<?php

class Posts 
{
  public $conn;
  public $table = POSTS_DB_TABLE;

  public $id;
  public $type;
  public $category_id;
  public $title;
  public $author;
  public $date;
  public $searchTag;
  public $tags;
  public $comment_count;
  public $status;
  public $content;
  public $image;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  /** Returns all of the posts within the database */
  public function read()
  {
    $query = 'SELECT * FROM ' . $this->table;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt;
  }

  /**
   * @param $search
   * @return Posts
   */
  public function search()
  {
    $query = 'SELECT * FROM ' . $this->table . ' WHERE tags LIKE ?';
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->searchTag);
    $stmt->execute();

    return $stmt;
  }

};


