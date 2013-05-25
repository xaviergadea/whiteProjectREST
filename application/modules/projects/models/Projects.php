<?php

/**
 * This is the Data Mapper class for the Projects table.
 */
class Projects_Model_Projects
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
            $this->_table = new Projects_Model_DbTable_Projects;
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
    
	public function fetchEntriesSql()
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
      	$sql="SELECT projects.id, short_name, status, thumbnail, images, year, area,
    	 			 presupuesto, map, categories_id, photos, 
    	 			 project_esp as project_esp, project_".$lang." as project, place_".$lang." as place, 
    	 			 description_".$lang." as description,
    	 			 premios_".$lang." as premio, cliente_".$lang." as cliente,
    	 			 associates_".$lang." as associates,
    	 			 colaborators_".$lang." as colaborators, 
    	 			 consultors_".$lang." as consultors,
    	 			 constructor_".$lang." as constructor, 
    	 			 pdf_".$lang." as pdf,
    	 			 categories.category_short, categories.category_esp
    	      FROM projects, categories
    	      WHERE projects.categories_id=categories.id 
    	      ";    
//    	Zend_Debug::dump($sql);die();
    	$table = $this->getTable()->getAdapter()->fetchAssoc($sql);
        return $table;
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
      	$sql="SELECT projects.id, short_name, status, thumbnail, images, year, area,
    	 			 presupuesto, map, categories_id, photos, 
    	 			 project_".$lang." as project, place_".$lang." as place, 
    	 			 description_".$lang." as description,
    	 			 premios_".$lang." as premio, cliente_".$lang." as cliente,
    	 			 associates_".$lang." as associates,
    	 			 colaborators_".$lang." as colaborators, 
    	 			 consultors_".$lang." as consultors,
    	 			 constructor_".$lang." as constructor, 
    	 			 pdf_".$lang." as pdf,
    	 			 categories.category_short
    	      FROM projects, categories
    	      WHERE projects.id=".$id." AND 
    	      		projects.categories_id=categories.id AND
    	      		status=1
    	      ";    
//    	Zend_Debug::dump($sql);die();
    	$table = $this->getTable()->getAdapter()->fetchAssoc($sql);
        return $table;
    }
    
	public function getProjectByType($type)
    {
        
    	$sql="SELECT projects.id, short_name, status, thumbnail, images, year, area,
    	 			 presupuesto, map, categories_id, photos, 
    	 			 project_esp, place_esp, description_esp, associates_esp, 
    	 			 colaborators_esp, cliente_esp, constructor_esp, pdf_esp,
    	 			 project_cat, place_cat, description_cat, associates_cat, 
    	 			 colaborators_cat, cliente_cat, constructor_cat, pdf_cat, 
    	 			 project_eng, place_eng, description_eng, associates_eng, 
    	 			 colaborators_eng, cliente_eng, constructor_eng, pdf_eng,
    	 			 categories.category_short
    	      FROM projects, categories
    	      WHERE projects.categories_id = categories.id AND
    	      		projects.status = 1 AND
				 	categories.category_short = '".$type."' 
			  ORDER BY year DESC
    	      ";
//    	Zend_Debug::dump($sql);die();
    	$table = $this->getTable()->getAdapter()->fetchAssoc($sql);
        return $table;
    }
    
	public function getProjectPrizes()
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
    	$sql="SELECT projects.id, short_name, status, thumbnail, images, year, area,
    	 			 presupuesto, map, categories_id, photos, 
    	 			 project_".$lang." as project, place_".$lang." as place, 
    	 			 description_".$lang." as description,
    	 			 premios_".$lang." as premio, cliente_".$lang." as cliente,
    	 			 associates_".$lang." as associates,
    	 			 colaborators_".$lang." as colaborators, 
    	 			 consultors_".$lang." as consultors,
    	 			 constructor_".$lang." as constructor, 
    	 			 pdf_".$lang." as pdf,
    	 			 categories.category_short
    	      FROM projects, categories
    	      WHERE projects.categories_id=categories.id AND
    	      		status=1 
    	      ";    
