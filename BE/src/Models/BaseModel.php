<?php
abstract class BaseModel{
    /*
    * @var PDO
    */
    static $pdo = null;

    /**
     * The name of the talbe in the databse that the model binds
     * @var string
    */
    public $table;

    /**
     * The name of schema in the database that the model binds
     * @var string
     */
    public $rows;

    /**
     * The model construct
     */
    public function __construct(){
        // if($this->pdo == null){
        //     require_once '../src/config.php';
        //     $this->pdo = $pdo;
        // }
    }

    /**
     * Abstract method to get all data from the table
     */

    public function getAll(){
        $stmt = self::$pdo->prepare("SELECT * FROM $this->table");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Abstract method to get data by value in the column
     */
    public function getBy($column, $value){
        $stmt = self::$pdo->prepare("SELECT * FROM $this->table WHERE $column = :value");
        $stmt->execute(['value' => $value]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Example:
     * model->getWithJoin('id', 1, ['table1.value', 'table1.name', 'table2.name as table2Name'], ['table' => 'table2', 'column' => 'id'])* model->getWithJoin('id', 1, ['table1.value', 'table1.name', 'table2.name as table2Name'], ['table' => 'table2', 'column' => 'id'])
     */
    public function getWithJoin($column, $value, $rows, $join){
        $stmt = $this->pdo->prepare(
            "SELECT " . implode(",", $rows) . 
            " FROM $this->table 
            JOIN {$join['table']} ON $this->table.$column = {$join['table']}." . $join['column'] . 
            " WHERE $this->table.$column = :value"
        );
        $stmt->execute(['value' => $value]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function deleteByID($id){
        $stmt = self::$pdo->prepare("DELETE FROM $this->table WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    /**
     * The insert method
     * 
     * @param array $data
     * For example:
     * $data = ["field1" => "value1", "field2" => "value2"]
     * @return int The last insert id
     */
    public function insert(array $data){
        if($this->table ===""){
            throw new Exception("Table name is not defined");
        }

        $marks = array_fill(0, count($data), "?");

        $fields = array_keys($data);

        $values = array_values($data);

        $stmt = self::$pdo->prepare(
                                "INSERT INTO $this->table (".implode(",",$fields).") 
                                VALUES (".implode(",",$marks).")");

        $stmt->execute($values);

        return self::$pdo->lastInsertId();
    }
    /**
     * The update method
     * 
     * @param array $data
     * For example:
     * $data = ["field1" => "value1", "field2" => "value2"]
     */
    public function update(array $data, array $where){
        if($this->table === ""){
            throw new \Exception("Attribute _table is empty string!");
        }
        
        // Fields to be added.
        $fields = array_keys($data);
        // Fields values
        $values = array_values($data);

        $wherefield = array_keys($where);
        $wherevalue = array_values($where);

        // Prepare statement
        $stmt = self::$pdo->prepare("
        UPDATE " . $this->table . " SET ".  implode(', ', array_map(function($field){ return $field . ' = ? '; }, $fields)) ."
        WHERE " . implode(' AND ', array_map(function($field){ return $field . ' = ? '; }, $wherefield)));
        
        // Execute statement with values
        $stmt->execute(array_merge($values, $wherevalue));

        // Return last inserted ID.
        return self::$pdo->lastInsertId();
    }
}
?> 