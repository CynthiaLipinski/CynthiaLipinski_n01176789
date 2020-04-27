<?php 
$emailerr = "";
$postalerr="";
$nameerr="";
$gendererr="";
$gender = $name= $email = $postalcode="";
if(isset($_POST['signup'])){
    
    $name = $_POST['name'];
    if($name == ""){
        $nameerr= "please enter a name";
    }  else {
        $nameerr = "valid name";
    }
    
    $email = $_POST['email'];
    if($email == ""){
        $emailerr= "please enter email";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $emailerr ="please enter a valid email";
    } else {
        $emailerr = "valid email";
    }
    
    $postal = $_POST['postalcode'];
    $pattern = "/^([a-zA-Z]\d[a-zA-Z])\ {0,1}(\d[a-zA-Z]\d)$/";
    if($postal == ""){
       $postalerr = "please enter a postal code";
    } else if (!preg_match($pattern, $postal)){
       $postalerr = "please enter valid postal code";
    } else {
       $postalerr = "valid postal code";
    }
    
    $gender = $_POST['gender'];
    if($gender == ""){
        $gendererr= "please select a gender";
    }  else {
        $gendererr = "valid gender";
    }
}

?>
<div class="main">
    <h1> Sign up for our monthly newsletter!</h1>
    <form action="" method="post">
        <div>Name: <input type="text" name="name" value="<?php
        if(isset($name))
        { echo $name;}?>" class="textbox" /> <span id="error"><?= $nameerr; ?></span></div>
        <div>Email: <input type="email" name="email" value="<?php
        if(isset($email))
        { echo $email;}?>" class="textbox" /> <span id="error"><?= $emailerr; ?></span></div>
        <div>Postal: <input type="text" name="postalcode" value="<?php
        if(isset($postal))
        { echo $postal;}?>" class="textbox" /> <span id="error"><?= $postalerr; ?></span></div>
        <div>Gender:
            <input type="radio" id="female" name="gender" value="female">Female
            <input type="radio" id="male" name="gender" value="male">Male
            <input type="radio" id="other" name="gender" value="other">Other
            <span id="error"><?= $gendererr; ?></span>
        </div>
        <input type="submit" name="signup" value="Sign Up">

    </form>
</div>
