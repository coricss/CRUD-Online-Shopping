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
        $signup=false;

      
         
        $sql = "SELECT * FROM tbluser";
        $users = $con->query($sql) or die ($con->error);
        $row = $users->fetch_assoc();

        $sql = "SELECT * FROM tblinventory where `type`='Tops' AND `category`='Women' order by rand() LIMIT 9";
        $data1 = $con->query($sql) or die ($con->error);
        $sql = "SELECT * FROM tblinventory where `type`='Bottoms' AND `category`='Women' order by rand() LIMIT 9";
        $data2 = $con->query($sql) or die ($con->error);
        $sql = "SELECT * FROM tblinventory where `type`='Dress' AND `category`='Women' order by rand() LIMIT 9";
        $data3 = $con->query($sql) or die ($con->error);

        $sql=  "SELECT * FROM tbltransaction";
        $transaction = $con->query($sql) or die ($con->error);
        

if(isset($_SESSION['UserLogIn'])&&($_SESSION['Access']=="User")){
    $signup=true;
    $user=$_SESSION['ID'];
    
    $sql="SELECT COUNT(tbltransaction.`transactionID`) AS 'NOTIF' FROM `tbltransaction` INNER JOIN `tbluser` ON `tbltransaction`.`userID`=`tbluser`.`userID` WHERE tbltransaction.`Status`='Added to cart' AND tbltransaction.`userID`='$user'";
    $cart = $con->query($sql) or die ($con->error);
    $notif = mysqli_fetch_assoc($cart);
    $count=$notif['NOTIF'];

    $photo=$row['photo'];
    if(isset($_GET['select'])){

        $ID=$_GET['select'];

        $sql = "SELECT * FROM tblinventory where productID=$ID";
        $pic = $con->query($sql) or die ($con->error);
        $row = $pic->fetch_assoc();
        $img=$row['photo'];
        $prodname=$row['productName'];
        $price=$row['price'];
        $left=$row['quantity'];
        $desc1=$row['itemdesc1'];
        $desc2=$row['itemdesc2'];
        $desc3=$row['itemdesc3'];

        if(isset($_POST['add'])){
            
            
            $quantity = $_POST['quan'];
            $prod=$_POST['prod'];
            $price=$_POST['price'];
            $itemleft=$_POST['itemleft'];
            $date=date('F d, Y');
            $id=$_SESSION['ID'];
            $fname=$_SESSION['firstname'];
            $lname=$_SESSION['lastname'];
            $time=date("h:i a");
            $photo=$_POST['photo'];
            $total=$price*$quantity;

            if($itemleft=="0"){
                $_SESSION['message']="We're sorry the item is out of stock";
                $_SESSION['msg_type']="danger";
                echo header("Refresh:1; url=home.php");
            }
            else if($quantity=="0"){
                $_SESSION['message']="Please select quantity";
                $_SESSION['msg_type']="danger";
                echo header("Refresh:1; url=home.php?select=".$row['productID']);
            }
            else{
            

            $sql= "INSERT INTO `tbltransaction`(`transactionID`, `userID`, `productID`, `customerName`, `productName`, `photo`, `Price`, `Quantity`, `Total`, `Time`, `Date`,  `Status`) VALUES ('', '$id', '$ID','$fname $lname','$prod', '$photo', '$price', '$quantity', '$total', '$time', '$date', 'Added to cart')";
            $con->query($sql) or die ($con->error);
            
            echo header("Refresh:1; url=cart.php");
            }
        }
        // $sql= "UPDATE tblinventory SET quantity=quantity-'$quantity' where productID=$ID";
        //     $con->query($sql) or die ($con->error);
           
    }
   
    
}
else if(isset($_SESSION['UserLogIn'])&&($_SESSION['Access']=="Admin"&&"Supervisor")){
    echo header("Location: accounts.php");
}
else{

    if(isset($_GET['select'])){

        $ID=$_GET['select'];

        $sql = "SELECT * FROM tblinventory where productID=$ID";
        $pic = $con->query($sql) or die ($con->error);
        $row = $pic->fetch_assoc();
        $img=$row['photo'];
        $prodname=$row['productName'];
        $price=$row['price'];
        $left=$row['quantity'];
        $desc1=$row['itemdesc1'];
        $desc2=$row['itemdesc2'];
        $desc3=$row['itemdesc3'];

        if(isset($_POST['add'])||isset($_POST['buy'])){
            echo header("Refresh:0; url=LogIn.php");
        }
        

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LLC | Women</title>
    <link rel="shortcut icon" type=image/x-icon href=images/icon.png>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <script src="js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.js"></script>
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
                                <a href="women.php" class="nav-link dropbtn active-women" id=women>Women</a>
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
                    <?php } else{ ?>
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
                                <a href="women.php" class="nav-link dropbtn active-women" id=women>Women</a>
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
                            <style>.cart-button:before {content: "<?php echo $count ?>"}</style>
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
    <br><br>




    <!-- BANNER WOMEN -->
    <div class="container">
        <div class="row">
            <div class="col-12 women banner-image-container">
                <h4 class="display-4">Women's Outfits</h4>
                <form action=home.php method=get>
                <div class="search-boxwomen">
                    <input class="search-input" name=searchitem  value="" type="text" placeholder="Search something..">
                    <button class="search-btn"><i class="fas fa-search"></i></a></button>
                    <?php if (isset($_SESSION['UserLogIn'])){ ?>
                        <a href="cart.php" class="nav-link cart-button">
                                <i class="fas fa-shopping-cart" style="font-size: 25px"></i>
                            </a>
                        <?php } else{?>
                            <a href="LogIn.php" class="nav-link cart-button">
                                <i class="fas fa-shopping-cart" style="font-size: 25px"></i>
                            </a>
                            <?php }?>
                </div>
            </form>
            </div>
        </div>
    </div>
    <br><br><br>





    <!-- PRODUCT CAROUSEL -->
    <div class="container">
        <div class="header-container">
            <span class="header">Women's Tops</span>
        </div>
        <br><br><br>
       
        <div class="row text-center">
        
            <div class="col-12">
                <div class="owl-carousel owl-theme">
                    
                <?php while($row = $data1->fetch_array()){ ?>
                    <div class="item">
                        <div class="item-container">
                        <div class="item-image-container">
                        <a href="home.php?select=<?php echo $row['productID']?>"><button type=submit name=select id=select><img src="<?php echo "images/products/".$row['photo']?>" alt=""></button></a>
                            <?php if($row['category']=="Men"){?>
                                    <div class="shape men"><?php echo "₱".$row['price']?></div>
                                <?php } else if($row['category']=="Women"){?>
                                    <div class="shape women"><?php echo "₱".$row['price']?></div>
                                <?php } else if($row['category']=="Kids"){?>
                                    <div class="shape kids"><?php echo "₱".$row['price']?></div>
                                <?php }?>
                    
                        </div>
                        
                             <div class="item-description-container">
                                <h5><?php echo $row['productName']?></h5>
                                <p><?php echo $row['itemdesc1']?></p>
                        </div>
                        </div>
                       
                           
                    </div>
                    <?php } ?>
                    </div>
                    <div class="row text-center">
                        <div class="col-12">
                        <a href="women-top.php"><button class="btn btn-primary btn-md">See More</button></a>
                        </div>
                     </div>
                </div>
                
            </div>
                </div>
    
    <br><br><br>



    

    <!-- PRODUCT CAROUSEL -->
    <div class="container">
        <div class="header-container">
            <span class="header">Women's Bottoms</span>
            </div>
        <br><br><br>
       
        <div class="row text-center">
        
            <div class="col-12">
                <div class="owl-carousel owl-theme">
                    
                <?php while($row = $data2->fetch_array()){ ?>
                    
                    <div class="item">
                        <div class="item-container">
                        <div class="item-image-container">
                        <a href="home.php?select=<?php echo $row['productID']?>"><button type=submit name=select id=select><img src="<?php echo "images/products/".$row['photo']?>" alt=""></button></a>
                            <?php if($row['category']=="Men"){?>
                                    <div class="shape men"><?php echo "₱".$row['price']?></div>
                                <?php } else if($row['category']=="Women"){?>
                                    <div class="shape women"><?php echo "₱".$row['price']?></div>
                                <?php } else if($row['category']=="Kids"){?>
                                    <div class="shape kids"><?php echo "₱".$row['price']?></div>
                                <?php }?>
                    
                        </div>
                        
                             <div class="item-description-container">
                                <h5><?php echo $row['productName']?></h5>
                                <p><?php echo $row['itemdesc1']?></p>
                        </div>
                        </div>
                       
                           
                    </div>
                    <?php } ?>
                </div>
                    <div class="row text-center">
                        <div class="col-12">
                        <a href="women-bottom.php"><button class="btn btn-primary btn-md">See More</button></a>
                        </div>
                     </div>
                </div>
                
            </div>
                </div>
    
    <br><br><br>





    <!-- PRODUCT CAROUSEL -->
    <div class="container">
        <div class="header-container">
            <span class="header">Women's Dress</span>
            </div>
        <br><br><br>
       
        <div class="row text-center">
        
            <div class="col-12">
                <div class="owl-carousel owl-theme">
                    
                <?php while($row = $data3->fetch_array()){ ?>
                    <div class="item">
                        <div class="item-container">
                        <div class="item-image-container">
                        <a href="home.php?select=<?php echo $row['productID']?>"><button type=submit name=select id=select><img src="<?php echo "images/products/".$row['photo']?>" alt=""></button></a>
                            <?php if($row['category']=="Men"){?>
                                    <div class="shape men"><?php echo "₱".$row['price']?></div>
                                <?php } else if($row['category']=="Women"){?>
                                    <div class="shape women"><?php echo "₱".$row['price']?></div>
                                <?php } else if($row['category']=="Kids"){?>
                                    <div class="shape kids"><?php echo "₱".$row['price']?></div>
                                <?php }?>
                    
                        </div>
                        
                             <div class="item-description-container">
                                <h5><?php echo $row['productName']?></h5>
                                <p><?php echo $row['itemdesc1']?></p>
                        </div>
                        </div>
                       
                           
                    </div>
                    <?php } ?>
                    </div>
                    <div class="row text-center">
                        <div class="col-12">
                        <a href="women-dress.php"><button class="btn btn-primary btn-md">See More</button></a>
                        </div>
                     </div>
                </div>
                
            </div>
                </div>
    
    <br><br><br>







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