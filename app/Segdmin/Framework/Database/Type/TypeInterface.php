<?php
namespace Segdmin\Framework\Database\Type;

/**
 *
 * @author eagleoneraptor
 */
interface TypeInterface
{
	function toNative($value);
	function toDatabase($value);
	function bindFormat();
}

