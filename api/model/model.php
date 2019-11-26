<?php
    require_once dirname(__DIR__) . '/config/database.php';
    require_once dirname(__DIR__) . '/config/config.php';

    class Model
    {
        private $conn;
        // constructor with $db as database connection
        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function test($table)
        {
            $columns = '*';
            $query = "SELECT $columns FROM $table";
            $sth = $this->conn->prepare($query);
            $sth->execute();

            return $sth;
        }

        //index , create , store, show, edit, update, destroy;
        public function index($table, $fields = array(), $where = array())
        {
            if ($table == '') {
                return false;
            }

            $columns = '*';
            if (!empty($fields)) {
                $columns = implode(',',$fields);
            }

            $clause = '';
            if (!empty($where)) {
                $clause = implode(',', $where);
            }
            // $clause = 'ORDER BY `updated_at` DESC';

            $query = 'SELECT ' . $columns . ' FROM ' . $table .' '. $clause;

            $stmt = $this->conn->prepare($query);

            if ($stmt->execute()) {
                if(!is_null($stmt->execute())){
                    return $stmt;
                }
            }
            return false;
        }

        public function show($table, $fields = array(), $where = array())
        {
            if ($table == '') {
                return false;
            }

            $columns = '*';
            if (!empty($fields)) {
                $columns = implode(',', $fields);
            }

            $clause = '';
            if (!empty($where)) {
                foreach ($where as $key => $value) {
                    if ($key !== key($where)) {
                        $result[] = $key . ' = ' . "'" . $value . "'"; 
                    }
                }
                switch ($where[0]) {
                    case 'NOT':
                        if (count($result) === 1) {
                            $condition = " NOT " . $result[0];
                        }
                        break;
                    case 'AND' || 'OR':
                        $condition = implode(" $where[0] ", $result);
                        break;
                    
                    default:
                        $condition = implode('', $result);
                        break;
                }
            }

            if (isset($condition)) {
                $query = 'SELECT ' . $columns . ' FROM ' . $table .' WHERE '. $condition;

                $stmt = $this->conn->prepare($query);

                if ($stmt->execute()) {
                    return $stmt;
                }
                return false;
            }
        }

        public function create($table, $fields = array())
        {
            if ($table == '') {
                return false;
            }

            if (!empty($fields)) {
                foreach ($fields as $key => $value) {
                    $clause_key[] = $key;
                    $clause_value[] = $value; 
                }
            }

            $fields = implode(',', $clause_key);
            $value = "('".implode("','", $clause_value)."')";
            $query = 'INSERT INTO ' . $table . ' (' . $fields . ') VALUES ' . $value ;

            $stmt = $this->conn->prepare($query);

            if ($stmt->execute()) {
                return true;
            }
            return false;
        }

        public function update($table, $fields = array(), $where = array())
        {
            if ($table == '') {
                return null;
            }

            if (!empty($fields)) {
                foreach ($fields as $key => $value) {
                    $set[] = $key . ' = '. "'" . $value . "'";
                }
                $clause = implode(',', $set);
            }

            if (!empty($where)) {
                foreach ($where as $key => $value) {
                    if ($key !== key($where)) {
                        $result[] = $key . ' = ' . "'" . $value . "'"; 
                    }
                }
                switch ($where[0]) {
                    case 'NOT':
                        if (count($result) === 1) {
                            $condition = " NOT " . $result[0];
                        }
                        break;
                    case 'AND' || 'OR':
                        $condition = implode(" $where[0] ", $result);
                        break;
                    
                    default:
                        $condition = implode('', $result);
                        break;
                }
            }

            if (isset($condition)) {
                $query = 'UPDATE ' . $table . ' SET ' . $clause . ' WHERE ' . $condition;

                $stmt = $this->conn->prepare($query);

                if ($stmt->execute()) {
                    return true;
                }
                return false;
            }
        }

        public function destroy($table, $where = array())
        {
            if (empty($table)) {
                return null;
            }

            if (!empty($where)) {
                foreach ($where as $key => $value) {
                    if ($key !== key($where)) {
                        $result[] = $key . ' = ' . "'" . $value . "'"; 
                    }
                }
                switch ($where[0]) {
                    case 'NOT':
                        if (count($result) === 1) {
                            $condition = " NOT " . $result[0];
                        }
                        break;
                    case 'AND' || 'OR':
                        $condition = implode(" $where[0] ", $result);
                        break;
                    
                    default:
                        $condition = implode('', $result);
                        break;
                }
            }

            if (isset($condition)) {
                $query = 'DELETE  FROM ' . $table . ' WHERE ' . $condition;

                $stmt = $this->conn->prepare($query);

                if ($stmt->execute()) {
                    return true;
                }
                return false;
            }
        }
    }
