<?php

session_start();


require_once ('./php/component.php');

if(isset($_POST['add'])){
	


if(isset($_SESSION['cart'])){
	
	$item_array_id=array_column($_SESSION['cart'],"pid");
	
	if(in_array($_POST['id'],$item_array_id)){
		$count=count($_SESSION['cart']);
		$item_array= array(
		'pid'=> $_POST['id']
		);
		$_SESSION['cart'][$count]=$item_array;
		#print_r($_SESSION['cart']);
		
	}else{
		
		$count=count($_SESSION['cart']);
		$item_array= array(
		'pid'=> $_POST['id']
		);
		$_SESSION['cart'][$count]=$item_array;
		#print_r($_SESSION['cart']);
		
	}
	#print_r($item_array_id);
}else{
	$item_array=array(
	
	'pid'=>$_POST['id']
	);
	
	//create a session varibale
	$_SESSION['cart'][0]=$item_array;
	#print_r($_SESSION['cart']);
}
	
}
	
?>

<html>
<head>


 <title>Shopping Cart</title>
       
    <meta http-equiv="X-UA-Compatible" content="ie=edge">      <title>OliyayaCouture</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Oliyaya Couture">
        <meta name="keyword" content="Oliyaya">
        <meta name="author" content="Tsholofelo Matsetela">
   
	<link rel= "stylesheet" type="text/css" href ="css/shop.css">
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

   
 
</head>

<body style="background-color:black;"> 

        <div class ="container">
  
            
            
            <nav>
              <input type="checkbox" id="check">
              <label for="check">
              <i class="fas fa-bars" id="btn"></i>
              <i class="fas fa-times" id="cancel"></i>
            </label>
                          
                          
        <ul>
            <li><a class="active" href ="index.html">HOME PAGE</a></li>
           
            <li><a href ="Fashion.php">SHOP</a></li>
            <li><a href ="photo-gallery.html">PHOTO GALLERY</a></li>
            <li><a href ="get-involved.html">BOOKING</a></li>
            <li><a href ="contact-us.html">CONTACT US</a></li>
			 <li><a href="cart.php" class="nav-item nav-link active">
                    <h5 class="px-5 cart">
                        <i class="fas fa-shopping-cart"></i> Cart 
						
						<?php

                        if (isset($_SESSION['cart'])){
                            $count = count($_SESSION['cart']);
                            echo "<span id=\"cart_count\" class=\"text-warning bg-light\">$count</span>";
                        }else{
                            echo "<span id=\"cart_count\" class=\"text-warning bg-light\">0</span>";
                        }

                        ?>
						</h5></a></li>
          
        </ul>

             </nav>
			 
            <img src="logo1.png" alt="centered image" width="400" style="display: block; margin-left: auto; margin-right: auto;" />



<div class="resp">  
<form class="content">	
<center>
<table cellspacing="1" cellpadding="5">

 <?php
include('dbConn.php');



		
            $query = "SELECT * FROM tblproducts";
            $result = mysqli_query($conn,$query);
          if(mysqli_num_rows($result) > 0){
	             while($row = mysqli_fetch_assoc($result)){

                    
                    component($row['pname'],$row['price'], $row['image'], $row['pid']);
				 }
                }
            
?>

    
</table>
</center>
</form>
	</div>
</body>
<style>
table{
    width: 90%;
    margin: 30px auto;
    border-collapse: collapse;
    text-align: center;
	
	
}
.resp{
	        padding: 20px;
        position: relative;
        text-align: center;
		color:white;
}
@media (max-width: 860px){
.resp{
	        padding: 20px;
        position: relative;
        text-align: center;
		color:white;
}
}



</style>
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

.add {
    width: 220px;
    height: 50px;
    border: none;
    outline: none;
    color: white;
    background: #111;
    cursor: pointer;
    position: relative;
    z-index: 0;
    border-radius: 10px;
}

.add:before {
    content: '';
    background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
    position: absolute;
    top: -2px;
    left:-2px;
    background-size: 400%;
    z-index: -1;
    filter: blur(5px);
    width: calc(100% + 4px);
    height: calc(100% + 4px);
    animation: glowing 20s linear infinite;
    opacity: 0;
    transition: opacity .3s ease-in-out;
    border-radius: 10px;
}

.add:active {
    color: #000
}

.add:active:after {
    background: transparent;
}

.add:hover:before {
    opacity: 1;
}

.add:after {
    z-index: -1;
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background: #111;
    left: 0;
    top: 0;
    border-radius: 10px;
}

@keyframes glowing {
    0% { background-position: 0 0; }
    50% { background-position: 400% 0; }
    100% { background-position: 0 0; }
}




 </style>
<script>
function openNav() 
{
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() 
{
  document.getElementById("mySidenav").style.width = "0";
}
</script>

</html>