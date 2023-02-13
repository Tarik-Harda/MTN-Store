<?php
session_start();
if (!isset($_SESSION['enlign'])) {
    header("LOCATION:log.php");
}
$pdo = new PDO('mysql:host=localhost;dbname=mtn1', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_POST['id_per'])) {
$id = $_POST['id_per'] ?? null;
$query = $pdo->prepare("DELETE FROM personne WHERE id_per=$id;DELETE FROM users WHERE id=$id");
$query->execute();
header('Location: index.php?pu=personne?id_per?'.$r);
}
if (isset($_POST['id_books'])) {
$id = $_POST['id_books'] ?? null;
$query = $pdo->prepare("DELETE FROM books WHERE id_books=$id;");
$query->execute();
header('Location: index.php?pu=books?id_books');
}
if (isset($_POST['id'])) {
    $id = $_POST['id'] ?? null;
    $query = $pdo->prepare("DELETE FROM personne WHERE id_per=$id;DELETE FROM users WHERE id=$id");
    $query->execute();
    header('Location:logout.php');
    }