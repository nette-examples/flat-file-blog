<?php

declare(strict_types=1);

namespace App\Module\Front\Error;

use Nette\Application\BadRequestException;
use Nette\Application\Helpers;
use Nette\Application\IPresenter;
use Nette\Application\IResponse;
use Nette\Application\Request;
use Nette\Application\Responses\CallbackResponse;
use Nette\Application\Responses\ForwardResponse;
use Nette\Http\IRequest;
use Nette\SmartObject;
use Tracy\ILogger;

class ErrorPresenter implements IPresenter
{
	use SmartObject;

	/** @inject */
	public ILogger $logger;

	public function run(Request $request): IResponse
	{
		$exception = $request->getParameter('exception');

		if ($exception instanceof BadRequestException) {
			[$module, , $sep] = Helpers::splitName($request->getPresenterName());
			return new ForwardResponse($request->setPresenterName($module . $sep . 'Error4xx'));
		}

		$this->logger->log($exception, ILogger::EXCEPTION);

		return new CallbackResponse(function (IRequest $httpRequest, \Nette\Http\IResponse $httpResponse): void {
			if (preg_match('#^text/html(?:;|$)#', (string) $httpResponse->getHeader('Content-Type'))) {
				$file = __DIR__ . '/../@Templates/Error/500.phtml';
				if (is_file($file)) {
					echo file_get_contents($file);
				} else {
					echo 'Error 500';
				}
			}
		});
	}
}
