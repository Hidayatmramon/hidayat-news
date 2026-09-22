(function($) {
    'use strict';
    $(function() {

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview').attr('src', e.target.result);
                    $('#image-preview').hide();
                    $('#image-preview').fadeIn(650);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview2').attr('src', e.target.result);
                    $('#image-preview2').hide();
                    $('#image-preview2').fadeIn(650);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview3').attr('src', e.target.result);
                    $('#image-preview3').hide();
                    $('#image-preview3').fadeIn(650);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURL4(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview4').attr('src', e.target.result);
                    $('#image-preview4').hide();
                    $('#image-preview4').fadeIn(650);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        $("#file-input").on('change',function() {
            readURL(this);
        });

        $("#file-input2").on('change',function() {
            readURL2(this);
        });

        $("#file-input3").on('change',function() {
            readURL3(this);
        });

        $("#file-input4").on('change',function() {
            readURL4(this);
        });

        $("#file-slider-input2").on('change',function() {
            readURL2(this);
        });

        $("#file-tstmnl-input2").on('change',function() {
            readURL2(this);
        });

        $("#file-service-input2").on('change',function() {
            readURL2(this);
        });
        
    });
})(jQuery);
