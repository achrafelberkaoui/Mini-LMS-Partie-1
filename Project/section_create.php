<?php
include "config.php";
include "header.php";

$error = [];
        function Valid_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data) ;
        $data = htmlspecialchars($data);
        return $data;

    };
if(isset($_POST['submit'])){
    if(empty($_POST['course_id'])||!is_numeric($_POST['course_id'])){
        $error['course_id'] = "course id invalide";
    }else{
        $course_id = intval($_POST['course_id']);
    };

    if (empty($_POST['title'])) {
        $error['title'] = "Titre invalide";
    } else {
        $title = Valid_input($_POST['title']);
    };
    
    if (empty($_POST['content'])) {
        $error['content'] = "content invalide";
    } else {
        $title = Valid_input($_POST['content']);
    };

    if(empty($_POST['created_at'])){
        $created_at = date('y-m-d');
    }else{
        $created_at = $_POST['created_at'];
    };
    if(empty($error)){ 
    $demen= $connec->prepare('INSERT INTO sections(course_id, title, content, created_at)
        VALUES(?,?,?,?)
        ');
        $demen->bind_param("isss",$course_id, $title, $content, $created_at);
        $demen->execute();
            echo "<p style='color:green'>section ajouté avec succès !</p>";
            header("refresh:1; url=sections_list.php");
            exit;
};
};

?>


<section class="form-container">
    <h2>Créer une Section</h2>

    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?> " method="POST" class="section-form">

        <div class="form-group">
            <label for="course_id">Course ID</label>
            <input  id="course_id" name="course_id" placeholder="ID du cours">
            <?php if (isset($error['course_id'])) { ?>
                <p class='error'><?= $error['course_id']; ?></p>
            <?php }
            ; ?>
        </div>

        <div class="form-group">
            <label for="title">Titre de la section</label>
            <input type="text" id="title" name="title" placeholder="Nom de la section">
            <?php if (isset($error['title'])) { ?>
            <p class='error'><?= $error['title']; ?></p>
            <?php }
            ; ?>

        </div>

            <div class="form-group">
            <label for="content">Content de la section</label>
            <input type="text" id="content" name="content" placeholder="content de la section">
            <?php if (isset($error['content'])) { ?>
            <p class='error'><?= $error['content']; ?></p>
            <?php }
            ; ?>
        </div>

        <div class="form-group">
            <label for="created_at">Date de création</label>
            <input type="date" id="created_at" name="created_at" >
        </div>

        <button type="submit" class="submit-btn" name = "submit">Enregistrer</button>
        <a href="sections_list.php">
            <button type="button" class="cancel-btn">Cancel</button>
        </a>
        </form>
</section>

<?php
include "footer.php"
?>
