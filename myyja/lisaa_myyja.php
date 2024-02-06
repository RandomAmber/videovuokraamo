<?php
// Include a file that contains the class that we use to connect to the database.

require '../database.php';
include '../header.php';
include '../redirect.php';
// If the user has pressed the form's Add button, the form's action is activated and
// send the information contained in the form using the POST method to this same page.
// That is, if we go inside the block, it responds after pressing the Add button, not the first time when entering the page.

if (!empty($_POST)) {
    // You create and initialize the variables for checking the contents of the fields

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

    // the data sent by the POST method is read into the variables

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

    // write the data into db table, if all is ok
    // get the user to myyja.php page

    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("set names utf8");
        $sql = "INSERT INTO myyja (etunimi, sukunimi, lahiosoite, postinumero, postitoimipaikka, puhelin, sahkoposti, kayttajatunnus, salasana, rooli) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($etunimi, $sukunimi, $lahiosoite, $postinumero, $postitoimipaikka, $puhelin, $sahkoposti, $kayttajatunnus, $salasana, $rooli));
        Database::disconnect();
        header("Location: myyja.php");
    }
}
?>


<body style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <h3>Lisää myyjä</h3>
        </div>

        <!-- the form for adding myyja. --> 

        <form action="lisaa_myyja.php" method="post">

            <!-- etunimi -->

            <div class="form-group row <?php echo !empty($etunimiError)?'alert alert-info':'';?>">
                <label class="col-sm-2 col-form-label text-right">Etunimi</label>
                <div class="col-sm-10">
                    <input name="etunimi" type="text" placeholder="Etunimi" value="<?php echo !empty($etunimi)?$etunimi:'';?>">
                    <?php if (!empty($etunimiError)): ?>
                        <small class="text-muted">
                            <?php echo $etunimiError;?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- sukunimi -->

            <div class="form-group row <?php echo !empty($sukunimiError)?'alert alert-info':'';?>">
                <label class="col-sm-2 col-form-label text-right">Sukunimi</label>
                <div class="col-sm-10">
                    <input name="sukunimi" type="text" placeholder="Sukunimi" value="<?php echo !empty($sukunimi)?$sukunimi:'';?>">
                    <?php if (!empty($sukunimiError)): ?>
                        <small class="text-muted">
                            <?php echo $sukunimiError;?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- lahiosoite -->

            <div class="form-group row <?php echo !empty($lahiosoiteError)?'alert alert-info':'';?>">
                <label class="col-sm-2 col-form-label text-right">Lähiosoite</label>
                <div class="col-sm-10">
                    <input name="lahiosoite" type="text" placeholder="Lähiosoite" value="<?php echo !empty($lahiosoite)?$lahiosoite:'';?>">
                    <?php if (!empty($lahiosoiteError)): ?>
                        <small class="text-muted">
                            <?php echo $lahiosoiteError;?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- postinumero -->

            <div class="form-group row <?php echo !empty($postinumeroError)?'alert alert-info':'';?>">
                <label class="col-sm-2 col-form-label text-right">Postinumero</label>
                <div class="col-sm-10">
                    <input name="postinumero" type="text" placeholder="Postinumero" value="<?php echo !empty($postinumero)?$postinumero:'';?>">
                    <?php if (!empty($postinumeroError)): ?>
                        <small class="text-muted">
                            <?php echo $postinumeroError;?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- postitoimipaikka -->

            <div class="form-group row <?php echo !empty($postitoimipaikkaError)?'alert alert-info':'';?>">
                <label class="col-sm-2 col-form-label text-right">Postitoimipaikka</label>
                <div class="col-sm-10">
                    <input name="postitoimipaikka" type="text" placeholder="Postitoimipaikka" value="<?php echo !empty($postitoimipaikka)?$postitoimipaikka:'';?>">
                    <?php if (!empty($postitoimipaikkaError)): ?>
                        <small class="text-muted">
                            <?php echo $postitoimipaikkaError;?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- puhelin -->

            <div class="form-group row <?php echo !empty($puhelinError)?'alert alert-info':'';?>">
                <label class="col-sm-2 col-form-label text-right">Puhelin</label>
                <div class="col-sm-10">
                    <input name="puhelin" type="text" placeholder="Puhelin" value="<?php echo !empty($puhelin)?$puhelin:'';?>">
                    <?php if (!empty($puhelinError)): ?>
                        <small class="text-muted">
                            <?php echo $puhelinError;?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- sahkoposti -->

            <div class="form-group row <?php echo !empty($sahkopostiError)?'alert alert-info':'';?>">
                <label class="col-sm-2 col-form-label text-right">Sähköposti</label>
                <div class="col-sm-10">
                    <input name="sahkoposti" type="text" placeholder="Sähköposti" value="<?php echo !empty($sahkoposti)?$sahkoposti:'';?>">
                    <?php if (!empty($sahkopostiError)): ?>
                        <small class="text-muted">
                            <?php echo $sahkopostiError;?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- kayttajatunnus -->

            <div class="form-group row <?php echo !empty($kayttajatunnusError)?'alert alert-info':'';?>">
                <label class="col-sm-2 col-form-label text-right">Käyttäjätunnus</label>
                <div class="col-sm-10">
                    <input name="kayttajatunnus" type="text" placeholder="Käyttäjätunnus" value="<?php echo !empty($kayttajatunnus)?$kayttajatunnus:'';?>">
                    <?php if (!empty($kayttajatunnusError)): ?>
                        <small class="text-muted">
                            <?php echo $kayttajatunnusError;?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- salasana -->

            <div class="form-group row <?php echo !empty($salasanaError)?'alert alert-info':'';?>">
                <label class="col-sm-2 col-form-label text-right">Salasana</label>
                <div class="col-sm-10">
                    <input name="salasana" type="password" placeholder="Salasana" value="<?php echo !empty($salasana)?$salasana:'';?>">
                    <?php if (!empty($salasanaError)): ?>
                        <small class="text-muted">
                            <?php echo $salasanaError;?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- rooli -->

            <div class="form-group row <?php echo !empty($rooliError)?'alert alert-info':'';?>">
                <label class="col-sm-2 col-form-label text-right">Rooli</label>
                <div class="col-sm-10">
                    <input name="rooli" type="text" placeholder="Rooli" value="<?php echo !empty($rooli)?$rooli:'';?>">
                    <?php if (!empty($rooliError)): ?>
                        <small class="text-muted">
                            <?php echo $rooliError;?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success">Lisää</button>
                <a class="btn" href="myyja.php">Takaisin</a>
            </div>
        </form>
    </div> <!-- /container -->

    <?php
    include '../footer.php';

    ?>
