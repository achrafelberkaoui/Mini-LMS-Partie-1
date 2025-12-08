<?php
include "config.php";
include "header.php";

$sql = 'SELECT * FROM courses';
$resul = mysqli_query($connec, $sql);
$element = mysqli_fetch_all($resul, MYSQLI_ASSOC);

?>
<section class="courses-container">
    <h2>Liste des Cours</h2>
    <table class="courses-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Niveau</th>
                <th>Créé le</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach($element as $ele){ ?>
            <tr>
                <td><?= $ele['id'] ?></td>

                <td>
                <?php
                if(!empty($ele['image'])){ ?>
                <img src="../assets/img/<?= $ele['image'] ?>" alt="image" class="img-aa">
                <?php }else{ ?>
                    <span style = "color: rgba(142, 142, 142, 0.54)" >Aucun Image</span>
                <?php } ?>
                </td>

                <td><?= $ele['Title'] ?></td>
                <td><?= $ele['Description'] ?></td>
                <td><?= $ele['Niveau'] ?></td>
                <td><?= $ele['created_at'] ?></td>
                <td class="actions">
                    <button class="edit-btn">Modifier</button>
                    <button class="delete-btn">Supprimer</button>
                </td>
            </tr>
        <?php }; ?>
        </tbody>
    </table>

    <div class="countainer-btn-delet">
        <a href="courses_create.php">
        <button class="add-btn">Ajoute Course</button>
        </a>
    </div>
</section>

<?php
include "footer.php";
?>
