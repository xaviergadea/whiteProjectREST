<?php

class Zend_View_Helper_AclLink extends Zend_View_Helper_Abstract 
{

    public function aclLink($options)
    {
    	$acl = Users_Model_Acl::getInstance(); 
    	$SesOrk = new Zend_Session_Namespace('SesOrk');
		$list=$acl->listResourceByUser($SesOrk->project_user_role_id);
		$link=null;
		
    	if (!isset($options['target'])) {
            $options['target']="";
		}
		else
			$options['target']="target=\"".$options['target']."\"";
			
		if (!isset($options['class'])) {
            $options['class']="";
		}
		else
			$options['class']="class=\"".$options['class']."\"";	
			
		if (!isset($options['label'])) {
            throw new Zend_View_Exception(
                'Label must be defined'
            );
		}
		
		if($acl->isAllowed($list['role'], $options['module'].":".$options['controller'], $options['action']))
			$link="<a ".$options['class']." ".$options['target']." 
					  href=\"".$this->view->url(array('module'=>$options['module'],
													'controller'=>$options['controller'],
													'action'=>$options['action'],
													@$options['pname']=>@$options['pvalue']
													))."\"
												>".
						$options['label']."
					</a>";
		
		return $link;
		
    }  
}