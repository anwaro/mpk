<?php


class Database extends PDO
{
    
    public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS)
    {
        // if  use msql
        //try{
            
            //if PDO drivers are installed
            parent::__construct($DB_TYPE.':host='.$DB_HOST.';dbname='.$DB_NAME, $DB_USER, $DB_PASS);
            
            
        /*}catch (PDOException $e){
            echo "Page can't connect with database <br>"
            . "Please reload page";            
            exit();
        } */     
		
        // if use sqlite
        //parent::__construct('sqlite:'.DB_NAME_SQLITE);
    }
    
    /**
     * select
     * @param string $sql An SQL string
     * @param array $array Paramters to bind
     * @param constant $fetchMode A PDO Fetch mode
     * @return mixed
     */
    public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
    {
        $sth = $this->prepare($sql);
        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }
        
        $sth->execute(); 
        
        return $sth->fetchAll($fetchMode);
    }
    
    /**
     * insert
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     */
    public function insert($table, $data)
    {
        ksort($data);
        
        $fieldNames = implode('`, `', array_keys($data));
        $fieldValues = ':' . implode(', :', array_keys($data));
        
        $sth = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");
        
        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        
        $sth->execute();
    }
    
    /**
     * update
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     * @param string $where the WHERE query part
     */
    public function update($table, $data, $where)
    {
        ksort($data);
        
        $fieldDetails = NULL;
        foreach($data as $key=> $value) {
            $fieldDetails .= "`$key`=:$key,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');
        
        $sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");
        //if you want see a db quey
        //$str = "UPDATE $table SET $fieldDetails WHERE $where";
        
        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", "$value");
            //$str = str_replace(":$key", $value, $str);
        }
        
        $sth->execute();
        // it is completly db query
        //echo $str;
    }
    
    /**
     * delete
     * 
     * @param string $table
     * @param string $where
     * @param integer $limit
     * @return integer Affected Rows
     */
    public function delete($table, $where, $limit = 1)
    {
        return $this->exec("DELETE FROM $table WHERE $where LIMIT $limit");
    }
   
    
    /**
     * Execute sql query
     * 
     * @param string $param Sql query
     * @param bool $convert Convert string to array
     * @param int $fetchMode
     * @return array
     */
    public function exe($param, $convert = 0, $fetchMode = PDO::FETCH_ASSOC) {
        //echo $param;
        
        
        $sth = $this->query($param);
        $data = $sth->fetchAll($fetchMode);
                
        
        if($convert == 1){
            return $this->result_array($data);
        }
        else{
            return $this->array_value_recursive($data);            
        }
        
    }
    /**
     * Convert result of pgsql function to array
     * 
     * @param array $data Array of string ( "(x,x,x,x)")
     * @return $array Array
     */
    
    public function result_array($data) {
        $newData = [];
        foreach ($data as $row) {
            $row_reset = str_replace(['"', "(", ")"], " ",reset($row));            
            array_push($newData, explode(',', $row_reset));
            
        }
        return $newData;
        
    }
    
    /**
    * Convert associative array to value array recursive
    *
    * @param $arr null|string|array
    * @return null|string|array
    */
    private function array_value_recursive($arr){
        if(gettype ($arr) == "array"){
            $arr = array_values ($arr);
            for($i=0; $i<count($arr);$i++){
                $arr[$i]= $this->array_value_recursive($arr[$i]);
            }
            return $arr;
        }
        else {
            return $arr;
        }

    }
    
}