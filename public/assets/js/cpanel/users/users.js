const tableBody = document.querySelector('#table-body'); 
const deleteButtons = document.getElementsByName('delete-button'); 

// event double click to edit rows 
tableBody.addEventListener('dblclick' , (event)=>{
    let editLink = event.target.parentElement.children[0].value; 
    window.location=editLink;
}); 

//add event for all delete buttons
for (let i of deleteButtons){
    i.addEventListener('click' , ()=>{
        Swal.fire({
            title: 'حذف مستخدم !',
            text: "هل انت متأكد ؟",
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

