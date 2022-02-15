<?php

if(!isset($_SESSION)){
    session_start();
}
    include_once("connections/connect.php");
    $con=connect();

    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $sql= "SELECT * FROM tbluser where email = '$email' and password = '$password'";
        $users = $con->query($sql) or die ($con->error);
        $row = $users->fetch_assoc();
        $total = $users->num_rows;


        if(($total>0)&&($row['Access']=="Admin")){

            $id=$row['userID'];
            $_SESSION['ID']=$row['userID'];
            $_SESSION['UserLogIn'] = $row['email'];
            $_SESSION['Access'] = $row['Access'];
            $_SESSION['firstname']=$row['Firstname'];
            $_SESSION['lastname']=$row['Lastname'];
            $_SESSION['photo']=$row['photo'];

            if($row['status']=="online.png"){
                $_SESSION['message'] = "<script>
                $(function() {
                    $.notify({
                        message: 'Account is currently logged in' 
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
                unset($_SESSION['UserLogIn']);
                unset($_SESSION['Access']);
            }
            else{
            
            $_SESSION['message'] = "<script>
            $(function() {
                $.notify({
                    message: 'Admin Login Successful!'
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
            
            if($row['status']=="offline.png"){
                $sql= "UPDATE tbluser SET `status`='online.png' WHERE `userID`='$id'";
                $con->query($sql) or die ($con->error);
            }

            echo header("Refresh:1; url=accounts.php");
        }
            
        }
        else if(($total>0)&&($row['Access']=="User")){

            $id=$row['userID'];
            $_SESSION['ID']=$row['userID'];
            $_SESSION['UserLogIn'] = $row['email'];
            $_SESSION['Access'] = $row['Access'];
            $_SESSION['firstname']=$row['Firstname'];
            $_SESSION['lastname']=$row['Lastname'];
            $_SESSION['photo']=$row['photo'];

            $_SESSION['houseno']=$row['HouseNo'];
            $_SESSION['street']=$row['Street'];
            $_SESSION['brgy']=$row['Brgy'];
            $_SESSION['city']=$row['City'];
            $_SESSION['prov']=$row['Province'];
            $_SESSION['contact']=$row['phone'];
            
        if($row['status']=="online.png"){
            $_SESSION['message'] = "<script>
            $(function() {
                $.notify({
                    message: 'Account is currently logged in' 
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
            unset($_SESSION['UserLogIn']);
            unset($_SESSION['Access']);
        }
        else{
            
            $_SESSION['message'] = "<script>
            $(function() {
                $.notify({
                    message: 'User Login Successful!'
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

            if($row['status']=="offline.png"){
                $sql= "UPDATE tbluser SET `status`='online.png' WHERE `userID`='$id'";
                $con->query($sql) or die ($con->error);
            }

            echo header("Refresh:1; url=home.php");
        }
        }
        else if(($total>0)&&($row['Access']=="Supervisor")){

            $id=$row['userID'];
            $_SESSION['ID']=$row['userID'];
            $_SESSION['UserLogIn'] = $row['email'];
            $_SESSION['Access'] = $row['Access'];
            $_SESSION['firstname']=$row['Firstname'];
            $_SESSION['lastname']=$row['Lastname'];
            $_SESSION['photo']=$row['photo'];

            if($row['status']=="online.png"){
                $_SESSION['message'] = "<script>
                $(function() {
                    $.notify({
                        message: 'Account is currently logged in' 
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
                unset($_SESSION['UserLogIn']);
                unset($_SESSION['Access']);
            }
            else{
            $_SESSION['message'] = "<script>
            $(function() {
                $.notify({
                    message: 'Supervisor Login Successful!'
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

            if($row['status']=="offline.png"){
                $sql= "UPDATE tbluser SET `status`='online.png' WHERE `userID`='$id'";
                $con->query($sql) or die ($con->error);
            }

            echo header("Refresh:1; url=accounts.php");
        }
        }
    
        else{
            $_SESSION['message'] = "<script>
            $(function() {
                $.notify({
                    message: 'Invalid Email Address And Password!' 
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
    if(isset($_POST['register'])){
        echo header("Location: Register.php");
    }
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="shortcut icon" type=image/x-icon href=images/icon.png>
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
    <script src="js/bootstrap-notify.min.js"></script>
</head>
<body>


    <!-- NAVIGATION -->
    <nav class="navbar navbar-expand-md sticky-top navigation">
        <div class="container-fluid">
            <a href="home.php" class="navbar-brand logo-container"><img src="images/Logo.png" alt="" class="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="fas fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a href="men.php" class="nav-link dropbtn">Men</a>
                        <div class="dropdown-content">
                            <a href="men-top.php">Top</a>
                            <a href="men-bottom.html">Bottom</a>
                            <a href="men-formal-attire.html">Formal Attire</a>
                        </div>
                    </li>
               
                    <li class="nav-item dropdown">
                        <a href="women.php" class="nav-link dropbtn">Women</a>
                        <div class="dropdown-content">
                            <a href="women-top.php">Top</a>
                            <a href="women-bottom.php">Bottom</a>
                            <a href="women-dress.php">Dress</a>
                        </div>
                    </li>
                
                    <li class="nav-item dropdown">
                        <a href="kids.php" class="nav-link dropbtn">Kids</a>
                        <div class="dropdown-content">
                            <a href="kids-boys.php">Boys</a>
                            <a href="kids-girls.php">Girls</a>
                            <a href="kids-toddlers.php">Toddlers</a>
                        </div>
                    </li>
                </ul>
                    <li class="nav-item">
                        <a href="sign-up.php" class="nav-link">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a href="LogIn.php" class="nav-link">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- LOG IN -->
    <div class="login-background">
        
    <!-- ALERT -->
    
    <?php if(isset($_SESSION['message'])){?>
        <?php 
                
               echo $_SESSION['message'];
               unset($_SESSION['message']);
               
           ?>
    <?php }?>

        <br><br><br>
        <br><br><br>
        <div class="container">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-sm-12 col-lg-6 login-container">
                    <h4 class="display-4">Log In</h4>
                    <br>
                    <form name="loginform" action="" method=post>
                        <div class="form-group col-12">
                            <label for="inputEmail">Email Address: </label>
                            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email Address" required>
                            <br>
                            <label for="inputPassword">Password: </label>
                            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                            <br><br>
                            <button type="submit" name=login class="btn btn-primary btn-md">Log In</button>
                        </div>
                    </form>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>








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
</html>