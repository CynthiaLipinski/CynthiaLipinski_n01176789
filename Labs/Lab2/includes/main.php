<script>
    function validation() {
        var name = document.signUp.name.value;
        var email = document.signUp.email.value;
        var postalcode = document.signUp.postalcode.value;
        var regex = /^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/;
        //canadian postal code regex from https://stackoverflow.com/questions/15774555/efficient-regex-for-canadian-postal-code-function
        if (name == null || name == "") {
            alert("Please enter valid name.");
            return false;
        } else if (email == null || email == "") {
            alert("Please enter valid email.");
            return false;
        } else if (postalcode == null || postalcode == "" || !regex.test(postalcode)) {
            alert("Please enter valid postal code.");
            return false;
        }

    }

</script>
<div class="main">
    <h1> Sign up for our monthly newsletter!</h1>
    <form name="signUp" onsubmit="return validation()" action="thank.php" method="post">
        <div>Name: <input type="text" name="name"></div>
        <div>Email: <input type="email" name="email"></div>
        <div>Postal: <input type="text" name="postalcode"></div>
        <input type="submit" value="Sign Up">
    </form>
</div>
