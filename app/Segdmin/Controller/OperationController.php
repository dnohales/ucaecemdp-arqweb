<?php
namespace Segdmin\Controller;

use Segdmin\Framework\Controller;
use Segdmin\Model\Coverage;
use Segdmin\Model\Operation;

class OperationController extends Controller
{
	public function addByCoverageAction($coverageId)
	{
		$coverage = $this->findEntity('Coverage', $coverageId);
		return $this->doAdd($coverage);
	}
	
	public function addAction()
	{
		return $this->doAdd(null);
	}
	
	public function doAdd(Coverage $coverage = null)
	{
		$operation = new Operation($this->getOrm());
		
		if($coverage !== null){
			$operation->setCoverageId($coverage->getId());
		}
		
		return $this->render('Operation:add', array(
			'operation' => $operation
		));
	}
	
	public function getCompanyInfoAction($id)
	{
		$company = $this->findEntity('Company', $id);
		return json_encode(array(
			'coverages' => $this->getApplication()->getTemplateManager()->getHtmlHelper()->options(
				$this->getOrm()->getRepository('Coverage')->findAllBy(array(
					'companyId' => $company->getId()
				)),
				null,
				function($t){
					return $t->getId().': '.$t->getDescription();
				}
			),
			'comission' => $company->getComission()
		));
	}
    
    public function removeAction()
	{
		return $this->render('Operation:remove');
	}
    
    public function editAction()
	{
		return $this->render('Operation:edit');
	}
    
    public function answerAction()
	{
		return $this->render('Operation:answer');
	}
}
?>
