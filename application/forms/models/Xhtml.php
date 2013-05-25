<?php
class Forms_Models_Xhtml extends Zend_Form_Element_Xhtml
{
//	private $_content;
 	protected $_content;
 
	/**
     * Set element label
     *
     * @param  string $label
     * @return Zend_Form_Element
     */
    public function setContent($content)
    {
        $this->_content = (string) $content;
        return $this;
    }
    
	/**
     * Retrieve element label
     *
     * @return string
     */
    public function getContent()
    {
        return $this->_content;
    }
    

	public $helper = 'formText';
	
}