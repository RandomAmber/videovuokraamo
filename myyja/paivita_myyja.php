<?php
// include a file that contains the class that we use to connect to the database.
require '../database.php';
include '../header.php';
include '../redirect.php';
$myyjaID = null; //initialize variable

// check if myyjaID passed with the get method
// if so, store the value
if (!empty($_GET['myyjaID'])) {
    $myyjaID = $_REQUEST['myyjaID'];
}

// if myyjaID is not passed, return the user to the myyja.php page
// if passed, then the data of that seller is retrieved from the table into the variable
if (null == $myyjaID) {
    header("Location: myyja.php"); // index.php -> myyja.php
}

if (!empty($_POST)) {

    // initialise the variables to check the fields:
    $etunimiError = null;
    $sukunimiError = null;
    $lahiosoiteError = null;
    $postinumeroError = null;
    $postitoimipaikkaError = null;
    $puhelinError = null;
    $sahkopostiError = null;
    $kayttajatunnusError = null;
    $salasanaError = null;
    $rooliError = null;

    // load the content with POST-method
    $etunimi = $_POST['etunimi'];
    $sukunimi = $_POST['sukunimi'];
    $lahiosoite = $_POST['lahiosoite'];
    $postinumero = $_POST['postinumero'];
    $postitoimipaikka = $_POST['postitoimipaikka'];
    $puhelin = $_POST['puhelin'];
    $sahkoposti = $_POST['sahkoposti'];
    $kayttajatunnus = $_POST['kayttajatunnus'];
    $salasana = $_POST['salasana'];
    $rooli = $_POST['rooli'];

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
        $postitoimipaikkaError = "Syötä postitoimipaikka";
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

    if (empty($kayttajatunnus)) {
        $kayttajatunnusError = "Syötä käyttäjätunnus";
        $valid = false;
    }

    if (empty($salasana)) {
        $salasanaError = "Syötä salasana";
        $valid = false;
    }

    if (empty($rooli)) {
        $rooliError = "Syötä rooli";
        $valid = false;
    }

    // update the info to db table if it is ok
    // return the user to the myyja.php / index.php page
    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("set names utf8");
        $sql = "UPDATE myyja SET etunimi = ?, sukunimi = ?, lahiosoite = ?, postinumero = ?, postitoimipaikka = ?, puhelin = ?, sahkoposti = ?, kayttajatunnus = ?, salasana = ?, rooli = ? WHERE myyjaID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($etunimi, $sukunimi, $lahiosoite, $postinumero, $postitoimipaikka, $puhelin, $sahkoposti, $kayttajatunnus, $salasana, $rooli, $myyjaID));
        Database::disconnect();
        header("Location: myyja.php"); // index.php -> myyja.php
    }
} else {
    // get the myyja data into variables so that the existing data can be displayed
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("set names utf8");
    $sql = "SELECT * FROM myyja where myyjaID = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($myyjaID));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    $etunimi = $data['etunimi'];
    $sukunimi = $data['sukunimi'];
    $lahiosoite = $data['lahiosoite'];
    $postinumero = $data['postinumero'];
    $postitoimipaikka = $data['postitoimipaikka'];
    $puhelin = $data['puhelin'];
    $sahkoposti = $data['sahkoposti'];
    $kayttajatunnus = $data['kayttajatunnus'];
    $salasana = $data['salasana'];
    $rooli = $data['rooli'];

    Database::disconnect();
}
?>


