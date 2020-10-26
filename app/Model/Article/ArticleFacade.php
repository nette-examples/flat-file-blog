<?php

declare(strict_types=1);

namespace App\Model\Article;

use App\Model\Article\Exception\ArticleNotFoundException;
use Nette\Neon\Neon;
use Nette\Utils\FileSystem;

class ArticleFacade extends ArticleRepository
{
	public function create(ArticleData $data): Article
	{
		$article = new Article($data);
		
		$this->save($article);
		
		return $article;
	}

	/**
	 * @throws ArticleNotFoundException
	 */
	public function edit(string $slug, ArticleData $data): void
	{
		$article = $this->get($slug);
		
		$article->edit($data);
		
		$this->save($article);
	}
	
	private function save(Article $article): void
	{
		FileSystem::write(__DIR__ . '/../../../storage/articles/' . $article->getSlug() . '.md', "```yaml\n" . Neon::encode([
			'title' => $article->getTitle(),
			'author' => $article->getAuthor(),
			'createdAt' => $article->getCreatedAt()->format('Y-m-d H:i:s')
			], Neon::BLOCK) . "```\n\n" . $article->getData()->content . "\n");
	}
	
	public function delete(string $slug): void
	{
		@unlink(__DIR__ . '/../../../storage/articles/' . $slug . '.md');
	}
}
