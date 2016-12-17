<?php

class FaqController extends Zend_Controller_Action
{
    public function init(){}

    public function indexAction()
    {
        $info = array();
        $this->view->info = $info;
    }
}







