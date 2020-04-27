<?php
session_start();
require_once 'Cynthia_database.php';
require_once 'Cynthia_userprofile_profile.php';
require_once 'Cynthia_playlist_playlist.php';

//loads profile with id
if(isset($_SESSION['id'])){
    $profile = new Profile();
    $playlist = new Playlist();
    $profile = $profile->GetWithId(Database::GetDb(),$_SESSION['id'])[0];
    $userPlaylist = $playlist->GetUserPlaylist(Database::GetDb(),$_SESSION['id']);
}else{
    header("location:Cynthia_userprofile_login.php");
}
require_once('master_layout/header.php');
?>

<div class="profileinfo">
    <h1>Profile Information</h1>
    <p>Username:  <?echo $profile->username;?></p>
    <p>Email:  <?echo $profile->email;?></p>
    <p>Gender:  <?echo $profile->gender;?></p>
    <p><?
    if($profile->country==null){
        echo "you have no country specified";
    }else{
        echo "<p>Country:  ".$profile->country."</p>";
    }?>
    </p>
    <p class="playlistprofile">Playlists</p>
    <div class="playlistlist">
        <?
            foreach($userPlaylist as $playlist)
                echo '<form action="Cynthia_playlist_view.php" method="POST">
                        <input type="hidden" name="playlistid" value="'.$playlist->id.'">
                        <button type="submit" name="update" class="buttons">'.$playlist->name.'</button>
                    </form>';
            ?>
    </div>
    <div class="updatebutton">
    <a href="Cynthia_playlist_add.php" class="buttons">Add a playlist</a>
    <a href="Cynthia_userprofile_Update.php" class="buttons">Update Profile</a>
    </div>
</div>
<?php require_once('master_layout/footer.php'); ?>
