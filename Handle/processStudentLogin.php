<?php
  if(isset($_SESSION)) {
    session_destroy();
  }

include "session.php";
if(($_SERVER['REQUEST_METHOD']) == 'POST' && (!empty($_POST['StudentLogin']))) {
  if(isset($_POST['StudentEmail'])) { $StudentEmail = $_POST['StudentEmail']; }
  if(isset($_POST['StudentPassword'])) { $StudentPassword = $_POST['StudentPassword']; }

  //Connecting to DB
  include("loginDB.php");
  $formDBLink = mysqli_connect($host, $user, $password, $dbname);
  $sqlQuery = "SELECT * FROM student WHERE StudentEmail = '$StudentEmail'";
  $result = $formDBLink->query($sqlQuery);
  $row = $result->fetch_array(MYSQLI_ASSOC);
  $count = mysqli_num_rows($result);
  if($count == 1) {
    $Password = $row['StudentPassword'];
    $Name = $row['StudentName'];
    $DOB = $row['DOB'];
    $Phone = $row['Phone'];
    $CourseTaken=$row['CourseTaken'];
    $StudentCourses= $row['StudentCourses'];
    $formDBLink->close();
    // if((password_verify($AdminPassword, $HashedPassword))) {
    if ($Password == $StudentPassword) {
      $_SESSION['StudentEmail'] = $StudentEmail;
      $_SESSION['StudentName'] = $Name;
      $_SESSION['DOB'] = $DOB;
      $_SESSION['Phone'] = $Phone;
      $_SESSION['CourseTaken'] = $CourseTaken;
      $_SESSION['StudentCourses'] = $StudentCourses;
      header("Location: index.php");
    } else {
      $LoginMsg = '<p>Incorrect Password!</p>';
    }
    // $count 1 chk [END]
  } else {
    $LoginMsg = '<p>Incorrect Email!</p>';
  }
} else {
  // $LoginMsg = '<p class="UserFormError">Empty Field!</p>';
}
?>
