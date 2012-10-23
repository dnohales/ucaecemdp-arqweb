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
		return $this->render('Auth:login');
	}
}

