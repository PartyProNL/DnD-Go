<html lang = "en">
   <head>
      <title>DnDGo login</title>
      <link href = "styles/style.css" rel = "stylesheet">
   </head>
   <body>
     <?php
     // Verbinden met de database
     $db = new PDO('sqlite:database/dndgo');

     // Email en password ophalen uit de form
     $password = $_POST["password"];
     $email = $_POST["email"];

     // SQL query maken en uitvoeren
     $sql = "SELECT COUNT(user_id) AS aantal FROM users WHERE email = '".$email."' AND password = '".$password."'";
     $check = $db->query($sql);

     // Ophalen hoeveel accounts er zijn gevonden
     $aantalGevondenAccounts = 0;
     foreach ($check as $row) {
       $aantalGevondenAccounts = $row['aantal'];
     }

     // If check om het juiste uit te uitvoeren
     if($aantalGevondenAccounts > 0) {
       // Session token generaten
       $session_token = rand(0, 9999999);

       // Deze token in de database stoppen
       $sql = "UPDATE users SET session='".$session_token."' WHERE email='".$email."'";
       $resultaat = $db->exec($sql);

       // Verbinding weer sluiten
       $db = NULL;

       // Session token in de session stoppen
       session_start();
       $_SESSION["session"] = $session_token;
       $_SESSION["session_email"] = $email;

       // Doorsturen naar de dashboard home pagina
       header('Location: dashboard/dashboard.php');
     } else {
       // Verbinding weer sluiten
       $db = NULL;

       // Session gebruiken om door te geven dat de gegevens niet kloppen
       session_start();
       $_SESSION["login_failed"] = "De opgegeven e-mail of wachtwoord klopt niet";

       // Doorsturen naar de login pagina
       header('Location: login.php');
     }

     ?>
    Click <a href = "home.html" tite = "Logout">here</a> to return to the homepage.
  </body>
</html>
