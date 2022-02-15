<?php
if(!isset($_SESSION)){
    session_start();
}
    include_once("connections/connect.php");
    $con=connect();

if(isset($_GET['logout'])){
    $id=$_GET['logout'];

    $command = "SELECT * FROM tbluser where `userID`='$id'";
    $data = $con->query($command) or die ($con->error);
    $rows = $data->fetch_assoc();
    $total = $data->num_rows;

    if(($total>0)&&($rows['Access']=="User")){
        
        if($rows['status']=="online.png"){
            $sql= "UPDATE tbluser SET `status`='offline.png' WHERE `userID`='$id'";
            $con->query($sql) or die ($con->error);
            
            unset($_SESSION['UserLogIn']);
            unset($_SESSION['Access']);
        }

        echo header("Location: home.php");  
    }
    else if(($total>0)&&($rows['Access']=="Admin")){
        if($rows['status']=="online.png"){
            $sql= "UPDATE tbluser SET `status`='offline.png' WHERE `userID`='$id'";
            $con->query($sql) or die ($con->error);

            unset($_SESSION['UserLogIn']);
            unset($_SESSION['Access']);
        }

        echo header("Location: home.php");
    }
    else if(($total>0)&&($rows['Access']=="Supervisor")){
        if($rows['status']=="online.png"){
            $sql= "UPDATE tbluser SET `status`='offline.png' WHERE `userID`='$id'";
            $con->query($sql) or die ($con->error);

            unset($_SESSION['UserLogIn']);
            unset($_SESSION['Access']);
        }
        echo header("Location: home.php");
    }
}


?>