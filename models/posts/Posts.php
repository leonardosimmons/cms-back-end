<?php

class Posts 
{
  public $conn;
  public $table = POSTS_DB_TABLE;

  public $id;
  public $category_id;
  public $title;
  public $author;
  public $date;
  public $tags;
  public $comment_count;
  public $status;
  public $content;
  public $image;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function read()
  {
    $query = 'SELECT * FROM ' . $this->table;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt;
  }
};

?>
