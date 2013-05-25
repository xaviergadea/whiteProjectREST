<?php

class Users_AuthorController extends Zend_Controller_Action
{

    public function loginAction()
    {		
		$this->_helper->layout->setLayout('login');			// Change layout    	
	
    	$this->view->headTitle("Login", 'APPEND');
        $request = $this->getRequest();
    	
        $form    = new Users_Form_AuthorLogin();
        $form->setName('registration');
    	    	
        if (!$this->getRequest()->isPost()) {
            $this->view->form = $form;
            return;
        } elseif (!$form->isValid($_POST)) {
            $this->view->failedValidation = true;
            $this->view->form = $form;
            return;
        }
             
        $values = $form->getValues();
		
        // Setup DbTable adapter
        $adapter = new Zend_Auth_Adapter_DbTable(Zend_Registry::get('db'));
        $adapter->setTableName('acl_users');
        $adapter->setIdentityColumn('email');
        $adapter->setCredentialColumn('password');
        $adapter->setIdentity($values['name']);
        $adapter->setCredential(hash('SHA256', $values['password']));
	
        // authentication attempt
        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($adapter);        
        $table = new Users_Model_DbTable_Users;
        // authentication succeeded
        if ($result->isValid()) {            
        	
        	$status=$adapter->getResultRowObject()->status;
        	//Zend_debug::dump($status);
        	
        	if($status==1){        		
				$auth->getStorage()
	               	 ->write($adapter->getResultRowObject(null, 'password'));
		        $this->view->passedAuthentication = true;  
                $rowset = $table->fetchRow("email ='".$values['name']."'");
                $role = new Users_Model_DbTable_Roles;
                $rowset_role = $role->fetchRow("role_id ='".$rowset['role_id']."'");
                

                if($rowset_role['prefered_uri']!='0')
                {         	
                	$this->_redirect("http://".$_SERVER['HTTP_HOST'].'/'.$rowset_role['prefered_uri']);              	
                }
                else
                {
                	$this->_redirect("http://".$_SERVER['HTTP_HOST'].'/admin');
                }
                return;
        	}
        	else{
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
    }
    
    public function logoutAction()
    {
//        Zend_Debug::dump($_SERVER);
//        Zend_Debug::dump($_SESSION);
//        die;
    	Zend_Auth::getInstance()->clearIdentity();
    	Zend_Session::destroy();
        $this->_helper->redirector('index', 'index', 'admin');
    }
    
	public function logoutandbackAction()
    {
//        Zend_Debug::dump($_SERVER);
//        Zend_Debug::dump($_SESSION);
//        die;
//Zend_Debug::dump($_SERVER['HTTP_REFERER']);
//Zend_Debug::dump(Zend_Controller_Front::getInstance()->getRequest()->getRequestUri());
//die;
  	
		Zend_Auth::getInstance()->clearIdentity();
    	Zend_Session::destroy();
       	$this->_redirect($_SERVER['HTTP_REFERER']);  
    }

    /**
     *
     * recoverAction
     * Starts lost password procedure sending an email to the user with a random password
     *
     * @category   White-Project
     * @uses       Zend_Controller_Action
     * @package    White-Project
     * @subpackage Controller
     * @return void
     */
    public function recoverAction()
    {
        $email = $this->_getParam('email', 0);
        $nextUrlBase="http://".$_SERVER['HTTP_HOST'].Zend_Controller_Front::getInstance()->getBaseUrl();
        $nextUrl = $nextUrlBase . '/users/author/newpassword/email/' . $email;

        $model = new Users_Model_Authors();
        $newPassword = $model->createRandomPassword();

        Zend_Debug::dump('passwd: ' . $newPassword);
        // Save the new password hash at DB
        $modelUsers = new Users_Model_Users();
        $modelUsers->update(
                        array('validation_code'=>hash('SHA256', $newPassword)),
                        "email='" . $email . "'");

        // Send email
        $mail = new Zend_Mail();
        $mail->setBodyText(
            $this->view->translate('Your password for was successfully generated') . '.<br />' .
            $this->view->translate('You can access the Web site at the following address:') . '<a href="' . $nextUrl . '">' . $nextUrl . '</a><br />' .
            $this->view->translate('Your login e-mail:') . ' ' . $email . '<br />' .
            $this->view->translate('Your new password:') . ' ' . $newPassword . '<br />
            <br />' .
            $this->view->translate('For your own security, you will be prompted to change your password the next time you sign in to the system.') . '.');
        // todo: get "From" e-mail at application.ini
        $mail->setFrom('soporte@White-Project.com', 'Soporte White-Project');
        $mail->addTo($email, '');
        $mail->setSubject('Nueva contraseña');
        //Zend_Debug::dump($mail);
        //$mail->send();

        // todo: show message if failed to save to the DB or send email problem

        // Show "An e-mail with a temporary password has been sent to you" with button "Back" which navigates to login screen
        $this->view->entrySaved = true;
    }

    /**
     * newpasswordAction
     * Called from the email with the new password
     * Shows a form to enter random password sent by e-mail and forces to write a new one.
     *
     * @category   White-Project
     * @uses       Zend_Controller_Action
     * @package    White-Project
     * @subpackage Controller
     * @return void
     */
    public function newpasswordAction()
    {
        $email = $this->_getParam('email');
        $this->view->email = $email;

        $form = new Users_Form_NewPassword();

        $request = $this->getRequest();

        if (!$request->isPost()) {
            $this->view->form = $form;
            return;
        } elseif (!$form->isValid($_POST)) {
            $this->view->failedValidation = true;
            $this->view->form = $form;
            return;
        }
        
        // We have a valid POST :
        $formValues = $form->getValues();
        $model = new Users_Model_Users();
        $row = $model->fetchEntryByEmail($email);
        if (hash('SHA256', $formValues['randomPassword']) != $row['validation_code'])
        {
            $this->view->failedRandomPassword = true;
            $this->view->form = $form;
            return;
        }
        $model->update(array('password'=>$formValues['newPassword'], 'validation_code'=>'0'), "email='" . $email . "'" );
        $this->view->newPasswordSetOk = true;
    }

}