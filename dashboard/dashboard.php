<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>DnD Go | Inloggen</title>
  </head>
  <body>
    <?php
    session_start();

    if(array_key_exists("session", $_SESSION)) {
      $session_token = $_SESSION["session"];
      echo $session_token."<br>";

      // Checken of de session token wel erin zit
    } else {
      // Session token weghalen
      unset($_SESSION['session']);

      // Bericht meegeven dat de sessie verlopen is
      $_SESSION["session_ended"] = "Je sessie is verlopen. Log opnieuw in.";

      // Doorsturen naar de login pagina
      header('Location: ../login.php');
    }

    session_destroy();
     ?>

    Dit is de dashboard
  </body>
</html>
