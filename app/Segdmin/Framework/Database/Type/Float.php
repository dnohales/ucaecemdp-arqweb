<?php
namespace Segdmin\Framework\Database\Type;

/**
 * Description of Float
 *
 * @author eagleoneraptor
 */
class Float implements TypeInterface
{
	public function toNative($value)
	{
		return (float)$value;
	}
	
	public function toDatabase($value)
	{
		return (float)$value;
	}
	
	public function bindFormat()
	{
		return \PDO::PARAM_STR;
	}
}

