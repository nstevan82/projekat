<?php
class database
{
	private $db_host ;
	private $db_user ;
	private $db_pass ;
    private $db_name ;
	private $file;
    private $result = array();
	private $con = false;  
 
public function connect($file)
        {  
            if(!$this->con)  
            {  
$fp = @fopen($file, 'r'); 
if ($fp) { 
 $array = explode("\n", fread($fp, filesize($file))); 
}
$this->dbhost=$array[0];
$this->db_user=$array[1];
@$this->db_pass=$array[2];
$this->db_name="kadrovska";
	
	            $myconn = @mysql_connect($this->db_host,$this->db_user,$this->db_pass);  
                if($myconn)  
                {   
                    $seldb = @mysql_select_db($this->db_name,$myconn);  
                    if($seldb)  
                    {  
                        $this->con = true;  
                        return true;   
                    } else  
                    {  
                        return false;   
                    }  
                } else  
                {  
                    return false;   
                }  
            } else  
            {  
                return true;   
            }  
        }  
		
		
public function disconnect()  
    {  
        if($this->con)  
        {  
            if(@mysql_close())  
            {  
                           $this->con = false;   
                return true;   
            }  
            else  
            {  
                return false;   
            }  
        }  
    }     
private function tableExists($table)  
        {  
            $tablesInDb = mysql_query("SHOW TABLES FROM ".$this->db_name." LIKE '$table'");  
			
            if($tablesInDb)  
            {  
                if(mysql_num_rows($tablesInDb)==1)  
                {  
                    return true;   
                }  
                else  
                {   
                    return false;   
                }  
            }  
        }  
public function select($table, $rows = '*', $where = null, $order = null)  
        {  
            $q = 'SELECT '.$rows.' FROM '.$table;  
            if($where != null)  
                $q .= ' WHERE '.$where;  
			
            if($order != null)  
                $q .= ' ORDER BY '.$order;  

            if($this->tableExists($table))  
           { 
            $query = @mysql_query($q); 
		
            if($query)  
            {  
                $this->numResults = mysql_num_rows($query);  
                for($i = 0; $i < $this->numResults; $i++)  
                {  
                    $r = mysql_fetch_array($query);  
                    $key = array_keys($r);   
                    for($x = 0; $x < count($key); $x++)  
                    {  
                        // alfavrednosti dozvoljene
                        if(!is_int($key[$x]))  
                        {  
                            if(mysql_num_rows($query) >= 1)  
                                $this->result[$i][$key[$x]] = $r[$key[$x]];  
                            else if(mysql_num_rows($query) < 1)  
                                $this->result = null;   
                            else  
                                $this->result[$key[$x]] = $r[$key[$x]];   
                        }  
                    }  
                }              
                return true;   
            }  
            else  
            {  
                return false;   
            }  
            }  
    else  
          return false;   
        }  
	
public function insert($table,$values,$rows = null)  
        {
		
		
            if($this->tableExists($table))  
            {  
                $insert = 'INSERT INTO '.$table;  
                if($rows != null)  
                {   	
                    $insert .= ' ('.$rows.')';   
                }  
      
                for($i = 0; $i < count($values); $i++)  
                { 
                    if(is_string($values[$i]))  
                        $values[$i] = '"'.$values[$i].'"';  
                }  
                $values = implode(',',$values);  
                $insert .= ' VALUES ('.$values.')';  
				
                $ins = @mysql_query($insert); 
	
                if($ins)  
                {  
                    return true;   
                }  
                else  
                {  
                    return false;   
                }  
            }  
        }  
		
public function delete($table,$where = null)  
        {  
            if($this->tableExists($table))  
            {  
                if($where == null)  
                {  
                    $delete = 'DELETE '.$table;   
                }  
                else  
                {  
                    $delete = 'DELETE FROM '.$table.' WHERE '.$where;   
                }  
                $del = @mysql_query($delete);  
      
                if($del)  
                {  
                    return true;   
                }  
                else  
                {  
                   return false;   
                }  
            }  
            else  
            {  
                return false;   
            }  
        }  
public function update($table,$rows,$vrednosti,$where)  
        {
            if($this->tableExists($table))  
            {  
                // PRodji kroz WHERE vrednosti
                
                for($i = 0; $i < count($where); $i++)  
                {  
                    if($i%2 != 0)  
                    {  
                        if(is_string($where[$i]))  
                        {  
                            if(($i+1) != null)  
                                $where[$i] = '"'.$where[$i].'" AND ';  
                            else  
                                $where[$i] = '"'.$where[$i].'"';  
                        }  
                    }  
                }  
                $where = implode('=',$where);  
                  
                  
                $update = 'UPDATE '.$table.' SET ';  
               // $vrednosti = array_keys($vrednosti);   
				$keys = array_keys($rows);   
                for($i = 0; $i < count($rows); $i++)  
               {  
                    if(is_string($rows[$keys[$i]]))  
                    {  
                        $update .= $rows[$keys[$i]].'="'.$vrednosti[$i].'"';  
						
                    }  
                    else  
                    {  
                        $update .=$rows[$keys[$i]].'="'.$vrednosti[$i];  
						
                    }  
                      
                    // Parse to add commas  
                    if($i != count($rows)-1)  
                    {  
                        $update .= ',';   
                    }  
                }  
                $update .= ' WHERE '.$where;  
				
                $query = @mysql_query($update);  
                if($query)  
                {  
                    return true;   
                }  
                else  
                {  
                    return false;   
                }  
            }  
            else  
            {  
                return false;   
            }  
        }  
	
public function getResult()
{
return $this->result;
}
public function displayResult()
{
	$res = $this->getResult();  
}
	
}	
?>