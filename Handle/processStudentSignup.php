<?php
if(!(isset($_SESSION))) {
  include "session.php";
}
// php code for on page validation msg
  //chk POST & submit!empty [START]
  if(($_SERVER['REQUEST_METHOD'] == 'POST') && (!empty($_POST['StudentSignup']))) {
    if(isset($_POST['StudentEmail'])) { $StudentEmail = $_POST['StudentEmail']; }
    if(isset($_POST['StudentPassword'])) { $StudentPassword = $_POST['StudentPassword']; }
    $hasError = false; // error chk mechanism
    //ERROR CHECKS
    if(!(filter_var($StudentEmail,FILTER_VALIDATE_EMAIL))) {
      $errUserEmail = '<p class="UserFormError">Email not valid.</p>';
      $hasError = true;
    }
    if(strlen($StudentPassword) < 8) {
      $errUserPassword = '<p class="UserFormError">Password has to be atleast 8 chars.</p>';
      $hasError = true;
    }

    // IF NO ERROR IN FORM, PUSH DATA TO DB
    if(!($hasError)) {
      include("loginDB.php");
      $formDBLink = mysqli_connect($host, $user, $password, $dbname);
      if($formDBLink-> connect_error) {
        die("Connection Failed:".$formDBLink-> connect_error);
      }
      $formInfoQuery = "INSERT INTO student(StudentEmail, StudentPassword)
      VALUES (
        '".$StudentEmail."',
        '".$StudentPassword."'
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
