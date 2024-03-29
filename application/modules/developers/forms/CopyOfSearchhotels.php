<?php

class White-Project_Form_Searchhotelscopy extends Zend_Form
{

    public function init()
    {    
    	Zend_Dojo::enableForm($this);
        
        $this->setMethod('post');
        $front = Zend_Controller_Front::getInstance();
        $this->setAction($front->getBaseUrl().'/White-Project/frontend/hotelssearchresponse');
        
        $subForm1 = new Zend_Dojo_Form_SubForm();
        $subForm1->setMethod('post');
		$subForm1->setAttribs(array(
			'name'   => 'hotels',
			'legend' => 'Hoteles',
			'dijitParams' => array(
			'title' => 'Hoteles'),
			));

		$subForm1->setDecorators(array(
			'FormElements',
			array('ContentPane', array(
				'id'          => 'contentPane',
				'dijitParams' => array(
					'tabPosition' => 'top'
				),
			)),
			'DijitForm',
		));
		
		$pobId = new Zend_Dojo_Form_Element_FilteringSelect('pobId');
		$pobId->setLabel('Destino:')
		            ->setAutoComplete(true)		            
		            ->setStoreType('dojo.data.ItemFileReadStore')
		            ->setStoreId('pob')	            
		            ->setStoreParams(array('url'=>'/White-Project/frontend/poblationlist/','clearOnClose'=>'true'))		            
		            ->setAttrib("searchAttr", "poblacion")
		            ->setAttrib("pageSize", 10)
		            //->setAttrib('onChange', 'javascript:')		            		            		            
		            ->setAttrib("hasDownArrow", "false")
		            ->setRequired(true);
				                       
		$entrada = new Zend_Dojo_Form_Element_DateTextBox('entrada');
		$entrada->setLabel('Entrada:')
				->setRequired(true)
				->addValidator('NotEmpty', true, array('messages'=>array(Zend_Validate_NotEmpty::IS_EMPTY=>'Valor requerido')))
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 76)
				->setAttrib('maxlength', 255)
                ->setOptions(array(
                                    'formatLength'   => 'long',
                                    "style"=> "width:200px; height:1.6em",
                                ));

        $salida = new Zend_Dojo_Form_Element_DateTextBox('salida');
		$salida->setLabel('Salida:')
				->setRequired(true)
                ->addValidator('NotEmpty', true, array('messages'=>array(Zend_Validate_NotEmpty::IS_EMPTY=>'Valor requerido')))
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 76)
				->setAttrib('maxlength', 255)
                ->setOptions(array(
                                    'formatLength'   => 'long',
                                    "style"=> "width:200px; height:1.6em",
                                ));
		
        $regimen = new Zend_Form_Element_Select('regimen');
		$regimen->setLabel('Régimen:')
                ->setmultiOptions(array('ALL'=>'Cualquiera', 'SA'=>'Solo alojamiento', 'DE'=>'Alojam. y desay.', 'AC'=>'Alojam. y cena', 'ME'=>'Media pensión', 'PC'=>'Pensión completa', 'TI'=>'Todo incluído'))
				->setAttrib('maxlength', 200)
				->setAttrib('size', 1)
				->setRequired(true)
                ->addValidator('NotEmpty', true, array('messages'=>array(Zend_Validate_NotEmpty::IS_EMPTY=>'Valor requerido')));

                
        $rooms = new Zend_Form_Element_Select('rooms');
		$rooms->setLabel('Habitaciones:')
                ->setmultiOptions(array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5'))
				->setAttrib('maxlength', 200)
				->setAttrib('size', 1)
				->setRequired(true)
				->setOptions(array('onChange'=>'javascript:
					getAjaxResponse("/hotels/index/search/rooms/"+dojo.byId("hotelstab-rooms").value,"roomy");'))
                ->addValidator('NotEmpty', true, array('messages'=>array(Zend_Validate_NotEmpty::IS_EMPTY=>'Valor requerido')))
				->setDecorators(array(
					'ViewHelper',
					'Description',
					'Errors',
					array(array('data'=>'HtmlTag'), array('tag' => 'dd')),
					array('Label', array('tag' => 'dt')),
					array(array('row'=>'HtmlTag'),array('tag'=>'div','style'=>'width:100px;float:left;','id'=>'div_rooms'))
				));
        $adults = new Zend_Form_Element_Select('adults');
		$adults->setLabel('Adultos:')
                ->setmultiOptions(array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4'))
				->setValue('2')
				->setAttrib('maxlength', 200)
				->setAttrib('size', 1)
				->setRequired(true)
                ->addValidator('NotEmpty', true, array('messages'=>array(Zend_Validate_NotEmpty::IS_EMPTY=>'Valor requerido')))
				->setDecorators(array(
					'ViewHelper',
					'Description',
					'Errors',
					array(array('data'=>'HtmlTag'), array('tag' => 'dd')),
					array('Label', array('tag' => 'dt')),
					array(array('row'=>'HtmlTag'),array('tag'=>'div','style'=>'width:100px;float:left;','id'=>'div_adults'))
				));
				
        $link_boys= new Default_Model_Xhtmls("searchhotels_boys");
		$link_boys->setContent("<div style='clear:both;'><a id='dialog_searchhotels_boys' href='#'>Búsqueda con niños</a></div>");

        $submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Buscar');
		   
		$subForm1->addElements(array($pobId,$entrada,$salida,
								 $regimen,$rooms,$adults,$link_boys,$submit));
				
		$entrada2 = new Zend_Dojo_Form_Element_DateTextBox('entrada2');
		$entrada2->setLabel('Entrada:')
				->setRequired(true)
				->addValidator('NotEmpty', true, array('messages'=>array(Zend_Validate_NotEmpty::IS_EMPTY=>'Valor requerido')))
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 76)
				->setAttrib('maxlength', 255)
                ->setOptions(array(
                                    'formatLength'   => 'long',
                                    "style"=> "width:200px; height:1.6em",
                                ));
		
        $salida2 = new Zend_Dojo_Form_Element_DateTextBox('salida2');
		$salida2->setLabel('Salida:')
				->setRequired(true)
                ->addValidator('NotEmpty', true, array('messages'=>array(Zend_Validate_NotEmpty::IS_EMPTY=>'Valor requerido')))
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 76)
				->setAttrib('maxlength', 255)
                ->setOptions(array(
                                    'formatLength'   => 'long',
                                    "style"=> "width:200px; height:1.6em",
                                ));
                                						 
		$subForm2 = new Zend_Dojo_Form_SubForm();
		$subForm2->setAttribs(array(
			'name'   => 'vuelos',
			'legend' => 'Vuelos',
			));
			
		$subForm2->addElements(array($entrada2,$salida2));
		
		$this->setDecorators(array(
			'FormElements',
				array('TabContainer', array(						
						'style'       => 'width: 473px; height: 298px;',						
						'dijitParams' => array(
							'tabPosition' => 'top'
						),
				)),
			'DijitForm',				
		));
		//$this->setAttrib('id', 255);
		
		$this->addSubForm($subForm1, 'hotelstab')
			 ->addSubForm($subForm2, 'flightstab');		
		
    }		
}