<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>DnD Go | Registreren</title>
  </head>
  <body>
    <?php
    session_start();
    //$register_failed = $_SESSION["register_failed"];

    print_r($_SESSION);

    unset($_SESSION['register_failed']);
    session_destroy();
     ?>

    <form action="registerprocess.php" method="post">
      Email<input type="text" name="email" value=""><br>
      Wachtwoord<input type="text" name="password" value=""><br>
      <input type="submit">
    </form>
  </body>
</html>
