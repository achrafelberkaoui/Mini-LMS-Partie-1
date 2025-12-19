<?php
require_once "config.php";
require_once "header.php";

function valideInpu($data){
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    $data = trim($data);

    return $data;
};
$errors = [];

if($_SERVER["REQUEST_METHOD"]==="POST"){
    if(empty($_POST['name'])){
        $errors['name'] = "veuillez entrer votre name";
    }else{
        $name = valideInpu($_POST['name']);
    };

    if(empty($_POST['email'])){
        $errors['email'] = "veuillez entrer votre email";
    }elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $errors ['email']= "email no valide";
    }else{
        $email = valideInpu($_POST['email']);
    };

    if(empty($_POST['password'])){
        $errors['password'] = "veuillez entrer votre password";
    }elseif (strlen($_POST['password']) < 8 ) {
        $errors['password'] = "minmum 8 characters";
    }else{
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    };

    if(empty($errors)){
        $sql = $connec ->prepare("INSERT INTO usser(Name, Email, PassWord)
                                VALUES(?, ?, ?)");

        $sql->bind_param("sss", $name, $email, $password);
        if($sql->execute()){
            echo "<p style = 'color:green'>SignUp Success</p>";
            header("refresh:1, location = dashbored.php") ;
        };
    };
    
};

?>

<div class="auth-container">
  <div class="auth-box">
    <h2 class="auth-title">Signup</h2>

    <form action="" method="POST">
      <div class="auth-group">
        <label>Nom complet</label>
        <input class="auth-input" type="text" name="name" required>
      </div>

      <div class="auth-group">
        <label>Email</label>
        <input class="auth-input" type="email" name="email" required>
      </div>

      <div class="auth-group">
        <label>Mot de passe</label>
        <input class="auth-input" type="password" name="password" required>
      </div>

      <?php
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p class='auth-error'>$error</p>";
    }
}
?>

      <button class="auth-btn">S'inscrire</button>
    </form>

    <p class="auth-text">
      Déjà un compte ?
      <a href="login.php">Se connecter</a>
    </p>
  </div>
</div>

<?php
include "footer.php"
?>

