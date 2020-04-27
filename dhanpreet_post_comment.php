<?php
require('bitewave_connection__db.php');
$code = 856578585875;

if(isset($_POST['submit_comment'])){
    $user_comment = $_POST['user_comment'];
    $user_id = $_POST['user_id'];
    $audio_id = $_POST['audio_id'];

    //Database connection file
    require('bitewave_connection__db.php');

    $sql = "INSERT INTO user_comments (user_id, user_comment, audio_id)
            VALUES (    :user_id,
                        :user_comment,
                        :audio_id)";
    $pst = $dbcon->prepare($sql);

    $pst->bindParam(':user_id', $user_id);
    $pst->bindParam(':user_comment', $user_comment);
    $pst->bindParam(':audio_id', $audio_id);
    
    $count = $pst->execute();
    if($count){
        header("Location: dhanpreet_audio_detail.php?id=".($audio_id+$code));
    }
    else {  echo "problem adding a data"; }
}
?>