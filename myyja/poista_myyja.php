<?php
// include a file that contains the class that we use to connect to the database.

require '../database.php';
include '../header.php';
include '../redirect.php';
$myyjaID = null; //initialize variable

//check if myyjaID passed with the get method
// if so, store the value

if (!empty($_GET['myyjaID'])) {
    $myyjaID = $_REQUEST['myyjaID'];

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM myyja where myyjaID = ?";
    $q = $pdo->prepare($sql);
    $pdo->exec("set names utf8");
    $q->execute(array($myyjaID));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
}

if (!empty($_POST)) {
    $myyjaID = $_POST['myyjaID'];

    //delete the myyjaID data from db, go back to the myyja.php

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM myyja where myyjaID = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($myyjaID));
    Database::disconnect();
    header("Location: myyja.php");
}
?>



<body style="margin-top: 100px;">
    <div class="container">

        <div class="row">
            <h3>Poista myyjä</h3>
        </div>

        <form action="poista_myyja.php" method="post">
            <input type="hidden" name="myyjaID" value="<?php echo $myyjaID; ?>" />
            <p class="alert alert-warning">Haluatko varmasti poistaa myyjän <?php echo $data['etunimi'] . " " . $data["sukunimi"]; ?> tiedot?</p>
            <div>
                <button type="submit" class="btn btn-danger">Kyllä</button>
                <a class="btn" href="myyja.php">Ei</a>
            </div>
        </form>
    </div>

    <?php
    include '../redirect.php';

    ?>