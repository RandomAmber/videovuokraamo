<?php
// include a file that contains the class that we use to connect to the database.

require '../database.php';
include '../header.php';
include '../redirect.php';
$videoID = null; //initialize variable

//check if videoID passed with the get method
// if so, store the value

if (!empty($_GET['videoID'])) {
    $videoID = $_REQUEST['videoID'];
}

//if videoID is not passed, return the user to the video.php page
// if passed, then the data of that customer is retrieved from the table into the  variable

if (null == $videoID) {
    header("Location: video.php");
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("set names utf8");
    $sql = "SELECT * FROM video where videoID = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($videoID));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
}

?>




<body style="margin-top: 100px;">

    <!-- show the video info with readonly input to the user -->
    <div class="container">
        <div class="row">
            <h3>Katso videotietoja</h3>
        </div>

        <div class="row">
        <!-- left column -->
            <div class="col-md-6"> 
                <!-- nimi -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nimi</label>
                    <div class="col-sm-10">
                        <input type="text" style="padding-left: 20px;" readonly class="form-control-plaintext" id="staticnimi" value="<?php echo $data['nimi']; ?>">
                    </div>
                </div>

                <!-- kuvaus -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kuvaus</label>
                    <div class="col-sm-10">
                        <p style="padding-left: 20px;" class="text-wrap"><?php echo $data['kuvaus']; ?></p> 
                        <!-- <input type="text" readonly class="form-control-plaintext text-wrap" id="statickuvaus" value="<?php echo $data['kuvaus']; ?>"> -->
                    </div>
                </div>

                <!-- genre -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Genre</label>
                    <div class="col-sm-10">
                        <input type="text" style="padding-left: 20px;" readonly class="form-control-plaintext" id="staticgenre" value="<?php echo $data['genre']; ?>">
                    </div>
                </div>

                <!-- ikaraja -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Ikäraja</label>
                    <div class="col-sm-10">
                        <input type="text" style="padding-left: 20px;" readonly class="form-control-plaintext" id="staticikaraja" value="<?php echo $data['ikaraja']; ?> +">
                    </div>
                </div>

                <!-- kesto -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kesto</label>
                    <div class="col-sm-10">
                        <input type="text" style="padding-left: 20px;" readonly class="form-control-plaintext" id="statickesto" value="<?php echo $data['kesto']; ?> min">
                    </div>
                </div>

                <!-- julkaisupaiva -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Julkaisupäivä</label>
                    <div class="col-sm-10">
                        <input type="text" style="padding-left: 20px;" readonly class="form-control-plaintext" id="staticjulkaisupaiva" value="<?php echo $data['julkaisupaiva']; ?>">
                    </div>
                </div>

                <!-- tuotantovuosi -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tuotantovuosi</label>
                    <div class="col-sm-10">
                        <input type="text" style="padding-left: 20px;" readonly class="form-control-plaintext" id="statictuotantovuosi" value="<?php echo $data['tuotantovuosi']; ?>">
                    </div>
                </div>

                <!-- ohjaaja -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Ohjaaja</label>
                    <div class="col-sm-10">
                        <input type="text" style="padding-left: 20px;" readonly class="form-control-plaintext" id="staticohjaaja" value="<?php echo $data['ohjaaja']; ?>">
                    </div>
                </div>

                <!-- nayttelijat -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Näyttelijät</label>
                    <div class="col-sm-10">
                        <input type="text" style="padding-left: 20px;" readonly class="form-control-plaintext" id="staticnayttelijat" value="<?php echo $data['nayttelijat']; ?>">
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <!-- kuva -->
                <div class="form-group row"> 
                    <img class="featurette-image img-fluid mx-auto" src="../img/<?php echo $data['kuva']; ?>" alt="<?php echo $row['nimi']; ?>" width="300">


                </div>
            </div>

        </div>





        <div>
            <a class="btn btn-secondary" href="video.php">Takaisin</a>
        </div>


    </div>

    <?php
    include '../footer.php';

    ?>