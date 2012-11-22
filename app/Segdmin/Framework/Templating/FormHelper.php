<?php
namespace Segdmin\Framework\Templating;

use Segdmin\Framework\Form\Form;
use Segdmin\Framework\Form\FormField;

/**
 * Description of FormHelper
 *
 * @author damiannohales
 */
class FormHelper
{
	public function row(FormField $field)
	{
		$o = '<div class="form-row">';
		$o = '<label>'.$field->getLabel().'</label>';
		$o = '<div class="form-widget">'.$field->render().'</div>';
		$o = '<div class="form-errors">'.$this->errors($field).'</div>';
	}
}
