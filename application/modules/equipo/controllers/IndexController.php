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
class Equipo_IndexController extends Zend_Controller_Action
{

     /**
     * Initialize controller
     *
     * Set backend layout.
     * Get URI to use in navigation breadcrumb.
     *
     * @return void
     */
	protected $_destination;
	
	public function init()
    {   
        $this->_helper->layout->setLayout('layout_backend');			// Change layout
        $uri="/".$this->_getParam('module')."/".$this->_getParam('controller')."/".$this->_getParam('action');
        $activeNav = $this->view->navigation()->findByUri($uri);
		$activeNav->active=true;
		
		$this->_equipo = Zend_Registry::get('equipo_config');	
    	$this->_destination=$this->_equipo->images->path;
    	$this->_baseurl=$this->_equipo->images->baseurl;
		
		$this->SesOrk = new Zend_Session_Namespace('SesJdvdp');
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
        $this->view->title = "Equipo";			
        $model = new Equipo_Model_Equipo();
        $this->view->entries = $model->fetchEntries();       
    }
    
    /**
     * Add project.
     *
     * @return      void
     */
    public function addAction()
    {
    	$this->view->headTitle("Add New Equipo", 'APPEND');
        $request = $this->getRequest();
    	$form    = new Equipo_Form_Equipo();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Equipo_Model_Equipo();
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
     * Edit module.
     *
     * @return      void
     */
	public function editAction()
    {
    	$this->view->headTitle("Edit Equipo", 'APPEND');
        $request = $this->getRequest();
    	$form    = new Equipo_Form_Equipo(array('isEdit'=>1));
    	$form->submit->setLabel('Save');
   	
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Equipo_Model_Equipo();
                $id = $this->_getParam('equipo_id', 0);
                
                // Handle Upload File Update 
                $row = $model->fetchEntry((int)$id);
                $last_image=$row['photo'];
                
                if ($form->photo->getValue()!='') {				 
                	unlink($this->_destination.'/'.$last_image);
            		if (!$form->photo->receive()) {
				        print "Upload error";
				    }
				    $value=preg_replace('/[^0-9a-zа-яіїё\`\~\!\@\#\$\%\^\*\(\)\; \,\.\'\/\_\-]/i', ' ',$form->photo->getValue());
				    $form->photo->setValue($value);                                    
				}
				else {					
					unset ($form->photo);					
				} 
				
                $model->update($form->getValues(),'id = '. (int)$id);
                return $this->_helper->redirector('index');
            }
        	else {
				$form->populate($request->getPost());
			}
        }
    	else {
			$id = $this->_getParam('equipo_id', 0);
			if ($id > 0) {
				$model = new Equipo_Model_Equipo();
				$data=$model->fetchEntry($id);
				$form->populate($data);
				$form->photo_tag->setImage($this->_baseurl.'/'.$data['photo']);
			}
				$row = $model->fetchEntry((int)$id);
                $last_image=$row['photo'];
		}
		if($last_image)
        	$thumb=$this->view->baseUrl($this->_baseurl.'/'.$last_image);
        else {            	
           	$thumb=$this->view->baseUrl($this->view->notImage());
        } 
        
        $form->photo_tag->setImage($thumb);
        $this->view->form = $form;
    }

     /**
     * Delete module.
     *
     * @return      void
     */
	public function deleteAction()
    {
    	$this->view->headTitle("Delete Equipo", 'APPEND');
        $request = $this->getRequest();
        
        if ($this->getRequest()->isPost()) {
        	$del = $request->getPost('del');
        	if ($del == 'Si') {
				$id = $this->_getParam('equipo_id', 0);
				$model = new Users_Model_Modules();
				$model->delete('module_id = '. (int)$id);
			}
			return $this->_helper->redirector('index');
        }
   		else {
			$id = $this->_getParam('equipo_id', 0);
			if ($id > 0) {
				$model = new Users_Model_Modules();
				$this->view->entry = $model->fetchEntry($id);
			}
		}
    }  
}