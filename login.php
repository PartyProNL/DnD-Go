<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>DnD Go | Inloggen</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/loginstyle.css">
  </head>
  <body>
    <?php
    session_start();

    if(array_key_exists("session", $_SESSION)) {
      header('Location: dashboard/dashboard.php');
    }
     ?>

    <div class="login-page">
      <div class="login-menu">
        <div class="login-menu-top">
          <h2 class="login-menu-top-title">Inloggen</h2>
          <div class="login-menu-top-line"></div>
        </div>
        <div class="login-menu-form">
          <form class="login-menu-form-form" action="loginprocess.php" method="post">
            <div class="login-menu-form-input-container-container">
              <div class="login-menu-form-input-container">
                <p class="login-menu-form-text">E-mailadres</p>
                <input class="login-menu-form-input" type="text" name="email" required><br>
                <p class="login-menu-form-text login-menu-form-text-password">Wachtwoord</p>
                <input class="login-menu-form-input" type="text" name="password" value="" required><br>
              </div>
            </div>

            <input class="login-menu-form-submit" type="submit" value="Inloggen">
          </form>
        </div>
        <div class="login-menu-error-container">
          <?php
          if(array_key_exists("register_succeeded", $_SESSION)) {
            $registered_message = $_SESSION["register_succeeded"];
            echo "<p class=\"login-menu-error-text\">".$registered_message."</p>";
            unset($_SESSION['register_succeeded']);
          }

          if(array_key_exists("login_failed", $_SESSION)) {
            $fail_message = $_SESSION["login_failed"];
            echo "<p class=\"login-menu-error-text\">".$fail_message."</p>";
            unset($_SESSION['login_failed']);
          }

          if(array_key_exists("session_ended", $_SESSION)) {
            $fail_message = $_SESSION["session_ended"];
            echo "<p class=\"login-menu-error-text\">".$fail_message."</p>";
            unset($_SESSION['session_ended']);
          }
           ?>
        </div>

        <div class="login-menu-separator">
          <div class="login-menu-separator-line">
          </div>
        </div>

        <div class="login-menu-register">
          <a class="login-menu-register-button" href="register.php">Registreren</a>
        </div>
      </div>
    </div>
  </body>
</html>
