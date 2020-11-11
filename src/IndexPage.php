<?php

class IndexPage extends Page
{
    public function addpageContent()
    {
        $this->pageHtml .= file_get_contents(DIR_TEMPLATES.'index.html');
    }
}