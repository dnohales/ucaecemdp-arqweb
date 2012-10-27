<?php
namespace Segdmin\Model;

use Segdmin\Framework\Database\ORM;

/**
 * Description of Entity
 *
 * @author eagleoneraptor
 */
class Entity
{
	protected $id;
	protected $orm;

	final public function __construct(ORM $orm)
	{
		$this->orm = $orm;
		$this->init();
	}
	
	protected function init()
	{
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getOrm()
	{
		return $this->orm;
	}
}

?>
