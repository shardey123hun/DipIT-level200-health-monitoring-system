<?php
    session_start();
    include '../connections/users.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - All Patients</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="newstyles.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="main-header">
        <div class="nav-header">
            <img src="../logo.jfif" alt="SLAS Logo" class="nav-logo">
            <h1 class="nav-title">Health Monitoring System</h1>
        </div>
        <div class="user-info">
            <i class="fas fa-bell notification-icon"></i>
            <span>                    <span><?=$_SESSION['name']?></span>
</span>
            <img src="../bg1.jpg" alt="User Profile" class="user-profile">
        </div>
    </header>

    <div class="container">
        <nav class="nav-panel">
            
            <ul class="nav-items">
                <li class="nav-item"><a href="./"><i class="fa fa-home"></i>Home</a></li>
                <li class="nav-item"><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li class="nav-item active"><a href="Patients.php"><i class="fas fa-bank"></i>View Patients</a></li>
                <li class="nav-item"><a href="emergency_history.php"><i class="fa fa-list"></i>Emergency History</a></li>
                <li class="nav-item"><a href="../account/signup.html"><i class="fa fa-users"></i>Add new patient</a></li>
                <li class="nav-item"><a href="#"><i class="fa fa-user"></i>Amend my Details</a></li>
            </ul>
        </nav>

        <main class="main-content">
            <section class="patient-list">
                <br><br>
                <h3>All Patients</h3>
                <div class="table-wrapper">

                <table class="patients-table">
                    <thead>
                        <tr>
                            <th>Patient ID</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                            foreach($users as $user){
                        
                        ?>
                    
                        <tr>
                            <td>UID<?=$user['id']?></td>
                            <td><?=$user['name']?></td>
                            <td>45</td>
                            <td><?=$user['gender']=="M"?'Male':'Female'?></td>
                            <td><a href="add_report.php?user=<?=$user['id']?>" class="view-button">View</a></td>
                        </tr>
                        <?php
                        }
                        
                        ?>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </section>
            
            </div>
        </main>
    </div>
    <script src="../nav_controller.js"></script>

</body>
</html>
