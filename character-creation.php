<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>DnD Go | Character-Creator</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/style.css">
  </head>
  <body>


     <div class="character">
       <div class="character-creator">
         <div class="character-creator-top">
           <h2 class="character-creator-top-title">Character creator</h2>
         </div>
         <div class="character-creator-form">
           <form class="character-creator-form-form" action="characterprocess.php" method="post">
             <div class="character-creator-form-input-container-container">
               <div class="character-creator-form-input-container">
                 <p class="character-creator-form-text character-creator-form-text-first-name">Naam</p>
                 <input class="character-creator-form-input" type="text" name="first-name" required><br>
                 <p class="character-creator-form-text character-creator-form-text-last-name">Achteraam</p>
                 <input class="character-creator-form-input" type="text" name="last-name" required><br>
                 <p class="character-creator-form-text character-creator-form-text-race">Ras</p>
                 <select class="character-creator-form-input" type="number" name="race" value="" required>
                    <option value="1">Dragonborn</option>
                    <option value="2">Dwarf</option>
                    <option value="4">Elf</option>
                    <option value="5">Gnome</option>
                    <option value="6">Human</option>
                 </select>
                 <p class="character-creator-form-text character-creator-form-text-class">Klasse</p>
                 <select class="character-creator-form-input" type="number" name="class" value="" required>
                    <option value="1">Barbarian</option>
                    <option value="2">Bard</option>
                    <option value="3">Cleric</option>
                    <option value="4">Druid</option>
                    <option value="6">Fighter</option>
                 </select>
                 <p class="character-creator-form-text character-creator-form-text-level">Level</p>
                 <input class="character-creator-form-input" type="text" name="level" value="" required><br>
                 <p class="character-creator-form-text character-creator-form-text-xp">XP</p>
                 <input class="character-creator-form-input" type="text" name="xp" value="" required><br>
                 <p class="character-creator-form-text character-creator-form-text-backstory">Achtergrond</p>
                 <input class="character-creator-form-input" type="text" name="backstory" value="" required><br>
               </div>
             </div>

             <input class="character-creator-form-submit" type="submit">
           </form>
         </div>
         <div class="character-creator-error-container">
           <?php
            session_start();

            if(array_key_exists("character_failed", $_SESSION)) {
              $fail_message = $_SESSION["character_failed"];
              echo $fail_message."<br>";
              unset($_SESSION['character_failed']);
            }

            session_destroy();
            ?>
         </div>

       </div>
     </div>
  </body>
</html>
