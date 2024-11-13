<?php
  session_start ();
  $db = new SQLite3 ("users.db");

  $db->exec ("CREATE TABLE IF NOT EXISTS user (id INTEGER PRIMARY KEY AUTOINCREMENT, username TEXT, password TEXT, email TEXT)");

  $counter = $db->querySingle("SELECT COUNT(*) as count FROM user");

  if ($counter == 0) { 
    $db->exec ("INSERT INTO user (username, password, email) VALUES ('admin', 'password_admin', 'admin@gmail.com')");
  }

  if (isset ($_POST ['Register'])) {
    $username = $_POST ['username'];
    $password = $_POST ['password'];
    $email = $_POST ['email'];

    $results = $db->query ("SELECT * FROM user WHERE email = '$email' OR username = '$username'");

    if ($results->fetchArray ()) {
      header ("Location: index.php");
      exit ();  
    } else {
      $db->exec ("INSERT INTO user (username, password, email) VALUES ('$username', '$password', '$email')");
    }
  }

  if (isset ($_POST ['Login'])) {
    $username = $_POST ['username'];
    $password = $_POST ['password'];

    $results = $db->query ("SELECT * FROM user WHERE username = '$username' AND password = '$password'");

    if ($results->fetchArray ()){
      if ($username == "admin"){
        header ("Location: admin.php");
        exit ();
      } else {
        $_SESSION ['username'] = $username;
        header ("Location: user.php");
        exit ();
      }
    } else {
      header ("Location: index.php");
      exit ();
    }
  }
?>

<html>
<head>
  <title>Authentication System</title>
  <style>
    body {
      display: flex; 
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
  </style>
</head>
  
<body>
  <h1>Authentication System</h1>

  <h2>Register</h2>
  <form action = "index.php" method = "POST">
    <input type = "text" name = "username" placeholder = "Username">
    <input type = "password" name = "password" placeholder = "Password">
    <input type = "text" name = "email" placeholder = "Email">
    <input type = "submit" value = "register" name = "Register">
  </form>

  <h2>Login</h2>
  <form action = "index.php" method = "POST">
    <input type = "text" name = "username" placeholder = "Username">
    <input type = "password" name = "password" placeholder = "Password">
    <input type = "submit" value = "login" name = "Login">
  </form>

</body>
</html>
