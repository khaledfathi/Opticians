
/* #### constants #### */
const orderRevisionButton = document.querySelector('#order-revision-button');
const orderRevisionLink = document.querySelector('#order-revision-link'); 
const workDivs = document.getElementsByName('work');
/* #### end constants #### */

/* #### General #### */
/* #### End General #### */

/* #### Functions #### */
/* #### End Functions #### */


/* #### Event Actions #### */
function eventSetOrderRevision(event){
    Swal.fire({
    title: 'تأكيد المراجعة !',
    text: "لن تتمكن من الرجوع عن هذه العملية !",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    cancelButtonText: 'الغاء',
    confirmButtonText: 'موافق'
    }).then((result) => {
    request(orderRevisionLink.value).then((res)=>{
        console.log(res);
        event.target.innerHTML= 'تمت المراجعة بواسطة : '+res.revisioner; 
        event.target.style.background='green';
        event.target.disabled=true;
        Swal.fire(
            'تمت المراجعة',
            '',
            'success'
            )
    });
    });
}
/* #### End Event Actions #### */

/* #### Events #### */
(orderRevisionButton) ? orderRevisionButton.addEventListener('click' , eventSetOrderRevision) : null ; 
/* #### End Events #### */


/*########################################################*/ 
for (let i of workDivs){
   i.children[2].addEventListener('click' ,()=>{
    //change the link (use hidden input )
    request('/revision/setrevisionmultiorder?id').then((res)=>{
        console.log(res);
    }); 
   });
}