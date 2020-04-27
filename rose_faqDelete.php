<?php
    
    require_once 'bitewave_connection__db.php';
    require_once 'rose_faq.php';

    if(isset($_POST['faqID'])) {
        $id = $_POST['faqID'];
        $dbcon = Database::getDb();
                
        $f = new FAQ();
        $delete = $f->deleteFAQ($id, $dbcon);
        
        if($delete){
            header("Location: faqList.php");
        } else {
            echo "problem deleting";  
        }
        
    }