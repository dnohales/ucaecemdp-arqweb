<?php
namespace Segdmin\Framework\Templating;

use Segdmin\Model\Entity;

/**
 * Description of WidgetManager
 *
 * @author eagleoneraptor
 */
class HtmlHelper
{
	public function options($data, $selected, $toStringClosure = null, $emptyLabel = 'Seleccione...')
	{
		$out = '';
		
		$out .= "<option value=\"\">$emptyLabel</option>";
		foreach($data as $k => $d){
			if(is_int($k) && $d instanceof Entity){
				$k = $d->getId();
			}
			
			if($toStringClosure !== null){
				$label = $toStringClosure($d);
			} else {
				$label = (string)$d;
			}
			
			$out .= "<option value=\"$k\"";
			if($d === $selected){
				$out .= ' selected';
			}
			$out .= ">$label</option>";
		}
		
		return $out;
	}
}

?>
