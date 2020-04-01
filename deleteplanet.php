<?php
require_once 'pdo_connect.php';
require_once 'functions.php';
$id = $_GET['id'];
deletePlanet($pdo, $id);
header('Location: viewplanet.php');
?>