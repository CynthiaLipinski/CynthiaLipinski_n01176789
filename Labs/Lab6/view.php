<?php
session_start();
require_once 'database.php';
require_once 'profile.php';



if(isset($_SESSION['id'])){
    $profile = new Profile();

    $profile = $profile->GetWithId(Database::GetDb(),$_SESSION['id'])[0];

}

if(isset($_POST['deleteProfile'])){
    $profileDelete = new Profile();
    $profileDelete->Delete(Database::GetDb(),$profile->id);
    session_unset();
    header("Location:login.php");
}
require_once('header.php');
?>

<div class="main">
    <div><p>Username: <?echo $profile->username;?></p>
<?
    if($profile->country==null){
        echo "you have no country specified";
    }else{
        echo "Country: ".$profile->country;
    }?>
        <p>Email: <?echo $profile->email;?></p>
        <p>Gender: <?echo $profile->gender;?></p>
        </div>
        
    <a href="Update.php">Update</a>
    <a href="logout.php">Logout</a>
</div>
<?php require_once('footer.php'); ?>