<?php

class Zend_View_Helper_EntryUrl
{

    public $view = null;
    
    protected static $entryUrls = array();

    public function entryUrl($entry)
    {
        if (is_array($entry)) {
            $entry = new ArrayObject($entry, ArrayObject::ARRAY_AS_PROPS);
        }
        if (!is_object($entry) || !isset($entry->title) || !isset($entry->id)
                || empty($entry->title) || empty($entry->id)) {
            throw new Zend_View_Exception(
                'Some or all of entry\'s id and title is empty'
                . 'or entry parameter is not a valid object/array'
            );
        }
        if (!preg_match("/^\d+$/", $entry->id)) {
            throw new Zend_View_Exception(
                'Entry id must be comprised only of digits'
            );
        }
    	if (isset(self::$entryUrls[$entry->id])) {
            return self::$entryUrls[$entry->id];
        }
        $front = Zend_Controller_Front::getInstance();
        
        
        $url = rtrim($front->getBaseUrl(), '/') . '/';
        $title = $this->_filterTitle($entry->title);
        $url .= $title . '-' . $entry->id;
        self::$entryUrls[$entry->id] = $url;
        return $url;
    }

    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }

    protected function _filterTitle($title)
    {
        $accents = '/&([A-Za-z]{1,2})(grave|acute|circ|cedil|uml|lig);/';
    	$string_encoded = htmlentities($title,ENT_NOQUOTES,'UTF-8');
    	$title = preg_replace($accents,'$1',$string_encoded);
        $title = preg_replace(
            array("/[^[:alnum:]\s\.\_!;,\+\-\%]/", "/[\s]+/"),            
            array('', '-'), $title
        );
        return $title;
        //return $this->view->transliterate($title);		// STRANGE PROBLEM????
    }
}