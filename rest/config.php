<?php
class Config {

  const DATE_FORMAT = "Y-m-d H:i:s";

  // const DB_HOST = "localhost";
  // const DB_USERNAME = "events";
  // const DB_PASSWORD = "events123";
  // const DB_SCHEME = "events_db";

//   $host="eu-cdbr-west-02.cleardb.net";
// $port=3306;
// $socket="";
// $user="b80b15d1d7ad17";
// $password="";
// $dbname="heroku_df1469867643cb1";

// $con = new mysqli($host, $user, $password, $dbname, $port, $socket)
// 	or die ('Could not connect to the database server' . mysqli_connect_error());

//$con->close();


  const DB_HOST = "eu-cdbr-west-02.cleardb.net";
  const DB_USERNAME = "b80b15d1d7ad17";
  const DB_PASSWORD = "4b91e993";
  const DB_SCHEME = "heroku_df1469867643cb1"; 

  const JWT_SECRET = "y4KvQcZVqn3F7uxQvcFk";
  const JWT_TOKEN_TIME = 604800;

  public static function JWT_SECRET(){
    return Config::get_env("JWT_SECRET", "y4KvQcZVqn3F7uxQvcFk");
  }
  
  public static function ENVIRONMENT_SERVER ()
  {
      return Config::get_env("ENVIRONMENT_SERVER", "localhost/indigo-events/");
  }
  public static function PROTOCOL () {
      return strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://';
  }

  public static function get_env($name, $default)
  {
      return isset($_ENV[$name]) && trim($_ENV[$name]) != '' ? $_ENV[$name] : $default;
  }
}

?>
