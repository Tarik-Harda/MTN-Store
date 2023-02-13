<?php
session_start();
if (isset($_SESSION['enlign']) and $_SESSION['usertype'] == 1) {
    header('Location:http://localhost/WebSite/index.php?pu=personne?id_per');
}
if (isset($_SESSION['enlign']) and $_SESSION['usertype'] == 0) {
    header('Location:http://localhost/WebSite/index.php?pu=personne?id_per');
}
$pdo = new PDO('mysql:host=localhost;dbname=mtn1', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_POST['signin'])) {
    $s = 0;
    $nom = $_POST['lname'];
    if (empty($nom)) {
        $s += 1;
    }
    $prenom = $_POST['fname'];
    if (empty($prenom)) {
        $s += 1;
    }
    $mail = $_POST['email'];
    if (empty($mail)) {
        $s += 1;
    }
    $pw = md5($_POST['password']);
    if (empty($pw)) {
        $s += 1;
    }
    $date_n = $_POST['date'];
    if (empty($date_n)) {
        $s += 1;
    }
    $adresse = $_POST['adresse'];
    if (empty($adresse)) {
        $s += 1;
    }
    $tel = $_POST['tel'];
    if (empty($tel)) {
        $s += 1;
    }
    if ($s == 0) {
        $sql = $pdo->prepare("SELECT mail FROM personne WHERE mail='$mail'");
        $sql->execute();
        $idd = $sql->fetchAll();
        if (empty($idd)) {
            $sq = $pdo->prepare("SELECT MAX(id_per) as max FROM personne");
            $sq->execute();
            $id = $sq->fetch();
            $id = $id['max'] + 1;
            $query = $pdo->prepare("INSERT INTO `personne` (`id_per`,`nom`,`prenom`,`mail`,`pw`,`date_n`,`adresse`,`tele`)VALUES ($id,:nom,:prenom,:mail,:pw,:date_n,:adresse,:tele);INSERT INTO `users` (`id`,`login`,`pw`)VALUES (:id,:mail,:pw)");
            $query->bindValue(':id', $id);
            $query->bindValue(':nom', $nom);
            $query->bindValue(':prenom', $prenom);
            $query->bindValue(':mail', $mail);
            $query->bindValue(':pw', $pw);
            $query->bindValue(':date_n', $date_n);
            $query->bindValue(':adresse', $adresse);
            $query->bindValue(':tele', $tel);
            $query->execute();
            $sql = $pdo->prepare("SELECT * FROM users WHERE login='$mail'");
            $sql->execute();
            $resulta = $sql->fetchALL();
            $_SESSION['enlign'] = $resulta[0]['id'];
            $_SESSION['usertype'] = $resulta[0]['usertype'];
            echo "<script>alert('Create Successfully')</script>";
            header('Location:http://localhost/WebSite/Home.php?' . $_SESSION['enlign'] . '?ty=' . $_SESSION['usertype']);

        } else {
            echo "<script>alert('Email Already Existed')</script>";
        }
    }
    else{
        echo"<script>alert('soory!some rows is empty!')</script>";
    }
}

