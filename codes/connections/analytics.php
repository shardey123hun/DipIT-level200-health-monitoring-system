<?php

include 'conn.php';

$sql= 'SELECT * FROM emergencies order by id DESC';
$stmt= $conn->prepare($sql);
$stmt->execute();
$emergencies=$stmt->fetchAll();

$users_sql= 'SELECT * FROM users order by id DESC';
$users_stmt= $conn->prepare($users_sql);
$users_stmt->execute();
$users=$users_stmt->fetchAll();
$unhealthy=0;
$no_of_male=0;
 foreach($users as $user){
    if($user['gender']=="M"){
        $no_of_male++;
    }
    $health_status_sql= 'SELECT * FROM patient_records where patient= ? order by date DESC limit 1';
    $health_status_stmt= $conn->prepare($health_status_sql);
    $health_status_stmt->execute([$user['id']]);
    if($health_status_stmt->rowCount()==1){
        $records=$health_status_stmt->fetch();
        if(isset($records["health_status"]) &&$records["health_status"]!="normal"){
            $unhealthy++;
        }
    }
 }
 $healthy=count($users)-$unhealthy;
 $no_of_female=count($users)-$no_of_male;

?>