<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="utf-8">
  <title>Een karakter aanmaken</title>
</head>
<body>
  <?php
    // Verbinden met de database
    $db = new PDO('sqlite:database/dndgo');

    // Voor-/achternaam, klasse, ras, level, xp en backstory ophalen uit de form
    $firstName = $_POST["first-name"];
    $lastName = $_POST["last-name"];
    $race = $_POST["race"];
    $class = $_POST["class"];
    $level = $_POST["level"];
    $xp = $_POST["xp"];
    $backstory = $_POST["backstory"];


      // Het account toevoegen
      $sql = "INSERT INTO characters (first_name, last_name, class_id, race_id, level, xp, backstory)
      VALUES ('".$firstName."','".$lastName."','".$class."','".$race."','".$level."','".$xp."','".$backstory."')";
      $resultaat = $db->exec($sql);

      // De verbinding weer sluiten
      $db = NULL;

      // Session gebruiken om door te geven dat een account is gemaakt
      session_start();
      $_SESSION["register_succeeded"] = "Je karakter is succesvol aangemaakt! Je kunt je karaccter nu bekijken in je dashboard.";

      // Doorsturen naar de login pagina
      header('Location: login.php');

  ?>
</body>
</html>