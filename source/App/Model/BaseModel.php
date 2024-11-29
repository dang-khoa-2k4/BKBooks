<?php
include_once('Model/Database.php');
class BaseModel extends DataBase{
    protected $conn;
    

    function __construct() {
        $this -> conn = $this -> connect();
    }


    public function all($table ,
                        $select = ['*'],
                        $orderBy = [],
                        $limit = 100
                        )
    {
        $column = implode(',', $select);
        $orderByStr = implode(',', $orderBy);

        if ($orderByStr){
            $sql = "SELECT {$column} FROM {$table} ORDER BY {$orderByStr} LIMIT {$limit}";
        }
        else
        {
            $sql = "SELECT {$column} FROM {$table} LIMIT {$limit}";
        }
        
        $result = $this -> _query($sql);
        
        $data = [];
        while ($row = mysqli_fetch_assoc($result)){
            array_push($data, $row);
        }
        return $data;
    }

    public function find($table, $idName, $idValue){
        $sql = "SELECT * FROM {$table} WHERE {$idName} = '{$idValue}'";
        $result = $this -> _query($sql);
        return mysqli_fetch_assoc($result);
    }
    
    public function create($table, $data = []){
        $key = implode(',',array_keys($data));
        $newValueArray = array_map(function($value){
            return "'" . $value . "'";
        }, array_values($data));
        $newValue = implode(',', $newValueArray);
        $sql = "INSERT INTO {$table}({$key}) VALUES ({$newValue})";
        return $this -> _query($sql);       
    }
    public function update($table, $idName ,$idValue, $data = []){
        
        $dataSet = [];

        foreach ($data as $key => $value) {
            array_push($dataSet, "{$key} = '" . $value . "'");
        }
        $dataSetStr = implode(',',$dataSet);

        $sql = "UPDATE {$table} SET {$dataSetStr} WHERE {$idName} = '{$idValue}'";

        return $this -> _query($sql);

    }
    public function delete($table, $idName, $idValue){
        $sql = "DELETE FROM {$table} WHERE {$idName} = '{$idValue}'";
        return $this -> _query($sql);
    }
    public function _query($sql){
        return mysqli_query($this -> conn, $sql);
    }
    
    function __destruct() {
        $this -> closeDatabase($this->conn);
    }
}
?>