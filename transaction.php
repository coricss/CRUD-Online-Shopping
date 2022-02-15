
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
        $address = "";
        $phone = "";
        $access="";
        $update=false;
        $User=false;
        $signup=false;

      
         

        $sql = "SELECT * FROM tbluser WHERE `Access`='User'";
        $users = $con->query($sql) or die ($con->error);
       // $row = $users->fetch_assoc();
        $sql = "SELECT * FROM tbluser WHERE `Access`='Admin'";
        $admin = $con->query($sql) or die ($con->error);

        $sql = "SELECT * FROM tbluser WHERE `Access`='Supervisor'";
        $supervisor = $con->query($sql) or die ($con->error);

        $sql=  "SELECT * FROM tbltransaction";
        $transaction = $con->query($sql) or die ($con->error);

        $sql = "SELECT * FROM tbluser";
        $all = $con->query($sql) or die ($con->error);
        
        if(isset($_SESSION['UserLogIn'])&&($_SESSION['Access']=="Admin")){
          $signup=true;
          //SEARCH
            if(isset($_POST['searchtrans'])){ 
                $searchkey=$_POST['searchtrans'];
                $sql = "SELECT * FROM tbltransaction WHERE `transactionID` like '%$searchkey%' OR `customerName` like '%$searchkey%' OR `productName` LIKE '%$searchkey%' OR `Time` like '%$searchkey%' OR `Date` like '%$searchkey%' OR `Status` like '%$searchkey%' OR `Payment` like '%$searchkey%'";
                $transaction = $con->query($sql) or die ($con->error);
                
            }
            else{
            $sql = "SELECT * FROM tbltransaction";
            $searchkey="";
            }
            if(isset($_POST['updatepic'])){
            
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
                            type: 'danger'
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
                                type: 'danger'
                            });
                        });
                        </script>";
                   
                }
            }
            
            }

        }
        else if(isset($_SESSION['UserLogIn'])&&($_SESSION['Access']=="Supervisor")){
          $signup=true;

          if(isset($_POST['searchtrans'])){ 
            $searchkey=$_POST['searchtrans'];
            $sql = "SELECT * FROM tbltransaction WHERE `transactionID` like '%$searchkey%' OR `customerName` like '%$searchkey%' OR `productName` LIKE '%$searchkey%' OR `Time` like '%$searchkey%' OR `Date` like '%$searchkey%' OR `Status` like '%$searchkey%' OR `Payment` like '%$searchkey%'";
            $transaction = $con->query($sql) or die ($con->error);
            
        }
        else{
        $sql = "SELECT * FROM tbltransaction";
        $searchkey="";
        }

        if(isset($_POST['updatepic'])){
            
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
                        type: 'danger'
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
                    echo header("Refresh:2; url=transaction.php");
                
                }
            }
            else{
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
                            type: 'danger'
                        });
                    });
                    </script>";
               
            }
        }
        
        }
          } 
          else{
              echo header("Refresh:0 url=LogIn.php");
          }
       

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
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
    <script src="js/bootstrap-notify.min.js"></script>
</head>
<body>

    <!-- NAVIGATION -->
    <nav class="navbar navbar-expand-md sticky-top navigation">
        <div class="container-fluid">
            <a href="accounts.php" class="navbar-brand logo-container"><img src="images/Logo.png" alt="" class="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="fas fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
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
                                <a href="accounts.php?User" class="dropdown-item" name=logout><span class="fas fa-users"></span>&nbsp&nbspUsers</a>
                                <a href="inventory.php" class="dropdown-item" name=logout><span class="fas fa-tshirt"></span>&nbsp&nbspInventory</a>
                                <a href="transaction.php" class="dropdown-item active-btn" name=logout>&nbsp<span class="fas fa-file"></span>&nbsp&nbspTransactions</a>
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
    
    <div class="container-fluid">
        
        <br><br><br><br>
        
        <!-- ADMIN AUTHORITY-->
        <?php if(isset($_SESSION['UserLogIn'])&&($_SESSION['Access']=="Admin")){?>   

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
                <h4 class="display-4" id=accounts>Transaction History</h4>
                <form method=post>
                        <center>
                             <div class="search-box">
                                  <input class="search-input" name=searchtrans value="<?php echo $searchkey?>" type="text" placeholder="Search something.." data-toggle="tooltip" data-placement="top" title="Type to search">
                                  <button type=submit class="search-btn" data-toggle="tooltip" data-placement="top" title="Click to search"><i class="fas fa-search"></i></button>
                              </div>
                         </center>
                </form>
                 <br><br>
            </div>
        </div>
        <div class="row">
            <div class="col-12 table-responsive table-container">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Transaction ID</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Status</th>
                            <th scope="col">Payment</th>
                        </tr>
                    </thead>
                    <?php while($row = $transaction->fetch_array()){ ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $row['transactionID'];?></th>
                            <td><?php echo $row['customerName']?></td>
                            <td><?php echo $row['productName'];?></td>
                            <td>₱<?php echo $row['Price'];?>.00</td>
                            <td><?php echo $row['Quantity'];?></td>
                            <td>₱<?php echo $row['Total'];?>.00</td>
                            <td><?php echo $row['Date'];?></td>
                            <td><?php echo $row['Time'];?></td>
                            <td><?php echo $row['Status']; ?></td>
                            <td><?php echo $row['Payment']; ?></td>
                        </tr>
                        
                    </tbody>
                    <?php } ?>
                    </table>
                                    </div>
                                </div>
                             
        <br><br><br><br><br><br> <br><br><br><br>
       
                <?php } else if(isset($_SESSION['UserLogIn'])&&($_SESSION['Access']=="Supervisor")){?>
        <!-- Supervisor -->
       
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
                <h4 class="display-4" id=accounts>Transaction History</h4> 
                <form method=post>
                        <center>
                             <div class="search-box">
                                  <input class="search-input" name=searchtrans value="<?php echo $searchkey?>" type="text" placeholder="Search something.." data-toggle="tooltip" data-placement="top" title="Type to search">
                                  <button type=submit class="search-btn" data-toggle="tooltip" data-placement="top" title="Click to search"><i class="fas fa-search"></i></button>
                              </div>
                         </center>
                </form>
                
                <br><br>
            </div>
        </div>
        <div class="row">
            <div class="col-12 table-responsive table-container">
                <table class="table table-hover">
                <thead class="thead-dark">
                        <tr>
                            <th scope="col">Transaction ID</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Status</th>
                            <th scope="col">Payment</th>
                        </tr>
                    </thead>
                    <?php while($row = $transaction->fetch_array()){ ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $row['transactionID'];?></th>
                            <td><?php echo $row['customerName']?></td>
                            <td><?php echo $row['productName'];?></td>
                            <td>₱<?php echo $row['Price'];?>.00</td>
                            <td><?php echo $row['Quantity'];?></td>
                            <td>₱<?php echo $row['Total'];?>.00</td>
                            <td><?php echo $row['Date'];?></td>
                            <td><?php echo $row['Time'];?></td>
                            <td><?php echo $row['Status']; ?></td>
                            <td><?php echo $row['Payment']; ?></td>
                        </tr>
                        
                    </tbody>
                    <?php } ?>
                    </table>
                                    </div>
                                </div>
                                <?php } ?>
                                <br><br><br><br> <br><br><br><br>
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
        <script>
                function selectkids(){
                    
                    if(document.getElementById("category").value=="Kids"){
                    document.getElementByID("sub").disabled=false;
                    alert("asd");
                    
                }
                else{
                    document.getElementByID("sub").disabled=true;
                }
        
            }
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