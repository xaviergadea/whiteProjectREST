<?php

class Zend_View_Helper_NotImage
{

    protected static $noImage = null;

    public function notImage()
    {
        if (!is_null(self::$noImage)) {
            return self::$noImage;
        }
        $front = Zend_Controller_Front::getInstance();
        $url = rtrim($front->getBaseUrl(), '/');
        $equipo_config=Zend_Registry::get('equipo_config');
        self::$noImage = $url.$equipo_config->images->noimage;
        return self::$noImage;
    }

}