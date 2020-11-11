<?php
class ArticlePage extends Page
{
    private $newArticle = false;
    private $newComment = false;
    private $articleId;

    public function __construct($articleId)
    {
        $this->articleId = $articleId;
    }

    public function addpageContent()
    {
        if ($this->newArticle === true) $this->pageHtml .= '<script language="javascript"> alert("Your Article Was Succesfully Submitted") </script>';
        if ($this->newComment === true) $this->pageHtml .= '<script language="javascript"> alert("Your Comment Was Succesfully Submitted") </script>';
        $this->pageHtml .= file_get_contents(DIR_TEMPLATES.'article.html');
    }

    public function newComment()
    {
        $this->newComment = true;
        return $this;
    }

    public function newArticle()
    {
        $this->newArticle = true;
        return $this;
    }


}