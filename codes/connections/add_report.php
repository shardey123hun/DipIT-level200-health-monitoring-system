<?php
session_start();
#check if details submitted
if (isset($_SESSION['id'])&&
    isset($_POST['patient'])){
    

        include 'conn.php';

        #get data from POST request into variables

        $doctor = $_SESSION['id'];
        $health_status = $_POST['health_status'];
        $glucose_level = $_POST['glucose_level'];
        $blood_pressure = $_POST['blood_pressure'];
        $heart_rate = $_POST['heart_rate'];
        $additional_notes = $_POST['additional_notes'];
        $temperature = $_POST['temperature'];
        $medications=$_POST['medications'];
        $patient = $_POST['patient'];
        $attachment;

        if((isset($_POST['others']))!=""){
            $additional_notes = $_POST['others'];
        }else{
            $additional_notes = $_POST['additional_notes'];}
        
        #making URL data format


        #Processing attachment

        If (isset($_FILES['attachment'])){
            #get data and store them im var
            $img_name = $_FILES['attachment']['name'];
            $tmp_name = $_FILES['attachment']['tmp_name'];
            $error = $_FILES['attachment']['error'];

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
                    $attachment= $doctor.time().'.'. $img_ex_lc;

                    #creating upload path on root directory
                    $attachment_path = '../files/'.$attachment;

                    #move uploaded image into uploaded folder 
                    move_uploaded_file($tmp_name, $attachment_path);
                }else{
                    $em= "You can't upload  files of this type";
                    header("additional_notes: ../index.php?error=$em");
                    exit;
                }
            }
        }
              
  
        # if the user uploads attachment,
         if($patient!=""){ 
            if($attachment!=""){  
                #Insert data into database
                $sql= "INSERT INTO patient_records(doctor, glucose_level, health_status , blood_pressure, heart_rate, additional_notes, temperature, attachment, medications, patient )
                    VALUES(?,?,?,?,?,?,?,?,?,?)";
                $stmt= $conn ->prepare($sql);
                $stmt->execute([$doctor, $glucose_level, $health_status , $blood_pressure, $heart_rate, $additional_notes, $temperature, $attachment, $medications, $patient]);
            }else{
         
                #Insert data into database
                $sql= "INSERT INTO patient_records(doctor, glucose_level, health_status , blood_pressure, heart_rate, additional_notes, temperature, medications, patient )
                    VALUES(?,?,?,?,?,?,?,?,?)";
                $stmt= $conn ->prepare($sql);
                $stmt->execute([$doctor, $glucose_level, $health_status , $blood_pressure, $heart_rate, $additional_notes, $temperature, $medications, $patient]);
            }
        }else{
            $em= "Please select additional_notes";
            header("additional_notes: ../index.php?error=$em");
            exit;
        }
        $sm = "Task successful. wait for approval";
        #redirect to 'index.php' and passing success message
        header("location: ../admin/add_report.php?user=$patient&&success=$sm");
        exit;
    }else{
        $em= "unknown insertion error occurred!";
        header("additional_notes: ../index.php?error=$em");
        exit;
    }

?>