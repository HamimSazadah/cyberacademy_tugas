<?php
include "db.php";
require_once 'vendor/autoload.php';
use Predis\Client;
$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Check connection.
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

try {
    $redis = new Client(array(
        "scheme" => "tcp",
        "host" => getenv('REDIS_HOST'),
        "port" => getenv('REDIS_PORT'),
        "password" => getenv('REDIS_PASSWORD')
    ));
} catch (Exception $e) {
    echo "Connection to redis failed: ".$e;
}

$host = getenv('HOST');

if(getenv('APP_ENV')=='production'){
    error_reporting(0);
}else{
    error_reporting(E_ALL);
}



?>
