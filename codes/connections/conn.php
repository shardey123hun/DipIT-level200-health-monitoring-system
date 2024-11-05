<?php 
 #Database connection file.................

        #server name
        $sName = "localhost";
        #user name
        $uName = "root";
        #password 
        $pass = "";
        #database name
        $db_name= "health_tracker";

        #creating database connection
        try{
            $conn= new PDO("mysql:host=$sName; dbname=$db_name",
             $uName,$pass);
             $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          }catch(PDOException $em){
              echo "connection failed : ".$em->getMessage();
          }?>