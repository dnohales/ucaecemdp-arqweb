<?php
namespace Segdmin\Framework\Database\Type;

/**
 * Description of Int
 *
 * @author eagleoneraptor
 */
class Int implements TypeInterface
{
	public function toNative($value)
	{
		return $value === null? null:(int)$value;
	}
	
	public function toDatabase($value)
	{
		return $value === null? null:(int)$value;
	}
	
	public function bindFormat()
	{
		return \PDO::PARAM_INT;
	}
}

