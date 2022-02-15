<?php

if(!isset($_SESSION)){
  session_start();
  
}

include_once("connections/connect.php");
$con=connect();

       
        $signup=false;
       
        // $mysqli=new mysqli('localhost', 'root', '','onlineorderingsystem') or die ($mysqli_error($mysqli));
         
        $sql = "SELECT * FROM tbluser";
        $users = $con->query($sql) or die ($con->error);
        $row = $users->fetch_assoc();
        $id=$_SESSION['ID'];

        $sql=  "SELECT * FROM `tbltransaction` WHERE `Status`='Purchased' AND `userID` ='$id'";
        $transaction = $con->query($sql) or die ($con->error);

        $sql=  "SELECT * FROM `tbltransaction` WHERE `Status`='Purchased' AND `userID` ='$id'";
        $tran = $con->query($sql) or die ($con->error);

if(isset($_SESSION['UserLogIn'])&&($_SESSION['Access']=="User")){
    $signup=true;
    //  
  
    //   echo "try";
    $sql="SELECT COUNT(tbltransaction.`transactionID`) AS 'NOTIF' FROM `tbltransaction` INNER JOIN `tbluser` ON `tbltransaction`.`userID`=`tbluser`.`userID` WHERE tbltransaction.`Status`='Added to cart' AND tbltransaction.`userID`='$id'";
    $cart = $con->query($sql) or die ($con->error);
    $notif = mysqli_fetch_assoc($cart);
    $count=$notif['NOTIF'];

        if(isset($_POST['update'])){
            
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
            else{
             $update_filename=$old_img;
            }

            if (!in_array($file_ext, $allowed_ext)){
                $_SESSION['message'] = "<script>
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
                    type: 'danger',
                  
                });
            });
            </script>";
                
               
            }
            else{
            if($_FILES['profileImg']['name']!=''){
                if(file_exists("images/avatars/".$_FILES['profileImg']['name'])){
                    $_SESSION['message'] = "<script>
                    $(function() {
                        $.notify({
                            message: 'Please upload new photo!' 
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
                else{
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
                    $_SESSION['message'] = "<script>
                    $(function() {
                        $.notify({
                            message: 'Your photo has been updated!' 
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
                    
                    // echo header("Refresh:1; url=LogOut.php?".$_SESSION['ID']);
                    echo header("Refresh:1; url=user-account.php");
                }
            }
            else{
                $_SESSION['message'] = "<script>
                $(function() {
                    $.notify({
                        message: 'Please click the camera to change photo!' 
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
                echo header("Refresh:1; url=user-account.php");
            }
        }
        
        }

      
    }
    else if(isset($_SESSION['UserLogIn'])&&($_SESSION['Access']=="Admin"&&"Supervisor")){
        echo header("Location: accounts.php");
    }
        

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LLC | <?php echo $_SESSION['firstname']." ".$_SESSION['lastname'];?></title>
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
                    <?php if (isset($_SESSION['UserLogIn'])){ ?>
                        <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a href="men.php" class="nav-link dropbtn">Men</a>
                        <div class="dropdown-content">
                            <a href="men-top.php">Top</a>
                            <a href="men-bottom.php">Bottom</a>
                            <a href="men-formal-attire.php">Formal Attire</a>
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
                            <a href="cart.php" class="nav-link cart-user"><i class="fas fa-shopping-cart"></i></a>
                    </li>
                    <?php } else{ ?>
                        <?php echo header("Location: LogIn.php")?>
                    <?php }?>

                    
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
                                <a href="user-account.php" class="dropdown-item"><i class="fas fa-shopping-bag"></i> &nbspMy Orders</a>
                                <a href="LogOut.php?logout=<?php echo $_SESSION['ID']?>" class="dropdown-item" name=logout><span class="fas fa-sign-out-alt"></span>&nbsp&nbspLogout</a>
                                </div>
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
                    
                    <li class="nav-item" id="signup">
                        <a href="sign-up.php"  class="nav-link">Sign Up</a>
                    </li>
                    <?php }?>


                    <?php if (isset($_SESSION['UserLogIn'])){ ?>
                        <?php if($count!='0'){?>
                            <style>.cart-user:before {content: "<?php echo $count ?>"}</style>
                        <?php }?>

                    <li class="nav-item">
                     <a href="user-account.php"  class="nav-link"><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></a>
                    </li>
                    <?php } else { ?>
                        <li class="nav-item">
                        <a href="LogIn.php" class="nav-link">Login</a>
                    </li>
                    <?php }?>
                    </li>
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
    <br><br>


    <!-- USER ACCOUNT -->
    <div class="container ua-container">
        <div class="row">
            <div class="col-10 ua-image">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="file" name="profileImg" id="profileImg" onChange="displayImg(this)" class="form-control" style="display: none;">
                    <div class=try>
                        <div class=camera onclick=triggerClick()><center><div class="fas fa-camera align-middle" style="color: black"></div><center></div>
                             <a href="<?php echo 'images/avatars/'.$_SESSION['photo']?>"><img src="<?php echo 'images/avatars/'.$_SESSION['photo']?>" id="profileDis" width=30px height=30px alt=""></a>
                    </div>
                    <input type="hidden" name="photo" id="photo" placeholder="" value="<?php echo $_SESSION['photo']; ?>">
                    <div class="text-center img-place img-di">
                    
                         <h6><button type=submit id=update name=update>Update Image</button></h6>
                    </div>
                </form>
        
               </h1>
                    <div class="row ">
                        <div class="col-12">
                            <h1><?php echo $_SESSION['firstname']." ".$_SESSION['lastname'];?>
                            
                                <h6 class="text-left">&nbsp<?php echo $_SESSION['UserLogIn']?></h6>
                                <h5 class="text-left">&nbspID: #<?php echo $_SESSION['ID']?></h5>
                        </div> 
                    </div>
            </div>         
        </div>
    </div>
        <hr>
      
        <?php if($tran->fetch_array()>0){?>
            <div class="row text-center">
            <div class="col-12">
                <h4 class="display-3">My Orders</h4>
            </div>
        </div> 
   
    <div class="container text-center">
        <br><br>   
        <div class="row table-responsive table-container">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col" style="z-index: 1;">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Payment Method</th>
                    </tr>
                </thead>
 		    <?php while($row = $transaction->fetch_array()){ ?>
                <tbody class="cart-items-container">
                    <tr class="cart-item-row">
                        <td class="align-middle">
                            <img src="<?php echo 'images/products/'.$row['photo']?>"width="90" height="90" class="cart-item-image">
                        </td>
                        <td class="cart-item-name align-middle"><?php echo $row['productName'];?></td>
                        <td class="cart-item-price align-middle"><?php echo $row['Quantity'];?></td>
                        <td class="cart-item-price align-middle"><?php echo "Php ".$row['Total'].".00";?></td>
                        <td class="align-middle"><?php echo $row['Date'];?></td>
                        <td class="cart-item-total-price align-middle"><?php echo $row['Time'];?></td>
                        <td class="cart-item-price align-middle"><?php echo $row['Payment'];?></td>
                    </tr>
			<?php } ?>

                </tbody>
            </table>
        
        </div>
    </div>
    <br><br><br><br><br><br><br><br><br><br>
    
    <?php } else{?>
        <div class="container text-center">
            <div class="row">
                <div class="col-12">
                    <h1 class="display-3">No Purchase Found!</h1>
                    <h5 class="display-5">There are no orders yet.</h5>
                </div>
            </div> 
       
                <img src="images/background/emptyorders.png" style="max-width: 100%">
             
    </div>
            <?php } ?>

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
                    <p>Copyright &copy; 2021 | All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>
</body>
<script>
     function triggerClick(e) {
            document.querySelector('#profileImg').click();
            }
    function displayImg(e) {
            if (e.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e){
                document.querySelector('#profileDis').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(e.files[0]);
            }
            }
</script>
</html>