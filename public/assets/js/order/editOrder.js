
/* #### constants #### */
const orderDate = document.querySelector('#order-date'); 
const orderTime = document.querySelector('#order-time'); 
const addOptionDiv =  document.getElementsByName('add-option-div'); 
const orderUploadImage = document.querySelector('#order-upload-image');
const orderUploadImageFile = document.querySelector('#order-upload-image-file');
const defaultImageIcon = document.querySelector('#default-image-icon').value; 
const presctiptionUploadImage = document.querySelector('#presctiption-upload-image');
const presctiptionUploadImageFile = document.querySelector('#presctiption-upload-image-file'); 
const removeOrderImageButton = document.querySelector('#remove-order-image-button'); 
const removePersctiptionImageButton = document.querySelector('#remove-presctiption-image-button'); 
const workType = document.querySelector('#work-type'); 
const addWorkButton = document.querySelector('#add-work-button'); 
const workContainerDiv = document.querySelector('#work-container-div'); 
const workDiv = document.querySelector('#work-div'); 
const loadingImage = document.querySelector('#loading-image'); 
const orderSingleImageDiv = document.querySelector('#order-single-image-div');
const cancelOrderRevisionButton = document.querySelector('#cancel-order-revision-button');
const orderRevisionStatus = document.querySelector('#order-revision-status');
const orderRevisionStatusMsg = document.querySelector('#order-revision-status-msg');
const deleteOrderImageStatus = document.querySelector('#delete-order-image-status');
//used for backend request
const orderDetails = document.querySelector('#order-details');
const submitButton = document.querySelector('#submit-button');
/* #### end constants #### */

/* #### General #### */
/* #### End General #### */

/* #### Functions #### */
/* #### End Functions #### */


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
    orderUploadImageFile.value='';
    deleteOrderImageStatus.value=1; 
}

function eventWorkTypeChanged(){
    if (workType.value == 'نظارة جديدة'){
        addWorkButton.hidden=false; 
        workContainerDiv.hidden=false;
        orderSingleImageDiv.hidden=true;
    }else {
        addWorkButton.hidden=true; 
        workContainerDiv.hidden=true;
        orderSingleImageDiv.hidden=false;
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
    let addLeftFiled = addLeftDiv.children[1];
    let addRightFiled = addRightDiv.children[1];
    
    //presctiption
    let presctiptionImage = newWorkDiv.children[4].children[1]; 
    let presctiptionImageBrowseFile = newWorkDiv.children[4].children[2]; 
    let presctiptionRemoveImageButton = newWorkDiv.children[4].children[3]; 

    //delete this div button
    let removeWorkButton = newWorkDiv.children[5].children[0]; 
    /**************************************/ 

    //create unique id to bind labels with checkboxes
    let uniqueAddCheckBoxId = new Date().valueOf()+'_'+Math.floor(Math.random()*1000);
    let uniqueBindCheckBoxId = new Date().valueOf()+'_'+Math.floor(Math.random()*1000);

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
            bindCheckBox.disabled=true;
            addLeftFiled.value='';
            addRightFiled.value=''; 
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
        presctiptionImageBrowseFile.value='';
    });
    removeWorkButton.addEventListener('click' , ()=>{
        removeWorkButton.parentElement.parentElement.remove()
    }); 

    
    //append to parent div
    workContainerDiv.appendChild(newWorkDiv);    
}

function eventCollectOrderDetailsData(){
    let works = workContainerDiv.children;     
    let orderDetailsData=[]; 
    //loob in parent div
    for (let i=0 ; i<works.length ; i++){
        //ignore first hidden div
        if (i>0){
            let work = works[i];
            let workData ={};
            //left
            workData['l_sphere'] = work.children[0].children[1].children[1].value;             
            workData['l_cylinder'] = work.children[0].children[2].children[1].value;
            workData['l_axis'] = work.children[0].children[3].children[1].value;
            workData['l_add'] = work.children[0].children[4].children[1].value;
            //right
            workData['r_sphere'] = work.children[1].children[1].children[1].value; 
            workData['r_cylinder'] = work.children[1].children[2].children[1].value;
            workData['r_axis'] = work.children[1].children[3].children[1].value;
            workData['r_add'] = work.children[1].children[4].children[1].value;
            //add checkbox
            workData ['isAddChecked'] = work.children[2].children[0].children[0].checked; 
            //lens type 
            workData['lensTypeId'] = work.children[3].children[0].children[0].children[1].value
            //frame type
            workData['frameTypeId'] = work.children[3].children[0].children[1].children[1].value 
            //count
            workData['count'] = work.children[3].children[0].children[2].children[1].value
            //details
            workData['details'] = work.children[3].children[1].children[0].children[1].value
            //set name to image file to use in back end 
            workData['image'] = work.children[4].children[2].name="image_"+i
            //revision status
            workData['revision'] = work.children[6].children[0].value
            //work id 
            workData['id'] = works[i].children[7].children[0].value; 
            //delete status 
            workData['deleteStatus'] = works[i].children[7].children[1].value;
            //delete image status
            workData['deleteImageStatus'] = works[i].children[7].children[2].value; 
            orderDetailsData.push(workData); 
        }
        workData=[]; 
    }
    orderDetails.value = JSON.stringify(orderDetailsData);
} 

