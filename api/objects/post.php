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

    public function createPost()
    {
        session_start();
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        //query
        // $query = "INSERT INTO " . $this->table_name . "SET title=:title, content=:content, status=:status, user_id=:user_id, created_at=:created_at, updated_at=:updated_at";

        $query = "INSERT INTO " . $this->table_name ."(title, content, status, user_id) VALUES(:title, :content, :status, :user_id)";

        // $query->bindparam(':name', $name);
        // $query->bindparam(':age', $age);
        // $query->bindparam(':email', $email);
        // $query->execute();

        $stmt = $this->conn->prepare($query);

        // // sanitize
        // $this->title=htmlspecialchars(strip_tags($this->title));
        // $this->content=htmlspecialchars(strip_tags($this->content));
        // $this->status=htmlspecialchars(strip_tags($this->status));
        // $this->user_id=htmlspecialchars(strip_tags($this->user_id));
        // $this->created_at=htmlspecialchars(strip_tags($this->created_at));
        // $this->updated_at=htmlspecialchars(strip_tags($this->updated_at));

        // bind values

        $stmt->bindValue(":title", $_POST['title']);
        $stmt->bindValue(":content", $_POST['editor1']);
        $stmt->bindValue(":status", 1);
        $stmt->bindValue(":user_id", $_SESSION['id']);

        
        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();

            return true;
        }
        
        return false;
    }

}
