<?php
    session_start();

    include("dbconnection.php");

    if($_POST['user']=="")  die("<script> alert('You didn\'t give your Email or username!')</script>");
    if($_POST['pw']=="")    die("<script> alert('You didn\'t give your Password!')</script>");


    $upw = md5($_POST['pw']);
    
    $t = mysqli_query($adb, "
            SELECT  * FROM user
            WHERE   (uname='$_POST[user]' OR umail='$_POST[user]') 
            AND     upw = '$upw'
            AND     ustatus = 'A'
    ");

    if(mysqli_num_rows($t))
    {
        $sor = mysqli_fetch_array($t);

        $_SESSION['uid']    =   $sor['uid'];
        $_SESSION['uname']  =   $sor['uname'];
        $_SESSION['umail']  =   $sor['umail'];
        $_SESSION['upw']    =   $sor['upw'];
        $_SESSION['uperm']  =   $sor['uperm'];

        mysqli_query($adb, "
            INSERT INTO login   (lid ,  luid,           ldate,  lip                     ) 
            VALUES              ('',    '$sor[uid]',    NOW(),  '$_SERVER[REMOTE_ADDR]' );
        ");
        $_SESSION['lid']    =   mysqli_insert_id($adb);

        print "
            <script>
                parent.location.href='./?p=homepage'
            </script>
        ";
    }
    else 
    {
        die("<script> 
                    alert('The email or username you entered isn’t connected to an account.')
                    parent.location.href='./?p=login'
            </script>");
    }

    mysqli_close($adb);
?>