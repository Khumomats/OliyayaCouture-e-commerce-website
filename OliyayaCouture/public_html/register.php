<?php
 /**How To Create A Login System In PHP For Beginners | Procedural MySQLi | PHP Tutorial.2020.YouTube video, added by Dani Krossing.
 [Online].Available at: https://www.youtube.com/watch?v=gCo6JqGMi30&list=PLmI7yJUCKoc-1HbPikpnuibk0YIn95vpb&index=2&t=134s [Accessed 04 May 2021].*/
    include('dbConn.php');
    $output = NULL;
    $fname = $lname = $email = $pass =  $rpass = "";

    if(isset($_POST['submit']))
    {
    
        $fname = $_POST['fname'];
		$lname = $_POST['lname'];
        $email = $_POST['email'];
        $pass = $_POST['pass']; 
        $rpass = $_POST['rpass'];
        
        $pattern = '/^(?=.*[!@#$%^&*-?])(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{4,20}$/';
		
        $query = "SELECT * FROM tblCustomers WHERE email = '$email'";
    
        $checkUserExsists = mysqli_query($conn,$query);
		#VALIDATING THE USER
        
        if(empty($fname) || empty($lname) || empty($email) || empty($pass) || empty($rpass))
        {
			echo "<script>alert('Fields cannot be empty')</script>";
           
        }
        elseif(filter_var($email, FILTER_VALIDATE_EMAIL) != true)
        {
			echo "<script>alert('Invalid Email address')</script>";
           
        }
        elseif(mysqli_num_rows($checkUserExsists) == 1)
        {
			echo "<script>alert('User already exists')</script>";
            
        }

        elseif($pass != $rpass)
        {
			echo "<script>alert('Passwords do not match')</script>";
          
        }

		elseif(!preg_match($pattern, $pass))
		{
			echo "<script>alert('Password is not strong enough')</script>";
			
		}
        else
        {
			
            $pass = md5($pass); #This will create a hashed password
            $query = "INSERT INTO tblCustomers (name,surname, email, password) VALUES ('$fname','$lname','$email','$pass')";
            $insertUser = mysqli_query($conn,$query);
            if ($insertUser == true) 
            {
                $output = "You have Sucessfully been Registered";
            
			}
        }
    
    
    }
	
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
		<link rel="stylesheet" type ="text/css" href="style.css">
		<link rel="stylesheet" type ="text/css" href="newstyle.css">
    </head>
    
<body>
<!-- THE REGISTER FORM IS CREATED HERE -->

 <div class="container">
 <a href="cart.php" name="submit">Back</a>
 	<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>

  	<div class="input-group">
  	
  	  <input type="text" name = "fname" minlength="3" placeholder="Name" maxlength="20" value = "<?php echo $fname; ?>">
  	</div>
	  	<div class="input-group">
  	 
  	  <input type="text" name = "lname" minlength="3" placeholder="Surname" maxlength="20" value = "<?php echo $lname; ?>">
  	</div>
  	<div class="input-group">
  	 
  	  <input type="email" name = "email" placeholder="Email"  value = "<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  
  	  <input type="password" name="pass" placeholder="Password">
  	</div>
  	<div class="input-group">
  	 
  	  <input type="password" name="rpass" placeholder="Confirm password">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="submit">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
    </form>
    <?php
    echo "<br>";
    echo $output;
    ?>
    
</body>


</html>