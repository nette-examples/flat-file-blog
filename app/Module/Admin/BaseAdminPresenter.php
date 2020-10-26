<?php

declare(strict_types=1);

namespace App\Module\Admin;

use Nette\Application\Helpers;
use Nette\Application\UI\Presenter;

/**
 * @property BaseAdminTemplate $template
 */
abstract class BaseAdminPresenter extends Presenter
{
	public function startup()
	{
		parent::startup();

		// User must be logged in to enter administration
		if (!$this->user->isLoggedIn()) {
			$this->flashMessage('You shall not pass', 'danger');
			$this->redirect(':Front:Auth:default');
		}
	}

	public function beforeRender(): void
	{
		$this->setLayout(__DIR__ . '/@Templates/@Layout/layout.latte');
		$this->getTemplate()->setFile(__DIR__ . '/@Templates/' . Helpers::splitName($this->getName())[1] . '/' . $this->getAction() .'.latte');
		
		// Here is possible to assign common variables among presenters, user is just an example, nette would automatically passed user to template anyway
		$this->template->user = $this->getUser();
	}

	public function handleLogout(): void
	{
		$this->getUser()->logout();
	}
}
