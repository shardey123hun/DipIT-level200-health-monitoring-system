<?php
session_start();
#check if details submitted
if (isset($_POST['name'])&&
    isset($_POST['password'])&&
    isset($_POST['email'])&&
    isset($_POST['gender'])&&
    isset($_POST['contact'])){
        
        include 'conn.php';

        #get data from POST request into variables

        $name= $_POST['name'];
        $password = $_POST['password'];
        $email= $_POST['email'];
        $gender = $_POST['gender'];
        $contact= $_POST['contact'];
        #making URL data format
        $data = 'name='.$name.'password='.$password;
        #Simple form validation

        if(empty($name)){
            #error message
            $em = " Name is required";
            #redirect to 'signup.php'
            header("Location: ../signUp.php?error=$em");
            exit;
        }
        elseif(empty($email)){
            #error message
            $em = " user email is required";

            #redirect to 'signup.php'
            header("Location: ../signUp.php?error=$em");
            exit;
        }
        elseif(empty($password)){
            #error message
            $em = " password is required";

            #redirect to 'signup.php'
            header("Location: ../signUp.php?error=$em");
            exit;
        }else{
              
        #Processing Profile picture

        If (isset($_FILES['profilePicture'])!=""){
            #get data and store them im var
            $img_name = $_FILES['profilePicture']['name'];
            $tmp_name = $_FILES['profilePicture']['tmp_name'];
            $error = $_FILES['profilePicture']['error'];

            #If there is no error in uploading, 

            if ($error===0){
                #get image extension stored in a var

                $img_ex= pathinfo( $img_name, PATHINFO_EXTENSION);
                #convert the img extension into lowercase and store it in a var
                $img_ex_lc = strtolower( $img_ex);

                /*creating array 
                that stores allowed to upload image extension.*/

                $allowed_exs= array("jpg","jpeg","png");

                #Check if the imagbe extension is present in the array
                
                If ( in_array( $img_ex_lc, $allowed_exs)){

                    #renaming the image with name
                    $new_img_name= $name.time().'.'. $img_ex_lc;

                    #creating upload path on root directory
                    $img_upload_path = $new_img_name;

                    #move uploaded image into uploaded folder 
                    move_uploaded_file($tmp_name, 'uploads/'.$img_upload_path);
                }else{
                    $em= "You can't upload  files of this type";
                    header("Location:  accountManager/signUp.php?error=$em&$data");
                    exit;
                }
            }else{
                $em= "unknown error occurred!";
                header("Location:  accountManager/signUp.php?error=$em&$data");
                exit;
            }
        }
        # if the user uploads profile picture,
         if(isset($new_img_name)){  
            #Insert data into database
            $sql= "INSERT INTO doctors( name, password, email, p_p, gender,contact)
                VALUES(?,?,?,?,?,?)";
            $stmt= $conn ->prepare($sql);
            $stmt->execute([$name, $password, $email, $img_upload_path, $gender, $contact]);
        }else{
              #Insert data into database
              $sql= "INSERT INTO doctors( name, password, email, gender,contact)
              VALUES(?,?,?,?,?)";
          $stmt= $conn ->prepare($sql);
          $stmt->execute([$name, $password, $email, $gender, $contact]);
        }
        // $sql= 'SELECT * FROM doctors 
        //                 WHERE name=? && password=?';
        //             $stmt= $conn->prepare($sql);
        //             $stmt->execute([$name, $password]);
        //             $agent= $stmt->fetch();
        //                     $_SESSION['name']=$name;
        //                     $_SESSION['password']=$password;
        //                     $_SESSION['id']=$agent['id'];
        //                     $_SESSION['profilePicture']=$agent['profilePicture'];
                        
        $sm = "Account created successfully";
        #redirect to 'index.php' and passing success message
        header("Location: ../admin/");
        exit;
    }
}else{
        header("Location: ../accountManager/signUp.php");
        exit;
    }
?>