<?php
// include a file that contains the class that we use to connect to the database.

require '../database.php';

include '../header.php';
include '../redirect.php';

$myyjaID = null; // initialize variable

// check if myyjaID passed with the get method
// if so, store the value

if (!empty($_GET['myyjaID'])) {
    $myyjaID = $_REQUEST['myyjaID'];
}

// if myyjaID is not passed, return the user to the myyja.php page
// if passed, then the data of that seller is retrieved from the table into the variable

if (null == $myyjaID) {
    header("Location: myyja.php");
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("set names utf8");
    $sql = "SELECT * FROM myyja WHERE myyjaID = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($myyjaID));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
}

?>



<body style="margin-top: 100px;">

    <!-- show the myyja info with readonly input to the user -->
    <div class="container">
        <div class="row">
            <h3>Katso myyjätietoja</h3>
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

        <!-- puhelin -->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">Puhelin</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticpuhelin" value="<?php echo $data['puhelin']; ?>">
            </div>
        </div>

        <!-- käyttäjätunnus -->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">Käyttäjätunnus</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="statickayttajatunnus" value="<?php echo $data['kayttajatunnus']; ?>">
            </div>
        </div>

        <!-- rooli -->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">Rooli</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticrooli" value="<?php echo $data['rooli']; ?>">
            </div>
        </div>

        <!-- sähköposti -->
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">Sähköposti</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticsahkoposti" value="<?php echo $data['sahkoposti']; ?>">
            </div>
        </div>

        <div>
            <a class="btn" href="myyja.php">Takaisin</a>
        </div>

    </div>

    <?php
    include '../redirect.php';

    ?>