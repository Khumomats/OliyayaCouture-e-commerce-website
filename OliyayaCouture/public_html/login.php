
    <?php


  session_start();
    unset($_SESSION['email']);  

    include_once('dbConn.php');
   
	
	
    $output = NULL;
    $email = $pass = "";
#Existing users will be able ot login here, their details will be fetched from the database

/**How to Make Login Form in PHP and MySQL.2019. Youtube video, added by Coding with Elias.[Online].Avalable at: 
 https://www.youtube.com/watch?v=JDn6OAMnJwQ [Accessed 05 May 2021]. */
    if(isset($_POST['submit']))
    {
    
        $_SESSION['email'] = $_POST['email'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $hpass = md5($pass);

        $query = "SELECT email, password FROM tblCustomers WHERE email = '$email' AND password = '$hpass'";
        
        $result = mysqli_query($conn,$query);

        $row = mysqli_fetch_array($result);

        $x = $row['email'];
        $y = $row['password'];
        

        if(empty($email))
        {
            
			echo "<script>alert('Please enter email')</script>";
        }

        else 
        { 
             if($x == $email && $y == $hpass) 
             {
                 header("location:cart.php");
				 
				
             }
            else 
            {
				echo "<script>alert('Incorrect Username\Password.')</script>";
               
            }
			
        
        }
        
        
        
       if( $email=="admin1@email.com" && $pass=="mainAdmin12"){
				
				  header("location:admin.php");
			}
        
        
    
    }
	
    ?>

	<!DOCTYPE html>
	<html>
		<head>
			<title>Login</title>
			<link rel="stylesheet" type ="text/css" href="newstyle.css"> <!-- CSS style sheet embeded here -->
		</head>
		<!-- THE LOGIN FORM IS CREATED HERE -->
	<body>
	
		<div class="header">
		
  </div>
   <div class="container">
   <a href="cart.php" name="submit">Back</a>
 	<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
		
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="pass" required>
            </div>
            
			<div class="input-group">
				<button name="submit" class="btn" style:background-color=violet>Login </button>
			</div>
			
			<p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
		</form>
		<?php
		echo "<br>";
		echo $output;
		
		?>
	
	</div.	
	</body>
	</html>