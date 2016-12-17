<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initAutoLoad()
    {
        $moduleLoader = new Zend_Application_Module_Autoloader(array(
            'namespace' =>'',
            'basePath' => APPLICATION_PATH));
        $autoloader = Zend_Loader_Autoloader::getInstance();
        Zend_Session::start();
        $autoloader->registerNamespace(array('lib_'));
        return $moduleLoader;
    }

    protected function _initViewHelpers()
    {
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();

        //$view->headMeta()->appendHttpEquiv('Content-Type','text/html;charset-utf-8');
        //$view->headTitle('T-format Відеозйомка');
        //$view->headTitle()->setSeparator('::');

        if(!Zend_Auth::getInstance()->hasIdentity())
        {
            $view->identity = false;
        }
        else{
            $view->identity = Zend_Auth::getInstance()->getIdentity();
        }
    }

    protected function _initAcl()
    {
        $acl = new Zend_Acl();

        $acl->addRole(new Zend_Acl_Role('guest'));
        $acl->addRole(new Zend_Acl_Role('admin'));
        $acl->deny();
        $acl->allow('admin',null);

        $acl->add(new Zend_Acl_Resource('index'));
        $acl->add(new Zend_Acl_Resource('auth'));
        $acl->add(new Zend_Acl_Resource('table'));
        $acl->add(new Zend_Acl_Resource('users'));
        $acl->add(new Zend_Acl_Resource('videos'));
        $acl->add(new Zend_Acl_Resource('ourjob'));

        $acl->add(new Zend_Acl_Resource('manageadmin'));
        $acl->add(new Zend_Acl_Resource('managenews'));
        $acl->add(new Zend_Acl_Resource('managevideos'));
        $acl->add(new Zend_Acl_Resource('manageourjob'));

        $acl->add(new Zend_Acl_Resource('contacts'));
        $acl->add(new Zend_Acl_Resource('faq'));

        $acl->allow('guest','index', array(
            'index','show'
        ));

        $acl->allow('guest','users', array(
            'index','simple-ajax', 'get-ajax-data', 'get-ajax-data-json'
        ));

        $acl->allow('guest','auth', array(
            'login','logout'
        ));

        $acl->allow('guest','table', array(
            'index'
        ));

        $acl->allow('guest','videos', array(
            'index', 'show'
        ));

        $acl->allow('guest','contacts', array(
            'index'
        ));
        $acl->allow('guest','faq', array(
            'index'
        ));

        $acl->allow('guest','ourjob', array(
            'index', 'show'
        ));
        Zend_Registry::set('acl',$acl);

    }

    protected function _initPlugins()
    {
        $front = Zend_Controller_Front::getInstance();
        $front ->registerPlugin(new Plugin_Acl());
    }

    protected function _initRequest()
    {
        $request = new Zend_Controller_Request_Http();
        $view = $this->bootstrap("view")->getResource("view");
        $view->baseUrl = $request->getBaseUrl();
        $view->basePath = $request->getBasePath();
        return $request;
    }
}

