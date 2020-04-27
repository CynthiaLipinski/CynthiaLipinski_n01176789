<?php
require('bitewave_connection__db.php');

$sql = "SELECT * FROM uploaded_audio";
$pdostm = $dbcon->prepare($sql);
$pdostm->execute();

$list_audio = $pdostm->fetchAll(PDO::FETCH_ASSOC);
$i=0;
$code = 856578585875;
?>
<!-- Header File -->
<?php require_once('master_layout/header.php'); ?>
<!--  M A I N    B O D Y    S E C T I O N  -->
<section class="list_audio_section">
    <p class="page_head">Music for you -<span> Listen all Day & Night</span></p>
    <table class="list_audioTable">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Artist</th>
            <th scope="col">Gener</th>
            <th scope="col">Year</th>
            <th scope="col">Language</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($list_audio as $audio) { $i += 1; ?>
            <tr>
                <th><?= $i ?></th>
                <td><a href="dhanpreet_audio_detail.php?id=<?= ($audio['id'] + $code) ?>"><?= $audio['audio_title'] ?></a></td>
                <td><?= $audio['audio_artist'] ?></td>
                <td><?= $audio['audio_gener'] ?></td>
                <td><?= $audio['audio_year'] ?></td>
                <td><?= $audio['audio_language'] ?></td>
                <td>
                    <form action="dhanpreet_update_audio.php" method="post">
                        <input type="hidden" name="id" value="<?= $audio['id'] ?>"/>
                        <button type="submit" name="update_audio" id="btn-update" class="button">Update</button>
                    </form>
                </td>
                <td>
                    <form action="dhanpreet_delete_audio.php" method="post">
                        <input type="hidden" name="id" value="<?= $audio['id'] ?>"/>
                        <button type="submit" name="delete_audio" id="btn-delete" class="button">Delete</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</section>
<!-- footer section -->
<?php require_once('master_layout/footer.php'); ?>