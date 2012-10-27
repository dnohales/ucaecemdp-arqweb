<?php
namespace Segdmin\Model;

/**
 * Description of Admin
 *
 * @author eagleoneraptor
 */
class Taker extends Entity
{
	private $producerId;
	private $email;
	private $name;
	private $lastName;
	private $address;
	private $dni;
	private $cuit;
	private $birth;
	private $phones;
	private $condition;
	
	public function getProducerId()
	{
		return $this->producerId;
	}

	public function setProducerId($producerId)
	{
		$this->producerId = $producerId;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getLastName()
	{
		return $this->lastName;
	}

	public function setLastName($lastName)
	{
		$this->lastName = $lastName;
	}

	public function getAddress()
	{
		return $this->address;
	}

	public function setAddress($address)
	{
		$this->address = $address;
	}

	public function getDni()
	{
		return $this->dni;
	}

	public function setDni($dni)
	{
		$this->dni = $dni;
	}

	public function getCuit()
	{
		return $this->cuit;
	}

	public function setCuit($cuit)
	{
		$this->cuit = $cuit;
	}

	public function getBirth()
	{
		return $this->birth;
	}

	public function setBirth($birth)
	{
		$this->birth = $birth;
	}

	public function getPhones()
	{
		return $this->phones;
	}

	public function setPhones($phones)
	{
		$this->phones = $phones;
	}

	public function getCondition()
	{
		return $this->condition;
	}

	public function setCondition($condition)
	{
		$this->condition = $condition;
	}

}

