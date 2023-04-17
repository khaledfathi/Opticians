
/* #### constants #### */
const orderDate = document.querySelector('#order-date'); 
const orderTime = document.querySelector('#order-time'); 
const glassesAddCheckbox = document.querySelector('#glasses-add-checkbox'); 
const glassesBindCheckbox = document.querySelector('#glasses-bind-checkbox')
const addOptionDiv =  document.getElementsByName('add-option-div'); 
const orderUploadImage = document.querySelector('#order-upload-image');
const orderUploadImageFile = document.querySelector('#order-upload-image-file');
const defaultImageIcon = orderUploadImage.src; 
const presctiptionUploadImage = document.querySelector('#presctiption-upload-image');
const presctiptionUploadImageFile = document.querySelector('#presctiption-upload-image-file'); 
const removeOrderImageButton = document.querySelector('#remove-order-image-button'); 
const removePersctiptionImageButton = document.querySelector('#remove-presctiption-image-button'); 
const addWorkButton = document.querySelector('#add-work-button'); 
const workType = document.querySelector('#work-type'); 
const workContainerDiv = document.querySelector('#work-container-div'); 
const workDiv = document.querySelector('#work-div'); 
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

function eventRemoveOrderImage(){
    orderUploadImage.src=defaultImageIcon; 
    orderUploadImage.style.width='50px' ;
}

function eventRemovePresctiptionImage(){
    presctiptionUploadImage.src=defaultImageIcon; 
    orderUploadImage.style.width='50px' ;
}

function eventAddNewWork(){
    let newWorkDiv = workDiv.cloneNode(); 
    newWorkDiv.innerHTML = workDiv.innerHTML; 
    newWorkDiv.style.display='flex';
    workContainerDiv.appendChild(newWorkDiv);
    console.log(newWorkDiv); 
}

function eventWorkTypeChanged(){
    if (workType.value == 'نظارة جديدة'){
        addWorkButton.hidden=false; 
        workContainerDiv.hidden=false;
    }else {
        addWorkButton.hidden=true; 
        workContainerDiv.hidden=true;
    }
}
/* #### End Event Actions #### */

/* #### Events #### */
glassesAddCheckbox.addEventListener('click' , eventAddCheckBox); 
orderUploadImage.addEventListener('click' , eventOrderUploadImage); 
orderUploadImageFile.addEventListener('change' , eventOrderUploadImageFile); 
presctiptionUploadImage.addEventListener('click' , eventPresctiptionUploadImage); 
presctiptionUploadImageFile.addEventListener('change' , eventPresctiptionUploadImageFile); 
removeOrderImageButton.addEventListener('click' , eventRemoveOrderImage); 
removePersctiptionImageButton.addEventListener('click' , eventRemovePresctiptionImage); 
workType.addEventListener('change', eventWorkTypeChanged); 
addWorkButton.addEventListener('click' , eventAddNewWork); 
/* #### End Events #### */
