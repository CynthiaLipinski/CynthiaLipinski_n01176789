<?php
session_start();
require_once 'database.php';
require_once 'profile.php';

$usernameErr = "";
$passwordErr= "";
$emailErr= "";
$countryErr="";
$genderErr="";


if(isset($_SESSION['id'])){
    $profile = new Profile();

    $profile = $profile->GetWithId(Database::GetDb(),$_SESSION['id'])[0];
}

if (isset($_POST['updateProfile'])) {
    //$username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $gender = $_POST['gender'];
    
    $isValid=true;

    if(empty($password)){
        $passwordErr="Please fill out a password.";
        $isValid=false;
    }
        
    if(empty($email)){
        $emailErr="Please fill out a email.";
        $isValid=false;
    }
    
    if($isValid){
        echo $gender." ".$email." ".$country." ".$password." ".$_SESSION['id'];
        $profile = new Profile();
    
        $profile->Update(Database::GetDb(),["password" => $password,
            "email" => $email,
            "country" => $country,
            "gender" => $gender,
            "id"=>$_SESSION['id']
        ]); 
        
        header("Location:view.php");
        exit();
    }
    
}
//deleting profile sends user back to login page
if(isset($_POST['deleteProfile'])){
    $profileDelete = new Profile();
    $profileDelete->Delete(Database::GetDb(),$profile->id);
    session_unset();
    header("Location:login.php");
}
require_once('header.php');
?>
<div>
    <div>
        <form method="post" action="Update.php">
            <div>
                <label>Update setting for: <?echo $profile->username;?></label>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password"  value="<?echo $profile->password;?>"placeholder="Enter your password">
                <p class="error">
                    <?echo $passwordErr;?>
                </p>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" value="<?echo $profile->email;?>">
                <p class="error">
                    <?echo $emailErr;?>
                </p>
            </div>
            <div>
                <label for="country">Country:</label>
                <input type="text" id="country" name="country" value="<?echo $profile->country;?>" placeholder="Enter your country">
            </div>
            <div>
                <label for="gender">Gender:</label>
                <input type="text" id="gender" name="gender" value="<?echo $profile->gender;?>" placeholder="Enter your gender">
            </div>
            <button type="submit" name="updateProfile">Update</button>
        </form>
        
    </div>
    <form method="post" >
            <button type="submit" class="buttons" name="deleteProfile">Delete Account</button>
        </form>
</div>
<?php require_once 'footer.php';?>