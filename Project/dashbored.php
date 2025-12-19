<?php require_once "header.php"?>
  <!-- SIDEBAR -->
  <aside class="dash-sidebar">
    <div class="dash-logo">My Dashboard</div>
    <nav class="dash-menu">
      <a href="#" class="active">Dashboard</a>
      <a href="courses_list.php">Courses</a>
      <a href="sections_list.php">Sections</a>
      <a href="#">Mon Course</a>
      <a href="">Logout</a>
    </nav>
  </aside>

  <!-- MAIN CONTENT -->
  <main class="dash-main">

    <div class="dash-header">
      <h2>Dashboard</h2>
      <div class="dash-user">Bienvenue, Admin</div>
    </div>

    <!-- STATS CARDS -->
    <div class="dash-cards">
      <div class="dash-card">
        <h3>Total Courses</h3>
        <p>12</p>
      </div>
      <div class="dash-card">
        <h3>Total Sections</h3>
        <p>45</p>
      </div>
      <div class="dash-card">
        <h3>Utilisateurs</h3>
        <p>8</p>
      </div>
    </div>

    <!-- TABLE -->
    <div class="dash-table">
      <h3>Derniers cours</h3>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>HTML Basics</td>
            <td>2025-01-01</td>
          </tr>
          <tr>
            <td>2</td>
            <td>CSS Advanced</td>
            <td>2025-01-05</td>
          </tr>
        </tbody>
      </table>
    </div>

