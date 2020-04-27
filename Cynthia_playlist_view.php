<?php
session_start();
require_once 'Cynthia_database.php';
require_once 'Cynthia_userprofile_profile.php';
require_once 'Cynthia_playlist_playlist.php';

//loads selected playlist
if(isset($_SESSION['id'])){
    $playlist = new Playlist();
    $thisPlaylist = $playlist->GetPlaylist(Database::GetDb(),$_POST['playlistid']);
    $thisPlaylistSongs = $playlist->GetPlaylistSongs(Database::GetDb(),$_POST['playlistid']);
}else{
    header("location:Cynthia_userprofile_login.php");
}

require_once('master_layout/header.php');
?>
<div class="registerview"style="padding:50px;" >

    <?php
        foreach($thisPlaylistSongs as $song){
            $thisSong='';
            $thisSong = $playlist->GetSong(Database::GetDb(),$song->songid)[0];
            echo '<div>Title: '.$thisSong->audio_title.'</div>';
            echo '<div>Artist: '.$thisSong->audio_artist.'</div>';
            echo '<div>Genre: '.$thisSong->audio_gener.'</div>';
            echo '<div>Year: '.$thisSong->audio_year.'</div>';
            echo '<div>Language: '.$thisSong->audio_langauge.'</div><br>';
        }
    ?>

    <form action="Cynthia_playlist_delete.php" method="POST" style="padding:20px;">
        <input type="hidden" name="playlistid" value="<?php echo $_POST['playlistid'];?>">
        <button type="submit" name="update" class="buttons">Delete</button>
        <a href="Cynthia_userprofile_view.php" class="buttons" style="margin:20px;">Back</a>
    </form>   
</div>
<?php require_once('master_layout/footer.php'); ?>