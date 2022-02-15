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
      $_SESSION["register_failed"] = "email_already_exists";

      // Terugsturen naar de register pagina
      header('Location: register.php');
    } else {
      // De leveranciertoevoegen
      $sql = "INSERT INTO users (email, password, characters) VALUES ('".$email."', '".$password."', '')";
      $resultaat = $db->exec($sql);
      echo 'Aantal toegevoegde accounts: '.$resultaat;
      $db = NULL;
    }
  ?>
</body>
</html>
