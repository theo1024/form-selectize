<?php
/**
 * Copyright (c) 2014 Petr Olišar (http://olisar.eu)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace App\Form\Control;

use Nette;
use Nette\PhpGenerator as Code;

/**
 * Description of ControlsExtension
 *
 * @author Petr Olišar <petr.olisar@gmail.com>
 */
class SelectizeExtension extends Nette\DI\CompilerExtension
{
	private $defaults =  [
	    'mode' => 'full',
	    'create' => true,
	    'maxItems' => null,
	    'delimiter' => '#/',
	    'plugins' => ['remove_button'],
	    'valueField' => 'id',
	    'labelField' => 'name',
	    'searchField' => 'name'
	];

	public function loadConfiguration()
	{
		$config = $this->getConfig($this->defaults);
		$builder = $this->getContainerBuilder();
		$builder->addDefinition($this->prefix('selectize'))
			->setClass('\App\Form\Control\Selectize');
	}

	public function afterCompile(Code\ClassType $class)
	{
		parent::afterCompile($class);

		$options = $this->getConfig($this->defaults);
		$this->initialization->addBody('\App\Form\Control\Selectize::register(?, ?);', ['addSelectize', $options]);
	}
}
