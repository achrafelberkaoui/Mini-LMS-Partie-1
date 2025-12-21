<?php
session_start();
require_once "config.php";
require_once "header.php";
if(!isset($_SESSION['email'])){
    header("location: login.php");
    exit;
};

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
                <td>
               <a href="section_by_course.php?course_id=<?=$ele['id']?>" style="color: black; text-decoration: none;"> 
                <?= $ele['Title'] ?>
               </a>
               </td>
                <td><?= $ele['Description'] ?></td>
                <td><?= $ele['Niveau'] ?></td>
                <td><?= $ele['created_at'] ?></td>
                <td class="actions">
                <?php if($_SESSION['role'] == 'admin'){ ?>
                <a href ="courses_edit.php?id=<?= $ele['id']?>" > <button class="edit-btn">Modifier</button> </a>
                <form action="courses_delete.php" method="POST">
                    <input type ="hidden" name="id" value = "<?= $ele['id']?>">
                <button class="delete-btn" 
                onclick="return confirm('Voulez-vous vraiment supprimer ce cours ?')" type = "submit">
                Supprimer
                </button>
                </form>
                <?php };?>
                <div class="course-add">
                <a href="enrollement.php?id=<?= $ele['id'] ?>" class="course-add-btn">+ Ajouter un cours</a>
                </div>
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
