<?php
namespace Segdmin\Controller;

use Segdmin\Framework\Controller;

/**
 * Description of AuthController
 *
 * @author eagleoneraptor
 */
class AuthController extends Controller
{
	public function loginAction()
	{
		$lastEmail = null;
		$error = null;
		
		if($this->getSession()->isLoggedIn()){
			return $this->redirectByRoute('index');
		}
		
		if($this->getRequest()->isPost()){
			$post = $this->getRequest()->post();
			
			$lastEmail = $post->get('email');
			$user = $this->getOrm()->getRepository('User')->findOneBy(array(
				'email' => $lastEmail
			));
			if($user !== null && $user->passwordMatch($post->get('password'))){
				$this->getSession()->login($user, $post->has('rememberMe')? 604800:0);
				return $this->redirectByRoute('index');
			} else {
				$error = 'La dirección de correo o password no son válidos';
			}
		}
		
		return $this->render('Auth:login', array(
			'lastEmail' => $lastEmail,
			'error' => $error
		));
	}
	
	public function logoutAction()
	{
		$this->getSession()->logout();
		return $this->redirectByRoute('login');
	}
}

