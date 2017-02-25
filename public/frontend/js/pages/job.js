var Job = {
    addExpBtn: $('#add_exp_btn'),
    moveWatching: $('a#move_watching'),
    deleteWatching: $('a#delete_watching'),
    moveInterest: $('a#move_interest'),
    deleteInterest: $('a#delete_interest'),
    moveShortlist: $('a#move_shortlist'),
    deleteShortlist: $('a#delete_shortlist'),
    expressInterest: $('a#express_interest'),
    userShortlistsTab: $('a[href="#user_shortlists"]'),
    userSelectedTab: $('a[href="#user_selected"]'),
    userInterestedTab: $('a[href="#user_interested"]'),
    SuccessTemplate: '<div class="alert alert-success alert-dismissibl fade in"> \
                            <p>Success</p> \
                        </div>',
    init: function() {
        this.bindUIActions();
    },
    initShow: function(){
        $('#myCarousel').carousel({
            interval: 5000
        });

        //Handles the carousel thumbnails
        $('[id^=carousel-selector-]').click(function () {
            var id_selector = $(this).attr("id");
            try {
                var id = /-(\d+)$/.exec(id_selector)[1];
                console.log(id_selector, id);
                jQuery('#myCarousel').carousel(parseInt(id));
            } catch (e) {
                console.log('Regex failed!', e);
            }
        });
        // When the carousel slides, auto update the text
        $('#myCarousel').on('slid.bs.carousel', function (e) {
            var id = $('.item.active').data('slide-number');
            $('#carousel-text').html($('#slide-content-'+id).html());
        });

        var owl1 = jQuery(".owl-slider-v2").owlCarousel({
            itemsDesktop : [1600,3],
            itemsDesktopSmall : [900,2],
            itemsTablet: [600,2],
            itemsMobile : [479,2],
            slideSpeed: 1000
        });
        jQuery(".next-v2").click(function(){
            owl1.trigger('owl.next');
        });
        jQuery(".prev-v2").click(function(){
            owl1.trigger('owl.prev');
        });
    },
    bindUIActions: function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var Job_Id = $('div#job_info').data('id');

        this.moveWatching.click(function (e) {
            var thisObj = $(this);
            e.preventDefault();
            var jqxhr = $.post( "/jobs/move_watching/" + Job_Id, { _token: CSRF_TOKEN })
            .done(function() {
                Job.moveWatching.fadeOut();
                Job.moveWatching.parent().append($(Job.SuccessTemplate).hide().fadeIn(500).fadeOut(1500));
                thisObj.closest('tr').fadeOut().remove();
            })
            .fail(function() {
                alert( "error" );
            });
            // var newExp = $('div.experience-wrap div.input-wrap:last');
            // newExp.find('input[type=text]:first').focus();
            return false;
        });

        this.deleteWatching.click(function (e) {
            e.preventDefault();
            var thisObj = $(this);
            var job_id = thisObj.closest('tr').find('td.job-title').find('a').data('id');
            var jqxhr = $.post( "/jobs/delete_watching/" + job_id, { _token: CSRF_TOKEN })
                .done(function() {
                    thisObj.fadeOut();
                    thisObj.closest('tr').fadeOut().remove();
                })
                .fail(function() {
                    alert( "error" );
                });
            // var newExp = $('div.experience-wrap div.input-wrap:last');
            // newExp.find('input[type=text]:first').focus();
            return false;
        });

        this.moveInterest.click(function (e) {
            e.preventDefault();
            var thisObj = $(this);
            var job_id = thisObj.closest('tr').find('td.job-title').find('a').data('id');
            var jqxhr = $.post( "/jobs/move_interest/" + job_id, { _token: CSRF_TOKEN })
                .done(function() {
                    thisObj.fadeOut();
                    thisObj.parent().append($(Job.SuccessTemplate).hide().fadeIn(500).fadeOut(1500));
                    thisObj.closest('tr').fadeOut().remove();
                })
                .fail(function() {
                    alert( "error" );
                });
            // var newExp = $('div.experience-wrap div.input-wrap:last');
            // newExp.find('input[type=text]:first').focus();
            return false;
        });

        this.deleteInterest.click(function (e) {
            e.preventDefault();
            var thisObj = $(this);
            var job_id = thisObj.closest('tr').find('td.job-title').find('a').data('id');
            var jqxhr = $.post( "/jobs/delete_interest/" + job_id, { _token: CSRF_TOKEN })
                .done(function() {
                    thisObj.fadeOut();
                    thisObj.closest('tr').fadeOut().remove();
                })
                .fail(function() {
                    alert( "error" );
                });
            // var newExp = $('div.experience-wrap div.input-wrap:last');
            // newExp.find('input[type=text]:first').focus();
            return false;
        });

        this.moveShortlist.click(function (e) {
            var thisObj = $(this);
            e.preventDefault();
            var job_id = thisObj.closest('tr').find('td.job-title').find('a').data('id');
            var jqxhr = $.post( "/jobs/move_shortlist/" + job_id, { _token: CSRF_TOKEN })
                .done(function() {
                    thisObj.fadeOut();
                    thisObj.parent().append($(Job.SuccessTemplate).hide().fadeIn(500).fadeOut(1500));
                    thisObj.closest('tr').fadeOut().remove();
                })
                .fail(function() {
                    alert( "error" );
                });
            // var newExp = $('div.experience-wrap div.input-wrap:last');
            // newExp.find('input[type=text]:first').focus();
            return false;
        });

        this.deleteShortlist.click(function (e) {
            e.preventDefault();
            var thisObj = $(this);
            var job_id = thisObj.closest('tr').find('td.job-title').find('a').data('id');
            var jqxhr = $.post( "/jobs/delete_shortlist/" + job_id, { _token: CSRF_TOKEN })
                .done(function() {
                    thisObj.fadeOut();
                    thisObj.closest('tr').fadeOut().remove();
                })
                .fail(function() {
                    alert( "error" );
                });
            // var newExp = $('div.experience-wrap div.input-wrap:last');
            // newExp.find('input[type=text]:first').focus();
            return false;
        });

        this.expressInterest.click(function (e) {
            e.preventDefault();
            var thisObj = $(this);
            var userId = thisObj.closest('div.row').find('div.job-user').find('img').data('user');
            var jqxhr = $.post( "/users/express_interest/" + userId, { _token: CSRF_TOKEN })
                .done(function() {
                    thisObj.fadeOut();
                    thisObj.closest('div').append($(Job.SuccessTemplate).hide().fadeIn(500).fadeOut(1500));
                    thisObj.remove();
                })
                .fail(function() {
                    alert( "error" );
                });
            // var newExp = $('div.experience-wrap div.input-wrap:last');
            // newExp.find('input[type=text]:first').focus();
            return false;
        });

        this.userInterestedTab.click(function (e) {
            //e.preventDefault();
            $( "div#user_interested" ).load( "/users/tagged_users/0", function() {
            });
        });

        this.userShortlistsTab.click(function (e) {
            //e.preventDefault();
            $( "div#user_shortlists" ).load( "/users/tagged_users/1", function() {
            });
        });

        this.userSelectedTab.click(function (e) {
            //e.preventDefault();
            $( "div#user_selected" ).load( "/users/tagged_users/2", function() {
            });
        });

        $(document).on('click', 'a#reply_question', function (e) {
            e.preventDefault();
            $(this).closest('div.media-body').find('form').fadeIn();
        });

        $(document).on('click', 'a#reply_cancel', function (e) {
            e.preventDefault();
            $(this).closest('form').fadeOut();
        });

        $(document).on('click', 'a#express_shortlist', function (e) {
            e.preventDefault();
            var thisObj = $(this);
            var userId = thisObj.closest('tr').find('td:first').find('img').data('user_tag');
            var jqxhr = $.post( "/users/express_shortlist/" + userId, { _token: CSRF_TOKEN })
                .done(function() {
                    thisObj.closest('tr').fadeOut().remove();
                    $('a[href="#user_shortlists"] span').text($('a[href="#user_shortlists"] span').text()*1 + 1);
                    $('a[href="#user_interested"] span').text($('a[href="#user_interested"] span').text()*1 - 1);
                })
                .fail(function() {
                    alert( "error" );
                });
            $(this).closest('div.media-body').find('form').fadeIn();
        });

        $(document).on('click', 'a#express_select', function (e) {
            e.preventDefault();
            var thisObj = $(this);
            var userId = thisObj.closest('tr').find('td:first').find('img').data('user_tag');
            var jqxhr = $.post( "/users/express_select/" + userId, { _token: CSRF_TOKEN })
                .done(function() {
                    thisObj.closest('tr').fadeOut().remove();
                    $('a[href="#user_selected"] span').text($('a[href="#user_selected"] span').text()*1 + 1);
                    $('a[href="#user_shortlists"] span').text($('a[href="#user_shortlists"] span').text()*1 - 1);
                })
                .fail(function() {
                    alert( "error" );
                });
            $(this).closest('div.media-body').find('form').fadeIn();
        });

        $(document).on('click', 'a#delete_user_selected', function (e) {
            e.preventDefault();
            var thisObj = $(this);
            var userId = thisObj.closest('tr').find('td:first').find('img').data('user_tag');
            var jqxhr = $.post( "/users/delete_tagged/" + userId + '/2', { _token: CSRF_TOKEN })
                .done(function() {
                    thisObj.fadeOut();
                    thisObj.closest('tr').fadeOut().remove();
                    $('a[href="#user_selected"] span').text($('a[href="#user_selected"] span').text()*1 - 1);
                    $('a[href="#user_shortlists"] span').text($('a[href="#user_shortlists"] span').text()*1 + 1);
                })
                .fail(function() {
                    alert( "error" );
                });
            // var newExp = $('div.experience-wrap div.input-wrap:last');
            // newExp.find('input[type=text]:first').focus();
            return false;
        });

        $(document).on('click', 'a#delete_user_shortlisted', function (e) {
            e.preventDefault();
            var thisObj = $(this);
            var userId = thisObj.closest('tr').find('td:first').find('img').data('user_tag');
            var jqxhr = $.post( "/users/delete_tagged/" + userId + '/1', { _token: CSRF_TOKEN })
                .done(function() {
                    thisObj.fadeOut();
                    thisObj.closest('tr').fadeOut().remove();
                    $('a[href="#user_shortlists"] span').text($('a[href="#user_shortlists"] span').text()*1 - 1);
                    $('a[href="#user_interested"] span').text($('a[href="#user_interested"] span').text()*1 + 1);
                })
                .fail(function() {
                    alert( "error" );
                });
            // var newExp = $('div.experience-wrap div.input-wrap:last');
            // newExp.find('input[type=text]:first').focus();
            return false;
        });

        $(document).on('click', 'a#delete_user_interested', function (e) {
            e.preventDefault();
            var thisObj = $(this);
            var userId = thisObj.closest('tr').find('td:first').find('img').data('user_tag');
            var jqxhr = $.post( "/users/delete_tagged/" + userId + '/4', { _token: CSRF_TOKEN })
                .done(function() {
                    thisObj.fadeOut();
                    thisObj.closest('tr').fadeOut().remove();
                    $('a[href="#user_interested"] span').text($('a[href="#user_interested"] span').text()*1 - 1);
                })
                .fail(function() {
                    alert( "error" );
                });
            // var newExp = $('div.experience-wrap div.input-wrap:last');
            // newExp.find('input[type=text]:first').focus();
            return false;
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