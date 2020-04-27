<?php 
session_start();
require_once 'Cynthia_database.php';
require_once 'Cynthia_playlist_playlist.php';

if(!isset($_SESSION['id'])){
    header("location:Cynthia_userprofile_login.php");
    exit();
}
$playlist = new Playlist();
//grabs all songs from database
$songs = $playlist->GetAllSongs(Database::GetDb());

//creates playlist
if(isset($_POST['addPlaylist'])){

    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $isValid=true;
    if(empty($name)){
        $nameErr="Please fill out a playlist name.";
        $isValid=false;
    }

    if($isValid==true){
//loads playlist to db
    $id = $playlist->AddPlaylist(Database::GetDb(),[ 
            "name" => $name,
            "description" => $desc,
            "userid"=>$_SESSION['id']
            ]); 
       echo $id;  
       foreach($_POST['song_list'] as $selected){
            $playlist->AddSong(Database::GetDb(),$id,$selected);
           
        }
        header("Location:Cynthia_userprofile_view.php");  
    }     
}

require_once('master_layout/header.php');
?>
    <div class="registerview" style="margin: 150px; margin-left: 350px; padding: 50px;">
        <form method="post" action="" class="createform">
        <h1>Create Playlist</h1>
            <div>
                <p>Name: <input type="text" id="name" name="name" placeholder="Enter playlist name"></p>
                <p class="error">
                </p>
            </div>
            <div>
                <p>Description: <input type="text" id="desc" name="desc" placeholder="Enter your description"></p>   
                <p class="error">                 
                </p>
            </div>
            <div>
            <p>Check what would like to add:</p>
                <?php
                    foreach($songs as $song){
                        echo '<input type="checkbox" style="margin-left:80px;" name="song_list[]" value="'.$song->id.'"><label>'.$song->audio_title.'</label><br/>';
                    }
                ?>
            </div>
            <button type="submit" name="addPlaylist" class="buttons" style="margin:50px;">Create</button>
        </form>
    </div>
<?php require_once 'master_layout/footer.php';?>