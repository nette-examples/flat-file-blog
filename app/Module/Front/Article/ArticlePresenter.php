<?php

declare(strict_types=1);

namespace App\Module\Front\Article;

use App\Model\Article\Article;
use App\Model\Article\ArticleFacade;
use App\Model\Article\Exception\ArticleNotFoundException;
use App\Module\Front\BaseFrontPresenter;

/**
 * @property ArticleTemplate $template
 */
class ArticlePresenter extends BaseFrontPresenter
{
	private Article $article;
	
	public function __construct(
		private ArticleFacade $articleFacade
	) {
		parent::__construct();
	}
	
	public function actionDefault(string $slug): void
	{
		try {
			$this->article = $this->articleFacade->get($slug);
		} catch (ArticleNotFoundException) {
			$this->error('Article not found', 404);
		}
	}
	
	public function renderDefault(string $slug): void
	{
		$this->template->article = $this->article;
	}
}
