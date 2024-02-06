<?php
// include a file that contains the class that we use to connect to the database.

require '../database.php';
include '../header.php';
include '../redirect.php';
$asiakasID = null; //initialize variable

//check if asiakasID passed with the get method
// if so, store the value

if (!empty($_GET['asiakasID'])) {
    $asiakasID = $_REQUEST['asiakasID'];

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM asiakas where asiakasID = ?";
    $q = $pdo->prepare($sql);
    $pdo->exec("set names utf8");
    $q->execute(array($asiakasID));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
}

if (!empty($_POST)) {
    $asiakasID = $_POST['asiakasID'];


    //delete the asiakasID data from db, go back to the index.php

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM asiakas where asiakasID = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($asiakasID));
    Database::disconnect();
    header("Location: asiakas.php");
}
?>



<body style="margin-top: 100px;">
<div class="container">

        <div class="row">
            <h3>Poista asiakas</h3>
        </div>

        <form action="poista_asiakas.php" method="post">
            <input type="hidden" name="asiakasID" value="<?php echo $asiakasID;?>"/>
            <p class="alert alert-warning">Haluatko varmasti poistaa asiakkaan <?php echo $data['etunimi'] . " " . $data["sukunimi"] ;?> tiedot?</p>
            <div>
                <button type="submit" class="btn btn-danger">Kyllä</button>
                <a class="btn" href="asiakas.php">Ei</a>
            </div>
        </form>
</div>

<?php
    include '../redirect.php';

    ?>