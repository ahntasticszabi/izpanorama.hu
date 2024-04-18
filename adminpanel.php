<?php 

if($_SESSION['uperm']!='Admin') die("<h2>For viewing the site you need to have an admin permission!</h2>");

//Felhasználok adatai
$userdata = mysqli_query($adb, "
      SELECT * 
      FROM  user
      ORDER BY uid
      ");
//Bejelentkezések adatai
$loginsdata = mysqli_query($adb, "
      SELECT * 
      FROM  login
      ORDER BY ldate DESC
      "); 
//Naplózások adatai
$loggingdata = mysqli_query($adb, "
      SELECT * 
      FROM  logging
      ORDER BY odate DESC LIMIT 50
      ");
//Posztok adatai
$postdata = mysqli_query($adb, "
      SELECT * 
      FROM  posts
      ORDER BY pdate DESC
      ");
//Kommentek adatai      
$commentsdata = mysqli_query($adb, "
      SELECT * 
      FROM  comments
      ORDER BY cdate DESC
      "); 
//Topicok adatai      
$threadsdata = mysqli_query($adb, "
      SELECT * 
      FROM  threads
      ORDER BY tdate DESC
      ");
//Válaszok adatai      
$answersdata = mysqli_query($adb, "
      SELECT * 
      FROM  answers
      ORDER BY adate DESC
      ");

//Posztok archiválása
if(isset($_REQUEST['parchive'])){
      if(mysqli_query($adb, "
      UPDATE posts SET pstatus = 'Archived' WHERE pid = '$_REQUEST[pid]'
      ")){
            print "<script>
                  alert('The post has been archived.')
                  parent.location.href=parent.location.href
            </script>";
      }
      else print "<script> alert('This post couldn't be archived.')</script>"; 
}
//Kommentek archiválása
if(isset($_REQUEST['carchive'])){
      if(mysqli_query($adb, "
      UPDATE comments SET cstatus = 'Archived' WHERE cid = '$_REQUEST[cid]'
      ")){
            print "<script>
                  alert('The comment has been archived.')
                  parent.location.href=parent.location.href
            </script>";
      }
      else print "<script> alert('This comment couldn't be archived.')</script>"; 
}
//Topicok archiválása
if(isset($_REQUEST['tarchive'])){
      if(mysqli_query($adb, "
      UPDATE threads SET tstatus = 'Archived' WHERE tid = '$_REQUEST[tid]'
      ")){
            print "<script>
                  alert('The thread has been archived.')
                  parent.location.href=parent.location.href
            </script>";
      }
      else print "<script> alert('This thread couldn't be archived.')</script>"; 
}
//Válaszok archiválása
if(isset($_REQUEST['aarchive'])){
      if(mysqli_query($adb, "
      UPDATE answers SET astatus = 'Archived' WHERE aid = '$_REQUEST[aid]'
      ")){
            print "<script>
                  alert('The answer has been archived.')
                  parent.location.href=parent.location.href
            </script>";
      }
      else print "<script> alert('This answer couldn't be archived.')</script>"; 
}

//Posztok aktiválása
if(isset($_REQUEST['pactive'])){
      if(mysqli_query($adb, "
      UPDATE posts SET pstatus = 'Active' WHERE pid = '$_REQUEST[pid]'
      ")){
            print "<script>
                  alert('The post has been activated.')
                  parent.location.href=parent.location.href
            </script>";
      }
      else print "<script> alert('This post couldn't be activated.')</script>"; 
}
//Kommentek aktiválása
if(isset($_REQUEST['cactive'])){
      if(mysqli_query($adb, "
      UPDATE comments SET cstatus = 'Active' WHERE cid = '$_REQUEST[cid]'
      ")){
            print "<script>
                  alert('The comment has been activated.')
                  parent.location.href=parent.location.href
            </script>";
      }
      else print "<script> alert('This comment couldn't be activated.')</script>"; 
}
//Topicok aktiválása
if(isset($_REQUEST['tactive'])){
      if(mysqli_query($adb, "
      UPDATE threads SET tstatus = 'Active' WHERE tid = '$_REQUEST[tid]'
      ")){
            print "<script>
                  alert('The thread has been activated.')
                  parent.location.href=parent.location.href
            </script>";
      }
      else print "<script> alert('This thread couldn't be activated.')</script>"; 
}
//Válaszok aktiválása
if(isset($_REQUEST['aactive'])){
      if(mysqli_query($adb, "
      UPDATE answers SET astatus = 'Active' WHERE aid = '$_REQUEST[aid]'
      ")){
            print "<script>
                  alert('The answer has been activated.')
                  parent.location.href=parent.location.href
            </script>";
      }
      else print "<script> alert('This answer couldn't be activated.')</script>"; 
}

?>

<style>
      table, th, td {
            border      : 1px solid black ;
            padding     : 12px;
      }
      th {
            background-color: #6f1cff;
            color: white;
      }
      tr {
            background-color: white;
            color: black;
      }
      tr:nth-child(even) {
            background-color  : #D6EEEE;
      }     
</style>

<div class='frame'>
      <div class="adminpanel left">
            <form method="get"> 
                <input type="submit" name="users"     value="Users"     />
                <input type="submit" name="logins"    value="Logins"    />
                <input type="submit" name="logging"   value="Logging"   />
                <input type="submit" name="posts"     value="Posts"     />
                <input type="submit" name="comments"  value="Comments"  />
                <input type="submit" name="threads"   value="Threads"   />
                <input type="submit" name="answers"   value="Answers"   />
                <input type="hidden" name="p"         value="adminpanel"/>
            </form>
      </div>

      <div class='adminpanel right'>
            <h1>Adminpanel</h1>

      <?php

      if(isset($_GET['users'])) 
      { 
            print "<table style=width:100%>
                  <tr>
                        <th>UserID                </th>
                        <th>UserName              </th>
                        <th>UserMail              </th>
                        <th>UserProfilePic        </th>
                        <th>RegDate               </th>
                        <th>Status                </th>
                        <th>Permission            </th>
                  </tr>";
            while( $userdatarow = mysqli_fetch_array( $userdata ) )
            {
                  print "
          	      <tr>
              	      <td>$userdatarow[uid]               </td>
              	      <td>$userdatarow[uname]             </td>
              	      <td>$userdatarow[umail]             </td>
              	      <td>$userdatarow[uprofilepic]       </td>
              	      <td>$userdatarow[udate]             </td>
                        <td>$userdatarow[ustatus]           </td>
	      		<td>$userdatarow[uperm]             </td>
          	      </tr>";
            }
            print "</table>"; 
      }

      if(isset($_GET['logins'])) 
      { 
            print "<table style=width:100%>
                  <tr>
                        <th>LoginID       </th>
                        <th>LoginUserID   </th>
                        <th>LoginDate     </th>
                        <th>LoginIP       </th>
                  </tr>";
            while( $loginsdatarow = mysqli_fetch_array( $loginsdata ) )
            {
        	      print "
          	      <tr>
              	      <td>$loginsdatarow[lid]          </td>
              	      <td>$loginsdatarow[luid]         </td>
              	      <td>$loginsdatarow[ldate]     </td>
              	      <td>$loginsdatarow[lip]        </td>
          	      </tr>";
            }
            print "</table>"; 
      }
      
      if(isset($_GET['logging'])) 
      { 
            print "<table style=width:100%>
                  <tr>
                        <th>LoggingID     </th>
                        <th>LoggingURL    </th>
                        <th>LogDate       </th>
                        <th>LogIP     </th>
                        <th>PostDate      </th>
                  </tr>";
            while( $loggingdatarow = mysqli_fetch_array( $loggingdata ) )
            {
        	      print "
          	      <tr>
              	      <td>$loggingdatarow[oid]      </td>
              	      <td>$loggingdatarow[ourl]     </td>
              	      <td>$loggingdatarow[odate]    </td>
              	      <td>$loggingdatarow[oip]      </td>
              	      <td>$loggingdatarow[olid]     </td>
          	      </tr>";
            }
            print "</table>"; 
      }

      if(isset($_GET['posts'])) 
      { 
            print "<table style=width:100%>
                  <tr>
                        <th>PostID        </th>
                        <th>UserID        </th>
                        <th>FileName      </th>
                        <th>PostTitle     </th>
                        <th>PostDate      </th>
                        <th>Status        </th>
                        <th colspan='2'>Action</th>
                  </tr>";
            while( $postdatarow = mysqli_fetch_array( $postdata ) )
            {
        	      print "
          	      <tr>
              	      <td>$postdatarow[pid]          </td>
              	      <td>$postdatarow[puid]         </td>
              	      <td>$postdatarow[ppicture]     </td>
              	      <td>$postdatarow[ptitle]       </td>
              	      <td>$postdatarow[pdate]        </td>
                        <td>$postdatarow[pstatus]      </td>
              	      <td>
              	          <a href='./?p=post&k=$postdatarow[ppicture]&c=$postdatarow[pid]'>
              	              <button>View</button>
              	          </a>
              	      </td>
                        <td>";
                        if($postdatarow['pstatus']!='Active') {
                              print "
                                    <form action='' method='post'>
                                          <input type='submit' name='pactive' value='Active'>
                                          <input type='hidden' name='pid'     value='$postdatarow[pid]'>
                                    </form>
                                    ";
                        }
                        else print "
                              <form action='' method='post'>
                                    <input type='submit' name='parchive' value='Archive'>
                                    <input type='hidden' name='pid'     value='$postdatarow[pid]'>
                              </form>
                              ";
                        print "</td> 
          	      </tr>";
            }
            print "</table>"; 
      } 

      if(isset($_GET['comments'])) 
      { 
            print "<table style=width:100%>
                  <tr>
                        <th>CommentID           </th>
                        <th>CommentPostID       </th>
                        <th>CommentUserID       </th>
                        <th>CommentText         </th>
                        <th>CommentStatus       </th>
                        <th>CommentDate         </th>
                        <th>Action              </th>
                  </tr>";
            while( $commentsdatarow = mysqli_fetch_array( $commentsdata ) )
            {
        	      print "
          	      <tr>
              	      <td>$commentsdatarow[cid]           </td>
                        <td>$commentsdatarow[cpid]          </td>
                        <td>$commentsdatarow[cuid]          </td>
              	      <td>$commentsdatarow[ctext]         </td>
                        <td>$commentsdatarow[cstatus]       </td>
                        <td>$commentsdatarow[cdate]         </td>
                        <td>";
                        if($commentsdatarow['cstatus']!='Active') {
                              print "
                                    <form action='' method='post'>
                                          <input type='submit' name='cactive' value='Active'>
                                          <input type='hidden' name='cid'     value='$commentsdatarow[cid]'>
                                    </form>
                                    ";
                        }
                        else print "
                              <form action='' method='post'>
                                    <input type='submit' name='carchive' value='Archive'>
                                    <input type='hidden' name='cid'     value='$commentsdatarow[cid]'>
                              </form>
                              ";
                        print "</td> 
          	      </tr>";
            }
            print "</table>"; 
      }

      if(isset($_GET['threads'])) 
      { 
            print "<table style=width:100%>
                  <tr>
                        <th>ThreadID            </th>
                        <th>ThreadUserID        </th>
                        <th>ThreadTitle         </th>
                        <th>ThreadSubtitle      </th>
                        <th>ThreadText          </th>
                        <th>ThreadStatus        </th>
                        <th>ThreadDate          </th>
                        <th colspan='2'>Action</th>
                  </tr>";
            while( $threadsdatarow = mysqli_fetch_array( $threadsdata ) )
            {
        	      print "
          	      <tr>
              	      <td>$threadsdatarow[tid]            </td>
                        <td>$threadsdatarow[tuid]           </td>
                        <td>$threadsdatarow[ttitle]         </td>
                        <td>$threadsdatarow[tsubtitle]      </td>
              	      <td>$threadsdatarow[ttext]          </td>
              	      <td>$threadsdatarow[tstatus]       </td>
                        <td>$threadsdatarow[tdate]          </td>                        
                        <td>
                              <a href='./?p=topic&i=$threadsdatarow[tid]&u=$threadsdatarow[tuid]'>
              	              <button>View</button>
              	          </a>
              	      </td>
                        <td>";
                        if($threadsdatarow['tstatus']!='Active') {
                              print "
                                    <form action='' method='post'>
                                          <input type='submit' name='tactive' value='Active'>
                                          <input type='hidden' name='tid'     value='$threadsdatarow[tid]'>
                                    </form>
                                    ";
                        }
                        else print "
                              <form action='' method='post'>
                                    <input type='submit' name='tarchive' value='Archive'>
                                    <input type='hidden' name='tid'     value='$threadsdatarow[tid]'>
                              </form>
                              ";
                        print "</td> 
          	      </tr>";
            }
            print "</table>"; 
      }

      if(isset($_GET['answers'])) 
      { 
            print "<table style=width:100%>
                  <tr>
                        <th>AnswerID            </th>
                        <th>AnswerThreadID      </th>
                        <th>AnswerUserID        </th>
                        <th>AnswerText          </th>
                        <th>AnswerStatus        </th>
                        <th>AnswerDate          </th>
                        <th>Action              </th>
                  </tr>";
            while( $answersdatarow = mysqli_fetch_array( $answersdata ) )
            {
        	      print "
          	      <tr>
              	      <td>$answersdatarow[aid]           </td>
                        <td>$answersdatarow[atid]          </td>
                        <td>$answersdatarow[auid]          </td>
              	      <td>$answersdatarow[atext]         </td>
                        <td>$answersdatarow[astatus]       </td>
              	      <td>$answersdatarow[adate]         </td>
                        <td>";
                        if($answersdatarow['astatus']!='Active') {
                              print "
                                    <form action='' method='post'>
                                          <input type='submit' name='aactive' value='Active'>
                                          <input type='hidden' name='aid'     value='$answersdatarow[aid]'>
                                    </form>
                                    ";
                        }
                        else print "
                              <form action='' method='post'>
                                    <input type='submit' name='aarchive' value='Archive'>
                                    <input type='hidden' name='aid'     value='$answersdatarow[aid]'>
                              </form>
                              ";
                        print "</td> 
          	      </tr>";
            }
            print "</table>"; 
      }

      if(isset($_GET['d']) && $_GET['d']=="delete") 
      { 
            $deletepicdata = mysqli_query($adb, "
                  UPDATE posts
                  SET pstatus = 'Archived'
                  WHERE pid =   '$_GET[pid]'
                  ");
      }

      if(isset($_GET['a']) && $_GET['a']=="active") 
      { 
            $activepicdata = mysqli_query($adb, "
                  UPDATE posts
                  SET pstatus = 'Active'
                  WHERE pid =   '$_GET[pid]'
                  ");
      }

      ?> 

      </div>

</div>



