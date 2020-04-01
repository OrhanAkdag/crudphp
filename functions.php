<?php
function getAllegiances() {
    return [
        'Clan Fett',
        'Commerce Guild',
        'Confederacy of Independant Systems',
        'Corporate Alliance',
        'Dark Lords of the Sith',
        'Death Watch',
        'First Order',
        'Free Ryloth movement',
        'Galactic Empire',
        'Galactic Republic',
        'Gungan Grand Army',
        'Hutts',
        'Intergalactic Banking Clan',
        'Jedi Order',
        'Lothal Rebels',
        'Mandalorian Clans',
        'Nightbrothers',
        'Nightsisters',
        'Nite Owls',
        'Rebel Alliance',
        'Shadow Collective',
        'The Resistance',
        'Techno Union',
        'Trade Federation',
        'Tusken Raiders',
        'Twi\'lek Freedom Fighters'
    ];
}

function getPlanet($pdo,$id)
{
    $res = $pdo->prepare('SELECT * FROM planets WHERE id = :id');
    $res->execute(['id'=> $id]);
    return $res->fetch();
}

function addBdd($pdo, $imageUrl){
    $req = $pdo->prepare(
        'INSERT INTO planets(name, status, terrain , allegiance, key_fact, image)
    VALUES(:name, :status, :terrain, :allegiance, :key_fact, :image)');
    $req->execute([
        'name' => $_POST['name'],
        'status' => $_POST['status'],
        'terrain' => $_POST['terrain'],
        'allegiance' => $_POST['allegiance'],
        'key_fact' => $_POST['keyfact'],
        'image' => $imageUrl
    ]);
}

function updateBdd($pdo, $imageUrl, $id){
    if(!is_null($imageUrl)){
        $req = $pdo->prepare('UPDATE planets SET name = :name, status = :status , terrain = :terrain , allegiance = :allegiance , key_fact = :key_fact , status = :status, image = :image WHERE id = :id');
        $req->execute([
            'name' => $_POST['name'],
            'status' => $_POST['status'],
            'terrain' => $_POST['terrain'],
            'allegiance' => $_POST['allegiance'],
            'key_fact' => $_POST['keyfact'],
            'image' => $imageUrl,
            'id'=> $id
        ]);
    } else {
        $req = $pdo->prepare('UPDATE planets SET name = :name, status = :status , terrain = :terrain , allegiance = :allegiance , key_fact = :key_fact , status = :status WHERE id = :id');
        $req->execute([
            'name' => $_POST['name'],
            'status' => $_POST['status'],
            'terrain' => $_POST['terrain'],
            'allegiance' => $_POST['allegiance'],
            'key_fact' => $_POST['keyfact'],
            'id'=> $id
        ]);
    }
}

function valideForm(){
    $errors = [];
    $imageUrl = null;
    $allowedExtension = ['image/png','image/jpeg','image/gif'];
    if($_FILES['image']['size'] == 0){
        $errors[] = '<div class="alert alert-danger" role="alert">Veuillez ajouter une image</div>';
    }
    if(in_array($_FILES['image']['type'],$allowedExtension)){
        if($_FILES['image']['size'] < 8000000){
            $extension = explode('/', $_FILES['image']['type'])[1];
            $imageUrl = uniqid().'.'.$extension;
            move_uploaded_file($_FILES['image']['tmp_name'],'images/planets/'.$imageUrl);
        }
        else {
            $errors[] = '<div class="alert alert-danger" role="alert">Fichier trop lourd</div> ';
        }
    }    
    else {
        $errors[] = '<div class="alert alert-danger" role="alert">J\'accepte que les fichiers png, jpg, gif</div>';
    }
    if(empty($_POST['name'])){
        $errors[] = '<div class="alert alert-danger" role="alert">Veuillez saisir le nom de la planète</div>';
    }
    if(empty($_POST['status'])){
        $errors[] = '<div class="alert alert-danger" role="alert">Veuillez saisir le status de la planète</div>';
    }
    if(empty($_POST['terrain'])){
        $errors[] = '<div class="alert alert-danger" role="alert">
        Veuillez terrain le status de la planète</div>';
    }
    if(empty($_POST['allegiance'])){
        if(!in_array($_POST['allegiance'], getAllegiances())){
            $errors[] = '<div class="alert alert-danger" role="alert">allegiance inconnue</div>';
        }
        $errors[] = '<div class="alert alert-danger" role="alert">
        Veuillez terrain l\'allegiance de la planète</div>';
    }
    if(empty($_POST['keyfact'])){
        $errors[] = '<div class="alert alert-danger" role="alert">Veuillez la key fact de la planète</div>';
    }
    return ['errors'=>$errors, 'image'=>$imageUrl];
}

function deletePlanet($pdo, $id)
{
 $res = $pdo->prepare('DELETE FROM planets WHERE id = :id');
 $res->execute(['id'=> $id]);
}

function validateEditForm() {
    $errors = [];
    $imageUrl = '';

    if($_FILES['image']['size'] != 0) {

        if ($_FILES['image']['type'] === 'image/png') {
            if ($_FILES['image']['size'] < 8000000) {
                $extension = explode('/', $_FILES['image']['type'])[1];
                $imageUrl = uniqid() . '.' . $extension;
                move_uploaded_file($_FILES['image']['tmp_name'], 'images/planets/' . $imageUrl);
            } else {
                $errors[] = 'Fichier trop lourd impossible';
            }
        } else {
            $errors[] = 'Impossible : j\'accepte que les PNGS !';
        }
    }
    if (empty($_POST['name'])) {
        $errors[] = '<div class="alert alert-danger" role="alert">Veuillez saisir le nom de la planète</div>';
    }
    if ( empty($_POST['status'])) {
        $errors[] = '<div class="alert alert-danger" role="alert">Veuillez saisir le status de la planète</div>';
    }
    if ( empty($_POST['terrain'])) {
        $errors[] = '<div class="alert alert-danger" role="alert">
        Veuillez terrain le status de la planète</div>';
    }
    if ( empty($_POST['allegiance'])) {
        if(!in_array($_POST['allegiance'], getAllegiances())){
            $errors[] = 'Allegiance inconue !!!';
        }
        $errors[] = '<div class="alert alert-danger" role="alert">
        Veuillez terrain l\'allegiance de la planète</div>';
    }
    if ( empty($_POST['keyfact'])) {
        $errors[] = '<div class="alert alert-danger" role="alert">Veuillez la key fact de la planète</div>';
    }

    return ['errors'=>$errors, 'image'=>$imageUrl];
}