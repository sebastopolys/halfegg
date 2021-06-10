<?php
function print_form($us_dat){  
    if(isset($_SESSION['login'])){
        $_session=$_SESSION['login'];  
        $loged=true;
     }
     elseif(isset($_SESSION['logout'])){
         $_session= $_SESSION['logout'];    
         $loged=false;
     }
     else{
         $_session ='NULL';
         $loged=false;
     }
     
     if($loged==false):
        
        $f= '      
      
        <form method="post" name="login_f">
        <div class="f_inp"><label for="user_f">User</label>
        <input type="text" name="user_f" ></div>
        <div class="f_inp"><label for="psw_f">Password</label>
        <input type="text" name="psw_f"></div>
        <div class="f_inp"><input type="submit" name="submit_f"value="LOGIN">
        <input type="submit" name="submit_fl"value="lost password">
        </div>      
        </form>';
    elseif($loged==true):
        $f = '
        <form method="post" name="login_f">             
        <div class="f_inp f_logedin">  
        <p>Hello '.$us_dat['nombre'].'</p>       
        <input type="submit" name="logout_f" value="LOGOUT">
        </div>
        <div class="f_inp"><p>Do you need some help? </p><a href="#">Contact support</a></div> 
        </form>
        ';
    endif;        
        return $f;
    }