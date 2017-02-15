/* Write here your custom javascript codes */
$(function() {
    $('a#sign_in').click(function(e){
        e.preventDefault();
        $('div.sign-in-wrap').toggle();
    });
    $('form#sign_in_form button[type=submit]').click(function(e) {
        e.preventDefault();
        var formObj = $('form#sign_in_form');
        var formData = formObj.serialize();

        $('div.sign-in-wrap p.text-alert').remove();
        formObj.removeClass('has-error');

        $.ajax({
            url: formObj.attr('action'),
            type: 'POST',
            data: formData,
            success: function(data){
                window.location.href='/home';
                console.log(data);
            },
            error: function (data) {
                var tmpHtml = '<p class="text-alert fadeInLeftBig">Username Or Password is incorrect.</p>';
                $('div.sign-in-wrap').prepend(tmpHtml);
                formObj.addClass('has-error');
            }
        });
    });
});

var Common = {

    read_image: function(input, wrapClass) {
        var ext, reader;
        if (input.files && input.files[0]) {
            ext = $(input).val().split('.').pop().toLowerCase();
            if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) === -1) {
                alert('invalid extension!');
                return false;
            }
            reader = new FileReader();
            reader.onload = function(e) {
                return $('div.' + wrapClass + ' img').attr('src', e.target.result);
            };
            return reader.readAsDataURL(input.files[0]);
        }
    }
};