<?php

include '../header.php';
include '../redirect.php';

?>

<body style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <h3>Videotiedot</h3>
        </div>
        <div class="row">
            <p>
                <a href="lisaa_video.php" class="btn btn-success">Lisää</a>
            </p>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nimi</th>
                        <th>Genre</th>
                        <th>Ikaraja</th>
                        <th>Kesto</th>
                        <th>Julkaisupäivä</th>
                        <th>Ohjaaja</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Create a connection to the database and search the customer table
                    //customer information in own columns.
                    // Finally, the connection to the database is disconnected.
                    include '../database.php';
                    $pdo = Database::connect();
                    $sql = 'SELECT * FROM video ORDER BY nimi, genre DESC';
                    $pdo->exec("set names utf8");
                    foreach ($pdo->query($sql) as $row) {
                        //echolla tulostetaan dynaamista sisältöä sivulle.
                        echo '<tr>';
                        echo '<td>' . $row['nimi'] . '</td>';
                        echo '<td>' . $row['genre'] . '</td>';
                        echo '<td>' . $row['ikaraja'] . '</td>';
                        echo '<td>' . $row['kesto'] . '</td>';
                        echo '<td>' . $row['julkaisupaiva'] . '</td>';
                        echo '<td>' . $row['ohjaaja'] . '</td>';
                        echo '<td><a class="btn" href="katso_video.php?
                            videoID=' . $row['videoID'] . '">Katso</a> ';
                        echo ' ';
                        echo '<a class="btn btn-success" href="paivita_video.php? 
                            videoID=' . $row['videoID'] . '">Päivitä</a>';
                        echo ' ';
                        echo '<a class="btn btn-danger" href="poista_video.php? 
                            videoID=' . $row['videoID'] . '">Poista</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    Database::disconnect();
                    ?>

                </tbody>
            </table>
        </div>
    </div> <!-- Container ends -->



    <?php
    include '../redirect.php';

    ?>