<?php

function component($pname, $price, $image, $pid){
    $element = "
    
     <div >
	 
                <form action=\"Fashion.php\" method=\"post\" style=\"width:70%\" style=\"padding:15\" style=\"backround:black\>
                    <div class=\"cardshadow  \ style=\"backround-color=\"black\" style=\"color:pink;\">
                        <div>
                            <img src=\"$image\" alt=\"Image1\" class=\"img-fluid card-img-top\" style=\"width:35%\" style=\"height:30%px\">
                        </div>
						 <div class=\"card-body\">
                            <h5 class=\"card-title\">$pname</h5>
                      
                            <h5>
                               
                                <span class=\"price\">R$price</span>
                            </h5>
                            <button type=\"submit\" backround=\"black\" name=\"add\" class=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button>
                             <input type='hidden' name='id' value='$pid'>
                        </div>
                    </div>
                </form>
            </div>
    ";
   
    echo $element;
}

function cartElement($image, $pname, $price, $pid){
    $element = "
    
    <form action=\"cart.php?action=remove&id=$pid\" method=\"post\" class=\"cart-items\">
                    <div class=\"border rounded\">
                        <div class=\"row bg-white\">
                            <div class=\"col-md-2 pl-0\">
                                <img src=\"$image\" alt=\"Image1\" class=\"img-fluid\">
                            </div>
                            <div class=\"col-md-4\">
                                <h5 class=\"pt-2\">$pname</h5>
                                
                                <h5 class=\"pt-2\">R$price</h5>
                                
                                <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                            </div>
                            <div class=\"col-md-3 py-5\">
                                   <div class=\"cart-quantity cart-column\">
                       
        </div>
    </td>
                            </div>
                        </div>
                    </div>
                </form>
    
    ";
  echo $element;
}

















