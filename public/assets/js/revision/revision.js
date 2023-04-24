/* #### constants #### */
const tableBody = document.querySelector('#table-body'); 
const deleteButtons = document.getElementsByName('delete-button'); 
const date = document.querySelector('#date');
/* #### end constants #### */


/* #### General #### */
date.value= currentDate(); 
/* #### end General #### */

/* #### Functions #### */
/* #### End Functions #### */

/* #### Event Actions #### */
/* #### end Event Actions #### */


/* #### Events #### */  
// event double click to edit rows 
tableBody.addEventListener('dblclick' , (event)=>{
    let editLink = event.target.parentElement.children[0].value; 
    console.log(editLink); 
    window.location=editLink;
}); 

//add event for all delete buttons
for (let i of deleteButtons){
    i.addEventListener('click' , ()=>{
        Swal.fire({
            title: 'حذف امر شغل !',
            text: "سيتم حذف كل الطلبات المتعلقة بامر الشغل ؟",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            cancelButtonText: 'الغاء',
            confirmButtonText: 'موافق'
        }).then((result) => {
            if (result.isConfirmed) {
                let deleteLink = i.parentElement.children[0].value; //hidden input carry the delete link
                request(deleteLink ).then((response)=>{
                    if (response.ok) {
                        i.parentElement.parentElement.remove(); 
                        Swal.fire(
                            response.msg,
                            '',
                            'success'
                          )
                    }else {
                         Swal.fire(
                            '',
                            response.msg,
                            'error'
                          )
                    }; 
                });
            }
        })
    }); 
}
/* #### end Events #### */  




