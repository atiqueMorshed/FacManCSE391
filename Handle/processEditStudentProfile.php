<?php
if(!(isset($_SESSION))) {
  include "session.php";
}
if(!(isset($_SESSION['StudentEmail']))) {
  header('Location: index.php');
}
// php code for on page validation msg
  //chk POST & submit!empty [START]
  if(($_SERVER['REQUEST_METHOD'] == 'POST') && (!empty($_POST['UpdateStudentProfile']))) {
    if(isset($_POST['name'])) { $StudentName = $_POST['name']; }
    if(isset($_POST['dob'])) { $DOB = $_POST['dob']; }
    if(isset($_POST['phone'])) { $Phone = $_POST['phone']; }
    if(isset($_POST['password'])) { $StudentPassword = $_POST['password']; }
    if(isset($_POST['cpassword'])) { $ConfirmStudentPassword = $_POST['cpassword']; }


    $hasError = false; // error chk mechanism
    $StudentEmail= $_SESSION['StudentEmail'];
    //ERROR CHECKS
    if(strlen($StudentName) < 6) {
      $errUser = '<p class="UserFormError">Invalid Name.</p>';
      $hasError = true;
    }
    else if($StudentPassword != $ConfirmStudentPassword) {
      $errUser = '<p class="UserFormError">Passwords must match.</p>';
      $hasError=true;
    }
    else if(strlen($StudentPassword) < 8) {
      $errUser = '<p class="UserFormError">Password has to be atleast 8 chars.</p>';
      $hasError = true;
    }
    else if(strlen($Phone) < 14) {
      $errUser = '<p class="UserFormError">Incorrect Phone.</p>';
      $hasError = true;
    }
    // IF NO ERROR IN FORM, PUSH DATA TO DB
    if(!($hasError)) {

      include("loginDB.php");
      $formDBLink = mysqli_connect($host, $user, $password, $dbname);
      if($formDBLink-> connect_error) {
        die("Connection Failed:".$formDBLink-> connect_error);
      }
      //
      $sqlQuery = "SELECT * FROM student WHERE Phone = '$Phone' AND StudentEmail != '$StudentEmail'";
      $result = $formDBLink->query($sqlQuery);
      $row = $result->fetch_array(MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
      if($count < 1) {
        $formInfoQuery = "UPDATE student SET StudentName='$StudentName', DOB='$DOB', StudentPassword='$StudentPassword', Phone='$Phone' WHERE StudentEmail='$StudentEmail'";
        if($Result = mysqli_query($formDBLink, $formInfoQuery)) {
          $Msg = '<p class="UserFormSuccess">Update Successful!</p>';
        } else {
          $Msg = '<p class="UserFormError">Update Failed!</p>';
        }
        mysqli_close($formDBLink);

      } else {
        $Msg = '<p class="UserFormError">Duplicate Phone!</p>';
        mysqli_close($formDBLink);
      }
      //
    } else {
        $Msg = $errUser;
    }
  } else {
    // $Msg = '<p class="UserFormError">Cannot process form.</p>';
  } //chk POST & submit!empty [END]
?>
