<?php

namespace Segdmin\Form;

/**
 * Description of ProducerForm
 *
 * @author damiannohales
 */
class ProducerForm
{
	protected function build()
	{
		$this->add('name', 'text', array(
			'label' => 'Nombre'
		));
		$this->add('lastName', 'text', array(
			'label' => 'Apellido'
		));
	}
}
