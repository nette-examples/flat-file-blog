<?php

declare(strict_types=1);

namespace App\Module\Admin\Article\Form;

use App\Model\Article\Article;
use App\UI\Form\Renderer\BootstrapRenderer;
use Nette\Application\UI\Form;

class ArticleFormFactory
{
	public function create(?Article $article): Form
	{
		$form = new Form();
		
		$form->addText('title', 'Title')
			->setRequired();
		
		$form->addTextArea('content', 'Content')
			->setRequired();

		$form->addText('author', 'Author')
			->setRequired();
		
		if ($article !== null) {
			$form->addSubmit('submit', 'Save');
			$form->setDefaults($article->getData());
			
		} else {
			$form->addSubmit('submit', 'Create');
		}
		
		$form->setRenderer(new BootstrapRenderer());
		
		return $form;
	}
}
