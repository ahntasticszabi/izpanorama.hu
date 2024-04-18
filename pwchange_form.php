<?php
    if(!$belepve) die("<h2>For viewing the site you need to be logged in.</h2>");

    $user = mysqli_fetch_array(mysqli_query($adb,"
                            SELECT * FROM user WHERE uid='$_SESSION[uid]'
                        "));
?>

<div class='profile_box'>
    <h1 style='text-align:center;'>Profile - Password change</h1>
    <h3 style='text-align:center;'><?=$_SESSION['uname'];?></h3>
    <form style='text-align:center;' action='pwchange_wr.php' method='post'>
        <input type='password'  name='upw'      placeholder='Current password'>      <br>
        <input type='password'  name='pw1'      placeholder='New password'>             <br>
        <input type='password'  name='pw2'      placeholder='Recomfirm new password'>      <br>
        <input type='hidden'    name='ustrid'   value='<?=$user['ustrid'];?>'>          <br>
        <hr>
        <input type='submit' value='Change'>
    </form>
</div>
     
