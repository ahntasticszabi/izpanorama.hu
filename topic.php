<?php

  if(!$belepve) die("<h2>For viewing the site you need to be logged in.</h2>");

  $tuser = mysqli_fetch_array (mysqli_query( $adb , "
                        SELECT * 
                        FROM   user
                        WHERE uid = '$_GET[u]'
                        ")) ;

  $user = mysqli_fetch_array(mysqli_query($adb,"
                        SELECT * FROM user WHERE uid='$_SESSION[uid]'
                        "));
  
  $thread = mysqli_fetch_array(mysqli_query( $adb, "
                        SELECT * FROM threads
                        WHERE tid = '$_GET[i]'
                        "));

?>

<div class="main-container">
    <div class="topic-container">
        <div class="head">
            <div class="head-authors"><?=$tuser['uname'];?></div>
            <div class="head-content"><?=$thread['ttitle'];?></div>
        </div>

        <div class="body">
            <div class="authors">
                <div class="username"><a href=""><?=$tuser['uname'];?></a></div>
                <div><?=$tuser['uperm'];?></div>
                <img src="./PROFILEPICS/<?=$tuser['uprofilepic'];?>" alt="<?=$tuser['uname'];?>">
            </div>
            <div class="content">
                <p><?=$thread['ttext'];?></p>
                <hr>
                <small><?=$tuser['ubio'];?></small>
                <br>
                <div class="comment">
                    <button onclick="showComment()">Comment</button>
                </div>
            </div>
        </div>
    </div>
    <div hidden class="comment-container" id="comment-container">
        <div class="comment-body">
            <form style="text-align:center;" action='topic_wr.php' method='post' target='kisablak'>
                <textarea name='atext' style="width: 60%;" cols=60 rows=3 placeholder="Your comment"></textarea></br>
                <input type='hidden'    name='ustrid'   value='<?=$user['ustrid'];?>'>
                <input type='hidden'    name='uid'   value='<?=$user['uid'];?>'>
                <input type='hidden'    name='uname'   value='<?=$user['uname'];?>'>
                <input type='hidden'    name='atid'   value='<?=$thread['tid'];?>'>                                             
                <input type='submit' value='Send'>
            </form>
        </div>
    </div>
        <!-- Válaszok -->
    <?php
        $answers = mysqli_query( $adb , "
            SELECT * 
            FROM   answers, user
            WHERE atid = '$thread[tid]' AND auid = uid AND astatus = 'Active'
            ORDER BY adate
        ");
        while( $arow = mysqli_fetch_array( $answers ) )
        {
            print "
                <div class='topic-container'>
                    <div class='body'>
                        <div class='authors'>
                            <div class='username'><a href=''>$arow[uname]</a></div>
                            <div>$arow[uperm]</div>
                            <img src='./PROFILEPICS/$arow[uprofilepic]' alt=''>
                        </div>
                        <div class='content'>
                            <p>$arow[atext]</p>
                            <hr>
                            <small>$arow[ubio]</small>
                        </div>
                    </div>
                </div>
            ";
        }
    ?>
</div>

<script>
    function showComment(){
        var comment = document.getElementById("comment-container");
        comment.removeAttribute("hidden");
    }
</script>