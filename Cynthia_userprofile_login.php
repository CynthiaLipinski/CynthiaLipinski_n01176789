<?php
session_start();
require_once 'Cynthia_database.php';
require_once 'Cynthia_userprofile_profile.php';

$usernameErr = "";
$passwordErr= "";

//checks if session variable 'id' is set, redirects to profile page if logged in
if(isset($_SESSION['id'])){
    header("location:Cynthia_userprofile_view.php");
    exit();
}

//error handling
if(isset($_POST['signIn'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $isValid=true;
    if(empty($username)){
        $usernameErr="Please fill out username";
        $isValid=false;
    }
    if(empty($password)){
        $passwordErr="Please fill out password";
        $isValid=false;
    }

    //if valid log in
    if($isValid){
        $profile = new Profile();
        $user = $profile->Login(Database::GetDb(),$username,$password);
        
        if($user=='null'){
            $loginErr="incorrect credentials";
        }else{
            $_SESSION['id']=$user;
        }
        
        header("location:Cynthia_userprofile_view.php");
        exit();

    }
}
require_once('master_layout/header.php');
?>
<section class="registerview">
    <form method="POST" action="" class="createform" >
        <div>
            <h1>Log In</h1>
            <label for="username">Username: </label>
            <input type="text" id="username" name="username" placeholder="Enter your username">
            <p> <?echo $usernameErr;?></p>
        </div>
        <div>
            <label for="password">Password: </label>
            <input type="password" id="password" name="password" placeholder="Enter your password">
            <p> <?echo $passwordErr;?></p>
        </div>
            <button type="submit" name="signIn" class="button">Log In</button>
    </form>
</section> 
<?php require_once 'master_layout/footer.php';?>