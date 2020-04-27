<?php 
    include_once 'master_layout/header.php';

    require_once 'bitewave_connection__db.php';
    require_once 'rose_faq.php';

    $question = $answer = "";

    if(isset($_POST['updateFAQ'])) {
        $id = $_POST['faqID'];
        $dbcon = Database::getDb();
        
        $f = new FAQ();
        $faq = $f->getFAQByID($id, $dbcon); 
        
        $question = $faq->question;
        $answer = $faq->answer;
        
        //var_dump($faq);
    }

    if(isset($_POST['updFAQ'])) {
        $id = $_POST['fid'];
        $question = $_POST['question'];
        $answer = $_POST['answer'];
        
        $dbcon = Database::getDb();
        $faq = new FAQ();
        $count = $faq->updateFAQ($id, $question, $answer, $dbcon);
        
        if($count) {
            header('Location: faqList.php');
        } else {
            echo "Unable to update";
        }
    }
?>

<body>
    <form action="" method="post">
        <input type="hidden" name="fid" value="<?= $id; ?>" />
        <div>
            <label for="question">Question:</label>
            <input type="text" name="question" id="question" value="<?= $question; ?>" placeholder="Enter Question">
            <span style="color:red">
            
            </span>
        </div>
        <div>
            <label for="answer">Answer:</label>
            <input type="text" name="answer" id="answer" value="<?= $answer; ?>" placeholder="Enter Answer">
            <span style="color:red">
            
            </span>
        </div>
        <a href="faqList.php">Back</a>
        <button type="submit" name="updFAQ">Update FAQ</button>
    </form>
</body>

<?php 
    include_once 'master_layout/footer.php';
?>