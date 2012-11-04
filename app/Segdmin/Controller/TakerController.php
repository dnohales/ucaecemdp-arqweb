<?php
namespace Segdmin\Controller;

use Segdmin\Framework\Controller;
use Segdmin\Model\Taker;

class TakerController extends Controller
{
	public function findTaker($id)
	{
		$taker = $this->findEntity('Taker', $id);
		if($this->getUser()->getProducer() !== null && $this->getUser()->getProducer() !== $taker->getProducer()){
			throw $this->createForbbidenException();
		}
		return $taker;
	}
	
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
			$producers = $this->getOrm()->getRepository('Producer')->findAll('id ASC');
		}
		
		if($this->getRequest()->isPost()){
			$post = $this->getRequest()->post();
			
			$this->bindIntoEntity($taker, $post);
			if($producer !== null){
				$taker->setProducerId($producer->getId());
			}
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
		$taker = $this->findTaker($id);
		
		$this->getOrm()->remove($taker);
		
		$this->getSession()->setFlash('success', 'El cliente y sus operaciones relacionadas han sido eliminadas correctamente');
		return $this->redirectByRoute('taker_index');
	}
	
	public function updateAction($id)
	{
		$taker = $this->findTaker($id);
		
		$this->bindIntoEntity($taker, $this->getRequest()->post(), array(
			'email',
			'name',
			'lastName',
			'address',
			'dni',
			'cuit',
			'birth',
			'phones',
			'situation',
		));
		$this->getOrm()->save($taker);
		
		$this->getSession()->setFlash('success', 'Se han guardado los cambios correctamente');
		return $this->redirectByRoute('taker_detail', array(
			'id' => $taker->getId()
		));
	}
    
    public function detailAction($id)
	{
		$taker = $this->findTaker($id);
		
		return $this->render('Taker:detail', array(
			'taker' => $taker
		));
	}
}
?>
