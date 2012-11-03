<?php
namespace Segdmin\Model;

/**
 * Description of Admin
 *
 * @author eagleoneraptor
 */
class Coverage extends Entity
{
	private $companyId;
	private $description;
	private $rate;

	public function getCompanyId()
	{
		return $this->companyId;
	}

	public function setCompanyId($companyId)
	{
		$this->companyId = $companyId;
	}
	
	public function getCompany()
	{
		return $this->getOrm()->find('Company', $this->getCompanyId());
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function setDescription($description)
	{
		$this->description = $description;
	}

	public function getRate()
	{
		return $this->rate;
	}

	public function setRate($rate)
	{
		$this->rate = $rate;
	}


}

