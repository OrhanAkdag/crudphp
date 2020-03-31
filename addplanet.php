<?php
require_once 'pdo_connect.php';

include 'menu.php';
include 'functions.php';
$errors = [];
$imageUrl = null;

if ( $_SERVER['REQUEST_METHOD'] === 'POST'){
    $returnValidation = valideForm();
    $errors = $returnValidation['errors'];
    if( count($errors) === 0){
        addBdd($pdo, $returnValidation['image']);
        header( 'location: viewplanet.php');
    }
}
?>

<div class="container my-2">
    <h1 class="text-center shadow p-2 bg-dark text-white">Ajouter une planète</h1>
    <form method="post" action="addplanet.php" class="p-5 shadow bg-dark" enctype="multipart/form-data">
        <div class="form-group">
            <label class="text-white">Nom de la planète</label>
            <input type="text" name="name" class="form-control" placeholder="Nom de la planète">
        </div>
        <div class="form-group">
            <label class="text-white">Status de la planète</label>
            <input type="text" name="status" class="form-control" placeholder="Status de la planète">
        </div>
        <div class="form-group">
            <label class="text-white">Terrain</label>
            <input type="text" name="terrain" class="form-control" placeholder="Terrain">
        </div>
        <div class="form-group">
            <label class="text-white">Allegiance</label>
            <select name="allegiance" class="form-control" placeholder="Allegiance">
            <?php
                foreach(getAllegiances() as $allegiances){
                    echo('<option value="'.$allegiances.'">'.$allegiances.'</option>');
                }
            ?>
            </select>
        </div>
        <div class="form-group">
            <label class="text-white">Key facts</label>
            <textarea type="text" name="keyfact" class="form-control">
            </textarea>
        </div>
        <div class="form-group">
            <label class="text-white">Image</label>
            <input type="file" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Valider</button>
        <?php
            if(count($errors) != 0){
                echo('<h2>Erreurs lors de la dernière soumission du formulaire: </h2>');
                foreach($errors as $error){
                    echo('<div class="error">'.$error.'</div>');
                }
            }
        ?>
    </form>
</div>