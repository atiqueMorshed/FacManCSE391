<?php include "Handle/processAddStudentCourse.php";
  if(!(isset($_SESSION['StudentEmail']))) {
    header('Location: index.php');
  }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Student Profile</title>
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
          <div class="container"><a class="navbar-brand" href="index.php">FacMan</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navbarResponsive"><span class="navbar-toggler-icon"></span></button>
              <div class="collapse navbar-collapse" id="navbarResponsive">
                  <ul class="nav navbar-nav ml-auto">
                      <li class="nav-item" role="presentation"></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" href="index.php">Home</a></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" href="StudentProfile.php">Profile</a></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" href="logout.php">Logout</a></li>
                  </ul>
              </div>
          </div>
      </nav>
      <div class="height150"></div>
      <div class="container profile profile-view facultyProfileBlock" id="profile">
          <!-- <div class="row">
              <div class="col-md-12 alert-col relative">
                  <div class="alert alert-info absolue center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>Profile save with success</span></div>
              </div>
          </div> -->
          <form action="AddStudentCourse2.php" method="post">
              <div class="form-row profile-row">
                  <div class="col-md-8">
                      <h1>Add Course</h1>
                      <hr>
                      <div class="form-row">
                      </div>
                      <div class="form-row">
                          <div class="col-sm-12 col-md-6">
                            <div class="input-group-append">
                              <select class="browser-default custom-select" name="CourseIDDropdown">
                                <option selected value="0">Course</option>
                                <?php
                                $StudentEmail = $_SESSION['StudentEmail'];
                                include("Handle/loginDB.php");
                                $formDBLink = mysqli_connect($host,$user,$password,$dbname);
                                $sqlQuery="SELECT DISTINCT CourseID FROM facourses";
                                $result=$formDBLink->query($sqlQuery);
                                while($row=$result->fetch_assoc()) {
                                  $CourseID = $row['CourseID'];
                                ?>
                                <option value="<?php echo $CourseID; ?>">CSE<?php echo $CourseID; ?></option>
                                <?php
                                  }
                                  mysqli_close($formDBLink);
                                ?>
                              </select>
                              <?php

                              ?>
                              <button class="btn btn-outline-secondary" type="submit">Search</button>
                            </div>
                          </div>
                            <div class="col-sm-12 col-md-6">
                              <div class="input-group-append">
                                <select class="browser-default custom-select" disabled>
                                  <option selected>Section</option>
                                  <!--  -->

                                  <option value="1">Name</option>
                                </select>

                                <button class="btn btn-outline-secondary" type="button" disabled >Search</button>
                              </div>
                            </div>
                      </div>

                      <div class="form-row">
                        <div class="col-md-12">
                          <?php
                            if(isset($_SESSION['ErrMsg'])) echo $_SESSION['ErrMsg'];
                          ?>
                        </div>
                        <div class="col-md-12 content-right">
                          <button type="submit" disabled class="btn btn-danger form-btn">Add Course</button>
                          <!-- <button type="submit" disabled name="AddStudentCourse" value="Add" class="btn btn-danger form-btn">Add Course</button> -->
                        </div>
                      </div>
                      <!-- <hr> -->

                  </div>
              </div>
          </form>
      </div>
        <!-- <div class="height150"></div> -->
      </div>
    </div>
    <footer class="bg-black footerBottom">
        <div class="container">
            <p class="text-center text-white m-0 small footerContent">Copyright&nbsp;© FacMan 2020</p>
        </div>
    </footer>


    <script src="assets/js/jquery.min.js"></script>
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
