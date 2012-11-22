<?php
namespace Segdmin\Repository;

use Segdmin\Framework\Database\MappingInformation;

/**
 * Description of UserRepository
 *
 * @author eagleoneraptor
 */
class CompanyRepository extends EntityRepository
{
	protected function createMappingInformation()
	{
		return new MappingInformation('company', array(
			'id' => 'id',
			'name' => 'string',
			'address' => 'string',
			'liability' => 'int',
			'taxEnd' => 'float',
			'taxMono' => 'float',
			'taxResp' => 'float',
			'comission' => 'int',
			'discount' => 'int',
		));
	}
}

