<html>

<head>
    <link href="styles/style.css" rel="stylesheet" />
    <title>
        Lab 4
    </title>
</head>

<body>
    <header>
        <?php
        $header_menu = [
        "Home"=>"index.php",
        "News"=>"news.php",
        "Contact"=>"contact.php",
        "About"=>"about.php"
        ];
        echo displayNavigation($header_menu);
?>
    </header>
    <div class="main">
        <div id="logo"><span>LOGO</span></div>
        <p>Contact Information <br> 123-456-7890 <br> 42 Wallaby Way, Sydney</p>
    </div>
