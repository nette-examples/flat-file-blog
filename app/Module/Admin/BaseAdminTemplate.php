<?php

declare(strict_types=1);

namespace App\Module\Admin;

use Nette\Bridges\ApplicationLatte\Template;
use Nette\Security\User;

abstract class BaseAdminTemplate extends Template
{
	public array $flashes;
	public User $user;
}
