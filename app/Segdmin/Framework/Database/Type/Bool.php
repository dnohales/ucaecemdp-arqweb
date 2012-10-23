<?php
namespace Segdmin\Framework\Database\Type;

/**
 * Description of Bool
 *
 * @author eagleoneraptor
 */
class Bool implements TypeInterface
{
	public function toNative($value)
	{
		return (bool)$value;
	}
	
	public function toDatabase($value)
	{
		return (bool)$value;
	}
	
	public function bindFormat()
	{
		return \PDO::PARAM_BOOL;
	}
}

?>
