<?php
include '../connections/analytics.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <!-- Navigation Panel -->
        <nav class="nav-panel">
            
            <ul class="nav-items">
                <li class="nav-item"><a href="./"><i class="fa fa-home"></i>Home</a></li>
                <li class="nav-item active"><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li class="nav-item"><a href="add_report.php?user=<?=$_SESSION['id']?>"><i class="fas fa-bank"></i>See My Health Record</a></li>
                <li class="nav-item"><a href="htbt.html"> <i class="fas fa-heart-pulse"> </i>Check Heart Rate</a></li>
                <li class="nav-item"><a href="#"><i class="fa fa-user"></i>Amend my Details</a></li>
            </ul>
        </nav>
        <!-- Main Content -->
        <main class="main-content">
            <header class="main-header">
                <div class="nav-header">
                    <img src="../logo.jfif" alt="SLAS Logo" class="nav-logo">
                    <h1 class="nav-title">Health Monitoring System</h1>
                </div>
                <div class="user-info">
                    <i class=" fas fa-bell"></i>
                    <span>                    <span><?=$_SESSION['name']?></span>
</span>
                    <img src="../bg1.jpg" alt="User Profile" class="user-profile" onclick="showAccount()">
                    <i class="fa-solid fa-chevron-down" onclick="showAccount()"></i>
                    <div class="profile_summery">
                        <div>
                            <i class=" fas fa-phone"></i>
                            CHANGE CONTACT
                        </div>
                        <div>
                            <i class=" fas fa-user"></i>
                            CHANGE PASSWORD
                        </div>
                        <a href="../account/logout.php" class="logout">
                            <i class=" fas fa-right-from-bracket"></i>
                            LOGOUT
                        </a>
                    </div>
                </div>
            </header>
            <div class="content-header">
                <a href="#" class="back-home">Back to Home</a>
                <h2>Dashboard</h2>
            </div>
            <div class="tabs">
                <a href="#" class="tab active">Status</a>
                <a href="#" class="tab">New Emergency</a>
            </div>
            <div class="cards">
                <div class="card">
                    <h3><?=count($users)?></h3>
                    <p>Number of Users</p>
                </div>
                <div class="card">
                    <h3>75</h3>
                    <p>Number of Doctors</p>
                </div>
                <div class="card">
                    <h3><?=count($emergencies)?></h3>
                    <p>Numbr of Emergency cases</p>
                </div>
            </div>
            <?php
            include '../charts/index.html';
            ?>
        </main>
    </div>
    <script src="../nav_controller.js"></script>
    <script>
        let analytics=[]
        let health_analytics = {
            healthy:<?=$healthy?>,
            unhealthy:<?=$unhealthy?>,
        }
        let gender_analytics={
            no_of_male:<?=$no_of_male?>,
            no_of_female:<?=$no_of_female?>
        }
        analytics.push(health_analytics)
        analytics.push(gender_analytics)
        localStorage.setItem("analytics", JSON.stringify(analytics))
    </script>
</body>
</html>
