<?php
require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/CompanyDao.class.php';
require_once dirname(__FILE__).'/../dao/UserDao.class.php';
require_once dirname(__FILE__).'/../../vendor/autoload.php';

class ReservationService extends BaseService{
//   private $eventTypeDao;

  public function __construct(){
    $this->dao = new ReservationDao();
    //$this->userDao = new UserDao();
  }

  public function get_reservation_by_id($id){
    return $this->dao->get_reservation_by_id($id);
  }

  public function get_reservation_by_user_id($user_id){
    return $this->dao->get_reservation_by_user_id($user_id);
  }

  public function add_reservation($reservation){
    try{
      $this->dao->beginTransaction();
        $reservation = parent::add([
          "status" => "ACTIVE",
          "date_reserved" => date(Config::DATE_FORMAT),
          "user_id" => $reservation["user_id"],
          "event_id" => $reservation["event_id"]
        ]);
        $this->dao->commit();
      }catch (\Exception $e){
          $this->dao->rollBack();
          throw $e;
      }
      return $reservation;
  }


}
?>
