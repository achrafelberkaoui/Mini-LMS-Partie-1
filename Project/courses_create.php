<?php
include "config.php";
include "header.php";
?>
<section class="form-container">
    <h2>Ajouter / Modifier un Cours</h2>

    <form action="#" method="POST" enctype="multipart/form-data" class="course-form">

        <div class="form-group">
            <label for="id">ID</label>
            <input type="number" id="id" name="id" placeholder="Entrez l'ID">
        </div>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="Titre du cours" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Description du cours" required></textarea>
        </div>

        <div class="form-group">
            <label for="niveau">Niveau</label>
            <select id="niveau" name="niveau" required>
                <option value="">-- Choisir le niveau --</option>
                <option value="Débutant">Débutant</option>
                <option value="Intermédiaire">Intermédiaire</option>
                <option value="Avancé">Avancé</option>
            </select>
        </div>

        <div class="form-group">
            <label for="created_at">Created_at</label>
            <input type="date" id="created_at" name="created_at" required>
        </div>

        <div class="form-group">
            <label for="image">Ajouter une image</label>
            <input type="file" id="image" name="image" accept="image/*">
        </div>

        <button type="submit" class="submit-btn">Enregistrer</button>
        <a href="courses_list.php">
        <button type="button" class="cancel-btn">Cancel</button>
        </a>
    </form>
</section>

<?php

