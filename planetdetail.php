<?php
require_once 'pdo_connect.php';
require_once 'functions.php';
include 'menu.php';
?>


<div class="text-white text-center">
    <?php
    $res = $pdo->prepare('SELECT * FROM planets WHERE id = :id');
    $res->execute(['id'=> $_GET['id']]);
    $fetchRes = $res->fetch();
    ?>

        <h1><?php echo($fetchRes['name']) ?></h1><br>
        <img  src="<?php echo('images/planets/'.$fetchRes['image']); ?>"
              alt="Image de la planète <?php echo($fetchRes['name']); ?>" > <br>
        <h2><u>Allegiance : </u> <?php echo($fetchRes['allegiance']) ?></h2>
        <div><u>Key facts : </u> <?php echo($fetchRes['key_fact']) ?></div>
        <div><u>Terrain : </u> <?php echo($fetchRes['terrain']) ?></div>
        <?php $res->closeCursor(); ?>
</div>
