# N01176789 - Cynthia Lipinski

Features Descriptions and Files:

1) User profiles: Allows users to customize their usernames, description, and playlists that others will see. When registering it checks if the username already exists in the database so that there are no duplicates.     
  
files: Cynthia_userprofile_add.php, Cynthia_userprofile_list.php, cynthia_userprofile_login.php, Cynthia_userprofile_logout.php, Cynthia_userprofile_profile.php, Cynthia_userprofile_update.php, Cynthia_userprofile_view.php   
   
2) Profile playlists: Registered users can create their own playlists that display on their profiles. Users can create, delete and edit playlists. The playlists are only visisble when logged in to the specific account.  
  
files: Cynthia_playlist_add.php, Cynthia_playlist_delete.php, cynthia_playlist_playlist.php, Cynthia_playlist_view.php     
     
3) Our Team: Shows current company positions and members. Admin side can update, create and delete members while User can view the page. In the database there is an admin option which can be set to 1 for admin. It's default is 0 when a user is registered.
  
files: cynthia_ourteam_view.php, cynthia_ourteam_update.php, cynthia_ourteam_ourteam.php, cynthia_ourteam_delete.php, cynthia_ourteam_add.php     
database file: Cynthia_database.php
