<?php

// Generate hashed password
$password = 'sam';
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Output hashed password
echo $hashedPassword;
