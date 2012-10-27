<?php
namespace Segdmin\Model;

/**
 * Description of Admin
 *
 * @author eagleoneraptor
 */
class Request extends Entity
{
	private $takerId;
	private $coverageId;
	private $accepted;
	private $data;
	private $model;
	private $insured;
	private $comission;
	private $comment;
	
	public function getTakerId()
	{
		return $this->takerId;
	}

	public function setTakerId($takerId)
	{
		$this->takerId = $takerId;
	}

	public function getCoverageId()
	{
		return $this->coverageId;
	}

	public function setCoverageId($coverageId)
	{
		$this->coverageId = $coverageId;
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

}

