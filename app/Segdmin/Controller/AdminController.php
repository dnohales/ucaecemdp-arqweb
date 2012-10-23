<?php
namespace Segdmin\Controller;

use Segdmin\Framework\Controller;

class AdminController extends Controller
{
	public function addAction()
	{
		return $this->render('Admin:add');
	}
    
    public function removeAction()
	{
		return $this->render('Admin:remove');
	}
}
?>
