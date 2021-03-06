<?php

class Config
{
    public const DATE_FORMAT = "Y-m-d H:i:s";
    public const JWT_SECRET = "y4KvQcZVqn3F7uxQvcFk";
    public const JWT_TOKEN_TIME = 604800;

    public const DB_HOST = "eu-cdbr-west-02.cleardb.net";
    public const DB_USERNAME = "b80b15d1d7ad17";
    public const DB_PASSWORD = "4b91e993";
    public const DB_SCHEME = "heroku_df1469867643cb1";

    public const SMTP_HOST = "smtp.sendgrid.net";
    public const SMTP_PORT = 587;
    public const SMTP_USER = "#";
    public const SMTP_PASSWORD = "#";

    public static function JWT_SECRET()
    {
        return Config::get_env("JWT_SECRET", "y4KvQcZVqn3F7uxQvcFk");
    }

    // environment servers setup
    public static function ENVIRONMENT_SERVER()
    {
        return Config::get_env("ENVIRONMENT_SERVER", "localhost/indigo-events/");
    }
    public static function PROTOCOL()
    {
        return strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, strpos($_SERVER["SERVER_PROTOCOL"], '/'))).'://';
    }

    public static function get_env($name, $default)
    {
        return isset($_ENV[$name]) && trim($_ENV[$name]) != '' ? $_ENV[$name] : $default;
    }

}
