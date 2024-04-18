<?php
    if(!$belepve) die("<h2>For viewing the site you need to be logged in.</h2>");

    $user = mysqli_fetch_array(mysqli_query($adb,   "
                                                    SELECT * FROM user WHERE uid='$_SESSION[uid]'
                                                    "));
?>
<?php
    $profilkep = mysqli_query($adb, "
                SELECT uprofilepic
                FROM user 
                WHERE   ustrid      =   '$user[ustrid]'
        ");
    $rows = mysqli_fetch_array($profilkep);
    $kep = $rows['uprofilepic'];
?>
<div class='profpicchange_box'>
    <h1 style='text-align:center;'>Profile - Profile picture changing</h1>
    <p style='text-align:center;'><?=$_SESSION['uname'];?></p>
    <form style='text-align:center;' action='profpicchange_wr.php' method='post' enctype='multipart/form-data'>
        <h3>Your current avatar</h3>
        <img src='PROFILEPICS/<?=$kep;?>' class='profilepic' alt='<?=$kep;?>' required><br><br>
        <p><label for='uprofilepic' style='cursor: pointer;'>Upload Image</label></p>
        <input type='file' accept='image/gif, image/jpeg, image/jpg, image/png' id='uprofilepic' name='uprofilepic' style='display: none;'>                                                                  <br>
        <input type='password'  name='upw'      placeholder='Password for validation' required><br>
        <input type='hidden'    name='ustrid'   value='<?=$user['ustrid'];?>'>                                          
        <hr style='margin:16px 0px;'>
        <input type='submit' value='Changing'>
    </form>

    
</div>