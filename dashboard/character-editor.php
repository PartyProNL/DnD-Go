<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>DnD Go | Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/character-editor.css">
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
        <a href="../home.html">
          <div class="header-logo-container">
          <img src="../images/icons/wolf.svg" alt="" class="header-logo">
          </div>
        </a>
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

        <?php
        $db = new PDO('sqlite:../database/dndgo');
        $characterId =  $_POST['id'];
        $sql2 = "SELECT * FROM characters WHERE character_id = '".$characterId."'";
        $result2 = $db->query($sql2);

        $first_name = "";
        $last_name = "";
        $backstory = "";
        $level = "";
        $xp = "";
        foreach ($result2 as $row) {
          $first_name = $row['first_name'];
          $last_name = $row['last_name'];
          $backstory = $row['backstory'];
          $level = $row['level'];
          $xp = $row['xp'];
        }

        $db = null;
        ?>

        <div class="ce-page">
          <div class="ce-page-inner">
            <div class="ce-page-inner-upper">
              <div class="ce-page-topper">
                <h2 class="ce-page-topper-text">Bewerken van <?php echo $first_name." ".$last_name; ?></h2>
              </div>
            </div>
            <div class="ce-page-inner-lower">
              <div class="page-item page-item-left">
                <div class="page-item-topper">
                  <h2 class="page-item-topper-text">Algemeen</h2>
                </div>
                <div class="page-item-lower">
                  <div class="page-item-lower-inner">
                    <form class="email-form" action="character-editor-general.php" method="post">
                      <div class="email-form-item-container">
                        <p class="email-form-input-text">Voornaam</p>
                        <input class="email-form-input" type="text" name="first_name" value="<?php echo $first_name;  ?>" required><br>
                      </div>
                      <div class="email-form-item-container">
                        <p class="email-form-input-text">Achternaam</p>
                        <input class="email-form-input" type="text" name="last_name" value="<?php echo $last_name;  ?>" required><br>
                      </div>
                      <div class="email-form-item-container backstory">
                        <p class="email-form-input-text">Achtergrond</p>
                        <input class="email-form-input backstory-input" type="text" name="backstory" value="<?php echo $backstory;  ?>" required><br>
                      </div>
                      <div class="email-form-submit-container">
                        <input type="hidden" name="character_id" value="<?php echo $_POST['id']; ?>">
                        <input class="email-form-submit" type="submit">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="page-item page-item-right">
                <div class="page-item-topper topper-right">
                  <h2 class="page-item-topper-text">Verwijderen</h2>
                </div>
                <div class="overig-lower">
                  <form class="overig-verwijder" action="character-editor-delete.php" method="post">
                    <div class="overig-verwijder-container">
                      <div class="email-form-item-container overig-input-container">
                        <p class="email-form-input-text">E-mail (voor bevestiging)</p>
                        <input class="email-form-input overig-input" type="text" name="old" required><br>
                        <input type="hidden" name="character_id" value="<?php echo $_POST['id']; ?>">
                      </div>
                      <div class="email-form-submit-container">
                        <input class="email-form-submit overig-confirm" type="submit" value="Karakter verwijderen">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="page-item page-item-middle">
                <div class="page-item-topper">
                  <h2 class="page-item-topper-text">Levels</h2>
                </div>
                <div class="page-item-lower">
                  <div class="page-item-lower-inner">
                    <form class="email-form" action="character-editor-levels.php" method="post">
                      <div class="email-form-item-container">
                        <p class="email-form-input-text">Level</p>
                        <input class="email-form-input" type="text" name="level" value="<?php echo $level;  ?>" required><br>
                      </div>
                      <div class="email-form-item-container">
                        <p class="email-form-input-text">Experience</p>
                        <input class="email-form-input" type="text" name="experience" value="<?php echo $xp;  ?>" required><br>
                      </div>
                      <div class="email-form-item-container">

                      </div>
                      <div class="email-form-error-container">

                      </div>
                      <div class="email-form-submit-container">
                        <input type="hidden" name="character_id" value="<?php echo $_POST['id']; ?>">
                        <input class="email-form-submit" type="submit">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </body>
</html>
