<?php

class ManageadminController extends Zend_Controller_Action
{

    public function init(){/* Initialize action controller here */}

    public function indexAction()
    {
        $info = array();
        $this->view->info = $info;
    }
}







