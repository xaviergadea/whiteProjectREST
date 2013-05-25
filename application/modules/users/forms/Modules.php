<?php

class Users_Form_Modules extends Zend_Form
{

    public function init()
    {
       	// set the method for the display form to POST
        $this->setMethod('post');
        $module_id = new Zend_Form_Element_Hidden('module_id');

		$module_name = new Zend_Form_Element_Text('module_name');
		$module_name->setLabel('Name')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255);
				
			
				
        $submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Add');

		$this->addElements(array($module_id,$module_name,$submit));
    }

}