<?php
session_start();
require_once 'Cynthia_database.php';
require_once 'Cynthia_userprofile_profile.php';
require_once 'Cynthia_playlist_playlist.php';

//grabbing
if(isset($_SESSION['id'])){
    $profile = new Profile();
    $playlist = new Playlist();
    $profile = $profile->GetWithId(Database::GetDb(),$_SESSION['id'])[0];
    $userPlaylist = $playlist->GetPlaylist(Database::GetDb(),$_POST['playlistid'])[0];
}
else{
    header("location:Cynthia_userprofile_login.php");
}
if(isset($_POST['delete'])){
    $playlist = new Playlist();
    //remove the songs
    
    $playlist-> DeletePlaylistSongs(Database::GetDb(),(int)$_POST['playlistid']);
    //remove the playlist
    $playlist->DeletePlaylist(Database::GetDb(),(int)$_POST['playlistid']);
    header("location:Cynthia_userprofile_view.php");
    exit();
}
require_once('master_layout/header.php');
?>
<div class="profileinfo" stlye="margin:50px;">
    <h1>Are you want to delete the Playlist <?php echo $userPlaylist->name;?></h1> 
    <form action="" method="POST" stlye="margin:50px;">
    <input type="hidden" name="playlistid" value="<?php echo $userPlaylist->id;?>">
    <button type="submit" name="delete" class="buttons" stlye="margin-left:50px;">Yes</button>
</form> 
</section>
<?php require_once('master_layout/footer.php'); ?>