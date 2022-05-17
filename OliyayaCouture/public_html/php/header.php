<?php

if(isset($_POST['submit']))
{
    header("location:login.php");
    
    unset($_SESSION['email']);  
    session_destroy(); 
}

?>
<header id="header">
   <link rel="stylesheet" href="cart.css">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="Fashion.php" class="navbar-brand">
            <h3 class="px-5">
			  
                <i class="fas fa-shopping-basket"></i> HOME
            </h3>
        </a>
        <button class="navbar-toggler"
            type="button"
                data-toggle="collapse"
                data-target = "#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup"
                aria-expanded="false"
                aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="mr-auto"></div>
            <div class="navbar-nav">
                <a href="cart.php" class="nav-item nav-link active">
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
                    </h5>
                </a>
				<form method="post">
				 
				 	<?php if(isset($_SESSION['email'])): ?>
				 <input type="submit" name="submit" value="Logout" class="logout" />
			<?php else: ?>
				 <input type="submit" name="submit" value="Login" class="logout" />
			<?php endif ?>
                 </form>				 
            </div>
        </div>
           
    </nav>
</header>






