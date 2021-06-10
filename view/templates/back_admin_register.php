<?php
function back_admin_register($lics,$usrs,$bkpg){

    if($bkpg=='users'){
        $bkpage='Users';
        $bklab='usuario';
    }
    elseif($bkpg=='licences'){
        $bkpage='Licences';
        $bklab='licencia';
    }
    else{
        $bkpage='unknown';
        $bklab='unknown';
    }

$hit = '<div id="il-'.$bkpg.'" class="il-content">';
$hit.= '<h3>'.$bkpage.'</h3>';    
    $hit.= '<section id="intra-cr-'.$bkpg.'" class="intra-section">        
                <form method="POST" name="cr-'.$bkpg.'" id="cr-'.$bkpg.'">
                    <span class="admin_fi">
                    <label for="cr-email-l"><b>Enter email for '.rtrim($bkpg,'s').' creation</b></label>
                    <textarea name="cr-email" rows="2" cols="45" id="cr-email"></textarea>
                    </span>                       
                    <input id="cr-sub-'.$bkpg.'" class="add-query" type="submit" name="cr-'.$bkpg.'-sub" value="ADD" >
                </form>
            </section>
        </div>';
        return $hit;
}