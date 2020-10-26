<?php

declare(strict_types=1);

namespace App\Module\Front\Auth\Form\SignIn;

use App\UI\Form\Renderer\BootstrapRenderer;
use Nette\Application\UI\Form;

class SignInFormFactory
{
	public function create(): Form
	{
		$form = new Form();
		
		$form->addText('username', 'Username')
			->setRequired();
		
		$form->addPassword('password', 'Password')
			->setRequired();
		
		$form->addSubmit('submit', 'Log in');
		
		// This is not necessary if you want just plain array or array object in onSuccess callback
		$form->setMappedType(SignInFormData::class);
		$form->setRenderer(new BootstrapRenderer());
		
		return $form;
	}
}
