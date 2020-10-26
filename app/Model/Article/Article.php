<?php

declare(strict_types=1);

namespace App\Model\Article;

use Nette\Utils\DateTime;
use Parsedown;

class Article
{
	private string $slug;
	private string $title;
	private string $author;
	private string $content;
	private DateTime $createdAt;
	private DateTime $updatedAt;
	
	public function __construct(ArticleData $data)
	{
		$this->slug = $data->slug;
		$this->createdAt = $data->createdAt;
		$this->edit($data);
	}
	
	public function edit(ArticleData $data) 
	{
		$this->title = $data->title;
		$this->author = $data->author;
		$this->content = $data->content;
		$this->updatedAt = $data->updatedAt;
	}
	
	public function getData(): ArticleData
	{
		$data = new ArticleData();
		$data->title = $this->title;
		$data->author = $this->author;
		$data->content = $this->content;
		
		return $data;
	}

	public function getSlug(): string
	{
		return $this->slug;
	}

	public function getTitle(): string
	{
		return $this->title;
	}

	public function getAuthor(): string
	{
		return $this->author;
	}

	public function getContent(): string
	{
		return (new Parsedown())->parse($this->content);
	}

	public function getCreatedAt(): DateTime
	{
		return $this->createdAt;
	}

	public function getUpdatedAt(): DateTime
	{
		return $this->updatedAt;
	}
}
