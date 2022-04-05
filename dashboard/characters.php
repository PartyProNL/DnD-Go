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
        <div class="character-new">
          <p class="character-new-txt">Welkom terug
          <?php
          // Verbinden met de database
          $email = $_SESSION["session_email"];
          $cut = explode("@",$email);
          echo $cut[0];
          ?>
          </p>
          <div class="character-new-plus">
            <a href="character-creation.php">
              <img class="character-new-plus-pic"src="../images/icons/Plus.png" alt="Plus!">
            </a>
          </div>
        </div>
        <div class="characters-container">
          <div class="characters-available">
            <div class="characters-available-header">
              <p class="characters-available-header-txt">Lijst van beschikbare classes</p>
            </div>
            <div class="scroll">
              <?php
              // Verbinden met de database
              $db = new PDO('sqlite:../database/dndgo');
              //Eerst characters ophalen van de huidige gebruiker Email
              //Dan exploden voor losse getallen
              //Vervolgens voor elk karacter het id ophalen
              $sql = "SELECT * FROM characters";
              $charaterResult = $db->query($sql);

              foreach ($characterResult as $row) {
                $name = $row['character_'];
                $desc = $row['race_description'];
                echo "<div class=\"race-desc\">
                  <div class=\"race-desc-header\">
                    <h3>$name</h3>
                  </div>
                  <p class=\"race-desc-txt\">$desc</p>
                </div>";
              }
              $db = NULL;
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
