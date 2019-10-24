<?php
    class Model
    {
        private $conn;
        // constructor with $db as database connection
        public function __construct($db)
        {
            $this->conn = $db;
        }
        // public function a()
        // {
        //     echo "xinchao";
        // }
        //index , create , store, show, edit, update, destroy;
        public function index($table, $fields = array())
        {
            if ($table == '') {
                return false;
            }

            $colums = '*';
            if (!empty($fields)) {
                $colums = implode(',',$fields);
            }
            $record = array();
            $clause = "ORDER BY `id` DESC";
            // if (!empty($where)) {

            // }
            $query = "SELECT $colums FROM $table " . $clause;
            // var_dump($query);
            $stmt = $this->conn->prepare($query);
            var_dump($stmt);
            if ($stmt->execute()) {
                while($row = $stmt->fetch()){
                    $record[] = $row;
                }
                return $record;
            }
        }
    }
?>