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
        $a = new Article();
        $data = '';
        //todo
        $this->pageHtml = str_replace('{articles}', $data, $this->pageHtml);
    }
}