<?php

class Users_Form_Resources extends Zend_Form
{

    public function init()
    {
       	//Todo
       	// Make a Unique validator for resources
    
    	// set the method for the display form to POST
        $this->setMethod('post');
        $uid = new Zend_Form_Element_Hidden('uid');

		$module_id = new Zend_Form_Element_Select('module_id');
		$module_id->setLabel('Module')
						 ->setmultiOptions($this->_selectOptions())
						 ->setAttrib('maxlength', 200)
						 ->setAttrib('size', 1)
						 ->setRequired(true);
						 
	    $resource = new Zend_Form_Element_Text('resource');
		$resource->setLabel('Resource')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('StringLength', false, array(3,20))
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255);

		$name_r = new Zend_Form_Element_Text('name_r');
		$name_r->setLabel('Name')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255);
				
			
				
        $submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Add');

		$this->addElements(array($uid,$module_id,$resource,$name_r,$submit));
    }

	protected function _selectOptions()
    {
        $sql="SELECT module_id, module_name
    	      FROM acl_modules";
    	$db=Zend_Registry::get('db');
    	$result = $db->fetchPairs($sql);
    	return $result;
    }

}