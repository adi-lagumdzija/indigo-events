<?php
class Config {

  const DATE_FORMAT = "Y-m-d H:i:s";
//  const JWT_SECRET = "y4KvQcZVqn3F7uxQvcFk";
  const JWT_TOKEN_TIME = 604800;

  const DB_HOST = "eu-cdbr-west-02.cleardb.net";
  const DB_USERNAME = "b80b15d1d7ad17";
  const DB_PASSWORD = "4b91e993";
  const DB_SCHEME = "heroku_df1469867643cb1";



  // const SMTP_HOST = "smtp.sendgrid.net";
  // const SMTP_PORT = 587;
  // const SMTP_USER = "#";  //DzeniKey
  // const SMTP_PASSWORD = "#";



  // public static function JWT_SECRET(){
  //   return Config::get_env("JWT_SECRET", "y4KvQcZVqn3F7uxQvcFk");
  // }

  // // environment servers setup
  //     public static function ENVIRONMENT_SERVER ()
  //     {
  //         return Config::get_env("ENVIRONMENT_SERVER", "localhost/indigo-events/");
  //     }
  //     public static function PROTOCOL () {
  //         return strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://';
  //     }

  //     public static function get_env($name, $default)
  //     {
  //         return isset($_ENV[$name]) && trim($_ENV[$name]) != '' ? $_ENV[$name] : $default;
  //     }
  // const DB_HOST = "127.0.0.1";
  // const DB_USERNAME = "root";
  // const DB_PASSWORD = "bradi123";
  // const DB_SCHEME = "indigoevents-project";



}
?>
