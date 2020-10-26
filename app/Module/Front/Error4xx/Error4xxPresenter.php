<?php

declare(strict_types=1);

namespace App\Module\Front\Error4xx;

use App\Module\Front\BaseFrontPresenter;
use Nette\Application\Helpers;

/**
 * @property Error4xxTemplate $template
 */
class Error4xxPresenter extends BaseFrontPresenter
{
	public function beforeRender(): void
	{
		parent::beforeRender();
		$file = __DIR__ . '/../@Templates/' . Helpers::splitName($this->getName())[1] . '/' . $this->getHttpResponse()->getCode() .'.latte';
		if (!file_exists($file)) {
			$this->getTemplate()->setFile(__DIR__ . '/../@Templates/' . Helpers::splitName($this->getName())[1] . '/4xx.latte');
		} else {
			$this->getTemplate()->setFile($file);
		}
	}
}
