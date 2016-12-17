<?php

class ContactsController extends Zend_Controller_Action
{
    public function init(){}

    public function indexAction()
    {
        $info = array();
        $this->view->info = $info;
    }
}







