<?php
namespace Segdmin\Framework\Templating;

use Segdmin\Framework\Exception\TemplatingException;

/**
 * Description of ViewContext
 *
 * @author eagleoneraptor
 */
class View
{
	private $templateManager;
	private $viewFile;
	private $parameters;
	private $extendedViewName;
	private $afterExtendReached;
	private $blockStack;
	private $mainBlock;
	private $blocks;
	private $currentBlock;
	
	public function __construct(TemplateManager $templateManager, $viewFile, array $parameters)
	{
		$this->templateManager = $templateManager;
		$this->viewFile = $viewFile;
		$this->parameters = $parameters;
		$this->rawContent = array();
		$this->afterExtendReached = false;
		$this->blockStack = array();
		$this->mainBlock = new ViewBlock('main');
		$this->blocks = array();
	}
	
	public function getTemplateManager()
	{
		return $this->templateManager;
	}

	public function getViewFile()
	{
		return $this->viewFile;
	}

	public function getParameters()
	{
		return $this->parameters;
	}
	
	public function isExtended()
	{
		return $this->extendedViewName !== null;
	}
	
	public function extend($viewName)
	{
		if($this->afterExtendReached){
			throw new TemplatingException('Solo debes llamar a extend una sola vez por vista y antes de renderizar cualquier bloque o vista parcial');
		}
		
		$this->extendedViewName = $viewName;
		$this->afterExtendReached = true;
		
		$this->obEnd();
		
		$extendedView = $this->templateManager->createView($this->extendedViewName, $this->parameters);
		$extendedView->run();
		$this->blocks = $extendedView->blocks;
		$this->mainBlock = $extendedView->mainBlock;
		
		$this->obStart();
	}
	
	public function partial($viewName, array $parameters = array())
	{
		$this->afterExtendReached = true;
		return $this->templateManager->renderView($viewName, $parameters);
	}
	
	public function parentBlock()
	{
		if($this->currentBlock === null){
			throw new TemplatingException('Debes estar dentro de un bloque para imprimir el contenido del bloque padre');
		}
		
		return $this->blocks[$this->currentBlock->getName()]->render();
	}
	
	public function block($blockName)
	{
		if(!$blockName){
			throw new TemplatingException('El nombre del bloque no puede estar vacío');
		}
		
		$this->afterExtendReached = true;
		$newBlock = new ViewBlock($blockName);
		
		if(count($this->blockStack) == 0){
			if($this->isExtended()){
				//El contenido impreso entre una sobreescritura de bloque y otro se descarta
				//esto pasa cuando se extienden las vistas
				$this->obClean();
			} else {
				$this->mainBlock->addContent($this->obGetClean());
				$this->mainBlock->addContent($newBlock);
			}
		} else {
			//Si es un bloque anidado, se añade el contenido al bloque padre
			end($this->blockStack)->addContent($this->obGetClean());
			end($this->blockStack)->addContent($newBlock);
		}
		
		//Añado el bloque a la pila de bloques
		$this->currentBlock = $newBlock;
		$this->blockStack[] = $newBlock;
	}
	
	public function endBlock()
	{
		if($this->currentBlock === null){
			throw new TemplatingException('No hay ningún bloque para terminar');
		}
		
		$this->currentBlock->addContent($this->obGetClean());
		
		//Añado o sobreescribo el bloque actual
		if(!isset($this->blocks[$this->currentBlock->getName()])){
			$this->blocks[$this->currentBlock->getName()] = $this->currentBlock;
		} else {
			$this->blocks[$this->currentBlock->getName()]->setContent($this->currentBlock->getContent());
		}
		
		//Quito el bloque de la pila
		array_pop($this->blockStack);
		
		//Seteo como bloque actual al padre
		$endBlock = end($this->blockStack);
		$this->currentBlock = $endBlock===false? null:$endBlock;
	}
	
	public function asset($name)
	{
		return rtrim($this->getTemplateManager()->getApplication()->getCurrentRequest()->getBaseUrl(), '/').'/'.$name;
	}
	
	public function url($routeName, array $parameters = array())
	{
		return $this->getTemplateManager()->getApplication()->getRouter()->generate($routeName, $parameters);
	}
	
	public function run()
	{
		$this->obStart();
		$this->invokeViewFile();
		
		if($this->currentBlock){
			throw new TemplatingException('No se cerraron todos los bloques ¿te olvidaste de llamar a $view->endBlock()?');
		}
		
		//Se añade el último contenido de la vista
		if($this->isExtended()){
			$this->obClean();
		} else {
			$this->mainBlock->addContent($this->obGetClean());
		}
		
		$this->obEnd();
	}
	
	private function invokeViewFile()
	{
		$context = new ViewContext($this);
		$context->invokeView();
	}
	
	public function render()
	{
		return $this->mainBlock->render();
	}
	
	private function obClean()
	{
		@ob_end_clean();
		@ob_start();
	}
	
	private function obGetClean()
	{
		$o = @ob_get_clean();
		@ob_start();
		return $o;
	}
	
	private function obStart()
	{
		@ob_start();
	}
	
	private function obEnd()
	{
		@ob_end_clean();
	}

}
