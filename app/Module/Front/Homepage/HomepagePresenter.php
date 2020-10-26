<?php

declare(strict_types=1);

namespace App\Module\Front\Homepage;

use App\Model\Article\Article;
use App\Model\Article\ArticleFacade;
use App\Module\Front\BaseFrontPresenter;

/**
 * @property HomepageTemplate $template
 */
class HomepagePresenter extends BaseFrontPresenter
{
	/** @var Article[] */
	private array $articles;
	
	public function __construct(
		private ArticleFacade $articleFacade
	) {
		parent::__construct();
	}
	
	public function actionDefault(): void
	{
		$this->articles = $this->articleFacade->getAll();
	}
	
	public function renderDefault(): void
	{
		$this->template->articles = $this->articles;
	}
}
