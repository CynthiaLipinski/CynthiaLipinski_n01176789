<?php
//VALIDATIONS
$errors="";
$gender="";
$email="";
$name="";
$postalcode="";
//get values and assign local variables
if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $postalcode = $_POST['postalcode'];
    $gender = $_POST['gender'];
    
    $heardfrom = isset($_POST['heardfrom']) ? $_POST['heardfrom'] : "";
    
    $errors = validateForm($name, $email, $postalcode, $gender, $heardfrom,$errors);
    if(empty($errors)) {
        $errors = "Your form has been submitted";
    }
}

//function to validate forms
function validateForm($name, $email, $postalcode, $gender, $heardfrom,$errors) {
    if(empty($name)) {
        $errors .="Please enter a name<br/>";
    } 
    
    if(empty($email)) {
        $errors .= "Please enter email<br/>";
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){ 
            $emailerr ="please enter a valid email<br/>";
        }
    }
    
    if(empty($postalcode)) {
        $errors .="Please enter a postal code<br/>";
    } else {
        $pattern = "/^([a-zA-Z]\d[a-zA-Z])\ {0,1}(\d[a-zA-Z]\d)$/";
        if (checkPattern($pattern, $postalcode)) {
            $errors .= "Please enter a valid postal code<br/>";
        }
    }
    
    if(empty($gender)) {
        $errors .="Please select a gender<br/>";
    }
    
     if(empty($heardfrom)) {
        $errors .="Please select where you heard of us from the dropdown<br/>";
    }
    
    return $errors;
}

//function to validate with regular expression
function checkPattern($pattern, $value){
    return !preg_match($pattern, $value);
}
?>
