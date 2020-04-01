<?php
include 'menu.php';

require_once 'pdo_connect.php';
?>

<div class="container my-2">
    <h1 class="text-center shadow p-2 bg-dark text-white">Page qui liste nos planètes</h1>
        <h2 class="text-center shadow p-2 bg-dark text-white">Les planètes disponibles dans notre base de donnée :</h2>

        <table class="table table-dark shadow">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Terrain</th>
                <th scope="col">Allegiance</th>
                <th scope="col">Key facts</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
                <!--<th scope="col">Action</th>-->
            </tr>
            </thead>
            <tbody>
            <?php
            $reponse = $pdo->query('SELECT * FROM planets');
            while ($data = $reponse->fetch())
            {
                ?>
                <tr>
                    <td><?php echo($data['id']); ?></td>
                    <td><?php echo($data['name']); ?></td>
                    <td><?php echo($data['status']); ?></td>
                    <td><?php echo($data['terrain']); ?></td>
                    <td><?php echo($data['allegiance']); ?></td>
                    <td><?php echo($data['key_fact']); ?></td>
                    <td>
                        <img style="max-width: 140px;" src="<?php echo('images/planets/'.$data['image']); ?>"
                            alt="Image de la planète <?php echo($data['name']); ?>"/>
                    </td>
                    <td>
                        <a title="Voir le détail" href="planetdetail.php?id=<?php echo($data['id']); ?>">
                            <i class="fa fa-eye text-primary mx-2"></i>
                        </a>

                        <a title="Editer" href="edit-planet.php?id=<?php echo($data['id']); ?>">
                            <i class="fa fa-edit text-warning mx-2"></i>
                        </a>

                        <a title="Supprimer" href="http://www.google.fr">
                            <i class="fa fa-trash text-danger mx-2"></i>
                        </a>
                    </td>


                </tr>
                <?php
            }
            $reponse->closeCursor();
            ?>

            </tbody>
        </table>
</div>

