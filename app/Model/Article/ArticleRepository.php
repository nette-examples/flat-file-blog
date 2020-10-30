<?php

declare(strict_types=1);

namespace App\Model\Article;

use App\Model\Article\Exception\ArticleNotFoundException;
use Nette\Utils\Finder;
use SplFileInfo;

class ArticleRepository
{
	public function __construct(
		protected ArticleDataFactory $articleDataFactory
	) {}

	/**
	 * @throws ArticleNotFoundException
	 */
	public function get(string $slug): Article
	{
		$path = __DIR__ . '/../../../storage/articles/' . $slug . '.md';
		
		if (!file_exists($path)) {
			throw new ArticleNotFoundException();
		}
		
		return new Article($this->articleDataFactory->createFromFile(new SplFileInfo($path)));
	}

	/**
	 * @return Article[]
	 */
	public function getAll(): array
	{
		$articles = [];
		
		/** @var SplFileInfo $file */
		foreach (Finder::findFiles('*.md')->from(__DIR__ . '/../../../storage/articles') as $file) {
			$articles[] = new Article($this->articleDataFactory->createFromFile($file));
		}
		
		return $articles;
	}

	/**
	 * @return Article[]
	 */
	public function getSearchResults(string $query): array
	{
		$articles = [];

		foreach ($this->getAll() as $article) {
			$match = similar_text($lowerQuery = strtolower($query), $lowerTitle = strtolower($article->getTitle()));
			if (str_contains($lowerTitle, $lowerQuery) || $match >= 3.5) {
				$articles[] = $article;
			}
		}
		
		return $articles;
	}

	public function getAllSlugs(): array
	{
		$slugs = [];

		/** @var SplFileInfo $file */
		foreach (Finder::findFiles('*.md')->from(__DIR__ . '/../../../storage/articles') as $file) {
			$slugs[] = $file->getBasename('.md');
		}

		return $slugs;
	}
}
