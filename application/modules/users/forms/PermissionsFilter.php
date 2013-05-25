<?php

class Users_Form_PermissionsFilter extends Zend_Form
{
	protected $_zfip;

    public function init()
    {
  		Zend_Session::namespaceUnset('Zfip');
        $this->_zfip = new Zend_Session_Namespace('Zfip');

		$resource_uid = new Zend_Form_Element_Select('resource_uid');
		$resource_uid->setLabel('Resource')
						 ->setmultiOptions($this->_selectOptionsResources())
						 ->setAttrib('maxlength', 200)
						 ->setAttrib('size', 1)
						 ->setRequired(true)
                     	 ->setOptions(array(
                                 'onChange'=>'javascript:document.getElementById("searchForm").submit();',
                                 "style"=> "margin-top:-0px;",
                                 'class'=>'inline'
                             ))
                         ;

        $resource_uid->getDecorator('Label')->setOption('class', 'inline');

        $this->setAttrib('id', 'searchForm');

		$this->addElements(array($resource_uid));
    }

	protected function _selectOptionsResources()
    {
        $sql="SELECT uid, resource
    	      FROM acl_resources
    	      ORDER BY resource";
    	$db=Zend_Registry::get('db');
        $result = array('-' => '-') + $db->fetchPairs($sql);
    	return $result;
    }

}