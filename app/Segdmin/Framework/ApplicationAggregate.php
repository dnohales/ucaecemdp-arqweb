<?php
namespace Segdmin\Framework;

/**
 * Description of ApplicationAggregate
 *
 * @author eagleoneraptor
 */
class ApplicationAggregate implements ApplicationAggregateInterface
{
	protected $application;
	
	public function getApplication()
	{
		return $this->application;
	}

	public function setApplication(Application $application)
	{
		$this->application = $application;
	}

}

?>
