
// https://bootstrapfriendly.com/blog/form-submission-using-javascript-ajax-and-php

console.log('admin Script - halfegg');
// Form
const form = document.getElementById('admin-view');
// View buttons
const saveButton = document.getElementsByClassName('v_view');

 

for (let index = 0; index < saveButton.length; index++) {
  
   saveButton[index].addEventListener('click',function(e){
    e.preventDefault();
   // console.log(saveButton[index].getAttribute('userid'));
    save_ajax(saveButton[index].getAttribute('userid'));
  
});
    
}
function save_ajax(id) {
    var  xmlhttp;
    if(window.XMLHttpRequest){
      xmlhttp = new XMLHttpRequest();
    }else if(window.ActiveXObject){
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")

    }
    let url = 'http://localhost/halfegg/src/admin/log/adminFormAjax.php';


    // Instantiating the request object
    xmlhttp.open("POST", url, true);
     // Defining event listener for readystatechange event
    xmlhttp.onreadystatechange = function() {
        if (this.readyState !== "complete"){
            document.getElementById("il_view").innerHTML = this.response;
        //   console.log(this.response);
        }      
   
    }
 
    // Retrieving the form data
    var myForm = document.getElementById("admin-view");    
    var formData = new FormData(myForm);
 
    // Sending the request to the server
    formData.append('id',id);
    xmlhttp.send(formData);

    // replace DOM Html content
    // replaceText( myForm) ;
    function replaceText(formData){
        for(var pair of formData.entries()){
            let nam = pair[0];
            let val = pair[1];
 
        }      
    }
    

}
