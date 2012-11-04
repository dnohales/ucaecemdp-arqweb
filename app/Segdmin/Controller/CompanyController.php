<?php
namespace Segdmin\Controller;

use Segdmin\Framework\Controller;
use Segdmin\Model\Company;
use Segdmin\Model\User;

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
			$post = $this->getRequest()->post();
			
			$this->bindIntoEntity($company, $post);
			$this->getOrm()->save($company);
			
			$user = new User($this->getOrm());
			$user->setEmail($post->get('user')->get('email'));
			$user->setPlainPassword($post->get('user')->get('password'));
			$user->setCompany($company);
			$this->getOrm()->save($user);
			
			$this->getSession()->setFlash('success', 'Se añadió la compañía correctamente');
			return $this->redirectByRoute('company_index');
		}
		
		return $this->render('Company:add', array(
			'company' => $company
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
	
	public function updateAction($id)
	{
		$company = $this->findEntity('Company', $id);
		
		$this->bindIntoEntity($company, $this->getRequest()->post());
		$this->getOrm()->save($company);
		
		$this->getSession()->setFlash('success', 'Se han guardado los cambios correctamente');
		
		return $this->redirectByRoute('company_detail', array(
			'id' => $company->getId()
		));
	}
    
    public function detailAction($id)
	{
		$company = $this->findEntity('Company', $id);
		
		return $this->render('Company:detail', array(
			'company' => $company
		));
	}
}
?>
