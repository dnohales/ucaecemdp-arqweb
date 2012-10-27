<?php
namespace Segdmin\Framework\Logging;

/**
 * Description of LogEntry
 *
 * @author eagleoneraptor
 */
class LogEntry
{
	private $level;
	private $category;
	private $message;
	
	public function __construct($level, $message, $category)
	{
		$this->setLevel($level);
		$this->setMessage($message);
		$this->setCategory($category);
	}
	
	public function getLevel()
	{
		return $this->level;
	}

	public function setLevel($level)
	{
		$this->level = $level;
	}

	public function getCategory()
	{
		return $this->category;
	}

	public function setCategory($category)
	{
		$this->category = $category;
	}

	public function getMessage()
	{
		return $this->message;
	}

	public function setMessage($message)
	{
		$this->message = $message;
	}
}

?>
