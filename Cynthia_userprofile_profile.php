<?php //profile controller
class Profile {
    //gets all profiles
    public function GetAll($dbcon)
    {
        $sql = "SELECT * FROM profiles";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();
        
        $profiles = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $profiles;
    }

    //create new function login
    public function Login($dbcon, $username, $password)
    {
        $query = "SELECT * FROM profiles WHERE username = :username";
        $pdostm = $dbcon->prepare($query);
        $pdostm->bindParam(':username', $username);
      
        $pdostm->execute();
        $users = $pdostm->fetchAll(PDO::FETCH_ASSOC);
        
        $user = $users[0];
        $uid = $user["id"];
        
        if ($user != null) {
            if(password_verify($password, $user["password"] ))
            {
                return $uid;
            }
            else{
                return 'null';
            }
        }
    }
    //returns all profiles with the 
    public function GetWithId($dbcon,$id){
        $sql = "SELECT * FROM profiles where id = :id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id', $id);
        $pdostm->execute();
        
        $profiles = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $profiles;
    }
    //creating values
    public function Add($dbcon, $profile)
    {
        $sql = "INSERT INTO profiles (username, password, email, gender, country)
        values (:username, :password, :email, :gender, :country)";
        $pdostm= $dbcon->prepare($sql);
        $pdostm->bindParam(':username', $profile['username']);
        $pdostm->bindParam(':password', $profile['password']);
        $pdostm->bindParam(':email', $profile['email']);
        $pdostm->bindParam(':gender', $profile['gender']);
        $pdostm->bindParam(':country', $profile['country']);
        
        $rows = $pdostm->execute();
        
        if($rows) {
            echo "Created a profile";
        }
        else {
            echo "Error creating";
        }
    }
    //deletes profile
    public function Delete($dbcon,$id){
        
        $sql = "DELETE FROM profiles WHERE id = :id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id', $id);
        
        $rows = $pdostm->execute();

        if ($rows) {
            echo "deleted a profile";
            
        } else {
            $pdostm->debugDumpParams();
        }
    }
//updating a user profile
    public function Update($dbcon, $profile)
    {
        $sql = "UPDATE profiles
                set password = :password,
                email = :email,
                country = :country,
                gender = :gender
                where id =:id";
         $pdostm = $dbcon->prepare($sql);
         $pdostm->bindParam(':password', $profile['password']);
         $pdostm->bindParam(':email', $profile['email']);
         $pdostm->bindParam(':gender', $profile['gender']);
         $pdostm->bindParam(':country', $profile['country']);
         $pdostm->bindParam(':id', $profile['id']);   
         $rows = $pdostm->execute();

         if ($rows) {
            echo "Updated a profile";
            
        } else {
            $pdostm->debugDumpParams();
        }
        
    }
    //fetches all usernames
    public function getUsernames($dbcon)
    {
        $sql = "SELECT username FROM profiles";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();
        
        $profiles = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $profiles;
    }
}
