<?php
$valikko = 'vuokraus';
include 'header.php';
include 'redirect.php';

require_once 'database.php';

$virheilmoitus = '';

// If the user has pressed the Save rental button of the form, the action of the form is activated and sends the information contained in the form using the POST method to this same page.
// That is, if we go inside the block, it responds after pressing the Talleen renting button, not when entering the page the first time.

if (!empty($_POST)) {
    // start the variables for error
    $asiakasError = null;
    $vuokrauspvmError = null;
    $palautuspvmError = null;
    $kokonaishintaError = null;
    $videoError = null;
    $kplHintaError = null;

    // get the variables with POST-method
    $asiakasID = $_POST['asiakasID'];
    $vuokrauspvm = $_POST['vuokrauspvm'];
    $palautuspvm = $_POST['palautuspvm'];
    $kokonaishinta = $_POST['kokonaishinta'];
    $video = $_POST['video'];
    $kplHinta = $_POST['kplHinta'];

    $virheilmoitus = '';
    // Check the user input (that they are not empty)

    $valid = true;
    if (empty($vuokrauspvm)) {
        $virheilmoitus = "Vuokrauspäivä on tyhjä <br/>";
        $valid = false;
    }

    if (empty($palautuspvm)) {
        $virheilmoitus = $virheilmoitus . " " . "Palautuspäivä on tyhjä <br/>";
        $valid = false;
    }

    if (empty($kokonaishinta)) {
        $virheilmoitus = $virheilmoitus . " " .  "Kokonaishinta on tyhjä <br/>";
        $valid = false;
    }

    if (empty($kplHinta)) {
        $virheilmoitus .= "Kappalehinta on tyhjä <br/>";
        $valid = false;
    }

    // get the data to the table if all is ok
    // get the user to vuokraus_onnistui.php page

    if ($valid) {
        $pdo = Database::connect();
        $pdo->beginTransaction();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO vuokraus (AsiakasID, vuokrauspvm, palautuspvm, kokonaishinta) values(?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $pdo->exec("set names utf8");
        $q->execute(array($asiakasID, $vuokrauspvm, $palautuspvm, $kokonaishinta));

        $vuokrausID = $pdo->lastInsertId();
        foreach ($video as $key => $n) {
            $sql = "INSERT INTO vuokrausrivi (VuokrausID, videoID, hinta) values(?,?,?)";
            $q = $pdo->prepare($sql);
            $pdo->exec("set names utf8");
            $q->execute(array($vuokrausID, $video[$key], $kplHinta[$key]));
        }

        $pdo->commit();
        Database::disconnect();
        header("Location: vuokraus_onnistui.php");
    }
}

?>

<div class="container">

    <!-- Form for recording rental information
At the top of the form, general rental information
Videos for rent at the bottom of the form
You can add or remove video lines in the lower part if necessary
Note the array variable naming like <select name="video[]">
-->

    <div class="row" style="margin-top: 100px;">
        <h3>Vuokraustiedot</h3>
    </div>
    <form class="form-horizontal" action="vuokraus.php" method="post">
        <?php if ($virheilmoitus != "") {
            echo '<div style="background-color:red;">';
            echo '<p>' . $virheilmoitus . '</p>';
            echo '</div>';
        }
        ?>

        <div class="row">
            <table class="table table-striped table-bordered">
                <thread>
                    <tr>
                        <th>Asiakas</th>
                        <th>Lainauspvm</th>
                        <th>Palautuspvm</th>
                        <th>Kokonaishinta</th>
                    </tr>
                </thread>
                <tbody>
                    <?php
                    include_once 'database.php';
                    $pdo = Database::connect();
                    $sql = "SELECT asiakasID, CONCAT(etunimi, ' ', sukunimi) kokonimi FROM asiakas ORDER BY sukunimi, etunimi DESC";
                    $pdo->exec("set names utf8");
                    echo '<tr>';
                    echo '<td>';
                    echo '<select name="asiakasID">';
                    foreach ($pdo->query($sql) as $row) {
                        echo '<option value="' . $row['asiakasID'] . '">' . $row['kokonimi'] . '</option>';
                    }
                    echo '</select>';
                    echo '</td>';
                    echo '<td><input name="vuokrauspvm" type="date" value="' . date('Y-m-d') . '">';
                    echo '</td>';
                    echo '<td> <input name="palautuspvm" type="date" value="' . date('Y-m-d', strtotime('+1 day')) . '">';
                    echo '</td>';
                    echo '<td><input name="kokonaishinta" >';
                    echo '</td>';
                    echo '</tr>';

                    Database::disconnect();

                    ?>
                </tbody>
            </table>
        </div>

        <div class="row">
            <label>Kuinka monta rivi haluat näkyviin:
                <select id="participants" class="input-mini required-entry">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>

            </label>
            <table class="table table-striped table-bordered" id="participantTable">
                <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th>Video</th>
                        <th>Hinta</th>
                    </tr>

                </thead>
                <tr class="participantRow">
                    <td>&nbsp;</td>
                    <?php 
                    include_once 'database.php';
                    $pdo = Database::connect();
                    $sql = "SELECT videoID, nimi FROM video ORDER BY nimi";
                    $pdo->exec("set names utf8");
                    echo '<td>';
                    echo '<select name="video[]">';
                    foreach ($pdo->query($sql) as $row){
                        echo '<option value="' . $row['videoID'] . '">' . $row['nimi'] . '</option>';

                    }
                    echo '</select>';
                    echo '</td>';
                    Database::disconnect();

                    ?>
                    <td><input name="kplHinta[]" id="" type="text" value="5" placeholder="Hinta" class="required-entry">
                    </td>
                    <td><button class="btn btn-danger remove" type="button">Poista</button>
                    </td>
                </tr>
                <tr id="addButtonRow">
                    <td colspan="4"><center><button class="btn btn-large btn-success add" type="button">Lisää videorivejä</button></center></td>
                </tr>
            </table>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success">Tallenna vuokraus</button>
            <a class="btn" href="http://localhost/videovuokramo/index.php">Takaisin</a>
        </div>


    </form>

</div>

<?php
include 'footer.php';
?>