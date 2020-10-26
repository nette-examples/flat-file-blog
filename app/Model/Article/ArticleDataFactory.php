<?php

declare(strict_types=1);

namespace App\Model\Article;

use App\Module\Admin\Article\Form\Article\ArticleFormData;
use Nette\Neon\Neon;
use Nette\Utils\DateTime;
use Nette\Utils\FileSystem;
use Nette\Utils\Strings;
use SplFileInfo;

class ArticleDataFactory
{
	public function createFromFile(SplFileInfo $file): ArticleData
	{
		$fileContent = FileSystem::read($file->getPathname());

		preg_match('/```yaml(.*?)```/s', $fileContent, $match);
		$metaData = Neon::decode($match[1]);
		
		$data = new ArticleData();
		$data->slug = $file->getBasename('.md');
		$data->title = $metaData['title'];
		$data->author = $metaData['author'];
		$data->content = trim(str_replace($match[0], '', $fileContent));
		$data->createdAt = DateTime::from($metaData['createdAt']);
		$data->updatedAt = DateTime::from($file->getMTime());
		
		return $data;
	}
	
	public function createFromFormData(ArticleFormData $formData): ArticleData
	{
		$data = new ArticleData();
		
		$data->slug = Strings::webalize($formData->title);
		$data->title = $formData->title;
		$data->author = $formData->author;
		$data->content = $formData->content;
		$data->createdAt = new DateTime();
		$data->updatedAt = new DateTime();

		return $data;
	}
}
