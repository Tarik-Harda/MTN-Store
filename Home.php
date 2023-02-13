<?php try {
    $pdo = new PDO("mysql:host=localhost;dbname=mtn1", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Failed" . $e->getMessage();

}

?>

<?php

if (isset($_POST['profile'])) {
    header('Location:http://localhost/WebSite/log.php');
}
if (isset($_POST['logout'])) {
    header('Location:http://localhost/WebSite/logout.php');
}

?>
<?php
session_start();
if (!empty($_SESSION['enlign'])) {
    $i = $_SESSION['enlign'];
    $q = $pdo->prepare("SELECT nom,prenom  FROM personne WHERE id_per=$i");
    $q->execute();
    $array = $q->fetchAll();
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
            integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/css.css">
    <title>MTN-Store | Home</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light py-3" id="nav">
    <div class="container">

        <img src="img/logo.png" alt="" width="70px">
        <h2><img src="img/MTN.png" alt="" width="200px"></h2>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span id="bar" class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/WebSite/Home.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Categories&nbsp<i class="fas fa-caret-down"></i></a>
                    <ul id="cat">
                        <li><a href="http://localhost/WebSite/Home.php?category=frontend">frontend</a></li>
                        <li><a href="http://localhost/WebSite/Home.php?category=backend">Backend</a></li>
                        <li><a href="http://localhost/WebSite/Home.php?category=fullstack">FullStack</a></li>
                        <li><a href="http://localhost/WebSite/Home.php?category=mobile">Mobile</a></li>
                        <li><a href="http://localhost/WebSite/Home.php?category=security">Security</a></li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="About.php ">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact us</a>
                </li>

                <li>
                    <form action="" method="post">
                        <button class="btn mt-2" name="profile" id="user"><i
                                    class="fa fa-user"></i>&nbsp&nbsp<?php if (!empty($_SESSION['enlign'])) {echo $array[0][0].$array[0][1];}?>
                        </button>
                        <button class="btn mt-2" name="logout"><i class="fas fa-sign-out-alt"></i></button>

                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
<br><br><br><br>
<br><br>
<div class="container">
    <form action="" method="post">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="search" placeholder="Search ..."
                   aria-label="Recipient's username"
                   aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit" name="searchbutton">Search</button>
            </div>
        </div>
    </form>
</div>
<section id="sectioncenter">
    <div class="shadow-lg p-3 mb-5 bg-white rounded mt-5 ml-5 mr-5">
        <br><br><br>

        <?php
        $pdo = new PDO('mysql:host=localhost;dbname=mtn1', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        if (isset($_POST['searchbutton'])) {
            $search = "%" . $_POST['search'] . "%";
            $sql = $pdo->prepare("SELECT id_books FROM books WHERE `name` like '$search' or `category` like '$search' or `description` like '$search' ORDER BY id_books DESC");
//            $sql->bindValue(':nom', "%$search%");
        } elseif (isset($_GET['category'])) {
            $category = $_GET['category'];
            $sql = $pdo->prepare("SELECT id_books FROM books WHERE category='$category' ORDER BY `books`.`id_books` DESC");
        } else {
            $sql = $pdo->prepare("SELECT id_books FROM books ORDER BY `books`.`id_books` DESC");
        }

        $sql->execute();
        $array = $sql->fetchAll();
        $row = $sql->rowCount();
        if (empty($row)) {
            echo "<script>alert('Not Found !!')</script>";
            $sql = $pdo->prepare("SELECT id_books FROM books ");
            $sql->execute();
            $array = $sql->fetchAll();
            $row = $sql->rowCount();
        }
        $s = '<div class="row row-col-1 row-cols-md-3 m-auto my-4">';
        $l = 0;
        for ($i = 0; $i < $row; $i++) {

            $n = $array[$i][0];
            $q = $pdo->prepare("SELECT * FROM books WHERE id_books=$n");
            $q->execute();
            $result = $q->fetch();
            $id = $result['id_books'];
            $name = $result['name'];
            $img = $result['img'];
            $src = $result['pdf'];
            $dec = $result['description'];
            if ($l == 4) {
                $s .= '</div><br><br><div class="row row-col-1 row-cols-md-3 m-auto my-4">';
                $l = 1;
                $s .= '<div class="m-auto col-md-3" id="cards"> ';
                $s .= '<div class="card h-100">';
                $s .= "<img src='$img'class='card-img-top' alt='...' height='400px'/>";
                $s .= '<div class="card-body" >';
                $s .= "<h5 class='card-title'>$name</h5>";
                $s .= "<p class='card-text'>$dec</p>     
    <center>
    <a href='http://localhost/WebSite/dash.php?src=$src?id=$id'>
    <button type='submit' class='btn btn-primary' name='dowload'>Download Book</button>
    </a>
    </center>
    </div>
    </div>
    </div>
    ";

            } else {
                $l += 1;
                $s .= '<div class="m-auto col-md-3" id="cards"> ';
                $s .= '<div class="card h-100">';
                $s .= "<img src='$img'class='card-img-top' alt='...' height='400px'/>";
                $s .= '<div class="card-body">';
                $s .= "<h5 class='card-title'>$name</h5>";
                $s .= "<p class='card-text'>$dec</p>
    <center>
    <a href='http://localhost/WebSite/dash.php?src=$src?$id'>
    <button type='submit' class='btn btn-primary' name='dowload'>Download Book</button>
    </a>
    </center>
    </div>
    </div>
    </div> 

    ";
            }
        }
        echo $s;
        ?>

    </div>
</section>
<br><br>
<hr>
<br><br>
<section id="categories" class="container mb - 5">
    <div class="row mt - 3 mt - 5">
        <div class="col - sm">
            <a href="http://localhost/WebSite/Home.php?category=frontend"><img width="100px" src="img/frontend.png"
                                                                               alt="" class="ml-5">
                <h3 class="ml-4 pl-3"> Frontend</h3>
            </a>
        </div>
        <div class="col-sm">
            <a href="http://localhost/WebSite/Home.php?category=backend"><img width="100px" src="img/backend.png" alt=""
                                                                              class="ml-5">
                <h3 class="ml-5 "> Backend</h3>
            </a>
        </div>
        <a href="http://localhost/WebSite/Home.php?category=fullstack">
            <div class="col-sm"><img width="100px" src="img/Fullstack.png" alt="" class="ml-5">
                <h3 class="ml-5 "> Fullstack</h3>
        </a>
    </div>
    <a href="http://localhost/WebSite/Home.php?category=mobile">
        <div class="col-sm"><img width="100px" src="img/Mobile.png" alt="" class="ml-5">
            <h3 class="ml-5 pl-1"> Mobile</h3>
    </a>
    </div >
    <a href="http://localhost/WebSite/Home.php?category=security">
        <div class="col-sm"><img width="100px" src="img/hacker.png" alt="" class="ml-5">
            <h3 class="ml-4 pl-3"> Security</h3>
    </a>
    </div >
    </div >
    <hr>
    <br><br>
    <br><br>
</section>
<footer>
    <div class="bg-secondary text-center text-white pt-4 mb-4" id="footer">
        <div>
            <section class="mb-4">
                <a class="btn btn-outline-light btn-floating m-1" href="#" role="button"><i
                            class="fab fa-facebook-f"></i></a>


                <a class="btn btn-outline-light btn-floating m-1" href="#" role="button"><i
                            class="fab fa-twitter"></i></a>


                <a class="btn btn-outline-light btn-floating m-1" href="#" role="button"><i
                            class="fab fa-google"></i></a>


                <a class="btn btn-outline-light btn-floating m-1" href="#" role="button"><i
                            class="fab fa-instagram"></i></a>

                <a class="btn btn-outline-light btn-floating m-1" href="#" role="button"><i
                            class="fab fa-github"></i></a>
            </section>

            <div class="row pb-5 pt-2">

                <div class="col-lg-4">
                    <a class="text-uppercase text-white" href="#" role="button"> Home</a>
                </div>
                <div class="col-lg-4">
                    <a class="text-uppercase text-white" href="About.php" role="button"> About</a>
                </div>
                <div class="col-lg-4">
                    <a class="text-uppercase text-white" href="#" role="button"> Contact us </a>
                </div>
            </div>

            <div class="text-center p-3">
                © 2022 Copyright:
                <a class="text-white" href="https://MTN_BOOKS.com/"> MTN_books . com</a>
            </div>
</footer>
</div>
</div>

</body>

</html>