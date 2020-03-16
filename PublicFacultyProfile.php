<?php
if(!(isset($_SESSION))) {
  include "Handle/session.php";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Faculty Profile</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli">
    <link rel="stylesheet" href="assets/css/Bootstrap-Chat.css">
    <link rel="stylesheet" href="assets/css/Community-ChatComments.css">
    <link rel="stylesheet" href="assets/css/Data-Table-with-Search-Sort-Filter-and-Zoom-using-TableSorter.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/LinkedIn-like-Profile-Box.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-Form-1.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-Form.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<div class="containerMinHeight">
    <div class="mainHeight">
      <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-dark navbar-custom">
          <div class="container"><a class="navbar-brand" href="index.jsp">FacMan</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navbarResponsive"><span class="navbar-toggler-icon"></span></button>
              <div class="collapse navbar-collapse" id="navbarResponsive">
                  <ul class="nav navbar-nav ml-auto">
                      <li class="nav-item" role="presentation"></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" href="index.php">Home</a></li>
                      <?php
                          if(!(isset($_SESSION['AdminEmail']) || (isset($_SESSION['StudentEmail'])) || (isset($_SESSION['FacultyEmail'])))) {
                      ?>
                      <li class="nav-item" role="presentation"><a class="nav-link" href="FacultyLogin.php">Faculty</a></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" href="StudentLogin.php">Student</a></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" href="AdminLogin.php">Admin</a></li>
                      <!-- <li class="nav-item dropdown">
                          <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">Login</a>
                          <div class="dropdown-menu" role="menu">
                              <a class="dropdown-item" role="presentation" href="FacultyLogin.php">Faculty</a>
                              <a class="dropdown-item" role="presentation" href="StudentLogin.php">Student</a>
                              <a class="dropdown-item" role="presentation" href="AdminLogin.php">Admin</a>
                          </div>
                      </li> -->
                      <?php
                          }
                      ?>

                      <?php
                          if(isset($_SESSION['AdminEmail'])) {
                      ?>
                      <li class="nav-item" role="presentation"><a class="nav-link" href="AddFaculty.php">Add Faculty</a></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" href="AddStudent.php">Add Student</a></li>

                      <!-- <li class="nav-item dropdown">
                          <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">Register</a>
                          <div class="dropdown-menu" role="menu">
                              <a class="dropdown-item" role="presentation" href="AddFaculty.jsp">Faculty</a>
                              <a class="dropdown-item" role="presentation" href="AddStudent.jsp">Student</a>
                          </div>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="logout.php">Logout</a></li>
                      </li> -->

                      <?php
                          }
                      ?>

                      <?php
                          if(isset($_SESSION['FacultyEmail'])) {
                      ?>
                      <li class="nav-item" role="presentation"><a class="nav-link" href="FacultyProfile.php">Profile</a></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" href="Chat.php">Chat</a></li>
                      <?php
                          }
                      ?>

                      <?php
                          if(isset($_SESSION['StudentEmail'])) {
                      ?>
                      <li class="nav-item" role="presentation"><a class="nav-link" href="StudentProfile.php">Profile</a></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" href="Chat.php">Chat</a></li>
                      <?php
                          }
                      ?>


                      <?php
                          if((isset($_SESSION['AdminEmail']) || (isset($_SESSION['StudentEmail'])) || (isset($_SESSION['FacultyEmail'])))) {
                      ?>
                      <li class="nav-item" role="presentation"><a class="nav-link" href="logout.php">Logout</a></li>
                      <?php
                      }
                      ?>
                  </ul>
              </div>
          </div>
      </nav>
        <div class="height150"></div>
        <div class="container profile profile-view facultyProfileBlock" id="profile">
          <?php
            $FacultyCourses = $_GET['FacultyCourses'];
            include("Handle/loginDB.php");
            include "Handle/processFacultyProfileDatabase.php";
            $formDBLink = mysqli_connect($host, $user, $password, $dbname);
            $sqlQuery = "SELECT * FROM faculty WHERE FacultyCourses = '$FacultyCourses'";
            $result = $formDBLink->query($sqlQuery);
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);
            if($count == 1) {
              $Initial = $row['FacultyInitial'];
              $Name = $row['FacultyName'];
              $Email= $row['FacultyEmail'];
            }
              $formDBLink->close();
          ?>
            <form>
                <div class="form-row profile-row">
                    <div class="col-md-10">

                        <?php
                            if(isset($_SESSION['StudentEmail'])) {

                        ?>
                        <h2>Message Now: <a href="Chat.php?FacultyCourses=<?php echo $FacultyCourses ?>"><img
                                src="assets/img/message2.png" alt="" style="height: 30px; align-self: center"></a></h2>
                        <?php
                            }
                        ?>
                        <hr>
                        <h1>Profile </h1>
                        <hr>
                        <div class="form-row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group"><label>Name </label><input class="form-control" disabled type="text" name="name" value="<?php echo $Name ?>"></div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group"><label>Initial </label><input class="form-control" disabled type="text" name="initial" value="<?php echo $Initial ?>"></div>
                            </div>
                        </div>
                        <div class="form-group"><label>Email </label><input class="form-control" type="email" disabled autocomplete="off" required="" name="email" value="<?php echo $Email ?>"></div>
                        <hr>
                        <div class="FacultyTableDatabase">
                            <table class="table FacultyProfileTable">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Course</th>
                                    <th scope="col">Section</th>
                                    <th scope="col">Day</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Students</th>
                                    <th scope="col">Active</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                  $formDBLink = mysqli_connect($host,$user,$password,$dbname);
                                  $sqlQuery="SELECT * FROM facourses WHERE FacultyCourses='$FacultyCourses'";
                                  $result=$formDBLink->query($sqlQuery);
                                  $i=0;
                                  while($row=$result->fetch_assoc()) {
                                    $CourseID = $row['CourseID'];
                                    $Section = $row['Section'];
                                    $Day = findDay($row['Day']);
                                    $Time = findTime($row['Time']);
                                    $TotalStudents = $row['TotalStudents'];
                                    $AS = $row['ActiveStatus'];
                                    $ActiveStatus = findActiveStatus($AS);
                                    $FCID = $row['FCID'];
                                    $i++;
                                ?>
                                  <tr>
                                    <td><?php echo $i ?></td>
                                    <th><?php echo $CourseID ?></th>
                                    <td>CSE<?php echo $Section ?></td>
                                    <td><?php echo $Day ?></td>
                                    <td><?php echo $Time ?></td>
                                    <td><?php echo $TotalStudents ?></td>
                                    <td><?php echo $ActiveStatus ?></td>
                                  </tr>
                                <?php
                                  }
                                  $formDBLink->close();
                                ?>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </form>
        </div>
        <div class="height150"></div>
    </div>
</div>
<footer class="bg-black footerBottom">
    <div class="container">
        <p class="text-center text-white m-0 small footerContent">Copyright&nbsp;© FacMan 2020</p>
    </div>
</footer>


<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/Data-Table-with-Search-Sort-Filter-and-Zoom-using-TableSorter.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/jquery.tablesorter.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-filter.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-storage.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
<!-- <script src="assets/js/Profile-Edit-Form.js"></script> -->
</body>
</html>
