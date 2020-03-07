<?php
include "session.php";
if(!(isset($_SESSION['FacultyEmail']))) {
  header('Location: index.php');
}
if(($_SERVER['REQUEST_METHOD'] == 'POST') && (!empty($_POST['AddCourseFaculty'])) && ($_POST['courseID'] > 0) && ($_POST['section'] > 0) && ($_POST['day'] > 0) && ($_POST['time'] > 0) && ($_POST['totalSeat'] > 0)) {
  $CourseID = $_POST['courseID'];
  $Section = $_POST['section'];
  $Day = $_POST['day'];
  $Time = $_POST['time'];
  $TotalSeat = $_POST['totalSeat'];
  $TotalStudents = 0;
  $ActiveStatus = 1;
  $FacultyCourses = $_SESSION['FacultyCourses'];

  include("loginDB.php");
  $formDBLink = mysqli_connect($host, $user, $password, $dbname);
  if($formDBLink-> connect_error) {
    die("Connection Failed:".$formDBLink-> connect_error);
  }
  //check if course with same section already exists.
  $sqlQuery = "SELECT * FROM facourses WHERE CourseID='$CourseID' AND Section = '$Section'";
  $result = $formDBLink->query($sqlQuery);
  $row = $result->fetch_array(MYSQLI_ASSOC);
  $count = mysqli_num_rows($result);
  if($count<1) {

    //check if the faculty has any classes at that day+time
    $sqlQuery = "SELECT * FROM facourses WHERE Day='$Day' AND Time = '$Time' AND FacultyCourses='$FacultyCourses'";
    $result = $formDBLink->query($sqlQuery);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if($count<1) {
      // Insert
      $formInfoQuery = "INSERT INTO facourses(FacultyCourses, CourseID, Section, Day, Time, Seat, ActiveStatus, TotalStudents)
      VALUES (
        '".$FacultyCourses."',
        '".$CourseID."',
        '".$Section."',
        '".$Day."',
        '".$Time."',
        '".$TotalSeat."',
        '".$ActiveStatus."',
        '".$TotalStudents."'
      )";
      if($Result = mysqli_query($formDBLink, $formInfoQuery)) {
        $AFCError = '<p class="UserFormSuccess">Entry Successful!</p>';
      } else {
          $AFCError = '<p class="UserFormError">Error! Please try again later.</p>';
      }
    } else {
        $AFCError = '<p class="UserFormError">You already have a course at that time.</p>';
    }
  } else {
    $AFCError = '<p class="UserFormError">Already exists!</p>';
  }

  mysqli_close($formDBLink);
} else {
  $AFCError = '<p class="UserFormError">Fill up the form.</p>';
}
if(isset($AFCError)) $_SESSION['ErrorMsg'] = $AFCError;
?>
