<?php
require('bitewave_connection__db.php');

$sql = "SELECT * FROM user_comments";
$pdostm = $dbcon->prepare($sql);
$pdostm->execute();
    
$user_comments = $pdostm->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($user_comments);
?>