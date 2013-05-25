<?php

/**
 * IndexController.php is the default controller for admin module
 *
 * This module is required. Is the admin default module of
 * backend. Is used for very simple administration tasks.
 *
 * @author     Agustín Calderón <agustincl@gmail.com>
 * @copyright  Copyright 2009 White-Project. All Rights Reserved.
 * @license    http://creativecommons.org/licenses/by-nc-nd/3.0/es/  CC-NC-ND
 * @category   White-Project
 * @package    Admin
 * @subpackage file
 * @version    SVN $Id: IndexController.php 1145 2010-05-19 23:31:01Z agustincl $
 *
 */

/**
 * Admin_IndexController
 *
 * @category   White-Project
 * @uses       Zend_Controller_Action
 * @package    Admin
 * @subpackage Controller
 * 
 */
class Admin_IndexController extends Zend_Controller_Action
{
    
    /**
     * Initialize controller
     * 
     * Set backend layout.
     * Get URI to use in navigation breadcrumb.
     * Read menu from config file and send to navigation object.
     *
     * @return void
     */
    public function init()
    {
    	$this->_helper->layout->setLayout('layout_backend');			// Change layout
		$uri = $this->_request->getPathInfo();
		$activeNav = $this->view->navigation()->findByUri($uri);
		$activeNav->active=true;
    }

    /**
     * Index admin front. Welcome layout.
     *
     * @return      void
     */
    public function indexAction()
    {
//		$model = new Admin_Model_Templates();
    	$this->view->title = $this->view->translate("Index");
        $this->view->dojo()->enable();
//		include_once 'Zend/Version.php';
		if (class_exists('Zend_Version', false)) {
			$version = Zend_Version::VERSION;
			$enable = true;
		}
        $model = new Admin_Model_Checks();
					
		$info=array('php_version'=>PHP_VERSION,
					'zend_version'=>Zend_Version::VERSION,
                    'apache_version'=>$_SERVER['SERVER_SOFTWARE'],
                    'application_env'=>$_SERVER['APPLICATION_ENV'],
                    'document_root'=>$_SERVER['DOCUMENT_ROOT'],
                    'magic_quotes'=>get_magic_quotes_runtime(),
                    'mb_string'=>function_exists('mb_substr'),
                    'sql_strict_mode'=>$model->checkStrictMode(),
                    'sql_server_version'=>$model->getDbServerVersion(),
					'zend_enable'=>true,
					'account'=>$this->getRequest()->getParam('account')				
						);

		$this->view->php=$info;
       Zend_Debug::dump($_SERVER, $label="Server variables", $echo=false);
    }
	
	/**
     * Index admin front. Welcome layout.
     *
     * @return      void
     */
    public function datadumpAction()
    {
		$this->view->headTitle($this->view->translate("Data Dump"), 'APPEND');
		$model = new Admin_Model_Data;
		$model->allstructure();	
    }
    
    public function  permissionsdumpAction()
    {
    	$this->view->headTitle($this->view->translate("Permissions Tables Dump"), 'APPEND');
		$model = new Admin_Model_Data;
		$model->permissionsstructure();		
    }
    
	public function  restorepermissionsdumpAction()
    {	
    	$this->view->headTitle($this->view->translate("Permissions Tables Restore"), 'APPEND');
		$model = new Admin_Model_Data;
		$model->permissionsrestore();		
    }
       
	public function dumpAction()
    {
    	$this->view->title = $this->view->translate("Dump"); 		
    }
    
	public function croncancelhotelsbooksAction()
    {
    	$this->view->headTitle($this->view->translate("CRON Cancel Hotels Books"), 'APPEND');
    	// conectar a la base de datos.
        $model = new Iturismo_Model_Admin();
        $model->save($form->getValues());              
	   
    	// actualizar tabla temporla		
    }
    
    
    /**
     * List all resources.
     *
     * @return      void
     */
    public function listresourcesAction()
    { 
		$this->view->title = $this->view->translate("List Resources");
		$acl = Users_Model_Acl::getInstance(); 					
		$this->view->list=$acl->listResourceByUser();
    }

    /**
     * Check configuration values.
     *
     * @return      void
     * @todo        Automatize reading config file from currents modules
     */
    public function checkconfigAction()
    {
        $this->view->title = $this->view->translate("Check Config");
		$out=array();
        $model = new Admin_Model_Checks();
					
		$info=array('php_version'=>PHP_VERSION,
					'zend_version'=>Zend_Version::VERSION,
                    'apache_version'=>$_SERVER['SERVER_SOFTWARE'],
                    'application_env'=>$_SERVER['APPLICATION_ENV'],
                    'document_root'=>$_SERVER['DOCUMENT_ROOT'],
                    'magic_quotes'=>get_magic_quotes_runtime(),
                    'mb_string'=>function_exists('mb_substr'),
                    'sql_strict_mode'=>$model->checkStrictMode(),
                    'sql_server_version'=>$model->getDbServerVersion(),
					'zend_enable'=>true,
					'account'=>$this->getRequest()->getParam('account')				
						);

		$this->view->php=$info;
		
		
		
        
		$out['SQL StrictMode']=$model->checkStrictMode();	
		$this->view->out=$info;
    }
}