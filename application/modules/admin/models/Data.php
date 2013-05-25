<?php

/**
 * Admin_Model_Checks
 *
 * @category   White-Project
 * @package    Admin
 * @subpackage Model
 *
 */
class Admin_Model_Data
{

    /**
     * Hold admin configuration.
     * 
     * @access protected
     * @var array
     */
    protected $_admin_config;
    private $_db;
	
	
    public function __construct()
    {
    	$this->_admin_config = Zend_Registry::get('admin_config');
    	$this->_db=Zend_Registry::get('db');	
    }
    
	public function permissionsrestore()
    {
    	$filename=$this->_admin_config->filename->permissions;
    	$sql='';
    	$handle = gzopen($this->_admin_config->directory->script.$filename.".gz", 'r');
		while (!gzeof($handle)) {
		   $buffer = gzgets($handle, 4096);
		   $sql.=$buffer;
		}
		gzclose($handle);
		$sql_arr=explode(';',$sql);
		foreach ($sql_arr as $sql_inst) 
		{
			$sql_clean=rtrim($sql_inst);
			if(!empty($sql_clean))
				$tables = $this->_db->query($sql_inst);			
		}		
    }
    
    public function allstructure()
    {
    	$tables = $this->_db->fetchAssoc('SHOW TABLES');
    	$this->getstructure($tables,$this->_admin_config->filename->script);
    }
    
 	public function permissionsstructure()
    {    	
    	$tablestr=$this->_admin_config->permissions->tables;
    	$tables=explode(',',$tablestr); 
    	$tableobj=array();
    	foreach ($tables as $table)
    	{
    		array_push($tableobj,array('Tables_in_'.$this->_admin_config->database->name=>$table));
    	}    	   	   	
    	$this->getstructure($tableobj,$this->_admin_config->filename->permissions);	
    }
    
    public function getstructure($tables, $filename)
    {
    	
    	$SQL=Array();
    	
    	foreach($tables as $table)
    	{
    		$insert_sql = "";
    		$create=$this->_db->fetchAssoc("SHOW CREATE TABLE ".$table['Tables_in_'.$this->_admin_config->database->name]);
    		
    		$SQL[]='--'. PHP_EOL.
				   '-- Table structure for table `'.$table['Tables_in_'.$this->_admin_config->database->name].'`'. PHP_EOL.
					'--'. PHP_EOL;
    		$SQL[]='DROP TABLE IF EXISTS `'.$table['Tables_in_'.$this->_admin_config->database->name].'`;';
    		$SQL[]=$create[$table['Tables_in_'.$this->_admin_config->database->name]]["Create Table"].";";
    		
    		$selects=$this->_db->fetchAssoc("SELECT * from ".$table['Tables_in_'.$this->_admin_config->database->name]); 
    		
    		foreach($selects as $select)
    		{
    			$insert_sql .= "INSERT INTO ".$table['Tables_in_'.$this->_admin_config->database->name]." VALUES('";
    			$data=array();	
    			foreach($select as $key => $value)
    				$data[]=addslashes($value);
    			$values=implode("','",$data);
    			$insert_sql .=$values;
    			$insert_sql .= "');\n";     		
    		}
    		$SQL[] = $insert_sql; 
    	}
    	//Zend_Debug::dump(implode("\r", $SQL));
    	
	 	
		$stream = @fopen($this->_admin_config->directory->script.$filename, 'w+', false);
		if (! $stream) {
		    throw new Exception('Failed to open stream');
		}
    	
		$format  = '-- Admin DataDump' . PHP_EOL;
		$format .= '-- version 2.0' . PHP_EOL;
		$format .= '--' . PHP_EOL;
		$format .= '-- Host: localhost' . PHP_EOL;
		$format .= '-- Generation Time: %timestamp%' . PHP_EOL;
		$format .= '-- %timestamp% %priorityName% (%priority%)'.PHP_EOL;
		$format .= PHP_EOL;
		$format .= PHP_EOL;
		$format .= '%message%' . PHP_EOL;
		$formatter = new Zend_Log_Formatter_Simple($format);

    	$writer = new Zend_Log_Writer_Stream($stream);
    	$writer->setFormatter($formatter);
		$logger = new Zend_Log($writer);
		$logger->info(implode("\r", $SQL));
		
		$s = file_get_contents($this->_admin_config->directory->script.$filename); 
		file_put_contents($this->_admin_config->directory->script.$filename.".gz",gzencode($s,9));
		@fopen($this->_admin_config->directory->script.$filename, 'w+', false);
		
    	return;
    }
    
   	
	
}