<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>DnD Go | Registreren</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/registerstyle.css">
  </head>
  <body>


     <div class="register-page">
       <div class="register-menu">
         <div class="register-menu-top">
           <h2 class="register-menu-top-title">Registreren</h2>
           <div class="register-menu-top-line"></div>
         </div>
         <div class="register-menu-form">
           <form class="register-menu-form-form" action="registerprocess.php" method="post">
             <div class="register-menu-form-input-container-container">
               <div class="register-menu-form-input-container">
                 <p class="register-menu-form-text">E-mailadres</p>
                 <input class="register-menu-form-input" type="text" name="email" required><br>
                 <p class="register-menu-form-text register-menu-form-text-password">Wachtwoord</p>
                 <input class="register-menu-form-input" type="text" name="password" value="" required><br>
               </div>
             </div>

             <input class="register-menu-form-submit" type="submit">
           </form>
         </div>
         <div class="register-menu-error-container">
           <?php
            session_start();

            if(array_key_exists("register_failed", $_SESSION)) {
              $fail_message = $_SESSION["register_failed"];
              echo $fail_message."<br>";
              unset($_SESSION['register_failed']);
            }

            session_destroy();
            ?>
         </div>

         <div class="register-menu-separator">
           <div class="register-menu-separator-line">
           </div>
         </div>

         <div class="login-menu-login">
           <a class="login-menu-login-button" href="login.php">Inloggen</a>
         </div>
       </div>
     </div>
  </body>
</html>
