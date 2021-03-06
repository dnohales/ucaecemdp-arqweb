<?php
namespace Segdmin\Model;

/**
 * Description of Admin
 *
 * @author eagleoneraptor
 */
class Operation extends Entity
{
	const STATE_PENDING  = 2;
	const STATE_ACCEPTED = 1;
	const STATE_REJECTED = 0;
	
	private $takerId;
	private $coverageId;
	private $accepted;
	private $data;
	private $model;
	private $insured;
	private $comission;
	private $comment;
	private $creationTime;
	
	protected function init()
	{
		$this->creationTime = new \DateTime();
	}
	
	public function getTakerId()
	{
		return $this->takerId;
	}

	public function setTakerId($takerId)
	{
		$this->takerId = $takerId;
	}
	
	public function getTaker()
	{
		return $this->getOrm()->find('Taker', $this->getTakerId());
	}

	public function getCoverageId()
	{
		return $this->coverageId;
	}

	public function setCoverageId($coverageId)
	{
		$this->coverageId = $coverageId;
	}
	
	public function getCoverage()
	{
		return $this->getOrm()->find('Coverage', $this->getCoverageId());
	}

	public function getData()
	{
		return $this->data;
	}

	public function setData($data)
	{
		$this->data = $data;
	}

	public function getModel()
	{
		return $this->model;
	}

	public function setModel($model)
	{
		$this->model = $model;
	}

	public function getInsured()
	{
		return $this->insured;
	}

	public function setInsured($insured)
	{
		$this->insured = $insured;
	}

	public function getComission()
	{
		return $this->comission;
	}

	public function setComission($comission)
	{
		$this->comission = $comission;
	}

	public function getComment()
	{
		return $this->comment;
	}

	public function setComment($comment)
	{
		$this->comment = $comment;
	}
	
	public function getCreationTime()
	{
		return $this->creationTime;
	}

	public function setCreationTime($creationTime)
	{
		$this->creationTime = $creationTime;
	}
	
	public function getAcceptedState()
	{
		if($this->accepted === true){
			return self::STATE_ACCEPTED;
		} else if($this->accepted === false){
			return self::STATE_REJECTED;
		} else {
			return self::STATE_PENDING;
		}
	}
	
	public function accept()
	{
		$this->accepted = true;
	}
	
	public function reject()
	{
		$this->accepted = false;
	}
	
	public function getTotalCost()
	{
		if($this->getCoverage() === null || $this->getTaker() === null){
			throw new \Exception('La operación tiene campos necesarios, vacíos');
		}
		
		$SA = $this->getInsured();
		$T = $this->getCoverage()->getRate();
		$RC = $this->getCoverage()->getCompany()->getLiability();
		$D = $this->getComission();
		$SIT = $this->getTaker()->getTaxBySituation($this->getCoverage()->getCompany());
		
		if(!$SA || !$T || !$RC || !$D || !$SIT){
			throw new \Exception('La operación tiene campos necesarios, vacíos');
		}
		
		$result = ($SA * $T / 100 + $RC) * ( (100 - $D) / 100) * ( (100 + $SIT) / 100);
		return (float)number_format($result, 2, '.', '');
	}
	
	public function isTotalCostCalculable()
	{
		try{
			$this->getTotalCost();
			return true;
		} catch(\Exception $e){
			return false;
		}
	}
	
	public function isValidTotalCost()
	{
		return $this->isTotalCostCalculable() && $this->getTotalCost() > 0;
	}

}