<body style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <h3>Päivitä myyjä</h3>
        </div>

        <form action="paivita_myyja.php?myyjaID=<?php echo $myyjaID ?>" method="post">

            <!-- etunimi -->
            <div class="form-group row <?php echo !empty($etunimiError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Etunimi</label>
                <div class="col-sm-10">
                    <input name="etunimi" type="text" placeholder="Etunimi" value="<?php echo !empty($etunimi) ? $etunimi : ''; ?>">
                    <?php if (!empty($etunimiError)) : ?>
                        <small class="text-danger">
                            <?php echo $etunimiError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- sukunimi -->
            <div class="form-group row <?php echo !empty($sukunimiError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Sukunimi</label>
                <div class="col-sm-10">
                    <input name="sukunimi" type="text" placeholder="Sukunimi" value="<?php echo !empty($sukunimi) ? $sukunimi : ''; ?>">
                    <?php if (!empty($sukunimiError)) : ?>
                        <small class="text-danger">
                            <?php echo $sukunimiError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- lahiosoite -->
            <div class="form-group row <?php echo !empty($lahiosoiteError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Lähiosoite</label>
                <div class="col-sm-10">
                    <input name="lahiosoite" type="text" placeholder="Lähiosoite" value="<?php echo !empty($lahiosoite) ? $lahiosoite : ''; ?>">
                    <?php if (!empty($lahiosoiteError)) : ?>
                        <small class="text-danger">
                            <?php echo $lahiosoiteError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- postinumero -->
            <div class="form-group row <?php echo !empty($postinumeroError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Postinumero</label>
                <div class="col-sm-10">
                    <input name="postinumero" type="text" placeholder="Postinumero" value="<?php echo !empty($postinumero) ? $postinumero : ''; ?>">
                    <?php if (!empty($postinumeroError)) : ?>
                        <small class="text-danger">
                            <?php echo $postinumeroError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- postitoimipaikka -->
            <div class="form-group row <?php echo !empty($postitoimipaikkaError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Postitoimipaikka</label>
                <div class="col-sm-10">
                    <input name="postitoimipaikka" type="text" placeholder="Postitoimipaikka" value="<?php echo !empty($postitoimipaikka) ? $postitoimipaikka : ''; ?>">
                    <?php if (!empty($postitoimipaikkaError)) : ?>
                        <small class="text-danger">
                            <?php echo $postitoimipaikkaError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- puhelin -->
            <div class="form-group row <?php echo !empty($puhelinError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Puhelin</label>
                <div class="col-sm-10">
                    <input name="puhelin" type="text" placeholder="Puhelin" value="<?php echo !empty($puhelin) ? $puhelin : ''; ?>">
                    <?php if (!empty($puhelinError)) : ?>
                        <small class="text-danger">
                            <?php echo $puhelinError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- sahkoposti -->
            <div class="form-group row <?php echo !empty($sahkopostiError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Sähköposti</label>
                <div class="col-sm-10">
                    <input name="sahkoposti" type="text" placeholder="Sähköposti" value="<?php echo !empty($sahkoposti) ? $sahkoposti : ''; ?>">
                    <?php if (!empty($sahkopostiError)) : ?>
                        <small class="text-danger">
                            <?php echo $sahkopostiError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- kayttajatunnus -->
            <div class="form-group row <?php echo !empty($kayttajatunnusError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Käyttäjätunnus</label>
                <div class="col-sm-10">
                    <input name="kayttajatunnus" type="text" placeholder="Käyttäjätunnus" value="<?php echo !empty($kayttajatunnus) ? $kayttajatunnus : ''; ?>">
                    <?php if (!empty($kayttajatunnusError)) : ?>
                        <small class="text-danger">
                            <?php echo $kayttajatunnusError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- salasana -->
            <div class="form-group row <?php echo !empty($salasanaError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Salasana</label>
                <div class="col-sm-10">
                    <input name="salasana" type="text" placeholder="Salasana" value="<?php echo !empty($salasana) ? $salasana : ''; ?>">
                    <?php if (!empty($salasanaError)) : ?>
                        <small class="text-danger">
                            <?php echo $salasanaError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- rooli -->
            <div class="form-group row <?php echo !empty($rooliError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Rooli</label>
                <div class="col-sm-10">
                    <input name="rooli" type="text" placeholder="Rooli" value="<?php echo !empty($rooli) ? $rooli : ''; ?>">
                    <?php if (!empty($rooliError)) : ?>
                        <small class="text-danger">
                            <?php echo $rooliError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success">Päivitä</button>
                <a class="btn" href="myyja.php">Takaisin</a>
            </div>
        </form>

    </div> <!-- /container -->

    <?php
    include '../footer.php';

    ?>
