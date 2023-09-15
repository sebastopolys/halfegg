<?php
namespace Halfegg\admin\templates;

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
                            <th></th> 
                           
                        </tr><form id="admin-view" enctype="multipart/form-data" >';   
                        foreach ($usrs as $key => $value) {
                             
                            // don't print admin
                             if(intval($value['role'])!==0){                                 
                                $ht .= '<tr>';
                                $ht .= '<td>'.$value['id'].'</td>';
                                $ht .= '<td>'.$value['username'].'</td>';
                                $ht .= '<td>'.$value['email'].'</td>';
                                $ht .= '<td>'.$value['role'].'</td>';
                                $ht .= '<td>'.$value['last_action'].'</td>';
                                $ht .= '<td><button type="button" id="bk_view-'.$value['id'].'" userid="'.$value['id'].'" class="v_view">view</button></td>';
                                $ht .= '<td><button type="button" id="view_it-'.$value['id'].'" class="create_item" id_user="'.$value['id'].'">Item</button></td>';       
                                $ht .= '</tr>';
                                $ht .= '<input id="userid-'.$value['id'].'" name="userid-'.$value['id'].'" type="hidden" value="'.$value['id'].'"/>';
                            }                         
                        }     
             
                    $ht .='</form></table></section></div>'; 
                    $ht .= $this->new_item_form($value['id']);
                    $ht .='<div id="il_view" style="background-color:yellow;">-</div>';
        
                return $ht;
        }


        private function new_item_form($id){

                $hi = '<div id="newitemform">
                        <form id="newitem" enctype="multipart/form-data">';

                $hi .= '<label for="it-name-'.$id.'">Title</label>
                        <input id="it-name-'.$id.'" type="text" name="it-name"/>';

                $hi .= '<label for="it-descr-'.$id.'">Description</label>
                        <input type="text" id="it-descr-'.$id.'" name="it-descr"/>';

                $hi .= '<label for="it-cont-'.$id.'">Content</label>
                        <textarea id="it-cont-'.$id.'" name="it-cont" row="20" cols="33" placeholder="Here the content" ></textarea>';

                $hi.= '<button id="create-it-'.$id.'" class="create-it" id_user="'.$id.'">Save</button>';

                $hi .= '</form></div>';  
                return $hi;
        }
    
}
