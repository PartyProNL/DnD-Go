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
     $db = new PDO('sqlite:database/dndgo');
     $password = $_POST["password"];
     $email = $_POST["email"];
     $sql = "SELECT COUNT(user_id) AS check FROM users WHERE email = '".$email."' AND WHERE password = '".$password."'";
    $check = $db->query($sql);

    $aantalGevondenAccounts = 0;
    foreach ($check as $row) {
      $aantalGevondenAccounts = $row['check'];
    }
    echo $aantalGevondenAccounts;
    $db = NULL;
     ?>

  </body>
         Click <a href = "home.html" tite = "Logout">here</a> to return to the homepage.

      </div>

   </body>
</html>
