<?php
    if(!$belepve) die("<h2>For viewing the site you need to be logged in.</h2>");

    $user = mysqli_fetch_array(mysqli_query($adb,   "
                                                    SELECT * FROM user WHERE uid='$_SESSION[uid]'
                                                    "));
?>
<div class='post'>
    <h1 style='text-align:center;'>Post a picture!</h1><br>
    <form style='text-align:center;' action='post_wr.php' method='post' enctype='multipart/form-data'>
        <p><label for="postpic" style="cursor: pointer;">Upload Image</label></p>
        <input type='file'  accept='image/gif, image/jpg, image/jpeg, image/png, image/webp' name='postpic' id="postpic" onchange='loadFile(event)' style='display: none;'"><br>
        <img id="output" width="200" length="400" /><br>
        <input style='text-align:center' type="text" name='posttitle' placeholder='Title'>
        <input type='hidden'    name='ustrid'   value='<?=$user['ustrid'];?>'>
        <input type='hidden'    name='uid'   value='<?=$user['uid'];?>'>                                            
        <hr style='margin:16px 0px;'>
        <input type='submit' value='Upload'>
    </form>
</div>

<script>
var loadFile = function(event) {
	var image = document.getElementById('output');
	image.src = URL.createObjectURL(event.target.files[0]);
};
</script>