//    	Zend_Debug::dump($sql);die();
    	$table = $this->getTable()->getAdapter()->fetchAssoc($sql);
        return $table;
    }
    
	public function getSearchResponse($text)
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
    	$sql="SELECT projects.id, short_name, status, thumbnail, images, year, area,
    	 			 presupuesto, map, categories_id, photos, 
    	 			 project_".$lang." as project, place_".$lang." as place, 
    	 			 description_".$lang." as description,
    	 			 premios_".$lang." as premio, cliente_".$lang." as cliente,
    	 			 associates_".$lang." as associates,
    	 			 colaborators_".$lang." as colaborators, 
    	 			 consultors_".$lang." as consultors,
    	 			 constructor_".$lang." as constructor, 
    	 			 pdf_".$lang." as pdf,
    	 			 categories.category_short as category_short
    	      FROM projects, categories
    	      WHERE projects.categories_id=categories.id AND
    	      		status=1 AND (
    	      		UCASE(project_esp) LIKE UCASE('%".$text."%') OR
    	      		UCASE(place_esp) LIKE UCASE( '%".$text."%') OR
    	      		UCASE(description_esp) LIKE UCASE( '%".$text."%') OR
    	      		UCASE(premios_esp) LIKE UCASE( '%".$text."%') OR
    	      		UCASE(cliente_esp) LIKE UCASE( '%".$text."%') OR
    	      		UCASE(associates_esp) LIKE UCASE( '%".$text."%') OR
    	      		UCASE(consultors_esp) LIKE UCASE( '%".$text."%') OR
    	      		UCASE(constructor_esp) LIKE UCASE( '%".$text."%') OR
    	      		UCASE(project_cat) LIKE UCASE( '%".$text."%') OR
    	      		UCASE(place_cat) LIKE UCASE( '%".$text."%') OR
    	      		UCASE(description_cat) LIKE UCASE( '%".$text."%') OR
    	      		UCASE(premios_cat) LIKE UCASE( '%".$text."%') OR
    	      		UCASE(cliente_cat) LIKE UCASE( '%".$text."%') OR
    	      		UCASE(associates_cat) LIKE UCASE( '%".$text."%') OR
    	      		UCASE(consultors_cat) LIKE UCASE( '%".$text."%' ) OR
    	      		UCASE(constructor_cat) LIKE UCASE( '%".$text."%') OR    	      		
    	      		UCASE(project_eng) LIKE UCASE( '%".$text."%') OR
    	      		UCASE(place_eng) LIKE UCASE( '%".$text."%') OR
    	      		UCASE(description_eng) LIKE UCASE( '%".$text."%') OR
    	      		UCASE(premios_eng) LIKE UCASE( '%".$text."%') OR
    	      		UCASE(cliente_eng) LIKE UCASE( '%".$text."%') OR
    	      		UCASE(associates_eng) LIKE UCASE( '%".$text."%') OR
    	      		UCASE(consultors_eng) LIKE UCASE( '%".$text."%') OR
    	      		UCASE(constructor_eng) LIKE UCASE( '%".$text."%')
    	      		)

    	      ";    
//    	Zend_Debug::dump($sql);die();
    	$table = $this->getTable()->getAdapter()->fetchAssoc($sql);
        return $table;
    }
    
	public function appendImage($image,$id)
    {
		$info=$this->fetchEntry($id);
		$images=$info['images'];		
		$arr=explode(',',$images);
		$arr2=array();
		foreach($arr as $key => $value)
			if($value!='')array_push($arr2,$value);			
		if($image!='' and $image!=null)array_push($arr2,$image);
		$data=implode(',',$arr2);		
		$arr3=array('images'=>$data);
		return $this->update($arr3, 'id = '. (int)$id);
    }
    
	public function removeImage($image, $id)
    {
		$info=$this->fetchEntry($id);
		$images=$info['images'];		
		$array_fotos=explode(",",$images);
		$out=array();
		foreach($array_fotos as $key => $value)
		{
			if($value!=$image)array_push($out,$value);
		}
		$out=implode(",", $out);
		$update=array('images'=>$out);
		
		$path=$this->getPathById($id);
		$this->update($update, 'id = '. (int)$id);
		unlink(APPLICATION_PATH.'/../public/assets/proyectos/'.$path->category_short.'/'.$path->short_name.'/'.$image);
		return;
    }
    
	public function getCategoryById($id)
    {
        
    	$sql="SELECT categories.id, 
					categories.category_eng, 
					categories.category_esp, 
					categories.category_cat, 
					categories.category_short
				FROM categories
    	      WHERE categories.id = '".$id."'
    	      ";
//    	Zend_Debug::dump($sql);die();
    	$table = $this->getTable()->getAdapter()->fetchAssoc($sql);
        return $table;
    }
    
   public function rrmdir($dir) 
   { 
     if (is_dir($dir)) { 
     $objects = scandir($dir); 
     foreach ($objects as $object) { 
       if ($object != "." && $object != "..") { 
         if (filetype($dir."/".$object) == "dir") $this->rrmdir($dir."/".$object); else unlink($dir."/".$object); 
       } 
     } 
     reset($objects); 
     rmdir($dir); 
   }
   }
   
   public function cleanFileName($filename) 
   { 
        $dodgychars = "[^0-9a-zA-z()_-]"; // allow only alphanumeric, underscore, parentheses and hyphen
        $filename = preg_replace("/^[.]*/","",$filename); // lose any leading dots
		$filename = preg_replace("/[.]*$/","",$filename); // lose any trailing dots
		$filename = preg_replace("/$dodgychars/","_",$filename); // replace dodgy characters
		$filename=preg_replace('/[^0-9a-zа-яіїё\`\~\!\@\#\$\%\^\*\(\)\; \,\.\'\/\_\-]/i', '-',$filename);
	    return $filename;
   } 
	
    
}