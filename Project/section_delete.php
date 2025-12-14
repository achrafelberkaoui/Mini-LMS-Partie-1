<?php
include "config.php";
include "header.php";

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