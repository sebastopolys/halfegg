<?php
function print_client($us_dat,$us_lic){
   
    if(isset($_GET['pg'])):
        $get_page=$_GET['pg'];
    else:
        $get_page=NULL;
    endif;

    
        if(!empty($_SESSION['login'])&&!isset($_SESSION['logout'])){
            $user_sess=$_SESSION['login'];
            if($get_page!==NULL&&$get_page=="dash"){                
                
                $cc='<section><h2>Dashboard</h2></section>';
               
            }elseif($get_page!==NULL&&$get_page=="acc"){

                $cc = '<section><h2>My account</h2>';       
                $cc .='<p>Nombre: '.$us_dat['nombre'].'</p>';
                $cc .='<p>email: '.$us_dat['email'].'</p>';           
                $cc .='<p>USER ID: '.$us_dat['id'].'</p>';            
                
                if(!empty($us_lic)){
                    $cc .='<p>Licence ID: '.$us_lic['id'].'</p>';
                    $cc .='<p>Licence key: '.$us_lic['l_key'].'</p>';
                    $cc .='<p>Licence status: ';
                    if($us_lic['status']==0):
                        $cc.='unactive</p>';
                    elseif($us_lic['status']==-1):
                        $cc.='admin</p>';
                    elseif($us_lic['status']==1):
                        $cc.='active</p>';
                    else:
                        $cc.='unknown</p>';
                    endif;
                    $cc .='<p>Licence created on: '.$us_lic['timestamp'].'</p>';
                }
                else{
                    $cc .= '<p>There is no license attached to this account</p>';
                }
                $cc.=  '</section>';
            }
            else{
                $cc='<section><h2>Home page</h2><p>Welcome back.</p></section>';
            }
        }
        elseif(!empty($_SESSION['logout'])&&!isset($_SESSION['login'])){
            
            $cc='<section><h2>Public website. You are Loged OUT</h2></section>';        
        }
        else{

        $cc= '<section><a href="https://web.whatsapp.com/send?phone=541165636894&text=Hello! ">Link to whatsapp</a></section>';
        
        }
    return $cc;
}