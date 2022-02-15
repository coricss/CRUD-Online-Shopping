
<?php

if(!isset($_SESSION)){
  session_start();
  
}

include_once("connections/connect.php");
$con=connect();

        $id=0;
        $prod = "";
        $photo = "";
        $type = "";
        $category = "";
        $sub = "";
        $price = "";
        $quantity="";
        $desc1="";
        $desc2="";
        $desc3="";
        $update=false;
        $User=false;
        $signup=false;

      
         
        $sql = "SELECT * FROM tblinventory";
        $inventory = $con->query($sql) or die ($con->error);
     



//Admin login
if(isset($_SESSION['UserLogIn'])&&($_SESSION['Access']=="Admin")){
  $signup=true;
  //SEARCH
  if(isset($_POST['searchitem'])){ 
    $searchkey=$_POST['searchitem'];
    $sql = "SELECT * FROM tblinventory WHERE `productID` like '%$searchkey%' OR `productName` LIKE '%$searchkey%' OR `type` like '%$searchkey%' OR `category` like '%$searchkey%' OR `subcategory` like '%$searchkey%' OR `itemdesc1` like '%$searchkey%' OR `itemdesc2` like '%$searchkey%' OR `itemdesc3` like '%$searchkey%'";
    $inventory = $con->query($sql) or die ($con->error);
    
}
else{
  $sql = "SELECT * FROM tblinventory";
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

//SAVE
if(isset($_POST['save'])){
                   
    
            $prod = $_POST['productname'];
            $type = $_POST['type'];
            $category = $_POST['category'];
            $sub = $_POST['sub'];
            $price = $_POST['price'];
            $quantity=$_POST['quantity'];
            $desc1=$_POST['desc1'];;
            $desc2=$_POST['desc2'];
            $desc3=$_POST['desc3'];
            // $desc3=$_POST['desc3'];
            $ImageName = $_FILES["photo"]['name'];
            $target_file = "images/products/".$ImageName;

            //.JPG .PNG .GIF 
            $allowed_ext=array('gif', 'png', 'jpg', 'jpeg', 'jfif');
            $filename=$_FILES["photo"]['name'];
            $file_ext=pathinfo($filename, PATHINFO_EXTENSION);

            
            $sql= "SELECT * FROM tblinventory where productName = '$prod'";
            $items = $con->query($sql) or die ($con->error);
            $row = $items->fetch_assoc();

             if($prod==""||$price==""||$type=="None"||$category=="None"||$quantity==""||$desc1==""||$desc2==""||$desc3==""){
                $_SESSION['message'] = "<script>
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
            else if(!in_array($file_ext, $allowed_ext)){
                $_SESSION['message'] = "<script>
                        $(function() {
                            $.notify({
                                message: 'Uploaded file is not a valid image. Only JPG, PNG and GIF files are allowed' 
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
            else if($prod==isset($row['productName'])){
                $_SESSION['message'] = "<script>
                        $(function() {
                            $.notify({
                                message: 'Product name already exists' 
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
            if($_FILES['photo']['name']!=''){
                if($_FILES["photo"]['size']>200000){
                    $_SESSION['message'] = "<script>
                        $(function() {
                            $.notify({
                                message: 'Image size should not be greater than 200Kb' 
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
               
                if(file_exists($target_file)) {
                    $_SESSION['message'] = "<script>
                        $(function() {
                            $.notify({
                                message: 'File already exists' 
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
                if (empty($error)) {
                    if(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                    $sql= "INSERT INTO `tblinventory`(`productID`, `photo`, `productName`, `type`, `category`, `subcategory`, `price`, `itemsold`, `quantity`, `itemdesc1`, `itemdesc2`, `itemdesc3`) VALUES ('','$ImageName','$prod','$type','$category','$sub','$price','0', '$quantity', '$desc1', '$desc2', '$desc3')";
                    $con->query($sql) or die ($con->error);
                        $_SESSION['message'] = "<script>
                        $(function() {
                            $.notify({
                                message: 'An item has been added to Inventory' 
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
                    echo header("Refresh:2; url=inventory.php?");
                    }
                    else{
                        $_SESSION['message'] = "<script>
                        $(function() {
                            $.notify({
                                message: 'There was an error uploading the file' 
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
                    }
                }

            }
            else{
                $_SESSION['message'] = "<script>
                        $(function() {
                            $.notify({
                                message: 'Please fill up the form properly' 
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
            }

        }
            
           
}


//DELETE
if(isset($_GET['delete'])){
  $id=$_GET['delete'];
    
    $sql= "SELECT * FROM `tblinventory` WHERE `productID`='$id'";
    $con->query($sql) or die ($con->error);
    $data = $con->query($sql) or die ($con->error);
    $rows = $data->fetch_assoc();
    $total = $data->num_rows;
    $photo = $rows['photo'];
  
    $sql= "DELETE FROM `tblinventory` WHERE `productID`='$id'";
    $con->query($sql) or die ($con->error);
    
    unlink("images/products/".$photo);
    
    $_SESSION['message'] = "<script>
                        $(function() {
                            $.notify({
                                message: 'Item has deleted successfully' 
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

     echo header("Refresh:1; url=inventory.php");
  
}

//EDIT
if(isset($_GET['edit'])){
  $id=$_GET['edit'];
  $update=true;
 
  $sql= "SELECT * FROM tblinventory WHERE `productID`='$id'";
    $items=$con->query($sql) or die ($con->error);
    if($items->num_rows){
    $row = $items->fetch_array();

    $prod = $row['productName'];
    $photo = $row['photo'];
    $type = $row['type'];
    $category = $row['category'];
    $sub = $row['subcategory'];
    $price = $row['price'];
    $quantity=$row['quantity'];
    $desc1=$row['itemdesc1'];;
    $desc2=$row['itemdesc2'];
    $desc3=$row['itemdesc3'];

    
  }
  
  // echo header("Refresh:0; url=UserInformation.php");
}
//UPDATE
if(isset($_POST['update'])){

    $id = $_POST['id'];
    $prod = $_POST['productname'];
    $type = $_POST['type'];
    $category = $_POST['category'];
    $sub = $_POST['sub'];
    $price = $_POST['price'];
    $quantity=$_POST['quantity'];
    $desc1=$_POST['desc1'];;
    $desc2=$_POST['desc2'];
    $desc3=$_POST['desc3'];
  
    $sql= "UPDATE tblinventory SET `productName`='$prod', `type`='$type', `category`='$category', `subcategory`='$sub', `price`='$price', `quantity`='$quantity', `itemdesc1`='$desc1', `itemdesc2`='$desc2', `itemdesc3`='$desc3' WHERE `productID`='$id'";
    $con->query($sql) or die ($con->error);
  
    
    // $target_file = "images/products/".$category."/".$type."/".$sub."/".$new_img;
    $ImageName = $_FILES["photo"]['name'];
    $new_img=$_FILES["photo"]["name"];
    $old_img=$_POST["photo"];

    if($new_img!=''){
        $update_filename=$_FILES['photo']['name'];
    }
    else{
     $update_filename=$old_img;
    }

     if($_FILES['photo']['name']!=''){
        if(file_exists("images/products/".$_FILES['photo']['name'])){
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
            $sql= "UPDATE tblinventory SET `photo`='$ImageName', `type`='$type', `category`='$category', `subcategory`='$sub', `price`='$price', `quantity`='$quantity', `itemdesc1`='$desc1', `itemdesc2`='$desc2', `itemdesc3`='$desc3' WHERE `productID`='$id'";
            $con->query($sql) or die ($con->error);

            if($_FILES['photo']['name']!=''){
                move_uploaded_file($_FILES["photo"]["tmp_name"], "images/products/".$_FILES['photo']['name']);
                unlink("images/products/".$old_img);
            }

            $_SESSION['message'] = "<script>
                        $(function() {
                            $.notify({
                                message: 'Record has been updated!' 
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

            echo header("Refresh:1; url=inventory.php?");
        }
        $_SESSION['message'] = "<script>
                        $(function() {
                            $.notify({
                                message: 'Please fill up form completely!' 
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

    $_SESSION['message'] = "<script>
                        $(function() {
                            $.notify({
                                message: 'Record has been updated!' 
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

    echo header("Refresh:1; url=inventory.php?");
}
//Show admin

}
//Supervisor LogIn
else if(isset($_SESSION['UserLogIn'])&&($_SESSION['Access']=="Supervisor")){
  $user=true;
  $signup=true;
  //SEARCH
  if(isset($_POST['searchitem'])){ 
    $searchkey=$_POST['searchitem'];
    $sql = "SELECT * FROM tblinventory WHERE `productID` like '%$searchkey%' OR `productName` LIKE '%$searchkey%' OR `type` like '%$searchkey%' OR `category` like '%$searchkey%' OR `subcategory` like '%$searchkey%' OR `itemdesc1` like '%$searchkey%' OR `itemdesc2` like '%$searchkey%' OR `itemdesc3` like '%$searchkey%'";
    $inventory = $con->query($sql) or die ($con->error);
    
}
else{
  $sql = "SELECT * FROM tblinventory";
  $searchkey="";
}
  
}
//Guest
else{
    echo header("Refresh:0; url=LogIn.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="shortcut icon" type=image/x-icon href=images/icon.png>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
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
                                <a href="inventory.php" class="dropdown-item active-btn" name=logout><span class="fas fa-tshirt"></span>&nbsp&nbspInventory</a>
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


    <div class="container-fluid">
        
        <br><br><br><br>
        
        <!-- ADMIN AUTHORITY-->
        <?php if(isset($_SESSION['UserLogIn'])&&($_SESSION['Access']=="Admin")){?> 
            
            <?php if((isset($_GET['edit']))||(isset($_GET['add']))){?>
                <div class="container">          
        <div class="row text-center">
            <div class="col-12">
                <h4 class="display-4">Inventory Form</h4><hr>
            </div>
        </div>
        <br><br>

        <div class="container"> 
        <div class="row">
            <div class="col">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-row">

                        <div class="form-group col-sm-12 col-md-4">
                            <label for="photo">Photo: </label>
                            <input type="file" name="photo" id="photo" class="form-control" placeholder="">
                            <input type="hidden" name="photo" id="photo" placeholder="" value="<?php echo $photo; ?>">
                        </div>

                        <div class="form-group col-sm-12 col-md-4">
                            <input type="hidden" name='id' value="<?php echo $id; ?>">
                            <label for="productname">Product Name: </label>
                            <input type="text" name="productname" id="productname" class="form-control" placeholder="Product Name" value="<?php echo $prod; ?>">
                        </div>

                        <div class="form-group col-sm-12 col-md-4">
                            <label for="type">Type:</label>
                            <select name="type" id="type" class="form-control">
                            <?php if(isset($_GET['edit'])){?>
                                <option value="<?php echo $type;?>"><?php echo $type;?></option>
                            <?php }?>
                                <option value="" name='None'>None</option>
                                <option value="Tops" name='Tops'>Tops</option>
                                <option value="Bottoms" name='Bottoms'>Bottoms</option>
                                <option value="Dress" name='Dress'>Dress</option>
                                <option value="Formal Attire" name='Formal Attire'>Formal Attire</option>
                            </select>
                        </div>


                        <div class="form-group col-sm-12 col-md-3">
                            <label for="category">Category:</label>
                            <select name="category" id="category" onClick="selectkids()" class="form-control">
                            <?php if(isset($_GET['edit'])){?>
                                <option value="<?php echo $category;?>"><?php echo $category;?></option>
                            <?php }?>
                                <option value="" name='None'>None</option>
                                <option value="Men" name='Men'>Men</option>
                                <option value="Women" name='Women'>Women</option>
                                <option value="Kids" name='Kids'>Kids</option>
                            </select>
                        </div>

                        <div class="form-group col-sm-12 col-md-3">
                            <label for="sub">If Kids:</label>
                            <select name="sub" id="sub" class="form-control">
                                <?php if(isset($_GET['edit'])){?>
                                    <option value="<?php echo $sub;?>"><?php echo $sub;?></option>
                                <?php }?>
                                <option value="" name='None'>None</option>
                                <option value="Boys" name='Boys'>Boys</option>
                                <option value="Girls" name='Girls'>Girls</option>
                                <option value="Toddlers" name='Toddlers'>Toddlers</option>
                            </select>
                        </div>

                        <div class="form-group col-sm-12 col-md-3">
                            <label for="price">Price: </label>
                            <input type="text" name="price" id="price" class="form-control" maxlength="10" placeholder="Price" onkeypress="return onlyNumberKey(event)" value="<?php echo $price;?>">
                        </div>

                        <div class="form-group col-sm-12 col-md-3">
                            <label for="quantity">Quantity: </label>
                            <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Quantity" value="<?php echo $quantity;?>"> 
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="inputAddress">Item Descriptions: </label>
                        </div>
                        
                        <div class="form-group col-sm-12 col-md-4">
                            <input type="text" name="desc1" class="form-control" id="productdesc1" placeholder="Description 1" value="<?php echo $desc1?>">
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <input type="text" name="desc2"  class="form-control" id="productdesc2" placeholder="Description 2" value="<?php echo $desc2?>">
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <input type="text" name="desc3" class="form-control" id="productdesc3" placeholder="Description 3" value="<?php echo $desc3?>">
                        </div>
                       
                    </div>
                    <br><br>
                    <?php if($update==true){ ?>
                    <div class="form-row">
                        <div class="col-6 mx-auto button-container">
                            <a href="inventory.php#inventoryform"><button type="submit" name="update" class="btn btn-primary btn-md form-control">Update Item <img src=images/buttons/update.png></button></a>
                        </div>
                    </div>
                    <?php }else{ ?>
                    <div class="form-row">
                        <div class="col-6 mx-auto button-container">
                            <button type="submit" name="save" class="btn btn-primary btn-md form-control">Add Item <i class="fa fa-plus-square align-middle" style="font-size: 20px"></i></button>
                        </div>
                    </div>
                    <?php } ?>
                </form>
                </div>
            </div>
        </div>         

        <?php } else { ?>
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
                <h4 class="display-4" id=prods>Products </h4>
                <center>         
                    <form method=post>
                    <div class="search-box">
                         <input class="search-input" value="<?php echo $searchkey?>" name=searchitem type="text" placeholder="Search something.." data-toggle="tooltip" data-placement="top" title="Type to search">
                         <button class="search-btn"><i class="fas fa-search" data-toggle="tooltip" data-placement="top" title="Click to search"></i></button>
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
                            <th scope="col">Product ID</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Types</th>
                            <th scope="col">Category</th>
                            <th scope="col">Sub Category</th>
                            <th scope="col">Item Description</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Item Sold</th>
                            <th scope="col" colspan=2><center>Action</center></th>
                        </tr>
                    </thead>

                    <?php while($row = $inventory->fetch_array()){ ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $row['productID'];?></th>
                            <td><img src="<?php echo 'images/products/'.$row['photo']?>"width="90" height="90"></td>
                            <td><?php echo $row['productName'];?></td>
                            <td><?php echo $row['type'];?></td>
                            <td><?php echo $row['category'];?></td>
                            <td><?php echo $row['subcategory'];?></td>
                            <td>
                                &#9679;<?php echo $row['itemdesc1']; ?><br>
                                &#9679;<?php echo $row['itemdesc2']; ?><br>
                                &#9679;<?php echo $row['itemdesc3']; ?>
                            </td>
                            <td>₱<?php echo $row['price']; ?>.00</td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td><?php echo $row['itemsold']; ?></td>
                            <td>
                            <center>
                                    <div class="table-buttons">
                                        <a href="inventory.php?add=<?php echo $row['productID']?>#inventoryform"><button class="btn btn-primary btn-sm form-control" id=add type=submit name=add data-toggle="tooltip" data-placement="top" title="Click to add"><i class="fas fa-plus"></i></button></a>                
                                        <a href="inventory.php?edit=<?php echo $row['productID']?>#inventoryform"><button class="btn btn-success btn-sm form-control" id=edit type=submit name=edit data-toggle="tooltip" data-placement="top" title="Click to edit"><i class="far fa-edit"></i></button></a>
                                        <a href="inventory.php?delete=<?php echo $row['productID']?>"><button class="btn btn-danger btn-sm form-control" type=submit id=delete name=delete data-toggle="tooltip" data-placement="top" title="Click to delete"><i class="fas fa-trash"></i></button></a>        
                                    </div>
                            </center> 
                            </td>
                        </tr>
                        
                    </tbody>
                    <?php } ?>
                    </table>
                 </div>
         </div>
         
        <?php } ?>
        
                <?php } else if(isset($_SESSION['UserLogIn'])&&($_SESSION['Access']=="Supervisor")){?>
        <!-- SUPERVISOR AUTHORITY -->
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
                <h4 class="display-4" id=accounts>Products</h4> 
                <center>         
                    <form method=post>
                    <div class="search-box">
                         <input class="search-input" value="<?php echo $searchkey?>" name=searchitem type="text" placeholder="Search something.." data-toggle="tooltip" data-placement="top" title="Type to search">
                         <button class="search-btn"><i class="fas fa-search"></i></button>
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
                            <th scope="col">Product ID</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Types</th>
                            <th scope="col">Category</th>
                            <th scope="col">Sub Category</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Item Sold</th>
                        
                        </tr>
                    </thead>

                    <?php while($row = $inventory->fetch_array()){ ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $row['productID'];?></th>
                            <td><img src="<?php echo 'images/products/'.$row['photo']?>"width="90" height="90"></td>
                            <td><?php echo $row['productName'];?></td>
                            <td><?php echo $row['type'];?></td>
                            <td><?php echo $row['category'];?></td>
                            <td><?php echo $row['subcategory'];?></td>
                            <td>₱<?php echo $row['price']; ?>.00</td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td><?php echo $row['itemsold']; ?></td>
                            
                        </tr>
                        
                    </tbody>
                    <?php } ?>
                    </table>
            </div>
                    <?php } ?>
                                <br><br>   
        </div>
    </div>            
    <br><br><br><br> <br><br><br><br> 
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

             function onlyNumberKey(evt) { 
              
              // Only ASCII charactar in that range allowed 
              var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
              if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
              return false; 
              return true;
            }
            
            function myAlertBottom(){
                $(".myAlert-bottom").show();
                setTimeout(function(){
                    $(".myAlert-bottom").hide(); 
                }, 2000);
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