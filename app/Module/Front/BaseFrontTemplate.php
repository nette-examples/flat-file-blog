<?php

declare(strict_types=1);

namespace App\Module\Front;

use Nette\Bridges\ApplicationLatte\Template;
use Nette\Security\User;

abstract class BaseFrontTemplate extends Template
{
	public array $flashes;
	public User $user;
}
