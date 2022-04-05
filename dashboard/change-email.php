<?php
  // Verbinden met de database
  $db = new PDO('sqlite:../database/dndgo');

  // De e-mail van de gebruiker ophalen om zometeen in de database te gebruiken
  session_start();
  $actual_old = $_SESSION["session_email"];

  // Gegevens uit de form ophalen
  $old = $_POST["old"];
  $new = $_POST["new"];
  $repeat = $_POST["repeat"];

  // Kijken of de oude email klopt
  if($old == $actual_old) {
    echo "succes";
  } else {
    echo "fail";
  }
  echo "$actual_old $old $new $repeat";
?>
