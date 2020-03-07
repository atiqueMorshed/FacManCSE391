<?php
if(!(isset($_SESSION))) {
  include "session.php";
}
if(!(isset($_SESSION['StudentEmail']))) {
  header('Location: index.php');
}
