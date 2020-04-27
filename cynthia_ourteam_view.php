<?php
session_start();
require_once 'Cynthia_database.php';
require_once 'Cynthia_ourteam_ourteam.php';
require_once 'Cynthia_userprofile_profile.php';

//loads all team members
$member = new Member();
$members = $member->GetAll(Database::GetDb());
$profile = new Profile();

$profile = $profile->GetWithId(Database::GetDb(),$_SESSION['id'])[0];

require_once('master_layout/header.php');
?>
<div class="profileinfo" style="padding:50px;">
<h1>Our Team</h1>
    <?php //show all the members in divs
        foreach($members as $member){
            echo '<div>Name: '.$member->name.'</div>';
            echo '<div>Position: '.$member->position.'</div>';
            echo '<div>About: '.$member->about.'</div><br>';
            //if user is admin then they can see edit buttons
            //admin is 1 while normal user is 0 in phpmyadmin
            if($profile->admin==1){?>
                <form action="cynthia_ourteam_update.php" method="POST">
                    <input type="hidden" name="memberid" value='<? echo $member->id;?>'>
                    <button type="submit" name="update" class="buttons">Update</button>
                </form>
                <form action="cynthia_ourteam_delete.php" method="POST">
                    <input type="hidden" name="memberid" value='<? echo $member->id;?>'>
                    <button type="submit" name="delete" class="buttons">delete</button>
                </form>
           <? }
        }
        if($profile->admin==1){

            echo '<a class="buttons" href="cynthia_ourteam_add.php">Add a Team Member</a>';
        }
    ?>
<?php require_once('master_layout/footer.php'); ?>
