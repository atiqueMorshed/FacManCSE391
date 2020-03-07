<?php
if(!(isset($_SESSION))) {
  include "session.php";
}
if(!(isset($_SESSION['StudentEmail']))) {
  header('Location: index.php');
}
if(($_SERVER['REQUEST_METHOD'] == 'POST') && (!empty($_POST['AddStudentCourse'])) && ($_POST['CourseSectionDropdown'] > 0)) {
  if(isset($_POST['CourseSectionDropdown'])) { $Section = $_POST['CourseSectionDropdown']; }
  if(isset($_POST['CourseIDDropdown'])) { $CourseID = $_POST['CourseIDDropdown']; }
  $StudentCourses = $_SESSION['StudentCourses'];

    include("loginDB.php");
    $formDBLink = mysqli_connect($host, $user, $password, $dbname);
    if($formDBLink-> connect_error) {
      die("Connection Failed:".$formDBLink-> connect_error);
    }
    $sqlQuery = "SELECT * FROM student WHERE StudentCourses='$StudentCourses'";
    $result = $formDBLink->query($sqlQuery);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if($count==1) {
      $CourseTaken=$row['CourseTaken'];
      if($CourseTaken<4) {
        $sqlQuery = "SELECT * FROM stcourses WHERE CourseID = '$CourseID' AND StudentCourses='$StudentCourses'";
        $result = $formDBLink->query($sqlQuery);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        if($count < 1) {
        $sqlQuery = "SELECT * FROM stcourses WHERE CourseID = '$CourseID' AND Section='$Section' AND StudentCourses='$StudentCourses'";
        $result = $formDBLink->query($sqlQuery);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        if($count < 1) {
          //eligible
          $FCIDQuery = "SELECT * FROM facourses WHERE CourseID = '$CourseID' AND Section='$Section'";
          $FCIDresult = $formDBLink->query($FCIDQuery);
          $FCIDrow = $FCIDresult->fetch_array(MYSQLI_ASSOC);
          $FCIDcount = mysqli_num_rows($FCIDresult);
          if($FCIDcount == 1) {
            $FCID = $FCIDrow['FCID'];
          $formInfoQuery = "INSERT INTO stcourses(StudentCourses, CourseID, Section,FCID)
          VALUES (
            '".$StudentCourses."',
            '".$CourseID."',
            '".$Section."',
            '".$FCID."'
          )";
          if($Result = mysqli_query($formDBLink, $formInfoQuery)) {
            //select totalstudents from facourses and update facourses totalstudent++;
            $sqlQuery = "SELECT * FROM facourses WHERE FCID='$FCID'";
            $result = $formDBLink->query($sqlQuery);
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);
            if($count==1) {
              $TotalStudents=$row['TotalStudents'];
              $TotalStudents++;
              //update total Student
              $formInfoQuery = "UPDATE facourses SET TotalStudents='$TotalStudents' WHERE FCID='$FCID'";
              if($Result = mysqli_query($formDBLink, $formInfoQuery)) {
                $ASCMsg = '<p class="UserFormSuccess">Update Successful!</p>';
              } else {
                $ASCMsg = '<p class="UserFormError">Update Faileda!</p>';
              }
              //increment courses taken for a student
              $CourseTaken++;
              $formInfoQuery = "UPDATE student SET CourseTaken='$CourseTaken' WHERE StudentCourses='$StudentCourses'";
              if($Result = mysqli_query($formDBLink,$formInfoQuery)) {
                $ASCMsg = '<p class="UserFormSuccess">Update Successful!</p>';
              } else {
                $ASCMsg = '<p class="UserFormError">Update Faileda!</p>';
              }
              // $formDBLink->close();
              // return $FacultyCourses;
            }
            // return $FacultyCourses;
           } else {
             $ASCMsg = '<p class="UserFormError">Update Failedb!</p>';
           }
          // mysqli_close($formDBLink);
        } else {
          $ASCMsg = '<p class="UserFormError">Section already taken.</p>';
          mysqli_close($formDBLink);
          header('Location: index.php');
        }


    } else {
      $ASCMsg = '<p class="UserFormError">You have alreay taken this course.</p>';
    }
    //
    // // $formInfoQuery = "UPDATE stcourses SET StudentName='$StudentName', DOB='$DOB', StudentPassword='$StudentPassword', Phone='$Phone' WHERE StudentEmail='$StudentEmail'";
    //
    // if($Result = mysqli_query($formDBLink, $formInfoQuery)) {
    //   $ASCMsg = '<p class="UserFormSuccess">Signup Successful!</p>';
    // } else {
    //   $ASCMsg = '<p class="UserFormError">Signup Unuccessful!</p>';
    // }
    // mysqli_close($formDBLink);
  }
  } else {
    $ASCMsg = '<p class="UserFormError">You have already added 4 courses.</p>';
  }
}
mysqli_close($formDBLink);
}//chk POST & submit!empty [END]

if(isset($ASCMsg)) $_SESSION['ErrorMsg'] = $ASCMsg;
?>
