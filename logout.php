<?php
Session_start();
session_destroy();
header("Location:log.php");
// $_SESSION['enlign']=0;
// $_SESSION['usertype']=null;
echo $_SESSION['enlign'];