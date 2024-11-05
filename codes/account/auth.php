<?php
session_start();
if(isset($_SESSION['name'])&&isset($_SESSION['password'])){
    $_POST['name']= $_SESSION['name'];
    $_POST['password']=$_SESSION['password'];

}
#check if details submitted
if (isset($_POST['name'])&&
    isset($_POST['password'])){

        include '../connections/conn.php';

        #get data from POST request into variables

        $name= $_POST['name'];
        $password= $_POST['password'];


        if(empty($name)){
            #error message
            $em = "user name is required";

            #redirect to 'login.php'
            header("Location: ./login.php?error=$em");
            exit;
        }
        elseif(empty($password)){
            #error message
            $em = " password is required";

            #redirect to 'login.php'
            header("Location: ./login.php?error=$em");
            exit;
        }else{
                #validation
                $sql= 'SELECT * FROM users
                WHERE name=?';
                $stmt= $conn->prepare($sql);
                $stmt->execute([$name]);
        
                #if username Exist
                if($stmt->rowCount()===1){
                    #fetching user info
                    $user= $stmt->fetch();
                    #validation
                    if($user['name']==$name){

                        #Verify encrypted password
                        if($password===$user['password']){
                            #Login successful

                        #Creating session   
                        $_SESSION['name']=$user['name'];
                        $_SESSION['password']=$user['password'];
                        $_SESSION['id']=$user['id'];
                        $_SESSION['email']=$user['email'];
                        $_SESSION['contact']=$user['contact'];
                        $_SESSION['gender']=$user['gender'];
                        $_SESSION['profilePicture']=$user['profilePicture'];

                            if (isset($_POST['roomId'])){
                                $details=$_POST['roomId'];
                                header("Location: ../userPage/roomPreview.php?details=$details");
                            }else{
                            #redirect to 'AdminHome.php'
                            header("Location: ../user/");}

                            }else{
                            #error message
                            $em = " Incorrect password ";

                            #redirect to 'login.php'
                            header("Location: ./login.php?error=$em");}

                     }else{
                            #error message
                            $em = " Incorrect User name or password ";

                            #redirect to 'signup.php'
                            header("Location: ./login.php?error=$em");
                            exit;
                        }
                    
                }elseif($name=="Admin"&&$password=="admin12345"){
                        $_SESSION['name']=$name;
                        $_SESSION['password']=$password;
                        $_SESSION['id']=1;
                        #redirect to 'AdminHome.php'
                        header("Location: ../admin/");
                }else{
                            #validation
                    $sql= 'SELECT * FROM doctors 
                        WHERE name=?';
                    $stmt= $conn->prepare($sql);
                    $stmt->execute([$name]);
            
                    #if username Exist
                    if($stmt->rowCount()===1){
                        #fetching user info
                        $agent= $stmt->fetch();
                        #validation
                        if($agent['name']===$name){

                            #Verify encrypted password
                            if($password===$agent['password']){
                                #Login successful

                            #Creating session   
                            $_SESSION['name']=$agent['name'];
                            $_SESSION['password']=$agent['password'];
                            $_SESSION['id']=$agent['id'];
                            $_SESSION['profilePicture']=$agent['profilePicture'];
                            $_SESSION['occupation']=$agent['occupation'];
                            $_SESSION['email']=$agent['email'];
                            $_SESSION['contact']=$agent['contact'];
                            $_SESSION['gender']=$agent['gender'];
                            $_SESSION['profilePicture']=$agent['profilePicture'];
    
                            header("Location: ../admin/");
                        }else{
                                #error message
                                $em = " Incorrect User name or password ";
            
                                #redirect to 'signup.php'
                                header("Location: ./login.php?error=$em");
                                exit;}
                        }else{
                        #error message
                        $em = " Incorrect User name or password ";

                        #redirect to 'signup.php'
                        header("Location: ./login.php?error=$em");
                        exit;
                        }
                }else{
                    #error message
                    $em = " Incorrect User name or password ";

                    #redirect to 'signup.php'
                    header("Location: ./login.php?error=$em");
                    exit;}
            }
        }
    }else{
        header("Location: ./login.php");
        exit;
    }
?>