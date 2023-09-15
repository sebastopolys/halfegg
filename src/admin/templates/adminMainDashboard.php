<?php
namespace Halfegg\admin\templates;

use Halfegg\incs\adminBackendToggle;

class adminMainDashboard{
    function intralog_dashboard($usrs){

        # NAVigation
    $md = '
        <div id="cont">
            <header><h1>'.MAINAME.'</h1>
            
            <h4>'.DESCR.'</h4>
            </header>
            <nav id="intralog-nav">
            <form method="GET">
                <ul>
                    <li><button name="bkpg" value="home" id="il_butt_dash" class="il_nav_butt" >Dashboard</button></li>
                    <li><button name="bkpg" value="users" id="il_butt_usr" class="il_nav_butt" >Usuarios</button></li>
                    <li><button name="bkpg" value="licences" id="il_butt_lic" class="il_nav_butt" >Items</button></li>
                    <li><button name="bkpg" value="search" id="il_butt_busc" class="il_nav_butt" >Buscador</button></li>                    
                    <li><button name="bkpg" value="analitycs" id="il_butt_stat" class="il_nav_butt" >Estadisticas</button></li>
                    <li><button name="bkpg" value="settings"id="il_butt_ajjs" class="il_nav_butt" >Ajustes</button></li>
                </ul>
            </form>
            </nav>
            <div id="m-content" class="il-dash il-content">';
    
     
        
              $ryp= new adminBackendToggle($usrs);
              $md .= $ryp->_html;
        
    $md .= '</div></div><pre>'.VERSION.'</pre>';
         
    return $md;
       
    }
}
