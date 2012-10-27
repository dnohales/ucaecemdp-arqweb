<?php
namespace Segdmin\Repository;

use Segdmin\Framework\Database\MappingInformation;

/**
 * Description of RequestRepository
 *
 * @author eagleoneraptor
 */
class RequestRepository extends EntityRepository
{
	protected function createMappingInformation()
	{
		return new MappingInformation('request', array(
			'id' => 'id',
			'takerId' => 'int',
			'coverageId' => 'int',
			'accepted' => 'bool',
			'data' => 'string',
			'model' => 'string',
			'insured' => 'int',
			'comission' => 'int',
			'comment' => 'string',
		));
	}
}

