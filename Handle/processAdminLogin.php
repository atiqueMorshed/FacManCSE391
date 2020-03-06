<?php
  if(isset($_SESSION)) {
    session_destroy();
  }
  include "session.php";
  // After clicking Login
  if(($_SERVER['REQUEST_METHOD']) == 'POST' && (!empty($_POST['AdminLogin']))) {
    if(isset($_POST['AdminEmail'])) { $AdminEmail = $_POST['AdminEmail']; }
    if(isset($_POST['AdminPassword'])) { $AdminPassword = $_POST['AdminPassword']; }

    //Connecting to DB
    include("loginDB.php");
    $formDBLink = mysqli_connect($host, $user, $password, $dbname);
    $sqlQuery = "SELECT * FROM admin WHERE AdminEmail = '$AdminEmail'";
    $result = $formDBLink->query($sqlQuery);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if($count == 1) {
      $Password = $row['AdminPassword'];
      $AdminID = $row['AdminID'];
      // if((password_verify($AdminPassword, $HashedPassword))) {
      if ($Password == $AdminPassword) {
        $_SESSION['AdminEmail'] = $AdminEmail;
        $_SESSION['AdminID'] = $AdminID;
        header("Location: index.php");
      } else {
        $LoginMsg = '<p class="UserFormError">Incorrect Password!</p>';
      }
      // $count 1 chk [END]
    } else {
      $LoginMsg = '<p class="UserFormError">Incorrect Email!</p>';
    }
  } else {
    // $LoginMsg = '<p class="UserFormError">Empty Field!</p>';
  }
?>
