<?php

class ManagevideosController extends Zend_Controller_Action
{

    public function init(){/* Initialize action controller here */}

    public function indexAction()
    {
        $num = 25;
        $page = $this->_getParam('page');

        $result = new Model_DbTable_Videos();
        if($this->_getParam('row'))
        {
            $row = $this->_getParam('row');
            $type = $this->_getParam('type');

            $result = $result-> getSortData($row,$type);
        } else
        {
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


    public function addAction(){
        $form = new Form_Videos();
        $form->submit->setLabel('Save');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData))
            {
                $title = $form->getValue('title');
                $href = $form->getValue('href');
                $img_title = $form->getValue('img_title');
                $pages = new Model_DbTable_Videos();
                $pages->addData( $title, $href, $img_title);

                $this->_helper->redirector('index','managevideos');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function editAction()
    {
        $form = new Form_Videos();
        $form->submit->setLabel('Save');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = (int)$this->_getParam('id');
                $title = $form->getValue('title');
                $href = $form->getValue('href');
                $img_title = $form->getValue('img_title');
                $data = new Model_DbTable_Videos();
                $data->updateData($id, $title , $href, $img_title);

                $this->_helper->redirector('index','managevideos');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);

            if ($id > 0) {
                $data = new Model_DbTable_Videos();
                $form->populate($data->getInfoByid($id));
                //var_dump($data->getInfoByid($id));exit;

            }
        }
    }

    public function deleteAction()
    {
        $id = $this->_getParam('id', 0);
        $data = new Model_DbTable_Videos();
        $data->deleteData($id);
        $this->_helper->redirector('index','managevideos');

    }
}







