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
class Projects_IndexController extends Zend_Controller_Action
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
        $this->view->title = "Projects";			
        $model = new Projects_Model_Projects();
        $this->view->entries = $model->fetchEntriesSql();       
    }
    
    /**
     * Add project.
     *
     * @return      void
     */
    public function addAction()
    {
    	$this->view->dojo()->enable();
    	$this->view->headTitle("Add New Project", 'APPEND');
        $request = $this->getRequest();
    	$form    = new Projects_Form_Projects(array('path'=>'22'));

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
            	$all_form_details = array();
			    foreach ($form->getSubForms() as $subform) {
			    	$all_form_details = array_merge($all_form_details, $subform->getValues());
			    }  
                $model = new Projects_Model_Projects();
//                $model->save($form->getValues());

                $all_form_details['short_name']=$model->cleanFileName($all_form_details['short_name']); 
				$model->save($all_form_details);
				//create directory
				//Zend_Debug::dump($all_form_details);
				$category=$model->getCategoryById($all_form_details['categories_id']);
				//Zend_Debug::dump($category);
				$dir=APPLICATION_PATH."/../public/assets/proyectos/".$category[$all_form_details['categories_id']]['category_short'].'/'.$all_form_details['short_name'];
				mkdir($dir, 0755);
                return $this->_helper->redirector('index');
            }
        }
    	else {
            $form->populate($form->getValues());
	}
//        $this->view->form = $form;
        
       	$formgen = $form->getSubForm('subformgen');
       	
		$formesp = $form->getSubForm('subformesp');
		$formcat = $form->getSubForm('subformcat');
		$formeng = $form->getSubForm('subformeng');
		$formsubmit = $form->getSubForm('subformsubmit');
    
        $this->view->formgen = $formgen;
        
        $this->view->formesp = $formesp;
        $this->view->formcat = $formcat;
        $this->view->formeng = $formeng;
        $this->view->formsubmit = $formsubmit;
    }
	
    
	
    public function addphotoformAction()
    {
    	// Disable Layout
    	//$this->_helper->viewRenderer->setNoRender(true);
    	$this->_helper->layout->disableLayout();

    	$project_id = $this->_getParam('project_id', 0);   
    	$this->view->dir=$project_id;
    	
    }
    
	public function addphotoformjarAction()
    {
    	// Disable Layout
    	//$this->_helper->viewRenderer->setNoRender(true);
    	$this->_helper->layout->disableLayout();

    	$project_id = $this->_getParam('project_id', 0);   
    	$this->view->dir=$project_id;
    	
    }
    
    /**
     * Edit project.
     *
     * @return      void
     */
	public function editAction()
    {    	
    	$this->view->dojo()->enable();
        $this->view->dojo()->addStyleSheet(DOJO_PATH.'/dojox/image/resources/Lightbox.css')
				            ->addStyleSheet(DOJO_PATH.'/dojox/layout/resources/FloatingPane.css')
				            ->requireModule('dijit.form.Form')
				            ->requireModule('dijit.dijit')
				            ->requireModule('dijit.layout.ContentPane')							
				            ->requireModule('dijit.layout.TabContainer')
				            ->requireModule('dijit.Dialog');    





//    	require_once (APPLICATION_PATH.'/modules/projects/models/Ajax.php');
//	    $model = new Project_Model_Ajax();
//	    $model->fetchResponse('post', '/scripts/data/text/text.txt','containerID');
	    
    	
    	$this->view->headTitle("Edit Project", 'APPEND');
        $request = $this->getRequest();
    	$form    = new Projects_Form_Projects();    	
    	$form->submit->setLabel('Save');
    	
    	$formgen = $form->getSubForm('subformgen');
    	$formgen->removeElement('short_name');
    	$formgen->removeElement('categories_id');
    	
    	$formgal = $form->getSubForm('subformgal');
    	
    	$form->setOptions(array('path'=>'sol'));
    	
        if ($this->getRequest()->isPost()) {
        	if ($form->isValid($request->getPost())) {       
        		$formgal->removeElement('images');
        		 		
        		$all_form_details = array();
			    foreach ($form->getSubForms() as $subform) {
			    	$all_form_details = array_merge($all_form_details, $subform->getValues());
			    }        		
        		$model = new Projects_Model_Projects();
        		
                $id = $this->_getParam('id', 0);                                
                //$model->update($form->getValues(),'id = '. (int)$id);
                $data=$model->fetchEntry($id);
                $images=explode(',',$data['images']);
                if($all_form_details['thumbnail']=='')$all_form_details['thumbnail']=$images[0]; 
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
				$model = new Projects_Model_Projects();
				$data=$model->getPathById($id);
				$form->populate($model->fetchEntry($id));
				$form->subformgal->images->setAttrib("id",$id);
				$form->subformgal->images->setAttrib("path",$data->short_name);
				$form->subformgal->images->setAttrib("type",$data->category_short);
								
			}
		}
		
		//$formgen = $form->getSubForm('subformgen');
		//$formgal = $form->getSubForm('subformgal');
		$formesp = $form->getSubForm('subformesp');
		$formcat = $form->getSubForm('subformcat');
		$formeng = $form->getSubForm('subformeng');
		$formsubmit = $form->getSubForm('subformsubmit');
       
		
    	
		
        $this->view->formgen = $formgen;
        $this->view->formgal = $formgal;
        $this->view->formesp = $formesp;
        $this->view->formcat = $formcat;
        $this->view->formeng = $formeng;
        $this->view->formsubmit = $formsubmit;
        $this->view->project_id = $id;
//        $this->view->form = $form;
		

    }

     /**
     * Delete project.
     *
     * @return      void
     */
	public function deleteAction()
    {
    	$this->view->headTitle("Delete Project", 'APPEND');
        $request = $this->getRequest();
        
        if ($this->getRequest()->isPost()) {
        	$del = $request->getPost('del');
        	if ($del == 'Si') {
				$id = $this->_getParam('id', 0);
				$model = new Projects_Model_Projects();
				$category=$model->getPathById($id);
				$dir=APPLICATION_PATH."/../public/assets/proyectos/".$category->category_short.'/'.$category->short_name;
				$model->delete('id = '. (int)$id);
				$model->rrmdir($dir);
			}
			return $this->_helper->redirector('index');
        }
   		else {
			$id = $this->_getParam('project_id', 0);
			if ($id > 0) {
				$model = new Projects_Model_Projects();
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
                $model = new Projects_Model_Projects();  
                $model->update($data,'id = '. (int)$id);
                return $this->_helper->redirector('index');
			}
		}
        return $this->_helper->redirector('index');
    }
}