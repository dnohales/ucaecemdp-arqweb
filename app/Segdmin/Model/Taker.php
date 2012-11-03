<?php
namespace Segdmin\Model;

/**
 * Description of Admin
 *
 * @author eagleoneraptor
 */
class Taker extends Entity
{
	const COND_FINALCONSUMER = 1;
	const COND_MONO = 2;
	const COND_REGRESPONSIBLE = 3;
	
	private $producerId;
	private $email;
	private $name;
	private $lastName;
	private $address;
	private $dni;
	private $cuit;
	private $birth;
	private $phones;
	private $situation;
	
	public function getProducerId()
	{
		return $this->producerId;
	}

	public function setProducerId($producerId)
	{
		$this->producerId = $producerId;
	}
	
	public function getProducer()
	{
		return $this->getOrm()->getRepository('Producer')->find($this->getProducerId());
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
	
	public function getFullName()
	{
		return $this->getName().' '.$this->getLastName();
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
	
	static public function getSituationInformation()
	{
		return array(
			self::COND_FINALCONSUMER => 'Consumidor final',
			self::COND_MONO => 'Monotributista',
			self::COND_REGRESPONSIBLE => 'Responsable inscripto',
		);
	}

	public function getSituation()
	{
		return $this->situation;
	}
	
	public function getSituationAsString()
	{
		$info = self::getSituationInformation();
		return $info[$this->getSituation()];
	}

	public function setSituation($situation)
	{
		$this->situation = $situation;
	}
	
	public function getRequests()
	{
		return $this->getOrm()->getRepository('Request')->findAllBy(array(
			'takerId' => $this->getId()
		));
	}
}

