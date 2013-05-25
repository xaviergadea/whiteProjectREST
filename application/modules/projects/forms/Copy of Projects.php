<?php

class Projects_Form_Projects extends Zend_Form
{

    public function init()
    {
       	Zend_Dojo::enableForm($this);           
    	// set the method for the display form to POST
        $this->setMethod('post');
        $project_id = new Zend_Form_Element_Hidden('id');
		
      
        // -----------------  General elements ----------------------- //                 
        $status = new Zend_Form_Element_Select('status');
		$status->setLabel('Status')
						 ->setRequired(true)
                         ->addValidator('NotEmpty', true)
                         ->setmultiOptions(array('1'=>'active','0'=>'inactive' ))
						 ->setAttrib('maxlength', 200)
						 ->setAttrib('size', 1)
						 ;
						                     
		$project_images = new Zend_Form_Element_Textarea('images');
		$project_images->setLabel('Images')
				->setRequired(true)
                ->addValidator('NotEmpty', true)
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setDescription('comma separated')
				->setAttrib('maxlength', 255);
		
		$project_thumb = new Zend_Form_Element_Text('thumbnail');
		$project_thumb->setLabel('Thumbnail')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255);
				
		$project_year = new Zend_Form_Element_Text('year');
		$project_year->setLabel('Year')
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255);	
					
		$project_area = new Zend_Form_Element_Text('area');
		$project_area->setLabel('Area')
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255);		
				
		$project_map = new Zend_Form_Element_Text('map');
		$project_map->setLabel('Map')
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255);	
						
		$project_categori = new Zend_Form_Element_Select('categories_id');
		$project_categori->setLabel('Category')
						 ->setmultiOptions($this->_selectOptionsCategory())
						 ->setAttrib('maxlength', 200)
						 ->setAttrib('size', 1)
						 ->setRequired(true)
                         ->addValidator('NotEmpty', true);
                         
        $project_photo = new Zend_Form_Element_Text('photos');
		$project_photo->setLabel('Photos')
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255);

		// -----------------  Español elements ----------------------- //
				
		$project_name = new Zend_Form_Element_Text('project_esp');
		$project_name->setLabel('Name')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 70)
				->setAttrib('maxlength', 255);
						                 
		$project_place = new Zend_Form_Element_Text('place_esp');
		$project_place->setLabel('Place')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255);

		$project_description = new Zend_Form_Element_Textarea('description_esp');
		$project_description->setLabel('Description')
				->setRequired(true)
                ->addValidator('NotEmpty', true)
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 1);
				
		$project_associates = new Zend_Form_Element_Textarea('associates_esp');
		$project_associates->setLabel('Associates')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setAttrib('maxlength', 255);
				
		$project_colaborators = new Zend_Form_Element_Textarea('colaborators_esp');
		$project_colaborators->setLabel('Colaborators')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setAttrib('maxlength', 255);
				
		$project_promotors = new Zend_Form_Element_Textarea('promotors_esp');
		$project_promotors->setLabel('Promotors')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setAttrib('maxlength', 255);
		
		$project_constructor = new Zend_Form_Element_Textarea('constructor_esp');
		$project_constructor->setLabel('Contructor')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setAttrib('maxlength', 255);
		
		$project_pdf = new Zend_Form_Element_Text('pdf_esp');
		$project_pdf->setLabel('Pdf')
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255);

		// -----------------  Catalá elements ----------------------- //
				
		$project_namecat = new Zend_Form_Element_Text('project_cat');
		$project_namecat->setLabel('Name')
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 70)
				->setAttrib('maxlength', 255);
						                 
		$project_placecat = new Zend_Form_Element_Text('place_cat');
		$project_placecat->setLabel('Place')
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255);

		$project_descriptioncat = new Zend_Form_Element_Textarea('description_cat');
		$project_descriptioncat->setLabel('Description')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 1);
				
		$project_associatescat = new Zend_Form_Element_Textarea('associates_cat');
		$project_associatescat->setLabel('Associates')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setAttrib('maxlength', 255);
				
		$project_colaboratorscat = new Zend_Form_Element_Textarea('colaborators_cat');
		$project_colaboratorscat->setLabel('Colaborators')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setAttrib('maxlength', 255);
				
		$project_promotorscat = new Zend_Form_Element_Textarea('promotors_cat');
		$project_promotorscat->setLabel('Promotors')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setAttrib('maxlength', 255);
		
		$project_constructorcat = new Zend_Form_Element_Textarea('constructor_cat');
		$project_constructorcat->setLabel('Contructor')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setAttrib('maxlength', 255);
		
		$project_pdfcat = new Zend_Form_Element_Text('pdf_cat');
		$project_pdfcat->setLabel('Pdf')
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255);

		// -----------------  English elements ----------------------- //
		
		$project_nameeng = new Zend_Form_Element_Text('project_eng');
		$project_nameeng->setLabel('Name')
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 70)
				->setAttrib('maxlength', 255);
						                 
		$project_placeeng = new Zend_Form_Element_Text('place_eng');
		$project_placeeng->setLabel('Place')
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255);

		$project_descriptioneng = new Zend_Form_Element_Textarea('description_eng');
		$project_descriptioneng->setLabel('Description')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 1);
				
		$project_associateseng = new Zend_Form_Element_Textarea('associates_eng');
		$project_associateseng->setLabel('Associates')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setAttrib('maxlength', 255);
				
		$project_colaboratorseng = new Zend_Form_Element_Textarea('colaborators_eng');
		$project_colaboratorseng->setLabel('Colaborators')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setAttrib('maxlength', 255);
				
		$project_promotorseng = new Zend_Form_Element_Textarea('promotors_eng');
		$project_promotorseng->setLabel('Promotors')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setAttrib('maxlength', 255);
		
		$project_constructoreng = new Zend_Form_Element_Textarea('constructor_eng');
		$project_constructoreng->setLabel('Contructor')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setAttrib('maxlength', 255);
		
		$project_pdfeng = new Zend_Form_Element_Text('pdf_eng');
		$project_pdfeng->setLabel('Pdf')
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255);

		// -----------------  Getting all ----------------------- //		
				
        $submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Add');
		
		$this->addElements(array($project_id,$status,$project_images,$project_thumb,
								$project_year, $project_area,$project_map,$project_photo,
								$project_categori,
								$project_name,$project_place,$project_description,
								$project_associates,$project_colaborators,$project_promotors,
								$project_constructor,$project_pdf,
								$project_namecat,$project_placecat,$project_descriptioncat,
								$project_associatescat,$project_colaboratorscat,$project_promotorscat,
								$project_constructorcat,$project_pdfcat,
								$project_nameeng,$project_placeeng,$project_descriptioneng,
								$project_associateseng,$project_colaboratorseng,$project_promotorseng,
								$project_constructoreng,$project_pdfeng,
								$submit
								));
		
