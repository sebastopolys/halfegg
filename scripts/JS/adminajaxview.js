let path =  window.location.pathname;
let removeslash = path.replace('/','');
let domain = removeslash.replace('/intralog.php','');

window.onload = (event) => {
/*
    let prefix = window.location.hostname;
    console.log(prefix);
*/
    // get all buttons by class name
    const view_bts = document.getElementsByClassName('v_view');

    for(var elem of view_bts){

        // build selector
        let htmlid = 'bk_view-'+elem.getAttribute('userid');
        // get html 
        let userid = document.getElementById(htmlid);

        // add click event to buttons
        elem.addEventListener('click', function(e){
            e.preventDefault();
            // get user id
            id = userid.getAttribute('userid');
          
            view_user(id); 
            
               
        });
        
      
    
    }
    
}

function view_user(id){

    var  xmlhttp;
    if(window.XMLHttpRequest){
      xmlhttp = new XMLHttpRequest();
    }else if(window.ActiveXObject){
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")

    }
    let url = 'http://localhost/'+domain+'/src/admin/log/viewUserAjax.php';

     // Instantiating the request object
     xmlhttp.open("POST", url, true);
     // Defining event listener for readystatechange event
    xmlhttp.onreadystatechange = function() {
        
        if (this.readyState === 4 && this.status === 200) {
         //   console.log(this.responseText);
            // get div container
            let cont = document.getElementById('il_view');
            cont.innerHTML = this.responseText;
        }     
 
   
    }
     
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("id="+id);

}