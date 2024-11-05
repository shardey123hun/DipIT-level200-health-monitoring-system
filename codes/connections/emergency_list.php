<?php
include 'conn.php';
#Agent displaying condition ......shown on Admin page

#Agent displaying condition ......shown on Admin page
if(isset($_GET['emergency'])){
        $sql2= 'SELECT * FROM emergencies
        WHERE id= ?';
        $stmt2= $conn->prepare($sql2);
        $stmt2->execute(([$_GET['emergency']]));
        $emergency=$stmt2->fetch();
}else{
        $sql= 'SELECT * FROM emergencies order by id DESC';
        $stmt= $conn->prepare($sql);
        $stmt->execute();
        $emergencies=$stmt->fetchAll();

}
?>