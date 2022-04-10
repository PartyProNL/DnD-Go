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

  if($old == $actual_old) {
    if ($new == $repeat) {
      if(filter_var($new, FILTER_VALIDATE_EMAIL)) {
        // E-mail updaten in de sessie zodat de gebruiker niet uitgelogd wordt
        $_SESSION["session_email"] = $new;

        // E-mail updaten in de database
        $sql = "UPDATE users SET email='".$new."' WHERE email='".$actual_old."'";
        $resultaat = $db->exec($sql);
      } else {
        // Error sturen van dat de nieuwe e-mail niet geldig is (@-teken mist of domein mist, etc.)
        $_SESSION["email_change_error"] = "Het nieuwe e-mailadres is ongeldig";
      }
    } else {
      // Error sturen van dat de nieuwe e-mail en de herhaling ervan niet dezelfde waarde hebben
      $_SESSION["email_change_error"] = "Nieuwe e-mail en de herhaling zijn niet hetzelfde";
    }
  } else {
    // Error sturen dat de ingevoerde oude e-mail en de daadwerkelijke oude e-mail niet hetzelfde zijn
    $_SESSION["email_change_error"] = "Oude email is onjuist";
  }

  // Gebruiker terugsturen naar de settings pagina
  header('Location: settings.php');
?>
