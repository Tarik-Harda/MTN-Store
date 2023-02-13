<?php
session_start();
if (!isset($_SESSION['enlign'])) {
    header("LOCATION:log.php");
}
if (isset($_SESSION['enlign']) and $_SESSION['usertype'] == 1) {
    header("LOCATION:index.php?pu=personne?id_per");
}
?>
<?php
$pdo = new PDO('mysql:host=localhost;dbname=mtn1', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$id = $_SESSION['enlign'];
$stm = $pdo->prepare("SELECT * From personne WHERE id_per =$id");
$stm->execute();
$result = $stm->fetch();
$sql = $pdo->prepare("SELECT COUNT(id_perspnne) as count From acha WHERE id_perspnne=$id");
$sql->execute();
$count = $sql->fetch();
$count = $count['count'];

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>MTN-Store | Profile</title>
    <style>
        body {
            margin: 10px;
            padding: 10px;
            font-family: cursive, sans-serif;
        }

        form {
            border: 1px solid #eee;
            background-color: #eee;
            width: 400px;
            border-radius: 10px;
            text-align: center;
            padding: 10px;

        }

        .img {
            width: 100px;
            height: 100px;
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            color: white;
        }

        a:hover {
            text-decoration: none;
            color: white;
        }
    </style>
</head>
<body>
<center>
    <form>
        <img src="img/user.png" alt="" class="img">
        <p>nom:<?php echo $result['nom']; ?></p>
        <p>prenom:<?php echo $result['prenom']; ?></p>
        <p>mail:<?php echo $result['mail']; ?></p>
        <p>date naissance:<?php echo $result['date_n']; ?></p>
        <p>Adresse:<?php echo $result['adresse']; ?></p>
        <p>Tele:<?php echo $result['tele']; ?></p>
        <p>Donwload : <?php echo $count; ?></p>

        <button type="button" class="btn btn-primary" name="update"><a
                    href="update.php?id_per=<?php echo $id ?>">Update</a></button>
        <button type="button" class="btn btn-danger"><a href="logout.php">logout</a></button>
        <button type="button" class="btn btn-success"><a href="Home.php">Go to Home</a></button>


    </form>
    <form style="display: inline-block" method="post" action="delete.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <a href="delete.php">
            <button type="submit" class="btn btn-danger">Delete</button>
        </a>
    </form>
    <?php
    $pdo = new PDO('mysql:host=localhost;dbname=mtn1', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $id = $_SESSION['enlign'];
    $sql = $pdo->prepare("SELECT * From acha WHERE id_perspnne=$id");
    $sql->execute();
    $all = $sql->fetchAll();
    $count = $sql->rowCount();

    ?>
    <br><br><br>
    <section>
        <table class="table">
            <thead>
            <tr>
                <th scope="col"> name</th>
                <th scope="col">category</th>
                <th scope="col">date</th>
                <th scope="col">link</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // print_r($all);
            // $all=$all;
            // echo $all[0][0];
            for ($i = 0; $i < $count; $i++) {
                $id_books = $all[$i][0];

                $sql = $pdo->prepare("SELECT `name`,`category`,`pdf` From books WHERE id_books=$id_books");
                $sql->execute();
                $books = $sql->fetchAll();
                $name = $books[0]['name'];
                $category = $books[0]['category'];
                $pdf = $books[0]['pdf'];
                // echo $pdf;
                $date = $all[$i]['dateacha'];
                echo "<tr><td>$name</td><td>$category</td><td> $date</td><td><a href='http://localhost/WebSite/dash.php?src=$pdf?$id_books'><button class='btn btn-success'>download</button></a></td></tr>";
            }
            ?>
            </tbody>
        </table>
    </section>
</center>
</body>
</html>