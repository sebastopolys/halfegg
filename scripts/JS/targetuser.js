
// https://bootstrapfriendly.com/blog/form-submission-using-javascript-ajax-and-php

console.log('Target user Script - halfegg');

// GET DOMAIN 
let path =  window.location.pathname;
let removeslash = path.replace('/','');
let domain = removeslash.replace('/intralog.php','');

window.onload = (event) => {
 
   
 
    // save button
    const saveUser = document.getElementById('save_pr');
    
    // Save event
    saveUser.addEventListener('click',function(e){
        e.preventDefault();
        // save profile       
        save_ajax();
        // save item
        ajax_create();
    // console.log(saveUser);
        
    });    

    // initialize TinyMCE html editor
    tinymce.init({
        selector: 'textarea#it-cont',
        plugins: "lists",    
        toolbar: "undo redo | numlist bullist | styleselect | bold italic "        
      });   

}

function save_ajax() {
    var  xmlhttp;
    if(window.XMLHttpRequest){
      xmlhttp = new XMLHttpRequest();
    }else if(window.ActiveXObject){
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")

    }
    let url = 'http://localhost/'+domain+'/src/public/log/publicFormAjax.php';


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

function ajax_create() {
    var  xmlhttp;
    if(window.XMLHttpRequest){
      xmlhttp = new XMLHttpRequest();
    }else if(window.ActiveXObject){
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")

    }
    let url = 'http://localhost/'+domain+'/src/admin/log/createItemAjax.php';


    // Instantiating the request object
    xmlhttp.open("POST", url, true);
     // Defining event listener for readystatechange event
    xmlhttp.onreadystatechange = function() {
        if (this.readyState !== "complete"){
            //document.getElementById("il_view").innerHTML = this.response;
            console.log('success');
           console.log(this.response);
        }      
   
    }
 
    // Retrieving the form data
    var form = document.getElementById("newitem");    
    var formDat = new FormData(form);
    let htmlTinymce = tinymce.activeEditor.getContent();
    // Sending the request to the server
   
     
    formDat.append('it-cont',htmlTinymce);
    xmlhttp.send(formDat);
    //console.log(formDat);


    // replace DOM Html content
    // replaceText( myForm) ;
    function replaceText(formDat){
        for(var pair of formDat.entries()){
            let nam = pair[0];
            let val = pair[1];
 
        }      
    }
    

}

