<?php

declare(strict_types=1);

namespace App\Model\Article;

use Nette\Utils\DateTime;

class ArticleData
{
	public string $slug;
	public string $title;
	public string $author;
	public string $content;
	public DateTime $createdAt;
	public DateTime $updatedAt;
}
