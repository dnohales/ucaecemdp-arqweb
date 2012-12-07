<?php
namespace Segdmin\Controller;

use Segdmin\Framework\Controller;
use Segdmin\Model\Producer;
use Segdmin\Model\User;

class UserController extends Controller
{
	public function indexAction()
	{
		return $this->render('User:index', array(
			'users' => $this->getOrm()->getRepository('User')->findAll()
		));
	}
	
	public function addAction()
	{
		$user = new User($this->getOrm());
		
		if($this->getRequest()->isPost()){
			/*$post = $this->getRequest()->post();
			
			$this->bindIntoEntity($user, $post);
			$this->getOrm()->save($user);
			
			$user = new User($this->getOrm());
			$user->setEmail($post->get('user')->get('email'));
			$user->setPlainPassword($post->get('user')->get('password'));
			$user->setProducer($user);
			$this->getOrm()->save($user);*/
			
			$this->getSession()->setFlash('success', 'Se añadió el usuario correctamente');
			return $this->redirectByRoute('user_index');
		}
		
		return $this->render('User:add', array(
			'user' => $user
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
	
	public function updateAction($id)
	{
		$producer = $this->findEntity('Producer', $id);
		
		$this->bindIntoEntity($producer, $this->getRequest()->post());
		$this->getOrm()->save($producer);
		$this->getSession()->setFlash('success', 'Se han guardado los cambios correctamente');
		
		return $this->redirectByRoute('producer_detail', array(
			'id' => $producer->getId()
		));
	}
    
    public function detailAction($id)
	{
		$producer = $this->findEntity('Producer', $id);
		
		return $this->render('Producer:detail', array(
			'producer' => $producer
		));
	}
}
