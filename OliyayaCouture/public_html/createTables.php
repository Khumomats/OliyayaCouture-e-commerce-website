<?php
  include"dbConn.php";



       $qrya= "DROP TABLE IF EXISTS `tblorderproduct`";
	   $qryb= "DROP TABLE IF EXISTS `tblorders`";
	   $qryc= "DROP TABLE IF EXISTS `tblproducts`";
	   $qryd="DROP TABLE IF EXISTS `tblcustomers`";
	  
	   
	    $DropTableA = mysqli_query($conn, $qrya);
		$DropTableB = mysqli_query($conn, $qryb);
		$DropTableC = mysqli_query($conn, $qryc);
		$DropTableD = mysqli_query($conn, $qryd);
		$DropTableE = mysqli_query($conn, $qrye);


		$sqla = "CREATE TABLE `tblcustomers` (
				  `cid` int(10) NOT NULL AUTO_INCREMENT,
				  `name` varchar(50) NOT NULL,
				  `surname` varchar(50) NOT NULL,
				  `email` varchar(50) NOT NULL,
				  `password` varchar(200) NOT NULL,
				  PRIMARY KEY (`cid`)
				) ENGINE=InnoDB DEFAULT CHARSET=latin1";

		$sqlb = "CREATE TABLE `tblproducts` (
				  `pid` int(10) NOT NULL AUTO_INCREMENT,
				  `pname` varchar(50) NOT NULL,
				  `price` decimal(10,2) NOT NULL,
				  `image` varchar(50) NOT NULL,
				  `qnty` int(10) NOT NULL,
				  PRIMARY KEY (`pid`)
				) ENGINE=InnoDB DEFAULT CHARSET=latin1";

		$sqlc = "CREATE TABLE `tblorders` (
				  `oid` int(10) NOT NULL AUTO_INCREMENT,
				  `cid` int(10) NOT NULL,
				  `datecreation` date NOT NULL,
				  PRIMARY KEY (`oid`),
				  KEY `cid` (`cid`),
				  CONSTRAINT `tblorders_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `tblcustomers` (`cid`)
				) ENGINE=InnoDB DEFAULT CHARSET=latin1";		
				
				
				
	  $sqld = "CREATE TABLE `tbladdress` (
				  `zipcode` int(10) NOT NULL,
				  `cid` int(10) NOT NULL,
				  `oid` int(10) NOT NULL,
				  `province` varchar(50) NOT NULL,
				  `city` varchar(50) NOT NULL,
				  `suburb` varchar(50) NOT NULL,
				  `stName` varchar(50) NOT NULL,
				  PRIMARY KEY (`zipcode`),
				  KEY `cid` (`cid`),
				  KEY `oid` (`oid`),
				  CONSTRAINT `tbladdress_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `tblcustomers` (`cid`),
				  CONSTRAINT `tbladdress_ibfk_2` FOREIGN KEY (`oid`) REFERENCES `tblorders` (`oid`)
				) ENGINE=InnoDB DEFAULT CHARSET=latin1";

		$sqle = "CREATE TABLE `tblorderproduct` (
				  `oid` int(10) NOT NULL,
				  `pid` int(10) NOT NULL,
				  `price` decimal(10,2) NOT NULL,
				  `qnty` int(10) NOT NULL,
				  Primary Key (`oid`,`pid`),
				  KEY `oid` (`oid`),
				  KEY `pid` (`pid`),
				  CONSTRAINT `tblorderproduct_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `tblproducts` (`pid`),
				  CONSTRAINT `tblorderproductt_ibfk_2` FOREIGN KEY (`oid`) REFERENCES `tblorders` (`oid`)
				) ENGINE=InnoDB DEFAULT CHARSET=latin1";

		$CreateTableA = mysqli_query($conn, $sqla);
		$CreateTableB = mysqli_query($conn, $sqlb);
		$CreateTableC = mysqli_query($conn, $sqlc);
		$CreateTableD = mysqli_query($conn, $sqld);
		$CreateTableE = mysqli_query($conn, $sqle);
		

		if ($CreateTableA && $CreateTableB && $CreateTableC && $CreateTableD && $CreateTableE == TRUE) 
		{
			
				//echo "<br>Tables created<br>";
				#echo "There was an error :".mysqli_error($conn);
				loadProduct();
		} 
		else 
		{

			//echo "<br>Tables exsist";
			
		}





//Esatablish connection to the database


/*
function loadCustomer()//explictly called
{
$conn = mysqli_connect("localhost","root","","18024010_POE");
$open = fopen('customerData.txt','r'); //open the file stream into $open storeit in the read mode

while(!feof($open)) //loop through the lines
{
	$getTextline = fgets($open) ;// stores each line into a variable called $getTextline
	$explodeLine = explode(",",$getTextline); // separate line valuse based on a delimeter
	
	list($fname,$lname,$email,$passdword) = $explodeLine;
	
  $sql = "INSERT INTO tblcustomers(fname,lname,email,password) VALUES ('$fname','$lname','$email','$passdword')";
    mysqli_query($conn,$sql);
}
fclose($open); //colses the file stream	
}
*/
function loadProduct()//explictly called
{
$conn = mysqli_connect("localhost","root","","oliyaya_couture");
$open = fopen('product.txt','r'); //open the file stream into $open storeit in the read mode

while(!feof($open)) //loop through the lines
{
	$getTextline = fgets($open) ;// stores each line into a variable called $getTextline
	$explodeLine = explode(",",$getTextline); // separate line valuse based on a delimeter
	
	list($pname,$price,$image,$qnty) = $explodeLine;
	
  $sql = "INSERT INTO tblproducts(pname,price,image,qnty) VALUES ('$pname','$price','$image','$qnty')";
    mysqli_query($conn,$sql);
}
fclose($open); //colses the file stream	
}

/*
function loadOrders()//explictly called
{
$conn = mysqli_connect("localhost","root","","18024010_POE");
$open = fopen('orderData.txt','r'); //open the file stream into $open storeit in the read mode

while(!feof($open)) //loop through the lines
{
	$getTextline = fgets($open) ;// stores each line into a variable called $getTextline
	$explodeLine = explode(",",$getTextline); // separate line valuse based on a delimeter
	
	list($cid,$qnty) = $explodeLine;
	
  $sql = "INSERT INTO tblorders(cid,qnty) VALUES ('$cid','$qnty')";
    mysqli_query($conn,$sql);
}
fclose($open); //colses the file stream	
}


function loadOrderProduct()//explictly called
{
$conn = mysqli_connect("localhost","root","","18024010_POE");
$open = fopen('orderProductData.txt','r'); //open the file stream into $open storeit in the read mode

while(!feof($open)) //loop through the lines
{
	$getTextline = fgets($open) ;// stores each line into a variable called $getTextline
	$explodeLine = explode(",",$getTextline); // separate line valuse based on a delimeter
	
	list($oid,$pid) = $explodeLine;
	
  $sql = "INSERT INTO tblorderproduct(oid,pid) VALUES ('$oid','$pid')";
    mysqli_query($conn,$sql);
}
fclose($open); //colses the file stream	
}
*/
?>

 <!--
  References: W3schools.com. (2021). CSS Backgrounds. [online] Available at: https://www.w3schools.com/css/css_background.asp [Accessed 3May 2021].
  W3schools.com. (2021). PHP Form Handling. [online] Available at: https://www.w3schools.com/php/php_forms.asp [Accessed 4 May 2021].
  W3schools.com. (2021). PHP include and require. [online] Available at: https://www.w3schools.com/php/php_includes.asp [Accessed 5 May 2021].
-->

‌














