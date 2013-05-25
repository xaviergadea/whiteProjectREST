<?php

class Projects_Form_Projects extends Zend_Form
{
	
	private $_projects = array();
	
    public function init()
    {
       	Zend_Dojo::enableForm($this);
       	$this->_projects = Zend_Registry::get('projects_config');	
    	$destination=realpath($this->_projects->images->path);
        
//       	$array=array();       	
//        $this->setElementsBelongTo($array);       
    	// set the method for the display form to POST
        $this->setMethod('post');
        $project_id = new Zend_Form_Element_Hidden('id');
        $project_id->removeDecorator('label');
		
      
        // -----------------  General elements ----------------------- //                 
        $project_short = new Zend_Form_Element_Text('short_name');
		$project_short->setLabel('Short Name')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text-input medium-input'))
				;
        		
        $status = new Zend_Form_Element_Select('status');
		$status->setLabel('Status')
						 ->setRequired(true)
                         ->addValidator('NotEmpty', true)
                         ->setmultiOptions(array('1'=>'active','0'=>'inactive' ))
						 ->setAttrib('maxlength', 200)
						 ->setAttrib('size', 1)
						 ;
				
		$project_year = new Zend_Form_Element_Text('year');
		$project_year->setLabel('Year')
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text-input medium-input'))
				;	
					
		$project_area = new Zend_Form_Element_Text('area');
		$project_area->setLabel('Area')
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addFilter(new Acl_Filter_StripSlashes())
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text-input medium-input'))
				;	
					
		$project_presupuesto = new Zend_Form_Element_Text('presupuesto');
		$project_presupuesto->setLabel('Presupuesto')
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text-input medium-input'))
				;
						
		$project_map = new Zend_Form_Element_Text('map');
		$project_map->setLabel('Map')
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text-input medium-input'))
				;	
						
		$project_categori = new Zend_Form_Element_Select('categories_id');
		$project_categori->setLabel('Category')
						 ->setmultiOptions($this->_selectOptionsCategory())
						 ->setAttrib('maxlength', 200)
						 ->setAttrib('size', 1);
                         
        $project_photo = new Zend_Form_Element_Text('photos');
		$project_photo->setLabel('Photos')
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text-input medium-input'))
				;

		// -----------------  Gallery elements ----------------------- //
		
		$imagen_path = new Zend_Form_Element_File('imagen_path');
		$imagen_path->setLabel('Image (512kb size, jpg,png,gif)')
                ->setDestination($destination)
                ->addFilter('StripTags')
				->addFilter('StringTrim')
                ->addValidator('NotExists', false, array($destination))
				->addValidator('Count', false, array(1))
				->addValidator('Extension', true, array('jpg,png,gif'))
				->addValidator('Size', false, array(512000))				
				;		  
		
		$imagen_texto = new Zend_Form_Element_Text('imagen_texto');
		$imagen_texto->setLabel('Description')
                ->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text-input medium-input'))
				;
		
		$project_thumb = new Zend_Form_Element_Text('thumbnail');
		$project_thumb->setLabel('Thumbnail')
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text-input medium-input'))
				;
						
		$project_images = new Zend_Form_Element_Textarea('images');
		$project_images->setLabel('Images')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setDescription('comma separated')
				->setAttrib('maxlength', 255)
				->setOptions(array('path'=>'text-input medium-input'))
				->setDecorators(array(array('ViewScript', array(
				    'viewScript' => 'forms/_element_photogallery.phtml'
				))));
						
		// -----------------  Español elements ----------------------- //
				
		$project_name = new Zend_Form_Element_Text('project_esp');
		$project_name->setLabel('Nombre')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 70)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text-input medium-input'))
				;
						                 
		$project_place = new Zend_Form_Element_Text('place_esp');
		$project_place->setLabel('Lugar')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text-input medium-input'))
				;

