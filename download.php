<?php
session_start();
try {
    $pdo = new PDO("mysql:host=localhost;dbname=mtn1", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Failed" . $e->getMessage();

}

if (!isset($_SESSION['enlign'])) {
    header('Location:http://localhost/WebSite/log.php');
}
$src = $_GET['src'];
$src = explode('?', $src);
$name = $src[0];
$idprodact = $src[1];
$idpersonne = $src[2];
$sq = $pdo->prepare("INSERT INTO acha VALUES($idprodact,'$name',$idpersonne,now())");
$sq->execute();
$arra = $sq->fetchAll();

header('Location:' . $src[0]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
//  if ($_SESSION['idprodact'] == "") {
//     $idprodact = $$_SESSION['idprodact'];
//     $name = $_SESSION['nameprodact'];
//     $idpersonne = $_SESSION['enlign'];
//     $name = $_SESSION['nameprodact'];

// } else {
//     echo "ok";
//     $src = $_GET['src'];
//     $src = explode('?', $src);
//     $name = $src[0];
//     $idprodact = $src[1];
//     $idpersonne = $_SESSION['enlign'];
// }

// if ($_SESSION['enlign'] != 0) {
//     // insert new prodact to acha
//     $sq = $pdo->prepare("INSERT INTO acha VALUES($idprodact,'$name',$idpersson)");
//     $sq->execute();
//     $arra = $sq->fetchAll();
//     $idprodact = "";
//     header('Location:http://localhost/WebSite/Home.php');

    // $sq = $pdo->prepare("SELECT id_books FROM acha WHERE id_books=(SELECT id_books FROM books WHERE pdf='$src');");
    // $sq->execute();
    // $arra = $sq->fetchAll();
    // $ro = $sq->rowCount();
    // $r=$ro+1;
    // if (empty($ro)) {

    //     // count id
    //     $sq = $pdo->prepare("SELECT COUNT(id_books) as count FROM acha");
    //     $sq->execute();
    //     $arra = $sq->fetchAll();
    //     $count=$arra[0]['count']+1;

    //     // insert new prodact to acha
    //     $sq = $pdo->prepare("INSERT INTO acha VALUES($r,'$src',1)");
    //     $sq->execute();
    //     $arra = $sq->fetchAll();
    //     header("Locatio:C:/xampp/htdocs/$src");

    // }else{

    //     // select cnt acha
    //     $id=$arra['id_books'];
    //     $r=$ro+1;
    //     $sq = $pdo->prepare("SELECT cnt FROM acha WHERE id_books=$id");
    //     $sq->execute();
    //     $arra = $sq->fetchAll();
    //     $cnt=$arra['cnt']+1;

    //     $sq = $pdo->prepare("UPDATE acha SET cnt=$cnt WHERE id_books=$id;");
    //     $sq->execute();
    //     $arra = $sq->fetchAll();
    //     header("Locatio:C:/xampp/htdocs/$src");

    // }
// } else {
//     header('Location:http://localhost/WebSite/log.php');
//     $_SESSION['operation'] = "download";
//     $_SESSION['idprodact'] = $idprodact;
//     $_SESSION['idpersonne'] = $idpersonne;
//     $_SESSION['nameprodact'] = $name;
// }
?>
</body>
</html>