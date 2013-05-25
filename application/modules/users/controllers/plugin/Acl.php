<?php

class Users_Controller_Plugin_Acl extends Zend_Controller_Plugin_Abstract
{

    protected $_auth = null;
    protected $_acl = null;

    public function __construct()
    {
        $users=Zend_Registry::get('users');
        $this->_auth = Zend_Auth::getInstance();
        $this->_auth->setStorage(new Zend_Auth_Storage_Session($users->StorageSession));
        $this->_acl = Users_Model_Acl::getInstance();             
    }

    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
    {  	
    	
//    	$account = Zend_Registry::get('account');  
//		phpinfo();
//		Zend_Debug::dump($_SESSION, "account", true);
//    	Zend_Debug::dump($this->_auth->getIdentity(), "account", true);
//		Zend_Debug::dump($request, "account", true);
//		die;
		
    	$module = $request->getModuleName();
    	$resource = $request->getControllerName();
    	$permission = $request->getActionName();
        
//        $module = $request->module;
//        $resource = $request->controller;
//        $permission = $request->action;        
//        $request->setParam('account', $account);
//        $account = $request->account;

    	if (!$this->_acl->has($module.":".$resource)) {
            //NO Exist Resource
    		$resource = null;            
        }
        else{
        	//Exist Resource
        	$resource=$module.":".$resource;        	
        }
      	
        
        // Get User Identity
        Zend_Debug::dump($this->_auth->hasIdentity(), "autenticated?", false);
       	if($this->_auth->getIdentity()){
			$role=$this->_acl->getRoleName($this->_auth->getIdentity()->role_id);
			$this->_acl->_UserRoleName=$role->role_name;
			$this->_acl->_UserRoleId=$this->_auth->getIdentity()->role_id;
			Zend_Debug::dump($role, "role", false);
       	}
		
       	
       
 		// Resource exist (Error 404)
		if(!$this->_acl->has($resource))
		{
			// Error 404
//			$request->setControllerName('error');
//        	$request->setActionName('error');
//        	$request->setDispatched(true);
//		    throw new ParameterNotFoundException('oh no!');
        	Zend_Debug::dump("-----", "Error 404", false);
			
		}	
		else{       
	        if (!$this->_acl->isAllowed($this->_acl->_UserRoleName,$resource, $permission)) {
	            if ($this->_auth->hasIdentity()) {
	                // authenticated, denied access, forward to denied page
	                $request->setModuleName('users');
	                $request->setControllerName('error');
	                $request->setActionName('denied');
	                //echo "si";
	            } else {
	                // not authenticated, forward to login page
					$request->setModuleName('users');
	                $request->setControllerName('author');
	                $request->setActionName('login');
	                //echo "no";
	            }
	        }
	        else {
	        	//echo "no or yes";
	        }
		}
    }
    
//	public function preDispatch(Zend_Controller_Request_Abstract $request)  
//	{  		
//		@$module = $request->module;
//		@$resource = $request->controller;
//        @$permission = $request->action;
//        @$account=$request->account;	
//        
//        Zend_Debug::dump($request, "request dispatch", false);
//		
//        $layout = Zend_Layout::getMvcInstance();
//        $view = $layout->getView();        		
//        
//        $model = new Whitelabel_Model_Wlabel();
//        $accountinfo=$model->getWlabelinfoByAccountModRes($account, $module, $module.':'.$resource);        
//        
//        // TODO Force Role
////		$this->_acl->_UserRoleName=$accountinfo->force_role;
//       	        
//        
//        Zend_Debug::dump($accountinfo, "accountLayout", false);
//        
//        if(@$accountinfo->layout!=NULL)
//        {
//        	$layout->setLayout($accountinfo->layout); 
//        }
//        Zend_Debug::dump($layout->getLayout(), 'layout', false);
//       	   
//		return;
//	}                
}