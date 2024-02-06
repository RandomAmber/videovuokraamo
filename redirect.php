<?php

//Otherwise, it's multidirecting!!!

// "too many redirects occurred trying to open “localhost/videovuokramo/index.php”. This might occur if you open a page that is redirected to open another page which then is redirected to open the original page"

// Check if the user is not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to the home page
    header('location: http://localhost/videovuokramo/index.php');
    exit;
}
?>

