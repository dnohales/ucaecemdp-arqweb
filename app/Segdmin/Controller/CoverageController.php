<?php
namespace Segdmin\Controller;

use Segdmin\Framework\Controller;

class CoverageController extends Controller
{
	public function addAction()
	{
		return $this->render('Coverage:add');
	}
    
    public function removeAction()
	{
		return $this->render('Coverage:remove');
	}
}
?>
