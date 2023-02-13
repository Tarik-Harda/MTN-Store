<?php

if (isset($_POST['profile'])) {
    header('Location:http://localhost/WebSite/log.php');
}
if (isset($_POST['logout'])) {
    header('Location:http://localhost/WebSite/logout.php');
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
            integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
            crossorigin="anonymous"></script>
    <title>MTN-Store | About</title>
    <style>
        html {
            box-sizing: border-box;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }


        .about-section {
            padding: 50px;
            text-align: center;
            background-color: #474e5d;
            color: white;
        }


        .title {
            color: grey;
            font-size: 25px;
        }

        .button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
        }


        .button:hover {
            background-color: #555;
            opacity: 0.7;
        }

        /* The flip card container - set the width and height to whatever you want. We have added the border property to demonstrate that the flip itself goes out of the box on hover (remove perspective if you don't want the 3D effect */
        .flip-card {
            background-color: transparent;
            border: 1px solid #f1f1f1;
            perspective: 1000px; /* Remove this if you don't want the 3D effect */
        }

        .flip-card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            height: 300px;
            background-color: #eee;
            color: black;
            cursor: pointer;
            font-size: 18px;
            max-width: 300px;
            margin: auto;
            text-align: center;
        }

        /* This container is needed to position the front and back side */
        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.8s;
            transform-style: preserve-3d;
        }

        /* Do an horizontal flip when you move the mouse over the flip box container */
        .flip-card:hover .flip-card-inner {
            transform: rotateY(180deg);
        }

        /* Position the front and back side */
        .flip-card-front, .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            -webkit-backface-visibility: hidden; /* Safari */
            backface-visibility: hidden;
        }

        /* Style the front side (fallback if image is missing) */
        .flip-card-front {
            background-color: #bbb;
            color: black;
        }

        /* Style the back side */
        .flip-card-back {
            background-color: #eee;
            color: black;
            transform: rotateY(180deg);
        }

        .column {
            float: left;
            width: 33.3%;
            margin-bottom: 16px;
            padding: 0 8px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;

        }

        body {
            font-family: cursive, sans-serif;
            overflow-x: hidden;


        }

        .navbar {
            font-size: 16px;
        }

        .navbar-light .navbar-nav .nav-link {
            padding: 0 20px;
            color: black;
            transition: 0.3s ease;
        }


        #nav {
            margin-top: -15px;
            height: 115px;
            width: 100%;
            position: fixed;
            top: 0;
            z-index: 20;


        }

        nav ul {
            padding: 0;
            margin: 0;
            float: right;
            margin-right: 30px;
        }

        nav ul li {
            position: relative;
            list-style: none;
            display: inline-block;

        }


        nav ul li #cat {
            background-color: rgb(168, 199, 199);
        }

        nav ul li #cat :hover {
            background-color: rgb(209, 220, 220);
            color: black;
        }

        nav ul li a {
            display: block;
            padding: 0 15px;
            color: white;
            text-decoration: none;
            line-height: 60px;
        }

        nav ul li a:hover {

            color: white;
            text-decoration: none;
        }

        nav ul ul {
            position: absolute;
            top: 60px;
            display: none;
        }

        nav ul li:hover > ul {
            display: block;
        }

        nav ul ul li {
            width: 150px;
            float: none;
            display: list-item;
            position: relative;

        }
        a:hover {
            text-decoration: none;
            color: black;
        }
    </style>
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
                    <a class="nav-link" href="Home.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Categories&nbsp<i class="fas fa-caret-down"></i></a>
                    <ul id="cat">
                        <li><a href="#">frontend</a></li>
                        <li><a href="#">Backend</a></li>
                        <li><a href="#">FullStack</a></li>
                        <li><a href="#">Mobile</a></li>
                        <li><a href="#">Security</a></li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="About.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact us</a>
                </li>

                <li>
                    <form action="" method="post">
                        <button class="btn mt-2" name="profile" id="user"><i
                                    class="fa fa-user"></i>&nbsp&nbsp
                        </button>
                        <button class="btn mt-2" name="logout"><i class="fas fa-sign-out-alt"></i></button>

                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
<br><br><br><br>
<div class="about-section">
    <h1>About Us </h1>

    <h4>this project is carried out by TARIK, MAJID and NABIL, made to help new developers to cultivate information
        through good tutorial books
    </h4>
</div>

<h2 style="text-align:center">Our Team</h2>
<div class="row">
    <div class="column" id="majid">
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <img src="img/MAJID.jpeg" alt="Avatar" style="width:300px;height:300px;">
                </div>
                <div class="flip-card-back">
                    <h2>Abdelmajid</h2>
                    <p>intern in digital development at NTIC SYBA</p>
                    <p class="title">assignment : Backend</p>
                    <p>mail : Majid@gmail.com</p>
                    <p>
                        <button class="button">Contact</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="column" id="tarik">
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <img src="img/Tarik.jpeg" alt="TARIK" style="width:300px;height:300px;">
                </div>
                <div class="flip-card-back">
                    <h2>Tarik</h2>
                    <p>intern in digital development at NTIC SYBA</p>
                    <p class="title">assignment : frontend</p>
                    <p>mail : Tarik@gmail.com</p>
                    <p>
                        <button class="button">Contact</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="column" id="nabil">
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <img src="img/NABIL.jpeg" alt="NABIL" style="width:300px;height:300px;">
                </div>
                <div class="flip-card-back">
                    <h2>Nabil</h2>
                    <p>intern in digital development at NTIC SYBA</p>
                    <p class="title">assignment : frontend</p>
                    <p>mail : Nabil@gmail.com</p>
                    <p>
                        <button class="button">Contact</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>