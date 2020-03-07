<?php
if(!(isset($_SESSION))) {
  include "Handle/session.php";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Title</title>
</head>
<body>
<?php
if(!isset($_SESSION['FacultyEmail'])) {
  include "Handle/sessionDestroy";
  header('Location: index.php');
} else {
  $FCID=$_GET['FCID'];
  if($FCID > 0) {
    include('Handle/loginDB.php');
    $formDBLink = mysqli_connect($host, $user, $password, $dbname);
    $sqlQuery = "SELECT * FROM facourses WHERE FCID='$FCID'";
    $result = $formDBLink->query($sqlQuery);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if($count==1) {
      $OldActiveStatus = $row['ActiveStatus'];
      if($OldActiveStatus == 1) $NewActiveStatus = 0;
      else $NewActiveStatus = 1;

      $sqlQuery = "UPDATE facourses SET ActiveStatus='$NewActiveStatus' WHERE FCID='$FCID'";
      if(mysqli_query($formDBLink, $sqlQuery)) {
        $formDBLink->close();
        header('Location: FacultyProfile.php');
      } else {
        $formDBLink->close();
        header('Location: index.php');
      }
    } else {
      include "Handle/sessionDestroy";
      header('Location: index.php');
    }

  } else {
    include "Handle/sessionDestroy";
    header('Location: index.php');
  }
}

?>
</body>
</html>
