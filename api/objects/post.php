<?php
class Post
{
    // database connection and table name
    private $conn;
    private $table_name = "posts";

    // object properties
    public $id;
    public $title;
    public $content;
    public $status;
    public $user_id;
    public $created_at;
    public $updated_at;



    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // signup user
    public function managementPost()
    {
        // select all query
        $query = "SELECT `id`, `title`, `content`, `status`, `user_id` FROM " . $this->table_name;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();

        return $stmt;
    }

    public function checkStatus()
    {
        $query = "SELECT `status` FROM" . $this->table_name . "WHERE `id` = :id";

        $stmt = $this->conn->prepare($query);

        print_r($row['id']);
        die();
    }

    public function createPost()
    {
        // date_default_timezone_set('Asia/Ho_Chi_Minh');
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            session_start();
        //query
        // $query = "INSERT INTO " . $this->table_name . "SET title=:title, content=:content, status=:status, user_id=:user_id, created_at=:created_at, updated_at=:updated_at";

        $query = "INSERT INTO " . $this->table_name ."(title, content, status, user_id, created_at, updated_at) VALUES(:title, :content, :status, :user_id, :created_at, :updated_at)";

        $stmt = $this->conn->prepare($query);

        // bind values

        $stmt->bindValue(":title", $_POST['title']);
        $stmt->bindValue(":content", $_POST['editor1']);
        $stmt->bindValue(":status", 1);
        $stmt->bindValue(":user_id", $_SESSION['id']);
        $stmt->bindValue(":created_at", date('Y/m/d h:i:s a', time()););
        $stmt->bindValue(":updated_at", date('Y/m/d h:i:s a', time()););

        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();

            return true;
        }
        
        return false;
    }

    public function editPost($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // $stmt->execute(array(':id' => $id));
        $stmt->bindValue(":id", $id);

        $stmt->execute();

        return $stmt;
    }

    public function updatedPost($id)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        session_start();

        $query = "UPDATE " . $this->table_name. " SET title=:newTitle, content=:newContent, status=:newStatus, user_id=:newUser_id, updated_at:=newUpdated_at WHERE id=:id";

        $stmt = $this->conn->prepare();

        $stmt->bindValue(":newTitle", $_POST['title']);
        $stmt->bindValue(":newContent", $_POST['editor1']);
        $stmt->bindValue(":newStatus", 2);
        $stmt->bindValue(":user_id", $_SESSION['id']);
        $stmt->bindValue(":created_at", date('Y/m/d h:i:s a', time()));
        $stmt->bindValue(":updated_at", date('Y/m/d h:i:s a', time()));
        $stmt->bindValue(":id", $id);

        $stmt->execute();

        if ($stmt->execute()) {
            return true;
        }

        return flase;
    }

}
