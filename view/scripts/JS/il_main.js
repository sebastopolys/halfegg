//'use strict';
// Botones
// show query
let show_query = document.getElementById('show-q');
// Crear licencia
let crear_lic_butt = document.getElementById('crea-l-b');
// RUN QUERY button !!
let query_butt = document.getElementById("il_queries"); 
//  NAVEGACION LATERAL Dashboard(default)/licencias/buscador/estadisticas/ajustes
let dashboard_cont = document.getElementById('il-dashboard');

let il_tab = document.getElementsByClassName("il_nav_butt"); 

function tog_htmlclass(){
    
      
    for (let ix = 0; ix < il_tab.length; ix++) {
        // on click event
        il_tab[ix].addEventListener('click',function(){ 
        
            // remove active class              
            let active = document.querySelector('#js-hand div.il-content.active');
            active.classList.remove('active');
            // add active class
            let activate = document.querySelector('#js-hand'); 
            activate.children[ix].classList.add('active');
            
            
        });
    }
}

tog_htmlclass();



/* Licence creator */


// agregar consulta
//let crear_l = document.getElementById('cr-submit');
// input
//let cr_bt = document.getElementById('cr-email-l');


/*crear_l.addEventListener('click', function(){    
    var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
  
        if(cr_bt.value.match(mailformat))
        {   
            cr_bt.focus();
            add_consult();
            return true;            
        }
        else        {
            alert("You have entered an invalid email address!");
            cr_bt.focus();
            return false;
        }     
});*/

function add_consult(){
   
    // hidden input
    const hd_101 = document.getElementById('hd-101');        
    let val_101 = hd_101.value;

    
    // input value already have a string
    if(val_101.length>0){
        console.log('hay string '+val_101);
        hd_101.value= hd_101.value+','+cr_bt.value; 
    }
    // input value is empty ~ we add the string
    else{
        hd_101.value= cr_bt.value;       
    }
 
     //   SAMPLE JSON FOR MULTIPLE EMAILS IN INPUT VALUE
    /*    let email = cr_bt.value;
        
        const json = {email};

        console.log(json);
    */

        // container de area consultas

        let cons_cont = document.getElementById('liccr_form');        

        // creamos el input
        // y le asignamos el value del formulario / lo hacemos hidden
        let inp_crm = document.createElement('span');
        inp_crm.className ='cons_not';
        inp_crm.innerHTML ='<p class="cons_wrap">Codigo 101: Crear licencia con email: '+cr_bt.value+'</p>';

        // insertamos el field
        cons_cont.prepend(inp_crm);

}


