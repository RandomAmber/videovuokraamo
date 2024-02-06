<?php
// include a file that contains the class that we use to connect to the database.

include '../header.php';
require '../database.php';
include '../redirect.php';
$videoID = null; // initialize variable

// check if videoID passed with the get method
// if so, store the value

if (!empty($_GET['videoID'])) {
    $videoID = $_REQUEST['videoID'];

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM video where videoID = ?";
    $q = $pdo->prepare($sql);
    $pdo->exec("set names utf8");
    $q->execute(array($videoID));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
}

if (!empty($_POST)) {
    $videoID = $_POST['videoID'];

    // delete the videoID data from db, go back to the video.php

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM video where videoID = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($videoID));
    Database::disconnect();
    header("Location: video.php");
}
?>


<body style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <h3>Poista video</h3>
        </div>

        <form action="poista_video.php" method="post">
            <input type="hidden" name="videoID" value="<?php echo $videoID; ?>" />
            <p class="alert alert-warning">Haluatko varmasti poistaa videon <?php echo $data['nimi']; ?> tiedot?</p>
            <div>
                <button type="submit" class="btn btn-danger">Kyllä</button>
                <a class="btn" href="video.php">Ei</a>
            </div>
        </form>
    </div>
    <?php
    include '../redirect.php';

    ?>