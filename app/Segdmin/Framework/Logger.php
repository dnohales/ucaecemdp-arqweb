<?php
namespace Segdmin\Framework;

use Segdmin\Framework\Logging\LogEntry;

/**
 * Description of Logger
 *
 * @author eagleoneraptor
 */
class Logger
{
	const CRITICAL = 'critical';
	const ERROR = 'error';
	const WARNING = 'warning';
	const NOTICE = 'notice';
	const DEBUG = 'debug';
	
	const DEFAULT_CATEGORY = 'app';
	
	static private $singletonInstance;
	
	private $logs;
	
	private function __construct()
	{
		$this->logs = array();
	}
	
	static public function createInstance()
	{
		if(self::$singletonInstance === null){
			self::$singletonInstance = new Logger();
		}
		
		return self::$singletonInstance;
	}
	
	static public function getInstance()
	{
		if(self::$singletonInstance === null){
			throw new \Exception('Necesitas crear el logger primero usando Logger::createInstance');
		}
		
		return self::$singletonInstance;
	}
	
	static public function log($level, $message, $category = self::DEFAULT_CATEGORY)
	{
		self::getInstance()->_log($level, $message, $category);
	}
	
	static public function critical($message, $category = self::DEFAULT_CATEGORY)
	{
		self::getInstance()->_log(self::CRITICAL, $message, $category);
	}
	
	static public function error($message, $category = self::DEFAULT_CATEGORY)
	{
		self::getInstance()->_log(self::ERROR, $message, $category);
	}
	
	static public function warning($message, $category = self::DEFAULT_CATEGORY)
	{
		self::getInstance()->_log(self::WARNING, $message, $category);
	}
	
	static public function notice($message, $category = self::DEFAULT_CATEGORY)
	{
		self::getInstance()->_log(self::NOTICE, $message, $category);
	}
	
	static public function debug($message, $category = self::DEFAULT_CATEGORY)
	{
		self::getInstance()->_log(self::DEBUG, $message, $category);
	}
	
	private function _log($level, $message, $category)
	{
		$this->logs[] = new LogEntry($level, $message, $category);
	}
	
	public function getLogs()
	{
		return $this->logs;
	}
}

?>
