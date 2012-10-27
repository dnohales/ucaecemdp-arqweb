<?php
namespace Segdmin\Repository;

use Segdmin\Framework\Database\MappingInformation;

/**
 * Description of UserRepository
 *
 * @author eagleoneraptor
 */
class TakerRepository extends EntityRepository
{
	protected function createMappingInformation()
	{
		return new MappingInformation('taker', array(
			'id' => 'id',
			'producerId' => 'int',
			'email' => 'string',
			'name' => 'string',
			'lastName' => 'string',
			'address' => 'string',
			'dni' => 'string',
			'cuit' => 'string',
			'birth' => 'dateTime',
			'phones' => 'string',
			'condition' => 'int',
		));
	}
}

