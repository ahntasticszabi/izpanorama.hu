<?php
    session_start();

    include("dbconnection.php");

    if($_POST['atext'] == "")  
    die("<script> alert('You didn\'t write a comment')</script>");

    $_POST = str_replace("<" , "< " , $_POST);
    $atext = $_POST['atext'];

    mysqli_query($adb, "
            INSERT INTO answers     (aid,    atid,              auid,           atext,      astatus,    adate,  aip                     )
            VALUES                  ('',     '$_POST[atid]',    '$_POST[uid]',  '$atext',   'Active',   NOW(),  '$_SERVER[REMOTE_ADDR]' );
    ");

    mysqli_close($adb);

    print "<script> 
                alert('Thank you for your comments!')
                parent.location.href=parent.location.href
            </script>
    ";
?>