<?php
include "config.php";
include "header.php";
?>
<section class="form-container">
    <h2>Ajouter / Modifier un Cours</h2>

    <?php

    function Valid_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data) ;
        $data = htmlspecialchars($data);
        return $data;

    };
    $errors = [];

    if (isset($_POST['submit'])) {

        if (empty($_POST['title'])) {
            $errors['title'] = "Titre invalide";
        } else {
            $title = Valid_input($_POST['title']);
        };

        if (empty($_POST['description'])) {
            $errors['description'] = "Description invalide";
        } else {
            $description = Valid_input($_POST['description']);
        };

        if (empty($_POST['niveau'])) {
            $errors['niveau'] = "Le niveau est requis";
        } elseif (in_array($_POST['niveau'], ["Debutant", "Intermdiaire", "advenced"])) {
            $niveau = Valid_input($_POST['niveau']);
        } else {
            $errors['niveau'] = "Niveau invalide";
        };

        if(empty($_POST['created_at'])){
            $created_at = date('y-m-d H:i:s');
        }else{
             $created_at = $_POST['created_at'];
        };

        if(!empty($_FILES['image']['name'])){
            $typeImg = ['image/png', 'image/jpeg', 'image/jpg'];
            if(!in_array($_FILES['image']['type'],$typeImg)){
                $errors['image'] = "Image invalide (PNG / JPG uniquement)";
            };
            if($_FILES['image']['size'] > 2 * 1024 * 1024){
             $errors['image'] = "L'image dépasse 2MB";
            };
        }else{
        $errors['image'] = "L'image est requise";
        };
        if(empty($errors)){
            $imagesName = time() . "_" . $_FILES['image']['name'];
            if(!move_uploaded_file($_FILES['image']['tmp_name'], "C:\\laragon\\www\\LMS Brf\\assets\\img\\$imagesName")){
                 $errors['image'] = "Erreur lors de l'upload de l'image";
            }else{
                $passDbDonnes = $connec->prepare(
                "INSERT INTO courses (image,Title,Description,Niveau,created_at)
                VALUES (?, ?, ?, ?, ?)");
                $passDbDonnes->bind_param("sssss", $imagesName,$title,$description,$niveau,$created_at);
                if($passDbDonnes->execute()){
                    echo "<p style='color:green'>Cours ajouté avec succès !</p>";
                    header("refresh:1; url=courses_list.php");
                    $_POST = [];
                }else{
                         echo "<p style='color:red'>Erreur lors de l'ajout en DB</p>";
                };
            };
        };
    };

    ?>

    <form action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> " method="POST" enctype="multipart/form-data"
        class="course-form">

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="Titre du cours"
            value = "<?= isset($_POST['title']) ? $_POST['title'] : ''?>">
            <?php if (isset($errors['title'])) { ?>
                <p class='error'><?= $errors['title']; ?></p>
            <?php }
            ; ?>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Description du cours"><?=isset($_POST['description'])?$_POST['description']:''?></textarea>
            <?php if (isset($errors['description'])) { ?>
                <p class='error'><?= $errors['description']; ?></p>
            <?php }
            ; ?>
        </div>

        <div class="form-group">
            <label for="niveau">Niveau</label>
            <select id="niveau" name="niveau">
                <option value="">-- Choisir le niveau --</option>
                <option value="Debutant" <?= (isset($_POST['niveau']) && $_POST['niveau'] == 'Debutant') ? "selected" : ""; ?> >Debutant</option>
                <option value="Intermdiaire" <?= (isset($_POST['niveau']) && $_POST['niveau'] == 'Intermdiaire') ? "selected" : ""; ?>>Intermdiaire</option>
                <option value="advenced" <?= (isset($_POST['niveau']) && $_POST['niveau'] == 'advenced') ? "selected" : ""; ?>>advenced</option>
            </select>
            <?php if (isset($errors['niveau'])) { ?>
                <p class='error'><?= $errors['niveau']; ?></p>
            <?php }
            ; ?>
        </div>

        <div class="form-group">
            <label for="created_at">Created_at</label>
            <input type="date" id="created_at" name="created_at">
        </div>

        <div class="form-group">
            <label for="image">Ajouter une image</label>
            <input type="file" id="image" name="image" accept="image/*" value =" <?= isset($_POST['image']) ? $_POST['image'] : ''?>">
            <?php if (isset($errors['image'])) { ?>
            <p class='error'><?= $errors['image']; ?></p>
            <?php }
            ; ?>
        </div>

        <button type="submit" name="submit" class="submit-btn">Enregistrer</button>
        <a href="courses_list.php">
            <button type="button" class="cancel-btn">Cancel</button>
        </a>
    </form>
</section>

<?php
include "footer.php"
?>