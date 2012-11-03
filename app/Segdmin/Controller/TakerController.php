<?php
namespace Segdmin\Controller;

use Segdmin\Framework\Controller;
use Segdmin\Model\Taker;

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
			'takers' => $takers,
		));
	}
	
	public function addAction()
	{
		$taker = new Taker($this->getOrm());
		
		$producer = $this->getUser()->getProducer();
		if($producer !== null){
			$producers = array();
		} else {
			$producers = $this->getOrm()->getRepository('Producer')->findAll('lastName, name ASC');
		}
		
		if($this->getRequest()->isPost()){
			$post = $this->getRequest()->post();
			
			$this->bindIntoEntity($taker, $post);
			$this->getOrm()->save($taker);
			
			$this->getSession()->setFlash('success', 'Se añadió el cliente correctamente');
			return $this->redirectByRoute('taker_index');
		}
		
		return $this->render('Taker:add', array(
			'taker' => $taker,
			'producers' => $producers
		));
	}
    
    public function removeAction()
	{
		return $this->render('Taker:remove');
	}
    
    public function detailAction($id)
	{
		$taker = $this->findEntity('Taker', $id);
		
		if($this->getRequest()->isPost()){
			$this->bindIntoEntity($taker, $this->getRequest()->post());
			$this->getOrm()->save($taker);
			$this->getSession()->setFlash('success', 'Se han guardado los cambios correctamente');
			return $this->reloadCurrentUri();
		}
		
		return $this->render('Taker:detail', array(
			'taker' => $taker
		));
	}
}
?>
