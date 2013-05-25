<?php

class Users_Form_AuthorLogin extends Zend_Form
{

    public function init()
    {
		$refer = new Zend_Form_Element_Hidden('refer');
		$refer->setValue(@$_SERVER['HTTP_REFERER']?@$_SERVER['HTTP_REFERER']:@$_SERVER['REDIRECT_URL']);
			
    	$email = new Zend_Form_Element_Text('name');
		$email->setLabel('Email')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('StringLength', false, array(3,80))
				->addValidator('emailAddress')
				->setAttrib('size', 30)
				->setAttrib('maxlength', 80)
				->setDecorators(array(array('ViewScript', array(
				    'viewScript' => 'forms/_element_normal.phtml'
				))))
				->setAttrib('class', 'text-input');   	
     	
		$password = new Zend_Form_Element_Password('password');
		$password->setLabel('Password')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('StringLength', false, array(3,20))
				->setAttrib('size', 30)
				->setAttrib('maxlength', 80)
				->setDecorators(array(array('ViewScript', array(
				    'viewScript' => 'forms/_element_normal.phtml',
				))))
				->setAttrib('class', 'text-input');

        $submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Submit')
				->setValue('Submit')
				->setDecorators(array(array('ViewScript', array(
				    'viewScript' => 'forms/_element_submit_alone.phtml'				   
				))))
				->setAttrib('class', 'button')
				->removeDecorator('label');
		
        $this->addElements(array($refer,$email,$password,$submit));        
        
    }

}