if (isset($_POST['login'])) {
    $s = 0;
    $mail = $_POST['email'];
    if (empty($mail)) {
        $s += 1;
    }
    $pw = md5($_POST['password']);
    if (empty($pw)) {
        $s += 1;
    }
    if ($s == 0) {
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $sql = $pdo->prepare("SELECT * FROM users WHERE login='$email'");
        $sql->execute();
        $resulta = $sql->fetchALL();
        // print_r($resulta);
        // echo"<br>".$resulta[0]['login'].$resulta[0]['pw'];
                if (!empty($resulta)) {
                            if (($resulta[0]['login'] == $email) and ($resulta[0]['pw'] == $password)) {
                                $_SESSION['enlign'] = $resulta[0]['id'];
                                $_SESSION['usertype'] = $resulta[0]['usertype'];
                                echo "enlign" . $_SESSION['enlign'];
                                echo 'usertype: ' . $_SESSION['usertype'];
                                header('Location:http://localhost/WebSite/Home.php?' . $_SESSION['enlign'] . '?ty=' . $_SESSION['usertype']);
                                }
                            else{
                                echo "<script>alert('Email or Password is incorect')</script>";
                                }
                
                }
                else {
                    echo "<script>alert('Email or Password is incorect')</script>";
                }
}
elseif ($s != 0) {
    echo "<script>alert('Email or Password is Empty')</script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
            integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
            crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MTN-Store | Login</title>
    <style>
        body {
            background-color: #f0f2f5;
            margin-top: 3%;
        }

        form {
            border-radius: 5px;
            width: 50%;
            box-shadow: 0px 0px 10px 3px rgb(80, 79, 79);
            background-color: rgb(254, 254, 254);
            padding: 0px 0px 1px 0px;
            height: 650px;
        }

        #div1 {
            display: block;
            margin: 10px;
        }

        #div {
            display: inline-block;
            width: 100%;
        }

        #div > input {
            display: inline-block;
            width: 49.5%;
            border: none;
            margin: 0px;
            height: 40px;
            cursor: pointer;
        }

        .in {
            cursor: pointer;
        }

        #log {
            border-radius: 0px 5px 0px 0px;
        }

        #sign {
            border-radius: 5px 0px 0px 0px;
            height: 30px;
        }

        input:focus {
            box-shadow: 0px 3px 6px 1px rgb(80, 79, 79);
            border-top: none;
        }
    </style>
    <script>
        function melog() {
            var s = '<div> <h2><img src="img/logo.png" alt="" width="70px">  <img src="img/MTN.png" alt="" width="200px"></h2> </div>'
            s += '<br><br><div class="form-group row">'
            s += '<label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Email :</label><br>'
            s += '<div class="col-sm-10">'
            s += '<input type="email" class="form-control form-control-lg" id="colFormLabelLg" name="email" placeholder="Enter Your Email ..."></div> </div>'
            s += '<br><br><div class="form-group row">'
            s += '<label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Password :</label><br>'
            s += '<div class="col-sm-10">'
            s += '<input type="password" class="form-control form-control-lg" id="colFormLabelLg" name="password" placeholder="Enter Your Passwrod ..."></div> </div>'
            s += '<br><br><div class="col-auto"><button type="submit" class="btn btn-success mb-2" name="login">Login</button></div>'
            s += '<style>#log{background-color: white;}</style>'


            var r = '<input type="button" value="Signin" class="in" name="sign" id="sign" onclick="mesign()">'
            r += '<input type="button" value="Login" class="in" name="log" id="log" onclick="melog()">'


            var div = document.getElementById('div')
            div.innerHTML = r
            var div1 = document.getElementById('div1')
            div1.innerHTML = s
        }

        function mesign() {
            var s = '<div> <h2><img src="img/logo.png" alt="" width="70px">  <img src="img/MTN.png" alt="" width="200px"></h2> </div>'
            s += '<div class="form-row mb-3"><div class="col"><label class="form-control-label px-3">First name<span class="text-danger"> *</span></label><input type="text" class="form-control" placeholder="First Name" name="fname"></div>'
            s += '<div class="col"><label class="form-control-label px-3">Last name<span class="text-danger"> *</span></label><input type="text" class="form-control " placeholder="Last Name" name="lname"></div></div>'

            s += '<div class="form-row mb-3"><div class="col">  <label class="form-control-label px-3">Email<span class="text-danger"> *</span></label><input type="email" class="form-control" placeholder="Email" name="email"></div>'
            s += '<div class="col">  <label class="form-control-label px-3">Password<span class="text-danger"> *</span></label><input type="password" class="form-control" placeholder="Password" name="password"></div></div>'

            s += '<div class="form-row mb-3"><div class="col">  <label class="form-control-label px-3">Address<span class="text-danger"> *</span></label><input type="text" class="form-control" placeholder="Address" name="adresse"></div>'
            s += '<div class="col">  <label class="form-control-label px-3">Phone<span class="text-danger"> *</span></label><input type="tel" class="form-control" placeholder="Tele" name="tel"></div></div>'

            s += '<div class="form-row mb-3"><div class="col">  <label class="form-control-label px-3">Birthday<span class="text-danger"> *</span></label><input type="date"  class="form-control" name="date"></div></div>'
            s += '<div class="col"><div class="col-auto"><button type="submit" class="btn btn-success mb-2 in" name="signin">Create</button></div>'
            s += '<style>#sign{background-color: white;}</style>'

            var r = '<input type="button" value="Signin" class="in" id="sign" onclick="mesign()">'
            r += '<input type="button" value="Login" class="in" id="log" onclick="melog()">'
            var div = document.getElementById('div')
            div.innerHTML = r
            var div1 = document.getElementById('div1')
            div1.innerHTML = s
        }
    </script>
</head>
<body onload="melog()">
<center>
    <form action="" method="post">
        <div id="div">
        </div>
        <div id="div1">
        </div>
    </form>
</center>
</body>
</html>