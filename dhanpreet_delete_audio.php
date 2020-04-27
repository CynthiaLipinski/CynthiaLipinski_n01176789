<?php
$path = $audio_file_location = $sql = "";
if(isset($_POST['id'])){
    $id = $_POST['id'];

    require('bitewave_connection__db.php');
    $sql = "SELECT audio_file_location from uploaded_audio WHERE id = :id";
    $pst = $dbcon->prepare($sql);
    $pst->bindParam(':id', $id);
    $pst->execute();
    $path = $pst->fetch(PDO::FETCH_OBJ);
    $audio_file_location = $path->audio_file_location; 

    if($audio_file_location != ""){
        echo $audio_file_location;
        if(unlink ($audio_file_location)){
            $sql = "DELETE FROM uploaded_audio WHERE id = :id";
            $pst = $dbcon->prepare($sql);
            $pst->bindParam(':id', $id);
            $count = $pst->execute();
            
            if($count){ header("Location: dhanpreet_list_audio.php");   }
            else {  echo " problem deleting";   }
        }
        else    {   echo "Check Code...";   }
    }
    else    {   echo "Error Check... No Audio File Found...";   }
}
