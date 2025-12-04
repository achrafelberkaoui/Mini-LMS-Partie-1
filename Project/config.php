<?php

$serverName = 'localhost';
$userName = 'root';
$password = '';
$dbName = 'lms';

$connec = mysqli_connect($serverName, $userName, $password, $dbName);

if(!$connec){
    die("connection field : " . mysqli_connect_error());
}