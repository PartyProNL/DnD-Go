<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="utf-8">
  <title>Een leverancier toevoegen</title>
</head>
<body>
  <?php
    // Verbinden met de database
    $db = new PDO('sqlite:database/dndgo');

    // Wachtwoord en email ophalen uit de form
    $password = $_POST["password"];
    $email = $_POST["email"];

    // Versturen van de query
    $select = "SELECT COUNT(email) AS aantal FROM users WHERE email = '".$email."'";
    $check = $db->query($select);

    // Ophalen hoeveel accounts er al bestaan met de gebruikte mail
    $aantalGevondenAccounts = 0;
    foreach ($check as $row) {
      $aantalGevondenAccounts = $row['aantal'];
    }

    // If check om de juiste actie uit te voeren als er al accounts zijn
    if($aantalGevondenAccounts > 0) {
      // Session gebruiken om op te slaan wat er gebeurd is
      session_start();
      $_SESSION["register_failed"] = "Er bestaat al een account met deze e-mail!";

      // Terugsturen naar de register pagina
      header('Location: register.php');
    } else {
      // De leveranciertoevoegen
      $sql = "INSERT INTO users (email, password, characters) VALUES ('".$email."', '".$password."', '')";
      $resultaat = $db->exec($sql);

      // De verbinding weer sluiten
      $db = NULL;

      // Session gebruiken om door te geven dat een account is gemaakt
      session_start();
      $_SESSION["register_succeeded"] = "Je account is succesvol aangemaakt! Gebruik nu dezelfde gegevens om in te loggen";

      // Doorsturen naar de login pagina
      header('Location: login.php');
    }
  ?>
</body>
</html>
