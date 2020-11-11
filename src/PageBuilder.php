<?php

interface PageBuilder
{
    public function addHeader();

    public function addPageContent();

    public function addFooter();

    public function printPage();
}