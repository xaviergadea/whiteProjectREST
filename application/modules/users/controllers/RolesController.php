<?php

/**
 * RolesController.php is the roles controller
 *
 * This module implement acl and auth.
 *
 * @author     Agustín Calderón <agustincl@gmail.com>
 * @copyright  Copyright 2009 White-Project. All Rights Reserved.
 * @license    http://creativecommons.org/licenses/by-nc-nd/3.0/es/  CC-NC-ND
 * @category   White-Project
 * @package    Users
 * @subpackage file
 * @version    SVN $Id:$
 *
 */

/**
 * Users_RolesController
 *
 * @category   White-Project
 * @uses       Zend_Controller_Action
 * @package    Users
 * @subpackage Controller
 *
 */
class Users_RolesController extends Zend_Controller_Action
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
     * Roles modules front.
     *
     * Show the roles and insert, update, delete controls.
     *
     * @return void
     */
    public function indexAction()
    {
        $this->view->title = "Roles";			
        $model = new Users_Model_Roles();
        $this->view->entries = $model->fetchEntries();       
    }
    
   /**
     * Add role.
     *
     * @return void
     */
    public function addAction()
    {
    	$this->view->headTitle("Add New Role", 'APPEND');
        $request = $this->getRequest();
    	$form    = new Users_Form_Roles();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Users_Model_Roles();
                $model->save($form->getValues());
                return $this->_helper->redirector('index');
            }
        }
    	else {
			$form->populate($form->getValues());
		}
        $this->view->form = $form;
    }

    /**
     * Edit role.
     *
     * @return      void
     */
	public function editAction()
    {
    	$this->view->headTitle("Edit Role", 'APPEND');
        $request = $this->getRequest();
    	$form    = new Users_Form_Roles(array('isEdit'=>1));
    	$form->submit->setLabel('Save');
   	
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Users_Model_Roles();
                $id = $this->_getParam('role_id', 0);
                $model->update($form->getValues(),'role_id = '. (int)$id);
                return $this->_helper->redirector('index');
            }
        	else {
				$form->populate($request->getPost());
			}
        }
    	else {
			$id = $this->_getParam('role_id', 0);
			if ($id > 0) {
				$model = new Users_Model_Roles();
				$form->populate($model->fetchEntry($id));
			}
		}
        $this->view->form = $form;
    }

    /**
     * Delete role.
     *
     * @return      void
     */
	public function deleteAction()
    {
    	$this->view->headTitle("Delete Role", 'APPEND');
        $request = $this->getRequest();
        
        if ($this->getRequest()->isPost()) {
        	$del = $request->getPost('del');
        	if ($del == 'Si') {
				$id = $this->_getParam('role_id', 0);
				$model = new Users_Model_Roles();
				$model->delete('role_id = '. (int)$id);
			}
			return $this->_helper->redirector('index');
        }
   		else {
			$id = $this->_getParam('role_id', 0);
			if ($id > 0) {
				$model = new Users_Model_Roles();
				$this->view->entry = $model->fetchEntry($id);
			}
		}
    }    
}