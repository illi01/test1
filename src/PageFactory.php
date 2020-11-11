<?php

class PageFactory
{
    private $action;
    public function __construct($action) {
        $this->action = $action;
    }

    public function createPageByAction()
    {
        switch ($this->action) {
            case 'create-article':
                $page = new ArticleFormPage();
                break;
            case 'add-article':
                $article = new Article();
                $articleId = $article->create();
                $page = new ArticlePage($articleId);
                $page->newArticle(true);
                break;
            case 'add-comment':
                $article = new Article($_GET['articleId']);
                $article->addComment();
                $page = new ArticlePage($_GET['articleId']);
                $page->newComment(true);
                break;
            case 'article':
                $page = new ArticlePage($_GET['articleId']);
                break;
            default:
                $page = new IndexPage();
        }
        return $page;
    }


}