<?php

class IndexController extends Zend_Controller_Action
{
    public function init(){}

    public function indexAction()
    {
        $num = 9;
        $page = $this->_getParam('page');

        $result = new Model_DbTable_News();
        if($this->_getParam('row'))
        {
            $row = $this->_getParam('row');
            $type = $this->_getParam('type');

            $result = $result-> getSortData($row,$type);
        } else {
            $result = $result->getData();
        }
        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($result));
        $paginator->setItemCountPerPage($num);
        $paginator->setCurrentPageNumber($page);
        $paginator->setView($this->view);
        $this->view->paginator = $paginator;
    }

    public function showAction()
    {
        $id = $this->_getParam('id', 0);
        if ($id > 0) {
            $result = new Model_DbTable_News();
            $result = $result->getInfoByid($id);

            $this->view->paginator = $result;
        }
    }
}







