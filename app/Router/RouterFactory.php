<?php

declare(strict_types=1);

namespace App\Router;

use Nette\Application\Routers\RouteList;
use Nette\Application\UI\Presenter;

final class RouterFactory
{
	public function create(): RouteList
	{
		$router = new RouteList;

		$router->add($this->createAdminRouter());
		$router->add($this->createFrontRouter());

		return $router;
	}

	private function createFrontRouter(): RouteList
	{
		$frontRouter = new RouteList('Front');
		
		$frontRouter->addRoute('/blog/<slug>', [
			Presenter::PRESENTER_KEY => 'Article',
			Presenter::ACTION_KEY => 'default',
		]);

		$frontRouter->addRoute('/[<presenter=Homepage>][/<action=default>][/<id>]');

		return $frontRouter;
	}

	private function createAdminRouter(): RouteList
	{
		$adminRouter = new RouteList('Admin');

		$adminRouter->addRoute('admin[/<presenter=Dashboard>][/<action=default>][/<id>]');

		return $adminRouter;
	}
}
