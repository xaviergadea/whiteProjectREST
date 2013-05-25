<?php

class Projects_Form_Projectscat extends Zend_Form
{

    public function init()
    {
       	// set the method for the display form to POST
        $this->setMethod('post');
        $project_id = new Zend_Form_Element_Hidden('id');
						
		$project_name = new Zend_Form_Element_Text('project_cat');
		$project_name->setLabel('Name')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 70)
				->setAttrib('maxlength', 255);
						                 
		$project_place = new Zend_Form_Element_Text('place_cat');
		$project_place->setLabel('Place')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255);

		$project_description = new Zend_Form_Element_Textarea('description_cat');
		$project_description->setLabel('Description')
				->setRequired(true)
                ->addValidator('NotEmpty', true)
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 1);
				
		$project_associates = new Zend_Form_Element_Textarea('associates_cat');
		$project_associates->setLabel('Col·laborant amb')
				->setRequired(true)
                ->addValidator('NotEmpty', true)
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setAttrib('maxlength', 255);
				
		$project_colaborators = new Zend_Form_Element_Textarea('colaborators_cat');
		$project_colaborators->setLabel('Colaborators')
				->setRequired(true)
                ->addValidator('NotEmpty', true)
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setAttrib('maxlength', 255);
				
		$project_promotors = new Zend_Form_Element_Textarea('promotors_cat');
		$project_promotors->setLabel('Promotors')
				->setRequired(true)
                ->addValidator('NotEmpty', true)
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setAttrib('maxlength', 255);
		
		$project_constructor = new Zend_Form_Element_Textarea('constructor_cat');
		$project_constructor->setLabel('Contructor')
				->setRequired(true)
                ->addValidator('NotEmpty', true)
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setAttrib('maxlength', 255);
		
		$project_pdf = new Zend_Form_Element_Text('pdf_cat');
		$project_pdf->setLabel('Pdf')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255);
                         
        $submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Add');
		
//		$catForm = new Zend_Dojo_Form_SubForm();
//        $catForm->setAttribs(array(
//            'name'   => 'slidertab',
//            'legend' => 'Slider Elements',
//        ));
//        $sliderForm->addElement(array($project_name));
		
//        $subFormEsp = new Zend_Form_SubForm();
//		$subFormEsp->setIsArray(true);
//		$subForm->addElements(array($project_name));
//		
//        $this->addSubForm($subForm, 'subform');
		$this->addElements(array($project_id,$project_name,
								$project_place,$project_description,$project_associates,
								$project_colaborators,$project_promotors,$project_constructor,
								$project_pdf,
								$submit));
		
//		$this->addDisplayGroup(array('project_cat','place_cat','description_cat','associates_cat',
//									'colaborators_cat','promotors_cat','constructor_cat',
//							'pdf_cat'), 'cat');
//									
//        $d1=$this->getDisplayGroup('cat');
//        $d1->setLegend('Catalán');
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