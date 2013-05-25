<?php

class Admin_Plugin_DojoLayer extends Zend_Controller_Plugin_Abstract
{
    public $layerScript;
    public $buildProfile;
    protected $_build;
 
    public function dispatchLoopShutdown()
    {
        if (!file_exists($this->layerScript)) {
            $this->generateDojoLayer();
        }
        
    	if (!file_exists($this->buildProfile)) {
            $this->generateBuildProfile();
        }
    }
 
    public function getBuild()
    {
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper(
            'ViewRenderer'
        );
        $viewRenderer->initView();
        if (null === $this->_build) {
            $this->_build = new Zend_Dojo_BuildLayer(array(
                'view'      => $viewRenderer->view,
                'layerName' => 'custom.main',
            	'consumeOnLoad' => true,
            ));
        }
        return $this->_build;
    }
 
    public function generateDojoLayer()
    {
        $build = $this->getBuild();
        $this->layerScript=APPLICATION_PATH . '/../public/scripts/js/custom/main.js';        
        $layerContents = $build->generateLayerScript();
        if (!is_dir(dirname($this->layerScript))) {
            mkdir(dirname($this->layerScript));
        }
        file_put_contents($this->layerScript, $layerContents);
    }
    
	public function generateBuildProfile()
    {
        $build = $this->getBuild();
    	$this->buildProfile=APPLICATION_PATH . '/../scripts/custom.profile.js';
    	$build->setLayerScriptPath("../ag.js")
    		  ->setProfilePrefixes(array('dojo'=>'../../dojo', 
    		  							 'dijit'=>'../dijit', 
    		  							 'dojox'=>'../dojox'
    		  						))
    		  ->setProfileOptions(array('version'=>'1.0.1'));
    	$profile = $build->generateBuildProfile();
        file_put_contents($this->buildProfile, $profile);
    }
}            
