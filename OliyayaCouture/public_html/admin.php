<?php
include('dbConn.php');
?>




<html>
<head>
  <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
<title>ADMIN</title>
<link rel="stylesheet" type="text/css" href="..\css/externalStyling.css">
<!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

   

   
<style>
.input-group {
    margin: 10px 0px 10px 0px;
}
.input-group label {
    display: block;
    text-align: left;
    margin: 3px;
}
.input-group input {
    height: 30px;
    width: 93%;
    padding: 5px 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid gray;
}
.btn {
    padding: 17px;
    font-size: 15px;
    color: white;
    background: #5F9EA0;
    border: none;
    border-radius: 5px;
	size: 10px 10px;
}
.edit_btn {
    text-decoration: none;
    padding: 2px 5px;
    background: #2E8B57;
    color: white;
    border-radius: 3px;
}

.del_btn {
    text-decoration: none;
    padding: 2px 5px;
    color: white;
    border-radius: 3px;
    background: #800000;
}
.msg {
    margin: 30px auto; 
    padding: 10px; 
    border-radius: 5px; 
    color: #3c763d; 
    background: #dff0d8; 
    border: 1px solid #3c763d;
    width: 50%;
    text-align: center;
}
 

body
{
	background-image: url("blue.jpeg" );
	color: black
}
table{

    width: 100%;
    margin: 30px auto;
    border-collapse: collapse;
   
	
}
tr {
    border-bottom: 1px solid #cbcbcb;
}
th, td{
    border: none;
    height: 30px;
    padding: 2px;
}
tr:hover {
    background: white;
}
form {
    width: 100%;
    margin: 50px auto;
    text-align: left;
    padding: 20px; 
    border: 5px ; 
    border-radius: 5px;
	background: smokewhite;
	width: 750px;
    height: 290px;
	color: blue;
}
.btn {
    padding: 17px;
    font-size: 15px;
    color: white;
    background: #5F9EA0;
    border: none;
    border-radius: 5px;
	size: 10px 10px;
}
.input-group {
    margin: 10px 0px 10px 0px;
}
.input-group label {
    display: block;
    text-align: left;
    margin: 3px;
}
.input-group input {
    height: 30px;
    width: 93%;
    padding: 5px 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid gray;
	
	
}
</style>
<body>
<br><br><br>
<table>
<tr>
<center>



</tr>
</table>


  <a href="login.php">Sign Out<hr></a>





                   <!-- Creating new Product -->
<?php
	// initialize variables
	$pname = "";
	$price = "";
	$pid = 0;
	$update = false;
	
		if(isset($_POST['image']))
	{
		$error = arraY();
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['temp_name'];
		$file_type = $_FILES['image']['type'];
		
		$file_ext = strtolower(end(explode('.',$_FILES['image']['name'])));
		
		$extensions = array("jpeg","jpg","png");
		
		
		if(in_array($file_ext,$extensions) == false)
		{
			$error[] = "Please upload an image with the extension as jpeg, jpg, png";
		} 
		if(empty($error) == true)
		{
		move_uploaded_file($file_temp,"images/" . $file_name);
		$path = $_SERVER['HTTP_REFERER']."images/" . $file_name;
		$pname = $_POST['pname'];
		$price = $_POST['price'];
		$qnty = 20;
		echo $path;
		mysqli_query($conn, "INSERT INTO tblproducts (pname, price, image, qnty) VALUES ('$pname','$price', '$path',$qnty)"); 
		$_SESSION['message'] = "Product added!!!"; 
		$results = mysqli_query($conn, "SELECT * FROM tblproducts");
		}
	}
	
	
	
	
	
	if (isset($_POST['save'])) 
	{		
		$pname = $_POST['pname'];
		$price = $_POST['price'];
		$imageURL = '..\images/homeDisplay.jpeg';
		$qnty = 20;
		
		mysqli_query($conn, "INSERT INTO tblproducts (pname, price, image, qnty) VALUES ('$pname','$price', '$imageURL',$qnty)"); 
		$_SESSION['message'] = "Product added!!!"; 
		$results = mysqli_query($conn, "SELECT * FROM tblproducts");	
	}
	
		if (isset($_GET['edit'])) 
		{
		$pid = $_GET['edit'];
		$update = true;
		$record = mysqli_query($conn, "SELECT * FROM tblproducts WHERE pid=$pid");

		if (mysqli_num_rows($record) == 1 ) 
		{
			$n = mysqli_fetch_array($record);
			$pname = $n['pname'];
			$price = $n['price'];
		}
	}
		if (isset($_POST['update'])) 
		{
		$pid = $_POST['pid'];
		$pname = $_POST['pname'];
		$price = $_POST['price'];

		mysqli_query($conn, "UPDATE tblproducts SET pname='$pname', price = '$price' WHERE pid=$pid");
		$_SESSION['message'] = "Product updated!"; 
		$results = mysqli_query($conn, "SELECT * FROM tblproducts");
	    }
	
		if (isset($_GET['delete'])) 
		{
		$id = $_GET['delete'];
		mysqli_query($conn, "DELETE FROM tblproducts WHERE pid=$id");
		$_SESSION['message'] = "Product deleted!"; 
		//header('location: admin.php');
		 $results = mysqli_query($conn, "SELECT * FROM tblproducts");
	    }
