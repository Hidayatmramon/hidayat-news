(function($) {
    'use strict';
    var msg = document.currentScript.getAttribute('data-msg');
    var icon = document.currentScript.getAttribute('data-icon');
    $(function() {
        var toastMixin = Swal.mixin({
            toast: true,
            position: 'top-right',
            iconColor: 'white',
            customClass: {
              popup: 'colored-toast'
            },
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
          });
          toastMixin.fire({
            icon: icon,
            title: msg
          });
      });
})(jQuery);
