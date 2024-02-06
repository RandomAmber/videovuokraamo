<?php
include 'header.php';
?>

<main role="main">

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="first-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="First slide">
                <div class="container">
                    <div class="carousel-caption text-left">
                        <h1>Example headline.</h1>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="second-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Second slide">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Another example headline.</h1>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="third-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Third slide">
                <div class="container">
                    <div class="carousel-caption text-right">
                        <h1>One more for good measure.</h1>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <!-- Marketing messaging and featurettes
      ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

        <!-- Three columns of text below the carousel -->
        <div class="row">
            <?php
            // get the info from the db - the last three & echo them onto the page

            include_once "database.php";
            $pdo = Database::connect();
            $pdo->exec("set names utf8");
            $sql = "SELECT * FROM video ORDER BY julkaisupaiva DESC LIMIT 3";

            foreach ($pdo->query($sql) as $row) {
                echo '<div class="col-lg-4">';
                echo '<img class="" src="img/' . $row['kuva'] . '" alt="' . $row['nimi'] . '" width="120" >';
                echo '<p><strong>' . $row['nimi'] . '</strong></p>';
                echo '<p>' . $row['julkaisupaiva'] . '</p>';
                echo '<p><a class="btn btn-secondary" href="video/katso_video.php?videoID=' . $row['videoID'] . '"role="button">Katso lisää</a></p>'; //videon_tiedot.php <-- katso_video.php for now
                echo '</div>';
            }


            ?>

        </div><!-- /.row -->


        <!-- START THE FEATURETTES -->
        <!-- lisäätään tähän tällä kertaa staattisesti kolmen viimeisimmän tiedot. Järkevintä olisi tehdä tämä myös dynaamisesti kuten yllä oleva osio. Voit miettiä miten tämän saisi tehtyä dynaamiseksi.???? -->

        <hr class="featurette-divider">

        <?php
        // get the info from the db - the random 3 & echo them onto the page

        include_once "database.php";
        $pdo = Database::connect();
        $pdo->exec("set names utf8");
        $sql = "SELECT * FROM video ORDER BY RAND() LIMIT 3";
        $counter = 1;
        foreach ($pdo->query($sql) as $row) {
            // the even/odd featurette position:
            if (
                $counter % 2 !== 0
            ) {
                //first & third movies
                echo '<div class="row featurette">';
                echo '<div class="col-md-7">';
                echo '<h2 class="featurette-heading">' . $row['nimi'] . '</h2>';
                echo '<p class="lead">' . $row['kuvaus'] . '</p>';
                echo '</div>';
                echo '<div class="col-md-5">';
                echo '<img class="featurette-image img-fluid mx-auto" src="img/' . $row['kuva'] . '" alt="' . $row['nimi'] . '" width="300" >';
                echo '</div>';
                echo '</div>'; // /div featurette
                echo '<hr class="featurette-divider">';
            } else {
                // second movie
                echo '<div class="row featurette">';
                echo '<div class="col-md-7 order-md-2">';
                echo '<h2 class="featurette-heading">' . $row['nimi'] . '</h2>';
                echo '<p class="lead">' . $row['kuvaus'] . '</p>';
                echo '</div>';
                echo '<div class="col-md-5 order-md-1">';
                echo '<img class="featurette-image img-fluid mx-auto" src="img/' . $row['kuva'] . '" alt="' . $row['nimi'] . '" width="300" >';
                echo '</div>';
                echo '</div>'; // /div featurette
                echo '<hr class="featurette-divider">';
            }

            $counter++;
        }

        Database::disconnect();


        ?>


        <!-- /END THE FEATURETTES -->

    </div><!-- /.container -->


    <!-- FOOTER -->
    <footer class="container">
        <p class="float-right"><a href="#">Back to top</a></p>
        <p>&copy; 2024 Just a test! &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </footer>
</main>

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<?php
include 'footer.php'
?>