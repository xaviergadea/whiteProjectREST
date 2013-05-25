<?php

class Admin_Form_Templates extends Zend_Form
{

    public function init()
    {
       	// set the method for the display form to POST
        $this->setMethod('post');
        $id = new Zend_Form_Element_Hidden('id');
		
		$id_wlabel = new Zend_Form_Element_Select('id_wlabel');
		$id_wlabel->setLabel('WLabel')
						 ->setmultiOptions($this->_selectOptionsWLabel())
						 ->setAttrib('maxlength', 200)
						 ->setAttrib('size', 1)
						 ->setRequired(true)
                         ->addValidator('NotEmpty', true);	
                         
		$layout = new Zend_Form_Element_Text('layout');
		$layout->setLabel('Layout')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255);
                         
		$template = new Zend_Form_Element_Text('template');
		$template->setLabel('Template')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255);

		$status = new Zend_Form_Element_Select('status');
		$status->setLabel('Status')
						 ->setRequired(true)
                         ->addValidator('NotEmpty', true)
                         ->setmultiOptions(array('0'=>'inactive', '1'=>'active'))
						 ->setAttrib('maxlength', 200)
						 ->setAttrib('size', 1)
						 ;
						 				 
        $submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Add');

		$this->addElements(array($id,$id_wlabel,$layout,$template,$status,$submit));
    }
    
	protected function _selectOptionsWLabel()
    {            	
    	$sql="SELECT id, label
    	      FROM wlabel";
    	$db=Zend_Registry::get('db');
    	$result = $db->fetchPairs($sql);
    	return $result;
    }

}