<?php
    session_start();
    include '../connections/users.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user - Patient Details</title>
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
            <i class="notification-icon"></i>
            <span>                    <span><?=$_SESSION['name']?></span>
</span>
            <img src="../bg1.jpg" alt="User Profile" class="user-profile">
        </div>
    </header>

    <div class="container">
        <nav class="nav-panel">
            
            <ul class="nav-items">
                <li class="nav-item"><a href="./"><i class="fa fa-home"></i>Home</a></li>
                <li class="nav-item active"><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li class="nav-item"><a href="add_report.php?user=<?=$_SESSION['id']?>"><i class="fas fa-bank"></i>See My Health Record</a></li>
                <li class="nav-item"><a href="htbt.html"><i class="fa fa-list"></i>Check Heart Rate</a></li>
                <li class="nav-item"><a href="#"><i class="fa fa-user"></i>Amend my Details</a></li>
            </ul>
        </nav>

        <main class="main-content">
            <br><br><br>
            <div class="tabs">
            <a href="../chat/?user=1"class="tab active">Chat</a>
            </div>
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

            <section class="latest-health-status">


                <?php
                
                if(isset($_GET['user'])){
                    $sql2= 'SELECT * FROM patient_records
                    WHERE patient= ? order by date limit 1';
                    $stmt2= $conn->prepare($sql2);
                    $stmt2->execute(([$_GET['user']]));
                    $Current_patient_records=$stmt2->fetch();
                }
                ?>

                <h3>Latest Health Status</h3>
                <?php
                    if(!empty($Current_patient_records)){
                
                ?>
                <div class="info-item">
                    <span class="label">Current Status:</span>
                    <span class="value">Stable</span>
                </div>
                <div class="info-item">
                    <span class="label">Blood Glucose Levels:</span>
                    <span class="value"><?=$Current_patient_records['glucose_level']?> mg/dL</span>
                </div>
                <div class="info-item">
                    <span class="label">Blood Pressure:</span>
                    <span class="value"><?=$Current_patient_records['blood_pressure']?> mmHg</span>
                </div>
                <div class="info-item">
                    <span class="label">Heart Rate:</span>
                    <span class="value"><?=$Current_patient_records['heart_rate']?> bpm</span>
                </div>
                <div class="info-item">
                    <span class="label">Temperature:</span>
                    <span class="value"><?=$Current_patient_records['temperature']?>°F</span>
                </div>
                <div class="info-item">
                    <span class="label">Medications:</span>
                    <span class="value"><?=$Current_patient_records['medications']?></span>
                </div>
                <div class="info-item">
                    <span class="label">Additional Notes:</span>
                    <span class="value"><?=$Current_patient_records['additional_notes']?>.</span>
                </div>
                <?php
                }else{ 
                    $Current_patient_records['id']=0
                ?>
                    <span class="label">THIS FILE IS EMPTY</span>
                    <br><br>
                <?php
                
                }
                

                include '../charts/analytics.html'
                ?>

                <button class="view-previous-button" onclick="togglePreviousReports()">See Previous Reports</button>
            </section>

            <section class="previous-reports" id="previous-reports" style="display: none;">
                <h3>Previous Health Reports</h3>
                <div class="table-wrapper">
                <table class="reports-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Blood Glucose Levels</th>
                            <th>Blood Pressure</th>
                            <th>Heart Rate</th>
                            <th>Temperature</th>
                            <th>Medications</th>
                            <th>Additional Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2024-06-30</td>
                            <td>115 mg/dL</td>
                            <td>118/76 mmHg</td>
                            <td>72 bpm</td>
                            <td>98.4°F</td>
                            <td>Metformin</td>
                            <td>Patient's glucose levels are stable.</td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
                </div>

                <?php
                
                if(isset($_GET['user'])){
                    $sql2= 'SELECT * FROM patient_records
                    WHERE patient= ? and id!= ? order by date';
                    $stmt2= $conn->prepare($sql2);
                    $stmt2->execute(([$_GET['user'], $Current_patient_records['id']]));
                    $patient_records=$stmt2->fetchAll();
                }
               
                    if(!empty($patient_records)){
                        foreach($patient_records as $patient_record){
                ?>
                <h3><?=$patient_record['date']?></h3>
                <div class="info-item">
                    <span class="label">Status:</span>
                    <span class="value">Stable</span>
                </div>
                <div class="info-item">
                    <span class="label">Blood Glucose Levels:</span>
                    <span class="value"><?=$patient_record['glucose_level']?> mg/dL</span>
                </div>
                <div class="info-item">
                    <span class="label">Blood Pressure:</span>
                    <span class="value"><?=$patient_record['blood_pressure']?> mmHg</span>
                </div>
                <div class="info-item">
                    <span class="label">Heart Rate:</span>
                    <span class="value"><?=$patient_record['heart_rate']?> bpm</span>
                </div>
                <div class="info-item">
                    <span class="label">Temperature:</span>
                    <span class="value"><?=$patient_record['temperature']?>°F</span>
                </div>
                <div class="info-item">
                    <span class="label">Medications:</span>
                    <span class="value"><?=$patient_record['medications']?></span>
                </div>
                <div class="info-item">
                    <span class="label">Additional Notes:</span>
                    <span class="value"><?=$patient_record['additional_notes']?>.</span>
                </div><br><br>
                <?php
                    }
                }else{ 
                    
                ?>
                    <span class="label">THIS FILE IS EMPTY</span>
                    <br><br>
                <?php
                
                }
                
                ?>

            </section>
        </main>
    </div>

    <footer class="footer">
        <p>© 2024 Smart Hospital Referral System. All rights reserved.</p>
    </footer>

    <script>
        function togglePreviousReports() {
            const reportsSection = document.getElementById('previous-reports');
            if (reportsSection.style.display === 'none') {
                reportsSection.style.display = 'block';
            } else {
                reportsSection.style.display = 'none';
            }
        }
    </script>
        <script src="../nav_controller.js"></script>

</body>
</html>
