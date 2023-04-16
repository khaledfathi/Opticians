/* #### constants #### */
const orderDate = document.querySelector('#order-date'); 
const orderTime = document.querySelector('#order-time'); 
const glassesAddCheckbox = document.querySelector('#glasses-add-checkbox'); 
const glassesBindCheckbox = document.querySelector('#glasses-bind-checkbox')
const addOptionDiv =  document.getElementsByName('add-option-div'); 
const orderUploadImage = document.querySelector('#order-upload-image');
const orderUploadImageFile = document.querySelector('#order-upload-image-file');
const presctiptionUploadImage = document.querySelector('#presctiption-upload-image');
const presctiptionUploadImageFile = document.querySelector('#presctiption-upload-image-file'); 
/* #### end constants #### */

/* #### Functions #### */
/* #### End Functions #### */

/* #### General #### */
//set current date and time 
orderDate.value = currentDate(); 
orderTime.value = currentTime(); 
/* #### End General #### */

/* #### Event Actions #### */
function eventAddCheckBox(){
    for(let i of addOptionDiv){
        if(glassesAddCheckbox.checked){
            i.hidden= false; 
            glassesBindCheckbox.disabled=false;
            glassesBindCheckbox.checked=true;
        }else {
            glassesBindCheckbox.disabled=true;
            i.hidden= true; 
        }
    }
}

/* order image */
function eventOrderUploadImage(){
    orderUploadImageFile.click();    
}

function eventOrderUploadImageFile(event){    
    let file = event.target.files[0]; 
    let imgSrc = URL.createObjectURL(file); 
    orderUploadImage.src=imgSrc; 
    orderUploadImage.style.width='200px'; 
}
/* end order image */

/* Presctiption image */
function eventPresctiptionUploadImage(){
    presctiptionUploadImageFile.click();    
}
function eventPresctiptionUploadImageFile(event){
    let file = event.target.files[0]; 
    let imgSrc = URL.createObjectURL(file); 
    presctiptionUploadImage.src=imgSrc; 
    presctiptionUploadImage.style.width='200px'; 
}
/* end Presctiption image */
/* #### End Event Actions #### */

/* #### Events #### */
glassesAddCheckbox.addEventListener('click' , eventAddCheckBox); 
orderUploadImage.addEventListener('click' , eventOrderUploadImage); 
orderUploadImageFile.addEventListener('change' , eventOrderUploadImageFile); 
presctiptionUploadImage.addEventListener('click' , eventPresctiptionUploadImage); 
// presctiptionUploadImageFile.addEventListener('change' , eventPresctiptionUploadImage); 
presctiptionUploadImageFile.addEventListener('change' , eventPresctiptionUploadImageFile); 
/* #### End Events #### */
