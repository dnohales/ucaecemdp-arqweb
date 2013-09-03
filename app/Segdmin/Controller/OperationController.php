<?php
namespace Segdmin\Controller;

use Exception;
use Segdmin\Framework\Controller;
use Segdmin\Framework\Exception\HttpException;
use Segdmin\Framework\Security\Roles;
use Segdmin\Model\Operation;

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
			},
			'Fecha' => function($operation) {
				return $operation->getCreationTime()->format('d/m/Y');
			}
		);
		
		if($this->getUser()->getCompany() === null){
			$tableFields['Compañía'] = function($operation){
				return $operation->getCoverage()->getCompany()->getName();
			};
		}
		
		$controller = $this;
		$tableFields['Acción'] = function($operation) use($controller){
			$content = '';

			switch ($operation->getAcceptedState())
			{
			case Operation::STATE_PENDING:
				if ($controller->isGranted('operation_answer')) {
					$content .= '<a data-operation-id="'.$operation->getId().'" class="operation-answer-btn btn btn-primary"><i></i> Aprobar/Rechazar</a>';
				}
				break;

			case Operation::STATE_REJECTED:
				$content .= '<span class="operation-rejected">Rechazado</span>';
				break;

			case Operation::STATE_ACCEPTED:
				$content .= '<span class="operation-accepted">Aceptado</span>';
				break;
			}
			$content .= ' <a class="btn" href="'.$controller->generateUrl('operation_detail', array('id' => $operation->getId())).'" title="Ver detalles"><i class="icon icon-search"></i></a>';
			
			return $content;
		};
		
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
		} catch(Exception $e) {
			$totalCost = null;
		}
		
		return json_encode(array('result' => $totalCost));
	}
    
    public function removeAction()
	{
		return $this->render('Operation:remove');
	}
    
    public function detailAction($id)
	{
		$operation = $this->findEntity('Operation', $id);
		
		return $this->render('Operation:detail', array(
			'operation' => $operation
		));
	}
    
    public function answerAction($id)
	{
		/* @var $operation Operation */
		$operation = $this->findEntity('Operation', $id);
		
		switch ($this->getRequest()->post()->get('type'))
		{
		case 'accept':
			$operation->accept();
			break;
		
		case 'reject':
			$operation->reject();
			break;
		
		default:
			throw new HttpException(401);
		}
		
		$this->getOrm()->save($operation);
		
		return '{"status": "success"}';
	}
	
	public function getAnswerDialogContentAction($id)
	{
		$operation = $this->findEntity('Operation', $id);
		
		return $this->render('Operation:_detail', array(
			'operation' => $operation
		));
	}
}
?>
