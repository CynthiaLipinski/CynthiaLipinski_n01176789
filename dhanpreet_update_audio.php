<?php
$id = $audio_title = $audio_artist = $audio_gener = $audio_year = $audio_language = "";

if(isset($_POST['update_audio'])) {
    $id= $_POST['id'];

    require('bitewave_connection__db.php');

    $sql = "SELECT * FROM uploaded_audio where id = :id";
    $pst = $dbcon->prepare($sql);
    $pst->bindParam(':id', $id);
    $pst->execute();
    $audio = $pst->fetch(PDO::FETCH_OBJ);

    $audio_title = $audio->audio_title;
    $audio_artist = $audio->audio_artist;
    $audio_gener = $audio->audio_gener;
    $audio_year = $audio->audio_year;
    $audio_language = $audio->audio_language;
}

if(isset($_POST['upd_audio'])) {
    $audio_title = $_POST['audio_title'];
    $audio_artist = $_POST['audio_artist'];
    $audio_gener = $_POST['audio_gener'];
    $audio_year = $_POST['audio_year'];
    $audio_language = $_POST['audio_language'];
    $id = $_POST['sid'];

    require('bitewave_connection__db.php');

    $dbcon = new PDO($dsn, $user, $password);

    $sql = "UPDATE uploaded_audio SET
        audio_title = :audio_title,
        audio_artist = :audio_artist,
        audio_gener = :audio_gener,
        audio_year = :audio_year,
        audio_language = :audio_language
        WHERE uploaded_audio.id = :id";

    $pst =   $dbcon->prepare($sql);

    $pst->bindParam(':audio_title', $audio_title);
    $pst->bindParam(':audio_artist', $audio_artist);
    $pst->bindParam(':audio_gener', $audio_gener);
    $pst->bindParam(':audio_year', $audio_year);
    $pst->bindParam(':audio_language', $audio_language);
    $pst->bindParam(':id', $id);

    $count = $pst->execute();
    if($count){
        header("Location: dhanpreet_list_audio.php");
    }
    else {
        echo "problem updating a audio details";
    }
}

?>
<!-- Header File -->
<?php require_once('master_layout/header.php'); ?>
<!--  M A I N    B O D Y    S E C T I O N  -->
<section class="update_audio">
    <!--    Form to Update Audio file details -->
    <form action="" method="post" enctype="multipart/form-data" class="update_audio__form">
        <input type="hidden" name="sid" value="<?= $id; ?>" />

        <label for="audio_title">Title</label>
        <input type="text" name="audio_title" id="audio_title" value= "<?= $audio_title; ?>" required />
        
        <label for="audio_artist">Artist</label>
        <input type="text" name="audio_artist" id="audio_artist" value= "<?= $audio_artist; ?>" required />
        
        <label for="audio_gener">Gener</label>
        <input type="text" name="audio_gener" id="audio_gener" value= "<?= $audio_gener; ?>" />
        
        <label for="audio_year">Publish Year</label>
        <input type="text" name="audio_year" id="audio_year" value="<?= $audio_year; ?>"/>
        
        <label for="audio_language">Vocal Language</label>
        <input type="text" name="audio_language" id="audio_language" value="<?= $audio_language; ?>" required />

        <div class="buttons">
            <button type="submit" name="back" onclick="history.back();" class="button">Back</button>
            <button type="submit" name="upd_audio" class="button">Update</button>
        </div>
    </form>
</section>
<!-- footer section -->
<?php require_once('master_layout/footer.php'); ?>