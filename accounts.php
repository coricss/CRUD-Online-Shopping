<?php
    if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connect.php");
$con=connect();

$id=0;
$fname = "";
$lname = "";
$email = "";
$password = "";
$house = "";
$street = "";
$brgy = "";
$city = "";
$province = "";
$phone = "";
$access="";
$update=false;
$User=false;
$signup=false;

$mysqli=new mysqli('localhost', 'root', '','onlineorderingsystem') or die ($mysqli_error($mysqli));
    
$sql = "SELECT * FROM tbluser WHERE `Access`='User'";
$users = $con->query($sql) or die ($con->error);
// $row = $users->fetch_assoc();
$sql = "SELECT * FROM tbluser WHERE `Access`='Admin'";
$admin = $con->query($sql) or die ($con->error);

$sql = "SELECT * FROM tbluser WHERE `Access`='Supervisor'";
$supervisor = $con->query($sql) or die ($con->error);

$sql = "SELECT * FROM tbluser";
$all = $con->query($sql) or die ($con->error);
     


        

//ADMIN LOGIN
if(isset($_SESSION['UserLogIn'])&&($_SESSION['Access']=="Admin")){
    $signup=true;

    //SEARCH
    if(isset($_POST['searchacc'])){ 
        $searchkey=$_POST['searchacc'];
        $sql = "SELECT * FROM tbluser WHERE `userID` like '%$searchkey%' OR `Firstname` LIKE '%$searchkey%' OR `Lastname` like '%$searchkey%' OR `email` like '%$searchkey%' OR `Access` like '%$searchkey%'";
        $all = $con->query($sql) or die ($con->error);
    }
    else{
        $sql = "SELECT * FROM tbluser";
        $searchkey="";
    }

    if(isset($_POST['save'])){
                    
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $house = $_POST['house'];
        $street = $_POST['street'];
        $brgy = $_POST['brgy'];
        $city = $_POST['city'];
        $province = $_POST['province'];
        $phone = $_POST['contact'];
        $access=$_POST['Access'];

        $sql= "SELECT * FROM tbluser where email = '$email'";
        $users = $con->query($sql) or die ($con->error);
        $row = $users->fetch_assoc();

        if($fname==""||$lname==""||$email==""||$password==""||$house==""||$city==""||$province==""||$city==""||$brgy==""||$phone==""){
            $_SESSION['message'] = "
            <script>
                $(function() {
                    $.notify({
                        message: 'Please Fill Up The Form Completely' 
                    },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'danger'
                    });
                });
            </script>";
        }
        else if($email==isset($row['email'])){
            $_SESSION['message'] = "
            <script>
                $(function() {
                    $.notify({
                        message: 'Email Address Already Exist And Taken' 
                    },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                    });
                });
            </script>";
        }
        else{
            $_SESSION['message'] = "
            <script>
                $(function() {
                    $.notify({
                        message: 'Record Has Been Added To Accounts' 
                    },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'success'
                    });
                });
            </script>";

            $sql= "INSERT INTO `tbluser`(`userID`, `photo`, `Firstname`, `Lastname`, `email`, `Password`, `HouseNo`, `Street`, `Brgy`, `City`, `Province`, `phone`, `status`, `Access`) VALUES ('', 'default.png', '$fname','$lname','$email','$password', '$house',' $street ','$brgy ','$city ','$province ', '+63$phone', 'offline.png', '$access')";
            $con->query($sql) or die ($con->error);
            echo header("Refresh:4; url=accounts.php");
        }
    }





    //DELETE
    if(isset($_GET['delete'])){
        $id=$_GET['delete'];
        
        $sql= "SELECT * FROM `tbluser` WHERE `Access`='User' AND `userID`='$id'";
        $con->query($sql) or die ($con->error);
        $data = $con->query($sql) or die ($con->error);
        $rows = $data->fetch_assoc();
        $total = $data->num_rows;
        $photo = $rows['photo'];

        if(($total>0)&&($rows['Access']=="User")){
            $sql= "DELETE FROM `tbluser` WHERE `userID`='$id'";
            $con->query($sql) or die ($con->error);

            $_SESSION['message'] = "
            <script>
                $(function() {
                    $.notify({
                        message: 'Record Has Been Deleted' 
                    },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                    });
                });
            </script>";

            if($photo!="default.png"){
                unlink("images/avatars/".$photo);
            }
            echo header("Refresh:4; url=accounts.php");
        }
    }





    //EDIT
    if(isset($_GET['edit'])){
        $update=true;
        $id=$_GET['edit'];

        $sql= "SELECT * FROM tbluser WHERE `userID`='$id'";
        $users=$con->query($sql) or die ($con->error);
        
        if($users->num_rows){
            $row = $users->fetch_assoc();
            $fname = $row['Firstname'];
            $lname = $row['Lastname'];
            $email = $row['email'];
            $password = $row['Password'];
            $house = $row['HouseNo'];
            $street = $row['Street'];
            $brgy = $row['Brgy'];
            $city = $row['City'];
            $province = $row['Province'];
            $phone = $row['phone'];
            $access=$row['Access'];
        }
        // echo header("Refresh:0; url=UserInformation.php");
    }





    //UPDATE
    if(isset($_POST['update'])){
        
        $id = $_POST['id'];
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $house = $_POST['house'];
        $street = $_POST['street'];
        $brgy = $_POST['brgy'];
        $city = $_POST['city'];
        $province = $_POST['province'];
        $phone = $_POST['contact'];
        $access=$_POST['Access'];

        $_SESSION['message'] = "
        <script>
            $(function() {
                $.notify({
                    message: 'Record Has Been Updated' 
                },{
                animate: {
                    enter: 'animate__animated animate__fadeInDown',
                    exit: 'animate__animated animate__fadeOutLeft'
                },
                delay: 2000,
                placement: {
                    from: 'bottom',
                    align: 'left'
                },
                type: 'success'
                });
            });
        </script>";

        $sql= "UPDATE tbluser SET `Firstname`='$fname', `Lastname`='$lname', `email`='$email', `Password`='$password', `HouseNo`='$house', `Street`=' $street ', `Brgy`='$brgy ', `City`='$city ', `Province`='$province ', `phone`='$phone', `Access`='$access' WHERE `userID`='$id'";
        $con->query($sql) or die ($con->error);
    
        echo header("Refresh:4; url=accounts.php");
    }

    if(isset($_POST['updatepic'])) {
                
        $ImageName=$_FILES["profileImg"]['name'];
        
        $id=$_SESSION['ID'];
        $sql = "SELECT `photo` FROM tbluser where `userID`='$id'";
        $users = $con->query($sql) or die ($con->error);
        $row = $users->fetch_assoc();

        //.JPG .PNG .GIF 
        $allowed_ext=array('gif', 'png', 'jpg', 'jpeg');
        $filename=$_FILES["profileImg"]['name'];
        $file_ext=pathinfo($filename, PATHINFO_EXTENSION);

        $new_img=$_FILES["profileImg"]["name"];
        $old_img=$row['photo'];

        if($new_img!='') {
            $update_filename=$_FILES['profileImg']['name'];
        }
        else {
            $update_filename=$old_img;
        }

        if (!in_array($file_ext, $allowed_ext)) {
            $_SESSION['message'] = "
            <script>
                $(function() {
                    $.notify({
                        message: 'Upload is not valid!' 
                    },{
                        animate: {
                            enter: 'animate__animated animate__fadeInDown',
                            exit: 'animate__animated animate__fadeOutLeft'
                        },
                        delay: 2000,
                        placement: {
                            from: 'bottom',
                            align: 'left'
                        },
                        type: 'danger'
                    });
                });
            </script>";
        }
        else {
            if($_FILES['profileImg']['name']!='') {
                if(file_exists("images/avatars/".$_FILES['profileImg']['name'])) {
                    $_SESSION['message'] = "
                    <script>
                        $(function() {
                            $.notify({
                                message: 'Image already exists!' 
                            },{
                                animate: {
                                    enter: 'animate__animated animate__fadeInDown',
                                    exit: 'animate__animated animate__fadeOutLeft'
                                },
                                delay: 2000,
                                placement: {
                                    from: 'bottom',
                                    align: 'left'
                                },
                                type: 'danger'
                            });
                        });
                    </script>";
                }
                else {
                    $sql= "UPDATE tbluser SET `photo`='$new_img' WHERE `userID`='$id'";
                    $con->query($sql) or die ($con->error);

                    if($_FILES['profileImg']['name']!='') {
                        move_uploaded_file($_FILES["profileImg"]["tmp_name"], "images/avatars/".$_FILES['profileImg']['name']);
                        if($_SESSION['photo']!="default.png") {
                            unlink("images/avatars/".$old_img);
                            $_SESSION['photo']=$new_img;
                        }
                        else {
                            $_SESSION['photo']=$new_img;
                        }
                    }
                    $_SESSION['message'] = "
                    <script>
                        $(function() {
                            $.notify({
                                message: 'Your photo has been uploaded!' 
                            },{
                                animate: {
                                    enter: 'animate__animated animate__fadeInDown',
                                    exit: 'animate__animated animate__fadeOutLeft'
                                },
                                delay: 2000,
                                placement: {
                                    from: 'bottom',
                                    align: 'left'
                                },
                                type: 'success'
                            });
                        });
                    </script>";
                    echo header("Refresh:2; url=accounts.php");
                }
            }
            else {
                $_SESSION['message'] = "
                <script>
                    $(function() {
                        $.notify({
                            message: 'Upload is not valid!' 
                        },{
                            animate: {
                                enter: 'animate__animated animate__fadeInDown',
                                exit: 'animate__animated animate__fadeOutLeft'
                            },
                            delay: 2000,
                            placement: {
                                from: 'bottom',
                                align: 'left'
                            },
                            type: 'danger'
                        });
                    });
                </script>";
            }
        }
    }
}





