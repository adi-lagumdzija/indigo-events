<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class EventDao extends BaseDao{

  public function __construct(){
    parent::__construct("event");
  }

  public function get_event($search, $offset, $limit, $order= '-id'){
    list($order_column, $order_direction) = self::parse_order($order);

    return $this->query("SELECT * FROM event
                        WHERE LOWER(name) LIKE CONCAT('%', :name, '%')
                        ORDER BY ${order_column} ${order_direction}
                        LIMIT ${limit} OFFSET ${offset}",
                        ["name"=>strtolower($search)]);
  }

  public function getEvent_by_city($city){
    return $this->query_unique("SELECT * FROM event WHERE city = :city", ["city"=>$city]);
  }
 }
?>
