<?php include "Handle/session.php";?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - FacMan</title>
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

                      <!-- <%
                          if(session.getAttribute("USER") == "2") {
                      %>
                      <li class="nav-item" role="presentation"><a class="nav-link" href="FacultyProfile.jsp">Profile</a></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" href="logout.php">Logout</a></li>
                      <%
                          }
                      %> -->

                      <!-- <%
                          if(session.getAttribute("USER") == "3") {
                      %>
                      <li class="nav-item" role="presentation"><a class="nav-link" href="StudentProfile.jsp">Profile</a></li>
                      <li class="nav-item" role="presentation"><a class="nav-link" href="logout.php">Logout</a></li>
                      <%
                          }
                      %> -->

                  </ul>
              </div>
          </div>
      </nav>
      <header class="masthead text-center text-white">
          <div class="masthead-content">
              <div class="container">
                  <h1 class="masthead-heading mb-0">Faculty Management</h1>
              </div>
          </div>
          <div class="bg-circle-1 bg-circle"></div>
          <div class="bg-circle-2 bg-circle"></div>
          <div class="bg-circle-3 bg-circle"></div>
          <div class="bg-circle-4 bg-circle"></div>
      </header>
      <div class="height150"></div>
      <div class="TableWithSearch">
        <form action="" method="get">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search..." aria-label="Recipient's username" aria-describedby="basic-addon2" name="SearchField">
            <!-- <button class="btn btn-outline-secondary" type="button">Search</button> -->
            <!-- <div class="input-group-append">
              <select class="browser-default custom-select">
                <option selected>Filter</option>
                <option value="1">Name</option>
                <option value="2">Course</option>
              </select>
              <button class="btn btn-outline-secondary" type="button">Search</button>
            </div> -->
          </div>
        </form>

        <div class="FacultyTableDatabase">
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Initial</th>
                <th scope="col">Course</th>
                <th scope="col">Section</th>
                <th scope="col">Day</th>
                <th scope="col">Time</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $Search = "none";
              if(isset($_GET['SearchField']))
                $Search = $_GET['SearchField'];
                $word = "CSE";
                if (strpos($Search, $word) !== false) {
                  $Search = str_replace("CSE", "", $Search);
                }
                $word = "cse";
                if (strpos($Search, $word) !== false) {
                  $Search = str_replace("cse", "", $Search);
                }
                include("Handle/loginDB.php");
                include "Handle/processFacultyProfileDatabase.php";
                $formDBLink = mysqli_connect($host, $user, $password, $dbname);
                if($Search == "none") {
                  $sqlQuery = "SELECT faculty.FacultyName, faculty.FacultyEmail, faculty.FacultyInitial, faculty.FacultyCourses, facourses.FacultyCourses, facourses.CourseID, facourses.Section, facourses.Day, facourses.Time, facourses.TotalStudents, facourses.ActiveStatus, facourses.FCID FROM faculty RIGHT JOIN facourses ON faculty.FacultyCourses = facourses.FacultyCourses ORDER BY facourses.CourseID";
                } else {
                  $sqlQuery = "SELECT faculty.FacultyName, faculty.FacultyEmail, faculty.FacultyInitial, faculty.FacultyCourses, facourses.FacultyCourses, facourses.CourseID, facourses.Section, facourses.Day, facourses.Time, facourses.TotalStudents, facourses.ActiveStatus, facourses.FCID FROM faculty RIGHT JOIN facourses ON faculty.FacultyCourses = facourses.FacultyCourses WHERE facourses.CourseID LIKE '".$Search."' OR faculty.FacultyName LIKE '".$Search."' OR faculty.FacultyInitial LIKE  '".$Search."' ORDER BY facourses.CourseID";
                }
                $result = $formDBLink->query($sqlQuery);
                while($row = $result->fetch_assoc()) {
                  $Name = $row['FacultyName'];
                  $Email = $row['FacultyEmail'];
                  $Initial = $row['FacultyInitial'];
                  $CourseID = $row['CourseID'];
                  $Section = $row['Section'];
                  $Day = findDay($row['Day']);
                  $Time = findTime($row['Time']);
                  $FacultyCourses = $row['FacultyCourses'];
              ?>
              <tr>
                <td><?php echo $Name ?></td>
                <th scope="row"><a href="PublicFacultyProfile.php?FacultyCourses=<?php echo $FacultyCourses ?>"><?php echo $Email ?></a></th>
                <td><?php echo $Initial ?></td>
                <td><?php echo $CourseID ?></td>
                <td><?php echo $Section ?></td>
                <td><?php echo $Day ?></td>
                <td><?php echo $Time ?></td>
              </tr>
              <?php
                }
                $formDBLink->close();
              ?>
            </tbody>
          </table>
        </div>
        <div class="height150"></div>
      </div>
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
    <script src="assets/js/Profile-Edit-Form.js"></script>
</body>

</html>
