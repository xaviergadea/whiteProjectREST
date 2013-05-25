<?php

/**
 * Frontend module bootstrap
 *
 * @author     Agustín F. Calderón M. <agustincl@gmail.com>
 * @copyright  Copyright 2009. All Rights Reserved.
 * @category   frontend
 * @package    Frontend
 * @subpackage file
 */
class Frontend_Bootstrap extends Zend_Application_Module_Bootstrap
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
		$admin_config = new Zend_Config_Ini($configFile,'frontend');
		Zend_Registry::set("frontend_config", $admin_config);	
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
}