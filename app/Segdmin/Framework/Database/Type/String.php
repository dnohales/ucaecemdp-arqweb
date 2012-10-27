<?php
namespace Segdmin\Framework\Database\Type;

/**
 * Description of String
 *
 * @author eagleoneraptor
 */
class String implements TypeInterface
{
	public function toNative($value)
	{
		return $value === null? null:(string)$value;
	}
	
	public function toDatabase($value)
	{
		return $value === null? null:(string)$value;
	}
	
	public function bindFormat()
	{
		return \PDO::PARAM_STR;
	}
}

