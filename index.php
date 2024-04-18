<?php
    session_start();
    date_default_timezone_set("Europe/Budapest");

    if(isset($_GET['p'])) $p = $_GET['p']; 
    else $p = "";
    if(isset($_SESSION['uid'])) $belepve=1  ;
    else                        $belepve=0  ;

    include("dbconnection.php");
    
    if($belepve) $lid=$_SESSION['lid']; else $lid=-1;
    mysqli_query($adb, "INSERT INTO logging (oid,   ourl,                       odate,  oip,                        olid)
                        VALUES              ('',    '$_SERVER[REQUEST_URI]',    NOW(),  '$_SERVER[REMOTE_ADDR]',    '$lid')
                        ");

    if($belepve == 1)   $user = mysqli_fetch_array(mysqli_query($adb,   "
                        SELECT * FROM user WHERE uid='$_SESSION[uid]'
                        "));

    if($belepve == 1)   $admin = mysqli_fetch_array(mysqli_query($adb,   "
                        SELECT * FROM user WHERE uperm='$_SESSION[uperm]'
                        "));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/28ee86e924.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/script.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IZPANORAMA</title>
</head>
<body style="margin-top: calc(4.65em + 15px);">
    <!-- Navigációs sor -->
    <?php
    
    if(!$belepve) print "";
    
    else {
    $profilkep = mysqli_query($adb, "
    SELECT uprofilepic
    FROM user 
    WHERE   ustrid      =   '$user[ustrid]'
    ");
    
    $rows = mysqli_fetch_array($profilkep);
    $kep = $rows['uprofilepic'];
    ?>
    <header class="fixed-top">
      <div class="container">
      <nav class="navbar navbar-expand">
      <div class="container-fluid">
        <a class="navbar-brand" href="./?p=homepage">
          <i class="d-none d-md-block">IZPANORAMA</i>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="./?p=postcreate">Post a picture</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./?p=forum">Forum</a>
            </ll>
            <li class="nav-item">
              <a class="nav-link" href="./?p=homepage">About Us</a>
            </li>
          </ul>
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 profile-menu">
              <li class="nav-item dropdown-center">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <div class="profile-pic">
                    <img src="PROFILEPICS/<?=$kep;?>" alt="Profile Picture">
                  </div>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <h6 class="dropdown-header">
                    <?=$_SESSION['uname'];?>
                  <aside><?=$_SESSION['uperm'];?></aside>
                  </h6>
                  <li><a class="dropdown-item" href="./?p=profile"><i class="fa-solid fa-user"></i> Account</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="./?p=datachange"><i class="fas fa-cog fa-fw"></i>Email or<br>Username</a></li>
                  <li><a class="dropdown-item" href="./?p=pwchange"><i class="fa-solid fa-key"></i>Password</a></li>
                  <li><a class="dropdown-item" href="./?p=profpicchange"><i class="fa-solid fa-image"></i>Profile picture</a></li>
                  <?php
                    if($_SESSION['uperm']=='Admin') print "
                      <li>
                        <hr class='dropdown-divider'>
                      </li>
                      <li><a class='dropdown-item' href='./?p=adminpanel'><i class='fa-solid fa-bolt'></i>Adminpanel</a></li>
                    ";
                  ?>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt fa-fw"></i> Log Out</a></li>
                </ul>
              </li>
          </ul>
      </div>
      </nav>
      </div>
    </header>
    <?php
    }


    //Source megadás
    if(!isset($_SESSION['uid']))
    {
        if($p=="reg")
            include ("reg_form.php");
        else 
            include("login_form.php");
    }
    else 
    {
        if($p=="homepage"       )   include("gallery.php")                                          ; else
        if($p=="postcreate"     )   include("post_form.php")                                        ; else
        if($p=="post"           )   include("post.php")                                             ; else
        if($p=="comment"        )   include("comment_form.php")                                     ; else
        if($p=="forum"          )   include("forum.php")                                            ; else
        if($p=="forumcreate"    )   include("forum_form.php")                                       ; else
        if($p=="topic"          )   include("topic.php")                                            ; else
        if($p=="topiccreate"    )   include("topic_form.php")                                       ; else
        if($p=="profile"        )   include("profile.php")                                          ; else
        if($p=="adminpanel"     )   include("adminpanel.php")                                       ; else
        if($p=="datachange"     )   include("datachange_form.php")                                  ; else
        if($p=="pwchange"       )   include("pwchange_form.php")                                    ; else
        if($p=="profpicchange"  )   include("profpicchange_form.php")                               ; else
        
        include("gallery.php");
    }
    
    ?>
    <iframe name='kisablak' style="display:none;" x_width=640 y_height=480 z_frameborder=0></iframe>
</body>
</html>