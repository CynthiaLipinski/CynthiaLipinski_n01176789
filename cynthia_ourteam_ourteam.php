<?php //team controller (admin view)
class Member{

    //returns all of team members
    public function GetAll($dbcon){
        $sql = "SELECT * FROM team";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();
        $team = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $team;
    }

    //returns one member
    public function GetWithId($dbcon,$id){
        $sql = "SELECT * FROM team where id = :id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id', $id);
        $pdostm->execute();
        
        $members = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $members;
    }

    //adds a new team member 
    public function AddMember($dbcon,$member){
        $sql = "INSERT INTO team (name, position, about) 
        values (:name, :position, :about)";
        $pdostm= $dbcon->prepare($sql);
        $pdostm->bindParam(':name',$member['name']);
        $pdostm->bindParam(':position',$member['position']);
        $pdostm->bindParam(':about', $member['about']);
        $rows = $pdostm->execute();

        if ($rows) {
            echo "added a member";
            
        } else {
            $pdostm->debugDumpParams();
        }
    }

    //updating a team members info 
    public function UpdateMember($dbcon, $info){
        $sql = "UPDATE team
                set name = :name,
                position = :position,
                about = :about
                where id =:id";
         $pdostm = $dbcon->prepare($sql);
         $pdostm->bindParam(':name', $info['name']);
         $pdostm->bindParam(':position', $info['position']);
         $pdostm->bindParam(':about', $info['about']);
         $pdostm->bindParam(':id', $info['id']);   
         $rows = $pdostm->execute();

         if ($rows) {
            echo "Updated a member";
            
        } else {
            $pdostm->debugDumpParams();
        }
        
    }
    //deleting team member 
    public function DeleteMember($dbcon,$id){
        $sql = "DELETE FROM team WHERE id = :id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id', $id);
        $rows = $pdostm->execute();

        if ($rows) {
            echo "deleted a member";
            
        } else {
            $pdostm->debugDumpParams();
        }
    }
}