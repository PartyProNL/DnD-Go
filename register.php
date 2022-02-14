<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="utf-8">
  <title>Een leverancier toevoegen</title>
</head>
<body>
  <?php
  $db = new PDO('sqlite:database/dndgo');
    $password = $_POST["password"];
    $email = $_POST["email"];
    $select = "SELECT COUNT(email) AS aantal FROM users WHERE email = '".$email."'";
    $check = $db->exec($select);
    echo count($check);
    echo "Aantal gevonden users: ";
  if(true) {
    exit('This email address is already used!');
    }
  else {
  // De leveranciertoevoegen
  $sql = "INSERT INTO users (email, password, characters)
  VALUES ('".$email."', '".$password."', '')";
  $resultaat = $db->exec($sql);
  echo 'Aantal toegevoegde accounts: '.$resultaat;
  $db = NULL;
  }
  ?>
</body>
</html>
