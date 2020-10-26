<?php

declare(strict_types=1);

namespace App\Module\Front\Article;

use App\Model\Article\Article;
use App\Module\Front\BaseFrontTemplate;

class ArticleTemplate extends BaseFrontTemplate
{
	public Article $article;
}
