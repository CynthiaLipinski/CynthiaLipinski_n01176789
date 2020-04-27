<?php 
session_start();
require_once 'Cynthia_database.php';
require_once 'Cynthia_ourteam_ourteam.php';
require_once 'Cynthia_userprofile_profile.php';

if(!isset($_SESSION['id'])){
   header("location:Cynthia_userprofile_login.php");
    exit();
}
$profile = new Profile();

$profile = $profile->GetWithId(Database::GetDb(),$_SESSION['id'])[0];

if($profile->admin!=1){
    header("location:Cynthia_ourteam_view.php");
    exit(); 
}

$member = new Member();
//grabs all members from database
$members = $member->GetAll(Database::GetDb());

//creates member
if(isset($_POST['addMember'])){

    $name = $_POST['name'];
    $position = $_POST['position'];
    $about = $_POST['about'];
    $isValid=true;
    if(empty($name)){
        $nameErr="Please fill out a member name.";
        $isValid=false;
    }
    if($isValid==true){
//loads member to db
    $member->AddMember(Database::GetDb(),[ 
            "name" => $name,
            "position" => $position,
            "about" => $about,
            ]); 
       
        header("Location:Cynthia_ourteam_view.php");  
    }     
}

require_once('master_layout/header.php');
?>
<div class="profileinfo">
    <form method="post" action=""class="createform" style="margin:50px;">
        <h1> Create Team Member</h1>
        <div>
            <label for="name">Name:</label> 
            <input type="text" id="name" name="name" placeholder="Enter a name">
            
        </div>
        <div>
            <label for="position">Position:</label>
            <input type="text" id="position" name="position" placeholder="Enter a posititon">
        </div>
        <div>
            <label for="about">About:</label>
            <input type="text" id="about" name="about" placeholder="About section">
        </div>
        <button type="submit" name="addMember" class="buttons">Create</button>
    </form> 
</div>
<?php require_once 'master_layout/footer.php';?>