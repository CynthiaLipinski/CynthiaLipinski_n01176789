<?php
    include_once 'master_layout/header.php';

    require_once 'bitewave_connection__db.php';
    require_once 'rose_faq.php';

    if(isset($_POST['addFAQ'])) {
        $question = $_POST['question'];
        $answer = $_POST['answer'];
        
        $dbcon = Database::getDb();
        $f = new FAQ();
        $faq = $f->addFAQ($question, $answer, $dbcon);
        
       if($faq){
            header('Location: faqList.php');
        } else {
            echo 'Problem adding to FAQ';
        }
        
    }//isset
?>

<body>
    <form action="" method="post">
        <div>
            <label for="question">Question:</label>
            <input type="text" name="question" id="question"/>
        </div>
        <div>
            <label for="answer">Answer:</label>
            <input type="text" name="answer" id="answer" />
        </div>
        <div>
            <button type="submit" name="addFAQ">Add</button>
            <a href="faqList.php" id="buttonBack">Back</a>
        </div>
    </form>
</body>

<?php 
    include_once 'master_layout/footer.php';
?>