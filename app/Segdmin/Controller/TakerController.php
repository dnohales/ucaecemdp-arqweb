<?php
namespace Segdmin\Controller;

use Segdmin\Framework\Controller;

class TakerController extends Controller
{
	public function indexAction()
	{
		$producer = $this->getUser()->getProducer();
		if($producer !== null){
			$takers = $this->getOrm()->getRepository('Taker')->findAllBy(array(
				'producerId' => $producer->getId()
			));
		} else {
			$takers = $this->getOrm()->getRepository('Taker')->findAll();
		}
		
		return $this->render('Taker:index', array(
			'takers' => $takers
		));
	}
	
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
