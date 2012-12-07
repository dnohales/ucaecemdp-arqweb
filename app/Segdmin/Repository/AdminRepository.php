<?php
namespace Segdmin\Repository;

use Segdmin\Framework\Database\MappingInformation;

/**
 * Description of UserRepository
 *
 * @author eagleoneraptor
 */
class AdminRepository extends EntityRepository
{
	protected function createMappingInformation()
	{
		return new MappingInformation('admin', array(
			'id' => 'id',
			'name' => 'string',
			'lastName' => 'string',
		));
	}
}

