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
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Contact Us</title>
        <style>
            * {
                background-color: #eee;

            }

            h1 {
                font-size: 18px;
                margin: auto;
                color: black;
            }

            label {
                background-color: white;
            }

            form {
                box-shadow: 0 18px 20px 0 black;
                width: 60%;
                height: 590px;
                background-color: white;
                color: black;
                cursor: pointer;
                font-size: 18px;
                max-width: 800px;
                margin: auto;
                text-align: center;
                border-radius: 4px;
            }

            input[type=text], input[type=tel], select, textarea {
                width: 99%;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                margin-top: 10px;
                margin-bottom: 16px;
                resize: vertical;
                background-color: white;

            }

            input[type=submit] {
                background-color: #04AA6D;
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            button {
                background-color: brown;
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            input[type=submit]:hover {
                background-color: #45a049;
            }

            .container {

                border-radius: 5px;
                background-color: #eee;
                padding: 20px;
            }
        </style>
    </head>
    <body>
    <div>
        <h1 style="text-align:center;">Contact_Us</h1>
    </div>
    <div class="container">
        <form action="#" method="post">

            <label for="fname">First_Name</label>
            <input type="text" id="fname" name="firstname" placeholder="Your name..">

            <label for="lname">Last_Name</label>
            <input type="text" id="lname" name="lastname" placeholder="Your last name..">

            <label for="lphone">Number_phone</label>
            <input type="tel" id="lphone" name="phone" placeholder="Your Number_phone..">
            <label for="lmail">mail</label>
            <input type="text" id="lmail" name="mail" placeholder="Your mail..">
            <label for="subject">Subject</label>
            <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

            <input type="submit" name="btn" value="Envoyer">
        </form>
    </div>
    </body>
    </html>
<?php
if (isset($_POST['btn'])) {
    $nom = $_POST['firstname'];
    $prenom = $_POST['lastname'];
    $tele = $_POST['phone'];
    $mail = $_POST['mail'];
    $subject = $_POST['subject'];
    $sql = $pdo->prepare("INSERT INTO contact (`nom`,`prenom`,`tele`,`mail`,`subject`) 
            value('$nom','$prenom','$tele','$mail','$subject')");
    $sql->execute();
    if ($sql) {
        echo '<script>alert("your message send succes check your email for found reply.")</script>';
    }

}

?>