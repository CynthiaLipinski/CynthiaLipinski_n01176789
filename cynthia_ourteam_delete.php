<?php
session_start();
require_once 'Cynthia_database.php';
require_once 'Cynthia_ourteam_ourteam.php';

//grabbing
if(isset($_SESSION['id'])){
    if(isset($_POST['delete'])){
        $member = new Member();
        $member = $member->GetWithId(Database::GetDb(),$_POST['memberid'])[0];
    }
}
else{
    header("location:Cynthia_userprofile_login.php");
}
if(isset($_POST['deleteMember'])){
    $member = new Member();
    $member-> DeleteMember(Database::GetDb(),(int)$_POST['memberid']);
    //removes member
    header("location:Cynthia_ourteam_view.php");
    exit();
}
require_once('master_layout/header.php');
?>
<div class="profileinfo" stlye="margin:50px;">
    <h1>Are you sure you want to delete this member <?php echo $member->name;?></h1> 
    <form action="" method="POST" stlye="margin:50px;">
    <input type="hidden" name="memberid" value="<?php echo $member->id;?>">
    <button type="submit" name="deleteMember" class="buttons" stlye="margin-left:50px;">Yes</button>
</form> 
</div>
<?php require_once('master_layout/footer.php'); ?>