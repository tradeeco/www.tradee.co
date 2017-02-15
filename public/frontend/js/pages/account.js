var Account = {
    addExpBtn: $('#add_exp_btn'),
    removeExpBtn: $('#delete_exp_btn'),
    addInterestedBtn: $('#add_interested_btn'),
    addJobSkillBtn: $('#add_exp_btn'),
    ExperienceTemplate: '<div class="row margin-bottom-20"> \
                            <div class="col-md-5"> \
                                <select class="form-control input-lg rounded" name="category_id[]">' + $('div.experience-wrap div.row:first select[name="category_id[]"]').html() + '</select> \
                            </div> \
                            <div class="col-md-5"> \
                                <select class="form-control input-lg rounded" name="length_id[]">' + $('div.experience-wrap div.row:first select[name="length_id[]"]').html() + '</select> \
                            </div> \
                            <div class="col-md-2"> \
                                <a href="#" id="delete_exp_btn" class="btn btn-danger btn-sm rounded"><i class="fa fa-trash"></i></a> \
                            </div>\
                         </div>',
    LengthTemplate: '<div class="row margin-bottom-20"> \
                        <div class="col-md-7"> \
                            <select class="form-control input-lg rounded" name="area_suburb_id[]">' + $('div.skill-wrap div.row:first select[name="area_suburb_id[]"]').html() + '</select> \
                        </div> \
                        <div class="col-md-2"> \
                        <a href="#" id="delete_interested_btn" class="btn btn-danger btn-sm rounded"><i class="fa fa-trash"></i></a> \
                        </div> \
                    </div>',
    EXPERIENCE_IDS: [],
    INTERESTED_IDS: [],
    init: function() {
        this.bindUIActions();
    },
    bindUIActions: function() {
        var mediaDropzone;
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        this.addExpBtn.click(function (e) {
            e.preventDefault();
            $('div.experience-wrap div.row:last').after(Account.ExperienceTemplate);
            // var newExp = $('div.experience-wrap div.input-wrap:last');
            // newExp.find('input[type=text]:first').focus();
            return false;
        });

        this.addInterestedBtn.click(function (e) {
            e.preventDefault();
            $('div.skill-wrap div.row:last').after(Account.LengthTemplate);
            // var newExp = $('div.experience-wrap div.input-wrap:last');
            // newExp.find('input[type=text]:first').focus();
            return false;
        });


        $(document).on('click', 'a#delete_exp_btn', function (e) {
            e.preventDefault();
            if ($(this).closest('div.row').find('input#experience_ids').length)
                Account.EXPERIENCE_IDS.push($(this).closest('div.row').find('input#experience_ids').val());
            $(this).closest('div.row').remove();
            // var newExp = $('div.experience-wrap div.input-wrap:last');
            // newExp.find('input[type=text]:first').focus();
            return false;
        });

        $(document).on('click', 'a#delete_interested_btn', function (e) {
            e.preventDefault();
            if ($(this).closest('div.row').find('input#interested_ids').length)
                Account.INTERESTED_IDS.push($(this).closest('div.row').find('input#interested_ids').val());
            $(this).closest('div.row').remove();
            // var newExp = $('div.experience-wrap div.input-wrap:last');
            // newExp.find('input[type=text]:first').focus();
            return false;
        });

        $('form.account-form').unbind('submit').on('submit', function() {
            $(this).find('input[name=remove_experience_ids]').remove();
            $(this).append("<input type='hidden' name='remove_experience_ids' value='" + Account.EXPERIENCE_IDS + "'>");
            Account.EXPERIENCE_IDS = [];

            $(this).find('input[name=remove_interested_ids]').remove();
            $(this).append("<input type='hidden' name='remove_interested_ids' value='" + Account.INTERESTED_IDS + "'>");
            Account.INTERESTED_IDS = [];
        });
    },
};