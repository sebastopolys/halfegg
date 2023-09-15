<?php
namespace Halfegg\admin\templates;

class adminClientRegister{

    function client_register(){
        
    $home_link= MANPATH.'/'.BASPATH;

    $cli='   
    <section>
                <h2>Complete your registration</h2>
                <div id="container">
            
                <form method="post">
                    <span class="form-it">
                    <label for="name-log">Enter your name</label>
                    <input name="name-log" id="name-log" type="text"/>
                    </span>
                    <span class="form-it">
                    <label for="mail-log">Enter your email</label>
                    <input name="mail-log" id="mail-log" type="text"/>
                    </span>
                    <span class="form-it">
                    <label for="pass-log">Enter your password</label>
                    <input name="pass-log" id="pass-log" type="password"/>
                    </span>
                    <span class="form-it">
                    <label for="pass1-log">Repeat password</label>
                    <input name="pass1-log" id="pass1-log" type="password"/><i><mark style="background:red;color:white;"> <b>!</b> </mark> Secure passwords uses numbers, caps, and 8 char length.</i>
                    </span>
                    <span class="form-it">
                    <input name="log-submit" id="log-submit" type="submit" value="Submit"/>
                    </span>
                </form>
                </div>
                </section>';
                return $cli;
    }
}
                