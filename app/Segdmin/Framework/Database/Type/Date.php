<?php
namespace Segdmin\Framework\Database\Type;

/**
 * Description of DateTime
 *
 * @author eagleoneraptor
 */
class Date implements TypeInterface
{
	public function toNative($value)
	{
		return $value === null? null:\DateTime::createFromFormat('Y-m-d', $value);
	}
	
	public function toDatabase($value)
	{
		return $value === null? null:$value->format('Y-m-d');
	}
	
	public function bindFormat()
	{
		return \PDO::PARAM_STR;
	}
}

