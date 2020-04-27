<?php
session_start();
 require_once 'Cynthia_database.php';
 require_once 'Cynthia_ourteam_ourteam.php';
 require_once 'Cynthia_userprofile_profile.php';

 $profile = new Profile();

 $profile = $profile->GetWithId(Database::GetDb(),$_SESSION['id'])[0];

    if($profile->admin!=1){
        header("Location:Cynthia_ourteam_view.php");  
    }

    if(isset($_POST['update'])){
        $memberid = $_POST['memberid'];
    }
  

    $member = new Member();
    $member = $member->GetWithId(Database::GetDb(),$memberid)[0];

    if(isset($_POST['updateMember'])){
        $isValid=true;
        $name = $_POST['name'];
        $position = $_POST['position'];
        $about = $_POST['about'];
        $memberid=$_POST['thisMemberid'];
        
        if(empty($name)){
            $nameErr="Please fill out a member name.";
            $isValid=false;
        }
        
        if($isValid==true){
        //updates member
           $member = new Member();
           $member->UpdateMember(Database::GetDb(),[ 
                "name" => $name,
                "position" => $position,
                "about" => $about,
                "id" =>(int)$memberid
            ]); 
       
        header("Location:Cynthia_ourteam_view.php");  
        }     
    }
    require_once('master_layout/header.php');
?>
<form method="post" action="">
        <h1> Update a Member</h1>
        <div>
            <label for="name">Name:</label> 
            <input type="text" id="name" name="name" value="<? echo $member->name;?>">
            
        </div>
        <div>
            <label for="position">Position:</label>
            <input type="text" id="position" name="position" value="<? echo $member->position;?>">
        </div>
        <div>
            <label for="about">About:</label>
            <input type="text" id="about" name="about" value="<? echo $member->about;?>">
        </div>
        <input type="hidden" name="thisMemberid" value="<? echo $member->id;?>">
        <button type="submit" name="updateMember" class="buttons">Update</button>
</form> 
<?php require_once 'master_layout/footer.php';?>