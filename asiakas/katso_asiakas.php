<?php
// include a file that contains the class that we use to connect to the database.

include '../header.php';
include '../redirect.php';


require '../database.php';
$asiakasID = null; //initialize variable

//check if asiakasID passed with the get method
// if so, store the value

if (!empty($_GET['asiakasID'])) {
    $asiakasID = $_REQUEST['asiakasID'];
}

//if asiakasID is not passed, return the user to the asiakas.php page
// if passed, then the data of that customer is retrieved from the table into the  variable

if (null == $asiakasID) {
    header("Location: asiakas.php"); //index.php -> asiakas.php
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("set names utf8");
    $sql = "SELECT * FROM asiakas where asiakasID = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($asiakasID));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
}

?>



<body style="margin-top: 100px;">

    <!-- show the asiakas info with readonly input to the user -->
    <div class="container">
        <div class="row">
            <h3>Katso asiakastietoja</h3>
        </div>

        <!-- hkltunnus -->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">Henkilötunnus</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="statichenkilotunnus" value="<?php echo $data['henkilotunnus']; ?>">
            </div>
        </div>

        <!-- etunimi -->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">Etunimi</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticetunimi" value="<?php echo $data['etunimi']; ?>">
            </div>
        </div>

        <!-- sukunimi -->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">Sukunimi</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticsukunimi" value="<?php echo $data['sukunimi']; ?>">
            </div>
        </div>

        <!-- lahiosoite -->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">Lähiosoite</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticlahiosoite" value="<?php echo $data['lahiosoite']; ?>">
            </div>
        </div>

        <!-- postinumero -->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">Postinumero</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticpostinumero" value="<?php echo $data['postinumero']; ?>">
            </div>
        </div>

        <!-- postitoimipaikka -->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">Postitoimipaikka</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticpostitoimipaikka" value="<?php echo $data['postitoimipaikka']; ?>">
            </div>
        </div>

        <!-- sahkoposti -->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">Sähköposti</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticsahkoposti" value="<?php echo $data['sahkoposti']; ?>">
            </div>
        </div>

        <!-- puhelin -->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">Puhelin</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticpuhelin" value="<?php echo $data['puhelin']; ?>">
            </div>
        </div>

        <div>
            <a class="btn" href="asiakas.php">Takaisin</a> <!-- index.php -> asiakas.php -->
        </div>


    </div>

    <?php
    include '../redirect.php';

    ?>