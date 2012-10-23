<?php
namespace Segdmin\Controller;

use Segdmin\Framework\Controller;

class TakerController extends Controller
{
	public function addAction()
	{
		return $this->render('Taker:add');
	}
    
    public function removeAction()
	{
		return $this->render('Taker:remove');
	}
    
    public function editAction()
	{
		return $this->render('Taker:edit');
	}
}
?>
