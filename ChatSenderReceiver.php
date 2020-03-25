<?php
  if(isset($_GET['FacultyCourses'])) {
    $FacultyCourses = $_GET['FacultyCourses'];

    include "Handle/loginDB.php";
    $formDBLink = mysqli_connect($host, $user, $password, $dbname);
    $sqlQuery1 = "SELECT * FROM messages WHERE (Sender ='$StudentCourses' AND Receiver = '$FacultyCourses') OR (Sender ='$FacultyCourses' AND Receiver = '$StudentCourses') ORDER BY MessageDate";
    $result1=$formDBLink->query($sqlQuery1);
    while($row1=$result1->fetch_assoc()) {
      $Sender = $row1['Sender'];
      $msg = $row1['Message'];
      $date = $row1['MessageDate'];
      if($FacultyCourses == $Sender) {
?>
<!-- Sender Message-->
<div class="media w-50 mb-3"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
  <div class="media-body ml-3">
    <div class="bg-light rounded py-2 px-3 mb-2">
      <p class="text-small mb-0 text-muted"><?php echo $msg ?></p>
    </div>
    <p class="small text-muted"><?php echo $date ?></p>
  </div>
</div>
<?php
} else {
?>
<!-- Reciever Message-->
<div class="media w-50 ml-auto mb-3">
  <div class="media-body">
    <div class="bg-primary rounded py-2 px-3 mb-2">
      <p class="text-small mb-0 text-white"><?php echo $msg ?></p>
    </div>
    <p class="small text-muted"><?php echo $date ?></p>
  </div>
</div>

<?php
    }
  }
    $formDBLink->close();
  } else if(isset($_GET['StudentCourses'])) {
    $StudentCourses = $_GET['StudentCourses'];
    $FacultyCourses = $_SESSION['FacultyCourses'];

    include "Handle/loginDB.php";
    $formDBLink = mysqli_connect($host, $user, $password, $dbname);
    $sqlQuery1 = "SELECT * FROM messages WHERE (Sender ='$StudentCourses' AND Receiver = '$FacultyCourses') OR (Sender ='$FacultyCourses' AND Receiver = '$StudentCourses') ORDER BY MessageDate";
    $result1=$formDBLink->query($sqlQuery1);
    while($row1=$result1->fetch_assoc()) {
      $Sender = $row1['Sender'];
      $msg = $row1['Message'];
      $date = $row1['MessageDate'];
      if($StudentCourses == $Sender) {
?>
<!-- Sender Message-->
<div class="media w-50 mb-3"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
  <div class="media-body ml-3">
    <div class="bg-light rounded py-2 px-3 mb-2">
      <p class="text-small mb-0 text-muted"><?php echo $msg ?></p>
    </div>
    <p class="small text-muted"><?php echo $date ?></p>
  </div>
</div>
<?php
} else {
?>
<!-- Reciever Message-->
<div class="media w-50 ml-auto mb-3">
  <div class="media-body">
    <div class="bg-primary rounded py-2 px-3 mb-2">
      <p class="text-small mb-0 text-white"><?php echo $msg ?></p>
    </div>
    <p class="small text-muted"><?php echo $date ?></p>
  </div>
</div>

<?php
    }
  }
  $formDBLink->close();
} else if(isset($_GET['FCID']) && isset($_SESSION['FacultyCourses'])) {
    $FacultyCourses = $_SESSION['FacultyCourses'];
    $FCID = $_GET['FCID'];

    include "Handle/loginDB.php";
    $formDBLink = mysqli_connect($host, $user, $password, $dbname);
    $sqlQuery1 = "SELECT * FROM messages WHERE FCID='$FCID' ORDER BY MessageDate";
    $result1=$formDBLink->query($sqlQuery1);
    while($row1=$result1->fetch_assoc()) {
      $Sender = $row1['Sender'];
      $msg = $row1['Message'];
      $date = $row1['MessageDate'];
      if($FacultyCourses == $Sender) {
        ?>
        <!-- Reciever Message-->
        <div class="media w-50 ml-auto mb-3">
          <div class="media-body">
            <div class="bg-primary rounded py-2 px-3 mb-2">
              <p class="text-small mb-0 text-white"><?php echo $msg ?></p>
            </div>
            <p class="small text-muted"><?php echo $date ?></p>
          </div>
        </div>
        <?php
      } else {
        $sqlQuery2 = "SELECT * FROM student WHERE StudentCourses = '$Sender'";
        $result2 = $formDBLink->query($sqlQuery2);
        if($row2 = $result2->fetch_assoc()) {
          $name = $row2['StudentName'];
        }
        ?>
        <!-- Sender Message-->
        <div class="media w-50 mb-3"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
          <div class="media-body ml-3">
            <div class="bg-light rounded py-2 px-3 mb-2">
              <p class="text-small mb-0 text-muted"><?php echo $name ?></p>
              <p class="text-small mb-0 text-muted"><?php echo $msg ?></p>
            </div>
            <p class="small text-muted"><?php echo $date ?></p>
          </div>
        </div>
        <?php
          }
        }
  $formDBLink->close();
}
else if(isset($_GET['FCID']) && isset($_SESSION['StudentCourses'])) {
    $StudentCourses = $_SESSION['StudentCourses'];
    $FCID = $_GET['FCID'];

    include "Handle/loginDB.php";
    $formDBLink = mysqli_connect($host, $user, $password, $dbname);
    $sqlQuery1 = "SELECT * FROM messages WHERE FCID='$FCID' ORDER BY MessageDate";
    $result1=$formDBLink->query($sqlQuery1);
    while($row1=$result1->fetch_assoc()) {
      $Sender = $row1['Sender'];
      $msg = $row1['Message'];
      $date = $row1['MessageDate'];
      if($StudentCourses == $Sender) {
        ?>
        <!-- Reciever Message-->
        <div class="media w-50 ml-auto mb-3">
          <div class="media-body">
            <div class="bg-primary rounded py-2 px-3 mb-2">
              <p class="text-small mb-0 text-white"><?php echo $msg ?></p>
            </div>
            <p class="small text-muted"><?php echo $date ?></p>
          </div>
        </div>
        <?php
      } else {
        $sqlQuery2 = "SELECT * FROM student WHERE StudentCourses = '$Sender'";
        $result2 = $formDBLink->query($sqlQuery2);
        if($row2 = $result2->fetch_assoc()) {
          $name = $row2['StudentName'];
        } else {
          $sqlQuery3 = "SELECT * FROM faculty WHERE FacultyCourses = '$Sender'";
          $result3 = $formDBLink->query($sqlQuery3);
          if($row3 = $result3->fetch_assoc()) {
            $name = $row3['FacultyName'];
          }
        }
        ?>
        <!-- Sender Message-->
        <div class="media w-50 mb-3"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
          <div class="media-body ml-3">
            <div class="bg-light rounded py-2 px-3 mb-2">
              <p class="text-small mb-0 text-muted"><?php echo $name ?></p>
              <p class="text-small mb-0 text-muted"><?php echo $msg ?></p>
            </div>
            <p class="small text-muted"><?php echo $date ?></p>
          </div>
        </div>
        <?php
          }
        }
  $formDBLink->close();
}
?>
