<?php
namespace Segdmin\Controller;

use Segdmin\Framework\Controller;
use Segdmin\Model\User;
use Segdmin\Model\Coverage;

class CoverageController extends Controller
{
	public function indexAction()
	{
		$tableFields = array(
			'Descripción' => 'description',
			'Tasa' => 'rate',
		);
		
		if($this->getUser()->getCompany() !== null){
			$coverages = $this->getOrm()->getRepository('Coverage')->findAllBy(array(
				'companyId' => $this->getUser()->getCompany()->getId()
			));
		} else {
			$coverages = $this->getOrm()->getRepository('Coverage')->findAll();
			$controller = $this;
			$tableFields['Compañía'] = function($coverage) use($controller){
				return '<a href="'.$controller->generateUrl('company_detail', array('id' => $coverage->getCompany()->getId())).'">'.$coverage->getCompany()->getName().'</a>';
			};
		}
		
		return $this->render('Coverage:index', array(
			'coverages' => $coverages,
			'tableFields' => $tableFields
		));
	}
	
	public function addAction()
	{
		$coverage = new Coverage($this->getOrm());
		
		if($this->getRequest()->isPost()){
			$post = $this->getRequest()->post();
			
			$this->bindIntoEntity($coverage, $post);
			$this->getOrm()->save($coverage);
			
			$this->getSession()->setFlash('success', 'Se añadió la cobertura correctamente');
			return $this->redirectByRoute('company_index');
		}
		
		return $this->render('Coverage:add', array(
			'companies' => $this->getUser()->getCompany() === null?
				$this->getOrm()->getRepository('Company')->findAll():
				array(),
			'coverage' => $coverage
		));
	}
	
	public function removeAction($id)
	{
		$company = $this->findEntity('Company', $id);
		
		$this->getOrm()->remove($company->getUser());
		$this->getOrm()->remove($company);
		$this->getSession()->setFlash('success', 'La compañía se ha eliminado correctamente');
		return $this->redirectByRoute('company_index');
	}
    
    public function detailAction($id)
	{
		$coverage = $this->findEntity('Coverage', $id);
		
		if($this->getRequest()->isPost()){
			$this->bindIntoEntity($coverage, $this->getRequest()->post());
			$this->getOrm()->save($coverage);
			$this->getSession()->setFlash('success', 'Se han guardado los cambios correctamente');
			return $this->reloadCurrentUri();
		}
		
		return $this->render('Coverage:detail', array(
			'coverage' => $coverage
		));
	}
}
