/*
 *  Document   : contact.js
 *  Author     : pixelcave
 *  Description: Custom javascript code used in Contact page
 */

var Contact = function() {

    return {
        init: function() {
            /*
             * With Gmaps.js, Check out examples and documentation at http://hpneo.github.io/gmaps/examples.html
             */

            // Set top section height to Google Maps container
            $('#gmap').css('height', 350);

            // Initialize map
            new GMaps({
                div: '#gmap',
                lat: 7.878960,
                lng: -72.496851,
                zoom: 15,
                disableDefaultUI: true,
                scrollwheel: false
            }).addMarkers([
                {
                    lat: 7.878960,
                    lng: -72.496851,
                    title: 'Find Us',
                    infoWindow: {content: '<strong>Direccion de la Empresa</strong>'},
                    animation: google.maps.Animation.DROP
                }
            ]);

            /*
             *  Jquery Validation, Check out more examples and documentation at https://github.com/jzaefferer/jquery-validation
             */

            /* Initialize Form Validation */
            $('#form-contact').validate({
                errorClass: 'help-block animation-slideDown', // You can change the animation class for a different entrance animation
                errorElement: 'div',
                errorPlacement: function(error, e) {
                    e.parents('.form-group').append(error);
                },
                highlight: function(e) {
                    $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
                    $(e).closest('.help-block').remove();
                },
                success: function(e) {
                    // You can use the following if you would like to highlight with green color the input after successful validation!
                    e.closest('.form-group').removeClass('has-success has-error'); // e.closest('.form-group').removeClass('has-success has-error').addClass('has-success');
                    e.closest('.help-block').remove();
                },
                rules: {
                    'contact-name': {
                        required: true,
                        minlength: 3
                    },
                    'contact-email': {
                        required: true,
                        email: true
                    },
                    'contact-message': {
                        required: true,
                        minlength: 5
                    }
                },
                messages: {
                    'contact-name': {
                        required: 'Escribe tu nombre',
                        minlength: 'Escribe tu nombre'
                    },
                    'contact-email': 'Escribe tu email',
                    'contact-message': {
                        required: 'Escribe un mensaje',
                        minlength: 'Escribe un mensaje'
                    }
                }
            });
        }
    };
}();