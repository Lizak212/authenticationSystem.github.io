<?php
  session_start ();
  $db = new SQLite3 ("users.db");

  if (isset ($_POST ['change_password'])) {
    $new_password = $_POST ['new_password'];
    $username = $_SESSION ['username'];

    $db->exec ("UPDATE user SET password = '$new_password' WHERE username = '$username'");
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
  <p>Welcome User!</p>

  <form method = "POST"> 
    <input type = "password" name = "new_password" placeholder = Password>
    <input type = "submit" value = "change password" name = "change_password">
  </form>

  <form action = "logout.php" method = "POST">
    <input type = "submit" value = "logout" name = "Logout">
  </form>

</body>
</html>
