$(document).ready(() => {
   $('#navbarDropdown').click(function() {
      $('.dropdown-menu').toggle();
   });

   $('.post').click(function(e) {
      $(this.querySelectorAll(':scope > .post-body')).toggle();
   });
});