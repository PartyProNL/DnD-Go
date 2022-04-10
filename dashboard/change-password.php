<?php
  // Verbinden met de database
  $db = new PDO('sqlite:../database/dndgo');

  // De e-mail van de gebruiker ophalen om zometeen in de database te gebruiken
  session_start();
  $email = $_SESSION["session_email"];

  $sql = "SELECT password FROM users WHERE email='".$email."'";
  $resultaat = $db->query($sql);

  $oud_wachtwoord_echt = "";
  foreach ($resultaat as $row) {
    $oud_wachtwoord_echt = $row['password'];
  }

  // Gegevens uit de form ophalen
  $old = $_POST["old"];
  $new = $_POST["new"];
  $repeat = $_POST["repeat"];

  if($old == $oud_wachtwoord_echt) {
    if ($new == $repeat) {
      // Wachtwoord updaten in de database
      $sql = "UPDATE users SET password='".$new."' WHERE email='".$email."'";
      $resultaat = $db->exec($sql);
    } else {
      // Error sturen van dat de nieuwe e-mail en de herhaling ervan niet dezelfde waarde hebben
      $_SESSION["password_change_error"] = "Nieuw wachtwoord en de herhaling daarvan zijn niet hetzelfde";
    }
  } else {
    // Error sturen dat de ingevoerde oude e-mail en de daadwerkelijke oude e-mail niet hetzelfde zijn
    $_SESSION["password_change_error"] = "Oud wachtwoord is onjuist";
  }

  // Gebruiker terugsturen naar de settings pagina
  header('Location: settings.php');
?>
