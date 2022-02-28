<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>DnD Go | Registreren</title>
  </head>
  <body>
    <?php
    session_start();

    if(array_key_exists("register_failed", $_SESSION)) {
      $fail_message = $_SESSION["register_failed"];
      echo $fail_message."<br>";
      unset($_SESSION['register_failed']);
    }

    session_destroy();
     ?>

    <form action="registerprocess.php" method="post">
      Email<input type="text" name="email" value="" required><br>
      Wachtwoord<input type="text" name="password" value="" required><br>
      <input type="submit">
    </form>
  </body>
</html>
