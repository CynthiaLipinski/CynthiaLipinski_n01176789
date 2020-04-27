<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Bitewave | Your digital song library</title>
    <meta name="description" content="songs library project php" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Custom CSS file by dhanpreet for project -->
    <link rel="stylesheet" href="style/ds_style.css" />

    <!-- CSS file for 3D carousel (Credit : https://materializecss.com/) -->
    <!-- Just copied the part that need from their provided css file and created own CSS file and added media querries to it-->
    <link rel="stylesheet" href="style/3dcarousel.css" />
  </head>
  <body class="body flex_column w100">
    <!--  H E A D D E R    S E C T I O N  -->
    <header>
      <!--  N A V I G A T I O N    B A R  -->
      <nav id="nav">
        <a href="#" class="logo">BiteWave</a>
        <!--  S E A R C H    B A R  -->
        <form method="get" action="rose_searchResults.php" class="search-bar">
          <input
            type="text"
            class="search-in"
            placeholder="Search Song or Singer..."
            aria-label="search songs or singer"
            name="audioSearch"
          />
          <button class="search-btn" aria-label="submit search">
            <i class="fas fa-search" name="searchAudio"></i>
          </button>
        </form>
        <!--  N A V I G A T I O N    M E N U  -->
        <ul>
          <li><a href="index.php" onclick="toggle()">Home</a></li>
          <li><a href="index.php #trending" onclick="toggle()">Trending</a></li>
          <li><a href="dhanpreet_list_audio.php" onclick="toggle()">Audio</a></li>
          <li>
            <a
              href="dhanpreet_upload_audio.php"
              onclick="toggle()"
              >Upload</a
            >
          </li>
          <li><a href="cynthia_ourteam_view.php" onclick="toggle()">Our Team</a></li>
          <li><a href="index.php #contact" onclick="toggle()">Contact Us</a></li>
          <li>
            <div class="loginout">
            
              <a href="Cynthia_userprofile_login.php"><i class="fas fa-user"></i> Sign In</a>
              <a href="Cynthia_userprofile_add.php">Register</a>
              <a href="Cynthia_userprofile_logout.php">Logout</a>
            </div>
          </li>
        </ul>
        <!-- D I V    TO    T O G G L E    N A V I G A T I O N -->
        <div class="toggle" onclick="toggle()"></div>
      </nav>
    </header>
    <main>