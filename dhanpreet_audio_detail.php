<?php
$audio_id = $audio_title = $audio_artist = $audio_gener = $audio_year = $audio_language = $user_id ="";
$code = 856578585875;

if(isset($_GET['id'])) {
    $audio_id =  $_GET['id'] - $code;

    require('bitewave_connection__db.php');

    $sql = "SELECT * FROM uploaded_audio where id = :id";
    $pst = $dbcon->prepare($sql);
    $pst->bindParam(':id', $audio_id);
    $pst->execute();
    $audio = $pst->fetch(PDO::FETCH_OBJ);

    $audio_title = $audio->audio_title;
    $audio_artist = $audio->audio_artist;
    $audio_gener = $audio->audio_gener;
    $audio_year = $audio->audio_year;
    $audio_language = $audio->audio_language;
    $user_id = $audio->user_id;
}
?>
<!-- Header File -->
<?php require_once('master_layout/header.php'); ?>
<!--  M A I N    B O D Y    S E C T I O N  -->
<section class="audio_detail">
    <div class="audio_info">
        <p><span>Upload By:</span>  <?= $user_id ?></p></br>
        <p><span>Title:    </span>  <?= $audio_title ?></p></br>
        <p><span>Artist:   </span>  <?= $audio_artist ?></p></br>
        <p><span>Gener:    </span>  <?= $audio_gener ?></p></br>
        <p><span>Year:     </span>  <?= $audio_year ?></p></br>
        <p><span>Language: </span>  <?= $audio_language ?></p></br>
    </div>
    <div class="audio_comment">
        <form action="dhanpreet_post_comment.php" method="post" class="comment_form" id="comment_form">
            <input type="hidden" id="user_id" name="user_id" value=000000>
            <input type="hidden" id="audio_id" name="audio_id" value=<?= $audio_id ?>>

            <label for="comment_box">Comment:</label>
            <textarea name="user_comment" id="user_comment" placeholder="Comment will be public..."></textarea>
            <button type="submit" name="submit_comment" id="submit_comment" class="button">COMMENT</button>
        </form>
        <script>
            $(document).ready(function(){
                var form_data = $('#comment_form');
                $('#submit_comment').click(function(){
                    $.ajax({
                        url: form.attr('action'),
                        type: 'post',
                        data: $('#comment_form input').serialize(),

                        success: function(data){
                            console.log(data);
                        }
                    });
                });
            });
        </script>
    </div>
    <div class="top_comments" id="top_comments">
        <script>
            var ajax = new XMLHttpRequest();
            var method = "POST";
            var url = "dhanpreet_read_comment.php";
            var asynchronous = true;

            ajax.open(method, url, asynchronous);
            ajax.send();

            ajax.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var data = JSON.parse(this.responseText);
                    var append = "";
                    for (let i in data) {
                        var user_id = data[i].user_id;
                        var user_comment = data[i].user_comment;

                        append += "<div class='each_comment'>";
                            append += "<p>User : "+ user_id +"</p>";
                            append += "<p>Comment : "+ user_comment +"</p>";
                        append += "</div>";
                    }
                    document.getElementById("top_comments").innerHTML = append;
                }
            };
        </script>
    </div>
</section>
<!-- footer section -->
<?php require_once('master_layout/footer.php'); ?>