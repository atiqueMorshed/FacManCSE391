<?php
if(!(isset($_SESSION))) {
  include "session.php";
}
// php code for on page validation msg
  //chk POST & submit!empty [START]
  if(($_SERVER['REQUEST_METHOD'] == 'POST') && (!empty($_POST['FacultySignup']))) {
    if(isset($_POST['FacultyEmail'])) { $FacultyEmail = $_POST['FacultyEmail']; }
    if(isset($_POST['FacultyPassword'])) { $FacultyPassword = $_POST['FacultyPassword']; }
    if(isset($_POST['FacultyInitial'])) { $FacultyInitial = $_POST['FacultyInitial'];
  }
    $hasError = false; // error chk mechanism
    //ERROR CHECKS
    if(!(filter_var($FacultyEmail,FILTER_VALIDATE_EMAIL))) {
      $errUserEmail = '<p class="UserFormError">Email not valid.</p>';
      $hasError = true;
    }
    if(strlen($FacultyPassword) < 8) {
      $errUserPassword = '<p class="UserFormError">Password has to be atleast 8 chars.</p>';
      $hasError = true;
    }

    if(strlen($FacultyInitial) != 3) {
      $errUserConfirmPassword = '<p class="UserFormError">Passwords must match.</p>';
      $hasError = true;
    }

    // IF NO ERROR IN FORM, PUSH DATA TO DB
    if(!($hasError)) {
      include("loginDB.php");
      $formDBLink = mysqli_connect($host, $user, $password, $dbname);
      if($formDBLink-> connect_error) {
        die("Connection Failed:".$formDBLink-> connect_error);
      }
      $formInfoQuery = "INSERT INTO faculty(FacultyEmail, FacultyPassword, FacultyInitial)
      VALUES (
        '".$FacultyEmail."',
        '".$FacultyPassword."',
        '".$FacultyInitial."'
      )";

      if($Result = mysqli_query($formDBLink, $formInfoQuery)) {
        $Msg = '<p class="UserFormSuccess">Signup Successful!</p>';
      } else {
        $Msg = '<p class="UserFormError">Signup Unuccessful!</p>';
      }
      mysqli_close($formDBLink);
    }
  } //chk POST & submit!empty [END]
?>
