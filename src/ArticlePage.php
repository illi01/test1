<?php
class ArticlePage extends Page
{
    private $newArticle = false;
    private $newComment = false;
    private $article;


    public function __construct($articleId)
    {
        $this->article = new Article($articleId);
    }

    public function addpageContent()
    {
        if ($this->newArticle === true) $this->pageHtml .= '<script language="javascript"> alert("Your Article Was Succesfully Submitted") </script>';
        if ($this->newComment === true) $this->pageHtml .= '<script language="javascript"> alert("Your Comment Was Succesfully Submitted") </script>';
        $this->pageHtml .= file_get_contents(DIR_TEMPLATES.'article.html');
        $this->pasteInfo();
    }

    public function pasteInfo()
    {
        $this->pageHtml = str_replace('{article-name}', $this->article->getName(), $this->pageHtml);
        $this->pageHtml = str_replace('{article-author}', $this->article->getAuthor(), $this->pageHtml);
        $this->pageHtml = str_replace('{article-date}', $this->article->getDateCreated(), $this->pageHtml);
        $this->pageHtml = str_replace('{article-content}', $this->article->getText(), $this->pageHtml);
        $this->pageHtml = str_replace('{comments}', $this->printedComments(), $this->pageHtml);
        $this->pageHtml = str_replace('{articleId}', $this->article->getId(), $this->pageHtml);
    }

    public function printedComments()
    {
        $html = '';
        $comments = $this->article->getComments();
        if ($comments) {
            foreach ($comments as $comment) {
                $html .= $this->getCommentHtml($comment);
            }
        } else {
            $html = '<li>No comments yet</li>';
        }

        return $html;
    }

    public function getCommentHtml($comment)
    {
        $html = file_get_contents(DIR_TEMPLATES.'comment.html');
        $html = str_replace('{comment-author}', $comment->getAuthor(), $html);
        var_dump($comment->getAuthor());
        $html = str_replace('{comment-date}', $comment->getDateCreated(), $html);
        $html = str_replace('{comment-email}', $comment->getEmail(), $html);
        $html = str_replace('{comment-text}', $comment->getText(), $html);

        return $html;
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