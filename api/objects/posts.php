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
        if ($stmt->execute()) {
            return $stmt;
        }
        return false;
    }

    public function createPost($title, $editor1, $currentUser)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $query = "INSERT INTO " . $this->table_name ."(title, content, status, user_id, created_at, updated_at) VALUES(:title, :content, :status, :user_id, :created_at, :updated_at)";
        // $query = "INSERT INTO " . $this->table_name ."(title, content, status, user_id) VALUES(:title, :content, :status, :user_id)";

        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindValue(":title", $title);
        $stmt->bindValue(":content", $editor1);
        $stmt->bindValue(":status", 1);
        $stmt->bindValue(":user_id", $currentUser);
        $stmt->bindValue(":created_at", date('Y-m-d h:i:s', time()));
        $stmt->bindValue(":updated_at", date('Y-m-d h:i:s', time()));
        // execute query
        // print_r($title . $editor1 . $currentUser);
        if ($stmt->execute()) {
            // print_r("dug");
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        // print("sai");
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

    public function updatedPost($id, $newTitle, $newEditor1, $currentUserEditing)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $query ="UPDATE " . $this->table_name. " SET `title`=:newTitle, `content`=:newContent, `status`=:newStatus, `user_id`=:newUser_id, `updated_at`=:newUpdated_at WHERE `id`=:id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":newTitle", $newTitle);
        $stmt->bindValue(":newContent", $newEditor1);
        $stmt->bindValue(":newStatus", 2);
        $stmt->bindparam(":newUser_id", $currentUserEditing);
        $stmt->bindValue(":newUpdated_at", date('Y-m-d h:i:s', time()));
        $stmt->bindValue(":id", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function removepost($id)
    {
        $query = "DELETE FROM " .$this->table_name. " WHERE `id` = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id", $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getTotalRecord()
    {
        $query = "SELECT count(*) FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $data = $stmt->fetchColumn();

        return $data;
    }

    // public function upload($checkList) {
    //     foreach ($checkList as $value) {
    //         $query = "SELECT `title`, `content` FROM" . $this->table_name . "WHERE `id` = :id";

    //         $stmt = $this->conn->prepare()
    //     }
    // }
}
