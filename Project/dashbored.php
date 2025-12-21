<?php
session_start();
require_once "config.php";
require_once "header.php";
if(!isset($_SESSION['email'])){
    header("location: login.php");
    exit;
};
?>
 <?php require_once "header.php"; ?>

<div class="dash-layout">
  <!-- SIDEBAR -->
  <aside class="dash-sidebar">
    <h2 class="dash-logo">Dashboard</h2>
    <nav class="dash-menu">
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
      <a href="add_course.php" class="dash-add-btn">+ Ajouter course</a>
    </div>

    <!-- COURSES TABLE -->
    <div class="dash-table">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- Exemple statique (DB من بعد) -->
          <tr>
            <td>1</td>
            <td>HTML</td>
            <td>Introduction HTML</td>
            <td class="dash-actions">
              <a href="#" class="dash-edit">Edit</a>
              <a href="#" class="dash-delete">Delete</a>
            </td>
          </tr>

          <tr>
            <td>2</td>
            <td>CSS</td>
            <td>CSS avancé</td>
            <td class="dash-actions">
              <a href="#" class="dash-edit">Edit</a>
              <a href="#" class="dash-delete">Delete</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

  </main>
</div>

<?php require_once "footer.php"; ?>


