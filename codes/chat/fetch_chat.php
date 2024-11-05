<?php
session_start();
include('../connections/conn.php');
$me = $_SESSION['id'];
$receiver= $_GET['receiver'];
$MsgSql= "SELECT * FROM chats WHERE sender_id= ? and receiver_id= ? or receiver_id =?  and sender_id =? ";
$smt=$conn->prepare($MsgSql);
$smt->execute([$me, $receiver, $me, $receiver]);
if($smt->rowCount()>0){
    while ($row=$smt->fetch()) {
    
    if ($row['sender_id']==$_SESSION['id']){
      if($row['fileType']=="img"){
       echo ' <div id="sender"><img src="../photos/'.$row['attachment'].'" width="100%" height="auto" onclick="viewImage(this)" alt=""><br>'.$row['msg'].'<br>
                <small style="text-align: right;">'.$row['date'].'</small>
              </div>';
      }
      if($row['fileType']=="vid"){
       echo ' <div id="sender"><video src="../photos/'.$row['attachment'].'" width="100%" height="auto"> </video><br>'.$row['msg'].'<br>
                <small style="text-align: right;">'.$row['date'].'</small>
            </div>';
      }
      if($row['fileType']=="aud"){
       echo ' <div id="sender">
               <audio src="../photos/'.$row['attachment'].'" controls width="90%" height="500px">
               </audio><br>'.$row['msg'].'
               </div>';
      }
      if($row['fileType']=="file"){
        
       echo ' <div id="sender">
                  <a href="../photos/'.$row['attachment'].'">
                  <img src="../photos/file.jpg" width="100%" height="auto"  alt="'.$row['attachment'].'"> 
                  <small>'.$row['attachment'].'</small>
                  </a><br>'.$row['msg'].'<br>
                  <small style="text-align: right;">'.$row['date'].'</small>
               </div>';
      }
      if($row['fileType']==""){
        echo ' <div class="message patient-message" id="sender">
                  '.$row['msg'].'
               </div>';
      }
   } else{
       if($row['fileType']=="img"){
         echo ' <div id="receiver"><img src="../photos/'.$row['attachment'].'" width="100%" height="auto"  alt="" onclick="viewImage(this)"><br>'.$row['msg'].'</div>';
        }
        if($row['fileType']=="vid"){
         echo ' <div id="receiver"><video src="../photos/'.$row['attachment'].'" width="100%" height="auto"> </video><br>'.$row['msg'].'</div>';
        }
        if($row['fileType']=="aud"){
         echo ' <div id="receiver">
                  <audio src="../photos/'.$row['attachment'].'" width="100%" height="auto" controls></audio><br>'.$row['msg'].'</div>';
        }
        if($row['fileType']=="file"){
          echo ' <div id="receiver">
                    <a href="../photos/'.$row['attachment'].'">
                    <img src="../photos/file.jpg" width="100%" height="auto"  alt="'.$row['attachment'].'"> 
                    <small>'.$row['attachment'].'</small>
                    </a><br>'.$row['msg'].'<br>
                    <small style="text-align: right;">'.$row['date'].'</small>
                </div>';
      }
        if($row['fileType']==""){
          echo ' <div class="message patient-message"  id="receiver">
                    '.$row['msg'].'
                 </div>';
        }
      }
  } 
}
?>