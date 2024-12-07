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

    public function getAll($lim, $offs){
        $stmt = self::$pdo->prepare("SELECT * FROM $this->table LIMIT $lim OFFSET $offs");
        $stmt->execute();

        $stmt1 = self::$pdo->prepare("SELECT COUNT(*) FROM $this->table");
        $result = $stmt1->execute();

        if(!$result){
            return false;
        }

        $count = $stmt1->fetchColumn();

        return [$stmt->fetchAll(PDO::FETCH_ASSOC), $count];
    }

    /**
     * Abstract method to get data by value in the column
     */
    public function getBy($column, $value, $lim = 1, $offs = 0){
        $stmt = self::$pdo->prepare("SELECT * FROM $this->table WHERE $column = :value LIMIT $lim OFFSET $offs");
        $stmt->execute(['value' => $value]);

        $stmt1 = self::$pdo->prepare("SELECT COUNT(*) FROM $this->table WHERE $column = :value");
        $result=$stmt1->execute(['value' => $value]);
        $count = $stmt1->fetchColumn();

        if(!$result){
            return false;
        }
        return [$stmt->fetchAll(PDO::FETCH_ASSOC), $count];
    }


    public function getByLike($column, $value, $lim = 1, $offs = 0){
        $stmt = self::$pdo->prepare("SELECT * FROM $this->table WHERE $column LIKE :value LIMIT $lim OFFSET $offs");
        $stmt->execute(['value'=> $value]);
        $stmt1 = self::$pdo->prepare("SELECT COUNT(*) FROM $this->table WHERE $column LIKE :value");
        $result=$stmt1->execute(['value'=> $value]);
        $count = $stmt1->fetchColumn();
        
        if(!$result){
            return false;
        }
        return [$stmt->fetchAll(PDO::FETCH_ASSOC), $count];
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
        $result = $stmt->execute(['value' => $value]);

        if(!$result){
            return false;
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function deleteByID($id){
        $stmt = self::$pdo->prepare("DELETE FROM $this->table WHERE id = :id");
        return $stmt->execute(['id' => $id]);
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
        
        return $stmt->execute($values);
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
        return $stmt->execute(array_merge($values, $wherevalue));
    }
}
?> 