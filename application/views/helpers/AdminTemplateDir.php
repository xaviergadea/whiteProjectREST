<?php

class Zend_View_Helper_AdminTemplateDir
{

    protected static $templateDir = null;
    protected $_templateDir = null;
    
	/**
     * Returns site's base url, or file with base url prepended
     *
     * $file is appended to the base url for simplicity
     *
     * @param  string|null $file
     * @return string
     */
    public function adminTemplateDir($file = null)
    {
        // Get baseUrl
        $baseUrl = $this->getBaseUrlAdminTemplate();

        // Remove trailing slashes
        if (null !== $file) {
            $file = '/' . ltrim($file, '/\\');
        }

        return $baseUrl . $file;
    }
    
	/**
     * Get BaseUrl
     *
     * @return string
     */
    public function getBaseUrlAdminTemplate()
    {
        if ($this->_templateDir === null) {
            
			$front = Zend_Controller_Front::getInstance();  
	    	$account=$front->getRequest()->getParam('account');
	    		
	        $model = new Admin_Model_Templates();
	        $template=$model->fetchTemplateByWlabel($account);
	    	foreach($template as $key => $value){
	    		if($key=='default')
	    			$templateDir = "/templates/".$template['default']['template'];
	    		else	
	    			$templateDir = "/templates/".$template[$account]['template'];
	    	}
	        $this->setBaseUrl($templateDir);
        }

        return $this->_templateDir;
    }
    
	/**
     * Set BaseUrl
     *
     * @param  string $base
     * @return Zend_View_Helper_BaseUrl
     */
    public function setBaseUrl($base)
    {
        $this->_templateDir = rtrim($base, '/\\');
        return $this;
    }

}