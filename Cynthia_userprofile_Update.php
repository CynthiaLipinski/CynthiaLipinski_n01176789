<?php
session_start();
require_once 'Cynthia_database.php';
require_once 'Cynthia_userprofile_profile.php';

$usernameErr = "";
$passwordErr= "";
$emailErr= "";
$countryErr="";
$genderErr="";

//if logged in, pulls user information, else redirects to homepage
if(isset($_SESSION['id'])){
    $profile = new Profile();
    $profile = $profile->GetWithId(Database::GetDb(),$_SESSION['id'])[0];
}else{
    header("location:Cynthia_userprofile_login.php");
}

if (isset($_POST['updateProfile'])) {
    $password = $_POST['password'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $gender = $_POST['gender'];
    $isValid=true;
    
    //not checking for password and leaving it blank because
    //the password is hashed in the db and needs to be decrpted to fill in the value
    if(empty($email)){
        $emailErr="Please fill out a email.";
        $isValid=false;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        $isValid=false;
    }
    
    //country and gender can be null so dont need to check
    var_dump($isValid);
    if($isValid){
        $profile = new Profile();
        $password=password_hash($password,PASSWORD_DEFAULT);
        $profile->Update(Database::GetDb(),["password" => $password,
            "email" => $email,
            "country" => $country,
            "gender" => $gender,
            "id"=>$_SESSION['id']
        ]); 
        header("Location:Cynthia_userprofile_view.php");
        exit();
    }
}

//deleting profile sends user back to login page
if(isset($_POST['deleteProfile'])){
    $profileDelete = new Profile();
    $profileDelete->Delete(Database::GetDb(),$profile->id);
    session_unset();
    header("Location:Cynthia_userprofile_login.php");
}
require_once('master_layout/header.php');
?>
    <div class="profileinfo">
        <form method="post" action="Cynthia_userprofile_Update.php" class="createform" style="margin:50px;">
            <div>
                <h1>Update setting for: <?echo $profile->username;?></h1>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password"  value="" placeholder="Enter your password">
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
                <p class="error">
                    <?echo $genderErr;?>
                </p>
            </div>
            <button type="submit" class="buttons" name="updateProfile">Update</button>
        </form>
        <form method="post" style="position: inherit;">
            <button type="submit" class="buttons" name="deleteProfile" style="margin-left:50px; margin-bottom: 20px;">Delete Account</button>
        </form>
    </div>
<?php require_once 'master_layout/footer.php';?>