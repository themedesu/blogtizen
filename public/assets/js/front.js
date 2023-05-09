/*! For license information please see front.js.LICENSE.txt */
(function($) {
    "use strict";
})();

document.addEventListener("DOMContentLoaded", function() {
  // Dropdown Menu
  // Make it as accordion for smaller screens
  if (window.innerWidth < 992) {
  
    // close all inner dropdowns when parent is closed
    document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown){
      everydropdown.addEventListener('hidden.bs.dropdown', function () {
        // after dropdown is hidden, then find all submenus
          this.querySelectorAll('.submenu').forEach(function(everysubmenu){
            // hide every submenu as well
            everysubmenu.style.display = 'none';
          });
      })
    });
  
    document.querySelectorAll('.dropdown-menu a').forEach(function(element){
      element.addEventListener('click', function (e) {
          let nextEl = this.nextElementSibling;
          if(nextEl && nextEl.classList.contains('submenu')) {	
            // prevent opening link if link needs to open dropdown
            e.preventDefault();
            if(nextEl.style.display == 'block'){
              nextEl.style.display = 'none';
            } else {
              nextEl.style.display = 'block';
            }
  
          }
      });
    })
  }

  // Scroll Menu
  window.addEventListener('scroll', function() {
    if (window.innerWidth > 1000){
      if (window.scrollY > 150) {
        document.getElementById('is-header-fixed').classList.add('fixed-top');
        navbar_height = document.querySelector('.navbar').offsetHeight;
        document.body.style.paddingTop = navbar_height + 'px';
      } else {
        document.getElementById('is-header-fixed').classList.remove('fixed-top');
        document.body.style.paddingTop = '0';
      } 
    }
  });
  
  // Current Year
  document.getElementById("year").innerHTML = new Date().getFullYear()+' ';
}); 