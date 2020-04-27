<?php
require_once 'page.php';
require_once 'post.php';
$title="This is a Post!";
$body='<div><h1 style="padding: 30px;
  font-size: 40px;
  text-align: center;">Post Title</h1></div><div><p style="padding: 300px;
   margin-top: -300px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent malesuada tristique augue et vestibulum. Vestibulum sed dignissim velit, quis rutrum sapien. Sed velit ex, pharetra non semper sit amet, vestibulum ut massa. Duis quam velit, fringilla nec neque a, sodales lobortis ipsum. Praesent nec lacinia orci. Nulla sed libero nec massa facilisis iaculis nec non libero. Mauris mauris lorem, consectetur sed vestibulum vel, ullamcorper quis tortor. Fusce imperdiet porttitor ante quis rutrum. Donec porttitor neque sapien, eu auctor erat tristique commodo. Integer scelerisque, sem congue tincidunt porta, quam erat rhoncus diam, sit amet tincidunt dui erat non lacus. Vivamus auctor tempus sapien, sit amet dictum augue porta vel.<br><br>Vivamus vel erat nisl. Vestibulum sit amet condimentum neque. Nunc a vulputate lacus. Vestibulum eleifend ante in libero pretium, at sodales augue lobortis. Sed tincidunt eu risus at condimentum. Donec bibendum viverra nunc eu auctor. Etiam volutpat magna nulla, tempor sollicitudin dolor laoreet id. Fusce convallis metus iaculis neque aliquet, non placerat felis feugiat. Phasellus nec mattis lacus. Morbi egestas, augue eu dignissim consequat, sem massa placerat sem, eget pellentesque massa odio ut enim. Vivamus euismod eu odio vel cursus. Vestibulum hendrerit ipsum justo.</p></div>';
$dateCount = new Post($title,'address',$body, '2013-12-12');
echo $dateCount->createPage();

echo '<div style="padding: 300px; margin-top: -500px;">'.$dateCount->postAge()->format("This post was created %r%y years %r%m month %r%d days ago").'</div>';
echo $dateCount->endPage();

?>
