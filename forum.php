<?php 
/* Képek lekérdezése */
  $threads = mysqli_query( $adb , "
      SELECT * 
      FROM   threads
      WHERE tstatus = 'Active'
      ORDER BY tdate
  ");
?>

<div class="header-container" style="text-align:center;">
    <h1>IZPANORAMA's Forum</h1>
    <button class="button"><a href="./?p=forumcreate">Submit new</a></button>
</div>

<body class="forum">
<div class="forum-container">
        <div class="subforum">
            <div class="subforum-title">
                <h1>General Information</h1>
            </div>
            <div class="subforum-rules-row">
                <div class="subforum-description subforum-column" style="text-align:center; font-weight:bold; font-size:18px;">
                    <h4><a style="font-size: 34px;" href="./?p=topic">The Rules</a></h4>
                    <p>IZPANORAMA's Forum Rules</p>
                </div>
            </div>
        </div>
        <!--More-->
        <div class="subforum">
            <div class="subforum-title">
                <h1>Topics</h1>
            </div>
            <?php
            while ( $trow = mysqli_fetch_assoc ($threads) ) {
                $tuser = mysqli_fetch_array (mysqli_query( $adb , "
                        SELECT * 
                        FROM   user
                        WHERE uid = '$trow[tuid]'
                "));
                print "
                <div class='subforum-row'>
                    <div class='subforum-description subforum-column'>
                        <h4><a href='./?p=topic&i=$trow[tid]&u=$trow[tuid]'>
                            $trow[ttitle]
                        </a></h4>
                        <p>$trow[tsubtitle]</p>
                    </div>
                    <div class='subforum-stats subforum-column center'>
                        <span>2 replies</span>
                    </div>
                    <div class='subforum-info subforum-column'>
                        Made by <a class='user'>$tuser[uname]</a> 
                        <br>on <small>$trow[tdate]</small>
                    </div>
                </div>
                <hr class='subforum-devider'>
                ";
            }
            ?>
        </div>
    </div>
</body>
<script src="main.js"></script>
