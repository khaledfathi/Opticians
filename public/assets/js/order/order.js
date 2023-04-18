
/* #### constants #### */
const orderDate = document.querySelector('#order-date'); 
const orderTime = document.querySelector('#order-time'); 
const addOptionDiv =  document.getElementsByName('add-option-div'); 
const orderUploadImage = document.querySelector('#order-upload-image');
const orderUploadImageFile = document.querySelector('#order-upload-image-file');
const defaultImageIcon = orderUploadImage.src; 
const presctiptionUploadImage = document.querySelector('#presctiption-upload-image');
const presctiptionUploadImageFile = document.querySelector('#presctiption-upload-image-file'); 
const removeOrderImageButton = document.querySelector('#remove-order-image-button'); 
const removePersctiptionImageButton = document.querySelector('#remove-presctiption-image-button'); 
const workType = document.querySelector('#work-type'); 
const addWorkButton = document.querySelector('#add-work-button'); 
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

function eventRemoveOrderImage(){
    orderUploadImage.src=defaultImageIcon; 
    orderUploadImage.style.width='50px' ;
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

function eventAddNewWork(){
    //copy div and display it 
    let newWorkDiv = workDiv.cloneNode(); 
    newWorkDiv.innerHTML = workDiv.innerHTML; 
    newWorkDiv.style.display='flex';

    /* elements to add events or mainpulating */
    //checkboxes
    let addCheckBox = newWorkDiv.children[2].children[0].children[0];
    let addCheckBoxLabel = newWorkDiv.children[2].children[0].children[1];
    let bindCheckBox = newWorkDiv.children[2].children[1].children[0];         
    let bindCheckBoxLabel = newWorkDiv.children[2].children[1].children[1];         
    //add fields
    let addLeftDiv = newWorkDiv.children[0].children[4]
    let addRightDiv = newWorkDiv.children[1].children[4];
    
    //presctiption
    let presctiptionImage = newWorkDiv.children[4].children[1]; 
    let presctiptionImageBrowseFile = newWorkDiv.children[4].children[2]; 
    let presctiptionRemoveImageButton = newWorkDiv.children[4].children[3]; 

    //delete this div button
    let removeWorkButton = newWorkDiv.children[5].children[0]; 
    /**************************************/ 

    //create unique id to bind labels with checkboxes
    let uniqueAddCheckBoxId = new Date().valueOf();
    let uniqueBindCheckBoxId = new Date().valueOf()+1;

    //bind labels with checkboxs
    addCheckBoxLabel.setAttribute('for', uniqueAddCheckBoxId);
    addCheckBox.id=uniqueAddCheckBoxId; 
    bindCheckBoxLabel.setAttribute('for',uniqueBindCheckBoxId); 
    bindCheckBox.id = uniqueBindCheckBoxId; 

    bindCheckBox.disabled=true;    
    
    /*EVENTS*/    
    addCheckBox.addEventListener('change' , ()=>{
        if(addCheckBox.checked){
            addLeftDiv.hidden=false; 
            addRightDiv.hidden=false; 
            bindCheckBox.disabled=false;
        }else{
            addLeftDiv.hidden=true; 
            addRightDiv.hidden=true; 
        }
    });
    //nested function
    function eventBindAddFileds(){
        let addRightField = addRightDiv.children[1];
        let addLeftField = addLeftDiv.children[1];
        
        addLeftField.addEventListener('input',()=>{            
           (bindCheckBox.checked) ? addRightField.value = addLeftField.value : null ; 
        });
        addRightField.addEventListener('input',()=>{            
            (bindCheckBox.checked) ? addLeftField.value = addRightField.value : null ; 
        });
        
    }
    bindCheckBox.addEventListener('change' , eventBindAddFileds);
    presctiptionImage.addEventListener('click' , ()=>{
        presctiptionImageBrowseFile.click();
    });
    presctiptionImageBrowseFile.addEventListener('change' , (event)=>{
        let file = event.target.files[0]; 
        let imgSrc = URL.createObjectURL(file); 
        presctiptionImage.src=imgSrc; 
        presctiptionImage.style.width='200px'; 
    }); 
    presctiptionRemoveImageButton.addEventListener('click' , ()=>{
        presctiptionImage.src=defaultImageIcon; 
        presctiptionImage.style.width='50px' ;
    });
    removeWorkButton.addEventListener('click' , ()=>{
        removeWorkButton.parentElement.parentElement.remove()
    }); 

    
    //append to parent div
    workContainerDiv.appendChild(newWorkDiv);    
}

/* #### End Event Actions #### */

/* #### Events #### */  
orderUploadImage.addEventListener('click' , eventOrderUploadImage); 
orderUploadImageFile.addEventListener('change' , eventOrderUploadImageFile); 
removeOrderImageButton.addEventListener('click' , eventRemoveOrderImage); 

workType.addEventListener('change', eventWorkTypeChanged); 
addWorkButton.addEventListener('click' , eventAddNewWork);

/* #### End Events #### */
