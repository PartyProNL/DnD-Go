test
<?php
session_start();

// Session token weghalen
unset($_SESSION['session']);

// Terug naar de login pagina
header('Location: ../login.php');
 ?>
