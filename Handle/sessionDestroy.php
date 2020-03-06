<?php
include "session.php";
session_destroy();
header("Location: ../index.php");
// header('Refresh: 2; URL=../index.php');
?>
