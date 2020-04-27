<?php
require_once 'Cynthia_database.php';
require_once 'Cynthia_userprofile_profile.php';
//admin view that shows all accounts
$profile = new Profile();
$profiles = $profile->GetAll(Database::GetDb());
var_dump($profiles);

?>
