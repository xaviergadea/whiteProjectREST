<?php

class Users_Form_Users extends Zend_Form
{

    public function init()
    {
       	// set the method for the display form to POST
        $this->setMethod('post');
        $uid = new Zend_Form_Element_Hidden('uid');

       	$user_name = new Zend_Form_Element_Text('user_name');
		$user_name->setLabel('Name')
				->setRequired(true)
				->addValidator('NotEmpty', true)
                ->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255);

		$password = new Zend_Form_Element_Password('password');
		$password->setLabel('Password')
				->setRequired(true)
				->addValidator('NotEmpty', true)
                ->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('StringLength',false,array(3,20))
				->setAttrib('size', 30)
				->setAttrib('maxlength', 80);

                $email = new Zend_Form_Element_Text('email');
		$email->setLabel('Email')
				->setRequired(true)
				->addValidator('NotEmpty', true)
                ->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('StringLength',false,array(3,200))
				->addValidator('emailAddress', true)
				->setAttrib('size', 30)
				->setAttrib('maxlength', 80);

		$status = new Zend_Form_Element_Select('status');
		$status->setLabel('Status')
						 ->setRequired(true)
                         ->addValidator('NotEmpty', true)
                         ->setmultiOptions(array('1'=>'Activo', '0'=>'Inactivo'))
						 ->setAttrib('maxlength', 200)
						 ->setAttrib('size', 1)
						 ;
	
                $phone = new Zend_Form_Element_Text('phone');
		$phone->setLabel('Phone')
				->setRequired(true)
				->addValidator('NotEmpty', true)
                ->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255);

		$role_id = new Zend_Form_Element_Select('role_id');
		$role_id->setLabel('Role')
						 ->setRequired(true)
                         ->addValidator('NotEmpty', true)
                         ->setmultiOptions($this->_selectOptions())
						 ->setAttrib('maxlength', 200)
						 ->setAttrib('size', 1)
						 ;

        $submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Add');

		$this->addElements(array($uid,$user_name,$password,$email,$status,
								 $phone,$role_id,$submit));
    }

	protected function _selectOptions()
    {
        $sql="SELECT role_id, role_name
    	      FROM acl_roles
              WHERE role_name!='Everyone' and role_name!='Implementor'";

        $db=Zend_Registry::get('db');
    	$result = $db->fetchPairs($sql);
    	return $result;
    }
	
	public function editUser()
	{
        $this->removeElement('password'); 
        return;
		
    }
    
	public function editPassword()
	{
        $this->removeElement('user_name');
        	$this->removeElement('email');
        	$this->removeElement('status');
        	$this->removeElement('phone');
       	 	$this->removeElement('role_id');
        return; 
    }
    
}