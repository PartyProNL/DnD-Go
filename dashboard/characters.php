<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>DnD Go | Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/characters.css">
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
        <div class="characters-page">
          <div class="characters-topper">
            <div class="characters-topper-left">
              <p class="character-topper-text">Welkom terug <?php
              // Verbinden met de database
              $email = $_SESSION["session_email"];
              $cut = explode("@",$email);
              echo $cut[0];
              ?></p>
            </div>
            <div class="characters-topper-right">
              <a class="characters-create-icon-container" href="character-creation.php"><img class="characters-create-icon" src="../images/icons/Plus.png" alt=""></a>
            </div>
          </div>
          <div class="characters-lower">
            <?php
            // Verbinden met de database
            $db = new PDO('sqlite:../database/dndgo');

            $email = $_SESSION["session_email"];
            $sql2 = "SELECT characters FROM users WHERE email = '".$email."'";
            $resultaat2 = $db->query($sql2);

            $gevondenCharacters = "";
            foreach ($resultaat2 as $row) {
              $gevondenCharacters = $row["characters"];
            }

            $splitCharacters = array_map("intval", explode(",", $gevondenCharacters));

            foreach($splitCharacters as $id) {
              if($id != 0) {
                $characterSql = "SELECT * FROM characters WHERE character_id='".$id."'";
                $result = $db->query($characterSql);

                foreach ($result as $row) {
                  $name = $row['first_name']." ".$row['last_name'];
                  $backstory = $row['backstory'];

                  echo "<div class=\"character-list-test\">
                    <div class=\"character-topper\">
                      <h1 class=\"character-name\">$name</h1>
                    </div>
                    <div class=\"character-lower\">
                      <div class=\"character-backstory-container\">
                        <p class=\"character-backstory\">$backstory</p>
                      </div>
                      <div class=\"character-button-container\">
                        <form class=\"character-button-form\" action=\"view-character.php\" method=\"post\">
                          <input type=\"hidden\" name=\"id\" value=\"$id\">
                          <input class=\"character-button\" type=\"submit\" value=\"Bekijken\">
                        </form>
                      </div>
                      <div class=\"character-button-container\">
                        <form class=\"character-button-form\" action=\"character-editor.php\" method=\"post\">
                          <input type=\"hidden\" name=\"id\" value=\"$id\">
                          <input class=\"character-button\" type=\"submit\" value=\"Bewerken\">
                        </form>
                      </div>
                    </div>
                  </div>";
                }
              }
            }

            // Database connectie weer sluiten
            $db = NULL;
            ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
