<?php
class Project_Model_Ajax
{
  	public function fetchResponse($method, $strurl, $strcontainer) {
    // zend style fetch uses any js ajax integrated above
    switch($method)
    {
    	case 'post':
    		echo "<script>getAjaxResponsePost('$strurl', '$strcontainer')</script>";
    	break;
    	case 'get':
    		echo "<script>getAjaxResponse('$strurl', '$strcontainer')</script>";
    	break;
    }
  }
}
?>