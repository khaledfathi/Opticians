/**
 * ajax request function  
 * @param {string} url - targt to fetch
 * @param {string} method - HTTP method
 * @param {object} data - request data 
 * @param {string} csrf - csrf key 
 * @returns (await) response as json format 
 */
const request = async (url='', method='GET' , data={} ,  csrf='') => {
    var response = {}; 
    if (method =='GET'){
        var response = await fetch(url); 
    }else if (method == 'POST' ) {
        var response = await fetch(url, {
            method: method,
            headers: {
                'X-CSRF-TOKEN': csrf, 
                mode: "cors", // no-cors, *cors, same-origin
                credentials: "same-origin", // include, *same-origin, omit
                Accept:"application/json",
                "Content-Type": "application/json"
            },
            body:JSON.stringify(data)
        });
    }
    return response.json();
};
