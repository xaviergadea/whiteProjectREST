<?php

class Users_AjaxController extends Zend_Controller_Action 
{
	
	public function init()
    {   
		// Disable Layout
    	$this->_helper->viewRenderer->setNoRender(true);
		$this->_helper->layout->disableLayout();    	
    }
    
 	/**
     * Login form frontend.
     *
     * @return void
     */
    public function loginuserAction() 
    {
   
        $this->view->headTitle("Login", 'APPEND');
        $request = $this->getRequest();

        //        $form    = new Users_Form_AuthorLogin();
        //        $form->setName('registration');

        if (!$this->getRequest()->isPost()) {
            $this->view->form = $form;
            echo "not post data";
        //            return;
        }
        //        elseif (!$form->isValid($_POST)) {
        //            $this->view->failedValidation = true;
        //            $this->view->form = $form;
        //            echo "not post data";
        //            return;
        //        }

        //        $values = $form->getValues();
        $username=$request->getPost('email');
        $password=$request->getPost('pass');


        // Setup DbTable adapter
        $adapter = new Zend_Auth_Adapter_DbTable(Zend_Registry::get('db'));
        $adapter->setTableName('acl_users');
        $adapter->setIdentityColumn('email');
        $adapter->setCredentialColumn('password');
        $adapter->setIdentity($username);
        $adapter->setCredential(hash('SHA256', $password));

        // authentication attempt
        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($adapter);
        $table = new Users_Model_DbTable_Users;
        // authentication succeeded
        if ($result->isValid()) {

            $status=$adapter->getResultRowObject()->status;
            //Zend_debug::dump($status);

            if($status==1) {
                $auth->getStorage()
                    ->write($adapter->getResultRowObject(null, 'password'));
                $this->view->passedAuthentication = true;
                $rowset = $table->fetchRow("email ='".$username."'");
                $role = new Users_Model_DbTable_Roles;
                $rowset_role = $role->fetchRow("role_id ='".$rowset['role_id']."'");
                echo "Authenticated!!!!";
                //$this->_helper->redirector('index', 'index', $rowset_role['prefered_uri']);
                return;
            }
            else {
                $this->view->statusState = true;
                $this->view->email=$username;
            }
        } else { // or not! Back to the login page!
            $this->view->failedAuthentication = true;
            $rowset = $table->fetchRow("email ='".$username."' and status=1");
            $rowCount = count($rowset);
            if ($rowCount > 0) {
            //echo "found $rowCount rows";
            //$this->view->email=$username;
            //$this->view->emailExist = true;
                echo "Check your username or password";
            } else {
            //$this->_helper->redirector('index', 'index', 'admin');
                echo "Check your username / password";
            }
        //$this->view->loginForm = $form;
        }
    //echo "authentication Done!!!";
    }

    public function loginuser2Action() {
        $method = ucfirst(strtolower($this->getRequest()->getMethod()));
        Zend_Debug::dump($method, "metodo:", false);

        $request = $this->getRequest();
        Zend_Debug::dump($request->getPost('email'), "getpost:", false);
        Zend_Debug::dump($request->getParams(), "getpost:", false);



        //      $form    = new Users_Form_AuthorLogin();
        //      $form    = new White-Project_Form_Loginuser();
        //    	$values = $form->getValues();

        if (!$this->getRequest()->isPost()) {
        //            $this->view->form = $form;
            $this->_helper->viewRenderer->setNoRender(true);
            $this->_helper->layout->disableLayout();
            echo "not post data";
        //return;
        }
        //        } elseif (!$form->isValid($_POST)) {
        ////            $this->view->failedValidation = true;
        ////            $this->view->form = $form;
        //            $this->_helper->viewRenderer->setNoRender(true);
        //    		$this->_helper->layout->disableLayout();
        //    		echo "not valid data";
        //            return;
        //        }
        //

        // Authentication adapter
        $adapter = new Zend_Auth_Adapter_DbTable(Zend_Registry::get('db'));
        $adapter->setTableName('acl_users');
        $adapter->setIdentityColumn('email');
        $adapter->setCredentialColumn('password');
        $adapter->setIdentity($request->getPost('email'));
        $adapter->setCredential(
            hash('SHA256', $request->getPost('pass'))
        );

        // Authentication attempt
        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($adapter);
        $table = new Users_Model_DbTable_Users;
        // authentication succeeded
        if ($result->isValid()) {

            $status=$adapter->getResultRowObject()->status;
            //Zend_debug::dump($status);

            if($status==1) {
                $auth->getStorage()
                    ->write($adapter->getResultRowObject(null, 'password'));
                $this->view->passedAuthentication = true;
                $rowset = $table->fetchRow("email ='".$values['name']."'");
                $role = new Users_Model_DbTable_Roles;
                $rowset_role = $role->fetchRow("role_id ='".$rowset['role_id']."'");
                $this->_helper->redirector('index', 'index', $rowset_role['prefered_uri']);
                return;
            }
            else {
                $this->view->statusState = true;
                $this->view->email=$values['name'];
            }
        } else { // or not! Back to the login page!
            $this->view->failedAuthentication = true;
            $rowset = $table->fetchRow("email ='".$values['name']."' and status=1");
            $rowCount = count($rowset);
            if ($rowCount > 0) {
            //echo "found $rowCount rows";
                $this->view->email=$values['name'];
                $this->view->emailExist = true;
            } else {
                $this->_helper->redirector('index', 'index', 'admin');
            }
            $this->view->loginForm = $form;
        }

        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        echo "authentication Done!!!";

    }

    /**
     * Logout frontend.
     *
     * @return void
     */
    public function logoutuserAction() {
    //$this->view->form = $form;
        Zend_Auth::getInstance()->clearIdentity();
        Zend_Session::destroy();
        $this->renderScript ( 'frontend/index.phtml' );
    }

}

