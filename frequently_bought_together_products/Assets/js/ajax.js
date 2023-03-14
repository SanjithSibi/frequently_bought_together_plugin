
jQuery(document).ready(function($) {
    $('#submit').click(function() {

        var values=$('#form').serializeArray();
        //console.log(values);
       $.ajax({
            type: 'post',
            url: contactForm.ajaxUrl,
            data: {
                action: 'submitForm',
                values:values,
            }


        });


        return false;
    });
});
