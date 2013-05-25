<?php

/**
 * AjaxController.php is the controller for ajax operations in projects module
 *
 * This module is required. Is the admin default module of
 * backend. Is used for very simple administration tasks.
 *
 * @author     Agustín Calderón <agustincl@gmail.com>
 * @copyright  Copyright 2010 jdvdp. All Rights Reserved.
 * @license    http://creativecommons.org/licenses/by-nc-nd/3.0/es/  CC-NC-ND
 * @category   jdvdp
 * @package    Admin
 * @subpackage file
 * @version    SVN $Id: AjaxController.php 553 2009-09-17 15:39:21Z agustincl $
 *
 */

class Projects_AjaxController extends Zend_Controller_Action
{
	
	public function init()
    {   
		// Disable Layout
    	$this->_helper->viewRenderer->setNoRender(true);
		$this->_helper->layout->disableLayout();   	
       
    }
    
	public function addphotoAction()
    {
    	// list of valid extensions, ex. array("jpeg", "xml", "bmp")
		$allowedExtensions = array('jpg', 'gif', 'png');
		// max file size in bytes
		$sizeLimit = 10 * 1024 * 1024;
		
		$project_id = $this->_getParam('project_id', 0);        
		//Zend_Debug::dump($project_id);
		$model = new Projects_Model_Projects();
		$data=$model->getPathById($project_id);
		//echo APPLICATION_PATH.'/../public/assets/proyectos/'.$data->category_short.'/'.$data->short_name;
		//die;
//		require_once APPLICATION_PATH.'/modules/projects/models/php.php';
//		$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
		
		$uploader = new Acl_Qqfileuploader($allowedExtensions, $sizeLimit);
		// upload directory		
		$result = $uploader->handleUpload(APPLICATION_PATH.'/../public/assets/proyectos/'.$data->category_short.'/'.$data->short_name.'/', true);
		if($result['success']=='1')$model->appendImage($_GET['qqfile'],$project_id);		
		// to pass data through iframe you will need to encode all html tags
		//print_r($_GET);
//		echo "<pre>";
//		print_r($result);
//		echo "</pre>";
		//die;
		echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);	
		return;							
    }
    
	public function deletephotoAction()
    {
    	if($this->_request->isXmlHttpRequest())
		{
    	$model = new Projects_Model_Projects();
    	$foto =  $this->_getParam('foto', 0);
    	$id =  $this->_getParam('id', 0);    	
    	$model->removeImage($foto, $id);
    	return;
		}
    }
    
	public function reloadgalleryAction()
    {
    	if($this->_request->isXmlHttpRequest())
		{
    		$id =  $this->_getParam('id', 0);    	
    		$model = new Projects_Model_Projects();
    		$data=$model->fetchEntry($id);
    		$path=$model->getPathById($id);
    		$this->view->entries=$data;
    		$this->view->type=$path->category_short;
    		$this->view->path=$path->short_name;
    		$this->view->id=$id;
    		
    		$this->renderScript('/ajax/reloadgallery.phtml');
    		  
    		return;
		}
    }
    
	public function addjarphotoAction()
    {
    	$project_id = $this->_getParam('id', 0);        
		//Zend_Debug::dump($project_id);
		$model = new Projects_Model_Projects();
		$data=$model->getPathById($project_id);
        	
	    $file_param_name = 'file';
		//	retrieve uploaded file name
		$file_name = $_FILES[ $file_param_name ][ 'name' ];
		$source_file_path = $_FILES[ $file_param_name ][ 'tmp_name' ];
		$target_file_path = APPLICATION_PATH.'/../public/assets/proyectos/'.$data->category_short.'/'.$data->short_name.'/' . $file_name;

		//	move uploaded file
		echo "Moving file " . $source_file_path . " > " . $target_file_path . ": ";
		if( move_uploaded_file( $source_file_path, $target_file_path ) ) {
			chmod($target_file_path, 0775);
			echo "success";
		} else{
			echo "failure";
		}		
		
		$model->appendImage($file_name,$project_id);
		return;
    }
    
	
    
 	
    
}