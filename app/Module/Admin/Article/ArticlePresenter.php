<?php

declare(strict_types=1);

namespace App\Module\Admin\Article;

use App\Model\Article\Article;
use App\Model\Article\ArticleDataFactory;
use App\Model\Article\ArticleFacade;
use App\Model\Article\Exception\ArticleNotFoundException;
use App\Module\Admin\Article\Form\Article\ArticleFormData;
use App\Module\Admin\Article\Form\Article\ArticleFormFactory;
use App\Module\Admin\BaseAdminPresenter;
use Nette\Application\UI\Form;

/**
 * @property ArticleTemplate $template
 */
class ArticlePresenter extends BaseAdminPresenter
{
	private array $articles;
	private ?Article $article = null;
	
	public function __construct(
		private ArticleFacade $articleFacade,
		private ArticleFormFactory $articleFormFactory,
		private ArticleDataFactory $articleDataFactory,
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

	/**
	 * @throws ArticleNotFoundException
	 */
	public function actionEdit(string $slug): void
	{
		$this->article = $this->articleFacade->get($slug);
	}
	
	public function renderEdit(string $slug): void
	{
		$this->template->article = $this->article;
	}
	
	public function createComponentArticleForm(): Form
	{
		$form = $this->articleFormFactory->create($this->article);
		
		$form->onSuccess[] = function (Form $form, ArticleFormData $formData): void {
			if ($this->article !== null) {
				$this->articleFacade->edit($this->article->getSlug(), $this->articleDataFactory->createFromFormData($formData));
				$this->flashMessage('Article was successfully updated', 'success');
			} else {
				$this->articleFacade->create($this->articleDataFactory->createFromFormData($formData));
				$this->flashMessage('Article was successfully created', 'success');
			}
			$this->redirect('this');
		};
		
		return $form;
	}
	
	public function handleDelete(string $slug): void
	{
		$this->articleFacade->delete($slug);
		$this->flashMessage('Article was successfully deleted', 'success');
		$this->redirect('this');
	}
}
