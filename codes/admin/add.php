<?php
    session_start();
    include '../connections/users.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor's Dashboard</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    display: flex;
    flex-direction: column;
    height: 100vh;
}

.header {
    background-color: #0033a1;
    color: #fff;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-left {
    display: flex;
    align-items: center;
}

.logo {
    height: 40px;
    margin-right: 10px;
}

.header-title {
    font-size: 20px;
    margin: 0;
}

.header-right {
    display: flex;
    align-items: center;
}

.doctor-name {
    margin-right: 20px;
    font-size: 16px;
}

.logout-button {
    background-color: #ff4b4b;
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-size: 14px;
    cursor: pointer;
    border-radius: 4px;
}

.container {
    display: flex;
    flex: 1;
}

.sidebar {
    width: 200px;
    background-color: #0033a1;
    color: #fff;
    padding: 20px;
    box-sizing: border-box;
}

.sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar ul li {
    margin-bottom: 20px;
}

.sidebar ul li a {
    color: #fff;
    text-decoration: none;
    font-size: 16px;
}

.main-content {
    flex: 1;
    padding: 20px;
    box-sizing: border-box;
}

.patient-info, .health-report {
    background-color: #fff;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.patient-info h3, .health-report h3 {
    margin-top: 0;
    font-size: 22px;
    color: #0033a1;
}
#patienthidden{
    display: none;
}

.info-item {
    display: flex;
    margin-bottom: 10px;
}

.label {
    font-weight: bold;
    width: 100px;
}

.value {
    flex: 1;
}

.health-form label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #0033a1;
}

.health-form textarea, .health-form input {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 4px;
    border: 1px solid #ccc;
    font-size: 14px;
}

.health-form textarea {
    resize: vertical;
}

.submit-button {
    background-color: #0033a1;
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 4px;
    display: block;
    width: 100%;
    text-align: center;
}

.footer {
    background-color: #0033a1;
    color: #fff;
    text-align: center;
    padding: 10px;
}

    </style>

        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <header class="main-header">
        <div class="nav-header">
            <img src="../logo.jfif" alt="SLAS Logo" class="nav-logo">
            <h1 class="nav-title">Health Monitoring System</h1>
        </div>
        <div class="user-info">
            <i class="notification-icon"></i>
            <span><span><?=$_SESSION['name']?></span>
</span>
            <img src="../bg1.jpg" alt="User Profile" class="user-profile">
        </div>
    </header>

    <div class="container">
        <nav class="nav-panel">
            
            <ul class="nav-items">
                <li class="nav-item"><a href="./"><i class="fa fa-home"></i>Home</a></li>
                <li class="nav-item active"><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li class="nav-item"><a href="Patients.php"><i class="fas fa-bank"></i>View Patients</a></li>
                <li class="nav-item"><a href="emergency_history.php"><i class="fa fa-list"></i>Emergency History</a></li>
                <li class="nav-item"><a href="../account/signup.html"><i class="fa fa-users"></i>Add new patient</a></li>
                <li class="nav-item"><a href="#"><i class="fa fa-user"></i>Amend my Details</a></li>
            </ul>
        </nav>

        <main class="main-content">
            <section class="patient-info">
                <h3>Patient Information</h3>
                <div class="info-item">
                    <span class="label">Name:</span>
                    <span class="value"><?=$user['name']?></span>
                </div>
                <div class="info-item">
                    <span class="label">Age:</span>
                    <span class="value">45</span>
                </div>
                <div class="info-item">
                    <span class="label">Gender:</span>
                    <span class="value"><?=$user['gender']=="M"?'Male':'Female'?></span>
                </div>
                <div class="info-item">
                    <span class="label">Patient ID:</span>
                    <span class="value">hidUid<?=$user['id']?></span>
                </div>
            </section>

            <section class="health-report">
                <h3>Update Health Report</h3>
                <form action="../connections/add_report.php" method="post" enctype="multipart/form-data" class="health-form">
                    <input type="text" name="patient" id="patienthidden" value="<?=$user['id']?>">
                    <label for="current-status">Current Health Status:</label>
                    <textarea id="current-status" name="health_status" rows="4" required></textarea>

                    <label for="blood-glucose">Blood Glucose Levels:</label>
                    <input type="text" id="blood-glucose" name="glucose_level" required>

                    <label for="blood-pressure">Blood Pressure:</label>
                    <input type="text" id="blood-pressure" name="blood_pressure" required>

                    <label for="heart-rate">Heart Rate:</label>
                    <input type="text" id="heart-rate" name="heart_rate" required>

                    <label for="temperature">Temperature:</label>
                    <input type="text" id="temperature" name="temperature" required>
                    <input type="file" id="" name="attachment">

                    <label for="medications">Medications:</label>
                    <textarea id="medications" name="medications" rows="4" required></textarea>

                    <label for="additional-notes">Additional Notes:</label>
                    <textarea id="additional-notes" name="additional_notes" rows="4"></textarea>

                    <button type="submit" class="submit-button">Update Report</button>
                </form>
            </section>
        </main>
    </div>

    <script src="../nav_controller.js"></script>
    
</body>
</html>
