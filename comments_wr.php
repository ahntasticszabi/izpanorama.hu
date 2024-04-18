<?php
    session_start();

    include("dbconnection.php");

    if($_POST['ccomment'] == "")  
    die("<script> alert('You didn't write a comment')</script>");

    $_POST = str_replace("<" , "< " , $_POST);
    $uzenet = $_POST['ccomment'];

    mysqli_query($adb, "
            INSERT INTO comments    (cid,    cpid,              cuid,           ctext,         cdate,  cstatus,    chistory,    cip                     )
            VALUES                  ('',     '$_POST[cpid]',    '$_POST[uid]',  '$uzenet',     NOW(),  'Active',   '',          '$_SERVER[REMOTE_ADDR]' );
    ");

    mysqli_close($adb);

    print "<script> 
                alert('Thank you for your comments!')
                parent.location.href=parent.location.href
            </script>
    ";
?>