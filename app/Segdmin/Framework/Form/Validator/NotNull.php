<?php

namespace Segdmin\Framework\Form\Validator;

use Segdmin\Framework\Exception\ValidatorException;

/**
 * Description of NotNull
 *
 * @author damiannohales
 */
class NotNull implements ValidatorInterface
{
	public function validate($value)
	{
		if(!$value){
			throw new ValidatorException('Debe completar este campo');
		}
	}
}
