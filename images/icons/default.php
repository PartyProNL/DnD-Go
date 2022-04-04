<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>DnD Go | Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/style.css">
  </head>
  <body>
    <?php
    session_start();

    if(array_key_exists("session", $_SESSION)) {
      // De session token ophalen
      $session_token = $_SESSION["session"];

      // Email Ophalen
      $session_email = $_SESSION["session_email"];

      // Checken of de session token wel in de database zit
      $db = new PDO('sqlite:../database/dndgo');
      $sql = "SELECT COUNT(session) AS aantal FROM users WHERE session = '".$session_token."' AND email = '".$session_email."'";
      $resultaat = $db->query($sql);
      $db = null;

      // Ophalen hoeveel accounts er zijn gevonden met dezelfde session token
      $aantalGevondenAccounts = 0;
      foreach ($resultaat as $row) {
        $aantalGevondenAccounts = $row['aantal'];
      }

      if($aantalGevondenAccounts == 0) {
        // Session token weghalen
        unset($_SESSION['session']);

        // Bericht meegeven dat de sessie verlopen is
        $_SESSION["session_ended"] = "Je sessie is verlopen. Log opnieuw in.";

        // Doorsturen naar de login pagina
        header('Location: ../login.php');
      }
    } else {
      // Bericht meegeven dat de sessie verlopen is
      $_SESSION["session_ended"] = "Je sessie is verlopen. Log opnieuw in.";

      // Doorsturen naar de login pagina
      header('Location: ../login.php');
    }
     ?>

    <header>
      <div class="header-title-container">
        <div class="header-logo-container">
          <img src="../images/icons/wolf.svg" alt="" class="header-logo">
        </div>
        <div class="header-text-container">
          <h1 class="header-title">DnD Go</h1>
        </div>
      </div>
    </header>
    <div class="lower">
      <div class="sidebar">
        <div class="sidebar-upper">
          <div class="sidebar-upper-item-container">
            <div class="sidebar-upper-item-icon-container">
              <img src="../images/icons/people.png" alt="" class="sidebar-upper-item-icon">
            </div>
            <div class="sidebar-upper-item-text-container">
              <a class="sidebar-upper-item-text" href="characters.php">Karakters</a>
            </div>
          </div>

          <div class="sidebar-upper-item-container">
            <div class="sidebar-upper-item-icon-container">
              <img src="../images/icons/elf.png" alt="" class="sidebar-upper-item-icon">
            </div>
            <div class="sidebar-upper-item-text-container">
              <a class="sidebar-upper-item-text" href="races.php">Races</a>
            </div>
          </div>

          <div class="sidebar-upper-item-container">
            <div class="sidebar-upper-item-icon-container">
              <img src="../images/icons/shield.png" alt="" class="sidebar-upper-item-icon">
            </div>
            <div class="sidebar-upper-item-text-container">
              <a class="sidebar-upper-item-text" href="classes.php">Classes</a>
            </div>
          </div>
        </div>
        <div class="sidebar-middle">
          <div class="sidebar-separator"></div>
        </div>
        <div class="sidebar-lower">
          <div class="sidebar-lower-item-container">
            <div class="sidebar-lower-item-icon-container">
              <img src="../images/icons/setting.png" alt="" class="sidebar-lower-item-icon">
            </div>
            <div class="sidebar-lower-item-text-container">
              <a class="sidebar-lower-item-text" href="settings.php">Instellingen</a>
            </div>
          </div>

          <div class="sidebar-lower-item-container">
            <div class="sidebar-lower-item-icon-container">
              <img src="../images/icons/logout.png" alt="" class="sidebar-lower-item-icon">
            </div>
            <div class="sidebar-lower-item-text-container">
              <a class="sidebar-lower-item-text" href="logoutprocess.php">Uitloggen</a>
            </div>
          </div>
        </div>
      </div>
      <div class="page">

      </div>
    </div>
  </body>
</html>
