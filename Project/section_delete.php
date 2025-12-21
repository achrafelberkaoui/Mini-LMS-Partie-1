<?php
session_start();
require_once "config.php";
require_once "header.php";
if(!isset($_SESSION['email'])){
    header("location: login.php");
    exit;
};

if(!isset($_POST['id'])){
    die("Id Manque");
};

$id = intval($_POST['id']);

$sql = "DELETE FROM sections
        WHERE id = $id";
$con = mysqli_query($connec, $sql);
if($con){
    header("location: sections_list.php");
    exit;
}else{
    echo "Erreur";
};

include "footer.php"
?>