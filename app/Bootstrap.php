<?php

declare(strict_types=1);

namespace App;

use Nette\Bootstrap\Configurator;

class Bootstrap
{
	public static function boot(): Configurator
	{
		$configurator = new Configurator;
		
		// You can enter also your ip address or array of IP addresses to setDebugMode
		$configurator->setDebugMode(true)
			->setTimeZone('Europe/Prague')
			->setTempDirectory(__DIR__ . '/../temp');

		$configurator->addConfig(__DIR__ . '/../config/main.neon');

		$configurator->enableTracy(__DIR__ . '/../log');

		return $configurator;
	}
}
