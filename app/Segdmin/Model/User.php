<?php
namespace Segdmin\Model;

use Segdmin\Framework\Security\Roles;
use Segdmin\Framework\Security\UserEntity;

/**
 * Description of User
 *
 * @author eagleoneraptor
 */
class User extends UserEntity
{
	private $email;
	private $password;
	private $salt;
	private $adminId;
	private $companyId;
	private $producerId;
	private $relatedEntity;
	
	protected function init()
	{
		$this->salt = md5(uniqid('', true).time());
		$this->relatedEntity = false;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function setPlainPassword($plainPassword)
	{
		$this->password = $this->encodePassword($plainPassword);
	}
	
	private function encodePassword($plainPassword)
	{
		return md5($plainPassword.'{'.$this->getSalt().'}');
	}
	
	public function passwordMatch($plainPassword)
	{
		return $this->encodePassword($plainPassword) === $this->getPassword();
	}

	public function getSalt()
	{
		return $this->salt;
	}

	public function getRoles()
	{
		$relatedRole = $this->getRelatedRole();
		return array($relatedRole ?: Roles::ADMIN, Roles::LOGGEDIN, Roles::ANONYMOUS);
	}
	
	private function getRelatedRole()
	{
		if($this->adminId === null){
			return Roles::ADMIN;
		} else if($this->producerId === null){
			return Roles::PRODUCER;
		} else if($this->companyId === null) {
			return Roles::COMPANY;
		} else {
			return null;
		}
	}
	
	public function getRelatedEntity()
	{
		if($this->relatedEntity === false){
			switch($this->getRelatedRole())
			{
			case Roles::ADMIN:
				$this->relatedEntity = $this->orm->find('Admin', $this->adminId);
				break;
			case Roles::ADMIN:
				$this->relatedEntity = $this->orm->find('Producer', $this->adminId);
				break;
			case Roles::ADMIN:
				$this->relatedEntity = $this->orm->find('Company', $this->adminId);
				break;
			default:
				$this->relatedEntity = null;
				break;
			}
		}
		
		return $this->relatedEntity;
	}
	
	public function setAdmin(Admin $admin)
	{
		$this->companyId = null;
		$this->producerId = null;
		$this->adminId = $admin->getId();
		$this->relatedEntity = false;
	}
	
	public function setCompany(Company $company)
	{
		$this->companyId = $company->getId();
		$this->producerId = null;
		$this->adminId = null;
		$this->relatedEntity = false;
	}
	
	public function setProducer(Producer $producer)
	{
		$this->companyId = null;
		$this->producerId = $producer->getId();
		$this->adminId = null;
		$this->relatedEntity = false;
	}

}

