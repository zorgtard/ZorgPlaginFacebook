
var $ = jQuery.noConflict();

$(document).ready(function(){


    $('#my_plugin_save_button').on('click', function(){
        var data = {
            action: 'save_settings',
            my_message: $('.my_message').val(),
            my_token: $('.my_token').val()
        };


        jQuery.post( ajaxurl, data, function(response) {
             alert('Сообщение сохранено!');
        });


    });

});