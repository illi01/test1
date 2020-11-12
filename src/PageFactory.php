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
                $articleId = $article->create($_POST['article-name'], $_POST['article-text'], $_POST['article-author']);
                $page = new ArticlePage($articleId);
                $page->newArticle(true);
                break;
            case 'add-comment':
                $article = new Article($_POST['article-id']);
                $article->addComment($_POST['comment-text'], $_POST['comment-author'], $_POST['comment-email']);
                $page = new ArticlePage($_POST['article-id']);
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