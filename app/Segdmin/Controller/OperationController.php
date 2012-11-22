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
		$operation = new Operation($this->getOrm());
		$operation->setCoverageId($coverage->getId());
		return $this->doAdd($operation);
	}
	
	public function addAction()
	{
		return $this->doAdd(new Operation($this->getOrm()));
	}
	
	public function doAdd(Operation $operation = null)
	{
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
	
	public function getOperationTotalCost()
	{
		$operation = new Operation($this->getOrm());
		
		$operation->setCoverageId($this->getRequest()->post()->get('coverageId'));
		$operation->setComission($this->getRequest()->post()->get('comission'));
		
		return json_encode(array('result' => $operation->getTotalCost()));
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
