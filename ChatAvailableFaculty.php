<?php
$SenderGuy = 'None';
if(isset($_SESSION['StudentCourses'])) {
  $Sender = $_SESSION['StudentCourses'];
  $SenderGuy = 'Student';
}
if(isset($_SESSION['FacultyCourses'])) {
  $Sender = $_SESSION['FacultyCourses'];
  $SenderGuy = 'Faculty';
}
include "Handle/loginDB.php";
$formDBLink = mysqli_connect($host, $user, $password, $dbname);
if($SenderGuy == 'Student') {
  ?>
  <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
    <div class="media"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
      <div class="media-body ml-4">
        <div class="d-flex align-items-center justify-content-between mb-1">
          <h1 class="mb-0">Individuals: </h1>
        </div>
      </div>
    </div>
  </a>
  <?php
  $DuplicateChecker = array();
  $StudentCourses = $_SESSION['StudentCourses'];
  $sqlQuery1 = "SELECT * FROM stcourses WHERE StudentCourses='$StudentCourses'";
  $result1=$formDBLink->query($sqlQuery1);
  $i=0;
  while($row1=$result1->fetch_assoc()) {
    $i++;
    $FCID = $row1['FCID'];
    $sqlQuery2 = "SELECT * FROM facourses WHERE FCID='$FCID'";
    $result2=$formDBLink->query($sqlQuery2);
    $row2 = $result2->fetch_array(MYSQLI_ASSOC);
    $count = mysqli_num_rows($result2);
    if($count == 1) {
      $FacultyCourses = $row2['FacultyCourses'];
      if(!(in_array($FacultyCourses, $DuplicateChecker))) {
      $DuplicateChecker[] = $FacultyCourses;
      $sqlQuery2 = "SELECT DISTINCT * FROM faculty WHERE FacultyCourses='$FacultyCourses'";
      $result2=$formDBLink->query($sqlQuery2);
      $row2 = $result2->fetch_array(MYSQLI_ASSOC);
      $count = mysqli_num_rows($result2);
      if($count == 1) {
        $FacultyName = $row2['FacultyName'];
        $FacultyEmail = $row2['FacultyEmail'];
        $FacultyInitial = $row2['FacultyInitial'];

        $sqlQuery2 = "SELECT * FROM messages WHERE FacultyCourses='$FacultyCourses' AND StudentCourses = $StudentCourses ORDER BY MessageDate DESC";
        $result2=$formDBLink->query($sqlQuery2);
        $LastMessageDate = "N/A";
        // while($row2=$result2->fetch_assoc()) {
        //   $LastMessageDate = $row2['MessageDate'];
        //   break;
        // }
      }
  ?>
  <a href="Chat.php?FacultyCourses=<?php echo $FacultyCourses ?>" id="<?php echo $i ?>" onclick="toggleclass(<?php echo $i ?>)" class="list-group-item list-group-item-action list-group-item-light rounded-0">
    <div class="media"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
      <div class="media-body ml-4">
        <div class="d-flex align-items-center justify-content-between mb-1">
          <h6 class="mb-0"><?php echo $FacultyName ?></h6><small class="small font-weight-bold"><?php echo $LastMessageDate ?></small>
        </div>
        <p class="font-italic text-muted mb-0 text-small"><?php echo $FacultyInitial ?></p>
        <p class="font-italic mb-0 text-small"><?php echo $FacultyEmail ?></p>
      </div>
    </div>
  </a>
  <?php
      }
    }
  }

  //GroupChat
  ?>
  <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
    <div class="media"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
      <div class="media-body ml-4">
        <div class="d-flex align-items-center justify-content-between mb-1">
          <h1 class="mb-0">Groups: </h1>
        </div>
      </div>
    </div>
  </a>
  <?php
  $sqlQuery1 = "SELECT * FROM stcourses WHERE StudentCourses ='$StudentCourses'";
  $result1=$formDBLink->query($sqlQuery1);

  while($row1=$result1->fetch_assoc()) {
    $FCID = $row1['FCID'];
    $sqlQuery2 = "SELECT * FROM facourses WHERE FCID = '$FCID'";
    $result2 = $formDBLink->query($sqlQuery2);
    $i = 0;
    while($row2 = $result2->fetch_assoc()) {
      $i++;
      $CourseID = $row2['CourseID'];
      $Section = $row2['Section'];
      $TotalStudents = $row2['TotalStudents'];

      ?>
      <a href="Chat.php?FCID=<?php echo $FCID ?>" id="<?php echo $i ?>" onclick="toggleclass(<?php echo $i ?>)" class="list-group-item list-group-item-action list-group-item-light rounded-0">
        <div class="media"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
          <div class="media-body ml-4">
            <div class="d-flex align-items-center justify-content-between mb-1">
              <h6 class="mb-0">CSE<?php echo $CourseID ?></h6>
              <small class="small font-weight-bold">Section: <?php echo $Section ?></small>
              <small class="small font-weight-bold">Group</small>
            </div>
            <p class="font-italic text-muted mb-0 text-small">Total: <?php echo $TotalStudents ?></p>
          </div>
        </div>
      </a>
      <?php
    }
  }
  $formDBLink->close();

} else if($SenderGuy == 'Faculty') {
  //Individual Students
  ?>
  <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
    <div class="media"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
      <div class="media-body ml-4">
        <div class="d-flex align-items-center justify-content-between mb-1">
          <h1 class="mb-0">Individuals: </h1>
        </div>
      </div>
    </div>
  </a>
  <?php
  $DuplicateChecker = array();
  $FacultyCourses = $_SESSION['FacultyCourses'];
  $sqlQuery1 = "SELECT * FROM facourses WHERE FacultyCourses='$FacultyCourses'";
  $result1=$formDBLink->query($sqlQuery1);
  $i=0;
  while($row1=$result1->fetch_assoc()) {
    $i++;
    $FCID = $row1['FCID'];
    $sqlQuery2 = "SELECT * FROM stcourses WHERE FCID='$FCID'";
    $result2=$formDBLink->query($sqlQuery2);
    // $row2 = $result2->fetch_array(MYSQLI_ASSOC);
    // $count = mysqli_num_rows($result2);
    // if($count == 1) {
    while($row2=$result2->fetch_assoc()) {
      $StudentCourses = $row2['StudentCourses'];
      if(!(in_array($StudentCourses, $DuplicateChecker))) {
      $DuplicateChecker[] = $StudentCourses;
      $sqlQuery3 = "SELECT DISTINCT * FROM student WHERE StudentCourses='$StudentCourses'";
      $result3=$formDBLink->query($sqlQuery3);
      $row3 = $result3->fetch_array(MYSQLI_ASSOC);
      $count = mysqli_num_rows($result3);
      if($count == 1) {
        $StudentName = $row3['StudentName'];
        $StudentEmail = $row3['StudentEmail'];
        $Phone = $row3['Phone'];

        $sqlQuery4 = "SELECT * FROM messages WHERE FacultyCourses='$FacultyCourses' AND StudentCourses = $StudentCourses ORDER BY MessageDate DESC";
        $result4=$formDBLink->query($sqlQuery4);
        $LastMessageDate = "N/A";
         // while($row2=$result4->fetch_assoc()) {
         //   $LastMessageDate = $row4['MessageDate'];
         //   break;
         // }
      }
  ?>
  <a href="Chat.php?StudentCourses=<?php echo $StudentCourses ?>" id="<?php echo $i ?>" onclick="toggleclass(<?php echo $i ?>)" class="list-group-item list-group-item-action list-group-item-light rounded-0">
    <div class="media"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
      <div class="media-body ml-4">
        <div class="d-flex align-items-center justify-content-between mb-1">
          <h6 class="mb-0"><?php echo $StudentName ?></h6><small class="small font-weight-bold"><?php echo $LastMessageDate ?></small>
        </div>
        <p class="font-italic text-muted mb-0 text-small"><?php echo $StudentEmail ?></p>
        <p class="font-italic mb-0 text-small"><?php echo $Phone ?></p>
      </div>
    </div>
  </a>
  <?php
      }
    }
  }
  //GroupChat
  ?>
  <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
    <div class="media"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
      <div class="media-body ml-4">
        <div class="d-flex align-items-center justify-content-between mb-1">
          <h1 class="mb-0">Groups: </h1>
        </div>
      </div>
    </div>
  </a>
  <?php
  $sqlQuery1 = "SELECT * FROM facourses WHERE FacultyCourses='$FacultyCourses'";
  $result1=$formDBLink->query($sqlQuery1);
  $i = 0;
  while($row1=$result1->fetch_assoc()) {
    $i++;
    $CourseID = $row1['CourseID'];
    $Section = $row1['Section'];
    $FCID = $row1['FCID'];
    $TotalStudents = $row1['TotalStudents'];
    $FCID = $row1['FCID'];

    ?>
    <a href="Chat.php?FCID=<?php echo $FCID ?>" id="<?php echo $i ?>" onclick="toggleclass(<?php echo $i ?>)" class="list-group-item list-group-item-action list-group-item-light rounded-0">
      <div class="media"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
        <div class="media-body ml-4">
          <div class="d-flex align-items-center justify-content-between mb-1">
            <h6 class="mb-0">CSE<?php echo $CourseID ?></h6>
            <small class="small font-weight-bold">Section: <?php echo $Section ?></small>
            <small class="small font-weight-bold">Group</small>
          </div>
          <p class="font-italic text-muted mb-0 text-small">Total: <?php echo $TotalStudents ?></p>
        </div>
      </div>
    </a>
    <?php
  }
  $formDBLink->close();
}
?>
