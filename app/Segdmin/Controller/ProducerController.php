<?php
namespace Segdmin\Controller;

use Segdmin\Framework\Controller;

class ProducerController extends Controller
{
	public function addAction()
	{
		return $this->render('Producer:add');
	}
    
    public function removeAction()
	{
		return $this->render('Producer:remove');
	}
    
    public function editAction()
	{
		return $this->render('Producer:edit');
	}
}
?>
