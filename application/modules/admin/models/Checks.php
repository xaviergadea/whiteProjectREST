<?php

/**
 * Checks.php is the model for check configurations
 *
 * This module is a library of differrents check configuraion options.
 *
 * @author     Agustín Calderón <agustincl@gmail.com>
 * @copyright  Copyright 2009 White-Project. All Rights Reserved.
 * @license    http://creativecommons.org/licenses/by-nc-nd/3.0/es/  CC-NC-ND
 * @category   White-Project
 * @package    Admin
 * @subpackage file
 * @version    SVN $Id: IndexController.php 594 2009-09-30 06:10:29Z agustincl $
 *
 */

/**
 * Admin_Model_Checks
 *
 * @category   White-Project
 * @package    Admin
 * @subpackage Model
 *
 */
class Admin_Model_Checks
{

    /**
     * Hold admin configuration.
     * 
     * @access protected
     * @var array
     */
    protected $_admin_config;
	
	
    public function __construct()
    {
    	$this->_admin_config = Zend_Registry::get('admin_config');	
    }
  
	public function checkInternetConnection()
   	{
   		$ip=NULL;
    	$ip = gethostbyname('www.google.com');
    	//Zend_Debug::dump($ip);die;
    	if ($ip!='www.google.com'){
    		return true;
    	}
    	else 
    		return false;
   	}

   	/**
     * Check iturismo path's configuration.
     *
     * @return Array with results
     * @throws Error with message
     */
   	public function checkIturismoPaths()
   	{
   		
   		$iturismo=Zend_Registry::get('iturismo');
   		foreach($iturismo as $key => $value){	
   					
			// Check Paths
   			if($value->path){
	   			$perm=substr(sprintf('%o', fileperms($value->path)), -4);
	   			try {
					if ($perm<$this->_admin_config->directory->permissions->iturismo) {
				        throw new Exception('( '.$perm.' '.realpath($value->path).') DIRECTORY NOT WRITABLE. o+w Needed.', false);
				    }
				    else
				    	throw new Exception('( '.$perm.' '.realpath($value->path).') DIRECTORY Good.', true);
			    } catch (Exception $e) {
			        $out[$key] = array('code'=>$e->getCode(), 'message'=>$e->getMessage());
			    }
			}
			
		}
		return $out;
   	}

    public function checkStrictMode() {
        $sql = "SELECT @@SESSION.sql_mode AS sql_mode";
        $db=Zend_Registry::get('db');
        $ds = $db->query($sql);
        $row = $ds->fetch();        
        return (strpos($row->sql_mode, "STRICT_TRANS_TABLES") !== false);
    }
    
    public function getDbServerVersion()
    {
        $db=Zend_Registry::get('db');
        return $db->getServerVersion();
    }
}