<?php
/*
** PDO DB class
** Verbinden met database
** Prepared statements maken
** Waardes binden aan statements
** Rows en results doorgeven.
*/

class Database {
  private $dbhost = DB_HOST;
  private $dbuser = DB_USER;
  private $dbpass = DB_PASS;
  private $dbname = DB_NAME;

  private $dbhandler;
  private $stmt;
  private $error;

  public function __construct() 
  {
    // dsn = data source name
    $dsn = 'mysql:host=' . $this->dbhost . ';dbname=' . $this->dbname;
    // https://www.php.net/manual/en/pdo.setattribute.php
    $options = array(
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );

    // pdo aanmaken
    try {
      $this->dbhandler = new PDO($dsn, $this->dbuser, $this->dbpass, $options);
    } catch(PDOException $e) {
      $this->error = $e->getMessage();
      echo $this->error;
    }
  }

  //query
  public function query($sql) {
    $this->stmt = $this->dbhandler->prepare($sql);
  }

  //Values binden
  public function bind($param, $value, $type = null) {
    if(is_null($type)){
      switch(true) {
        case is_int($value): 
          $type = PDO::PARAM_INT;
          break; 
        case is_bool($value): 
          $type = PDO::PARAM_BOOL;
          break; 
        case is_null($value): 
          $type = PDO::PARAM_NULL;
          break; 
        default: 
          $type = PDO::PARAM_STR;
      }
    }
    $this->stmt->bindValue($param, $value, $type);
  }
  // execute
  public function execute() {
    return $this->stmt->execute();
  }

  // results array
  public function resultSet() {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function single() {
    return $this->stmt->fetch(PDO::FETCH_OBJ);
  }

  public function rowCount() {
    return $this->stmt->rowCount();
  }
}