<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <form action="login.php" method="post">
      <input type="text" name="username" placeholder="Nombre de usuario">
      <input type="password" name="password" placeholder="Password">
      <input type="submit" value="Iniciar sesión">
    </form>
    <?php
      $db = getenv("DATABASE_URL");
      $conn = pg_connect($db) or die('Error: '.pg_last_error());
      echo '<p>Conectado</p>';
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $query = "SELECT * FROM users WHERE username='$user' and password='$password'";
        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());
        if (pg_num_rowd($result) == 1) {
          echo "<p>Login: OK</p>";
        } else {
          echo "<p>Login: Failed</p>";
        }
      }
     ?>
  </body>
</html>
