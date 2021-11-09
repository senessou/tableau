<?php
session_start();
require_once (__DIR__ . '/global.php' );

$dbName = DB_NAME;
$dbHost = DB_HOST;

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", DB_USER, DB_PASSWORD);
}
catch(Exception $ex) {
    echo "Erreur" .$ex->getMessage();
}