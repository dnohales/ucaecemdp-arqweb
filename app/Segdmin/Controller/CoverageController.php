<?php
namespace Segdmin\Controller;

use Segdmin\Framework\Controller;
use Segdmin\Model\User;
use Segdmin\Model\Coverage;

class CoverageController extends Controller
{
	public function findCoverage($id)
	{
		$coverage = $this->findEntity('Coverage', $id);
		if($this->getUser()->getCompany() !== null && $this->getUser()->getCompany() !== $coverage->getCompany()){
			throw $this->createForbbidenException();
		}
		return $coverage;
	}
	
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
			if($this->getUser()->getCompany() !== null){
				$coverage->setCompanyId($this->getUser()->getCompany()->getId());
			}
			$this->getOrm()->save($coverage);
			
			$this->getSession()->setFlash('success', 'Se añadió la cobertura correctamente');
			return $this->redirectByRoute('coverage_index');
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
		$coverage = $this->findCoverage($id);
		
		$this->getOrm()->remove($coverage);
		$this->getSession()->setFlash('success', 'La cobertura y sus peticiones asociadas se han eliminado correctamente');
		return $this->redirectByRoute('coverage_index');
	}
	
	public function updateAction($id)
	{
		$coverage = $this->findCoverage($id);
		
		$this->bindIntoEntity($coverage, $this->getRequest()->post(), array(
			'description',
			'rate'
		));
		$this->getOrm()->save($coverage);
		$this->getSession()->setFlash('success', 'Se han guardado los cambios correctamente');
		
		return $this->redirectByRoute('coverage_detail', array(
			'id' => $coverage->getId()
		));
	}
    
    public function detailAction($id)
	{
		$coverage = $this->findCoverage($id);
		
		return $this->render('Coverage:detail', array(
			'coverage' => $coverage
		));
	}
}
