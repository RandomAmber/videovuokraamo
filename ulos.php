<?php

require_once 'config.php'; //fixed the redirection

// Start the session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the index page
header('Location: ' . $root_folder . '/index.php'); // fixed
exit;
?>
