<?php
namespace Segdmin\Framework;

/**
 *
 * @author eagleoneraptor
 */
interface ApplicationAggregateInterface
{
	function getApplication();
	function setApplication(Application $application);
}

?>
