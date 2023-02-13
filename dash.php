<?php
session_start();

$src = $_GET['src'];
// $src=explode('?',$src);
header('Location:http://localhost/WebSite/download.php?src=' . $src . '?' . $_SESSION['enlign']);

// header('Location:'.$src);
?>