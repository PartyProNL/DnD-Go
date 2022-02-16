test
<?php
session_start();

// Session token weghalen
unset($_SESSION['session']);

// Verbinden met database
$db = new PDO('sqlite:../database/dndgo');

// Email ophalen voor in de query
$email = $_SESSION["session_email"];

// De session token weer verwijderen
$sql = "UPDATE users SET session=NULL WHERE email='".$email."'";
$resultaat = $db->exec($sql);

// Verbinding weer verbreken
$db = NULL;

// Email weghalen
unset($_SESSION['session_email']);

// Terug naar de login pagina
header('Location: ../login.php');
 ?>
