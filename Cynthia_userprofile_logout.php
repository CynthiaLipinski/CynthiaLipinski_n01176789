<?php
//stops session and sends user back to homepage
session_start();
session_unset();

header("location:Cynthia_userprofile_login.php");

?>