const menuButton = document.querySelector('#menu-button'); 
const mobileMenu = document.querySelector('#mobile-menu'); 


function menuToggle(){
    (mobileMenu.hidden)? mobileMenu.hidden=false : mobileMenu.hidden=true; 
}
menuButton.addEventListener('click' , menuToggle); 