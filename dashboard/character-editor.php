<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>DnD Go | Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
  </head>
  <body>
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
        <div class="bewerken-header">
          <p class="bewerken-header-txt">Karakter bewerken</p>
        </div>
        <div class="gegevens">
            <div class="gegevens-header">
              <p class="gegevens-header-txt">Gegevens bewerken</p>
            </div>
            <div class="gegevens-veranderen">
                <form class="character-editoror-form-form" action="characterprocess.php" method="post">
                  <div class="character-editoror-form-input-container-container">
                    <div class="character-editoror-form-input-container">
                      <p class="character-editoror-form-text character-editoror-form-text-first-name">Vooraam</p>
                      <input class="character-editoror-form-input" type="text" name="first-name" required><br>
                      <p class="character-editoror-form-text character-editoror-form-text-last-name">Achteraam</p>
                      <input class="character-editoror-form-input" type="text" name="last-name" required><br>
                      <p class="character-editoror-form-text character-editoror-form-text-race">Ras</p>
                      <select class="character-editoror-form-input" type="number" name="race" value="" required>
                         <option value="1">Dragonborn</option>
                         <option value="2">Dwarf</option>
                         <option value="4">Elf</option>
                         <option value="5">Gnome</option>
                         <option value="6">Human</option>
                      </select>
                      <p class="character-editoror-form-text character-editoror-form-text-class">Klasse</p>
                      <select class="character-editoror-form-input" type="number" name="class" value="" required>
                         <option value="1">Barbarian</option>
                         <option value="2">Bard</option>
                         <option value="3">Cleric</option>
                         <option value="4">Druid</option>
                         <option value="6">Fighter</option>
                      </select>
                      <p class="character-editoror-form-text character-editoror-form-text-level">Level</p>
                      <input class="character-editoror-form-input" type="text" name="level" value="" required><br>
                      <p class="character-editoror-form-text character-editoror-form-text-xp">XP</p>
                      <input class="character-editoror-form-input" type="text" name="xp" value="" required><br>
                      <p class="character-editoror-form-text character-editoror-form-text-backstory">Achtergrond</p>
                      <input class="character-editoror-form-input" type="text" name="backstory" value="" required><br>
                      <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
                    </div>
                  </div>
                  <input class="gegevens-veranderen-bevestigen" type="submit">
                </form>
            </div>
        </div>
        <div class="karakter-verwijderen">
            <div class="gegevens-header">
              <p class="gegevens-header-txt">Karakter verwijderen</p>
            </div>
            <div class="gegevens-veranderen">
                <form class="character-editoror-form-form" action="characterprocess.php" method="post">
                  <div class="character-editoror-form-input-container-container">
                    <div class="character-editoror-form-input-container">
                      <p class="character-editoror-form-text character-editoror-form-text-first-name">Email voor bevestiging</p>
                      <input class="character-editoror-form-input" type="text" name="email" required><br>
                      <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
                  </div>
                  <input class="gegevens-veranderen-bevestigen" type="submit">
                </form>
            </div>
        </div>
      </div>
    </div>
  </body>
</html>
