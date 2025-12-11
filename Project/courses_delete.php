<?php
include "config.php";
include "header.php";

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
?>