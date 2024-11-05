<?php
include 'conn.php';
$Sql= "insert into emergencies(latt, lon)
values(?,?)";
$smt=$conn->prepare($Sql);
$smt->execute([$_GET['latitude'], $_GET['longitude']]);
echo 'Sent';
?>