<?php
// Verbinden met de database
$db = new PDO('sqlite:../database/dndgo');

// Form ophalen
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$backstory = $_POST['backstory'];
$id = $_POST['character_id'];

// SQL Query
$sql = "UPDATE characters SET first_name='$first_name',last_name='$last_name',backstory='$backstory' WHERE character_id='$id'";
$result = $db->exec($sql);

// Gebruiker terugsturen naar karakters/home pagina (karakter bewerk lukt niet, post data meesturen die nodig is lukt niet?)
header('Location: characters.php');
?>
