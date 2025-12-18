<?php
require_once "config.php";
require_once "header.php";
?>

<div class="auth-container">
  <div class="auth-box">
    <h2 class="auth-title">Login</h2>

    <form action="login_process.php" method="POST">
      <div class="auth-group">
        <label>Email</label>
        <input class="auth-input" type="email" name="email" required>
      </div>

      <div class="auth-group">
        <label>Mot de passe</label>
        <input class="auth-input" type="password" name="password" required>
      </div>

      <button class="auth-btn">Se connecter</button>
    </form>

    <p class="auth-text">
      Pas encore de compte ?
      <a href="signup.php">Créer un compte</a>
    </p>
  </div>
</div>
