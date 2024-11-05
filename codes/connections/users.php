<?php
include 'conn.php';
#Agent displaying condition ......shown on Admin page

#Agent displaying condition ......shown on Admin page
if(isset($_GET['user'])){
        $sql2= 'SELECT * FROM users
        WHERE id= ?';
        $stmt2= $conn->prepare($sql2);
        $stmt2->execute(([$_GET['user']]));
        $user=$stmt2->fetch();
}else{
        $sql= 'SELECT * FROM users order by id DESC';
        $stmt= $conn->prepare($sql);
        $stmt->execute();
        $users=$stmt->fetchAll();

}
?>