<?
class White-Project_Form_Searchhotelsdemo extends Zend_Dojo_Form
{
	public function init()
	{
		$this->setDecorators(array(
			'FormElements',
				array('TabContainer', array(
						'id'          => 'tabContainer',
						'style'       => 'width: 600px; height: 500px;',
						'dijitParams' => array(
						'tabPosition' => 'top'
						),
				)),
			'DijitForm',
		));
		$subForm1 = new Zend_Dojo_Form_SubForm();
		$subForm1->setAttribs(array(
			'name'   => 'textboxtab',
			'legend' => 'Text Elements',
			'dijitParams' => array(
			'title' => 'Text Elements',
			),
			));
		$subForm1->addElement(
			'ComboBox',
			'combobox',
			array(
				'label'        => 'ComboBox (select)',
				'value'        => 'blue',
				'autocomplete' => false,
				'multiOptions' => array(
				'red'    => 'Rouge',
				'blue'   => 'Bleu',
				'white'  => 'Blanc',
				'orange' => 'Orange',
				'black'  => 'Noir',
				'green'  => 'Vert',
				),
			));
		$subForm1->addElement(
			'DateTextBox',
			'datebox',
				array(
				'value' => '2008-07-05',
				'label' => 'DateTextBox',
				'required'  => true,
				)
			);
		$subForm2 = new Zend_Dojo_Form_SubForm();
		$subForm2->setAttribs(array(
			'name'   => 'toggletab',
			'legend' => 'Toggle Elements',
			));
		$subForm2->addElement(
			'NumberSpinner',
			'ns',
				array(
				'value'             => '7',
				'label'             => 'NumberSpinner',
				'smallDelta'        => 5,
				'largeDelta'        => 25,
				'defaultTimeout'    => 1000,
				'timeoutChangeRate' => 100,
				'min'               => 9,
				'max'               => 1550,
				'places'            => 0,
				'maxlength'         => 20,
				)
			);
		$subForm2->addElement(
			'CheckBox',
			'checkbox',
				array(
				'label' => 'CheckBox',
				'checkedValue'  => 'foo',
				'uncheckedValue'  => 'bar',
				'checked' => true,
				)
			);
		$subForm2->addElement(
			'RadioButton',
			'radiobutton',
				array(
				'label' => 'RadioButton',
				'multiOptions'  => array(
				'foo' => 'Foo',
				'bar' => 'Bar',
				'baz' => 'Baz',
				),
			'value' => 'bar',
			)
			);
		$this->addSubForm($subForm1, 'textboxtab')
			 ->addSubForm($subForm2, 'editortab');
	}
}
?>