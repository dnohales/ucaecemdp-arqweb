<?php
namespace Segdmin\Controller;

use Segdmin\Framework\Controller;
use Segdmin\Model\Company;

class CompanyController extends Controller
{
	public function indexAction()
	{
		return $this->render('Company:index', array(
			'companies' => $this->getOrm()->getRepository('Company')->findAll()
		));
	}
	
	public function addAction()
	{
		$company = new Company($this->getOrm());
		
		if($this->getRequest()->isPost()){
			$this->bindIntoEntity($company, $this->getRequest()->post());
			$this->getOrm()->save($company);
			return $this->redirectByRoute('company_index');
		}
		
		return $this->render('Company:add', array(
			'company' => $company
		));
	}
    
    public function removeAction()
	{
		return $this->render('Company:remove');
	}
    
    public function editAction($id)
	{
		$company = $this->findEntity('Company', $id);
		
		if($this->getRequest()->isPost()){
			if($this->getRequest()->post()->has('remove')){
				$this->getOrm()->remove($company);
				return $this->redirectByRoute('company_index');
			} else {
				$this->bindIntoEntity($company, $this->getRequest()->post());
				$this->getOrm()->save($company);
				return $this->reloadCurrentUri();
			}
		}
		
		return $this->render('Company:edit', array(
			'company' => $company
		));
	}
}
?>
