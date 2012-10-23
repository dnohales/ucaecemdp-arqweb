<?php
namespace Segdmin\Controller;

use Segdmin\Framework\Controller;

class RequestController extends Controller
{
	public function addAction()
	{
		return $this->render('Request:add');
	}
    
    public function removeAction()
	{
		return $this->render('Request:remove');
	}
    
    public function editAction()
	{
		return $this->render('Request:edit');
	}
    
    public function answerAction()
	{
		return $this->render('Request:answer');
	}
}
?>
