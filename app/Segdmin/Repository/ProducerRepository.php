<?php
namespace Segdmin\Repository;

use Segdmin\Framework\Database\MappingInformation;

/**
 * Description of UserRepository
 *
 * @author eagleoneraptor
 */
class ProducerRepository extends EntityRepository
{
	protected function createMappingInformation()
	{
		return new MappingInformation('producer', array(
			'id' => 'id',
			'name' => 'string',
			'lastName' => 'string',
			'dni' => 'string',
			'address' => 'string',
			'phones' => 'string',
		));
	}
}

