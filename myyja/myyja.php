<?php
include '../header.php';
include '../redirect.php';
?>
    <body style="margin-top: 100px;">
        <div class="container">
            <div class="row">
                <h3>Myyjätiedot</h3>
            </div>
            <div class="row">
                <p>
                    <a href="lisaa_myyja.php" class="btn btn-success">Lisää</a>
                </p>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Etunimi</th>
                            <th>Sukunimi</th>
                            <th>Sähköposti</th>
                            <th>Toiminto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // Create a connection to the database and search the customer table
                         //customer information in own columns.
                         // Finally, the connection to the database is disconnected.
                         include '../database.php';
                         $pdo = Database::connect();
                         $sql = 'SELECT * FROM myyja ORDER BY sukunimi, etunimi DESC';
                         $pdo->exec("set names utf8");
                         foreach ($pdo->query($sql) as $row) {
                            //echolla tulostetaan dynaamista sisältöä sivulle.
                            echo '<tr>';
                            echo '<td>'. $row['etunimi'] . '</td>';
                            echo '<td>'. $row['sukunimi'] . '</td>';
                            echo '<td>'. $row['sahkoposti'] . '</td>';
                            echo '<td><a class="btn" href="katso_myyja.php?
                            myyjaID='.$row['myyjaID'].'">Katso</a> ';
                            echo ' ';
                            echo '<a class="btn btn-success" href="paivita_myyja.php? 
                            myyjaID='.$row['myyjaID'].'">Päivitä</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="poista_myyja.php? 
                            myyjaID='.$row['myyjaID'].'">Poista</a>';
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
    include '../footer.php';

    ?>