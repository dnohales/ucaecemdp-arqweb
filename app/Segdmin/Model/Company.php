<?php
namespace Segdmin\Model;

/**
 * Description of Admin
 *
 * @author eagleoneraptor
 */
class Company extends Entity
{
	private $name;
	private $address;
	private $liability;
	private $taxEnd;
	private $taxMono;
	private $taxResp;
	private $comission;
	private $discount;
	
	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getAddress()
	{
		return $this->address;
	}

	public function setAddress($address)
	{
		$this->address = $address;
	}

	public function getLiability()
	{
		return $this->liability;
	}

	public function setLiability($liability)
	{
		$this->liability = $liability;
	}

	public function getTaxEnd()
	{
		return $this->taxEnd;
	}

	public function setTaxEnd($taxEnd)
	{
		$this->taxEnd = $taxEnd;
	}

	public function getTaxMono()
	{
		return $this->taxMono;
	}

	public function setTaxMono($taxMono)
	{
		$this->taxMono = $taxMono;
	}

	public function getTaxResp()
	{
		return $this->taxResp;
	}

	public function setTaxResp($taxResp)
	{
		$this->taxResp = $taxResp;
	}

	public function getComission()
	{
		return $this->comission;
	}

	public function setComission($comission)
	{
		$this->comission = $comission;
	}

	public function getDiscount()
	{
		return $this->discount;
	}

	public function setDiscount($discount)
	{
		$this->discount = $discount;
	}
	
	public function getUser()
	{
		return $this->getOrm()->getRepository('User')->findOneBy(array(
			'companyId' => $this->getId()
		));
	}
	
	public function getCoverages()
	{
		return $this->getOrm()->getRepository('Coverage')->findAllBy(array(
			'companyId' => $this->getId()
		));
	}

}

