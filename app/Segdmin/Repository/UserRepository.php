<?php
namespace Segdmin\Repository;

use Segdmin\Framework\Database\MappingInformation;

/**
 * Description of UserRepository
 *
 * @author eagleoneraptor
 */
class UserRepository extends EntityRepository
{
	protected function createMappingInformation()
	{
		return new MappingInformation('user', array(
			'id' => 'id',
			'email' => 'string',
			'password' => 'string',
			'salt' => 'string',
			'adminId' => 'int',
			'producerId' => 'int',
			'companyId' => 'int',
		));
	}
}

