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
}

//if asiakasID is not passed, return the user to the asiakas.php page
// if passed, then the data of that customer is retrieved from the table into the  variable

if (null == $asiakasID) {
    header("Location: asiakas.php"); //index.php -> asiakas.php
}

if (!empty($_POST)) {

    //initialise the variables to check the fields:

    $etunimiError = null;
    $sukunimiError = null;
    $lahiosoiteError = null;
    $postinumeroError = null;
    $postitoimipaikkaError = null;
    $puhelinError = null;
    $sahkopostiError = null;
    $henkilotunnusError = null;

    // load the content with POST-method

    $etunimi = $_POST['etunimi'];
    $sukunimi = $_POST['sukunimi'];
    $lahiosoite = $_POST['lahiosoite'];
    $postinumero = $_POST['postinumero'];
    $postitoimipaikka = $_POST['postitoimipaikka'];
    $puhelin = $_POST['puhelin'];
    $sahkoposti = $_POST['sahkoposti'];
    $henkilotunnus = $_POST['henkilotunnus'];

    // check the user's inputs (whether they are empty)
    // if empty, then Error! 

    $valid = true;
    if (empty($etunimi)) {
        $etunimiError = "Syötä etunimi";
        $valid = false;
    }

    if (empty($sukunimi)) {
        $sukunimiError = "Syötä sukunimi";
        $valid = false;
    }

    if (empty($lahiosoite)) {
        $lahiosoiteError = "Syötä lahiosoite";
        $valid = false;
    }

    if (empty($postinumero)) {
        $postinumeroError = "Syötä postinumero";
        $valid = false;
    }

    if (empty($postitoimipaikka)) {
        $postitoimipaikkaError = "Syötä postituimipaikka";
        $valid = false;
    }

    if (empty($puhelin)) {
        $puhelinError = "Syötä puhelin";
        $valid = false;
    }

    if (empty($sahkoposti)) {
        $sahkopostiError = "Syötä sähköposti";
        $valid = false;
    }

    if (empty($henkilotunnus)) {
        $henkilotunnusError = "Syötä henkilötunnus";
        $valid = false;
    }

    // update the info to db table if it is ok
    // return the user to the asiakas.php / index.php page

    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("set names utf8");
        $sql = "UPDATE asiakas SET etunimi = ?, sukunimi = ?, sahkoposti = ?, henkilotunnus = ?, lahiosoite = ?, postinumero = ?, postitoimipaikka = ?, puhelin = ? WHERE asiakasID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($etunimi, $sukunimi, $sahkoposti, $henkilotunnus, $lahiosoite, $postinumero, $postitoimipaikka, $puhelin, $asiakasID));
        Database::disconnect();
        header("Location: asiakas.php"); // index.php -> asiakas.php

    }
} else {
    // get the asiakas data into variables so that the existing data can be displayed

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("set names utf8");
    $sql = "SELECT * FROM asiakas where asiakasID = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($asiakasID));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    $etunimi = $data['etunimi'];
    $sukunimi = $data['sukunimi'];
    $lahiosoite = $data['lahiosoite'];
    $postinumero = $data['postinumero'];
    $postitoimipaikka = $data['postitoimipaikka'];
    $puhelin = $data['puhelin'];
    $sahkoposti = $data['sahkoposti'];
    $henkilotunnus = $data['henkilotunnus'];
    Database::disconnect();
}
?>



<body style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <h3>Päivitä asiakas</h3>
        </div>

        <form action="paivita_asiakas.php?asiakasID=<?php echo $asiakasID ?>" method="post">

            <!-- hkltunnus -->
            <div class="form-group row <?php echo !empty($henkilotunnusError) ? '' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Henkilötunnus</label>
                <div class="col-sm-10">
                    <input name="henkilotunnus" type="text" placeholder="Henkilötunnus" value="<?php echo !empty($henkilotunnus) ? $henkilotunnus : ''; ?>">
                    <?php if (!empty($henkilotunnusError)) : ?>
                        <small class="text-muted">
                            <?php echo $henkilotunnusError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>
            <!-- etunimi -->

            <div class="form-group row <?php echo !empty($etunimiError) ? '' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Etunimi</label>
                <div class="col-sm-10">
                    <input name="etunimi" type="text" placeholder="Etunimi" value="<?php echo !empty($etunimi) ? $etunimi : ''; ?>">
                    <?php if (!empty($etunimiError)) : ?>
                        <small class="text-muted">
                            <?php echo $etunimiError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- sukunimi -->

            <div class="form-group row <?php echo !empty($sukunimiError) ? '' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Sukunimi</label>
                <div class="col-sm-10">
                    <input name="sukunimi" type="text" placeholder="Sukunimi" value="<?php echo !empty($sukunimi) ? $sukunimi : ''; ?>">
                    <?php if (!empty($sukunimiError)) : ?>
                        <small class="text-muted">
                            <?php echo $sukunimiError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>


            <!-- lahiosoite -->

            <div class="form-group row <?php echo !empty($lahiosoiteError) ? '' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Lähiosoite</label>
                <div class="col-sm-10">
                    <input name="lahiosoite" type="text" placeholder="Lähiosoite" value="<?php echo !empty($lahiosoite) ? $lahiosoite : ''; ?>">
                    <?php if (!empty($lahiosoiteError)) : ?>
                        <small class="text-muted">
                            <?php echo $lahiosoiteError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- postinumero -->

            <div class="form-group row <?php echo !empty($postinumeroError) ? '' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Postinumero</label>
                <div class="col-sm-10">
                    <input name="postinumero" type="text" placeholder="Postinumero" value="<?php echo !empty($postinumero) ? $postinumero : ''; ?>">
                    <?php if (!empty($postinumeroError)) : ?>
                        <small class="text-muted">
                            <?php echo $postinumeroError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>


            <!-- postitoimipaikka -->

            <div class="form-group row <?php echo !empty($postitoimipaikkaError) ? '' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Postitoimipaikka</label>
                <div class="col-sm-10">
                    <input name="postitoimipaikka" type="text" placeholder="Postitoimipaikka" value="<?php echo !empty($postitoimipaikka) ? $postitoimipaikka : ''; ?>">
                    <?php if (!empty($postitoimipaikkaError)) : ?>
                        <small class="text-muted">
                            <?php echo $postitoimipaikkaError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- puhelin -->

            <div class="form-group row <?php echo !empty($puhelinError) ? '' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Puhelin</label>
                <div class="col-sm-10">
                    <input name="puhelin" type="text" placeholder="Puhelin" value="<?php echo !empty($puhelin) ? $puhelin : ''; ?>">
                    <?php if (!empty($puhelinError)) : ?>
                        <small class="text-muted">
                            <?php echo $puhelinError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- sahkoposti -->

            <div class="form-group row <?php echo !empty($sahkopostiError) ? '' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Sähköposti</label>
                <div class="col-sm-10">
                    <input name="sahkoposti" type="text" placeholder="Sähköposti" value="<?php echo !empty($sahkoposti) ? $sahkoposti : ''; ?>">
                    <?php if (!empty($sahkopostiError)) : ?>
                        <small class="text-muted">
                            <?php echo $sahkopostiError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success">Päivitä</button>
                <a class="btn" href="asiakas.php">Takaisin</a>

            </div>
        </form>

    </div> <!-- /container -->

    <?php
    include '../redirect.php';

    ?>