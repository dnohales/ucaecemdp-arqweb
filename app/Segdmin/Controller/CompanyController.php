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
			foreach($this->getRequest()->post() as $key => $value){
				$company->{"set$key"}(trim($value));
			}
			$this->getOrm()->insert($company);
			return $this->redirectByRoute('company_index');
		}
		
		return $this->render('Company:add');
	}
    
    public function removeAction()
	{
		return $this->render('Company:remove');
	}
    
    public function editAction()
	{
		return $this->render('Company:edit');
	}
}
?>
