<?php include "Handle/processAddCourseFaculty.php";

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Faculty: Add Course</title>
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
                        <li class="nav-item" role="presentation"><a class="nav-link" href="FacultyProfile.php">Profile</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="logout.php">Logout</a></li>

                    </ul>
                </div>
            </div>
        </nav>
        <div class="height150"></div>
        <div class="container profile profile-view facultyProfileBlock" id="profile">
            <div class="row">
                <div class="col-md-12 alert-col relative">
                    <div class="alert alert-info absolue center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>Profile save with success</span></div>
                </div>
            </div>
            <form action="AddCourseFaculty.php" method="post">
                <div class="form-row profile-row">
                    <div class="col-md-8">
                        <div class="addFacultyCourseForm">
                            <h1>Add Courses</h1>
                            <hr>
                            <?php
                              if (!isset($_POST['courseID'])) {
                                header('Location: AddCourseFacultyPre.php');
                              }
                              $CourseID = $_POST['courseID'];
                            ?>
                            <div class="form-row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Course</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="courseID">
                                            <option selected value="<?php echo $CourseID ?>">CSE<?php echo $CourseID ?></option>
                                            <!-- <option value="110">CSE110</option>
                                            <option value="111">CSE111</option>
                                            <option value="220">CSE220</option>
                                            <option value="221">CSE221</option>
                                            <option value="230">CSE230</option>
                                            <option value="260">CSE260</option>
                                            <option value="320">CSE320</option>
                                            <option value="321">CSE321</option>
                                            <option value="330">CSE330</option>
                                            <option value="360">CSE360</option> -->
                                        </select>
                                    </div>
                                    <!-- <div class="form-group"><label>CourseID </label><input class="form-control" type="text" name="courseID"></div> -->
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect2">Section</label>
                                        <select class="form-control" id="exampleFormControlSelect2" name="section">
                                            <option value="0">Select</option>
                                            <?php
                                              $section = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
                                              include "Handle/loginDB.php";
                                              $formDBLink = mysqli_connect($host, $user, $password, $dbname);
                                              $sqlQuery1 = "SELECT * FROM facourses WHERE CourseID='$CourseID' ORDER BY Section ASC";
                                              $result1=$formDBLink->query($sqlQuery1);
                                              while($row1=$result1->fetch_assoc()) {
                                                $S = $row1['Section'];
                                                if(($key = array_search($S, $section)) !== false) {
                                                  unset($section[$key]);
                                                }
                                              }
                                              foreach ($section as $sec) {
                                            ?>
                                            <option value="<?php echo $sec ?>"><?php echo $sec ?></option>
                                            <?php
                                              }
                                              $section = array(1,2,3,4,5,6,7,8,9,10);
                                            ?>
                                            <!-- <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option> -->
                                        </select>
                                    </div>
                                    <!-- <div class="form-group"><label>Section </label><input class="form-control" type="text" name="section"></div> -->
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect3">Day</label>
                                        <select class="form-control" id="exampleFormControlSelect3" name="day">
                                            <option value="0">Select</option>
                                            <option value="1">SUN-TUE</option>
                                            <option value="2">MON-WED</option>
                                            <option value="3">SAT-THU</option>
                                        </select>
                                    </div>
                                    <!-- <div class="form-group"><label>Day </label><input class="form-control" type="text" name="Day"></div> -->
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect4">Time</label>
                                        <select class="form-control" id="exampleFormControlSelect4" name="time">
                                            <option value="0">Select</option>
                                            <option value="8">8.00-9.20</option>
                                            <option value="9">9.30-10.50</option>
                                            <option value="11">11.00-12.20</option>
                                            <option value="12">12.30-1.50</option>
                                            <option value="2">2.00-3.20</option>
                                        </select>
                                    </div>
                                    <!-- <div class="form-group"><label>Time </label><input class="form-control" type="text" name="Time"></div> -->
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect5">totalSeat</label>
                                        <select class="form-control" id="exampleFormControlSelect5" name="totalSeat">
                                            <option value="0">Select</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                            <option value="35">35</option>
                                            <option value="40">40</option>
                                            <option value="45">45</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                              <div class="col-md-12 content-right">
                                <button class="btn btn-danger form-btn" type="submit" name="AddCourseFaculty" value="AddCourse">Add</button>
                              </div>
                              <div class="col-md-12">
                                <p><a href="AddCourseFacultyPre.php">Go Back</a></p>
                                <?php
                                  if(isset($_SESSION['ErrorMsg'])) echo $_SESSION['ErrorMsg'];
                                ?>
                              </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </form>
            <!-- <p class="text-center text-danger" name="error"> ${ErrorMsg} </p> -->
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
