<?php
    if(!$belepve) die("<h2>For viewing the site you need to be logged in.</h2>");

    $admin = mysqli_fetch_array(mysqli_query($adb,   "
                        SELECT * FROM user WHERE uperm='$_SESSION[uperm]'
                        "));

    $postprofile = mysqli_query( $adb, "
                        SELECT * FROM posts
                        WHERE puid = '$_SESSION[uid]'
                        ORDER BY pdate DESC LIMIT 5
                        ");
    
?>

<style>
/* Create two unequal columns that floats next to each other */
/* Left column */
.leftcolumn {   
  float: left;
  width: 70%;
  padding-left: 150px;
  padding-right: 150px;
}

/* Right column */
.rightcolumn {
  float: left;
  width: 30%;
  padding-left: 20px;
  padding-right: 50px;
}

/* Add a card effect for articles */
.profile-card {
    background-color: white;
    padding         : 20px;
    margin-top      : 20px;
    border          : solid 1px rgb(0, 0, 0);
    border-radius   : 20px;
    background-image: linear-gradient(to right, #7C68ED, #CCFFFF);
    box-shadow      : .125rem .25rem rgba(0,0,0,.075)!important;
}

.post-card {
  padding           : 20px;
  margin-top        : 20px;
  background-color  : rgb(255, 255, 255);
  box-shadow        : .125rem .25rem rgba(0,0,0,.075)!important;
  line-height       : 1.7em;
}

/* Clear floats after the columns */
.row::after {
  content           : "";
  display           : table;
  clear             : both;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 800px) {
  .leftcolumn, .rightcolumn {   
    width           : 100%;
    padding         : 0;
  }
}

.post-card a {
    font-size       : 45px;
    text-decoration : none;
    font-family     :'Franklin Gothic Medium';
    font-weight     : bold;
    color           : black;
    text-shadow     : 2px 2px 2px white;
}

.post-card a:hover {
    color           :#7C68ED;
}

.post-card img {
    width           : 60%;
    display         : block;
    margin-left     : auto;
    margin-right    : auto;
}

.profile-card h1 {
    font-family     : arial;
    font-size       : 35px;
    color           : honeydew;
    text-shadow     : 2px 2px 2px black;
    font-weight     : bold;
}

.profile-card h3 {
    font-family     : arial;
    color           : honeydew;
    text-shadow     : 2px 2px 2px black;
    font-weight     : bold;
}

.profile-card a {
    text-decoration : none;
    color           : whitesmoke;
    font-family     : arial;
    font-weight     : bold;
    font-size       : 20px;
    text-shadow     : 2px 1px 1px black;
    line-height     : 30px;
}

.profile-card a:hover {
    color           : rgb(212, 244, 255);
}

</style>

<div class="row">  
  <div class="leftcolumn">
    <div class="post-card" style="text-align:center;">
      <h1 style="font-weight:bold;">YOUR LAST 5 POSTS</h1>
    </div>
    <?php
    while( $postsprofile = mysqli_fetch_assoc( $postprofile ) )
    {
      print "<div class='post-card' style='text-align:center;'>
        <a href='./?p=post&k=$postsprofile[ppicture]&c=$postsprofile[pid]&f=$postsprofile[puid]'>$postsprofile[ptitle]</a><br><br>
        <h5>$postsprofile[pdate]</h5>
        <img src='./POSTPICTURE/$postsprofile[ppicture]'>
      </div>";
    }
    ?>
  </div>
  <div class="rightcolumn">
    <div class="profile-card" style='text-align:center;'>
      <h1>About Me</h1>
      <img src='PROFILEPICS/<?=$kep;?>' style='height:200px;' class='profilepic' alt='<?=$kep;?>' required><br><br>
    </div>
    <div class="profile-card" style='text-align:center;'>
      <h1>Profile options</h1><br>
      <a href='./?p=datachange'>Email or username changing</a><br>
      <a href='./?p=pwchange'>Password changing</a><br>
      <a href='./?p=profpicchange'>Profile picture changing</a><br>
        <?php 
            if($_SESSION['uperm']=='Admin') print "<a href='./?p=adminpanel'>Adminpanel</a>" ;
        ?> 
        <hr>
        <input type='button' class='profile-button' value='Log out' onclick='location.href="logout.php"'>
    </ul>
    </div>
  </div>
</div>
