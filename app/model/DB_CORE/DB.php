<?php

# require_once 'PDO_Value_Binder.php';

namespace App\model\DB_CORE;
use App\model\DB_CORE\PDO_Value_Binder;

class DB extends PDO_Value_Binder{ 

	 protected $pdo;
     private $host = DB_HOST;
     private $user = DB_USER;
     private $pass = DB_PASS;
     private $dbname = DB_NAME;
     
     /*
     public function __construct()
     {
        $this->conn();
     } */

     protected function conn()
     {          
          $dns = 'mysql:host='. $this->host. ';dbname='. $this->dbname. ';charset=utf8';
        
          $this->pdo = new \PDO($dns, $this->user, $this->pass);	 
          $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
          $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);    
          
          return $this->pdo; 
     }
     
     
    # Conexión a mysqli
    public function mysqli_conn(){
        return mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);
    }     
    
    public function query($query)
    {
        $db = $this->mysqli_conn();
        $booleano = $db->real_query('SELECT * FROM usuarios');
        if ($booleano){
            $resultado = $db->use_result(); //Uso el resultado de la última consulta
            $personas = $resultado->fetch_object();
            while ($personas != null){ //Recorro el resultado
               // echo $personas->id." ".$personas->nombre." ".$personas->apellido."";
                $rs[] = $resultado->fetch_object();
            }
            
            return $rs;
            
            $resultado->free(); //Libero de la memoria
            echo "";
        }

exit;
        
        
       $resultado = $this->mysqli_conn()->query($query);
       $personas = $resultado->fetch_object();
       
        while ($personas != null){ //Recorro el resultado
            echo $personas->DOC_ID." <br>";
            //$personas = $resultado->fetch_object();
        }
        $resultado->free(); //Libero de la memoria        
        
    }


    /* insert - ingresa un registro en la tabla*/
    public function insert($table, $dataInsert)
    {           
        $fields = implode(', ', array_keys($dataInsert));   
        $binds = ':'. implode(', :', array_keys($dataInsert)); 

        try 
        {
            $this->conn();
            $stm = $this->pdo->prepare("INSERT INTO $table ($fields) VALUES($binds)");    
            self::bindValues($stm, $dataInsert);            
            $stm->execute();    
            
            return $this->pdo->lastInsertId();
        } 
        catch (\PDOException $e) 
        {
            self::setErrorPDO($e->getMessage());
            return FALSE;  
        }        
    }   
    
    public function insertDB($table) 
    {
            $this->conn();
            $sql = "INSERT INTO $table "
                . "(" . implode(', ', array_keys($doc)) . ")"
                . " VALUES (?,?,?,?,?)";

            $new_array = explode(',', implode(',', $doc));
            $stm = $this->pdo->prepare($sql);
            $stm->execute($new_array);
            
            return $this->pdo->lastInsertId();
     }

        /* setQuery: ejecuta la consulta Sql que recibe como parametro
       $fetch: positivo para que retorne los resultados de la consulta       
       Ej. obterner los resultados de la tabla

       debe ser negativo cuando por ej. se borra una fila ya que no se
       está consultando sino eliminando...
    */
    public function setQuery($query, $fetch=TRUE) 
    {		       
        try 
        {           
            $this->conn();            
            $stmt = $this->pdo->query($query);
            return $fetch ? $stmt->fetch() : TRUE;     
        } 
        catch (\PDOException $e) 
        {
            self::setErrorPDO($e->getMessage());
            return FALSE;  
        }
    }	


    /* updateWhere: actualiza con una o múltiples condiciones */
    public function updateWhere($table, $dataInsert, $where)
    {   
        $j = 1;
        $ssql = ''; 
        foreach($dataInsert as $key => $value) { $ssql .= "$key=:$key,"; }        
        $ssql = rtrim($ssql, ',');

        foreach($where as $key => $value)
        {
            $dataInsert[$key] = $value;

            if($j == 1) { $ssql .= " WHERE $key=:$key"; }
            else { $ssql .= " AND $key=:$key"; }    
            $j++;        
        }           

        $sql = "UPDATE $table SET $ssql";

        try 
        {           
            $this->conn(); 
            $stm = $this->pdo->prepare($sql);                
            $stm->execute($dataInsert);                
            return TRUE;
        } 
        catch (\PDOException $e) 
        {   return $sql;
            self::setErrorPDO($e->getMessage());
            return FALSE;  
        }           

    }       
    

        
    /* update => actualiza un registro */
    public function update($table, $array, $index) 
    {
        $cols = $binds = '';    
        foreach ($array as $key => $data)
        {
		   if($key != $index){ $cols .= $table.'_'. $key. '=?,';  }           
           $update[] = $data;
        }
        
        try 
        {        
            $this->conn();    
            $sql = "UPDATE  `$table` SET " . rtrim($cols, ',') . " WHERE $index=?";
            return $this->pdo->prepare($sql)->execute($update); 
        } 
        catch (\PDOException $e) 
        {
            self::setErrorPDO($e->getMessage());
            return FALSE;  
        }
       
    }
	
    /* delete - borra un registro de la tabla: "$table" con el id: "$id"
       retorna: boolean  */
    public function delete($table, $idArray) 
    {		
		foreach ($idArray as $key => $id){
			$field_id = $key;
		}
		
        try 
        {
            $this->conn();
            $stm = $this->pdo->prepare("DELETE FROM $table WHERE idArray = ?");
            return $stm->execute([$id]);
        } 
        catch (\PDOException $e) 
        {
            self::setErrorPDO($e->getMessage());
            return FALSE;  
        }
    }
	
	
    /* getRow - retornas un registro de la tabla: "$table"
       retorna: resultados de la consulta */
    public function getRow($table, $idArray) 
    {	
		foreach ($idArray as $key => $id){ $field = $key; }		

        try 
        {      
            $this->conn();      
            $stm = $this->pdo->prepare("SELECT * FROM $table WHERE $field = ? LIMIT 1");
            $stm->execute([$id]);
			
			return $stm->fetch();
        } 
        catch (\PDOException $e) 
        {
            self::setErrorPDO($e->getMessage());
            return FALSE;  
        }
    }	


    /* getRows - retornas los registros de la tabla: "$table"
       retorna: resultados de la consulta */
       public function getRows($table, $query=null) 
       {	
           try 
           {      
               $this->conn();      
               $stm = $this->pdo->prepare($query ? : "SELECT * FROM $table");  
               $stm->execute();             
               return $stm->fetchAll();
           } 
           catch (\PDOException $e) 
           {
              self::setErrorPDO($e->getMessage());
              return FALSE;  
           }
       }	    

       
     public function sp()
     {
        $published_year = 2010;
        $sql = 'CALL get_books(:published_year)';
        
        try {
            $this->conn();
            $statement = $this->pdo->prepare($sql);        
            $statement->bindParam(':published_year', $published_year, \PDO::PARAM_INT);        
            $statement->execute();
        
            return $statement->fetchAll(\PDO::FETCH_ASSOC);        
        } 
        catch (\PDOException $e) 
        {
            self::setErrorPDO($e->getMessage());
            return FALSE;  
        }

     }


    /* guarda en sesión el último error: Solo para ambiente de desarrollo */
    public static function setErrorPDO($error)
    {/*
        if(ENVIROMENT == 'development'){
            $_SESSION['pdo_error'] = $error;
        }       */
    }  
    
    
    function datatables_search($sort_columns, $search, $unset = 0)
    {
        $sql = '';
        $i = 0;
        $exclude = $unset ? array_slice($sort_columns, -$unset) : [];
        
        if ($search = trim($search))
        { 
            foreach ($sort_columns as $item)
            {
                if (! in_array($item, $exclude)) {
                    if ($i == 0) { $sql .= " WHERE $item LIKE '%$search%'"; } 
                    else { $sql .= " OR $item LIKE '%$search%'";  }  
                    $i++;
                }
            }
        }
        
        return $sql;
    }    
    
       
    
    

} // End of class




    /* insert - ingresa un registro en la tabla*/
    /*
    public static function insert($table, $array)
    {   
        $cols = $binds = '';    
        foreach ($array as $key => $data){
            $cols .= $table.'_'.$key.',';
            $binds .= '?,';
            $insert[] = $data;
        }               

        try 
        {
            $sql = "INSERT INTO `$table` (" . rtrim($cols, ',') . ") VALUES (" . rtrim($binds, ',') .")";     
            return $this->pdo->prepare($sql)->execute($insert);             
        } 
        catch (\PDOException $e) 
        {
            self::setErrorPDO($e->getMessage());
            return FALSE;  
        }
    }   */
    