function eventOrderDetailsValidation(){
    let works = workContainerDiv.children;    
    //loob in parent div
    for (let i=0 ; i<works.length ; i++){
        //ignore first hidden div
        if (i>0){
            //left
            let l_cylinder = works[i].children[0].children[2].children[1];
            let l_axis = works[i].children[0].children[3].children[1];
            //ritgh
            let r_cylinder = works[i].children[1].children[2].children[1];
            let r_axis = works[i].children[1].children[3].children[1];

            //left
            if (l_cylinder.value){
                l_axis.setAttribute('required','');                
            } else {                
                l_axis.setCustomValidity(''); 
                l_axis.removeAttribute('required'); 
            }
            //right
            if (r_cylinder.value){
                r_axis.setAttribute('required','');                
            } else {                
                r_axis.setCustomValidity(''); 
                r_axis.removeAttribute('required'); 
            }
        }
    } 
}

function displayLoadingImage(){
    loadingImage.style.display='flex';
}

function eventSetWorksEvents (){
   let works =  workContainerDiv.children;
   for (let i=1 ; i<works.length ; i++){//i=1 becuase the first one is an empty template

        /* elements to add events or mainpulating */
        //checkboxes
        let addCheckBox = works[i].children[2].children[0].children[0];
        let addCheckBoxLabel = works[i].children[2].children[0].children[1];
        let bindCheckBox = works[i].children[2].children[1].children[0];         
        let bindCheckBoxLabel = works[i].children[2].children[1].children[1];         
        
        //add fields
        let addLeftDiv = works[i].children[0].children[4]
        let addRightDiv = works[i].children[1].children[4];
        let addLeftFiled = addLeftDiv.children[1];
        let addRightFiled = addRightDiv.children[1];

        //presctiption
        let presctiptionImage = works[i].children[4].children[1]; 
        let presctiptionImageBrowseFile = works[i].children[4].children[2]; 
        let presctiptionRemoveImageButton = works[i].children[4].children[3]; 

        //delete this div button
        let removeWorkButton = works[i].children[5].children[0];

        //work id 
        let workId = works[i].children[7].children[0]; 

        //work delete status 
        let deleteStatus = works[i].children[7].children[1]; 
        
        //work delete image 
        let deleteImageStatus = works[i].children[7].children[2]; 

        //revision
        let revisionStatus = works[i].children[6].children[0];
        let revisionDescription = works[i].children[6].children[1];
        let cancelRevisionButton = works[i].children[6].children[2];
        /**************************************/ 

        //create unique id to bind labels with checkboxes
        let uniqueAddCheckBoxId = new Date().valueOf()+'_'+Math.floor(Math.random()*1000);
        let uniqueBindCheckBoxId = new Date().valueOf()+'_'+Math.floor(Math.random()*1000);

        //bind labels with checkboxs
        addCheckBoxLabel.setAttribute('for', uniqueAddCheckBoxId);
        addCheckBox.id=uniqueAddCheckBoxId; 
        bindCheckBoxLabel.setAttribute('for',uniqueBindCheckBoxId); 
        bindCheckBox.id = uniqueBindCheckBoxId; 

        bindCheckBox.disabled = (addCheckBox.checked) ? false : true;   
        
        /*EVENTS*/    
        addCheckBox.addEventListener('change' , ()=>{
            if(addCheckBox.checked){
                addLeftDiv.hidden=false; 
                addRightDiv.hidden=false; 
                bindCheckBox.disabled=false;
                addLeftFiled.value=""; 
                addRightFiled.value=""; 
            }else{
                addLeftDiv.hidden=true; 
                addRightDiv.hidden=true; 
                bindCheckBox.disabled=true;
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
            presctiptionImage.setAttribute('style', 'width:50px !important');
            presctiptionImageBrowseFile.value='';
            deleteImageStatus.value=1; 
        });
        removeWorkButton.addEventListener('click' , ()=>{
            console.log(deleteStatus.value);
            if (deleteStatus.value == 1) {
                deleteStatus.value=0; 
                removeWorkButton.innerHTML="حذف";
                removeWorkButton.parentElement.parentElement.style.background='white';
            }else {
                deleteStatus.value=1;
                removeWorkButton.innerHTML="الغاء الحذف";
                removeWorkButton.parentElement.parentElement.style.background='rgba(255,0,0,0.5)';
            } 
        }); 

        if (cancelRevisionButton != undefined){ //prevent console error if buttton dosent exist
            cancelRevisionButton.addEventListener('click' , ()=>{
                revisionStatus.value= 0; 
                revisionDescription.innerHTML = 'لم يتم مراجعتة';
                cancelRevisionButton.hidden=true;
                
            }); 
        }
    }

}

function eventOrderRevisionStatus(){
    orderRevisionStatus.value=0;
    orderRevisionStatusMsg.innerHTML='لم يتم مراجعتة ';
    cancelOrderRevisionButton.hidden=true;
}
/* #### End Event Actions #### */

/* #### Events #### */  
(orderUploadImageFile) ? orderUploadImage.addEventListener('click' , eventOrderUploadImage): null ; 
(orderUploadImageFile) ? orderUploadImageFile.addEventListener('change' , eventOrderUploadImageFile): null ; 
(removeOrderImageButton) ? removeOrderImageButton.addEventListener('click' , eventRemoveOrderImage) : null ; 
(workType) ? workType.addEventListener('change', eventWorkTypeChanged) : null ; 
addWorkButton.addEventListener('click' , eventAddNewWork);
submitButton.addEventListener('click' , eventCollectOrderDetailsData); 
submitButton.addEventListener('click' , eventOrderDetailsValidation); 
submitButton.addEventListener('click' , displayLoadingImage);
(cancelOrderRevisionButton != null ) ? cancelOrderRevisionButton.addEventListener('click' , eventOrderRevisionStatus) : null ;
window.addEventListener('load' , eventSetWorksEvents);
/* #### End Events #### */


/* #################################### */



