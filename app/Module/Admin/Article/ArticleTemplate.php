<?php

declare(strict_types=1);

namespace App\Module\Admin\Article;

use App\Model\Article\Article;
use App\Module\Admin\BaseAdminTemplate;

class ArticleTemplate extends BaseAdminTemplate
{
	/** @var Article[] */
	public array $articles;
	public ?Article $article;
}
