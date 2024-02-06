<?php 
// Initialise the session
session_start();



?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Carousel Template for Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/carousel/">

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="carousel.css" rel="stylesheet">
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="http://localhost/videovuokramo/index.php">Videovuokraamo</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <?php
                    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
                        echo '<li class="nav-item ';
                        echo ($valikko==='asiakas')?'active':'';
                        echo ' ">
                        <a class="nav-link" href="http://localhost/videovuokramo/asiakas/asiakas.php">Asiakas <span class="sr-only">(current)</span> </a>
                        </li>';
                        echo '<li class="nav-item ';
                        echo ($valikko==='video')?'active':'';
                        echo '">
                        <a class="nav-link" href="http://localhost/videovuokramo/video/video.php">Video</a>
                        </li>';
                        echo '<li class="nav-item ';
                        echo ($valikko==='vuokraus')?'active':'';
                        echo '">
                        <a class="nav-link" href="http://localhost/videovuokramo/vuokraus.php">Vuokraus</a>
                        </li>';
                        echo '<li class="nav-item ';
                        echo ($valikko==='myyja')?'active':'';
                        echo '">
                        <a class="nav-link" href="http://localhost/videovuokramo/myyja/myyja.php">Myyjä</a>
                        </li>';
                        echo '<li class="nav-item dropdown ';
                        echo ($valikko==='raportit')?'active':'';
                        echo '">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Raportit
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="vuokralla.php">Vuokralla</a>
                        </div>
                        </li>';
                    }

                    ?>
                </ul>
                <form class="form-inline mt-2 mt-md-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Syötä hakusana" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Haku</button>
                </form>

                <?php 
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
                    echo '<a class="nav-link" href="http://localhost/videovuokramo/ulos.php">Ulos <span class="oi oi-account-logout"></span></a>';
                }else {
                    echo '<a class="nav-link" href="sisaan.php">Kirjaudu <span class="oi oi-account-loing"></span></a>';
                    // echo '<a class="nav-link" href="ulos.php">Log out <span class="oi oi-account-loing"></span></a>'; test
                }

                ?>
            </div>
        </nav>
    </header>

<?php

// Ei tehdä tarkistusta, jos käyttäjä on etusivulla
// Ei tehdä tarkistusa, jos käyttäjä on kirjaudu sivulla
// Käyttäjää ei päästetä muille sivuille ilman kirjautumista, vaan hänet
// ohjataan takaisin etusivulle
//exit loettaa koodin suorittamisen

// if ($_SERVER["PHP_SELF"] != "/amber/index.php") {
//     if($_SERVER["PHP_SELF"] != "/amber/kirjaudu.php") {
//         if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true){
//             header("location: index.php");
//             exit;
//         }
//     }  

// }




?>