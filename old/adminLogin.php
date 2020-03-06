<?php include "Handle/processAdminLogin.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>AdminLogin</title>
  <link rel="stylesheet" type="text/css" href="Handle/styles.css">
</head>
<body>
<div style="padding-top:20%;"></div>
<!-- admin login form -->
<form class="appointmentFormAdmin" action="adminLogin.php" method="post">
  <label>Email: <input type="email" name="AdminEmail" required placeholder="Enter Your Email"></input></label>
  <label> Password: <input type="password" name="AdminPassword" required placeholder="Enter Your Password"></label>
  <button type="submit" name="AdminLogin" value="Admin">Login</button>
  <p><a href="index.php">Go back.</a></p>
  <?php
  if(isset($LoginMsg)) {
    echo $LoginMsg;
  }
  ?>
</form>

<?php include "Handle/footer.php";?>
