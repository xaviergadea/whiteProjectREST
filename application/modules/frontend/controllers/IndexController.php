<?php

/**
 * IndexController.php is the default controller for frontend module
 *
 * @author     Agustín Calderón <agustincl@gmail.com>
 * @copyright  Copyright 2009. All Rights Reserved.
 * @license    http://creativecommons.org/licenses/by-nc-nd/3.0/es/  CC-NC-ND
 * @category   backend
 * @package    Admin
 * @subpackage file
 *
 */

/**
 * Frontend_IndexController
 *
 * @category   backend
 * @uses       Zend_Controller_Action
 * @package    Frontend
 * @subpackage Controller
 *
 */
class Frontend_IndexController extends Zend_Controller_Action 
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
        $uri="/".$this->_getParam('module')."/".$this->_getParam('controller')."/".$this->_getParam('action');
        //$activeNav = $this->view->navigation()->findByUri($uri);
        //$activeNav->active=true;
    }

    /**
     * Index Default front.
     *
     * Show frontend index.
     *
     * @return void
     */
    public function indexAction()
    {
    	$this->view->title = "Index :: JDVDP";  
    	    
    }
        
	public function equipoAction()
    {
    	$this->view->title = "Equipo :: JDVDP";
    	$this->view->menu = "Equipo";
    	
    	$model = new Equipo_Model_Equipo();
    	$this->view->entries = $model->fetchSql(1);     
    	    
    }
    
	public function proyectosAction()
    {
    	$this->view->title = "Proyectos :: JDVDP";
    	$type=$this->_getParam('type',0);
    	$this->view->menu = "Proyectos";
    	$model = new Projects_Model_Projects();
    	$this->view->entries = $model->getProjectByType($type);     
    	$this->view->block = 'style="display: block !important;"';
    	$this->view->menu = $type;
    }
    
	public function detallesAction()
    {    	
    	$this->view->title = "Proyectos :: JDVDP";
    	$page=$this->_getParam('proyecto',0);
    	$model = new Projects_Model_Projects();
    	$data=array_values($model->fetchSql($page));
    	$this->view->block = 'style="display: block !important;"';
    	$this->view->menu = $data[0]['category_short'];
        $this->view->entries = $model->fetchSql($page);     
		
//        switch($_SESSION['default']['language']){
//        	case 'es':
//        		$this->renderScript ( 'index/detalles.phtml' );
//        	break;
//        	case 'ca':
//        		$this->renderScript ( 'index/detalles_cat.phtml' );
//        	break;
//        	case 'en':
//        		$this->renderScript ( 'index/detalles_eng.phtml' );
//        	break;
//        }
        //$this->renderScript ( 'detalles/detalles_'.$page.'.phtml' );    	    
    }
    
    public function publicacionesAction()
    {
    	$this->view->title = "Publicaciones :: JDVDP";
    	$this->view->menu = "Publicaciones";
    	    
    }
    
    public function premiosAction()
    {
    	$this->view->title = "Premios :: JDVDP"; 
    	$this->view->menu = "Premios"; 
    	$model = new Projects_Model_Projects();
    	$this->view->entries = $model->getProjectPrizes();  
    	    
    }
    
	public function searchAction()
    {
    	$this->view->title = "Busqueda :: JDVDP"; 
    	$this->view->menu = "Busquedas"; 
    	$model = new Projects_Model_Projects();
    	$this->view->entries = $model->getSearchResponse($this->view->escape($_POST['searchterm']));  
    	    
    }
    
	public function contactaAction()
    {
    	$this->view->title = "Contacta :: JDVDP"; 
    	$this->view->menu = "Contacta";
    	    
    }    
    
    
}