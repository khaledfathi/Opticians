const save = document.querySelector('#save');
const csrfToken = document.querySelector('#csrf_token');

//ajax request
const request = async (url='' ,data={} , method='GET' , csrf='') => {
    if (method =='GET'){
        var response = await fetch(url , method=method); 
    }else if (method == 'POST') {
        var response = await fetch(url, {
            method: method,
            headers: {
                'X-CSRF-TOKEN': csrf, 
                mode: "cors", // no-cors, *cors, same-origin
                credentials: "same-origin", // include, *same-origin, omit
                Accept:"application/json",
                "Content-Type": "application/json",
            },
            body:JSON.stringify(data)
        });
    }else{
        return "Method is not allowed"; 
    }
    return response.json();
};

save.addEventListener('click', () => {
    data= {
        name: document.querySelector('[name="name"]').value, 
        password : document.querySelector('[name="password"]').value, 
        password_confirmation :  document.querySelector('[name="password_confirmation"]').value, 
        phone : document.querySelector('[name="phone"]').value, 
        type : document.querySelector('[name="type"]').value,
        status : document.querySelector('[name="status"]').value
    }
    request('/cpanel/usersmanagment/createuser' , data , 'POST', csrfToken.value).then((response) => {
        let errorOkDiv = document.querySelector('#errors'); 
        if (response.hasOwnProperty('errors')){
            errors = ""; 
            for (let key in response.errors){
                errors += `<p class=errors>${response.errors[key]}</p>`; 
            }
            errorOkDiv.innerHTML = errors; 
        }else if (response.hasOwnProperty('ok')){
            window.location='/'; 
            errorOkDiv = `<p class="ok">تم الحفظ</p>`
        }

    });
}); 
