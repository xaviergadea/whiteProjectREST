<?php

/**
 * CrontabsController.php is the controller for crontabs module
 *
 * @author     Agustín Calderón <agustincl@gmail.com>
 * @copyright  Copyright 2009 White-Project. All Rights Reserved.
 * @license    http://creativecommons.org/licenses/by-nc-nd/3.0/es/  CC-NC-ND
 * @category   White-Project
 * @package    whitelabel
 * @subpackage file
 * @version    SVN $Id: IndexController.php 624 2009-10-13 15:33:37Z agustincl $
 *
 */

/**
 * Admin_OptimizeController
 *
 * @category   White-Project
 * @uses       Zend_Controller_Action
 * @package    Whitelabel
 * @subpackage Controller
 *
 */
class Admin_OptimizeController extends Zend_Controller_Action 
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
     * Index whitelabel front.
     *
     * Show the labels and insert, update, delete controls.
     *
     * @return      void
     */
 	public function indexAction()
    {
        $this->view->title = "Optimize";			
     
    }
     
    public function dojoAction()
    {
    	$this->view->headTitle("Create Dojo Build Layer", 'APPEND');
        $build = new Zend_Dojo_BuildLayer(array(
			'view'      => $this->view,
			'layerName' => 'custom.main',
			));
			       
		$layerContents = $build->generateLayerScript();
		$filename      = APPLICATION_PATH . '/../public/scripts/js/custom/main.js';
		
		file_put_contents($filename, $layerContents);
	}

    
    
}