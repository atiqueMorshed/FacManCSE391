<?php include "Handle/processFacultyProfile.php";?>
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
<?php
  if(!(isset($_SESSION['FacultyEmail']))) {
    header("Location: index.php");
  }
?>
  <div class="containerMinHeight" style="margin-left:-10%;">
    <div class="mainHeight">
      <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-dark navbar-custom">
          <div class="container"><a class="navbar-brand" href="index.php">FacMan</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navbarResponsive"><span class="navbar-toggler-icon"></span></button>
              <div class="collapse navbar-collapse" id="navbarResponsive">
                  <ul class="nav navbar-nav ml-auto">
                      <li class="nav-item" role="presentation"></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" href="index.php">Home</a></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" href="FacultyProfile.php">Profile</a></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" href="Chat.php">Chat</a></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" href="logout.php">Logout</a></li>

                  </ul>
              </div>
          </div>
      </nav>
      <div class="height150"></div>
      <div class="container profile profile-view facultyProfileBlock" class="profile">
          <!-- <div class="row">
              <div class="col-md-12 alert-col relative">
                  <div class="alert alert-info absolue center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>Profile save with success</span></div>
              </div>
          </div> -->
          <form>
              <div class="form-row profile-row">
                  <div class="col-md-11">
                      <h1>Profile </h1>
                      <hr>
                      <div class="form-row">
                          <div class="col-sm-12 col-md-6">
                              <div class="form-group"><label>Name </label><input class="form-control" disabled type="text" name="name" value="<?php echo $_SESSION['FacultyName']?>"></div>
                          </div>
                          <div class="col-sm-12 col-md-6">
                              <div class="form-group"><label>Initial </label><input class="form-control" disabled type="text" name="initial" value="<?php echo $_SESSION['FacultyInitial']?>"></div>
                          </div>
                      </div>
                      <div class="form-group"><label>Email </label><input class="form-control" type="email" disabled autocomplete="off" required="" name="email" value="<?php echo $_SESSION['FacultyEmail']?>"></div>
                      <!-- <div class="form-row">

                      </div> -->
                      <div class="form-row">
                            <div class="col-sm-12 col-md-6 content-right"><a class="btn btn-danger form-btn" href="AddCourseFacultyPre.php">Add Course</a></div>
                            <div class="col-sm-12 col-md-6 content-right"><a class="btn btn-danger form-btn" href="EditFacultyProfile.php">Edit</a></div>
                      </div>
                  </div>

          </form>

          <!--  -->
      <hr>
      <!-- <div class="container profile profile-view facultyProfileBlock" class="profile">
				<div class="form-row profile-row"> -->
                <!-- <div class="form-row profile-row"> -->
					        <div class="col-md-11">
                      <div class="FacultyTableDatabase">
                        <table class="table FacultyProfileTable">
                          <thead class="thead-dark">
                            <tr>
                              <!-- <th scope="col">#</th> -->
                              <th scope="col">Course</th>
                              <th scope="col">Section</th>
                              <th scope="col">Day</th>
                              <th scope="col">Time</th>
                              <th scope="col">Students</th>
                              <th scope="col">Active</th>
                              <th scope="col">Delete</th>
                              <th scope="col">De/activate</th>
                              <th scope="col">Message All</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                          if(!(isset($_SESSION['FacultyEmail']))) {
                              header('Location: index.php');
                          }else{
                            include "Handle/processFacultyProfileDatabase.php";
                            $email = $_SESSION['FacultyEmail'];
                            $FacultyCourses= FacultyCoursesFinder($email);
                            if($FacultyCourses!= -1) {
                              include("Handle/loginDB.php");
                              $formDBLink = mysqli_connect($host,$user,$password,$dbname);
                              $sqlQuery="SELECT * FROM facourses WHERE FacultyCourses='$FacultyCourses'";
                              $result=$formDBLink->query($sqlQuery);
                              $i=1;
                              while($row=$result->fetch_assoc()) {
                                $CourseID = $row['CourseID'];
                                $Section = $row['Section'];
                                $Day = findDay($row['Day']);
                                $Time = findTime($row['Time']);
                                $TotalStudents = $row['TotalStudents'];
                                $AS = $row['ActiveStatus'];
                                $ActiveStatus = findActiveStatus($AS);
                                $FCID = $row['FCID'];
                          ?>
                            <tr>
                              <!-- <th><?php echo $i ?></th> -->
                              <td>CSE<?php echo $CourseID ?></td>
                              <td><?php echo $Section ?></td>
                              <td><?php echo $Day ?></td>
                              <td><?php echo $Time ?></td>
                              <td><?php echo $TotalStudents ?></td>
                              <td><?php echo $ActiveStatus ?></td>
                              <td><a href="FacultyProfileDatabaseDelete.php?FCID=<?php echo $FCID ?>"><img src="assets/img/delete.png" height="20px"></a></td>
                                <?php
                                if($AS==1){
                                ?>
                                <td><a href="FacultyProfileDatabaseActiveStatus.php?FCID=<?php echo $FCID ?>"><img src="assets/img/on.png" height="20px"></a></td>
                                <?php
                                }else{
                                ?>
                                <td><a href="FacultyProfileDatabaseActiveStatus.php?FCID=<?php echo $FCID ?>"><img src="assets/img/off.png" height="20px"></a></td>
                                <?php
                                    }
                                ?>

                              <td><a href="Chat.php?FCID=<?php echo $FCID ?>"><img src="assets/img/message2.png" height="20px"></a></td>

                            </tr>

                          <?php
                              $i= $i+1;
                              }
                              $formDBLink->close();
                            }
                          }
                          ?>
                          <div class="height150"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

<!-- <footer class="bg-black footerBottom">
    <div class="container">
        <p class="text-center text-white m-0 small footerContent">Copyright&nbsp;© FacMan 2020</p>
    </div>
</footer> -->


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
