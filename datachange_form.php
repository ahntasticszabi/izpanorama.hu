<?php
    if(!$belepve) die("<h2>For viewing the site you need to be logged in.</h2>");

    $user = mysqli_fetch_array(mysqli_query($adb,"
                            SELECT * FROM user WHERE uid='$_SESSION[uid]'
                        "));
?>

<div class='profile_box'>
    <h1 style='text-align:center;'>Profile - Datachange</h1>
    <h3 style='text-align:center;'><?=$_SESSION['uname'];?></h2>

    <form style='text-align:center;' action='datachange_wr.php' method='post'>
        <input type='text'      name='umail'    placeholder='Email'             value='<?=$user['umail'];?>' required   >       <br>
        <input type='text'      name='uname'    placeholder='Username'          value='<?=$user['uname'];?>' required   >       <br>
        <input type='password'  name='upw'      placeholder='Password for validation' required                          >       <br>
        <input type='hidden'    name='ustrid'   value='<?=$user['ustrid'];?>'                                           >       <br>
        <input type='submit' value='Change'>
    </form>
</div>
     
