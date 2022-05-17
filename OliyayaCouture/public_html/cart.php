<?php

session_start();


require_once ("php/component.php");

require_once  ('dbConn.php');
/** 49-Creating checkout page with customer login & payment option 1.2020.YouTube video, added by Softmatic Technologie.[Online].Available at:
https://www.youtube.com/watch?v=5ldzpLdXsa8&t=371s [Accessed 29 June 2021] **/
if(isset($_POST['checkout']))
{
if(!isset($_SESSION['email'])){

    header("location:login.php");
		echo "<script>alert('Login or Register your account.')</script>";
}
if(isset($_SESSION['email'])){
	header("location:Checkout.php");
}
}

if (isset($_POST['remove'])){
  if ($_GET['action'] == 'remove'){
      foreach ($_SESSION['cart'] as $key => $value){
          if($value["pid"] == $_GET['id']){
              unset($_SESSION['cart'][$key]);
              echo "<script>alert('Product has been Removed...!')</script>";
              echo "<script>window.location = 'cart.php'</script>";
          }
      }
  }
}
if (isset($_POST['clear'])){
  if ($_GET['action'] == 'clear'){
      foreach ($_SESSION['cart'] as $key => $value){
          
              unset($_SESSION['cart'][$key]);
              echo "<script>alert('Cart has been cleared...!')</script>";
              echo "<script>window.location = 'cart.php'</script>";
          
      }
  }
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
      <link rel="stylesheet" href="cart.css">
	 
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

   
</head>
<body  style="background-color:black;>
 <script type="text/javascript" src="js/quantity.js"></script>
<?php
    require_once ('php/header.php');
	
{
  
}
	
?>
 <img src="logo1.png" alt="centered image" width="400" style="display: block; margin-left: auto; margin-right: auto;" />

<div class="container-fluid">
    <div class="row px-5">
        <div class="col-md-7">
            <div class="shopping-cart">
			<div class="1"  style="color:white";>
                <h6>My Cart </h6>
                
            
				</div>	
                <?php
				include ('dbConn.php');

                $total = 0;
				$finalTotal=0;
				$delivery= 150;
                    if (isset($_SESSION['cart'])){
                        $product_id = array_column($_SESSION['cart'], 'pid');

                       $query = "SELECT * FROM tblproducts";
                       $result = mysqli_query($conn,$query);
                        while ($row = mysqli_fetch_assoc($result)){
                            foreach ($product_id as $pid){
                                if ($row['pid'] == $pid){
                                    cartElement($row['image'], $row['pname'],$row['price'], $row['pid']);
                                    $total = $total + (int)$row['price'];
									$finalTotal=$total +$delivery;
									
                                }
                            }
                        }
                    }else{
                        echo "<h5>Cart is Empty</h5>";
                    }
					
					
					
					?>

					

            </div>
        </div>
        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">

            <div class="pt-4">
                <h6>PRICE DETAILS</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?php
						include ('dbConn.php');
                            if (isset($_SESSION['cart'])){
                                $count  = count($_SESSION['cart']);
                                echo "<h6>Price ($count items)</h6>";
                            }else{
                                echo "<h6>Price (0 items)</h6>";
                            }
                        ?>
                        <h6>Delivery Charges</h6>
                        <hr>
                        <h6>Amount Due:</h6>
                    </div>
                    <div class="col-md-6">
                        <h6>R<?php echo $total; ?></h6>
                        <h6 class="text-success">R150</h6>
                        <hr>
                        <h6>R<?php
                            echo $finalTotal;
                            ?></h6>
                    </div>
                </div>
				 <form method="post">
				 <button type="submit"name="checkout" class="checkout">CHECKOUT</a></button>
				  <div>
				  
			      </div>
                 </form>	
            </div>
			  </div>
				
				

        </div>
    </div>





	







<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 <footer> Copyright &COPY;2020 by OliyayaCouture.All Rights Reserved </footer>
</body>
	 <style>
 footer {
   position:fixed;
   bottom:0;
    padding: 20px;
    height: 38px;
	width:100%;
    background: lightslategray;
    border: none;
    margin-top: 20px;
    color: whitesmoke;
    background-color: gray;
    text-align: center;
      
}
 </style>
</html>
