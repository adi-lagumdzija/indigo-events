<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class  ReservationDao extends BaseDao{

  public function __construct(){
  parent::__construct("reservationdetails");
}

  public function get_reservation_by_id($id){
    return $this->query_unique("SELECT * FROM reservationdetails WHERE id = :id", ["id"=>$id]);
  }

  public function get_reservation_by_user_id($user_id){
    return $this->query_unique("SELECT * FROM reservationdetails WHERE user_id = :user_id", ["user_id"=>$user_id]);
  }

  // public function update_reservation_by_userid($status,$user){
  //   $this->update("user", $id, $user, "status");
  // }
 }
?>
