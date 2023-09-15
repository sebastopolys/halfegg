
// https://bootstrapfriendly.com/blog/form-submission-using-javascript-ajax-and-php

console.log('admin item - halfegg');
// Create new item button
const crit_button = document.getElementById('create-it-2');
 
  
crit_button.addEventListener('click',function(e){
        e.preventDefault();
        ajax_create(crit_button.getAttribute('id_user'));
 
    
    });
function ajax_create(id) {
    var  xmlhttp;
    if(window.XMLHttpRequest){
      xmlhttp = new XMLHttpRequest();
    }else if(window.ActiveXObject){
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")

    }
    let url = 'http://localhost/halfegg/src/admin/log/createItemAjax.php';


    // Instantiating the request object
    xmlhttp.open("POST", url, true);
     // Defining event listener for readystatechange event
    xmlhttp.onreadystatechange = function() {
        if (this.readyState !== "complete"){
            //document.getElementById("il_view").innerHTML = this.response;
           console.log(this.response);
        }      
   
    }
 
    // Retrieving the form data
    var form = document.getElementById("newitem");    
   var formDat = new FormData(form);
 
    // Sending the request to the server
    formDat.append('id',id);
    xmlhttp.send(formDat);

    // replace DOM Html content
    // replaceText( myForm) ;
    function replaceText(formDat){
        for(var pair of formDat.entries()){
            let nam = pair[0];
            let val = pair[1];
 
        }      
    }
    

}
