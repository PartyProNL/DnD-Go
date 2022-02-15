<?php
   ob_start();
   session_start();
?>

<html lang = "en">

   <head>
      <title>DnDGo login</title>
      <link href = "styles/style.css" rel = "stylesheet">
   </head>

   <body>
     <?php
     $password = $_POST["password"];
     $email = $_POST["email"];
     $user_id = "SELECT user_id
                  FROM users
                  WHERE email = '".$email."' AND
                  WHERE password = '".$password."'";


        if (true) {
          echo $user_id;
        }
     ?>

  </body>
         Click <a href = "home.html" tite = "Logout">here</a> to return to the homepage.

      </div>

   </body>
</html>
