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
        $cod=false;

      

        if(isset($_SESSION['UserLogIn'])&&($_SESSION['Access']=="User")){    
            $signup=true;

            $sql = "SELECT * FROM tbluser";
            $users = $con->query($sql) or die ($con->error);
            $row = $users->fetch_assoc();
    
            $sql = "SELECT * FROM tblinventory";
            $prod = $con->query($sql) or die ($con->error);
    
    
            $id=$_SESSION['ID'];
    
            $sql=  "SELECT * FROM `tbltransaction` WHERE `Status`='Added to cart' AND `userID` ='$id'";
            $transaction = $con->query($sql) or die ($con->error);

            $sql=  "SELECT * FROM `tbltransaction` where `Status`='Added to cart' AND `userID` ='$id'";
            $tran = $con->query($sql) or die ($con->error);

            
            $sql=  "SELECT Quantity FROM `tbltransaction` WHERE `Status`='Added to cart' AND `userID` ='$id'";
            $quantity = $con->query($sql) or die ($con->error);
            $rows = $quantity->fetch_assoc();
         
            $prodid=isset($rows['transactionID']);

           
            if(isset($_GET['btndel'])){
                $orderID=$_GET['btndel'];
               
                $id=$_SESSION['ID'];
                $sql= "SELECT * FROM `tbltransaction` WHERE `transactionID`='$prodid' AND `userID`='$id' AND `Status`='Added to cart'";
                $con->query($sql) or die ($con->error);
                $data = $con->query($sql) or die ($con->error);
                $rows = $data->fetch_assoc();
                $transacID=isset($row['transactionID']);
                $quan=isset($rows['Quantity']);

                // $sql= "UPDATE tblinventory inner join tbltransaction on tblinventory.productID = tbltransaction.productID SET tblinventory.quantity=tblinventory.quantity+'$quan' where tbltransaction.transactionID=$prodid";
                // $con->query($sql) or die ($con->error);

                $sql= "DELETE FROM `tbltransaction` WHERE `transactionID`='$orderID'";
                $con->query($sql) or die ($con->error);
                $_SESSION['message'] = "<script>
                    $(function() {
                        $.notify({
                            message: 'Item has been removed to cart!' 
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

                echo header("Refresh:4; url=cart.php");
            }
            if(isset($_GET['buy'])){
                $orID=$_GET['buy'];
             
                $sql="SELECT * FROM `tbltransaction` where transactionID='$orID'";
                $transac=$con->query($sql) or die ($con->error);
                $row= $transac->fetch_array();

                $img=$row['photo'];
                $prodname=$row['productName'];
                $price=$row['Price'];
                $total=$row['Total'];
                $quan=$row['Quantity'];
                $prodid=$row['productID'];

                $sql="SELECT quantity FROM `tblinventory` where productID='$prodid'";
                $order=$con->query($sql) or die ($con->error);
                $row= $order->fetch_array();
                $itemleft=$row['quantity'];
              
                   
                if(isset($_POST['cod'])){

                            $prod=$_POST['prod'];
                            $quantity=$_POST['quant'];
                            $price=$_POST['price'];
                            $itemleft=$_POST['itemleft'];
                            $date=date('F d, Y');
                            $id=$_SESSION['ID'];
                            $fname=$_SESSION['firstname'];
                            $lname=$_SESSION['lastname'];
                            date_default_timezone_set('Asia/Manila');
                            $time=date("h:i a");
                            $photo=$_POST['photo'];
                            $total=$price*$quan;

                            
                       
                                $sql= "UPDATE `tblinventory` SET `quantity`=`quantity`-'$quantity', `itemsold`=`itemsold`+'$quantity' where `productID`=$prodid";
                                $con->query($sql) or die ($con->error);
                                $sql="UPDATE tbltransaction set `Status`='Purchased', `Payment`='COD' where transactionID=$orID";
                                $con->query($sql) or die ($con->error);

                                $_SESSION['message'] = "<script>
                                $(function() {
                                    $.notify({
                                        message: 'Security Advisory: Lifestyle Clothing Co. Sellers are NOT allowed to ask you to order and transact your payments outside the platform. When using our Cash on Delivery service, payment is given to our official delivery partner upon receipt of item.' 
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

            echo header("Refresh:4; url=user-account.php");
                               
                            
                }

                if(isset($_POST['online'])){

                    $prod=$_POST['prod'];
                    $quantity=$_POST['quant'];
                    $price=$_POST['price'];
                    $itemleft=$_POST['itemleft'];
                    $date=date('F d, Y');
                    $id=$_SESSION['ID'];
                    $fname=$_SESSION['firstname'];
                    $lname=$_SESSION['lastname'];
                    date_default_timezone_set('Asia/Manila');
                    $time=date("h:i a");
                    $photo=$_POST['photo'];
                    $total=$price*$quan;

                    if($itemleft=="0"){
                        $_SESSION['message'] = "<script>
                    $(function() {
                        $.notify({
                            message: 'Sorry the item is out of stock!' 
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

                        echo header("Refresh:4; url=home.php");
                    }
                    else if($quantity=="0"){
                        $_SESSION['message'] = "<script>
                        $(function() {
                            $.notify({
                                message: 'Please select quantity!' 
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
    
                        echo header("Refresh:4; url=home.php?select=".$row['productID']);
                    }
                    else{
               
                        $sql= "UPDATE `tblinventory` SET `quantity`=`quantity`-'$quantity', `itemsold`=`itemsold`+'$quantity' where `productID`=$prodid";
                        $con->query($sql) or die ($con->error);
                        $sql="UPDATE tbltransaction set `Status`='Purchased', `Payment`='Online Payment' where transactionID=$orID";
                        $con->query($sql) or die ($con->error);
                        $_SESSION['message'] = "<script>
                    $(function() {
                        $.notify({
                            message: 'Thank you for buying!' 
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

                        echo header("Refresh:4; url=https://www.paypal.com/ph/signin");
                    }
                 }
                 

            
            }
           
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
    
                        
                        // echo header("Refresh:1; url=LogOut.php?".$_SESSION['ID']);
                    
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
        else if(isset($_SESSION['UserLogIn'])&&($_SESSION['Access']=="Admin"&&"Supervisor")){
            echo header("Location: accounts.php");
        }
       
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LLC | <?php echo $_SESSION['firstname']."'s"?> Cart</title>
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
                   
                    <?php if($signup==true){?>
                    <li class="nav-item" id="account">
                    <div class="navbar-collapse" id="navbar-list-4">
                        <ul class="navbar-nav">
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

    <?php if (isset($_SESSION['UserLogIn'])){ ?>
 <!-- ALERT -->
 <?php if(isset($_SESSION['message'])){?>
           <?php 
               echo $_SESSION['message'];
               unset($_SESSION['message']);
           ?>
    
    <?php }?>
    <br><br>

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
                <div class="row">
                <div class="col-12">
                <h1><?php echo $_SESSION['firstname']." ".$_SESSION['lastname'];?>
                    <h6 class="text-left">&nbsp<?php echo $_SESSION['UserLogIn']?></h6>
                    <h5 class="text-left">&nbspID: #<?php echo $_SESSION['ID']?></h5>
                        </div>
                </div>
        </div>
                    
               
 </div>
<hr>
   
    <?php if(isset($_GET['buy'])){?>  
       
     <!-- CHECKOUT -->
  <form method=post>
     <div class="container checkout">
        <div class="row">
            <div class="col-sm-12 col-md-4 checkout-image-container mx-auto">
                <img src="<?php echo "images/products/".$img?>" alt="" class="img-fluid">
            </div>
            <div class="col-sm-12 col-md-8 mx-auto">
                <div class="row">
                    <h3><?php echo $prodname?></h3>
                </div>
                <br>
                <div class="row">
                    <div class="col-4">
                        <p class="lead">Unit Price:</p>
                        <div style="display: flex">
                        <h4>Php.&nbsp;</h4><h4 class="checkout-unit-price"><?php echo $price?> <h4>.00</h4>
                        </div>
                    </div>
                    <div class="col-4">
                        <?php if($itemleft==0) { ?>
                                <p class="lead" style="color: red">Out of stock: </p>
                        <?php }else {?>
                                    <p class="lead">Quantity: </p>
                        <?php }?>
                       
                        <div class="quantity-counter">
                            <button id=btnadd  onclick="addQuantity()"><img src="images/buttons/add.png" alt=""></button>
                            <input type="number" name="" id="number" step="1" value="<?php echo $quan?>" min="0" max="<?php echo $itemleft?>" readonly class="checkout-quantity">
                            <button id=btnminus onclick="subtractQuantity()"><img src="images/buttons/subtract.png" alt=""></button>
                        </div>

                        
                        <input type=hidden name=orderID value="<?php echo $prodid?>">
                        <input type=hidden name=quant value="<?php echo $quan?>">
                        <input type=hidden name=photo value="<?php echo $img ?>">
                        <input type=hidden name=prod value="<?php echo $prodname?>">
                        <input type=hidden name=price value="<?php echo $price?>">
                        <input type=hidden name=itemleft value="<?php echo $itemleft?>">
                    </form>
            
                    </div>
                    <div class="col-4">
                        <p class="lead">Total Item Price: </p>
                        <div style="display: flex">
                        <h4>Php.&nbsp;</h4><h4 class="checkout-total-item-price"><?php echo $quan*$price?></h4><h4>.00</h4>
                        </div>
                    </div>
                </div>
                <br>
                <hr>
                <br>    

                <div class="row">
                    <div class="col-12">
                        <p class="lead">Customer Name: <?php echo $_SESSION['firstname']." ".$_SESSION['lastname']?></p>
                        <p class="lead">Shipping Address: <?php echo $_SESSION['houseno']." ".$_SESSION['street']." ".$_SESSION['brgy']." ".$_SESSION['city']." ".$_SESSION['prov']?></p>
                        <p class="lead">Contact Number: <?php echo $_SESSION['contact']?></p>
                    </div>
                </div>

                <br>
                <hr id=pay>
                <br> 
                <div class="row">
                    <div class="col-12">
                        <p class="lead">Select Payment Method: </p>
                    </div>
                    <div class="col-6">
                       <button type=submit class="btn btn-block btn-primary" id="btn-cod"  name=cod >Cash On Delivery <i class="fas fa-truck align-middle"></i></button>
                    </div>
                    <div class="col-6">
                  <button type=submit class="btn btn-block btn-success" id="btn-express" name=online  >Express Payment <i class="fab fa-bitcoin align-middle"></i></button></a>
                    </div>
                </div>
                <br><br>
                 
    
                <!-- EXPRESS PAYMENT -->
                <div id="online">
                    <div class="row checkout-express">
                        <br><br>
                    
                        <br><br>
                        <div class="col-3 bank-logo-container mx-auto">
                                <img src="images/payment/paypal logo.png" alt="">
                        </div>
                        <div class="col-3 bank-logo-container mx-auto">
                                <img src="images/payment/master-card logo.png" alt="" style="width: 120px">
                        </div>
                        <div class="col-3 bank-logo-container mx-auto">
                                <img src="images/payment/visa logo.png" alt="">
                        </div>
                        <div class="col-3 bank-logo-container mx-auto">
                                <img src="images/payment/gcash.png" style="width: 85px" alt="">
                        </div>
                    </div>
                    <br><br>
               
                </div>

        </div>
       
    </div>
</div>
                            
    <br><br><br>
 </div>
            <?php } else{ ?>  
</form>
                           
    <!-- CART-ITEMS -->
   <?php if($tran->fetch_array()>0){?>
    <div class="container text-center">
        <div class="row">
            <div class="col-12">
                <h4 class="display-3">Shopping Cart</h4>
            </div>
        </div> 
        <br><br>   
        <div class="row table-responsive table-container">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">&nbsp&nbsp</th>
                        <th scope="col">Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Price</th>
                        <th scope="col" style="z-index: 1;">Quantity</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Cancel</th>
                    </tr>
                </thead>
 		<?php while($row = $transaction->fetch_array()){ ?>
                <tbody class="cart-items-container">
                    <tr class="cart-item-row">
                    <label class="check">

                        <td scope="row" class="cart-item-name align-middle">
                            <a href="cart.php?buy=<?php echo $row['transactionID'];?>"><input type=hidden name=orderID  value="<?php echo $row['transactionID'];?>">
                            <button type=submit style=form-control name=buy id=btndel><img src="images/buttons/payment-method.png"></button>
                        </td>     

                        <td class="align-middle">
                            <img src="<?php echo 'images/products/'.$row['photo']?>"width="90" height="90" class="cart-item-image">
                        </td>
                        <input type=hidden name=photo value=<?php echo $row['photo'];?>>
                       <input type=hidden name=productID value=<?php echo $row['productID'];?>>
                       <input type=hidden name=quan value=<?php echo $row['Quantity'];?>>
                       <input type=hidden name=productname value=<?php echo $row['productName'];?>>
                       <input type=hidden name=price value=<?php echo $row['Price'];?>>
                       <input type=hidden name=total value=<?php echo $row['Total'];?>>
                        <td class="cart-item-name align-middle"><?php echo $row['productName'];?></td>
                        <td class="cart-item-price align-middle">₱<?php echo $row['Price'];?>.00</td>
                        <td class="align-middle">
                        
                          <?php echo $row['Quantity'];?>
                            </div>
                        </td>
                        <td class="cart-item-total-price align-middle">₱<?php echo $row['Total'];?>.00</td>
                        <td class="align-middle">
                        <a href="cart.php?btndel=<?php echo $row['transactionID'];?>"><input type=hidden name=transactID value=<?php echo $row['transactionID'];?>>
                           <button type=submit style=form-control name=btndel id=btndel><i class="far fa-trash-alt"></i></button>
                        </td>
                    </tr>
			<?php } ?>

                </tbody>
            </table>
         </div>
        </div>
        <br>
        <hr>
   
    </div>
    <?php } else{?>
        <div class="container text-center">
            <div class="row">
                <div class="col-12">
                    <h1 class="display-3">Your Cart is Currently Empty!</h1>
                    <h5 class="display-5">Go to home to add items here</h1>
                </div>
            </div> 
           
                <img src="images/background/empty cart.png" style="max-width: 100%">
              
    </div>
    </div>
    
    <?php } ?> 
    <br><br>
    <?php } ?>  

    <?php } else {echo header("Location: LogIn.php")?>
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
                   <p>Copyright © 2021 | All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>
    
    
</body>
    <script src="js/script.js"></script>
    <script>
        jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
    jQuery('.quantity').each(function() {
      var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');

      btnUp.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

      btnDown.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

    });

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
    <script src= script.js>
    </script>
  
</html>