<?php
if(!(isset($_SESSION))) {
  include "session.php";
}
if(!(isset($_SESSION['FacultyEmail']))) {
  header('Location: index.php');
}
// php code for on page validation msg
  //chk POST & submit!empty [START]
  if(($_SERVER['REQUEST_METHOD'] == 'POST') && (!empty($_POST['UpdateFacultyProfile']))) {
    echo "yey";
    if(isset($_POST['name'])) { $FacultyName = $_POST['name']; }
    if(isset($_POST['initial'])) { $FacultyInitial = $_POST['initial']; }
    if(isset($_POST['password'])) { $FacultyPassword = $_POST['password']; }
    if(isset($_POST['conpassword'])) { $ConfirmFacultyPassword = $_POST['conpassword']; }


    $hasError = false; // error chk mechanism
    $FacultyEmail= $_SESSION['FacultyEmail'];
    //ERROR CHECKS
    if(strlen($FacultyName) < 8) {
      $errUser = '<p class="UserFormError">Invalid Name.</p>';
      $hasError = true;
    }
    else if($FacultyPassword != $ConfirmFacultyPassword) {
      $errUser = '<p class="UserFormError">Passwords must match.</p>';
      $hasError=true;
    }
    else if(strlen($FacultyPassword) < 8) {
      $errUser = '<p class="UserFormError">Password has to be atleast 8 chars.</p>';
      $hasError = true;
    }

    else if(strlen($FacultyInitial) != 3) {
      $errUser = '<p class="UserFormError">Initial must be of length 3.</p>';
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
      $sqlQuery = "SELECT * FROM faculty WHERE FacultyInitial = '$FacultyInitial' AND FacultyEmail != '$FacultyEmail'";
      $result = $formDBLink->query($sqlQuery);
      $row = $result->fetch_array(MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
      if($count < 1) {

        $formInfoQuery = "UPDATE faculty SET FacultyName='$FacultyName', FacultyInitial='$FacultyInitial', FacultyPassword='$FacultyPassword' WHERE FacultyEmail='$FacultyEmail'";
        if($Result = mysqli_query($formDBLink, $formInfoQuery)) {
          $Msg = '<p class="UserFormSuccess">Update Successful!</p>';
        } else {
          $Msg = '<p class="UserFormError">Update Failed!</p>';
        }
        mysqli_close($formDBLink);

      } else {
        $Msg = '<p class="UserFormError">Duplicate Initial!</p>';
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
