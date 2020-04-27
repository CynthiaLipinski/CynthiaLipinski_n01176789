<?php
    $user = 'root';
    $password = '';
    $dbname = 'bitewave';
    $dsn = 'mysql:host=localhost;dbname=' . $dbname;

    $dbcon = new PDO($dsn, $user, $password);
?>