<?php include "Handle/processStudentProfile.php";
  if(!(isset($_SESSION['StudentEmail']) || isset($_SESSION['FacultyEmail']))) {
     header('Location: index.php');
  }
  if(!(isset($_SESSION))) {
    include "session.php";
  }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - FacMan</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Bootstrap-Chat.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script>
      function toggleclass(i) {
        document.getElementById(i).classList.add('active');
        // document.getElementById("MyElement").classList.remove('MyClass');
        // if ( document.getElementById("MyElement").classList.contains('MyClass') )
        // document.getElementById("MyElement").classList.toggle('MyClass');
      }
    </script>
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-dark navbar-custom">
        <div class="container"><a class="navbar-brand" href="#">FacMan</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navbarResponsive"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="FacultyProfile.php">Profile</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Chat.php">Chat</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="height100"></div>
    <section><div>
<div class="container py-5 px-4">
  <!-- For demo purpose-->
  <header class="text-center">
    <h1 class="display-4 text-black">Chat Now</h1>
  </header>

  <div class="row rounded-lg overflow-hidden shadow">
    <!-- Users box-->
    <div class="col-5 px-0">
      <div class="bg-white">

        <div class="bg-gray px-4 py-2 bg-light">
          <p class="h5 mb-0 py-1">Available</p>
        </div>

        <div class="messages-box">
          <div class="list-group rounded-0">
            <?php
            include "ChatAvailableFaculty.php";
            ?>
          </div>
        </div>
      </div>
    </div>
    <!-- Chat Box-->
    <div class="col-7 px-0">
      <div class="px-4 py-5 chat-box bg-white">
        <?php
        include "ChatSenderReceiver.php";
        ?>

      <!-- Typing area -->
      <form method="post" class="bg-light">
        <div class="input-group">
          <input type="text" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light" name="TextField">
          <div class="input-group-append">
            <button id="button-addon2" type="submit" class="btn btn-link" name="SendMessage"> <i class="fa fa-paper-plane"></i></button>
          </div>
        </div>
      </form>
      <?php
      if(isset($_POST['SendMessage'])) {
        $msg = htmlentities($_POST['TextField']);
        if($msg == "") {
          echo "<div class='alert alert-danger'>
  				        <strong><center>Please enter your message first!</center></strong>
  				      </div>";
        } else if(strlen($msg) > 100){
				echo "<div class='alert alert-danger'>
				        <strong><center>Message is Too long! Use only 100 characters</center></strong>
				      </div>";
			} else {
        include("Handle/loginDB.php");
        $formDBLink = mysqli_connect($host, $user, $password, $dbname);
        if($formDBLink-> connect_error) {
          die("Connection Failed:".$formDBLink-> connect_error);
        }
        if(isset($_GET['FacultyCourses'])) {
          $formInfoQuery = "INSERT INTO messages(Sender, Receiver, Message)
          VALUES (
            '".$StudentCourses."',
            '".$FacultyCourses."',
            '".$msg."'
          )";
          if($Result = mysqli_query($formDBLink, $formInfoQuery)) {
            mysqli_close($formDBLink);
            ?>
              <script>
                window.location.href = "chat.php?FacultyCourses=<?php echo $FacultyCourses ?>";
              </script>
            <?php
          } else {
            echo "<div class='alert alert-danger'>
                    <strong><center>Error Sending Message!</center></strong>
                  </div>";
            mysqli_close($formDBLink);
          }
        } else if(isset($_GET['StudentCourses'])) {
          $formInfoQuery = "INSERT INTO messages(Sender, Receiver, Message)
          VALUES (
            '".$FacultyCourses."',
            '".$StudentCourses."',
            '".$msg."'
          )";
          if($Result = mysqli_query($formDBLink, $formInfoQuery)) {
            mysqli_close($formDBLink);
            ?>
              <script>
                window.location.href = "chat.php?StudentCourses=<?php echo $StudentCourses ?>";
              </script>
            <?php
          } else {
            echo "<div class='alert alert-danger'>
                    <strong><center>Error Sending Message!</center></strong>
                  </div>";
            mysqli_close($formDBLink);
          }
        } else if(isset($_GET['FCID']) && isset($_SESSION['FacultyCourses'])) {
            $FacultyCourses = $_SESSION['FacultyCourses'];
            $FCID = $_GET['FCID'];
            $formInfoQuery = "INSERT INTO messages(Sender, FCID, Message)
            VALUES (
              '".$FacultyCourses."',
              '".$FCID."',
              '".$msg."'
            )";
            if($Result = mysqli_query($formDBLink, $formInfoQuery)) {
              mysqli_close($formDBLink);
              ?>
                <script>
                  window.location.href = "chat.php?FCID=<?php echo $FCID ?>";
                </script>
              <?php
            } else {
              echo "<div class='alert alert-danger'>
                      <strong><center>Error Sending Message!</center></strong>
                    </div>";
              mysqli_close($formDBLink);
            }
        } else if(isset($_GET['FCID']) && isset($_SESSION['StudentCourses'])) {
            $StudentCourses = $_SESSION['StudentCourses'];
            $FCID = $_GET['FCID'];
            $formInfoQuery = "INSERT INTO messages(Sender, FCID, Message)
            VALUES (
              '".$StudentCourses."',
              '".$FCID."',
              '".$msg."'
            )";
            if($Result = mysqli_query($formDBLink, $formInfoQuery)) {
              mysqli_close($formDBLink);
              ?>
                <script>
                  window.location.href = "chat.php?FCID=<?php echo $FCID ?>";
                </script>
              <?php
            } else {
              echo "<div class='alert alert-danger'>
                      <strong><center>Error Sending Message!</center></strong>
                    </div>";
              mysqli_close($formDBLink);
            }
        }
      }
    }
      ?>
    </div>
  </div>
</div>
</div>
</section>
<div class="height150"></div>
    <footer class="py-5 bg-black footerBottom">
        <div class="container">
            <p class="text-center text-white m-0 small">Copyright&nbsp;© FacMan 2020</p>
        </div>
    </footer>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
