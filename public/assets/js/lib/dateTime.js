
/**
 * get current Date
 * @returns {string} - stander date format (yyy-mm-dd)
 */
function currentDate(){
    const now = new Date(); 
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    let year = now.getFullYear();
    return `${year}-${month}-${day}`; 
}

/**
 * get current time
 * @returns {string} - current time (H:M)
 */
function currentTime(){
    const now = new Date(); 
    var hour = ("0" + now.getHours()).slice(-2);
    var minute = ("0" + (now.getMinutes() + 1)).slice(-2);
    return `${hour}:${minute}`; 
}