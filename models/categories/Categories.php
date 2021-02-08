<?php

class Categories
{
  public $conn;
  public $table = CATEGORIES_DB_TABLE;

  public $id;
  public $title;

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
}

?>