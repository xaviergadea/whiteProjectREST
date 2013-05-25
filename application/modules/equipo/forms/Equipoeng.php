<?php

class Projects_Form_Projectseng extends Zend_Form
{

    public function init()
    {
       	// set the method for the display form to POST
        $this->setMethod('post');
        $project_id = new Zend_Form_Element_Hidden('id');
				
		$project_name = new Zend_Form_Element_Text('project_eng');
		$project_name->setLabel('Name')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 70)
				->setAttrib('maxlength', 255);
						                 
		$project_place = new Zend_Form_Element_Text('place_eng');
		$project_place->setLabel('Place')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255);

		$project_description = new Zend_Form_Element_Textarea('description_eng');
		$project_description->setLabel('Description')
				->setRequired(true)
                ->addValidator('NotEmpty', true)
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 1);
				
		$project_associates = new Zend_Form_Element_Textarea('associates_eng');
		$project_associates->setLabel('Working with')
				->setRequired(true)
                ->addValidator('NotEmpty', true)
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setAttrib('maxlength', 255);
				
		$project_colaborators = new Zend_Form_Element_Textarea('colaborators_eng');
		$project_colaborators->setLabel('Colaborators')
				->setRequired(true)
                ->addValidator('NotEmpty', true)
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setAttrib('maxlength', 255);
				
		$project_promotors = new Zend_Form_Element_Textarea('promotors_eng');
		$project_promotors->setLabel('Promotors')
				->setRequired(true)
                ->addValidator('NotEmpty', true)
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setAttrib('maxlength', 255);
		
		$project_constructor = new Zend_Form_Element_Textarea('constructor_eng');
		$project_constructor->setLabel('Contructor')
				->setRequired(true)
                ->addValidator('NotEmpty', true)
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setAttrib('maxlength', 255);
		
		$project_pdf = new Zend_Form_Element_Text('pdf_eng');
		$project_pdf->setLabel('Pdf')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255);
                         
        $submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Add');

		$this->addElements(array($project_id,$project_name,
								$project_place,$project_description,$project_associates,
								$project_colaborators,$project_promotors,$project_constructor,
								$project_pdf,
								$submit));
		
//		$this->addDisplayGroup(array('project_eng','place_eng','description_eng','associates_eng',
//									'colaborators_eng','promotors_eng','constructor_eng',
//							'pdf_eng'), 'eng');
//									
//        $d1=$this->getDisplayGroup('eng');
//        $d1->setLegend('English');
//		$this->setDisplayGroupDecorators(array(
//          'FormElements',
//          'Fieldset'
//      	));
      	
      
      
     
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