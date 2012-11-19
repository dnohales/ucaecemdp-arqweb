<?php

namespace Segdmin\Framework\Form\Type;

use Segdmin\Framework\Form\FormField;

/**
 *
 * @author damiannohales
 */
interface FormTypeInterface
{
	function guessValidators();
	function render(FormField $field);
}
