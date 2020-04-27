<?php 
    class FAQ {
        public function getFAQByID($id, $dbcon) {
            $sql = "SELECT * FROM faq WHERE faqID = :id";
            $pdostm = $dbcon->prepare($sql);
            $pdostm->bindParam(':id', $id);
            $pdostm->execute();
            return $pdostm->fetch(PDO::FETCH_OBJ);
        }//getbyid
        
        public function listFAQ($dbcon) {
            $sql = "SELECT * FROM faq";
            $pdostm = $dbcon->prepare($sql);
            $pdostm->execute();
            
            $faq = $pdostm->fetchAll(PDO::FETCH_ASSOC);
            return $faq;
        }//list
        
        public function addFAQ($question, $answer, $dbcon) {
            $sql = "INSERT INTO faq (question, answer) VALUES ( :question, :answer)";
            $pdostm = $dbcon->prepare($sql);
            
            $pdostm->bindParam(':question', $question);
            $pdostm->bindParam(':answer', $answer);
            
            $addFAQ = $pdostm->execute();
            return $addFAQ;
        }//add
        
        public function deleteFAQ($id, $dbcon) {
            $sql = "DELETE FROM faq WHERE faqID = :id";
            $pdostm = $dbcon->prepare($sql);
            
            $pdostm->bindParam(':id', $id);
            
            $delete = $pdostm->execute();
            return $delete;
        } //delete
        
        public function updateFAQ($id, $question, $answer, $dbcon) {
            $sql = "UPDATE faq
                    set question = :question,
                    answer = :answer
                    WHERE faqID = :id";
            $pdostm = $dbcon->prepare($sql);
            
            $pdostm->bindParam(':question', $question);
            $pdostm->bindParam(':answer', $answer);
            $pdostm->bindParam(':id', $id);
            
            $update = $pdostm->execute();
            return $update;
        }//update
    }//class
?>