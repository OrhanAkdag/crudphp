<?php
$imageUrl = null;

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

function valideForm(){
    if($_FILES['image']['type'] === 'image/png'){
        if($_FILES['image']['size'] < 800000){
            $extension = explode('/', $_FILES['image']['type'])[1];
            $imageUrl = uniqid().'.'.$extension;
            move_uploaded_file($_FILES['image']['tmp_name'],'images/planets/'.$imageUrl);
        }
        else {
            $errors[] = 'Fichier trop lourd ';
        }
    }    
    else {
        $errors[] = 'J\'accepte que les fichiers png';
    }
    if(empty($_POST['name'])){
        $errors[] = 'Veuillez saisir le nom de la planète';
    }
    if(empty($_POST['status'])){
        $errors[] = 'Veuillez saisir le status de la planète';
    }
    if(empty($_POST['terrain'])){
        $errors[] = 'Veuillez saisir le terrain de la planète';
    }
    if(empty($_POST['allegiance'])){
        if(!in_array($_POST['allegiance'], getAllegiances())){
            $errors[] = 'allegiance inconnue';
        }
    }
    if(empty($_POST['keyfact'])){
        $errors[] = 'Veuillez saisir la key fact de la planète';
    }
    return $errors;
}
