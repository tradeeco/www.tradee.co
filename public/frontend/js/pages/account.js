var Account = {
    addExpBtn: $('#add_exp_btn'),
    addJobSkillBtn: $('#add_exp_btn'),
    completeCategoryBtn: $('.Category-complete-btn'),
    ExperienceTemplate: $('div.experience-wrap div.row:last').clone(),
    init: function() {
        this.bindUIActions();
    },
    bindUIActions: function() {
        var mediaDropzone;
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        this.addExpBtn.click(function (e) {
            e.preventDefault();
            console.log(Account.ExperienceTemplate);
            $('div.experience-wrap div.row:last').after(Account.ExperienceTemplate);
            // var newExp = $('div.experience-wrap div.input-wrap:last');
            // newExp.find('input[type=text]:first').focus();
            return false;
        });

    },
};