<?php
session_start();
$connection = new mysqli("localhost", "root", "root", "master");
if (!$connection) {
    die("Cannot connect to database") . $connection->connect_error;
}



?>

