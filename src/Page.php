<?php

abstract class Page implements PageBuilder
{
    public $pageHtml = '';

    public function addHeader()
    {
        $this->pageHtml .= file_get_contents(DIR_TEMPLATES.'header.html');
    }

    public function addPageContent()
    {
    }

    public function addFooter()
    {
        $this->pageHtml .= file_get_contents(DIR_TEMPLATES.'footer.html');
    }

    public function printPage()
    {
        return $this->pageHtml;
    }
}