<?php
 
namespace Halfegg\public\templates;
use Halfegg\mods\useThisMod;
class publicClient{

    

    function public_client_view($us_dat,$us_lic){
    
        if(isset($_GET['pg'])):
            $get_page=$_GET['pg'];
        else:
            $get_page=NULL;
        endif;

        
            if(!empty($_SESSION['login'])&&!isset($_SESSION['logout'])){

                $thismod = new useThisMod($us_dat);

                $user_sess=$_SESSION['login'];
                if($get_page!==NULL&&$get_page=="dash"){                
                    
                    $cc='<section><br/><br/>';
                    $cc .= '<h2>Dashboard</h2>';
                    
                    $cc .='</section>';
                
                }elseif($get_page!==NULL&&$get_page=="acc"){
                   
                 
                    // Form && Buttons
                    $cc = '<section><br/><br/>';     
                    $cc .= '<h2>Account</h2>';
                    $cc .= '<div id="ajax_response"></div>';
                    $cc .= '<form id="edit_profile_f" enctype="multipart/form-data">';
                    $cc .= '<input id="userid" name="userid" type="hidden" value="'.$us_dat['id'].'"/> 

                            <button value="edit" id="edit_pr" class="profile-butt" name="edit-profile">edit</button>
                            <button value="save" id="save_pr" class="profile-butt" name="save-profile">save</button>
                            <br/><br/>';

                    // Profile Avatar
                    $cc .= $thismod->printProfile()[0];
                    // Account related 
                    $cc .='<p>User name: '.$us_dat['username'].'</p>';
                    $cc .='<p>email: '.$us_dat['email'].'</p>'; 
                    
                    // Profile      
                    if(!empty($thismod->printProfile()[1])){
                        $cc .=  $thismod->printProfile()[1];   
                    } else {
                        if($us_dat['role']==4){
                            
                            $cc .= '<h2>Please complete your personal information</h2>';
                            $cc .= $thismod->createUserMeta()[1];
                        } else {
                            $cc .= 'No Personal information. Please contact to report this';
                        }
                        
                    }                  
                  /*

                    if($us_lic){
                       
                        $cc .='<p>Licence ID: '.$us_lic['id'].'</p>';                       
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
                        $cc .='<p>Licence created on: '.$us_lic['last_action'].'</p>';
                    }
                    else{
                        $cc .= '<p>There is no license attached to this account</p>';
                    }
                    */
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
}