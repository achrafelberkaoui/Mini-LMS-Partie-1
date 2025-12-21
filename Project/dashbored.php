<?php
session_start();
require_once "config.php";
require_once "header.php";
if(!isset($_SESSION['email'])){
    header("location:login.php");
    exit;
};
if(isset($_SESSION['msg'])){ 
     echo "<p style='color:green'>" . $_SESSION['msg'] . "</p>";
      unset($_SESSION['msg']);
      }; 

$id = $_SESSION['id'];
$stmt = mysqli_prepare($connec,"SELECT courses.* FROM courses
            join enrollments on courses.id = enrollments.course_id
            where enrollments.user_id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resu = mysqli_stmt_get_result($stmt);
?>
  

<div class="dash-layout">
  <!-- SIDEBAR -->
  <aside class="dash-sidebar">
    <h2 class="dash-logo">Dashboard</h2>
    <nav class="dash-menu">
        <?php if($_SESSION['role'] == 'admin'){ ?>
        <a href="statistique.php">statistique</a>
         <?php };?>
      <a href="dashboard.php" class="active">Courses</a>
      <a href="sections_list.php">Sections</a>
      <a href="logout.php">Logout</a>
    </nav>
  </aside>

  <!-- MAIN -->
  <main class="dash-main">

    <?php echo "<H2 style='color:green'>" . "Bonjour " . $_SESSION['name'] ."</H2>"  ?>
    <div class="dash-header">
      <h2>Liste des courses</h2>
      <a href="courses_list.php" class="dash-add-btn">+ Ajouter course</a>
    </div>


    <!-- COURSES TABLE -->
    <div class="dash-table">
      <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Niveau</th>
                <th>Créé le</th>
            </tr>
        </thead>
        <tbody>
<?php foreach($resu as $ele){ ?>
            <tr>
                <td><?= $ele['id'] ?></td>

                <td>
                <?php
                if(!empty($ele['image'])){ ?>
                <img src="../assets/img/<?= $ele['image'] ?>" alt="image" class="img-aa">
                <?php }else{ ?>
                    <span style = "color: rgba(142, 142, 142, 0.54)" >Aucun Image</span>
                <?php } ?>
                </td>
                <td>
               <a href="section_by_course.php?course_id=<?=$ele['id']?>" style="color: black; text-decoration: none;"> 
                <?= $ele['Title'] ?>
               </a>
               </td>
                <td><?= $ele['Description'] ?></td>
                <td><?= $ele['Niveau'] ?></td>
                <td><?= $ele['created_at'] ?></td>
            </tr>
        <?php }; ?>
        </tbody>
      </table>
    </div>

  </main>
</div>

<?php require_once "footer.php"; ?>


