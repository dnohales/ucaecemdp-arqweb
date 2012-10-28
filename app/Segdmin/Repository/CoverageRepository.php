<?php
namespace Segdmin\Repository;

use Segdmin\Framework\Database\MappingInformation;

/**
 * Description of CoverageRepository
 *
 * @author eagleoneraptor
 */
class CoverageRepository extends EntityRepository
{
	protected function createMappingInformation()
	{
		return new MappingInformation('coverage', array(
			'id' => 'id',
			'companyId' => 'int',
			'description' => 'string',
			'rate' => 'float',
		));
	}
}

