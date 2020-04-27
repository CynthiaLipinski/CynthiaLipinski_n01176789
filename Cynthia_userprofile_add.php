<?php
session_start();
require_once 'Cynthia_database.php';
require_once 'Cynthia_userprofile_profile.php';

$usernameErr = "";
$passwordErr= "";
$emailErr= "";
$countryErr="";
$genderErr="";

//checks if session variable 'id' is set, redirects to profile page if logged in
if(isset($_SESSION['id'])){
    header("location:Cynthia_userprofile_view.php");
    exit();
}

//error handling
if (isset($_POST['addProfile'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $gender = $_POST['gender'];
    $isValid=true;
    $profile = new Profile();
    $getprofiles = $profile->getUsernames(Database::GetDb()); 
    //checks if username is taken
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
    //loads user info to db and hashes password
    if($isValid){
        $profile = new Profile();
        $password=password_hash($password,PASSWORD_DEFAULT);
        $profile->Add(Database::GetDb(),[
            "username" => $username,
            "password" => $password,
            "email" => $email,
            "country" => $country,
            "gender" => $gender
        ]);
        header("location:Cynthia_userprofile_view.php");
        exit();
    }
}

require_once('master_layout/header.php');
?>
    <section class="registerview">
        <form method="post" action="Cynthia_userprofile_add.php" class="createform">
        <h1>Register<h1>
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
            <button type="submit" name="addProfile" class="buttons">Create</button>
        </form>
    </section>
    <?php require_once 'master_layout/footer.php';?>