		$project_description = new Zend_Form_Element_Textarea('description_esp');
		$project_description->setLabel('Descripción')
				->setRequired(true)
                ->addValidator('NotEmpty', true)
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 1);
				
		$project_prize = new Zend_Form_Element_Textarea('premios_esp');
		$project_prize->setLabel('Premios')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setAttrib('maxlength', 255);
		
		$project_client= new Zend_Form_Element_Textarea('cliente_esp');
		$project_client->setLabel('Cliente')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setAttrib('maxlength', 255);
				
						
		$project_associates = new Zend_Form_Element_Textarea('associates_esp');
		$project_associates->setLabel('Asociados')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36);
				
		$project_colaborators = new Zend_Form_Element_Textarea('colaborators_esp');
		$project_colaborators->setLabel('Colaborando con')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36);
				
		$project_consultors = new Zend_Form_Element_Textarea('consultors_esp');
		$project_consultors->setLabel('Consultores')
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
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text-input medium-input'))
				;

		// -----------------  Catalá elements ----------------------- //
				
		$project_namecat = new Zend_Form_Element_Text('project_cat');
		$project_namecat->setLabel('Nom')
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 70)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text-input medium-input'))
				;
						                 
		$project_placecat = new Zend_Form_Element_Text('place_cat');
		$project_placecat->setLabel('Lloc')
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text-input medium-input'))
				;

		$project_descriptioncat = new Zend_Form_Element_Textarea('description_cat');
		$project_descriptioncat->setLabel('Descripció')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 1);
				
		$project_prizecat = new Zend_Form_Element_Textarea('premios_cat');
		$project_prizecat->setLabel('Premis')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setAttrib('maxlength', 255);
		
		$project_clientcat= new Zend_Form_Element_Textarea('cliente_cat');
		$project_clientcat->setLabel('Client')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setAttrib('maxlength', 255);
				
						
		$project_associatescat = new Zend_Form_Element_Textarea('associates_cat');
		$project_associatescat->setLabel('Associats')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36);
				
		$project_colaboratorscat = new Zend_Form_Element_Textarea('colaborators_cat');
		$project_colaboratorscat->setLabel('Col·laborant amb')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36);
				
		$project_consultorscat = new Zend_Form_Element_Textarea('consultors_cat');
		$project_consultorscat->setLabel('Consultors')
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
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text-input medium-input'))
				;

		// -----------------  English elements ----------------------- //
		
		$project_nameeng = new Zend_Form_Element_Text('project_eng');
		$project_nameeng->setLabel('Name')
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 70)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text-input medium-input'))
				;
						                 
		$project_placeeng = new Zend_Form_Element_Text('place_eng');
		$project_placeeng->setLabel('Place')
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setAttrib('size', 56)
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text-input medium-input'))
				;

		$project_descriptioneng = new Zend_Form_Element_Textarea('description_eng');
		$project_descriptioneng->setLabel('Description')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 1);
				
		$project_prizeeng = new Zend_Form_Element_Textarea('premios_eng');
		$project_prizeeng->setLabel('Prize')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setAttrib('maxlength', 255);
		
		$project_clienteng= new Zend_Form_Element_Textarea('cliente_eng');
		$project_clienteng->setLabel('Client')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36)
				->setAttrib('maxlength', 255);
				
						
		$project_associateseng = new Zend_Form_Element_Textarea('associates_eng');
		$project_associateseng->setLabel('Associates')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36);
				
		$project_colaboratorseng = new Zend_Form_Element_Textarea('colaborators_eng');
		$project_colaboratorseng->setLabel('Collaborating with')
				//->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 36);
				
		$project_consultorseng = new Zend_Form_Element_Textarea('consultors_eng');
		$project_consultorseng->setLabel('Consultors')
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
				->setAttrib('maxlength', 255)
				->setOptions(array('class'=>'text-input medium-input'))
				;

		// -----------------  Getting all ----------------------- //		
				
        $submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Add');
		
		$this->addElements(array($submit));
		
		$subFormSubmit = new Zend_Form_SubForm();
		$subFormSubmit->setIsArray(false)
					  ->removeDecorator('label');
		$subFormSubmit->addElements(array($submit));
		$this->addSubForm($subFormSubmit, 'subformsubmit');
		
		// -----------------  General elements ----------------------- //
		$subFormGen = new Zend_Form_SubForm();
		$subFormGen->setIsArray(false)
				   ->removeDecorator('DtDdWrapper');
				   
		
		$subFormGen->addElements(array($project_id,$project_short,
								$project_year, $project_area,$project_presupuesto,$project_map,
								$project_photo,$project_categori,$status));
		$this->addSubForm($subFormGen, 'subformgen');
		
		// -----------------  Gallery elements ----------------------- //
		$subFormGal = new Zend_Form_SubForm();
		$subFormGal->setIsArray(false)
					->removeDecorator('DtDdWrapper');
		$subFormGal->addElements(array($project_images));
		$this->addSubForm($subFormGal, 'subformgal');
		
		// -----------------  Español elements ----------------------- //
		$subFormEsp = new Zend_Form_SubForm();
		$subFormEsp->setIsArray(false)
					 ->removeDecorator('DtDdWrapper');
		$subFormEsp->addElements(array($project_name,$project_place,$project_description,
									$project_prize,$project_client,
									$project_associates,$project_colaborators,
									$project_consultors,$project_constructor,
									$project_pdf));
		$this->addSubForm($subFormEsp, 'subformesp');
		
		// -----------------  Catalá elements ----------------------- //
		$subFormCat = new Zend_Form_SubForm();
		$subFormCat->setIsArray(false)
		->removeDecorator('DtDdWrapper');
		$subFormCat->addElements(array($project_namecat,$project_placecat,$project_descriptioncat,
									$project_prizecat,$project_clientcat,
									$project_associatescat,$project_colaboratorscat,
									$project_consultorscat,$project_constructorcat,
									$project_pdfcat));
		$this->addSubForm($subFormCat, 'subformcat');
		
		// -----------------  English elements ----------------------- //
		$subFormEng = new Zend_Form_SubForm();
		$subFormEng->setIsArray(false)
		->removeDecorator('DtDdWrapper');
		$subFormEng->addElements(array($project_nameeng,$project_placeeng,$project_descriptioneng,
									$project_prizeeng,$project_clienteng,
									$project_associateseng,$project_colaboratorseng,
									$project_consultorseng,$project_constructoreng,
									$project_pdfeng));
		$this->addSubForm($subFormEng, 'subformeng');
      
     
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