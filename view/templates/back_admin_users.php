<?php
function back_admin_users($lics,$usrs){

$ht='
        <div id="il-dashboard" class="il-content active">';

          
            for ($i=0; $i < count($lics); $i++) { 
                if($lics[$i]['status']==-1):                       
                    
           
                    $adminmail=$lics[$i]['email'];
                endif;
            }
      
            $t=count($usrs);
            $ht .= '<section id="intra-us" class="intra-section"><h3>Usuarios</h3>';
            $ht.='<ul>
                <li>Cantidad de usuarios Activos: '.--$t.'</li>    
                </ul>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Lic Id</th>
                    <th>Nombre</th>
                    <th>Email</th>                
                    <th>Session</th>           
                    <th>Hash</th>
                    <th>Last Session</th>
                </tr>';        
            for ($ri=0; $ri < count($usrs); $ri++) { 
                if($adminmail!=$usrs[$ri]['email']):                       
                    $ht .="<tr>";                
                    foreach ($usrs[$ri] as $kyr => $v3l) {                        
                        $ht .='<td>'.$v3l."</td>";            
                    }
                    $ht.="</tr>";
                endif;
            }
            $ht .='</table></section></div>';    

        return $ht;
}