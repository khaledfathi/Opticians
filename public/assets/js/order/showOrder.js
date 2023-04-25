
/* #### constants #### */
const orderRevisionButton = document.querySelector('#order-revision-button');
const orderRevisionLink = document.querySelector('#order-revision-link'); 
/* #### end constants #### */

/* #### General #### */
/* #### End General #### */

/* #### Functions #### */
/* #### End Functions #### */


/* #### Event Actions #### */
function eventSetOrderRevision(){
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
        orderRevisionButton.innerHTML= 'تمت المراجعة بواسطة : '+res.revisioner; 
        orderRevisionButton.style.background='green';
        orderRevisionButton.disabled=true;
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
orderRevisionButton.addEventListener('click' , eventSetOrderRevision); 
/* #### End Events #### */

