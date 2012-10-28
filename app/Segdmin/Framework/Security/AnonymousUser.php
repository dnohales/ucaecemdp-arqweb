<?php
namespace Segdmin\Framework\Security;

/**
 * Description of AnonymousUser
 *
 * @author eagleoneraptor
 */
class AnonymousUser implements UserInterface
{
	public function getRoles()
	{
		return array(Roles::ANONYMOUS);
	}
}

?>
