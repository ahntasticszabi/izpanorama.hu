<?php
    session_start();

    if($_POST['upw'] =="")              die("<script> alert('You didn't give your password.')</script>");

    include("dbconnection.php");

    if(strlen($_POST['pw1'])<4)         die("<script> alert('Your password is to short.')</script>");
    if($_POST['pw1']!=$_POST['pw2'])    die("<script> alert('The passwords are not the same.')</script>");
   
    $user = mysqli_fetch_array(mysqli_query($adb, "SELECT upw FROM user WHERE ustrid='$_POST[ustrid]'"));
    if(md5($_POST['upw'])!=$user['upw'])  
    die("<script> alert('Wrong password.')</script>");
    
    $upw = md5($_POST['pw1']);

    $t = mysqli_query($adb, "
            UPDATE  user
            SET     upw    =    md5('$_POST[pw1]')
            WHERE   ustrid  =   '$_POST[ustrid]'
    ");

    print "
        <script>
            alert('The change has been made.')
            parent.location.href='./?p=profile'
        </script>
    ";

    mysqli_close($adb);

?>