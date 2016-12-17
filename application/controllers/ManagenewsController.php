<?php

class ManagenewsController extends Zend_Controller_Action
{

    public function init(){/* Initialize action controller here */}

    public function indexAction()
    {
        $num = 25;
        $page = $this->_getParam('page');

        $result = new Model_DbTable_News();
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
        $form = new Form_News();
        $form->submit->setLabel('Save');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData))
            {
                $title = $form->getValue('title');
                $text = $form->getValue('text');
                $short_desc = $form->getValue('short_desc');
                $img_name = $form->getValue('img_name');
                $pages = new Model_DbTable_News();
                $pages->addData( $title, $text, $short_desc, $img_name);

                $this->_helper->redirector('index','managenews');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function editAction()
    {
        $form = new Form_News();
        $form->submit->setLabel('Save');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = (int)$this->_getParam('id');
                $title = $form->getValue('title');
                $text = $form->getValue('text');
                $short_desc = $form->getValue('short_desc');

                $data = new Model_DbTable_News();
                $data->updateData($id, $title , $text);

                $this->_helper->redirector('index', 'managenews');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $data = new Model_DbTable_News();
                $form->populate($data->getInfoByid($id));
            }
        }
    }

    public function deleteAction()
    {
        $id = $this->_getParam('id', 0);
        $data = new Model_DbTable_News();
        $data->deleteData($id);
        $this->_helper->redirector('index','managenews');

    }
}







