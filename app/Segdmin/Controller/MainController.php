<?php
namespace Segdmin\Controller;

use Segdmin\Framework\Controller;

/**
 * Description of MainController
 *
 * @author damiannohales
 */
class MainController extends Controller
{
	public function indexAction()
	{
		return $this->render('Main:index');
	}
}
