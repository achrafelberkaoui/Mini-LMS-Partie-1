<?php
include "config.php";
include "header.php";

if(!isset($_GET['id'])){
    die("id manque");
};

$id = intval($_GET['id']);
$bd ="SELECT * FROM sections
    WHERE id = $id";
$dem = mysqli_query($connec, $bd);
$getda = mysqli_fetch_assoc($dem);
if(!$getda){
    die("section introuvable");
};

if(isset($_POST['submit'])){
        $title = htmlspecialchars(trim($_POST['title']));
        $content = htmlspecialchars(trim($_POST['content']));
        $course_id = htmlspecialchars(trim($_POST['course_id']));


    $modiBD = "UPDATE sections
            SET  title = '$title', content= '$content', course_id = $course_id
            WHERE id = $id";
        if(mysqli_query($connec,$modiBD)){
            echo "<p style = 'color:green'>Section Modifie avec succes !</p>";
            header("refresh:1; url=sections_list.php");

        }else{
            echo "<p style = 'color:red'>error lors de la mise a jour </p>";
        };
};
?>


<section class="form-container">
    <h2>Modifie une Section</h2>

    <form action="" method="POST" class="section-form">

        <div class="form-group">
            <label for="course_id">Course ID</label>
            <input  id="course_id" name="course_id" placeholder="ID du cours" value ="<?=$getda['course_id']?>">
        </div>

        <div class="form-group">
            <label for="title">Titre de la section</label>
            <input type="text" id="title" name="title" placeholder="Nom de la section" value ="<?=$getda['title']?>">
        </div>

            <div class="form-group">
            <label for="content">Content de la section</label>
            <input type="text" id="content" name="content" placeholder="content de la section" value ="<?=$getda['content']?>">
        </div>

        <button type="submit" class="submit-btn" name = "submit">Enregistrer</button>
        <a href="courses_list.php">
            <button type="button" class="cancel-btn">Cancel</button>
        </a>
        </form>
</section>

<?php
include "footer.php"
?>