<?php
/*
** PDO DB class
** Verbinden met database
** Prepared statements maken
** Waardes binden aan statements
** Rows en results doorgeven.
*/
declare(strict_types=1);
namespace app\lib;
use mysql_xdevapi\Exception;
use \PDO;
use \PDOStatement;

class Database {
    private string $dbhost = DB_HOST;
    private string $dbuser = DB_USER;
    private string $dbpass = DB_PASS;
    private string $dbname = DB_NAME;

    private PDO $dbhandler;
    private PDOStatement $stmt;
    private string $error = "";

    private string $dsn;

  public function __construct()
  {
    // dsn = data source name
    $this->dsn = 'mysql:host=' . $this->dbhost . ';dbname=' . $this->dbname;
    // https://www.php.net/manual/en/pdo.setattribute.php
    $this->options = array(
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );

    // pdo aanmaken
      try {
          $this->dbhandler = new PDO($this->dsn, $this->dbuser, $this->dbpass, $this->options);
      } catch(\PDOException $e) {
          throw new \PDOException('unable to connect to database');
      }
  }


  //query
  public function query($sql) {
      try {
          $this->stmt = $this->dbhandler->prepare($sql);
      } catch (\PDOException $e) {
          throw new \PDOException('Kan item niet toevoegen aan database, probeer het later opnieuw.');
      }
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

  // return ID of inserted row, important for joining
  public function lastInsertId()
  {
      return $this->dbhandler->lastInsertId();
  }

  // results array
  public function resultSet() {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function single() {
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_OBJ);
  }

  public function rowCount() {
    return $this->stmt->rowCount();
  }
}