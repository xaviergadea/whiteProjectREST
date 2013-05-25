<?php

class Zend_View_Helper_FormatDbDate
{

    public function formatDbDate($datetime, $format='EEEE MMMM MM, yyyy HH:mm')
    {
        $date = new Zend_Date;
        $date->set($datetime, Zend_Date::ISO_8601);
        return $date->toString($format);
    }

}