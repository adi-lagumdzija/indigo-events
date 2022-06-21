<?php
require_once dirname(__FILE__)."/../config.php";

/*
* The main class for interaction with database
*
*  All other DAO classes should inherit this class.
*
* @author Dzenana Medjedovic
*/
class BaseDao {
  protected $connection;
  protected $table;

  public function __construct($table){
    $this->table = $table;
    try {
      $this->connection = new PDO("mysql:host=".Config::DB_HOST.";dbname=".Config::DB_SCHEME, Config::DB_USERNAME, Config::DB_PASSWORD);

      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e) {
      throw $e;
    }
  }

  public function parse_order($order){
    switch(substr($order, 0, 1)){
      case '-' : $order_direction = 'ASC'; break;
      case '+' : $order_direction = 'DESC'; break;
      default : throw new Exception("Invalid order format. First character should be either '-' or '+' "); break;
    }

    //Filter SQL injection attacks on column name
    $order_column = trim($this->connection->quote(substr($order, 1)),"'");

    return [$order_column, $order_direction];
  }

  public function beginTransaction(){ //change
    $this->connection->setAttribute(PDO::ATTR_AUTOCOMMIT, 1);
    $this->connection->beginTransaction();
  }
  public function commit(){
    $this->connection->commit();
    $this->connection->setAttribute(PDO::ATTR_AUTOCOMMIT, 1);
  }
  public function rollBack(){
    $this->connection->rollBack();
    $this->connection->setAttribute(PDO::ATTR_AUTOCOMMIT, 1);
  }

  protected function insert($table, $entity){
   $query = "INSERT INTO ${table} (";
   foreach ($entity as $column => $value) {
      $query .=$column.", ";
    }
    $query =substr($query, 0, -2);
    $query .=") VALUES (";
      foreach ($entity as $column => $value) {
        $query .= ":".$column.", ";
      }
      $query = substr($query, 0, -2);
      $query .=")";
      echo $query;
  $stmt= $this->connection->prepare($query);
  $stmt->execute($entity); //sql injection prevention
  $entity['id'] = $this->connection->lastInsertId();
  return $entity;
  }

// Full or incremental update in any table
  protected function executeUpdate($table, $id, $entity, $id_column="id"){
    $query = "UPDATE ${table} SET ";
    foreach ($entity as $name => $value) {
      $query .= $name ."= :". $name. ", ";
    }
    $query = substr($query, 0, -2);
    $query .= " WHERE ${id_column} = :id";

    $stmt= $this->connection->prepare($query);
    $entity['id'] = $id;
    $stmt->execute($entity);
  }

  protected function query($query, $params){
    $stmt = $this->connection->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  protected function query_unique($query, $params){
    $results = $this->query($query, $params);
    return reset($results);
  }

  public function add($entity){
    return $this->insert($this->table, $entity);
  }

  public function update($id, $entity){
    $this->executeUpdate($this->table, $id, $entity);
  }

  public function get_by_id($id){
    return $this->query_unique("SELECT * FROM ".$this->table." WHERE id=:id", ["id" => $id]);
  }

  public function get_all($offset = 0, $limit = 25, $order = "-id", $total=FALSE){

    list($order_column, $order_direction) = self::parse_order($order);

    if($total){
      return $this->query_unique("SELECT COUNT(*) AS total FROM ".$this->table,[]);
   }else{
      return $this->query("SELECT * FROM ".$this->table."
                          ORDER BY ${order_column} ${order_direction}
                          LIMIT ${limit} OFFSET ${offset}", []);
    }
  }

}
?>