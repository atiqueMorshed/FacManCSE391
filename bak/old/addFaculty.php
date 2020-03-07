<?php include "Handle/processFacultySignup.php";?> <!-- PHP CHK FORM -->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Faculty</title>
  <link rel="stylesheet" type="text/css" href="Handle/styles.css">
</head>
<body>
<div style="padding-top:20%;"></div>
<!--Signup Faculty Form -->
<form class="formSignup" action="addFaculty.php" method="post">
  <label>Email: <input type="email" name="FacultyEmail" required placeholder="Enter Faculty Email" value="<?php if(isset($FacultyEmail)) {echo $FacultyEmail;} ?>"></label>
  <label>Password: <input type="password" name="FacultyPassword" required placeholder="Minimum Length is 8" pattern=".{8,}"></label>
  <label>Confirm Password: <input type="password" name="FacultyConfirmPassword" placeholder="Must be matching password" pattern=".{8,}"></label>
  <button type="submit" name="FacultySignup" value="Signup">Signup</button>
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
