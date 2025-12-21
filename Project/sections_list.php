<?php
session_start();
require_once "config.php";
require_once "header.php";
if(!isset($_SESSION['email'])){
    header("location: login.php");
    exit;
};

$sql = "SELECT * FROM sections";
$reponse = mysqli_query($connec, $sql);
$rees = mysqli_fetch_all($reponse, MYSQLI_ASSOC);
?>


<section class="sections-container">
    <h2>Liste des Sections du Cours</h2>

    <table class="sections-table">
        <thead>
            <tr>

                <th>ID</th>
                <th>Course ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Position</th>
                <th>Created_at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($rees as $sec){?>
            <tr>
                <td><?= $sec['id']?></td>
                <td><?= $sec['course_id']?></td>
                <td><?= $sec['title'] ?></td>
                <td><?= $sec['content']?></td>
                <td><?= $sec['position']?></td>
                <td><?= $sec['created_at']?></td>
                <td class="actions">
                   <a href="section_edite.php?id=<?=$sec['id']?>"> <button class="edit-btn">Modifier</button> </a>
                <form action="section_delete.php" method="POST">
                    <input type ="hidden" name="id" value = "<?= $sec['id']?>">
                <button class="delete-btn" 
                onclick="return confirm('Voulez-vous vraiment supprimer la section <?= htmlspecialchars($sec['title']) ?> ?')" type = "submit">
                Supprimer
                </button>
                </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="add-section-btn">
        <button><a href="section_create.php">Ajouter une Section</a></button>
    </div>
</section>

    <?php
    include "footer.php";
    ?>