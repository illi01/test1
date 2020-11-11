<?php

class Env
{
    private $action;

    public function __construct($action)
    {
        $this->action = $action;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function createWebPage()
    {
        $pf = new PageFactory($this->action);
        $page = $pf->createPageByAction();
        $outputter = new Outputter();

        return $outputter->build($page);
    }
}