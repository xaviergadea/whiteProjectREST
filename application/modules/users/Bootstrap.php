<?php
 
/**
 * User module bootstrap
 *
 * @author     Agustín F. Calderón M. <agustincl@gmail.com>
 * @copyright  (c)2009 White-Project
 * @category   Acl.
 * @package    modules
 * @subpackage user
 * @license    All Right Reserved
 * @version    SVN: $Id: Bootstrap.php 
 */
class Users_Bootstrap extends Zend_Application_Module_Bootstrap
{
	
	/**
     * Bootstrap the acl 
     * 
     * @return void
     */
	static protected $_config;
    
    /**
     *
     * @param mixed $key
     * @return Zend_Config
     */
    protected function _initConfiguration() {
      // Todo
      //Set config in bootstrap as application config

       $configFile = dirname(__FILE__) . '/config.ini';
       $config = new Zend_Config_Ini($configFile,'users');
        //self::$_config=$config;
        //return $config;

         Zend_Registry::set("users", $config);
         
         //Zend_Debug::dump('users');
    }
    
	protected function _initAcl()
    {
		$users=Zend_Registry::get('users');
        $auth = Zend_Auth::getInstance();
        $auth->setStorage(new Zend_Auth_Storage_Session($users->StorageSession));
        
        //$acl = new Users_Model_Acl();
        
        $acl = Users_Model_Acl::getInstance();
        
        $front = Zend_Controller_Front::getInstance();
        //$front->setParam('auth', $auth);
        //$front->setParam('acl', $acl);
        require_once dirname(__FILE__) . '/controllers/plugin/Acl.php';
        $front->registerPlugin(new Users_Controller_Plugin_Acl($auth, $acl));
        //$front->registerPlugin(new Users_Controller_Plugin_Acl());        
    }
    
    /**
     * Initialize languages
     *
     * Read language content file.
     * Store translate object in registry.
     *
     * @return void
     */
    protected function _initLang()
    {
		$translate = Zend_Registry::get('Zend_Translate');
        @$translate->addTranslation(dirname(__FILE__) .'/languages/views.xml', $_SESSION['default']['language']);
        Zend_Registry::set('Zend_Translate', $translate);       
    }
    
    /**
     * Initialize paginator
     *
     *  @return void
     */
    protected function _initViews(){
    	Zend_Paginator::setDefaultScrollingStyle('Elastic');
    	Zend_View_Helper_PaginationControl::setDefaultViewPartial(
		    array('paginatorSimple.phtml','users')
		);	
		
    }
    
    
}
