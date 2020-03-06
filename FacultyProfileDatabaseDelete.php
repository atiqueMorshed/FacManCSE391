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
    $sqlQuery = "DELETE FROM facourses WHERE FCID='$FCID'";
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
}
?>
</body>
</html>
