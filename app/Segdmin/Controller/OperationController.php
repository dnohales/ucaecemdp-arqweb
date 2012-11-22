<?php
namespace Segdmin\Controller;

use Segdmin\Framework\Controller;
use Segdmin\Model\Coverage;
use Segdmin\Model\Operation;
use Segdmin\Framework\Security\Roles;

class OperationController extends Controller
{
	public function indexAction()
	{
		switch($this->getUser()->getRelatedRole())
		{
		case Roles::COMPANY:
			$operations = $this->getOrm()->getRepository('Operation')->loadAllByQuery(
				'SELECT o.id AS id, o.takerId AS takerId, o.accepted AS accepted, o.data AS data, o.model AS model, o.insured AS insured, o.comission AS comission, o.comment AS comment FROM operation AS o INNER JOIN coverage WHERE coverage.companyId = :companyId',
				array(
					':companyId' => $this->getUser()->getCompany()
				)
			);
			break;
		
		case Roles::PRODUCER:
			$operations = array();
			break;
		
		case Roles::ADMIN:
			$operations = $this->getOrm()->getRepository('Operation')->findAll();
			break;
		}
		
		$tableFields = array(
			'Cliente' => function($operation){
				return $operation->getTaker()->getFullName();
			},
			'Cobertura' => function($operation) {
				return $operation->getCoverage()->getDescription();
			}
		);
		
		if($this->getUser()->getCompany() === null){
			$tableFields['Compañía'] = function($operation){
				return $operation->getCoverage()->getCompany()->getName();
			};
		}
		
		if($this->isGranted('operation_answer')){
			$controller = $this;
			$tableFields['Acción'] = function($operation) use($controller){
				return '<a href="#'.$operation->getId().'" class="operation-answer-btn btn btn-primary"><i></i> Aprobar/Rechazar</a> <a class="btn" href="'.$controller->generateUrl('operation_detail', array('id' => $operation->getId())).'" title="Ver detalles"><i class="icon icon-search"></i></a>';
			};
		} else {
			$controller = $this;
			$tableFields['Acción'] = function($operation) use($controller){
				return '<a class="btn" href="'.$controller->generateUrl('operation_detail', array('id' => $operation->getId())).'" title="Ver detalles"><i class="icon icon-search"></i></a>';
			};
		}
		
		return $this->render('Operation:index', array(
			'tableFields' => $tableFields,
			'operations' => $operations
		));
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
    
    public function detailAction()
	{
		return $this->render('Operation:edit');
	}
    
    public function answerAction()
	{
		return $this->render('Operation:answer');
	}
	
	public function getAnswerDialogContent($id)
	{
		$operation = $this->findEntity('Operation', $id);
		echo 'Y hasta acá llegamos...';
	}
}
?>
