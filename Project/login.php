<?php
session_start();
require_once "config.php";
require_once "header.php";

$error = [];

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password,PASSWORD_DEFAULT);

    $sql = "SELECT * FROM usser WHERE Email = '$email' ";
    $res = mysqli_query($connec, $sql);
    
    $user = mysqli_fetch_assoc($res);
    // var_dump($user['Email']);
    // var_dump($user);
    // var_dump($mysqli_num_rows($res) === 1);
    if (mysqli_num_rows($res) === 1) {
        
        if(password_verify($password, $user['PassWord'] ))  {
          $_SESSION['email'] = $user['Email'];
          header("Location:dashbored.php");
          exit;
        } else {
            $error['password'] = "Mot de passe incorrect";
        }
    } else {
        $error['email'] = "Email non valide";
    };
}
?>

<div class="auth-container">
  <div class="auth-box">
    <h2 class="auth-title">Login</h2>

    <form action="" method="POST">
      <div class="auth-group">
        <label>Email</label>
        <input class="auth-input" type="email" name="email" required>
        <?php if(!empty($error['email'])){ ?>
        <p class="error"><?= $error['email']; ?></p>
        <?php };?>
        
      </div>

      <div class="auth-group">
        <label>Mot de passe</label>
        <input class="auth-input" type="password" name="password" required>
        <?php if(isset($error['password'])){ ?>
        <p class="error"><?= $error['password'] ?></p>
        <?php };?>
      </div>

      <button name="login" class="auth-btn">Se connecter</button>
    </form>

    <p class="auth-text">
      Pas encore de compte ?
      <a href="signup.php">Créer un compte</a>
    </p>
  </div>
</div>

<?php
require_once "footer.php"
?>
