<?php

require('includes/config.php');
require('includes/functions.php');

class Database
{
  /*  -----------------  INITIALIZATION  -----------------  */
  private $conn;
  private string $hn, $un, $pw, $db;

  /*  ------------------  CONNECTION  ------------------  */

  /**
   * * Sets database login information
   */
  protected function setLoginInfo()
  {
    $fh = fopen(LOGIN_INFO, 'r');
    $line = fread($fh, 50);
    fclose($fh);
    $temp = explode("\n", $line);

    $i = 1;
    foreach ($temp as $word) {
      switch($i)
      {
        case 1:
          $this->hn = onlyAlpha(preg_replace("/\s+/", "", $word));
          break;
        case 2:
          $this->un = onlyAlpha(preg_replace("/\s+/", "", $word));
          break;
        case 3:
          $this->pw = onlyAlpha(preg_replace("/\s+/", "", $word));
          break;
        case 4:
          $this->db = onlyAlpha(preg_replace("/\s+/", "", $word));
          break;
        default:
          break;
      }
      ++$i;
    }
    
    if ($this->db) {
      return true;
    } 

    return false;
  }

  /**
   * * Connects to database
   */
  public function connect()
  {
    $this->conn = null;
    $this->setLoginInfo();

    try {
      $this->conn = new PDO('mysql:host=' . $this->hn . ';dbname=' . $this->db, $this->un , $this->pw);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $err){
      echo 'Connection Error: ' . $err->getMessage();
    }

    return $this->conn;
  }
};


?>