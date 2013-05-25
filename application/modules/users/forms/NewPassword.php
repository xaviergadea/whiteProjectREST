<?php

class Users_Form_NewPassword extends Zend_Form
{

    public function init()
    {
	$refer = new Zend_Form_Element_Hidden('refer');
	$refer->setValue(@$_SERVER['HTTP_REFERER']?@$_SERVER['HTTP_REFERER']:$_SERVER['REDIRECT_URL']);

        $randomPassword = new Zend_Form_Element_Password('randomPassword');
        $randomPassword->setLabel('Password sent by email')
                        ->setRequired(true)
                        ->addFilter('StripTags')
                        ->addFilter('StringTrim')
                        ->addValidator('StringLength', false, array(3,20))
                        ->setAttrib('size', 30)
                        ->setAttrib('maxlength', 80);

        $newPassword = new Zend_Form_Element_Password('newPassword');
        $newPassword->setLabel('New Password')
                        ->setRequired(true)
                        ->addFilter('StripTags')
                        ->addFilter('StringTrim')
                        ->addValidator('StringLength', false, array(3,20))
                        ->setAttrib('size', 30)
                        ->setAttrib('maxlength', 80);

        $submit = new Zend_Form_Element_Submit('submit');
	$submit->setLabel('Submit');

        $this->addElements(array($refer,$randomPassword,$newPassword,$submit));

    }

}