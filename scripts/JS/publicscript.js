
// https://bootstrapfriendly.com/blog/form-submission-using-javascript-ajax-and-php


//const prefix = 'halfegg1';

// GET DOMAIN 
let url =  window.location.href;
let ext = window.location.search;
const baseurl = url.replace(ext,'');
 
window.onload = (event) => {
    const saveButton = document.getElementById('save_pr');
    const editButton = document.getElementById('edit_pr');
    const cancelButton = document.getElementById('cancel_pr');
  
    if(saveButton==null){return;}
    
    saveButton.addEventListener('click',function(e){
        e.preventDefault();

        saveButton.style = 'display:none';
        editButton.style = 'display:block';
        cancelButton.style = 'display:none';
        accsave();
        save_ajax();
        
    });
    
    editButton.addEventListener('click',function(ee){       
        ee.preventDefault();
 
        saveButton.style = 'display:inline-block';
        cancelButton.style = 'display:inline-block';
        editButton.style = 'display:none';
        
        accedit();

    });

    cancelButton.addEventListener('click',function(e){
        e.preventDefault();

        saveButton.style = 'display:none';
        editButton.style = 'display:block';
        cancelButton.style = 'display:none';
   
        accancel();
        
    });

}

function save_ajax() {
    var  xmlhttp;
    if(window.XMLHttpRequest){
      xmlhttp = new XMLHttpRequest();
    }else if(window.ActiveXObject){
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")

    }
    let url = baseurl+'src/public/log/publicFormAjax.php';


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
    replaceText(formData);

    function replaceText(formData){
        let labels = document.getElementsByClassName('profile-label');
        let values = document.getElementsByClassName('prof-data');
  

        
        for(var pair of formData.entries()){
    
            let ele = document.getElementById('pr_dat_'+pair[0]);
            if (ele !=null){
                ele.textContent = pair[1];
            }

        }  
      
    }
    

}

/*  Public client view account
 
*   Show   input fields  and  save button when click on "edit button" 
*   Hide values and edit button when click on "save button"
*   Display results on ajax success
*/

function accedit(){
    
    let fields = document.getElementsByClassName('prof-data');
    let inputs = document.getElementsByClassName('profile-input');
  
    for (var i = 0; i < fields.length; i++) {
         
        inputs[i].style = "display:inline-block"; 
        fields[i].style = "display:none"; 
    }
}
function accancel(){
    let fields = document.getElementsByClassName('prof-data');
    let inputs = document.getElementsByClassName('profile-input');


    for (var ix = 0; ix < fields.length; ix++) {
     
        fields[ix].style = 'display:inline-block';
        inputs[ix].style = 'display:none';
        
    }
}
function accsave(){
    let fields = document.getElementsByClassName('prof-data');
    let inputs = document.getElementsByClassName('profile-input');


    for (var ix = 0; ix < fields.length; ix++) {
     
        fields[ix].style = 'display:inline-block';
        inputs[ix].style = 'display:none';
        
    }
}
