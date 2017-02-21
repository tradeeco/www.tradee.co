var Home = {
    DropzoneElement: '#dropzone_preview',
    PHOTO_IDS: [],
    init: function() {
        this.initUI();
    },
    initAfter: function() {
        this.bindUIActions();
    },
    initUI: function() {
        $('.chosen-select').chosen({width: "100%"});
    },
    bindUIActions: function() {

        var mediaDropzone;
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        Dropzone.autoDiscover = false;
        mediaDropzone = new Dropzone(Home.DropzoneElement, {
            url: $(Home.DropzoneElement).data('url'),
            paramName: "file",
            addRemoveLinks: true
        });
        mediaDropzone.on("sending", function(file, xhr, data) {
            return data.append("_token", CSRF_TOKEN);
        });
        mediaDropzone.on('complete', function(file, response) {
            var message_template;
            if (file.status === 'success') {
                Home.PHOTO_IDS.push(JSON.parse(file.xhr.response).id);
                $(file.previewTemplate).find('.dz-remove').attr('id', JSON.parse(file.xhr.response).id);
            } else {
                message_template = '';
                $.each(JSON.parse(file.xhr.response), function(field, messages) {
                    message_template += '<p>' + messages + '</p>';
                });
                $(file.previewTemplate).find('div.dz-error-message').find('span').html(message_template);
                setTimeout(function() {
                    return $(file.previewTemplate).fadeOut('slow', function() {
                        return mediaDropzone.removeFile(file);
                    });
                }, 5000);
            }
        });
        mediaDropzone.on('removedfile', function(file) {
            var id;
            id = $(file.previewTemplate).find('.dz-remove').attr('id');
            $.ajax({
                type: 'POST',
                url: '/jobs/delete_photo',
                data: {
                    id: id,
                    '_token': CSRF_TOKEN,
                },
                success: function(file) {
                    var i;
                    $(file.previewTemplate).fadeOut();
                    i = Home.PHOTO_IDS.indexOf(id * 1);
                    if (i !== -1) {
                        Home.PHOTO_IDS.splice(i, 1);
                    }
                }
            });
        });
        $('form#create_job').unbind('submit').on('submit', function() {
            $(this).find('input[name=doc_ids]').remove();
            $(this).append("<input type='hidden' name='photo_ids' value='" + Home.PHOTO_IDS + "'>");
            Home.PHOTO_IDS = [];
        });
    },
};