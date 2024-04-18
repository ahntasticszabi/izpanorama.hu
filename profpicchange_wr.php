<?php
    session_start();

    $uprofilepic = $_FILES['uprofilepic'];
    if($uprofilepic['name']=="")   die("<script> alert('You didn't chose a picture.')</script>");

    include("dbconnection.php");
    include("func_sizing.php");

    $user = mysqli_fetch_array(mysqli_query($adb, "SELECT upw FROM user WHERE ustrid='$_POST[ustrid]'"));
    if(md5($_POST['upw'])!=$user['upw'])  
    die("<script> alert('Wrong password.')</script>");

    $picname = date("YmdHis_") . $_POST['ustrid'] . "_" . randomstring(10) . substr($uprofilepic['name'], strrpos($uprofilepic['name'], "."));
    move_uploaded_file($uprofilepic['tmp_name'] , "./PROFILEPICS_ORG/" . $picname);

    $t = strtolower(substr( $picname , -4 ));

    resize_crop_image(300, 300, "./PROFILEPICS_ORG/".$picname , "./PROFILEPICS/".$picname);

    $str10  = randomstring();

    if( $t==".jpg" || $t=="jpeg" || $t==".gif" || $t==".png" || $t=="webp")
	{
        $t = mysqli_query($adb, "
            UPDATE  user
            SET     uprofilepic  =  '$picname'
            WHERE   ustrid      =   '$_POST[ustrid]'
        ");

        print "
        <script>
            alert('Your profile picture has been changed.')
            parent.location.href='./?p=profpicchange'
        </script>
        ";
    }
    else print "<script> alert('The format of the picture is not allowed.')</script>";

    mysqli_close($adb);
?>