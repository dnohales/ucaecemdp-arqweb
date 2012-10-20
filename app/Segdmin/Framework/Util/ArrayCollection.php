<?php

namespace Segdmin\Framework\Util;

use \Closure;
use \ArrayIterator;
use \InvalidArgumentException;
use \Countable;
use \IteratorAggregate;
use \ArrayAccess;

/**
 * 
 */
class ArrayCollection implements Countable, IteratorAggregate, ArrayAccess
{

	private $_elements;

	public function __construct(array $elements = array())
	{
		$this->_elements = $elements;
	}

	public function toArray()
	{
		return $this->_elements;
	}

	public function first()
	{
		return reset($this->_elements);
	}

	public function last()
	{
		return end($this->_elements);
	}

	public function key()
	{
		return key($this->_elements);
	}

	public function next()
	{
		return next($this->_elements);
	}

	public function current()
	{
		return current($this->_elements);
	}

	public function remove($key)
	{
		if (isset($this->_elements[$key])) {
			$removed = $this->_elements[$key];
			unset($this->_elements[$key]);

			return $removed;
		}

		return null;
	}

	public function removeElement($element)
	{
		$key = array_search($element, $this->_elements, true);

		if ($key !== false) {
			unset($this->_elements[$key]);

			return true;
		}

		return false;
	}

	public function offsetExists($offset)
	{
		return $this->containsKey($offset);
	}

	public function offsetGet($offset)
	{
		if (isset($this->_elements[$offset])) {
			return $this->_elements[$offset];
		}
		throw new InvalidArgumentException("La clave \"$offset\" no existe en la colección");
	}

	public function offsetSet($offset, $value)
	{
		if (!isset($offset)) {
			return $this->add($value);
		}
		return $this->set($offset, $value);
	}

	public function offsetUnset($offset)
	{
		return $this->remove($offset);
	}

	public function containsKey($key)
	{
		return isset($this->_elements[$key]);
	}
	
	public function has($key)
	{
		return isset($this->_elements[$key]);
	}

	public function contains($element)
	{
		return in_array($element, $this->_elements, true);
	}

	public function exists(Closure $p)
	{
		foreach ($this->_elements as $key => $element) {
			if ($p($key, $element)) {
				return true;
			}
		}
		return false;
	}

	public function indexOf($element)
	{
		return array_search($element, $this->_elements, true);
	}

	public function get($key, $default = null)
	{
		if (isset($this->_elements[$key])) {
			if (is_array($this->_elements[$key])) {
				return new static($this->_elements[$key]);
			} else {
				return $this->_elements[$key];
			}
		}
		return $default;
	}

	public function getKeys()
	{
		return array_keys($this->_elements);
	}

	public function getValues()
	{
		return array_values($this->_elements);
	}

	public function count()
	{
		return count($this->_elements);
	}

	public function set($key, $value)
	{
		$this->_elements[$key] = $value;
	}

	public function add($value)
	{
		$this->_elements[] = $value;
		return true;
	}

	public function isEmpty()
	{
		return !$this->_elements;
	}

	public function getIterator()
	{
		return new ArrayIterator($this->_elements);
	}

	public function map(Closure $func)
	{
		return new static(array_map($func, $this->_elements));
	}

	public function filter(Closure $p)
	{
		return new static(array_filter($this->_elements, $p));
	}

	public function forAll(Closure $p)
	{
		foreach ($this->_elements as $key => $element) {
			if (!$p($key, $element)) {
				return false;
			}
		}

		return true;
	}

	public function partition(Closure $p)
	{
		$coll1 = array();
		$coll2 = array();
		foreach ($this->_elements as $key => $element) {
			if ($p($key, $element)) {
				$coll1[$key] = $element;
			} else {
				$coll2[$key] = $element;
			}
		}
		return array(new static($coll1), new static($coll2));
	}

	public function clear()
	{
		$this->_elements = array();
	}

	public function slice($offset, $length = null)
	{
		return array_slice($this->_elements, $offset, $length, true);
	}

}
