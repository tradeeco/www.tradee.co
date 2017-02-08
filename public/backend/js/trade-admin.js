var TradeAdmin = {

    addInputBtn: $('#add_cat_btn'),
    completeInputBtn: $('.Input-complete-btn'),
    InputTemplate: '<div class="col-sm-4 m-b input-wrap"> \
                            <input type="text" class="form-control rounded input-lg" name="name[]"> \
                            <a href="#" id="delete_cat_btn" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a> \
                       </div>',

    init: function() {
        this.bindUIActions();
    },
    bindUIActions: function() {
        // Add new Input item
        this.addInputBtn.click(function () {
            var newInput = $('div.input-wrap:last');
            newInput.after(TradeAdmin.InputTemplate);
            newInput.find('input[type=text]:first').focus();
            return false;
        });
        $(document).on('click', '#delete_cat_btn', function (e) {
            if($(this).parent().is(':first-child')){
                $(this).parent().find('input[type=text]').val('');
                return;
            };
            $(this).parent().remove();
            return false;
        });
        // Set Input as complete via AJAX
        this.completeInputBtn.change(function () {
            var h3 = $(this).parent().parent().parent().parent().find('h3');
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var url = '/schedules/update-Input';
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    id: $(this).attr('id'),
                    complete: $(this).is(':checked')? 1 : 0,
                    '_token': CSRF_TOKEN
                },
                dataType: 'JSON',
                success: function (data) {
                    h3.find('span').remove();
                    h3.append(data.status_label);
                }
            });
            return false;
        });
        // Delete Input via AJAX
        $(document).on('click', '#delete_btn', function (e) {
            e.preventDefault();
            var trWrapper = $(this).closest('tr');

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var url = $(this).attr('href');
            if (confirm('Are you sure you want to delete this?')) {
                $.ajax({
                    type: 'DELETE',
                    url: url,
                    data: {
                        '_token': CSRF_TOKEN,
                        '_method': 'DELETE'
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        trWrapper.remove();
                    }
                });
            }
            return false;
        });
    },
};