<?php
 
namespace Halfegg\public\templates;

use Halfegg\mods\useThisMod;
use Halfegg\incs\checkRoleCaps;
class publicClient{

    private static $_rol_caps = [];

    

    function public_client_view($us_dat,$us_lic){
    
        if(isset($_GET['pg'])):
            $get_page=$_GET['pg'];
        else:
            $get_page=NULL;
        endif;

        if(empty(self::$_rol_caps)&&$us_dat):             
            self::$_rol_caps = new checkRoleCaps($us_dat['role']);
        endif;



        
            if(!empty($_SESSION['login'])&&!isset($_SESSION['logout'])){

                $thismod = new useThisMod($us_dat);

                //$user_sess=$_SESSION['login'];  //   <----   ??? check this bug ?
                if($get_page!==NULL&&$get_page=="dash"){                
                    
                    $cc='<section><br/><br/>';
                    $cc .= '<h2>Dashboard</h2>';
                    
                    $cc .='</section>';
                
                } elseif($get_page!==NULL&&$get_page=="acc"){
                   
                 
                    // Form && Buttons
                    $cc = '<section class="marg-l-section"><br/><br/>';     
                    $cc .= '<h2>Account</h2>';
                    $cc .= '<div id="ajax_response"></div>';
                    $cc .= '<form id="edit_profile_f" enctype="multipart/form-data">';
                    $cc .= '<input id="userid" name="userid" type="hidden" value="'.$us_dat['id'].'"/> 
                           
                            <br/><br/>';
                    
                    
                   
                    
                    // role capabilities
                    // print_r(self::$_rol_caps->check);
                       
                    if(!empty($thismod->printProfile(self::$_rol_caps->check)[1])){

                        // Profile Avatar
                        if(!empty($thismod->printProfile(self::$_rol_caps->check)[0])){
                           
                            $cc .= $thismod->printProfile(self::$_rol_caps->check)[0];     echo " <br/>"; 
                        }
                            // Account related 
                            $cc .='<p>User name: '.$us_dat['username'].'</p>';
                            $cc .='<p>email: '.$us_dat['email'].'</p>';
                        
                            if(in_array('can_view_profile',self::$_rol_caps->check)){
                                
                                
                                $cc .=  $thismod->printProfile(self::$_rol_caps->check)[1];

                             

                            } else {
                                $cc .= 'continue';
                            } 

                    } elseif(in_array('can_create_profile',self::$_rol_caps->check)){
 
                        $cc .= '<h2>Please complete your personal information</h2>';
            
                        $cc .= $thismod->createUserMeta()[1];


                    } else {

                       $cc .= 'Permission denied';

                    }                  

                    $cc.=  '</section>';

                    // ITEM
                    if(in_array('can_view_item',self::$_rol_caps->check)){
                        $cc .= '<section class="marg-l-section">';
                        $cc .=   $thismod->printItem();
                        $cc .= '</section>';
                    }

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