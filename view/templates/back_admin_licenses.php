<?php
function back_admin_licenses($lics){
    $tt=count($lics);

$hit='
        <div id="il-dashboard" class="il-content active">
           
            <section id="intra-lic" class="intra-section"><h3>Licencias:</h3> 
            <ul><li>Cantidad de licencias Total: '.--$tt.'</li></ul>
            <table>
            <tr>
            <th>ID</th>
            <th>Email</th>
            <th>l_key</th>
            <th>Status</th> 
            <th>Created</th>          
            </tr>';
            for ($i=0; $i < count($lics); $i++) { 
                if($lics[$i]['status']!=-1):                       
                    $hit.="<tr>";
                foreach ($lics[$i] as $ky => $vl) {                            
                    $hit .='<td>'.$vl."</td>";                          
                    }
                    $hit.="</tr>";
                else:
                    $adminmail=$lics[$i]['email'];
                endif;
            }
            $hit .='</table>';
           
            $hit .='</section></div>';    

        return $hit;
}