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

    $nimiError = null;
    $kuvausError = null;
    $genreError = null;
    $ikarajaError = null;
    $kestoError = null;
    $julkaisupaivaError = null;
    $tuotantovuosiError = null;
    $ohjaajaError = null;
    $nayttelijatError = null;
    $kuvaError = null;

    // the data sent by the POST method is read into the variables

    $nimi = $_POST['nimi'];
    $kuvaus = $_POST['kuvaus'];
    $genre = $_POST['genre'];
    $ikaraja = $_POST['ikaraja'];
    $kesto = $_POST['kesto'];
    $julkaisupaiva = $_POST['julkaisupaiva'];
    $tuotantovuosi = $_POST['tuotantovuosi'];
    $ohjaaja = $_POST['ohjaaja'];
    $nayttelijat = $_POST['nayttelijat'];
    $kuva = $_POST['kuva'];


    // check the user's inputs (whether they are empty)
    // if empty, then Error! 

    $valid = true;


    if (empty($nimi)) {
        $nimiError = "Syötä nimi";
        $valid = false;
    }

    if (empty($kuvaus)) {
        $kuvausError = "Syötä kuvaus";
        $valid = false;
    }

    if (empty($genre)) {
        $genreError = "Syötä genre";
        $valid = false;
    }

    if (empty($ikaraja)) {
        $ikarajaError = "Syötä ikäraja";
        $valid = false;
    }

    if (empty($kesto)) {
        $kestoError = "Syötä kesto";
        $valid = false;
    }

    if (empty($julkaisupaiva)) {
        $julkaisupaivaError = "Syötä julkaisupäivä";
        $valid = false;
    }

    if (empty($tuotantovuosi)) {
        $tuotantovuosiError = "Syötä tuotantovuosi";
        $valid = false;
    }

    if (empty($ohjaaja)) {
        $ohjaajaError = "Syötä ohjaaja";
        $valid = false;
    }

    if (empty($nayttelijat)) {
        $nayttelijatError = "Syötä näyttelijät";
        $valid = false;
    }


    // write the data into db table, if all is ok
    // get the user to video.php page

    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("set names utf8");
        $sql = "INSERT INTO video (nimi, kuvaus, genre, ikaraja, kesto, julkaisupaiva, tuotantovuosi, ohjaaja, nayttelijat, kuva) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($nimi, $kuvaus, $genre, $ikaraja, $kesto, $julkaisupaiva, $tuotantovuosi, $ohjaaja, $nayttelijat, $kuva));
        Database::disconnect();
        header("Location: video.php");
    }
}
?>




<body style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <h3>Lisää video</h3>
        </div>

        <!-- the form for adding video. -->

        <form action="lisaa_video.php" method="post">

            <!-- nimi -->
            <div class="form-group row <?php echo !empty($nimiError) ? 'alert alert-info' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Nimi</label>
                <div class="col-sm-10">
                    <input name="nimi" type="text" placeholder="Nimi" value="<?php echo !empty($nimi) ? $nimi : ''; ?>">
                    <?php if (!empty($nimiError)) : ?>
                        <small class="text-muted">
                            <?php echo $nimiError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- kuvaus -->
            <div class="form-group row <?php echo !empty($kuvausError) ? 'alert alert-info' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Kuvaus</label>
                <div class="col-sm-10">
                    <input name="kuvaus" type="text" placeholder="Kuvaus" value="<?php echo !empty($kuvaus) ? $kuvaus : ''; ?>">
                    <?php if (!empty($kuvausError)) : ?>
                        <small class="text-muted">
                            <?php echo $kuvausError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- genre -->
            <div class="form-group row <?php echo !empty($genreError) ? 'alert alert-info' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Genre</label>
                <div class="col-sm-10">
                    <input name="genre" type="text" placeholder="Genre" value="<?php echo !empty($genre) ? $genre : ''; ?>">
                    <?php if (!empty($genreError)) : ?>
                        <small class="text-muted">
                            <?php echo $genreError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- ikaraja -->
            <div class="form-group row <?php echo !empty($ikarajaError) ? 'alert alert-info' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Ikäraja</label>
                <div class="col-sm-10">
                    <input name="ikaraja" type="text" placeholder="Ikäraja" value="<?php echo !empty($ikaraja) ? $ikaraja : ''; ?>">
                    <?php if (!empty($ikarajaError)) : ?>
                        <small class="text-muted">
                            <?php echo $ikarajaError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- kesto -->
            <div class="form-group row <?php echo !empty($kestoError) ? 'alert alert-info' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Kesto</label>
                <div class="col-sm-10">
                    <input name="kesto" type="text" placeholder="Kesto" value="<?php echo !empty($kesto) ? $kesto : ''; ?>">
                    <?php if (!empty($kestoError)) : ?>
                        <small class="text-muted">
                            <?php echo $kestoError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- julkaisupaiva -->
            <div class="form-group row <?php echo !empty($julkaisupaivaError) ? 'alert alert-info' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Julkaisupäivä</label>
                <div class="col-sm-10">
                    <input name="julkaisupaiva" type="text" placeholder="yyyy-mm-dd" value="<?php echo !empty($julkaisupaiva) ? $julkaisupaiva : ''; ?>">
                    <?php if (!empty($julkaisupaivaError)) : ?>
                        <small class="text-muted">
                            <?php echo $julkaisupaivaError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- tuotantovuosi -->
            <div class="form-group row <?php echo !empty($tuotantovuosiError) ? 'alert alert-info' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Tuotantovuosi</label>
                <div class="col-sm-10">
                    <input name="tuotantovuosi" type="text" placeholder="Tuotantovuosi" value="<?php echo !empty($tuotantovuosi) ? $tuotantovuosi : ''; ?>">
                    <?php if (!empty($tuotantovuosiError)) : ?>
                        <small class="text-muted">
                            <?php echo $tuotantovuosiError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- ohjaaja -->
            <div class="form-group row <?php echo !empty($ohjaajaError) ? 'alert alert-info' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Ohjaaja</label>
                <div class="col-sm-10">
                    <input name="ohjaaja" type="text" placeholder="Ohjaaja" value="<?php echo !empty($ohjaaja) ? $ohjaaja : ''; ?>">
                    <?php if (!empty($ohjaajaError)) : ?>
                        <small class="text-muted">
                            <?php echo $ohjaajaError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- nayttelijat -->
            <div class="form-group row <?php echo !empty($nayttelijatError) ? 'alert alert-info' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Näyttelijät</label>
                <div class="col-sm-10">
                    <input name="nayttelijat" type="text" placeholder="Näyttelijät" value="<?php echo !empty($nayttelijat) ? $nayttelijat : ''; ?>">
                    <?php if (!empty($nayttelijatError)) : ?>
                        <small class="text-muted">
                            <?php echo $nayttelijatError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <!-- kuva -->
            <div class="form-group row <?php echo !empty($kuvaError) ? 'alert alert-info' : ''; ?>">
                <label class="col-sm-2 col-form-label text-right">Kuva</label>
                <div class="col-sm-10">
                    <input name="kuva" type="text" placeholder="Kuva" value="<?php echo !empty($kuva) ? $kuva : ''; ?>">
                    <?php if (!empty($kuvaError)) : ?>
                        <small class="text-muted">
                            <?php echo $kuvaError; ?>
                        </small>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success">Lisää</button>
                <a class="btn" href="video.php">Takaisin</a>
            </div>
        </form>


    </div> <!-- /container -->

    <?php
    include '../redirect.php';

    ?>