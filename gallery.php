<?php

  if(!$belepve) die("<h2>For viewing the site you need to be logged in.</h2>");

  /* Képek lekérdezése */
  $pictures = mysqli_query( $adb , "
      SELECT * 
      FROM   posts
      WHERE pstatus = 'Active'
      ORDER BY pdate
  " ) ;

  echo "<div class='gallery-container'>";

  while( $prow = mysqli_fetch_assoc( $pictures ) )
  {
    $user = mysqli_fetch_array (mysqli_query( $adb , "
      SELECT * 
      FROM   user
      WHERE uid = '$prow[puid]'
    " )) ;
    print "
    <div class='gallery'>
      <figure>
        <a href='./?p=post&k=$prow[ppicture]&c=$prow[pid]&f=$prow[puid]'>
          <img src='./THUMBNAIL/$prow[ppicture]'>
        </a>
        <figcaption>
          <p class='gallery-title'>
            $prow[ptitle]
          </p>
          <p class='gallery-user'>
            by
            $user[uname]
          </p>
        </figcaption>
      </figure>
    </div>
    ";
  }
  print "<div style='clear:both;'>
        </div>
        </div>";
?>