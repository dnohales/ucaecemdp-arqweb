<?php
namespace Segdmin\Controller;

use Segdmin\Framework\Controller;
use Segdmin\Model\Producer;
use Segdmin\Model\User;

class ProducerController extends Controller
{
	public function indexAction()
	{
		return $this->render('Producer:index', array(
			'producers' => $this->getOrm()->getRepository('Producer')->findAll()
		));
	}
	
	public function addAction()
	{
		$producer = new Producer($this->getOrm());
		
		if($this->getRequest()->isPost()){
			$post = $this->getRequest()->post();
			
			$this->bindIntoEntity($producer, $post);
			$this->getOrm()->save($producer);
			
			$user = new User($this->getOrm());
			$user->setEmail($post->get('user')->get('email'));
			$user->setPlainPassword($post->get('user')->get('password'));
			$user->setProducer($producer);
			$this->getOrm()->save($user);
			
			$this->getSession()->setFlash('success', 'Se añadió el productor correctamente');
			return $this->redirectByRoute('producer_index');
		}
		
		return $this->render('Producer:add', array(
			'producer' => $producer
		));
	}
    
    public function removeAction($id)
	{
		$producer = $this->findEntity('Producer', $id);
		
		$this->getOrm()->remove($producer->getUser());
		$this->getOrm()->remove($producer);
		$this->getSession()->setFlash('success', 'El productor se ha eliminado correctamente');
		return $this->redirectByRoute('producer_index');
	}
    
    public function detailAction($id)
	{
		$producer = $this->findEntity('Producer', $id);
		
		if($this->getRequest()->isPost()){
			$this->bindIntoEntity($producer, $this->getRequest()->post());
			$this->getOrm()->save($producer);
			$this->getSession()->setFlash('success', 'Se han guardado los cambios correctamente');
			return $this->reloadCurrentUri();
		}
		
		return $this->render('Producer:detail', array(
			'producer' => $producer
		));
	}
}
?>
