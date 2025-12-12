<?php
include "config.php";
include "header.php";

if(!isset($_GET ['id'])){
    die("ID MANQUE");
};

$id = $_GET ['id'];

$BD = "SELECT * FROM courses
        WHERE id = $id";
$connOk = mysqli_query($connec, $BD);
$course = mysqli_fetch_assoc($connOk);

if(!$course){
    die("course introuvable");
};

if(isset($_POST['submit'])){
    $title = htmlspecialchars(trim($_POST['title']));
    $description = htmlspecialchars(trim($_POST['description']));
    $niveau = htmlspecialchars(trim($_POST['niveau']));

    $saveBD = "UPDATE courses
                SET Title = '$title', Description = '$description', Niveau = '$niveau'
                WHERE id = $id";
    if(mysqli_query($connec,$saveBD)){
        echo "<p style = 'color:green'>Cours Modifie avec succes !</p>";
        header("refresh:1; url=courses_list.php");

    }else{
        echo "<p style = 'color:red'>error lors de la mise a jour </p>";
    };
};
?>

 <form action="" method="POST" class="course-form">

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value ="<?= $course['Title']?>">

        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description"><?= $course['Description'] ?></textarea>
        </div>

        <div class="form-group">
            <label for="niveau">Niveau</label>
            <select id="niveau" name="niveau">
                <option value="">-- Choisir le niveau --</option>
                <option value="Debutant" <?= $course['Niveau'] == 'Debutant'?"selected" : ""; ?> >Debutant</option>
                <option value="Intermdiaire" <?=  $course['Niveau'] == 'Intermdiaire'?"selected" : ""; ?>>Intermdiaire</option>
                <option value="advenced" <?=  $course['Niveau'] == 'advenced'?"selected" : ""; ?>>advenced</option>
            </select>
        </div>


        <button type="submit" name="submit" class="submit-btn">Enregistrer</button>
        <a href="courses_list.php">
            <button type="button" class="cancel-btn">Cancel</button>
        </a>
    </form>

    <?php
    include "footer.php";
    ?>