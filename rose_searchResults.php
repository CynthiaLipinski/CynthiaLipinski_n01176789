<?php 
      require_once 'bitewave_connection__db.php';

    if(isset($_GET['searchAudio'])) {
        $search = $_GET['audioSearch'];
        
        $sql = "SELECT * FROM audio WHERE artist LIKE '%".$search."%'";
        $sql2 = "SELECT * FROM audio WHERE title LIKE '%".$search."%'";
        $pdostm = $dbcon->prepare($sql);
        $pdostm = $dbcon->prepare($sql2);
        $pdostm->execute();
            
        $result = $pdostm->setFetchMode(PDO::FETCH_OBJ);
                
        if($search == "") {
            echo "Please enter a value.";
        } else if ($result = $pdostm->fetchAll()) { 
        
    ?>
    <html>
        <table>
            <thead>
                <tr>
                    <th>Artist</th>
                    <th>Title</th>
                    <th>Genre</th>
                    <th>Year</th>
                    <th>Language</th>
                    <th>Audio Cover</th>
                </tr>
            </thead>
        <?php  foreach ($result as $s) { ?> 
            <tbody>
                <tr>
                    <td><?php echo $s['artist']; ?></td>
                    <td><?php echo $s['title']; ?></td>
                    <td><?php echo $s['genre']; ?></td>
                    <td><?php echo $s['year']; ?></td>
                    <td><?php echo $s['language'];?></td>
                    <td><?php echo $s['audiocover'];?></td>
                </tr>
            </tbody>
        </table>
    </html>
<?php
    }
        } else {
            echo "No results";
        } //else 
    }//isset
?>