<?php
namespace Segdmin\Controller;

use Segdmin\Framework\Controller;
use Segdmin\Framework\Security\Roles;
use Segdmin\Model\Admin;
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
			$post = $this->getRequest()->post();
			
			$user = new User($this->getOrm());
			$user->setEmail($post->get('user')->get('email'));
			$user->setPlainPassword($post->get('user')->get('password'));
			
			switch($post->get('rol'))
			{
			case Roles::ADMIN:
				$relatedAdmin = new Admin($this->getOrm());
				$this->bindIntoEntity($relatedAdmin, $post->get('admin'));
				$this->getOrm()->save($relatedAdmin);
				$user->setAdmin($relatedAdmin);
				break;
			
			case Roles::PRODUCER:
				$relatedProducer = $this->findEntity('Producer', $post->get('producerId'));
				$user->setProducer($relatedProducer);
				break;
			
			case Roles::COMPANY:
				$relatedCompany = $this->findEntity('Company', $post->get('companyId'));
				$user->setCompany($relatedCompany);
				break;
			}
			
			$this->getOrm()->save($user);
			
			$this->getSession()->setFlash('success', 'Se añadió el usuario correctamente');
			return $this->redirectByRoute('user_index');
		}
		
		return $this->render('User:add', array(
			'user' => $user
		));
	}
    
    public function removeAction($id)
	{
		$user = $this->findEntity('User', $id);
		
		$this->getOrm()->remove($user);
		$this->getSession()->setFlash('success', 'El usuario se ha eliminado correctamente');
		return $this->redirectByRoute('user_index');
	}
	
	public function updateAction($id)
	{
		$user = $this->findEntity('User', $id);
		
		$post = $this->getRequest()->post();
		if($post->get('user')->get('password') !== ''){
			$user->setPlainPassword($post->get('user')->get('password'));
		}
		
		$relatedEntity = $user->getRelatedEntity();
		if($relatedEntity instanceof Admin && $post->has('admin')){
			$this->bindIntoEntity($relatedEntity, $post->get('admin'));
			$this->getOrm()->save($relatedEntity);
		}
		
		$this->getOrm()->save($user);
		$this->getSession()->setFlash('success', 'Se han guardado los cambios correctamente');
		
		return $this->redirectByRoute('user_detail', array(
			'id' => $user->getId()
		));
	}
    
    public function detailAction($id)
	{
		$user = $this->findEntity('User', $id);
		
		return $this->render('User:detail', array(
			'user' => $user
		));
	}
}
