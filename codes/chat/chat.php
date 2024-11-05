<?php
echo "hello php";
session_start();
    include('../connections/conn.php');
    if( $_GET['msg']&&
        $_GET['sender']&&
        $_GET['receiver']){
         $sender=   $_GET['sender'];
         $receiver=   $_GET['receiver'];
         $att=   $_GET['att'];
         echo $att."........";

         $msg=   $_GET['msg'];
         if (isset($_FILES['att'])){
            $img_name = $_FILES['att']['name'];
                    $tmp_name = $_FILES['att']['tmp_name'];
                    $error = $_FILES['att']['error'];

                    #If there is no error in uploading, 
        
                    if ($error===0){
                        #get image extension stored in a var
        
                        $img_ex= pathinfo( $img_name, PATHINFO_EXTENSION);
                        #convert the img extension into lowercase and store it in a var
                        $img_ex_lc = strtolower( $img_ex);
        
                        /*creating array 
                        that stores allowed to upload image extension.*/
        
                        $allowed_exs1= array("jpg","jpeg","png");
                        $allowed_exs2= array("mp4","wmp","aac");
                        $allowed_exs3= array("mp3","3gpp","png","m4a","");
        
                        #Check if the imagbe extension is present in the array
                        if(in_array($img_ex_lc, $allowed_exs1)){
                            $fileType="img";
                        }elseif(in_array($img_ex_lc, $allowed_exs2)){
                            $fileType="vid";
                        }elseif(in_array($img_ex_lc, $allowed_exs3)){
                            $fileType="aud";
                        }else{
                            $fileType="file";
                        }
                        
                            #renaming the image with name
                            $attachment= "chatcampus".time().'.'. $img_ex_lc;
        
                            #creating upload path on root directory
                            $img_upload_path = './'.$attachment;
        
                            #move uploaded image into uploaded folder 
                            move_uploaded_file($tmp_name, "photos/".$img_upload_path);
                        $MsgSql= "insert into chats(sender_id,	receiver_id,	msg, attachment,fileType)
                        values(?,?,?,?,?)";
                        $smt=$conn->prepare($MsgSql);
                        $smt->execute([$sender,$receiver,$msg,$attachment,$fileType]);
                        echo 'Sent';
                }else{
                        $em= "unknown error occurred!";
                        header("Location: ../signUp.php?error=$em&$data");
                        exit;
                    }
        }else{
            $MsgSql= "insert into chats(sender_id,	receiver_id,	msg)
           values(?,?,?)";
            $smt=$conn->prepare($MsgSql);
            $smt->execute([$sender,$receiver,$msg]);
           echo 'Sent';
        }
    }
?>