<?php

  if(!$belepve) die("<h2>For viewing the site you need to be logged in.</h2>");

  $fuser = mysqli_fetch_array (mysqli_query( $adb , "
                        SELECT * 
                        FROM   user
                        WHERE uid = '$_GET[f]'
                        ")) ;

  $user = mysqli_fetch_array(mysqli_query($adb,"
                        SELECT * FROM user WHERE uid='$_SESSION[uid]'
                        "));
  
  $post = mysqli_fetch_array(mysqli_query( $adb, "
                        SELECT * FROM posts
                        WHERE pid = '$_GET[c]'
                        "));

?>

<!-- Cím -->
<div class='post-container'>
  <h1 style='text-align:center;'><?=$post['ptitle'];?></h1> 
</div>

<!-- Kép -->
<div class='post-container'>
  <div class='post-picture'>
    <img src='./POSTPICTURE/<?=$_GET['k'];?>'>
  </div> 
</div>

<!-- Felhasználó -->
<div class='post-container'>
  <div class="content-snippet">
    <section>
      <h2>
        <i class="fa fa-paper-plane"></i>
        <span>Submitted by</span>
      </h2>
      <aside>
        <a href="">
          <img src="PROFILEPICS/<?=$fuser['uprofilepic'];?>" alt="" style="max-width:40px;">
        </a>
        <p><?=$fuser['uname'];?></p>
      </aside>
    </section>
  </div>
</div>

<!-- Kommentek -->
<div class='post-container'>
  <form style='margin:24px 48px; line-height:28px; text-align:center' action='comments_wr.php' method='post' target='kisablak'>
    <textarea name='ccomment' cols=60 rows=2></textarea></br>
    <input type='submit' value='Submit'>
    <input type='hidden'    name='ustrid'   value='<?=$user['ustrid'];?>'>
    <input type='hidden'    name='uid'   value='<?=$user['uid'];?>'>
    <input type='hidden'    name='uname'   value='<?=$user['uname'];?>'>
    <input type='hidden'    name='cpid'   value='<?=$post['pid'];?>'>   
</form>

<?php
  $comments = mysqli_query( $adb , "
      SELECT * 
      FROM   comments, user
      WHERE cpid = '$post[pid]' AND cuid = uid AND cstatus = 'Active'
      ORDER BY cdate
  " ) ;

  while( $crow = mysqli_fetch_array( $comments ) )
  {
    print "
    <article class='comments'>
      <div class='comments-avatar'>
        <figure>
          <img src='./PROFILEPICS/$crow[uprofilepic]' style='max-width: 75px;'>
        </figure>
      </div>
      <p class='comments-name'>
        $crow[uname]
      </p>
      <time datetime='$crow[cdate]' class='comments-date'>$crow[cdate]</time>
      <p class='comments-text'>
        $crow[ctext]
      </p>
      <br>
    </article>
    ";
  }
?>

</div>
