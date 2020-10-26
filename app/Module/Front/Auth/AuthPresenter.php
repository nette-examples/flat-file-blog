<?php

declare(strict_types=1);

namespace App\Module\Front\Auth;

use App\Module\Front\Auth\Form\SignIn\SignInFormData;
use App\Module\Front\Auth\Form\SignIn\SignInFormFactory;
use App\Module\Front\BaseFrontPresenter;
use Nette\Application\UI\Form;
use Nette\Security\AuthenticationException;
use Nette\Security\IAuthenticator;

/**
 * @property AuthTemplate $template
 */
class AuthPresenter extends BaseFrontPresenter
{
	public function __construct(
		private SignInFormFactory $signInFormFactory
	) {
		parent::__construct();
	}
	
	public function createComponentSignInForm(): Form
	{
		$form = $this->signInFormFactory->create();
		
		$form->onSuccess[] = function (Form $form, SignInFormData $data) {
			try {
				$this->user->login($data->username, $data->password);
				$this->flashMessage('Successfully logged in', 'success');
				
			} catch (AuthenticationException) {
				$this->flashMessage('Bad credentials', 'danger');
			}
			$this->redirect('this');
		};
		
		return $form;
	}
}
