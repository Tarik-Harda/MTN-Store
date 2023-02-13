<?php
Session_start();
if (!isset($_SESSION['enlign'])) {
    header("LOCATION:http://localhost/WebSite/log.php");
}
if ($_SESSION['usertype'] == 0) {
    header("LOCATION:http://localhost/WebSite/profile.php?");
}

?>

<?php
// echo $_SESSION['enlign'].$_SESSION['usertype'];
$pdo = new PDO('mysql:host=localhost;dbname=mtn1', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$search = $_Get['search'] ?? null;
if (isset($_POST['searchbutton'])) {
    $info = $_POST['info'];
    $pu=explode('?',$_GET['pu']);
    $id_=$pu[1];
    $pu=$pu[0];
    if ($info=='id_books') {
        $lik='=';
        $search=$_POST['search'];

    }else{
        $lik='like';
        $search = "'%";
        $search.=$_POST['search'];
        $search.= "%'";
    }
    // echo $lik;
    $statement = $pdo->prepare("SELECT * FROM $pu WHERE `$info` $lik $search");
    
    // $statement->bindValue(':nom', "%$search%");
} else {
    $pu=explode('?',$_GET['pu']);
    $id_=$pu[1];
    $pu=$pu[0];
    $statement = $pdo->prepare("SELECT * FROM $pu ORDER BY $id_");
}
// echo "SELECT * FROM $pu WHERE `$info`$lik $search ORDER BY $id_";
$statement->execute();
$members = $statement->fetchAll(PDO::FETCH_ASSOC);
// print_r($members)


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
    <title>MTN-Store | List</title>
    <style>
        table {
            margin-top: 20px;
        }

        h1 {
            text-align: center;
            font-family: cursive;
            text-decoration: underline
        }

        body {
            background-color: #eee;
            font-family: cursive;
        }

        #a {
            margin-bottom: 12px;
        }
        a{
            text-decoration: none;
            color: white;
        }
        a:hover{
            text-decoration: none;
            color: white;
        }
    </style>
</head>
<body>


<div class="container">

    <a href="add.php" class="btn btn-success" id="a">Create New Book</a>
    <a href="logout.php" class="btn btn-danger" id="a">logout</a>
    <button type="button" class="btn btn-secondary" id="a"><a href="Home.php">Go to Home</a></button>
    <form action="" method="post">
    <button type="button" class="btn btn-secondary" id="a"><a href="http://localhost/WebSite/index.php?pu=personne?id_per">users</a></button>
    <button type="button" class="btn btn-secondary" id="a"><a href="http://localhost/WebSite/index.php?pu=books?id_books">prodact</a></button>
    </form>
            <!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->
    <?php $pu=explode('?',$_GET['pu']);$pu=$pu[0];  if ($pu=='personne'): ?>
    <form method="post">
        <h1>List of Members</h1>
        <div class="input-group mb-3">
            <select name="info" id="">
                <!-- <option value="id_pers">id</option>-->
                <option value="prenom">Last Name</option>
                <option value="nom">First Name</option>
                <option value="mail">Email</option>
                <option value="date_n">Birthday</option>
                <option value="adresse">Address</option>
            </select>
            <input type="text" class="form-control" placeholder="search" name="search" value="<?php echo $search ?>"/>
            <button class="btn btn-outline-secondary" type="submit" name="searchbutton">Search</button>
        </div>
    </form>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#id</th>
            <th scope="col">firstname</th>
            <th scope="col">lastname</th>
            <th scope="col">Email</th>
            <th scope="col">Date_naissance</th>
            <th scope="col">Adresse</th>
            <th scope="col">Option</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($members as $i => $member): ?>
            <tr>
                <th scope="row"><?php echo $member['id_per'] ?></th>
                <td> <?php echo $member['nom'] ?></td>
                <td> <?php echo $member['prenom'] ?></td>
                <td> <?php echo $member['mail'] ?></td>
                <td> <?php echo $member['date_n'] ?></td>
                <td> <?php echo $member['adresse'] ?></td>
                <td>
                    <a href="update.php?id_per=<?php echo $member['id_per'] ?>" class="btn btn-sm btn-outline-primary">Update</a>
                    <form style="display: inline-block" method="post" action="delete.php">
                        <input type="hidden" name="id_per" value="<?php echo $member['id_per'] ?>"/>
                        <a href="delete.php"><button type="submit" class="btn btn-sm btn-outline-danger">Delete</button></a>

                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        <?php $pu=explode('?',$_GET['pu']);$pu=$pu[0]; if ($pu=='books'):?>
            <form method="post">
            <h1>List of Books</h1>
        <div class="input-group mb-3">
            <select name="info" id="">
                <!-- <option value="id_pers">id</option>-->
                <option value="id_books">Id_Prodact</option>
                <option value="category">Category</option>
                <option value="name">Prodact_Name</option>
                <option value="dateadd">Date_Add</option>
                <option value="pdf">Pdf_Name</option>
                
            </select>
            <input type="text" class="form-control" placeholder="search" name="search" value="<?php echo $search ?>"/>
            <button class="btn btn-outline-secondary" type="submit" name="searchbutton">Search</button>
        </div>
    </form>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#id</th>
            <th scope="col">Prodact_Name</th>
            <th scope="col">Pdf_Name</th>
            <th scope="col">Category</th>
            <th scope="col">Date_Add</th>
            
            <th scope="col">Option</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($members as $i => $member): ?>
            <tr>
                <th scope="row"><?php echo $member['id_books'] ?></th>
                <td> <?php echo $member['name'] ?></td>
                <td> <?php echo $member['pdf'] ?></td>
                <td> <?php echo $member['category'] ?></td>
                <td> <?php echo $member['dateadd'] ?></td>
                <td>
                    <a href="add.php?id=<?php echo $member['id_books'] ?>" class="btn btn-sm btn-outline-primary mb-2">Update</a>
                    <form style="display: inline-block" method="post" action="delete.php">
                        <input type="hidden" name="id_books" value="<?php echo $member['id_books'] ?>"/>
                        <a href="delete.php"><button type="submit" class="btn btn-sm btn-outline-danger">Delete</button></a>

                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>