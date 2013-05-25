<?php

/**
 * Bootstrap.php is the admin module bootstrap
 *
 * @author     Agustín Calderón <agustincl@gmail.com>
 * @copyright  Copyright 2009 White-Project. All Rights Reserved.
 * @license    http://creativecommons.org/licenses/by-nc-nd/3.0/es/  CC-NC-ND
 * @category   White-Project
 * @package    Admin
 * @subpackage file
 * @version    SVN $Id: Bootstrap.php 1140 2010-05-19 16:48:11Z agustincl $
 *
 */

 /**
 * Admin_Bootstrap
 *
 * @category   White-Project
 * @uses       Zend_Application_Module_Bootstrap
 * @package    Admin
 * @subpackage Bootstrap
 *
 */
class Admin_Bootstrap extends Zend_Application_Module_Bootstrap
{
	
        /**
     * Initialize configuration
     *
     * Read configuration file.
     * Store configuration in registry.
     *
     * @return void
     */
    protected function _initConfiguration() 
    {
		$configFile = dirname(__FILE__) . '/config.ini';
		$admin_config = new Zend_Config_Ini($configFile,'admin');
		Zend_Registry::set("admin_config", $admin_config);	
		//Zend_Debug::dump('admin');	
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
        $translate->addTranslation(dirname(__FILE__) .'/languages/views.xml', $_SESSION['default']['language']);
    }    
    
	protected function initDojoLayer()
    {
		$front = Zend_Controller_Front::getInstance();
        require_once dirname(__FILE__) . '/controllers/plugin/Dojolayer.php';
        $front->registerPlugin(new Admin_Plugin_DojoLayer());
                
    }
    
    
}
