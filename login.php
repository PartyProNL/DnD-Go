<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>DnD Go | Inloggen</title>
  </head>
  <body>
    <?php
    session_start();

    if(array_key_exists("register_succeeded", $_SESSION)) {
      $registered_message = $_SESSION["register_succeeded"];
      echo $registered_message."<br>";
      unset($_SESSION['register_succeeded']);
    }

    if(array_key_exists("login_failed", $_SESSION)) {
      $fail_message = $_SESSION["login_failed"];
      echo $fail_message."<br>";
      unset($_SESSION['login_failed']);
    }

    if(array_key_exists("session_ended", $_SESSION)) {
      $fail_message = $_SESSION["session_ended"];
      echo $fail_message."<br>";
      unset($_SESSION['session_ended']);
    }

    session_destroy();
     ?>

    <form action="loginprocess.php" method="post">
      Email<input type="text" name="email" value=""><br>
      Wachtwoord<input type="text" name="password" value=""><br>
      <input type="submit">
    </form>
  </body>
</html>
