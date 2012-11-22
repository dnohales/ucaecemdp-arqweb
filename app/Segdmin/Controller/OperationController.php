<?php
namespace Segdmin\Controller;

use Segdmin\Framework\Controller;
use Segdmin\Model\Coverage;
use Segdmin\Model\Operation;

class OperationController extends Controller
{
	public function indexAction()
	{
		return $this->render('Base:full');
	}
	
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
		if($this->getRequest()->isPost()){
			$this->bindIntoEntity($operation, $this->getRequest()->post());
			$this->getOrm()->save($operation);
			
			$this->getSession()->setFlash('success', 'La operación se realizó correctamente y ha pasado al proceso de verificación.');
			return $this->redirectByRoute('operation_index');
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
	
	public function getOperationTotalCostAction()
	{
		$operation = new Operation($this->getOrm());
		
		try {
			$this->bindIntoEntity($operation, $this->getRequest()->post());
			$totalCost = $operation->getTotalCost();
		} catch(\Exception $e) {
			$totalCost = null;
		}
		
		return json_encode(array('result' => $totalCost));
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
