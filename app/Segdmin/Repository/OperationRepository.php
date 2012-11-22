<?php
namespace Segdmin\Repository;

use Segdmin\Framework\Database\MappingInformation;

/**
 * Description of OperationRepository
 *
 * @author eagleoneraptor
 */
class OperationRepository extends EntityRepository
{
	protected function createMappingInformation()
	{
		return new MappingInformation('operation', array(
			'id' => 'id',
			'takerId' => 'int',
			'coverageId' => 'int',
			'accepted' => 'bool',
			'data' => 'string',
			'model' => 'string',
			'insured' => 'int',
			'comission' => 'int',
			'comment' => 'string',
			'creationTime' => 'dateTime'
		));
	}
}

