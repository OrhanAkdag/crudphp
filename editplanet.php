<?php
require_once 'pdo_connect.php';

include 'menu.php';
include 'functions.php';
$idPlanet = $_GET['id'];
$planet = getPlanet($pdo, $idPlanet);
$errors = [];
$imageUrl = null;

if ( $_SERVER['REQUEST_METHOD'] === 'POST'){
    $returnValidation = validateEditForm();
    $errors = $returnValidation['errors'];
    $imageUrl = $returnValidation['image'];

    if( count($errors) === 0){
        updateBdd($pdo, $imageUrl, $planet['id']);
        header( 'location: viewplanet.php');
    }
}
?>

<div class="container my-2">
    <h1 class="text-center shadow p-2 bg-dark text-white">Ajouter une planète</h1>
    <form method="post" action="editplanet.php?id=<?php echo($planet['id']);?>"  class="p-5 shadow bg-dark" enctype="multipart/form-data">
        <div class="form-group">
            <label class="text-white">Nom de la planète</label>
            <input type="text" name="name" value="<?php echo($planet['name']) ?>" class="form-control" placeholder="Nom de la planète">
        </div>
        <div class="form-group">
            <label class="text-white">Status de la planète</label>
            <input type="text" name="status" value="<?php echo($planet['status']) ?>" class="form-control" placeholder="Status de la planète">
        </div>
        <div class="form-group">
            <label class="text-white">Terrain</label>
            <input type="text" name="terrain" value="<?php echo($planet['terrain']) ?>" class="form-control" placeholder="Terrain">
        </div>
        <div class="form-group">
            <label class="text-white">Allegiance</label>
            <select name="allegiance" class="form-control" placeholder="Allegiance">
            <?php

            foreach (getAllegiances() as $allegiance) {
                $selected = '';
                if($planet['allegiance'] === $allegiance){
                    $selected = 'selected';
                }
                echo('<option '.$selected.' value="'.$allegiance.'">'.$allegiance.'</option>');
            }
            ?>
            </select>
        </div>
        <div class="form-group">
            <label class="text-white">Key facts</label>
            <textarea type="text" name="keyfact" class="form-control">
            <?php echo($planet['key_fact']) ?>
            </textarea>
        </div>
        <div class="form-group">
            <label class="text-white">Image</label>
            <img src="<?php echo('images/planets/'.$planet['image']);?>" style="max-width: 150px;">
            <input  class="text-white" type="file" name="image" value="<?php echo($planet['image']) ?>">
        </div>
        <button type="submit" class="btn btn-primary">Valider</button>
        <?php
            if(count($errors) != 0){
                echo('<h2 class="text-white">Erreurs lors de la dernière soumission du formulaire: </h2>');
                foreach($errors as $error){
                    echo('<div class="error">'.$error.'</div>');
                }
            }
        ?>
    </form>
</div>