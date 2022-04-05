<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="utf-8">
  <title>Een karakter aanmaken</title>
</head>
<body>
  <?php
    // Verbinden met de database
    $db = new PDO('sqlite:../database/dndgo');

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

      //Koppelen karakter aan gebruiker
      session_start();
      $email = $_SESSION["session_email"];
      $sql2 = "SELECT characters FROM users WHERE email = '".$email."'";
      $resultaat2 = $db->query($sql2);

      $sql3 = "SELECT character_id FROM characters WHERE first_name = '$firstName' AND last_name = '$lastName'";
      $resultaat3 = $db->query($sql3);

      $gevondenCharacterid = "";
      foreach ($resultaat3 as $row) {
        $gevondenCharacterid = $row["character_id"];
      }

      $gevondenCharacters = "";
      foreach ($resultaat2 as $row) {
        $gevondenCharacters = $row["characters"];
      }

      $splitCharacters = array_map("intval", explode(",", $gevondenCharacters));

      array_push($splitCharacters, intval($gevondenCharacterid));

      $newList = implode(",", $splitCharacters);
      $sql4 = "UPDATE users SET characters='$newList' WHERE email='$email'";

      $resultaat4 = $db->exec($sql4);

      // De verbinding weer sluiten
      $db = NULL;

      // Session gebruiken om door te geven dat een account is gemaakt
      $_SESSION["register_succeeded"] = "Je karakter is succesvol aangemaakt! Je kunt je karaccter nu bekijken in je dashboard.";

      // Doorsturen naar de login pagina
      //header('Location: characters.php');

  ?>
</body>
</html>
