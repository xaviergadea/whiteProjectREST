<?php

/**
 * This is the Data Mapper class for the Banners table.
 */
class Admin_Model_Optimize
{
    /** Model_Resosurces_Table */
    protected $_table;

    /**
     * Retrieve table object
     * 
     * @return Model_Iturismo_Table
     */
    public function getTable()
    {
        if (null === $this->_table) {
            $this->_table = new Admin_Model_DbTable_Crontabs;
        }
        return $this->_table;
    }

    /**
     * Save a new entry
     * 
     * @param  array $data 
     * @return int|string
     */
    public function save(array $data)
    {
        $table  = $this->getTable();
        $fields = $table->info(Zend_Db_Table_Abstract::COLS);
        foreach ($data as $field => $value) {
            if (!in_array($field, $fields)) {
                unset($data[$field]);
            }
        }        
        return $table->insert($data);
    }
    
	/**
     * Update entry
     * 
     * @param  array $data, array|string $where SQL WHERE clause(s)
     * @return int|string
     */
    public function update(array $data, $where)
    {
		$table  = $this->getTable();
        $fields = $table->info(Zend_Db_Table_Abstract::COLS); 		
        foreach ($data as $field => $value) {
            if (!in_array($field, $fields)) {
                unset($data[$field]);
            }
        }   
         
        return $table->update($data, $where);
    }
        
	/**
     * Delete entries
     * 
     * @param  array|string $where SQL WHERE clause(s)
     * @return int|string
     */
    public function delete($where)
    {
		$table  = $this->getTable();              
        return $table->delete($where);
    }
	
	    	
    /**
     * Fetch all entries
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchEntries()
    {        
        return $this->getTable()->fetchAll('1')->toArray();
    }

    /**
     * Fetch pair id/label
     *
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchLabels()
    {
        $sql="SELECT id, label
    	      FROM wlabel";
    	$db=Zend_Registry::get('db');
    	$result = $db->fetchPairs($sql);
        return $result;
    }

 
    
    /**
     * Fetch an individual entry
     * 
     * @param  int|string $id 
     * @return null|Zend_Db_Table_Row_Abstract
     */
    public function fetchEntry($id)
    {
        $table = $this->getTable();
        $select = $table->select()->where('id = ?', $id);
        if ($table->fetchRow($select))
        	return $table->fetchRow($select)->toArray();
        else
        	return false;
    }
    
	
    
   
    
}