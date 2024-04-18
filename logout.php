<?php
    session_start();

    include("dbconnection.php");
    
    //session_destroy();

    unset($_SESSION['uid']);
    unset($_SESSION['uname']);
    unset($_SESSION['umail']);
    unset($_SESSION['upw']);
    unset($_SESSION['uperm']);
    unset($_SESSION['lid']);

    print "
        <script>
            parent.location.href='./'
        </script>
    ";

    mysqli_close($adb);

?>