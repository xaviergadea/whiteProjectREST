<?php
/*
'message' => array(
 	Zend_Validate_StringLength::TOO_SHORT => '%s must be at least %min% characters.',
   	Zend_Validate_StringLength::TOO_LONG => '%s must be shorter than %max% characters.')
   	*/

/*$this->translate =  new Zend_Translate('array', APP_PATH . 'de.php', $this->language);
Zend_Registry::set('Zend_Translate', $this->translate);
Zend_Validate_Abstract::setDefaultTranslator($this->translate);
Zend_Form::setDefaultTranslator($this->translate); */

class Users_Form_Roles extends Zend_Form
{

    public function init()
    {
       	// set the method for the display form to POST
        $this->setMethod('post');
        $role_id = new Zend_Form_Element_Hidden('role_id');

	    $role_name = new Zend_Form_Element_Text('role_name');
            $role_name->setLabel('Resource')
				->setRequired(true)
                                ->addValidator('NotEmpty', true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				//->addValidator('StringLength', false, array(3,20))
				->addValidator('StringLength',false,array(3,50))
                                ->setAttrib('size', 56)
				->setAttrib('maxlength', 255);
            
            $prefered_uri = new Zend_Form_Element_Text('prefered_uri');
            $prefered_uri->setLabel('Default URI')
				->setRequired(true)
                                ->addValidator('NotEmpty', true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('StringLength',false,array(3,20))
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255);

        $submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Add');

		$this->addElements(array($role_id,$role_name,$prefered_uri,$submit));
    }

}