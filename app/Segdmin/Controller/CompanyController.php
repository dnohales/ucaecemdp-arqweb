<?php
namespace Segdmin\Controller;

use Segdmin\Framework\Controller;

class CompanyController extends Controller
{
	public function addAction()
	{
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