//SUPERVISOR LOGIN
else if(isset($_SESSION['UserLogIn'])&&($_SESSION['Access']=="Supervisor")){
    $user=true;
    $signup=true;

    //SEARCH
    if(isset($_POST['searchacc'])){ 
        $searchkey=$_POST['searchacc'];
        $sql = "SELECT * FROM tbluser WHERE `userID` like '%$searchkey%' OR `Firstname` LIKE '%$searchkey%' OR `Lastname` like '%$searchkey%' OR `email` like '%$searchkey%' OR `Access` like '%$searchkey%'";
        $all = $con->query($sql) or die ($con->error);
    }
    else {
        $sql = "SELECT * FROM tbluser";
        $searchkey="";
    }
    if(isset($_POST['updatepic'])) {
                
        $ImageName=$_FILES["profileImg"]['name'];
        
        $id=$_SESSION['ID'];
        $sql = "SELECT `photo` FROM tbluser where `userID`='$id'";
        $users = $con->query($sql) or die ($con->error);
        $row = $users->fetch_assoc();

        //.JPG .PNG .GIF 
        $allowed_ext=array('gif', 'png', 'jpg', 'jpeg');
        $filename=$_FILES["profileImg"]['name'];
        $file_ext=pathinfo($filename, PATHINFO_EXTENSION);

        $new_img=$_FILES["profileImg"]["name"];
        $old_img=$row['photo'];

        if($new_img!=''){
            $update_filename=$_FILES['profileImg']['name'];
        }
        else {
            $update_filename=$old_img;
        }

        if (!in_array($file_ext, $allowed_ext)){
            $_SESSION['message'] = "
            <script>
                $(function() {
                    $.notify({
                        message: 'Upload is not valid!' 
                    },{
                        animate: {
                            enter: 'animate__animated animate__fadeInDown',
                            exit: 'animate__animated animate__fadeOutLeft'
                        },
                        delay: 2000,
                        placement: {
                            from: 'bottom',
                            align: 'left'
                        },
                        type: 'danger'
                    });
                });
            </script>";
        }
        else {
            if($_FILES['profileImg']['name']!=''){
                if(file_exists("images/avatars/".$_FILES['profileImg']['name'])){
                    $_SESSION['message'] = "
                    <script>
                        $(function() {
                            $.notify({
                                message: 'Image already exists!' 
                            },{
                                animate: {
                                    enter: 'animate__animated animate__fadeInDown',
                                    exit: 'animate__animated animate__fadeOutLeft'
                                },
                                delay: 2000,
                                placement: {
                                    from: 'bottom',
                                    align: 'left'
                                },
                                type: 'danger'
                            });
                        });
                    </script>";
                }
                else {
                    $sql= "UPDATE tbluser SET `photo`='$new_img' WHERE `userID`='$id'";
                    $con->query($sql) or die ($con->error);

                    if($_FILES['profileImg']['name']!=''){
                        move_uploaded_file($_FILES["profileImg"]["tmp_name"], "images/avatars/".$_FILES['profileImg']['name']);
                        if($_SESSION['photo']!="default.png"){
                            unlink("images/avatars/".$old_img);
                            $_SESSION['photo']=$new_img;
                        }
                        else{
                            $_SESSION['photo']=$new_img;
                        }
                    }
                    $_SESSION['message'] = "
                    <script>
                        $(function() {
                            $.notify({
                                message: 'Your photo has been uploaded!' 
                            },{
                                animate: {
                                    enter: 'animate__animated animate__fadeInDown',
                                    exit: 'animate__animated animate__fadeOutLeft'
                                },
                                delay: 2000,
                                placement: {
                                    from: 'bottom',
                                    align: 'left'
                                },
                                type: 'success'
                            });
                        });
                    </script>";
                    echo header("Refresh:2; url=accounts.php");
                }
            }
            else{
                $_SESSION['message'] = "
                <script>
                    $(function() {
                        $.notify({
                            message: 'Upload is not valid!' 
                        },{
                            animate: {
                                enter: 'animate__animated animate__fadeInDown',
                                exit: 'animate__animated animate__fadeOutLeft'
                            },
                            delay: 2000,
                            placement: {
                                from: 'bottom',
                                align: 'left'
                            },
                            type: 'danger'
                        });
                    });
                </script>";
            }
        }
    }
}





