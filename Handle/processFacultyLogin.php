<?php
  if(isset($_SESSION)) {
    session_destroy();
  }

include "session.php";
if(($_SERVER['REQUEST_METHOD']) == 'POST' && (!empty($_POST['FacultyLogin']))) {
  if(isset($_POST['FacultyEmail'])) { $FacultyEmail = $_POST['FacultyEmail']; }
  if(isset($_POST['FacultyPassword'])) { $FacultyPassword = $_POST['FacultyPassword']; }

  //Connecting to DB
  include("loginDB.php");
  $formDBLink = mysqli_connect($host, $user, $password, $dbname);
  $sqlQuery = "SELECT * FROM faculty WHERE FacultyEmail = '$FacultyEmail'";
  $result = $formDBLink->query($sqlQuery);
  $row = $result->fetch_array(MYSQLI_ASSOC);
  $count = mysqli_num_rows($result);
  if($count == 1) {
    $Password = $row['FacultyPassword'];
    $Initial = $row['FacultyInitial'];
    $Name = $row['FacultyName'];
    $FacultyCourses= $row['FacultyCourses'];
    $formDBLink->close();
    // if((password_verify($AdminPassword, $HashedPassword))) {
    if ($Password == $FacultyPassword) {
      $_SESSION['FacultyEmail'] = $FacultyEmail;
      $_SESSION['FacultyName'] = $Name;
      $_SESSION['FacultyInitial'] = $Initial;
      $_SESSION['FacultyCourses'] = $FacultyCourses;
      header("Location: index.php");
    } else {
      $LoginMsg = '<p class="UserFormError">Incorrect Password!</p>';
    }
    // $count 1 chk [END]
  } else {
    $LoginMsg = '<p class="UserFormError">Incorrect Email!</p>';
    $formDBLink->close();
  }
} else {
  // $LoginMsg = '<p class="UserFormError">Empty Field!</p>';
}
?>