?>
<div class="admm">
				<!-- Editing Form -->
<form method="post" action="admin.php" enctype="multipart/form-data">
	<input type="hidden" name="pid" value="<?php echo $pid; ?>">
	  
		<hr>
		
	
		<section id="boxes">
               <div class="container">
                   <div class="box">
                       
                        <label>Product Name</label><br>
                         <div class="input-group">
		<input type="text" name="pname" value="<?php echo $pname; ?>" required/> </th>
		</div>
                      
                     
                   </div>
                   <div class="box">
				   <label>Product Price</label><br>
                     <div class="input-group">
   		<input type="number" name="price" value="<?php echo $price; ?>" required/>
		</div>
                      
                    </div>
                 
                   <div class="box">
				   <label>Upload Image</label><br>
                      <input class="btn" type="file"name="image" >
   		
   		
                   </div>
             
			      <div>
			   </div>   </div>
			   </div>
			    
           </section>
		
		<center>
	
			&nbsp;
			<?php if ($update == true): ?>
				<button class="btn" type="submit" name="update" >UPDATE</button>
			<?php else: ?>
				<button class="btn" type="submit" name="save" >SAVE</button>
			<?php endif ?>
		<center>
		
</form>


          <!-- Loading the products -->
<?php if (isset($_SESSION['message'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
<?php endif ?>
<?php $results = mysqli_query($conn, "SELECT * FROM tblproducts"); ?>
<center>
<table >
	<thead>
		<tr>
		<th><h2>Image</h2></th>
			<th><h2>Name</h2></th>
			<th><h2>Price</h2></th>
			<th><h2>Action</h2></th>
		</tr>
	</thead>
	
	

	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
		   <td><img src="<?php echo $row['image'];?>" alt="" height="150" width="100" class="tbl"> </td>
			<td><?php echo $row['pname']; ?></td>
			<td><?php echo $row['price']; ?></td>
			<td>
				<a href="admin.php?edit=<?php echo $row['pid']; ?>" class="edit_btn" >Edit</a>
			
				<a href="admin.php?delete=<?php echo $row['pid']; ?>" class="del_btn">Delete</a>
			</td>
		</tr>
	<?php } ?>
	</div>
</table>
</center>
</body>
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
<style>

.adm{
	        padding: 20px;
        position: relative;
        text-align: center;
		color:black;
}
@media (max-width: 860px){
.adm{
	        padding: 20px;
        position: relative;
        text-align: center;
		color:black;
}
}
@media all and (max-width: 768px){
    float: none;
    text-align: center;
    width: 100%;
    

}
@media
only screen and (max-width: 768px) {
 table, thead, tbody, th, td, tr {
    display: block;
  }
  thead tr {
    position: absolute;
    top: -9999px;
    left: -9999px;
  }
  tr { border: 1px solid #ccc; }
  td {
    border: none;
    border-bottom: 1px solid #eee;
    position: relative;
    padding-left: 200px;
    margin-left: 150px;
  }
  td:before {
    position: absolute;
    top: 12px;
    left: 6px;
    width: 200px;
    padding-right: 40px;
    white-space: nowrap;
    margin-left: -150px;
  }
 
  td:nth-of-type(2):before { content: "Name"; }
  td:nth-of-type(3):before { content: "Price"; }
  td:nth-of-type(4):before { content: "Action";}
  
  .tbl{
	  margin-left:-280px;
	  height:100px;
  }
}


</style>
<html>

