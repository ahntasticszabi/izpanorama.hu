<?php
    if(!$belepve) die("<h2>For viewing the site you need to be logged in.</h2>");

    $user = mysqli_fetch_array(mysqli_query($adb,   "
                                                    SELECT * FROM user WHERE uid='$_SESSION[uid]'
                                                    "));
?>

<div class='post'>
    <h1 style='text-align:center;'>Post a thread!</h1><br>
    <form style='text-align:center;' action='forum_wr.php' method='post' target='kisablak'>
        <input style='text-align:center' type="text" name='ttitle'      placeholder='Title (Max. 70)'>
        <input style='text-align:center' type="text" name='tsubtitle'   placeholder='Subtitle (Max. 100)'>
        <textarea name='ttext' style="width: 80%;" cols=60 rows=3 placeholder="Text"></textarea></br>
        <input type='hidden'    name='ustrid'   value='<?=$user['ustrid'];?>'>
        <input type='hidden'    name='uid'   value='<?=$user['uid'];?>'>                                            
        <hr style='margin:16px 0px;'>
        <input type='submit' value='Submit'>
    </form>
</div>