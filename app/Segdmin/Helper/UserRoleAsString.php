<?php

namespace Segdmin\Helper;

use Segdmin\Framework\Security\Roles;
use Segdmin\Model\User;

/**
 * Description of UserRoleAsString
 *
 * @author Damián Nohales <damiannohales@uxorit.com>
 */
class UserRoleAsString
{
	public static function toText(User $user)
	{
		switch($user->getRelatedRole())
		{
		case Roles::ADMIN:
			if($user->isSuperUser()){
				return 'Administrador principal';
			} else {
				return 'Administrador ('.$user->getAdmin()->getFullName().')';
			}

		case Roles::PRODUCER:
			return 'Productor ('.$user->getProducer()->getFullName().')';

		case Roles::COMPANY:
			return 'Compañía ('.$user->getCompany()->getName().')';
		}
	}
	
}