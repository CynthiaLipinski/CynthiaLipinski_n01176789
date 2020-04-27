<div class="main">
    <h1> Sign up for our monthly newsletter!</h1>
    <p><?=$errors; ?></p>
    <form action="" method="post">
        <div>Name: <input type="text" name="name" value="<?= $name; ?>" class="textbox" /> </div>
        <div>Email: <input type="email" name="email" value="<?= $email; ?>" class="textbox" /> </div>
        <div>Postal: <input type="text" name="postalcode" value="<?= $postalcode; ?>" class="textbox" /> </div>
        <div>Gender:
            <input type="radio" id="female" name="gender" value="female" <?= ($gender == 'Female') ? "checked" : ""; ?>>Female
            <input type="radio" id="male" name="gender" value="male" <?= ($gender == 'Male') ? "checked" : ""; ?>>Male
            <input type="radio" id="other" name="gender" value="other" <?= ($gender == 'Other') ? "checked" : ""; ?>>Other
        </div>
        <div>
            <p>How did you hear about us?</p>
            <select name="heardfrom">
                <?php
                $heard = ['email' => 'Email', 'text' => 'Text', 'phone' => 'Phone'];
                echo populateDropdown($heard, $heardfrom);
                ?>
            </select>
        </div>
        <input type="submit" name="signup" value="Sign Up">

    </form>
</div>
