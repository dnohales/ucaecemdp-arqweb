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
	
	/**
	 * @return Application 
	 */
	public function getApplication()
	{
		return $this->application;
	}

	public function setApplication(Application $application)
	{
		$this->application = $application;
	}

}

