<?php

class Outputter
{

    public function build(PageBuilder $builder)
    {
        $builder->addHeader();
        $builder->addPageContent();
        $builder->addFooter();

        return $builder->printPage();
    }
}