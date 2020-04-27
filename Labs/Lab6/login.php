<?php
session_start();
require_once 'database.php';
require_once 'profile.php';

$usernameErr = "";
$passwordErr= "";

if(isset($_SESSION['id'])){
    header("location:view.php");
    exit();
}
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

    //if isvalid
    if($isValid){
        
        $profile = new Profile();
        
        $user = $profile->Login(Database::GetDb(),$username,$password);
        //$_SESSION['id']=$user[0]->id;
        if($user=='null'){
            $loginErr="incorrect credentials";
        }else{
            $_SESSION['id']=$user;
        }
        header("location:view.php");
        exit();

    }
}
require_once 'header.php';
?>
<div>
    <form method="POST" action="" >
        <div>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter your username">
            <p> <?echo $usernameErr;?></p>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password">
            <p> <?echo $passwordErr;?></p>
        </div>
            <button type="submit" name="signIn">Log In</button>
    </form>
</div> 
<?php require_once 'footer.php';?>