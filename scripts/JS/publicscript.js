
// https://bootstrapfriendly.com/blog/form-submission-using-javascript-ajax-and-php

console.log('Public Script - halfegg');

const saveButton = document.getElementById('save_pr');

 saveButton.addEventListener('click',function(e){
    e.preventDefault();
 
    save_ajax();
    
 });

//window.onload = (event) => {}
function save_ajax() {
    var  xmlhttp;
    if(window.XMLHttpRequest){
      xmlhttp = new XMLHttpRequest();
    }else if(window.ActiveXObject){
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")

    }
    let url = 'http://localhost/halfegg/src/public/log/publicFormAjax.php';


    // Instantiating the request object
    xmlhttp.open("POST", url, true);
     // Defining event listener for readystatechange event
    xmlhttp.onreadystatechange = function() {
        if (this.readyState !== "complete"){
            document.getElementById("ajax_response").innerHTML = "Profile information has changed";
           
        }      
   
    }

    // Retrieving the form data
    var myForm = document.getElementById("edit_profile_f");
    var formData = new FormData(myForm);
    
    // Sending the request to the server
    xmlhttp.send(formData);

    // replace DOM Html content
    replaceText( formData) ;
    function replaceText(formData){
        for(var pair of formData.entries()){
            let nam = pair[0];
            let val = pair[1];
 
        }      
    }
    

}

 

