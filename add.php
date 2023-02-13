<?php try {
    $pdo = new PDO("mysql:host=localhost;dbname=mtn1", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Failed" . $e->getMessage();
}
session_start();
if (!isset($_SESSION['enlign']) || $_SESSION['usertype'] == 0) {
    header('Location:http://localhost/WebSite/log.php');
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>MTN-Store | Add_Book</title>
    <style>
        body {
            overflow-x: hidden;
            height: 100%;
            background-repeat: no-repeat;
            background-size: 100% 100%;
            font-family: cursive;
            font-weight: bold;
        }

        .card {
            padding: 30px 40px;
            margin-top: 60px;
            margin-bottom: 60px;
            border: none;
            box-shadow: 0 6px 12px 0 rgba(0, 0, 0, 0.2)
        }

        input,
        button {
            padding: 8px 15px;
            border-radius: 5px;
            margin: 5px 0px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            font-size: 18px;
            font-weight: 300
        }

        .blue-border textarea {
            border: 1px solid #2365ef;
        }

        .blue-border .form-control:focus {
            border: 1px solid #2365ef;
            box-shadow: 0 0 0 0.2rem rgba(19, 43, 131, 0.25);
        }

        a {
            text-decoration: none;
            color: white;
        }

        .btn-outline-primary:hover {
            background-color: white;
        }

        a:hover {
            color: white;
        }

    </style>
</head>
<body>
<center>
    <div class="container-fluid px-1 py-5 mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                <div class="card">
<!--  -->
<!--  -->
<!--  -->
<!--  -->
                    <?php if (!isset($_GET['id'])):?>
                    <form class="form-card" method="post" action="" enctype="multipart/form-data">
                        <div>
                            <h2><img src="img/logo.png" alt="" width="70px">
                                <img src="img/MTN.png" alt="" width="200px"></h2>
                        </div>
                        <div class="row justify-content-between text-left">

                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Title<span class="text-danger"> *</span></label>
                                <input type="text" id="fname" name="titel" placeholder="Title"
                                       onblur="validate(1)">
                            </div>

                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Chose Pdf : <span
                                            class="text-danger"> *</span></label>
                                <input type="file" id="src" name="pdf"
                                       onblur="validate(2)">

                            </div>

                        </div>

                        <div class="row justify-content-between text-left">

                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Categorie<span
                                            class="text-danger"> *</span></label>
                                <select name="category" id="categori" class="se">
                                    <option value="frontend">Frontend</option>
                                    <option value="backend">Backend</option>
                                    <option value="mobile">Mobile</option>
                                    <option value="fullstack">Fullstack</option>
                                    <option value="security">Security</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Chose image : <span
                                            class="text-danger"> *</span></label>
                                <input type="file" id="image" name="image"
                                       onblur="validate(4)">
                            </div>

                        </div>

                        <div class="row justify-content-between text-left">

                            <div class="form-group blue-border">
                                <label class="exampleFormControlTextarea4">Discription<span
                                            class="text-danger"> *</span></label>
                                <textarea name="descreption" class="form-control" id="exampleFormControlTextarea4"
                                          placeholder="Descreption"
                                          rows="3"></textarea>
                            </div>
                            <div class="row justify-content-end">
                                <center>
                                    <div class="form-group col-sm-6">
                                        <button type="submit" name="add" class="btn-block btn-success">Add book</button>
                                        <button type="submit" class="btn btn-secondary"><a href="index.php?pu=personne?id_per">Go back</a>
                                        </button>
                                    </div>
                                </center>
                            </div>
                    </form>
                    <!--  -->
                    <?php endif;?>
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->
                    <?php if (isset($_GET['id'])):
                        $id_books=$_GET['id'];
                        $sql=$pdo->prepare("SELECT * FROM books WHERE id_books=$id_books;");
                        $sql->execute();
                        $resulta=$sql->fetchAll();
                        $tit=$resulta[0][1];
                        $cat=$resulta[0][4];
                        $disc=$resulta[0][3];
                        $img=$resulta[0][2];
                        $pd=$resulta[0][5];

                        ?>
                    <!--  -->
                        <form class="form-card" method="post" action="" enctype="multipart/form-data">
                        <div>
                            <h2><img src="img/logo.png" alt="" width="70px">
                                <img src="img/MTN.png" alt="" width="200px"></h2>
                        </div>
                        <div class="row justify-content-between text-left">

                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Title<span class="text-danger"> *</span></label>
                                <input type="text" value="<?php echo $tit?>" id="fname" name="titel" placeholder="Title"
                                       onblur="validate(1)">
                            </div>

                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Chose Pdf : <span
                                            class="text-danger"> *</span></label>
                                <input type="file" id="src" name="pdf"
                                       onblur="validate(2)">

                            </div>

                        </div>

                        <div class="row justify-content-between text-left">

                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Categorie<span
                                            class="text-danger"> *</span></label>
                                <select name="category" id="categori" class="se">
                                    <option value="frontend"<?php if($cat="frontend"){echo "selected";}?>>Frontend</option>
                                    <option value="backend"<?php if($cat="backend"){echo "selected";}?>>Backend</option>
                                    <option value="mobile"<?php if($cat="mobile"){echo "selected";}?>>Mobile</option>
                                    <option value="fullstack"<?php if($cat="fullstack"){echo "selected";}?>>Fullstack</option>
                                    <option value="security"<?php if($cat="security"){echo "selected";}?>>Security</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Chose image : <span
                                            class="text-danger"> *</span></label>
                                <input type="file" id="image" name="image"
                                       onblur="validate(4)">
                            </div>

                        </div>

                        <div class="row justify-content-between text-left">

                            <div class="form-group blue-border">
                                <label class="exampleFormControlTextarea4">Discription<span
                                            class="text-danger"> *</span></label>
                                <textarea name="descreption" class="form-control" id="exampleFormControlTextarea4"
                                          placeholder="Descreption"
                                          rows="3"><?php echo $disc?></textarea>
                            </div>
                            <div class="row justify-content-end">
                                <center>
                                    <div class="form-group col-sm-6">
                                        <button type="submit" name="update" class="btn-block btn-success">Update book</button>
                                        <button type="submit" class="btn btn-secondary"><a href="index.php?pu=personne?id_per">Go back</a>
                                        </button>
                                    </div>
                                </center>
                            </div>
                    </form>
                    
                        <?php endif;?>
<!--  -->
<!--  -->
<!--  -->
<!--  -->
                </div>
            </div>
        </div>
    </div>
</center>
</body>
<?php
if (isset($_SESSION['enlign']) and $_SESSION['usertype'] == 1) {

    if (isset($_POST['add'])) {
        $titel = $_POST['titel'];
        $descreption = $_POST['descreption'];
        $category = $_POST['category'];
        $image = $_FILES["image"];
        $image_name = $image['name'];
        $image_tmp = $image['tmp_name'];
        $pdf = $_FILES["pdf"];
        $pdf_name = $pdf['name'];
        $pdf_tmp = $pdf['tmp_name'];
        // echo "<br>" . $image['name'];
        $sql = $pdo->prepare("INSERT INTO books (`id_books`,`name`,`img`,`description`,`category`,`pdf`,`dateadd`) 
            value(null,'$titel','$image_name','$descreption','$category','$pdf_name',now())");
        $sql->execute();
        if ($sql) {
            move_uploaded_file($image_tmp, $image_name);
            move_uploaded_file($pdf_tmp, $pdf_name);
            echo "<script>alert('Create Successfully')</script>";
        }
    }
} else {
    header('Location:http://localhost/WebSite/log.php');
}
?>
<?php
if (isset($_SESSION['enlign']) and $_SESSION['usertype'] == 1) {

    if (isset($_POST['update'])) {
        $s='';
        $j='';
        $titel = $_POST['titel'];
        $descreption = $_POST['descreption'];
        $category = $_POST['category'];
        $image = $_FILES["image"]; 
        $image_name = $image['name'];
        $image_tmp = $image['tmp_name'];
        $pdf = $_FILES["pdf"];
        $pdf_name = $pdf['name'];
        $pdf_tmp = $pdf['tmp_name'];
        if (empty($image_name)) {

           $image_name = $img;
           $j='empty';
        }
        else {
            // $j='notempty';
        }
        if (empty($pdf_name)) {

             $pdf_name = $pd;
             $s='empty';
            //  echo$s;
         }
        else {
            $s='notempty';
            // echo$j;
        }
       
        
       
//        echo "UPDATE books SET`name`='$titel',`img`='$image_name',`description`='$descreption',`category`='$category',`pdf`='$pdf_name',`dateadd`=now() WHERE `id_books`=$id_books";
//         echo "<br>" . $image['name'];
        $sql = $pdo->prepare("UPDATE books SET`name`='$titel',`img`='$image_name',`description`='$descreption',`category`='$category',`pdf`='$pdf_name',`dateadd`=now() WHERE `id_books`=$id_books");
        $sql->execute();
        if ($sql) {
            echo "<script>alert('Update Successfully')</script>";
        }
        if ( $j=='notempty' and $sql) {
            move_uploaded_file($pdf_tmp, $pdf_name);
        }
        if ( $s=='notempty' and $sql) {
            move_uploaded_file($pdf_tmp, $pdf_name);
        }
    }
} else {
    header('Location:http://localhost/WebSite/log.php');
}
?>
</html>