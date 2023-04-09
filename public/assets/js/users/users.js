const tableBody = document.querySelector('#table-body'); 

tableBody.addEventListener('dblclick' , (event)=>{
    let userId = event.target.parentElement.children[0].innerHTML; 
    window.location=`/cpanel/users/${userId}`;
}); 
