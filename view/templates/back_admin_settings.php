<?php
function back_admin_settings(){
 

$hit='
<div id="il-ajust" class="il-content">
<section id="intra-cr-ajj" class="intra-section">
    <h3>Ajustes generales:</h3>
    
    <form method="POST" name="cr-ajj" id="crajj-button">
        <div class="admin_fi">
        <h5>Registro de usuarios:</h5>
        <ul>
        <li>    
            <input type="radio" id="reg-off" name="regist" value="reg-off"> 
            <label for="reg-off">Registration disabled</label>                    
        </li>
        <li>                              
            <input type="radio" id="on-page" name="regist" value="on-page"> 
            <label for="on-page">Allow registration on page:</label>    
        </li>
        <li> 
            <input type="radio" id="page-mail" name="regist" value="page-mail">
            <label for="page-mail">Registration on page and by email confirmation link:</label>

        </li>
        <li>
            <input type="radio" id="on-mail" name="regist" value="on-mail" checked>
            <label for="on-mail">Registration only by email link:</label>
        </li>
        
        
        
        </ul>
        <h5>Sistema de licencias:</h5>
        <ul>
            <li>
            <input type="checkbox" name="lic-feat" id="lic-feat">
            <label for="lic-feat">Enable licensing feature</label>
            </li>
        </ul>
        </div>                       
        <input id="cr-submit" class="add-query" type="button" name="cr-l-sub" value="SAVE" >
    </form>

</section>
</div>
';  

        return $hit;
}