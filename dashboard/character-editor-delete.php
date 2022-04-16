<?php
// Verbinden met de database
$db = new PDO('sqlite:../database/dndgo');

// De e-mail van de gebruiker ophalen om zometeen in de database te gebruiken
session_start();
$actual_old = $_SESSION["session_email"];

// Gegevens uit de form ophalen
$old = $_POST["old"];
$character_id = $_POST['character_id'];

// Checken of de e-mail voor de bevestiging klopt
if($old == $actual_old) {
  // Account verwijderen
  $sql = "DELETE FROM characters WHERE character_id='$character_id'";
  $result = $db->exec($sql);
}

// Gebruiker terugsturen naar de settings pagina (als het account verwijderd is wordt de gebruiker automatisch doorverstuurd naar de login)
header('Location: characters.php');
?>
