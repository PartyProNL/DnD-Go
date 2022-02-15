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
     $sql = "SELECT COUNT(user_id) AS aantal FROM users WHERE email = '".$email."' AND password = '".$password."'";
     $check = $db->query($sql);

     $aantalGevondenAccounts = 0;
     foreach ($check as $row) {
       $aantalGevondenAccounts = $row['aantal'];
     }
     echo $aantalGevondenAccounts;
     $db = NULL;
     ?>
    Click <a href = "home.html" tite = "Logout">here</a> to return to the homepage.
  </body>
</html>
