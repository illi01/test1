<?php

class PageFactory
{
    private $action;
    public function __construct($action) {
        $this->action = $action;
    }

    public function createPageByAction()
    {
       /* switch ($this->action) {
            case 'create-article':
                $page = new ArticleFormPage();
            case 'add-article':
                $articleId = new Article()->create();
                $page = new ArticlePage($articleId);
                break;
            case 'add-comment':
                $articleId = new Article($_POST['articleId'])->addComment();
                $page = new ArticlePage($articleId)->newComment(true);
                break;
            case 'new-article':
                $articleId = new Article()->create();
                $page = new ArticlePage($articleId)->newArticle(true);
                break;
            case 'article':
                $page = new ArticlePage($_POST['articleId']);
                break;
            default:
                $page = new IndexPage();
        }
        return $page;*/
        return new IndexPage();
    }


}