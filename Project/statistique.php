<?php
session_start();
require_once "config.php";
require_once "header.php";
if(!isset($_SESSION['email'] )){
    header("location: login.php");
    exit;
};
      if($_SESSION['role'] == 'user'){ 
        header("location: dashbored.php");
         };

// total cours
$sql = "SELECT count(*) as total FROM courses
        ";
$resdata = mysqli_query($connec, $sql);
$coursTotal = mysqli_fetch_assoc($resdata)['total']
;
// total users
$sql = "SELECT count(*) as total FROM usser
        ";
$resdata = mysqli_query($connec, $sql);
$usersTotal = mysqli_fetch_assoc($resdata)['total'];

// plus polpulaire
$sql = "SELECT courses.Title, count(enrollments.user_id) as total
        FROM courses
        LEFT JOIN enrollments on courses.id = enrollments.course_id
        group by courses.id
        order by total desc
        LIMIT 1";
$resdata = mysqli_query($connec, $sql);
$topCourse = mysqli_fetch_assoc($resdata);
// dernier inscription 

$resdata = "SELECT usser.Name, usser.Email, courses.Title, enrollments.enrolled_at
        FROM enrollments
        join usser on usser.id = enrollments.user_id
        join courses on courses.id = enrollments.course_id
        order by enrollments.enrolled_at DESC
        limit 5
        ";
$quer = mysqli_query($connec, $resdata);
$popCourses = mysqli_fetch_all($quer, MYSQLI_ASSOC);

// cours non inscrit
$resdata = "SELECT courses.Title, courses.description
        FROM courses
         WHERE id NOT  IN (SELECT course_id FROM enrollments)
        ";
$quer = mysqli_query($connec, $resdata);
$NoInscrCourses = mysqli_fetch_all($quer, MYSQLI_ASSOC);

// plus polpulaire
$sql = "SELECT courses.Title, count(enrollments.user_id) as total
        FROM courses
        JOIN enrollments on courses.id = enrollments.course_id
        group by courses.id
        order by total desc
        ";
$resdata = mysqli_query($connec, $sql);
$topCourses = mysqli_fetch_all($resdata, MYSQLI_ASSOC);


?>


<div class="admin-dashboard">

    <!-- GLOBAL STATS -->
    <div class="stat-container">
        <div class="stat-title">Statistiques globales</div>
        <div class="stat-grid">
            <div class="stat-card">
                <div class="stat-number"><?=$coursTotal?></div>
                <div class="stat-label">Total des cours</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?=$usersTotal?></div>
                <div class="stat-label">Total des utilisateurs</div>
            </div>
        </div>
    </div>

    <!-- COURS LE PLUS POPULAIRE -->
    <div class="stat-container">
        <div class="stat-title">Cours le plus populaire</div>
        <div class="stat-card">
            <div class="stat-number"><?= $topCourse['Title'] ;?></div>
        </div>
    </div>

    <!-- DERNIÈRES INSCRIPTIONS -->
    <div class="stat-container">
        <div class="stat-title">Dernières inscriptions</div>
        <table class="stat-table">
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Cours</th>
                <th>Date</th>
            </tr>
            <?php foreach($popCourses as $cours ) {?>
            <tr>
                <td><?= $cours['Name']?></td>
                <td><?= $cours['Email']?></td>
                <td><?= $cours['Title']?></td>
                <td><?= $cours['enrolled_at']?></td>
            </tr>
            <?php };?>

        </table>
    </div>

    <!-- COURS SANS INSCRIPTION -->
    <div class="stat-container">
        <div class="stat-title">Cours sans inscription</div>
        <table class="stat-table">
            <tr>
                <th>Titre du cours</th>
                <th>Description</th>
            </tr>
            <?php foreach($NoInscrCourses as $cours ) {?>
            <tr>
                <td><?= $cours['Title']?></td>
                <td><?= $cours['description']?></td>
            </tr>
            <?php };?>

        </table>
    </div>

    <!-- INSCRIPTIONS PAR COURS -->
    <div class="stat-container">
        <div class="stat-title">Inscriptions par cours</div>
        <table class="stat-table">
            <tr>
                <th>Cours</th>
                <th>Nombre d’inscriptions</th>
            </tr>
            <?php foreach($topCourses as $cours){ ?>
            <tr>
                <td><?=$cours['Title']?></td>
                <td><?=$cours['total']?></td>
            </tr>
                <?php };?>
        </table>
    </div>

</div>
