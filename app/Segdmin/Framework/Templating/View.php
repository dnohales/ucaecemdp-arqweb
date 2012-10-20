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
	private $rawContent;
	private $afterExtendReached;
	private $currentBlock;
	
	public function __construct(TemplateManager $templateManager, $viewFile, array $parameters)
	{
		$this->templateManager = $templateManager;
		$this->viewFile = $viewFile;
		$this->parameters = $parameters;
		$this->rawContent = array();
		$this->afterExtendReached = false;
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
		$this->rawContent = $extendedView->getRawContent();
		
		$this->obStart();
	}
	
	public function partial($viewName, array $parameters = array())
	{
		$this->afterExtendReached = true;
		echo $this->templateManager->renderView($viewName, $parameters);
	}
	
	public function parentBlock()
	{
		if($this->currentBlock === null){
			throw new TemplatingException('Debes estar dentro de un bloque para imprimir el contenido del bloque padre');
		}
		
		foreach($this->rawContent as $value){
			if($value[0] == $this->currentBlock){
				return $value[1];
			}
		}
	}
	
	public function block($blockName)
	{
		if(!$blockName){
			throw new TemplatingException('El nombre del bloque no puede estar vacío');
		}
		
		if($this->currentBlock){
			throw new TemplatingException('No puedes llamar bloques de forma anidada');
		}
		
		$this->afterExtendReached = true;
		
		if($this->isExtended()){
			$this->obClean();
		} else {
			$this->setRawContent(null, $this->obGetClean());
		}
		
		$this->currentBlock = $blockName;
	}
	
	public function endBlock()
	{
		if($this->currentBlock === null){
			throw new TemplatingException('No hay ningún bloque para terminar');
		}
		
		$this->afterExtendReached = true;
		
		$this->setRawContent($this->currentBlock, $this->obGetClean());
		$this->currentBlock = null;
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
		
		if($this->isExtended()){
			$this->obClean();
		} else {
			$this->setRawContent(null, $this->obGetClean());
		}
		
		$this->obEnd();
	}
	
	private function invokeViewFile()
	{
		extract($this->getParameters());
		include($this->getViewFile());
	}
	
	public function render()
	{
		$str = '';
		foreach($this->rawContent as $value){
			$str .= $value[1];
		}
		return $str;
	}
	
	private function setRawContent($block, $content)
	{
		if($block === null){
			$this->rawContent[] = array(null, $content);
		} else {
			foreach($this->rawContent as $key => $value){
				if($value[0] == $block){
					$this->rawContent[$key][1] = $content;
					return;
				}
			}
			$this->rawContent[] = array($block, $content);
		}
	}
	
	private function getRawContent()
	{
		return $this->rawContent;
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

?>
