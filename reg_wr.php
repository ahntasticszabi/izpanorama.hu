<?php
    session_start();

    include("dbconnection.php");

    if($_POST['uname']=="")  die("<script> alert('You didn\'t give a username.')</script>");
    if($_POST['umail']=="")  die("<script> alert('You didn\'t give a email.')</script>");

    if(strlen($_POST['pw1'])<6)  die("<script> alert('Your password is to short. (Min. length is 6 character)')</script>");
    if($_POST['pw1']!=$_POST['pw2'])  die("<script> alert('The passwords are not the same.')</script>");

    if(mysqli_num_rows(mysqli_query($adb, "SELECT * FROM user WHERE uname = '$_POST[uname]'")))
    die("<script> alert('This username is already taken.')</script>");

    if(mysqli_num_rows(mysqli_query($adb, "SELECT * FROM user WHERE umail = '$_POST[umail]'")))
    die("<script> alert('There is already an account with this email address.')</script>");

    $upw    = md5($_POST['pw1']);
    $str10  = randomstring();
    mysqli_query($adb, "
            INSERT INTO user    (uid ,  uname,              umail,              upw,        uprofilepic,    ubio,   udate,  ustatus,    uperm,  uip,                      ustrid  ) 
            VALUES              (NULL,  '$_POST[uname]',    '$_POST[umail]',    '$upw',     'template.jpg', '',     NOW(),  'A',        'User', '$_SERVER[REMOTE_ADDR]',  '$str10');
    ");

    mysqli_close($adb);

    /* Üzenet kiküldése
    $mailtext = "Dear user! Thank you for your registration!";

    mail($_POST['umail'], "Registration", $mailtext, "From:ahntasticszabi@izpanorama.hu");*/

    print "<script> 
                alert('Thank you for your registration!')
                parent.location.href='./?p=login'
            </script>
    ";
?>