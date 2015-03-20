 <h1>PHP Lab</h1>
 <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQbFYY4iUCXiZItvb7AeRLB4-36K_SZaqo57GtmRIr454wfBjCaWzpFJv3I" />
 <h2>Contact Us!</h2>
 <p>traffordbrittany@gmail.com</p>
 <p>647-888-5174</p>
      
 <nav> 
<?php 
  

function display_navigation ($navs) { 
    foreach($navs as $keys => $value){
        echo '<a href=' . '$value' . '>' . $keys . '</a>' . ' ';
    
    
    }
}
$navs = array("Home" => "#", "Classes" => "#", "Three" => "#", "Four" => "#", "Five" => "#");
    
display_navigation($navs);
            
?>
     
</nav>   