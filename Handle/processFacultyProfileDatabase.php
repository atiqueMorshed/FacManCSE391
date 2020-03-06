<?php
function FacultyCoursesFinder($email) {
  include('loginDB.php');
  $formDBLink = mysqli_connect($host, $user, $password, $dbname);
  if($formDBLink->connect_error) {
    die("Connection Failed:".$formDBLink-> connect_error);
  }
  $sqlQuery="SELECT * FROM faculty WHERE FacultyEmail='$email'";
  $result=$formDBLink->query($sqlQuery);
  $row=$result->fetch_array(MYSQLI_ASSOC);
  $count= mysqli_num_rows($result);
  if($count==1) {
    $FacultyCourses=$row['FacultyCourses'];
    $formDBLink->close();
    return $FacultyCourses;
  } else {
    $formDBLink->close();
    return -1;
  }
}

function findDay($Day) {
  if($Day==1) return "SUN-TUE";
  else if($Day==2) return "MON-WED";
  else return "SAT-THU";
}

function findTime($Time) {
  if($Time==8) return "8.00-9.20AM";
  else if($Time==9) return "9.30-10.50AM";
  else if($Time==11) return "11.00-12.20PM";
  else if($Time==12) return "12.30-01.50PM";
  else return "02.00-3.20PM";
}

function findActiveStatus($Status) {
  if($Status==0) return "NO";
  else return "YES";
}

?>
