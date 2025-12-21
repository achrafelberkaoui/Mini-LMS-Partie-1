<?php
session_start();
require_once "config.php";
require_once "header.php";

if(!isset($_SESSION['email'])){
    header("location: login.php");
    exit;
};
if(!isset($_GET['id'])){
    header("location: courses_list.php");
    exit;
};

$userId = $_SESSION['id'];
$courseId = $_GET['id'];

$coursesUser = "
                SELECT * FROM enrollments
                WHERE course_id = '$courseId'
                AND user_id = '$userId'
                ";
$result = mysqli_query($connec, $coursesUser);
if(mysqli_num_rows($result) == 0){
    $sql = "INSERT INTO enrollments(user_id, course_id)
            VALUES('$userId', '$courseId')";
    
    if(mysqli_query($connec, $sql)){
    $_SESSION['msg'] = "inscription réussie";
    header("location:dashbored.php");
    exit;
    };
}else{
    $_SESSION['msg'] = "déja inscrit";
    header("location:dashbored.php");
    exit;
}

