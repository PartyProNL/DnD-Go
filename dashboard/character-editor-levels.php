<?php
// Verbinden met de database
$db = new PDO('sqlite:../database/dndgo');

// Form ophalen
$level = $_POST['level'];
$experience = $_POST['experience'];
$id = $_POST['character_id'];

// SQL Query
$sql = "UPDATE characters SET level='$level',xp='$experience' WHERE character_id='$id'";
$result = $db->exec($sql);

// Gebruiker terugsturen naar karakters/home pagina (karakter bewerk lukt niet, post data meesturen die nodig is lukt niet?)
header('Location: characters.php');
?>
