<?php //playlist controller
class Playlist{

    //returns all the playlists
    public function GetAll($dbcon){
        $sql = "SELECT * FROM playlist";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();
        $playlist = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $playlist;
    }
    
    //gets all songs attached to playlist id
    public function GetPlaylistSongs($dbcon,$id){
        $sql = "SELECT * FROM playlistxsongs where playlistid = :id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id',$id);
        $pdostm->execute();
        $playlistSongs = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $playlistSongs;
    }

    //gets specific playlist id
    public function GetPlaylist($dbcon, $id){
        $sql = "SELECT * FROM playlist where id = :id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id',$id);
        $pdostm->execute();
        $playlist = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $playlist;
    }

    //deletes playlistxsongs
    public function DeletePlaylistSongs($dbcon,$id){
        $sql = "DELETE FROM playlistxsongs WHERE playlistid = :id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id', $id);
        $rows = $pdostm->execute();

        if ($rows) {
            echo "deleted a playlistxsong";
            
        } else {
            $pdostm->debugDumpParams();
        }
    }
    
    //returns all playlists associated with the user id
    public function GetUserPlaylist($dbcon, $id){
        $sql = "SELECT * FROM playlist where userid = :id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id',$id);
        $pdostm->execute();
        $playlist = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $playlist;
    }
    //loads values to newly created playlist
    public function AddPlaylist($dbcon,$info){
        $sql = "INSERT INTO playlist (name, description, userid)
        values (:name, :description, :userid)";
        $pdostm= $dbcon->prepare($sql);
        $pdostm->bindParam(':name', $info['name']);
        $pdostm->bindParam(':description', $info['description']);
        $pdostm->bindParam(':userid', $info['userid']);
        $rows = $pdostm->execute();
        return $dbcon->lastInsertId();
        
        if($rows) {
            echo "Created a playlist";
            exit;
        }
        else {
            echo "Error creating playlist";
        }
    }

    //Adds a song to playlist
    public function AddSong($dbcon,$playlistid,$songid){
        $sql = "INSERT INTO playlistxsongs (playlistid, songid)
        values (:playlistid, :songid)";
        $pdostm= $dbcon->prepare($sql);
        $pdostm->bindParam(':playlistid', $playlistid);
        $pdostm->bindParam(':songid', $songid);
        $rows = $pdostm->execute();
    }

    //returns all songs
    public function GetAllSongs($dbcon){
        $sql = "SELECT * FROM uploaded_audio";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();
        $songs = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $songs;
    }

    //gets specific song
    public function GetSong($dbcon,$id){
        $sql = "SELECT * FROM uploaded_audio where id = :id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id', $id);
        $pdostm->execute();
        $songs = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $songs;
    }

    //updating playlist
    public function UpdatePlaylist($dbcon, $info){
        $sql = "UPDATE playlist
                set name = :name,
                description = :description,
                where id =:id";
         $pdostm = $dbcon->prepare($sql);
         $pdostm->bindParam(':name', $info['name']);
         $pdostm->bindParam(':description', $info['description']);
         $pdostm->bindParam(':id', $info['id']);   
         $rows = $pdostm->execute();

         if ($rows) {
            echo "Updated a playlist";
            
        } else {
            $pdostm->debugDumpParams();
        }
        
    }
    //deleting playlist
    public function DeletePlaylist($dbcon,$id){
        $sql = "DELETE FROM playlist WHERE id = :id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id', $id);
        $rows = $pdostm->execute();

        if ($rows) {
            echo "deleted a playlist";
            
        } else {
            $pdostm->debugDumpParams();
        }
    }
}
?>