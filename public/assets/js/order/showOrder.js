
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
        if (result.isConfirmed){
            request(orderRevisionLink.value).then((res)=>{
                event.target.innerHTML= 'تمت المراجعة بواسطة : '+res.revisioner; 
                event.target.style.background='green';
                event.target.disabled=true;
                Swal.fire(
                    'تمت المراجعة',
                    '',
                    'success'
                    )
            });
        };
    });
}
/* #### End Event Actions #### */

/* #### Events #### */
(orderRevisionButton) ? orderRevisionButton.addEventListener('click' , eventSetOrderRevision) : null ; 


/* Event for many elements */ 
for (let i of workDivs){
    let button = i.children[2].children[0].children[0]; 
    if (button.innerHTML == 'مراجعة'){
        button.addEventListener('click' ,(event)=>{
        let workRevisionLink = i.children[2].children[0].children[1].value;
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
                if (result.isConfirmed){
                    console.log('in');
                    request(workRevisionLink).then((res)=>{
                        event.target.innerHTML= 'تمت المراجعة بواسطة : '+res.revisioner; 
                        event.target.style.background='green';
                        event.target.disabled=true;
                        Swal.fire(
                            'تمت المراجعة',
                            '',
                            'success'
                            )
                    });
                };
            }); 
        }); 
    }
}
/* end Event for many elements */ 
/* #### End Events #### */


/*########################################################*/ 
