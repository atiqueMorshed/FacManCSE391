<?php include "Handle/session.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin</title>
  <link rel="stylesheet" type="text/css" href="Handle/styles.css">
</head>
<body>
  <!-- [START] navbar -->
  <div class="navbar">
		<ul>
			<li class="icon"><a href="index.php">Logo</a></li>

      <!-- session= notSet -->
      <?php if(!(isset($_SESSION['AdminID']))){?>
        <li><a class="navCenter" href="studentLogin.php">Student</a></li>
        <li><a class="navCenter" href="facultyLogin.php">Faculty</a></li>
      <?php
            }
      ?>
      <!-- session= Set -->
      <?php if((isset($_SESSION['AdminID']))){?>
      <li><a class="navCenter" href="Handle/sessionDestroy.php">Logout</a></li>
      <li><a class="navCenter" href="addFaculty.php">Add Faculty</a></li>
      <li><a class="navCenter" href="addStudent.php">Add Student</a></li>
      <?php
        }
      ?>
      <li><a class="navCenter" href="admin.php">Home</a></li>
		</ul>
	</div>
  <!-- [END] navbar -->
  <div style="padding-top:10%;"></div>
  <!-- [START] body -->
<?php
  if(isset($_SESSION['AdminID'])) {
?>
<!-- session = Set -->
  <p class="mustLogin">Welcome, Admin!</p>

<?php
  }else {
?>
  <p class="mustLogin">U ARE NOT AN ADMIN!</p>
<?php
  }
?>

<?php include "Handle/footer.php";?>
