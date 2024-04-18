<?php
    session_start();

    if($_POST['umail']=="")     die("<script> alert('You didn't give your Email.')</script>");
    if($_POST['uname'] =="")    die("<script> alert('You didn't give your username.')</script>");

    include("dbconnection.php");

    if(mysqli_num_rows(mysqli_query($adb, "SELECT * FROM user WHERE umail='$_POST[umail]' AND ustrid!='$_POST[ustrid]'")))
    die("<script> alert('There is already an account with this Email address.')</script>");
    
    if(mysqli_num_rows(mysqli_query($adb, "SELECT * FROM user WHERE uname='$_POST[uname]' AND ustrid!='$_POST[ustrid]'")))
    die("<script> alert('This username is already taken.')</script>");

    $user = mysqli_fetch_array(mysqli_query($adb, "SELECT upw FROM user WHERE ustrid='$_POST[ustrid]'"));
    if(md5($_POST['upw'])!=$user['upw'])  
    die("<script> alert('Wrong password.')</script>");
    
    $t = mysqli_query($adb, "
            UPDATE  user
            SET     uname    =  '$_POST[uname]',
                    umail   =   '$_POST[umail]'
            WHERE   ustrid  =   '$_POST[ustrid]'
    ");

    print "
        <script>
            alert('The changes has been made.')
            parent.location.href='./?p=profile'
        </script>
    ";

    mysqli_close($adb);

?>