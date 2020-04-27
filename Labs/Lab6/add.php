<?php
require_once 'database.php';
require_once 'profile.php';

$usernameErr = "";
$passwordErr= "";
$emailErr= "";
$countryErr="";
$genderErr="";

if (isset($_POST['addProfile'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $gender = $_POST['gender'];
    
    $isValid=true;
    
    
    $profile = new Profile();
    
    $getprofiles = $profile->getUsernames(Database::GetDb()); 
    
    foreach($getprofiles as $profile){
        
            if($username==$profile->username){
                $usernameErr="this is already taken";
                $isValid=false;
                
            }
    }


    if(empty($username)){
        $usernameErr="Please fill out a username.";
        $isValid=false;
    }

    if(empty($password)){
        $passwordErr="Please fill out a password.";
        $isValid=false;
    }
        
    if(empty($email)){
        $emailErr="Please fill out a email.";
        $isValid=false;
    }
    
    if($isValid){
        $profile = new Profile();
        
        $profile->Add(Database::GetDb(),[
            "username" => $username,
            "password" => $password,
            "email" => $email,
            "country" => $country,
            "gender" => $gender
        ]);
        header("location:profile.php");
        exit();
    }
    
}
?>
<div>
    <div>
        <form method="post" action="add.php">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter your username">
                <p class="error">
                    <?echo $usernameErr;?>
                </p>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password">
                <p class="error">
                    <?echo $passwordErr;?>
                </p>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email">
                <p class="error">
                    <?echo $emailErr;?>
                </p>
            </div>
            <div>
                <label for="country">Country:</label>
                <input type="text" id="country" name="country" placeholder="Enter your country">
            </div>
            <div>
                <label for="gender">Gender:</label>
                <input type="text" id="gender" name="gender" placeholder="Enter your gender">
            </div>
            <button type="submit" name="addProfile">Create</button>
        </form>
    </div>
</div>
