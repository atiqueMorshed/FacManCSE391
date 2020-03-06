<?php include "Handle/processStudentSignup.php";?> <!-- PHP CHK FORM -->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Student</title>
  <link rel="stylesheet" type="text/css" href="Handle/styles.css">
</head>
<body>
<div style="padding-top:20%;"></div>
<!--Signup Student Form -->
<form class="formSignup" action="addStudent.php" method="post">
  <label>Email: <input type="email" name="StudentEmail" required placeholder="Enter Student Email" value="<?php if(isset($StudentEmail)) {echo $StudentEmail;} ?>"></label>
  <label>Password: <input type="password" name="StudentPassword" required placeholder="Minimum Length is 8" pattern=".{8,}"></label>
  <label>Confirm Password: <input type="password" name="StudentConfirmPassword" placeholder="Must be matching password" pattern=".{8,}"></label>
  <button type="submit" name="StudentSignup" value="Signup">Signup</button>
  <?php if(isset($errUserEmail)) {echo $errUserEmail;} ?>
  <?php if(isset($errUserConfirmPassword)) {echo $errUserConfirmPassword; } ?>
  <p><a href="admin.php">Go back.</a></p>
  <?php
  if(isset($Msg)) {
     echo $Msg;
  }
  ?>
</form>

<?php include "Handle/footer.php";?>