//		$this->addElements(array($submit));
//		
//		$subFormSubmit = new Zend_Form_SubForm();
//		$subFormSubmit->setIsArray(true);
//		$subFormSubmit->addElements(array($submit));
//		$this->addSubForm($subFormSubmit, 'subformsubmit');
//		
//		$subFormGen = new Zend_Form_SubForm();
//		$subFormGen->setIsArray(true);
//		$subFormGen->addElements(array($project_id,$project_images,$project_thumb,
//								$project_year, $project_area,$project_map,$project_photo,
//								$project_categori));
//		$this->addSubForm($subFormGen, 'subformgen');
//								
//		$subFormEsp = new Zend_Form_SubForm();
//		$subFormEsp->setIsArray(true);
//		$subFormEsp->addElements(array($project_name,$project_place,$project_description,
//								$project_associates,$project_colaborators,$project_promotors,
//								$project_constructor,$project_pdf));
//		$this->addSubForm($subFormEsp, 'subformesp');
//		
//		$subFormCat = new Zend_Form_SubForm();
//		$subFormCat->setIsArray(true);
//		$subFormCat->addElements(array($project_namecat,$project_placecat,$project_descriptioncat,
//								$project_associatescat,$project_colaboratorscat,$project_promotorscat,
//								$project_constructorcat,$project_pdfcat));
//		$this->addSubForm($subFormCat, 'subformcat');
//		
//		$subFormEng = new Zend_Form_SubForm();
//		$subFormEng->setIsArray(true);
//		$subFormEng->addElements(array($project_nameeng,$project_placeeng,$project_descriptioneng,
//								$project_associateseng,$project_colaboratorseng,$project_promotorseng,
//								$project_constructoreng,$project_pdfeng));
//		$this->addSubForm($subFormEng, 'subformeng');
		
		$this->addDisplayGroup(array('project_esp','place_esp','description_esp','associates_esp',
									'colaborators_esp','promotors_esp','constructor_esp',
							'pdf_esp'), 'esp');
									
        $d1=$this->getDisplayGroup('esp');
        $d1->setLegend('Español');
		$this->setDisplayGroupDecorators(array(
          'FormElements',
          'Fieldset'
      	));
      	
      	$this->addDisplayGroup(array('project_cat','place_cat','description_cat','associates_cat',
									'colaborators_cat','promotors_cat','constructor_cat',
							'pdf_cat'), 'cat');
									
        $d1=$this->getDisplayGroup('cat');
        $d1->setLegend('Català');
		$this->setDisplayGroupDecorators(array(
          'FormElements',
          'Fieldset'
      	));
      	
      	$this->addDisplayGroup(array('project_eng','place_eng','description_eng','associates_eng',
									'colaborators_eng','promotors_eng','constructor_eng',
							'pdf_eng'), 'eng');
									
        $d1=$this->getDisplayGroup('eng');
        $d1->setLegend('English');
		$this->setDisplayGroupDecorators(array(
          'FormElements',
          'Fieldset'
      	));
      	
      
      
     
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