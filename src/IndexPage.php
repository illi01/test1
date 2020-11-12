<?php

class IndexPage extends Page
{
    public function addpageContent()
    {
        $this->pageHtml .= file_get_contents(DIR_TEMPLATES.'index.html');
        $this->addArticles();
    }

    public function addArticles()
    {
        $data = $this->getAllArticles();

        $this->pageHtml = str_replace('{articles}', $data, $this->pageHtml);
    }

    public function getAllArticles()
    {
        $html = '';
        $a = new Article();
        $data = $a->getAllArticles();
        foreach ($data as $article) {
            $html .= '<li><a href="index.php?action=article&articleId=' . $article->getId() . '">' . $article->getName() . '</a></li>';
        }
        return $html;
    }
}