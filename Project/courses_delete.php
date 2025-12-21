<?php
session_start();
require_once "config.php";
require_once "header.php";
if(!isset($_SESSION['email'])){
    header("location: login.php");
    exit;
};
if(!isset($_POST['id'])){
    die("ID MANQUE");
}
$id = intval($_POST['id']);
$secID = "DELETE FROM sections WHERE course_id = $id";
$sql = mysqli_query($connec, $secID);


$rowID = "DELETE FROM courses WHERE id = $id";
$sql = mysqli_query($connec, $rowID);
if($sql){
    header("Location: courses_list.php");
    exit;
}else{
    echo "Erreur";
};

include "footer.php";
?>