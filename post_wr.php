<?php
    session_start();

    $ppicture = $_FILES['postpic'];
    if($ppicture['name']=="")   die("<script> alert('You didn't chose a picture.')</script>");

    include("dbconnection.php");
    include("func_sizing.php");

    $picname = date("YmdHis_") . $_POST['uid'] . "_" . randomstring(10) . substr($ppicture['name'], strrpos($ppicture['name'], "."));
    move_uploaded_file($ppicture['tmp_name'] , "./POSTPICTURE/" . $picname);

    $t = strtolower(substr( $picname , -4 ));

    resize_crop_image(230, 230, "./POSTPICTURE/".$picname , "./THUMBNAIL/".$picname);

    if( $t==".jpg" || $t=="jpeg" || $t==".gif" || $t==".png" || $t=="webp")
	  {
        $t = mysqli_query($adb, "
            INSERT INTO posts   (pid,   puid,                 ppicture,     ptitle,                 pstatus,    pdate, pip                      )
            VALUES              ('',    '$_SESSION[uid]',     '$picname',   '$_POST[posttitle]',    'Active',   NOW(), '$_SERVER[REMOTE_ADDR]'  );
        ");
        
        print "
        <script>
            alert('Your post has been uploaded.')
            parent.location.href='./?p=homepage'
        </script>
        ";
    }
    else print "<script> 
                    alert('The format of the picture is not allowed.')
                    parent.location.href='./?p=postcreate'
                </script>";

    mysqli_close($adb);
?>