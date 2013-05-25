<?php

class Equipo_Form_Equipo extends Zend_Form
{
	
	private $_equipo = array();
	
    public function init()
    {
       	Zend_Dojo::enableForm($this);
       	$this->_equipo = Zend_Registry::get('equipo_config');	
    	$destination=realpath($this->_equipo->images->path);
        require_once APPLICATION_PATH.'/../library/Acl/Filter/Stripslashes.php';
//       	$array=array();       	
//        $this->setElementsBelongTo($array);       
    	// set the method for the display form to POST
        $this->setMethod('post');
        $project_id = new Zend_Form_Element_Hidden('id');
		
      
       

		// -----------------  Gallery elements ----------------------- //
		$imagen_path_tag = new Zend_Form_Element_Image('photo_tag');
        $imagen_path_tag->setLabel("Current image")
                        ->setAttrib('class', 'thumb_admin');
                          
		$imagen_path = new Zend_Form_Element_File('photo');
		$imagen_path->setLabel('Image (512kb size, jpg,png,gif)')
                ->addValidator('NotEmpty', true)
                ->setDestination($destination)
                ->addFilter('StripTags')
				->addFilter('StringTrim')
                ->addValidator('NotExists', false, array($destination))
				->addValidator('Count', false, array(1))
				->addValidator('Extension', true, array('jpg,png,gif'))
				->addValidator('Size', false, array(512000))				
				;		  
		
		$equipo_esp = new Zend_Dojo_Form_Element_Editor('equipo_esp');
		$equipo_esp->setLabel('Equipo Español')
					  //->setOptions(array('class' => 'textarea'))
					  ->setOptions(array(
						    //'plugins'            => array('undo', '|', 'bold', 'italic', 'underline', 'createLink'),
						    'editActionInterval' => 2,
						    'focusOnLoad'        => true,
						    'height'             => '150px',
						    'inheritWidth'       => false,
						    'styleSheets'        => array('/js/custom/editor.css'),
					));
		$equipo_eng = new Zend_Dojo_Form_Element_Editor('equipo_eng');
		$equipo_eng->setLabel('Equipo English')
					  //->setOptions(array('class' => 'textarea'))
					  ->setOptions(array(
						    //'plugins'            => array('undo', '|', 'bold', 'italic', 'underline', 'createLink'),
						    'editActionInterval' => 2,
						    'focusOnLoad'        => true,
						    'height'             => '150px',
						    'inheritWidth'       => false,
						    'styleSheets'        => array('/js/custom/editor.css'),
					));
		$equipo_cat = new Zend_Dojo_Form_Element_Editor('equipo_cat');
		$equipo_cat->setLabel('Equipo Català')
					  //->setOptions(array('class' => 'textarea'))
					  ->setOptions(array(
						    //'plugins'            => array('undo', '|', 'bold', 'italic', 'underline', 'createLink'),
						    'editActionInterval' => 2,
						    'focusOnLoad'        => true,
						    'height'             => '150px',
						    'inheritWidth'       => false,
						    'styleSheets'        => array('/js/custom/editor.css'),
					));
		
		$description_esp = new Zend_Form_Element_Textarea('description_esp');
		$description_esp->setLabel('Descripción Foto Español')
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addFilter(new Acl_Filter_StripSlashes())
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text-input medium-input'))
				;
		$description_eng = new Zend_Form_Element_Textarea('description_eng');
		$description_eng->setLabel('Descripción Foto English')
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addFilter(new Acl_Filter_StripSlashes())
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text-input medium-input'))
				;
		$description_cat = new Zend_Form_Element_Textarea('description_cat');
		$description_cat->setLabel('Descripción Foto Català')
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addFilter(new Acl_Filter_StripSlashes())
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text-input medium-input'))
				;
		
				
		// -----------------  Getting all ----------------------- //		
				
        $submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Add')
		;

		
		$this->addElements(array($imagen_path_tag,$imagen_path,$equipo_esp,$equipo_eng,$equipo_cat,
								 $description_esp,$description_cat,$description_eng,$submit));
		
		
      
      
     
    }
    
	protected function _selectOptionsCategory()
    {            	
    	$sql="SELECT id, category_esp
    	      FROM categories
    	      ORDER BY category_esp ASC";
    	$db=Zend_Registry::get('db');
    	$result = $db->fetchPairs($sql);
    	return $result;
    }

}