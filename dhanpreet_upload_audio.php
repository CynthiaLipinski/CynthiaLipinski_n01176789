<?php
$audio_err= array();
//Verify that form is submittes
if(isset($_POST['upload_audio'])) {
  //Storing form value to variables
  $audio_title = $_POST['audio_title'];
  $audio_artist = $_POST['audio_artist'];
  $audio_gener = $_POST['audio_gener'];
  $audio_year = $_POST['audio_year'];
  $audio_language = $_POST['audio_language'];
  $user_id = $_POST['user_id'];

  //Check file is uploaded
  if(isset($_FILES['audio'])){
    //Storing file array values to variables
    $file_name = $_FILES['audio']['name'];
    $file_size =$_FILES['audio']['size'];
    $file_tmp =$_FILES['audio']['tmp_name'];
    $file_type=$_FILES['audio']['type'];
    $file_ext_explode = (explode('.',$file_name));
    $file_ext=strtolower(end($file_ext_explode));

    //Allowed extensions to upload as audio file
    $extensions= array("mp3", "wav");
    
    //Verify that uploded file have allowed extension
    if(in_array($file_ext,$extensions)=== false){
       $audio_err[]="Submitted without audio file or extension not correct, Please choose only .mp3 files";
       print_r($audio_err);
    }
    //Verify that file size must not be more that 5MB
    if($file_size > (1024*1024*20)){
       $audio_err[]='File size must less than 20 MB';
       print_r($audio_err);
    }
    
    //Verify that no error with upload
    if(empty($audio_err)==true){
      //move file ftom tem folder to audio folder
      $audio_file_location = "audio/".time().$file_name; 
      move_uploaded_file($file_tmp,$audio_file_location);

      //Database connection file
      require('bitewave_connection__db.php');

      $sql = "INSERT INTO uploaded_audio (audio_title, audio_artist, audio_gener, audio_year, audio_language, audio_file_location, user_id)
             VALUES ( :audio_title,
                      :audio_artist,
                      :audio_gener,
                      :audio_year,
                      :audio_language,
                      :audio_file_location,
                      :user_id)"; 
      $pst = $dbcon->prepare($sql);
     
      $pst->bindParam(':audio_title', $audio_title);
      $pst->bindParam(':audio_artist', $audio_artist);
      $pst->bindParam(':audio_gener', $audio_gener);
      $pst->bindParam(':audio_year', $audio_year);
      $pst->bindParam(':audio_language', $audio_language);
      $pst->bindParam(':audio_file_location', $audio_file_location);
      $pst->bindParam(':user_id', $user_id);

      $count = $pst->execute();
      if($count){
        header("Location: dhanpreet_list_audio.php");
      }
      else {  echo "problem adding a data"; }
    }
    else { echo "I have no idea what happen...";  }
 }
}

?>
<!-- Header File -->
<?php require_once('master_layout/header.php'); ?>
<!--  M A I N    B O D Y    S E C T I O N  -->
<section class="upload_audio">
  <form action="" method="post" enctype="multipart/form-data" class="upload_audio_form">
    <input type="hidden" id="user_id" name="user_id" value=000000>

    <label for="audio_title">Title</label>
    <input type="text" name="audio_title" id="audio_title" placeholder="Title for audio..." required />
    
    <label for="audio_artist">Artist</label>
      <input type="text" name="audio_artist" id="audio_artist" placeholder="Artist's Name" required />
    
    <label for="audio_gener">Gener</label>
    <input type="text" name="audio_gener" id="audio_gener" placeholder="Gener" required />
    
    <label for="audio_year">Publish Year</label>
    <input type="text" name="audio_year" id="audio_year" minlength="4" maxlength="4"  placeholder="Year when audio published" />
    
    <label for="audio_language">Vocal Language</label>
    <input type="text" name="audio_language" id="audio_language" placeholder="Language in which audio is produced" required />
    
    <label for="audio_file">Select File: [Only .mp3 & .wav] </label>
    <input type="file" name="audio" accept="audio/mp3" id="audio_file"/>

    <button type="submit" name="upload_audio" id="btn-submit" class="button">Upload Audio</button>
  </form>
</section>
<!-- footer section -->
<?php require_once('master_layout/footer.php'); ?>