//GUEST
else{
    echo header("Refresh:0; url=LogIn.php");
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Accounts</title>
    <link rel="shortcut icon" type=image/x-icon href=images/icon.png>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/animate.min.css">

    <script src="js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="jquery-3.3.1.slim.min.js"></script>
    <script src="js/bootstrap-notify.min.js"></script>
</head>
<body>






    <!-- NAVIGATION -->
    <nav class="navbar navbar-expand-md sticky-top navigation">
        <div class="container-fluid ">
            <a href="accounts.php" class="navbar-brand logo-container"><img src="images/Logo.png" alt="" class="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="fas fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <?php if($signup==true){?>
                        <li class="nav-item" id="account">
                            <div class="navbar-collapse" id="navbar-list-4">
                                <ul class="navbar-nav">
                                    <?php if (isset($_SESSION['UserLogIn'])){ ?>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img src="<?php echo 'images/avatars/'.$_SESSION['photo']?>" width="30" height="30" class="rounded-circle">
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                <a href="accounts.php?User" class="dropdown-item active-btn" name=logout><span class="fas fa-users"></span>&nbsp&nbspUsers</a>
                                                <a href="inventory.php" class="dropdown-item" name=logout><span class="fas fa-tshirt"></span>&nbsp&nbspInventory</a>
                                                <a href="transaction.php" class="dropdown-item" name=logout>&nbsp<span class="fas fa-file"></span>&nbsp&nbspTransactions</a>
                                                <a href="LogOut.php?logout=<?php echo $_SESSION['ID']?>" class="dropdown-item" name=logout>&nbsp<span class="fas fa-sign-out-alt"></span>&nbsp&nbspLogout</a>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <a href="accounts.php"  class="nav-link"><?php echo $_SESSION['Access'].": ".$_SESSION['firstname']." ".$_SESSION['lastname']; ?></a>
                                        </li>
                                    <?php } else { ?>
                                        <li class="nav-item">
                                            <a href="LogIn.php" class="nav-link">Login</a>
                                        </li>
                                    <?php }?>
                                </ul>
                            </div>
                        </li>
                        
                        <?php } else{ ?>
                        <li class="nav-item">
                            <a href="cart.php" class="nav-link"><i class="fas fa-shopping-cart"></i></a>
                        </li>
                        <li class="nav-item" id="signup">
                            <a href="sign-up.php"  class="nav-link">Sign Up</a>
                        </li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </nav>





    <!-- ALERT -->
    <?php if(isset($_SESSION['message'])){?>
        <?php 
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    <?php }?>





    <!-- ACCOUNTS -->
    <div class="container-fluid">
        <br><br><br><br>
        <!-- ADMIN AUTHORITY-->
        <?php if(isset($_SESSION['UserLogIn'])&&($_SESSION['Access']=="Admin")){?>
            <?php if((isset($_GET['edit']))||(isset($_GET['add']))){?>
                <div class="container">
                    <div class="row text-center">
                        <div class="col-12">
                            <h4 class="display-4">Data Form</h4><hr>
                        </div>
                    </div>
                    <br><br>

                    <div class="row">
                        <div class="col-12">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group col-sm-12 col-md-5">
                                        <input type="hidden" name='id' value="<?php echo $id; ?>">
                                        <label for="inputFirstname">Firstname: </label>
                                        <input type="text" name="firstname" id="accountsinputFirstname" class="form-control" placeholder="Firstname" value="<?php echo $fname?>">
                                    </div>
                                    <div class="form-group col-sm-12 col-md-5">
                                        <label for="inputLastname">Lastname: </label>
                                        <input type="text" name="lastname" id="accountsinputLastname" class="form-control" placeholder="Lastname" value="<?php echo $lname?>">
                                    </div>
                                    <div class="form-group col-sm-12 col-md-2">
                                        <label for="access">Account Type:</label>
                                        <select name="Access" id="access" class="form-control col-sm-12">
                                            <option value="User" name='User'>User</option>
                                            <option value="Admin" name='Admin'>Admin</option>
                                            <option value="Supervisor" name='Supervisor'>Supervisor</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-5">
                                        <label for="inputEmail">Email Address: </label>
                                        <input type="email" name="email" id="accountsinputEmail" class="form-control" placeholder="Email" value="<?php echo $email?>">
                                    </div>
                                    <div class="form-group col-sm-12 col-md-4">
                                        <label for="inputPassword">Password: </label>
                                        <input type="password" name="password" id="accountsinputPassword" class="form-control" placeholder="Password" value="<?php echo $password?>">
                                    </div>
                                    <div class="form-group col-sm-12 col-md-3">
                                        <label for="inputContactNumber">Contact Number: </label>
                                        <input type="text" name="contact" id="accountsinputContactNumber" class="form-control" maxlength="10" placeholder="+63" onkeypress="return onlyNumberKey(event)" value="<?php echo $phone?>">
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="inputAddress">Address: </label>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-4">
                                        <input type="text" name="house" id="accountsinputHouseNumber" onkeypress="return onlyNumberKey(event)" class="form-control" placeholder="House Number" value="<?php echo $house?>">
                                    </div>
                                    <div class="form-grop col-sm-12 col-md-4">
                                        <input type="text" name="street" id="accountsinputStreet" class="form-control" placeholder="Street" value="<?php echo $street?>">
                                    </div>
                                    <div class="form-grop col-sm-12 col-md-4">
                                        <input type="text" name="brgy" id="accountsinputBarangay" class="form-control" placeholder="Barangay" value="<?php echo $brgy?>">
                                    </div>
                                    <div class="form-grop col-sm-12 col-md-6">
                                        <input type="text" name="city" id="accountsinputCity" class="form-control" placeholder="City" value="<?php echo $city?>">
                                    </div>
                                    <div class="form-grop col-sm-12 col-md-6">
                                        <input type="text" name="province" id="accountsinputProvince" class="form-control" placeholder="Province" value="<?php echo $province?>">
                                    </div>   
                                </div>
                                <br><br>
                                <?php if($update==true){ ?>
                                    <div class="form-row">
                                        <div class="col-6 mx-auto button-container">
                                            <button type="submit" name="update" onclick=topFunction() class="btn btn-primary btn-md form-control">Update Account <img src=images/buttons/update.png></button>
                                        </div>
                                    </div>
                                <?php }else{ ?>
                                    <div class="form-row">
                                        <div class="col-6 mx-auto button-container">
                                            <button type="submit" name="save" class="btn btn-primary btn-md form-control">Save Account <i class="fas fa-save align-middle"></i></button>
                                        </div>
                                    </div>
                                <?php } ?>
                            </form>
                        </div>
                    </div>     
                </div>
            <?php } else {?>  
                <!-- ACCOUNTS -->
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-row img-pos">
                        <div class="form-group img-profile text-center col-12" >
                            <input type="file" name="profileImg" id="profileImg" onChange="displayImg(this)" class="form-control" style="display: none;">
                            <div class="try">
                                <input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
                                <img src="<?php echo 'images/avatars/'.$_SESSION['photo']?>" onclick=triggerClick() id="profileDis2" width=30px height=30px alt="" >
                            </div>
                            <input type="hidden" name="photo" id="photo" placeholder="" onclick=triggerClick() value="<?php echo $_SESSION['photo']; ?>">
                            <div class="text-center img-place img-di">
                                <h6><button type=submit id=update name=updatepic>Update Image</button></h6>
                                <h4 id='name'><?php echo $_SESSION['firstname'].' '.$_SESSION['lastname']?></h4>
                            </div>  
                        </div>
                    </div>
                </form>
                <hr style='width: 70%'>
                <div class="row text-center">
                    <div class="col-12">
                        <h4 class="display-4" id=accounts>Accounts</h4>
                        <center>
                            <form method=post>
                                <div class="search-box">
                                    <input class="search-input" name=searchacc type="text" value="<?php echo $searchkey;?>" placeholder="Search something.." data-toggle="tooltip" data-placement="top" title="Type to search">
                                    <button type=submit class="search-btn" name=btnsearchacc data-toggle="tooltip" data-placement="top" title="Click to search"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </center>
                        <br><br>
                    </div>
                </div>   
                <div class="row">
                    <div class="col-12 table-responsive table-container">
                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Avatar</th>
                                    <th scope="col">Firstname</th>
                                    <th scope="col">Lastname</th>
                                    <th scope="col">Email Address</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Contact Number</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Account Type</th>
                                    <th scope="col"><center>Action</center></th>
                                </tr>
                            </thead>
                            <?php while($row = $all->fetch_array()){ ?>
                                <tbody>
                                    <tr>
                                        <th scope="row"><?php echo $row['userID'];?></th>
                                        <td><img src="<?php echo 'images/avatars/'.$row['photo']?>"width="90" height="90"></td>
                                        <td><?php echo $row['Firstname'];?></td>
                                        <td><?php echo $row['Lastname'];?></td>
                                        <td><?php echo $row['email'];?></td>
                                        <td>
                                            <?php if(($row['Access']=="Admin")||($row['Access']=="Supervisor")){?>
                                                <?php echo $row['Password']=str_repeat("*", strlen($row['Password']));?>
                                            <?php } else{?>
                                                <?php echo $row['Password'];?>
                                            <?php }?>
                                        </td>
                                        <td><?php echo $row['HouseNo'].$row['Street'].$row['Brgy'].$row['City'].$row['Province'];?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <td><img src="<?php echo 'images/status/'.$row['status']?> " width="20" height="20"></td>
                                        <td><?php echo $row['Access']; ?></td>
                                        <td>
                                            <?php if(($row['Access']=="Admin")||($row['Access']=="Supervisor")){?>
                                                <center>
                                                    <div class="table-buttons">   
                                                        <a href="accounts.php?add=<?php echo $row['userID']?>#accountform"><button class="btn btn-primary btn-sm form-control" onclick=botFunction() id=add type=submit name=add data-toggle="tooltip" data-placement="top" title="Click to add" ><i class="fas fa-user-plus"></i></button></a>             
                                                        <button class="btn btn-secondary btn-sm form-control" onclick=botFunction() id=edit type=submit name=edit data-toggle="tooltip" data-placement="top" title="Edit is disabled"><i class="fas fa-user-edit"></i></button>
                                                        <button class="btn btn-secondary btn-sm form-control" type=submit id=delete name=delete data-toggle="tooltip" data-placement="top" title="Delete is disabled"><i class="fa fa-trash" ></i></button>     
                                                    </div>
                                                </center> 
                                            <?php } else{?>
                                                <center>
                                                    <div class="table-buttons">  
                                                        <a href="accounts.php?add=<?php echo $row['userID']?>#accountform"><button class="btn btn-primary btn-sm form-control" onclick=botFunction() id=add type=submit name=add data-toggle="tooltip" data-placement="top" title="Click to add"><i class="fas fa-user-plus"></i></button></a>              
                                                        <a href="accounts.php?edit=<?php echo $row['userID']?>#accountform"><button class="btn btn-success btn-sm form-control" onclick=botFunction() id=edit type=submit name=edit data-toggle="tooltip" data-placement="top" title="Click to edit" ><i class="fas fa-user-edit"></i></button></a>
                                                        <a href="accounts.php?delete=<?php echo $row['userID']?>"><button class="btn btn-danger btn-sm form-control" type=submit id=delete name=delete data-toggle="tooltip" data-placement="top" title="Click to delete"><i class="fa fa-trash"></i></button></a>        
                                                    </div>
                                                </center> 
                                            <?php }?>
                                        </td>
                                    </tr>
                                </tbody>
                            <?php } ?> 
                        </table>
                    </div>
                </div>
                <br><br>
                <hr id=accountform>
                <br><br>
            <?php }?>





            <!-- SUPERVISOR'S AUTHORITY -->
            <?php } else if(isset($_SESSION['UserLogIn'])&&($_SESSION['Access']=="Supervisor")){?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-row img-pos">
                        <div class="form-group img-profile text-center col-12" >
                            <input type="file" name="profileImg" id="profileImg" onChange="displayImg(this)" class="form-control" style="display: none;">
                            <div class="try">
                                <input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
                                <img src="<?php echo 'images/avatars/'.$_SESSION['photo']?>" onclick=triggerClick() id="profileDis2" width=30px height=30px alt="" >
                            </div>
                            <input type="hidden" name="photo" id="photo" placeholder="" onclick=triggerClick() value="<?php echo $_SESSION['photo']; ?>">
                            <div class="text-center img-place img-di">
                                <h6><button type=submit id=update name=updatepic>Update Image</button></h6>
                                <h4 id='name'><?php echo $_SESSION['firstname'].' '.$_SESSION['lastname']?></h4>
                            </div>  
                        </div>
                    </div>
                </form>
                <hr style='width: 70%'>
                <div class="row text-center">
                    <div class="col-12">
                        <h4 class="display-4" id=accounts>Accounts</h4>
                        <center>
                            <form method=post>
                                <div class="search-box">
                                    <input class="search-input" name=searchacc type="text" value="<?php echo $searchkey;?>" placeholder="Search something.." data-toggle="tooltip" data-placement="top" title="Type to search" >
                                    <button type=submit class="search-btn" name=btnsearchacc data-toggle="tooltip" data-placement="top" title="Search" ><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </center>
                        <br><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 table-responsive table-container">
                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Avatar</th>
                                    <th scope="col">Firstname</th>
                                    <th scope="col">Lastname</th>
                                    <th scope="col">Email Address</th>
                                    <!-- <th scope="col">Password</th> -->
                                    <th scope="col">Address</th>
                                    <th scope="col">Contact Number</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Account Type</th>
                                </tr>
                            </thead>
                            <?php while($row = $all->fetch_array()){ ?>
                                <tbody>
                                    <tr>
                                        <th scope="row"><?php echo $row['userID'];?></th>
                                        <td><img src="<?php echo 'images/avatars/'.$row['photo']?>"width="90" height="90"></td>
                                        <td><?php echo $row['Firstname'];?></td>
                                        <td><?php echo $row['Lastname'];?></td>
                                        <td><?php echo $row['email'];?></td>
                                        <!-- <td><?php echo $row['Password']=str_repeat("*", strlen($row['Password']));?></td> -->
                                        <td><?php echo $row['HouseNo'].$row['Street'].$row['Brgy'].$row['City'].$row['Province'];?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <td><img src="<?php echo 'images/status/'.$row['status']?> " width="20" height="20"></td>
                                        <td><?php echo $row['Access']; ?></td>
                                    </tr>
                                </tbody>
                                <?php }?>   
                            <?php }?>
                        </table>
                    </div>
                </div>
                <br><br><br><br><br><br><br><br>
            </div>
        </div>
    </div>
    <br><br>
    




    <!-- FOOTER -->
    <footer>
        <div class="container-fluid footer">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <h4 class="display-4 name">Lifestyle Clothing Co.</h4>
                    <p class="lead">
                        As Asia’s Online Fashion Destination, we create endless style possibilities through 
                        an ever-expanding range of products form the most coveted international and local 
                        brands, putting you at the centre of it all. With Lifestyle Clothing Co., You Own Now.
                    </p>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <p class="lead">Help Center:</p>
                    <div class="row">
                        <div class="col-12">
                            <a href="#">Location</a><br>
                            <a href="#">Contact Us</a><br>
                            <a href="#">Privacy Policy</a><br>
                            <a href="#">Terms And Conditions</a><br>
                            <a href="#">Frequently Asked Questions (FAQs)</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <p class="lead">Follow Us On:</p>
                    <div class="col-12 social">
                        <a href="#"><span class="fab fa-facebook"></span> Facebook</a><br>
                        <a href="#"><span class="fab fa-instagram"></span> Instagram</a><br>
                        <a href="#"><span class="fab fa-twitter"></span> Twitter</a><br>
                        <a href="#"><span class="fab fa-youtube"></span> YouTube</a><br>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <p class="lead">Email Us:</p>
                    <div class="textbox">
                        <input type="text" placeholder="Write Your Thoughts">
                    </div>
                    <div class="button">
                        <a href="mailto:" class="btn btn-primary">Send</a>
                    </div>
                </div>
            </div>
            <br>
            <hr>
            <div class="row text-center">
                <div class="col-12">
                   <p>Copyright © 2021 | All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>
</body>

<script>
    function onlyNumberKey(evt) { 
        // Only ASCII charactar in that range allowed 
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false; 
        return true;
    }

    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    function botFunction() {
        document.body.scrollBot = 0;
        document.documentElement.scrollBot = 0;
    }
</script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<script>
    function triggerClick(e) {
        document.querySelector('#profileImg').click();
    }

    function displayImg(e) {
        if (e.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
                document.querySelector('#profileDis2').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(e.files[0]);
        }
    }
</script>
</html>