<?php
session_start();
include '../connections/emergency_list.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emergency</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }
        #map {
            border: 2px solid #333;
            border-radius: 10px;
        }
    </style>
        <link rel="stylesheet" href="../user/styles.css">

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkYiyOU83FO0PsvD6cJW6DB9sySofT3Q0"></script>
</head>
<body onload="initializeMap('<?=$emergency['latt']?>', '<?=$emergency['lon']?>')">
    <header class="main-header">
        <div class="nav-header">
            <img src="../logo.jfif" alt="SLAS Logo" class="nav-logo">
            <h1 class="nav-title">Health Monitoring System</h1>
        </div>
        <div class="user-info">
            <i class=" fas fa-bell"></i>
            <span>                    <span><?=$_SESSION['name']?></span>
</span>
            <img src="../bg1.jpg" alt="User Profile" class="user-profile">
        </div>
    </header>
    <h2>Track Emergency location</h2>
    <div id="map" style="height: 400px; width: 100%; margin-top: 20px;"></div>
    <canvas id="canvas" width="320" height="240" style="display:none;"></canvas>

    <script src="script.js"></script>
</body>
</html>