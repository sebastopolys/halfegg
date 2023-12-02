<?php
namespace Halfegg\admin\templates;

use Halfegg\mods\useThisMod;


class adminBackendUsers{

    

    

    function back_admin_users($usrs){
 
    
        $ht='
                <div id="il-dashboard" class="il-content active">';
        
                              
                    $t=count($usrs);
                    $ht .= '<section id="intra-us" class="intra-section">';
                    $ht.='<ul>
                        <li>Active users: '.--$t.'</li>    
                        </ul>
                    <table>
                        <tr>
                            <th>ID</th>                            
                            <th>Nombre</th>                                         
                            <th>eMail</th>                                               
                            <th>role</th>
                            <th>Last log</th>
                            <th></th>
                         
                            
                           
                        </tr><form method="POST" id="admin-view" enctype="multipart/form-data" >';  
                        $fm = ''; 
                        foreach ($usrs as $key => $value) {
                             
                            // don't print admin
                             if(intval($value['id'])!==1){                                 
                                $ht .= '<tr>';
                                $ht .= '<td>'.$value['id'].'</td>';
                                $ht .= '<td>'.$value['username'].'</td>';
                                $ht .= '<td>'.$value['email'].'</td>';
                                $ht .= '<td>'.unserialize($value['role'])[0].'</td>';
                                $ht .= '<td>'.$value['last_action'].'</td>';
                                $ht .= '<td><button type="button" id="bk_view-'.$value['id'].'" userid="'.$value['id'].'" class="v_view">view</button></td>';
                               
                                $ht .= '</tr>';
                                

                             //   $ht .= '<input id="userid-'.$value['id'].'" class="adm_view_btn" name="userid-'.$value['id'].'" type="hidden" value="'.$value['id'].'"/>';
                            
                               
                            }                         
                        }     
             
                    $ht .='</form></table>';
                 
                    $ht .='</section></div><div id="il_view">-</div>';
        
                return $ht;
        }      
    
}
