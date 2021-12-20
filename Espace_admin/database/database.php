<?php

require_once('config.php');

$db_host = DB_HOST;
$db_name = DB_NAME;
$db_user = DB_USER;
$db_password = DB_PASSWORD;
$db_charset = DB_CHARSET;

$dsn = "mysql:host=$db_host;dbname=$db_name;charset=$db_charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
try {
    $db = new PDO($dsn, $db_user, $db_password, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
