<?php
namespace Segdmin\Framework\Templating;

/**
 * Description of ViewRawContent
 *
 * @author damiannohales
 */
class ViewBlock
{
	private $content;
	
	private $name;
	
	public function __construct($name)
	{
		$this->content = array();
		$this->name = $name;
	}
	
	public function addContent($contentOrBlock)
	{
		$this->content[] = $contentOrBlock;
	}
	
	public function getContent()
	{
		return $this->content;
	}
	
	public function setContent($content)
	{
		$this->content = $content;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function render()
	{
		$str = '';
		foreach($this->getContent() as $c){
			if($c instanceof ViewBlock){
				$str .= $c->render();
			} else {
				$str .= $c;
			}
		}
		return $str;
	}

}
