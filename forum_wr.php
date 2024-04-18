<?php
    session_start();

    include("dbconnection.php");

    if($_POST['ttitle'] == "")  
    die("<script> alert('You didn\'t write a title')</script>");

    if($_POST['tsubtitle'] == "")  
    die("<script> alert('You didn\'t write a subtitle!')</script>");

    if($_POST['ttext'] == "")  
    die("<script> alert('You didn\'t write a text!')</script>");

    $_POST = str_replace("<" , "< " , $_POST);
    $ttitle = $_POST['ttitle'];
    $tsubtitle = $_POST['tsubtitle'];
    $ttext = $_POST['ttext'];
    
    mysqli_query($adb, "
            INSERT INTO threads     (tid,   tuid,           ttitle,     tsubtitle,     ttext,       tstatus,     tdate,      tip                     )
            VALUES                  ('',    '$_POST[uid]',  '$ttitle',  '$tsubtitle',  '$ttext',    'Active',    NOW(),     '$_SERVER[REMOTE_ADDR]' );
    ");

    mysqli_close($adb);

    print "<script> 
                alert('Thank you for your thread!')
                parent.location.href='./?p=forum'
            </script>
    ";
?>