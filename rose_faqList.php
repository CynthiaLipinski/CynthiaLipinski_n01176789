<?php 
    include_once 'master_layout/header.php';

    require_once 'bitewave_connection__db.php';
    require_once 'rose_faq.php';

    $dbcon = Database::getDb();

    $faq = new FAQ();
    $list = $faq->listFAQ($dbcon);
?>

<body>
    <h1>FAQ</h1>
    <?php foreach ($list as $l) { ?>
    <ul>
        <li><?php echo $l['faqID']; ?></li>
        <li><?php echo $l['question']; ?>
            <ul>
                <li><?php echo $l['answer']; ?></li>
            </ul>
        </li>
        <form action="faqUpdate.php" method="post">
            <input type="hidden" name="faqID" value="<?= $l['faqID']; ?>"/>
            <input type="submit" name="updateFAQ" value="Update"/>
        </form>
        <form action="faqDelete.php" method="post">
            <input type="hidden" name="faqID" value="<?= $l['faqID']; ?>"/>
            <input type="submit" name="deleteFAQ" value="Delete"/>
        </form>
    </ul>
    <?php } ?>
    <a href="faqAdd.php">Add New</a>
</body>

<?php 
    include_once 'master_layout/footer.php';
?>