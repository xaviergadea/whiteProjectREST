<?php

/**
 * IndexController.php is the default controller for users module
 *
 * This module implement acl and auth.
 *
 * @author     Agustín Calderón <agustincl@gmail.com>
 * @copyright  Copyright 2009 White-Project. All Rights Reserved.
 * @license    http://creativecommons.org/licenses/by-nc-nd/3.0/es/  CC-NC-ND
 * @category   White-Project
 * @package    Users
 * @subpackage file
 * @version    SVN $Id: IndexController.php 1145 2010-05-19 23:31:01Z agustincl $
 *
 */

/**
 * Users_IndexController
 *
 * @category   White-Project
 * @uses       Zend_Controller_Action
 * @package    Users
 * @subpackage Controller
 *
 */
class Users_IndexController extends Zend_Controller_Action 
{

    /**
     * Initialize controller
     *
     * Set backend layout.
     * Get URI to use in navigation breadcrumb.
     *
     * @return void
     */
	public function init()
    {       
        $this->_helper->layout->setLayout('layout_backend');			// Change layout
        $uri="/".$this->_getParam('module')."/".$this->_getParam('controller')."/".$this->_getParam('action');
        $activeNav = $this->view->navigation()->findByUri($uri);
		$activeNav->active=true;
    }

    /**
     * Index users front.
     *
     * Show the users and insert, update, delete controls.
     *
     * @return      void
     */
    public function indexAction() 
    {
    	$this->view->title = "List users";
        $model = new Users_Model_Users();
		$this->view->entries = $model->fetchSql();
    }
    
   /**
     * Add user.
     *
     * @return      void
     */
    public function addAction()
    {
    	$this->view->headTitle("Add New Client", 'APPEND');
        $request = $this->getRequest();
    	$form    = new Users_Form_Users();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Users_Model_Users();
                $vals=$request->getPost();
                $email = $vals['email'];
                if ($model->fetchEntryEmailCount($email)==0) {
                	$model->save($form->getValues());
                	return $this->_helper->redirector('index');
                }
                else{
                	$this->renderScript('/error/error_emailfail.phtml');
                }
            }
        }
    	else {
			$form->populate($form->getValues());
		}

        $this->view->form = $form;
    }

    /**
     * Edit user.
     *
     * @return      void
     */
	public function editAction()
    {
    	$this->view->headTitle("Edit Users", 'APPEND');
        $request = $this->getRequest();
    	$form    = new Users_Form_Users(array('isEdit'=>1));
    	$form->submit->setLabel('Save');
   	
    	$form->editUser();
        
    	if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Users_Model_Users();
                $id = $this->_getParam('uid', 0);
                $model->update($form->getValues(),'uid = '. (int)$id);
                return $this->_helper->redirector('index');
            }
        	else {
				$form->populate($request->getPost());
			}
        }
    	else {
			$id = $this->_getParam('uid', 0);
			if ($id > 0) {
				$model = new Users_Model_Users();
				$form->populate($model->fetchEntry($id));
			}
		}
        $this->view->form = $form;
    }

    /**
     * Edit user password.
     *
     * @return      void
     */
	public function editpasswordAction()
    {
    	$this->view->headTitle("Edit User's Password", 'APPEND');
        $request = $this->getRequest();
    	$form    = new Users_Form_Users(array('isEdit'=>1));
    	$form->submit->setLabel('Save');
   	
    	$form->editPassword();
        
    	if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Users_Model_Users();
                $id = $this->_getParam('uid', 0);
                                
                $model->update($form->getValues(),'uid = '. (int)$id);
                return $this->_helper->redirector('index');
            }
        	else {
				$form->populate($request->getPost());
			}
        }
    	else {
			$id = $this->_getParam('uid', 0);
			if ($id > 0) {
				$model = new Users_Model_Users();
				$form->populate($model->fetchEntry($id));
			}
		}
        $this->view->form = $form;
    }

    /**
     * Delete user.
     *
     * @return      void
     */
	public function deleteAction()
    {
    	$this->view->headTitle("Delete Client", 'APPEND');
        $request = $this->getRequest();

        if ($this->getRequest()->isPost()) {
        	$del = $request->getPost('del');
        	if ($del == $this->view->translate("Yes")) {
				$id = $this->_getParam('uid', 0);
				$model = new Users_Model_Users();
				$model->delete('uid = '. (int)$id);
			}
			return $this->_helper->redirector('index');
        }
   		else {
			$id = $this->_getParam('uid', 0);
			if ($id > 0) {
				$model = new Users_Model_Users();
				$this->view->entry = $model->fetchEntry($id);
			}
		}
    }    
}