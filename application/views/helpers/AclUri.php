<?php

class Zend_View_Helper_AclUri extends Zend_View_Helper_Abstract
{
    /*
     * function aclUri
     * Allows to pass more than one parameter name/value as an array. Ex:
     *   $options = array(6) {
     *     ["module"] => string(10) "localities"
     *     ["controller"] => string(5) "index"
     *     ["action"] => string(11) "addtomaindb"
     *     ["pname"] => array(2) {
     *       [0] => string(11) "id_locality"
     *       [1] => string(8) "provider"
     *     }
     *     ["pvalue"] => array(2) {
     *       [0] => string(3) "CUR"
     *       [1] => string(3) "GTA"
     *     }
     *   }
     */
    public function aclUri($options)
    {
        $url = '';
    	$acl = Users_Model_Acl::getInstance();
		$list=$acl->listResourceByUser();
        if($acl->isAllowed($list['role'], $options['module'].":".$options['controller'], $options['action']))
            $url = $this->makeUrl($options);
        return $url;
    }

    private function makeUrl($options)
    {
        $url = '';

        $parameters = array('module'=>$options['module'],
							'controller'=>$options['controller'],
							'action'=>$options['action']);

        if(is_array(@$options['pname'])) {
            for($i=0; $i<count(@$options['pname']); $i++) {
                $parameters[$options['pname'][$i]] = @$options['pvalue'][$i];
            }
        }
        else {
            $parameters[@$options['pname']] = @$options['pvalue'];
        }

		$url=$this->view->url($parameters, 'default');

		return $url;
    }
}