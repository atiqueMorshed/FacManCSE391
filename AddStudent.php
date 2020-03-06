<?php include "Handle/processStudentSignup.php";?> <!-- PHP CHK FORM -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Add Student</title>
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
      if(!isset($_SESSION['AdminID'])) {
          header('Location: index.php');
      }
  ?>
    <div class="containerMinHeight">
        <div class="mainHeight">
            <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-dark navbar-custom">
                <div class="container"><a class="navbar-brand" href="index.php">FacMan</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navbarResponsive"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item" role="presentation"></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="index.php">Home</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="AddFaculty.php">Add Faculty</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="AddStudent.php">Add Student</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="logout.php">Logout</a></li>

                        </ul>
                    </div>
                </div>
            </nav>
            <div class="height150"></div>
            <div class="login-card"><img class="profile-img-card" src="assets/img/avatar_2x.png">
                <p class="profile-name-card"> </p>
                <form action="AddStudent.php" method="post" class="form-signin">
                    <span class="reauth-email"> </span>
                    <input class="form-control" type="email" id="inputEmail" required="" placeholder="Email address" autofocus="" pattern="[a-z0-9]{3,15}@[a-z]{5}\.[a-z]{1,3}" name="StudentEmail">
                    <input class="form-control" type="password" id="inputPassword" required="" placeholder="Password" pattern=".{8,}" name="StudentPassword">
                    <button class="btn btn-primary btn-block btn-lg btn-signin" type="submit" name="StudentSignup" value="StudentSignup" style="background-color: rgba(33,37,41,0.81);">Sign in</button>
                </form>
                <?php
                if(isset($Msg)) {
                   echo $Msg;
                }
                ?>
            </div>
        </div>
    </div>

    <footer class="bg-black footerBottom">
        <div class="container">
            <p class="text-center text-white m-0 small footerContent">Copyright&nbsp;© FacMan 202020</p>
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
