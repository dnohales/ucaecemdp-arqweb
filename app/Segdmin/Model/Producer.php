<?php
namespace Segdmin\Model;

/**
 * Description of Admin
 *
 * @author eagleoneraptor
 */
class Producer extends Entity
{
	private $name;
	private $lastName;
	private $dni;
	private $address;
	private $phones;
	
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

	public function getDni()
	{
		return $this->dni;
	}

	public function setDni($dni)
	{
		$this->dni = $dni;
	}

	public function getAddress()
	{
		return $this->address;
	}

	public function setAddress($address)
	{
		$this->address = $address;
	}

	public function getPhones()
	{
		return $this->phones;
	}

	public function setPhones($phones)
	{
		$this->phones = $phones;
	}


}

