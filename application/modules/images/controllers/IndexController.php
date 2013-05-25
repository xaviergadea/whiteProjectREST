<?php

/**
 * IndexController.php is the projects controller
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
 * Projects_IndexController
 *
 * @category   White-Project
 * @uses       Zend_Controller_Action
 * @package    Users
 * @subpackage Controller
 *
 */
class Images_IndexController extends Zend_Controller_Action
{

     /**
     * Initialize controller
     *
     * Set backend layout.
     * Get URI to use in navigation breadcrumb.
     *
     * @return void
     */
	
	private $_model = "Publications_Model_Publications";
	private $_form = "Projects_Form_Projects";
	
	public function init()
    {   
    	$this->_helper->layout->setLayout('layout_backend');			// Change layout
        $uri="/".$this->_getParam('module')."/".$this->_getParam('controller')."/".$this->_getParam('action');
        $activeNav = $this->view->navigation()->findByUri($uri);
		$activeNav->active=true;
    }	

   /**
     * Index projects front.
     *
     * Show the projects and insert, update, delete controls.
     *
     * @return      void
     */
    public function indexAction()
    {
    	$this->view->title = "Images";			
        $model = new $this->_model();
        
        $images= Zend_Registry::get('images_config');
    	
        $destination=realpath($images->files->path);
    	
	    $this->view->dir=$destination;
	    $this->view->name="All Images";
	    
		
		
    		
//        $model = new $this->_model();
//        $this->view->entries = $model->fetchEntries();       
    }
    
    
    
    /**
     * Add project.
     *
     * @return      void
     */
    public function addAction()
    {
    	$this->view->dojo()->enable();
    	$this->view->headTitle("Add New Publication", 'APPEND');
        $request = $this->getRequest();
    	$form    = new $this->_form();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
            	$all_form_details = array();
			    foreach ($form->getSubForms() as $subform) {
			    	$all_form_details = array_merge($all_form_details, $subform->getValues());
			    }  
                $model = new $this->_model();
//                $model->save($form->getValues());
				$model->save($all_form_details);
                return $this->_helper->redirector('index');
            }
        }
    	else {
            $form->populate($form->getValues());
	}
        $this->view->form = $form;
        
   
    }

    /**
     * Edit project.
     *
     * @return      void
     */
	public function editAction()
    {    	
    	
    	
    	
    	$this->view->dojo()->enable();
    	$this->view->headTitle("Edit Publication", 'APPEND');
        $request = $this->getRequest();
    	$form    = new $this->_form(array('isEdit'=>1));    	
    	$form->submit->setLabel('Save');
    	
        if ($this->getRequest()->isPost()) {
        	if ($form->isValid($request->getPost())) {        		
        		$all_form_details = array();
			    foreach ($form->getSubForms() as $subform) {
			    	$all_form_details = array_merge($all_form_details, $subform->getValues());
			    }        		
        		$model = new $this->_model();
                $id = $this->_getParam('id', 0);                                
                //$model->update($form->getValues(),'id = '. (int)$id);
                $model->update($all_form_details,'id = '. (int)$id);
                return $this->_helper->redirector('index');
            }
        	else {
				$form->populate($request->getPost());
			}
        }
    	else {
			$id = $this->_getParam('project_id', 0);
			if ($id > 0) {
				$model = new $this->_model();
				$form->populate($model->fetchEntry($id));				
			}
		}
		
	
        $this->view->form = $form;
		

    }

     /**
     * Delete project.
     *
     * @return      void
     */
	public function deleteAction()
    {
    	$this->view->headTitle("Delete Publication", 'APPEND');
        $request = $this->getRequest();
        
        if ($this->getRequest()->isPost()) {
        	$del = $request->getPost('del');
        	if ($del == 'Si') {
				$id = $this->_getParam('id', 0);
				$model = new $this->_model();
				$model->delete('id = '. (int)$id);
			}
			return $this->_helper->redirector('index');
        }
   		else {
			$id = $this->_getParam('project_id', 0);
			if ($id > 0) {
				$model = new $this->_model();
				$this->view->entry = $model->fetchEntry($id);
			}
		}
    } 

	public function toggleAction()
    {
    	$this->_helper->viewRenderer->setNoRender(true); 

    	
        if ($this->getRequest()->isGet()) {
			$id = $this->_getParam('project_id', 0);
			$togglevar = $this->_getParam('tooglevar', 0);			
			if ($id > 0 AND $togglevar!=null) {				                             
                $toggleval = $this->_getParam($togglevar, 0);               
                $newval = ($toggleval==1)?$toggleval=0:$toggleval=1;                
                $data=array('id'=>$id,$togglevar=>$toggleval);       
                $model = new $this->_model();  
                $model->update($data,'id = '. (int)$id);
                return $this->_helper->redirector('index');
			}
		}
        return $this->_helper->redirector('index');
    }
}