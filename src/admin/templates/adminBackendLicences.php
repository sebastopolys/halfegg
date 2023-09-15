<?php
namespace Halfegg\admin\templates;

class adminBackendLicences{

    function back_admin_licenses(){
     //   $tt=count($lics);
    
    $hit='
            <div id="il-dashboard" class="il-content active">
               
                <section id="intra-lic" class="intra-section"><h3>Items:</h3> ';
                
               
                $hit .='</section></div>';    
    
            return $hit;
    }
}
