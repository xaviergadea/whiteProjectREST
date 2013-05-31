<?php

class Zend_View_Helper_SortingLinks extends Zend_View_Helper_Abstract 
{

   
    
	public function getLink($page, $itemsPerPage, $sortField, $sortDir, $label) {
	  $q = http_build_query(array(
	      'p' => $page, 
	      'c' => $itemsPerPage,
	      's' => $sortField,
	      'd' => $sortDir,
	    )      
	  );  
	  return "<a href=\"?$q\">$label</a>";  
	}
    	
		
		
}