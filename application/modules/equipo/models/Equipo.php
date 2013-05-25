<?php

/**
 * This is the Data Mapper class for the Projects table.
 */
class Equipo_Model_Equipo
{
    /** Model_Resosurces_Table */
    protected $_table;

    /**
     * Retrieve table object
     * 
     * @return Model_Projects_Table
     */
    public function getTable()
    {
        if (null === $this->_table) {
            $this->_table = new Equipo_Model_DbTable_Equipo;
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
     * Fetch an individual entry
     * 
     * @param  int|string $id 
     * @return null|Zend_Db_Table_Row_Abstract
     */
    public function fetchEntry($id)
    {
        $table = $this->getTable();
        $select = $table->select()->where('id = ?', $id);
        return $table->fetchRow($select)->toArray();
    }
    
	public function getPathById($id)
    {
        $sql="SELECT projects.id, short_name, status,categories_id, categories.category_short
    	      FROM projects, categories
    	      WHERE projects.id=".$id." AND 
    	      		projects.categories_id=categories.id AND
    	      		status=1
    	      ";    
//    	Zend_Debug::dump($sql);die();
    	$table = $this->getTable()->getAdapter()->fetchRow($sql);
        return $table;
    }
    
	public function fetchSql($id)
    {
      	$lang=$_SESSION['default']['language'];
    	switch($lang){
    		case 'es':
    			$lang='esp';
    		break;
    		case 'ca':
    			$lang='cat';
    		break;
    		case 'en':
    			$lang='eng';
    		break;
    	}
      	$sql="SELECT equipo.id, 
				equipo.equipo_".$lang." as equipo,
				equipo.photo, 
				equipo.description_".$lang." as description 
			  FROM equipo 
    	      WHERE equipo.id=".$id."";    
//    	Zend_Debug::dump($sql);die();
    	$table = $this->getTable()->getAdapter()->fetchAssoc($sql);
        return $table;
    }
    
	public function getProjectByType($type)
    {
        
    	$sql="SELECT projects.id, short_name, status, thumbnail, images, year, area,
    	 			 presupuesto, map, categories_id, photos, 
    	 			 project_esp, place_esp, description_esp, associates_esp, 
    	 			 colaborators_esp, promotors_esp, constructor_esp, pdf_esp,
    	 			 project_cat, place_cat, description_cat, associates_cat, 
    	 			 colaborators_cat, promotors_cat, constructor_cat, pdf_cat, 
    	 			 project_eng, place_eng, description_eng, associates_eng, 
    	 			 colaborators_eng, promotors_eng, constructor_eng, pdf_eng,
    	 			 categories.category_short
    	      FROM projects, categories
    	      WHERE projects.categories_id = categories.id AND
    	      		projects.status = 1 AND
				 	categories.category_short = '".$type."'
    	      ";
//    	Zend_Debug::dump($sql);die();
    	$table = $this->getTable()->getAdapter()->fetchAssoc($sql);
        return $table;
    }
    
}