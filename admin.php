<?php
  session_start ();
  $db = new SQLite3 ("users.db");
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
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    table, th, td {
      border: 1px solid #ddd;
    }
    th, td {
      padding: 12px;
      text-align: left;
    }
    th {
      background-color: #f2f2f2;
    }
    tr {
      background-color: #f9f9f9;
    }
  </style>
</head>

<body>
  <h1>Authentication System</h1>
  <p>Welcome Admin!</p>

  <?php
  $results = $db->query ("SELECT * FROM user");

  echo "<table>";
  echo "<tr>";
  echo "<th>Username</th>";
  echo "<th>Password</th>";
  echo "<th>Email</th>";
  echo "</tr>";

  while ($row = $results->fetchArray (SQLITE3_ASSOC)) {
    echo "<tr>";
    echo "<td>" . $row ['username'] . "</td>";
    echo "<td>" . $row ['password'] . "</td>";
    echo "<td>" . $row ['email'] . "</td>";
    echo "</tr>";
  }

  echo "</table>";
  ?>

  <form action = "logout.php" method = "POST">
    <input type = "submit" value = "logout" name = "Logout">
  </form>

</body>
</html>
