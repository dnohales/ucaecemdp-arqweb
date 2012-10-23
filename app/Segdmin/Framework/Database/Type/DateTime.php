<?php
namespace Segdmin\Framework\Database\Type;

/**
 * Description of DateTime
 *
 * @author eagleoneraptor
 */
class DateTime implements TypeInterface
{
	public function toNative($value)
	{
		return \DateTime::createFromFormat('Y-m-d H:i:s', $value);
	}
	
	public function toDatabase($value)
	{
		return $value->format('Y-m-d H:i:s');
	}
	
	public function bindFormat()
	{
		return \PDO::PARAM_STR;
	}
}

