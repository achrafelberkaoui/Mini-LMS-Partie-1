<?php
include "config.php";
include "header.php";
?>
<section class="form-container">
    <h2>Ajouter / Modifier un Cours</h2>

    <?php
    if (isset($_POST['submit'])) {
        $errors = [];

        if (empty($_POST['title'])) {
            $errors['title'] = "Titre invalide";
        } else {
            $title = Valid_input($_POST['title']);
        }
        ;

        if (empty($_POST['description'])) {
            $errors['description'] = "Description invalide";
        } else {
            $description = Valid_input($_POST['description']);
        }
        ;

        if (empty($_POST['niveau'])) {
            $errors['niveau'] = "Le niveau est requis";
        } elseif (in_array($_POST['niveau'], ["Debutant", "Intermdiaire", "advenced"])) {
            $niveau = Valid_input($_POST['niveau']);
        } else {
            $errors['niveau'] = "Niveau invalide";
        }
        ;
    }
    ;

    function Valid_input($data)
    {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;

    }
    ;
    ?>

    <form action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> " method="POST" enctype="multipart/form-data"
        class="course-form">

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="Titre du cours">
            <?php if (isset($errors['title'])) { ?>
                <p class='error'><?= $errors['title']; ?></p>
            <?php }
            ; ?>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Description du cours"></textarea>
            <?php if (isset($errors['description'])) { ?>
                <p class='error'><?= $errors['description']; ?></p>
            <?php }
            ; ?>
        </div>

        <div class="form-group">
            <label for="niveau">Niveau</label>
            <select id="niveau" name="niveau">
                <option value="">-- Choisir le niveau --</option>
                <option value="Debutant">Debutant</option>
                <option value="Intermdiaire">Intermdiaire</option>
                <option value="advenced">advenced</option>
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
            <input type="file" id="image" name="image" accept="image/*">
        </div>

        <button type="submit" name="submit" class="submit-btn">Enregistrer</button>
        <a href="courses_list.php">
            <button type="button" class="cancel-btn">Cancel</button>
        </a>
    </form>
</section>