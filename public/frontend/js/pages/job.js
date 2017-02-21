var Job = {
    addExpBtn: $('#add_exp_btn'),
    init: function() {
        this.bindUIActions();
    },
    bindUIActions: function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $(document).on('click', 'a#reply_question', function (e) {
            e.preventDefault();
            $(this).closest('div.media-body').find('form').fadeIn();
        });

        $(document).on('click', 'a#reply_cancel', function (e) {
            e.preventDefault();
            $(this).closest('form').fadeOut();
        });

        $(document).on('submit', 'form.question-form', function(e) {
            e.preventDefault();
            var formObj = $(this);
            var job_id = $('div#job_info').data('id');
            formObj.find('input[name=job_id]').remove();
            formObj.append("<input type='hidden' name='job_id' value='" + job_id + "'>");
            formObj.ajaxSubmit({
                success: function(data) {
                    formObj.find('input').parent().removeClass('has-error');
                    formObj.find('input').parent().find('span').remove();
                    formObj.find('input[name=content]').val('');

                    $.get( "/job_questions/" + data.id, function( data ) {
                        $( "div.job-questions" ).prepend( data );
                    });
                }, error: function(data) {
                    if (data.status == 401)
                        window.location.href = '/login';
                    var response  = data.responseJSON.message;
                    $.each(response, function( key, value ) {
                        var inputObj = $('input[name=' + key + ']');
                        inputObj.parent().removeClass('has-error').addClass('has-error');
                        var tempHtml = ' <span class="help-block"> \
                                            <strong>' + value + '</strong> \
                                        </span>';
                        inputObj.parent().find('span').remove();
                        inputObj.parent().append(tempHtml);
                    });
                }
            })

        });

        $(document).on('submit', 'form.answer-form', function(e) {
            e.preventDefault();
            var formObj = $(this);
            formObj.ajaxSubmit({
                success: function(data) {
                    $.get( "/job_questions/" + data.id + "/answers", function( data ) {
                        formObj.closest( "div.media-body" ).find('div.job-answers').prepend( data );
                    });
                    formObj.find('input').parent().removeClass('has-error');
                    formObj.find('input').parent().find('span').remove();
                    formObj.find('input[name=content]').val('');
                    formObj.fadeOut();
                }, error: function(data) {
                    if (data.status == 401)
                        window.location.href = '/login';
                    var response  = data.responseJSON.message;
                    $.each(response, function( key, value ) {
                        var inputObj = formObj.find('input[name=' + key + ']');
                        inputObj.parent().removeClass('has-error').addClass('has-error');
                        var tempHtml = ' <span class="help-block"> \
                                            <strong>' + value + '</strong> \
                                        </span>';
                        inputObj.parent().find('span').remove();
                        inputObj.parent().append(tempHtml);
                    });
                }
            })

        });
    },
};