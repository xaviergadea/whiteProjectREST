<?php

class Zend_View_Helper_BaseUrlImagesFrontend
{

    protected static $baseUrl = null;

    public function baseUrlImagesFrontend()
    {
        if (!is_null(self::$baseUrl)) {
            return self::$baseUrl;
        }
        $front = Zend_Controller_Front::getInstance();
        $url = rtrim($front->getBaseUrl(), '/');
        $blog=Zend_Registry::get('blog');
        self::$baseUrl = $url.$blog->images->url;
        return self::$baseUrl;
    }

}