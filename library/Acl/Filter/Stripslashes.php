<?php
/**
 * Handle file uploads via XMLHttpRequest
 */
class Acl_Filter_StripSlashes implements Zend_Filter_Interface
{
    public function filter($value)
    {
        return get_magic_quotes_gpc() ? $this->_strip($value) : $value;
    }
 
    private function _strip($value)
    {
        return is_array($value) ? array_map(array($this, '_strip'), $value) :       stripslashes($value);
    }
 
}