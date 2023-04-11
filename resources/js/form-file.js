import $ from "jquery";
import "block-ui"

$(document).ready(function () {
    $('form input[type=file]').change(function () {
        let input = $(this);
        input.parents('fieldset').find('.alert').addClass('hidden');
        let urlAjax = input.data('upload-ajax');
        let files = input[0].files;

        if (urlAjax && files.length > 0) {
            addBlockUi();
            let formData = new FormData();
            formData.append('file', files[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('form input[name="_token"]').attr('value')
                }
            });
            $.ajax({
                type: "POST",
                url: urlAjax,
                contentType: false,
                processData: false,
                dataType: 'json',
                data: formData,
                success: function (response) {
                    removeBlockUi();
                    let image = response.file;
                    let preview = response.preview;
                    let fileName = response.fileName;
                    let fieldset = input.parents('fieldset');
                    let previewField = fieldset.find('.preview');
                    fieldset.find('input.input-file').val(image);
                    previewField.find('img').removeClass('hidden').attr('src', preview);
                    fieldset.find('label').html(fileName)

                },
                error: function (response) {
                    removeBlockUi();
                    let message = response.responseJSON.message;
                    let fieldset = input.parents('fieldset');
                    let alert = fieldset.find('.alert-danger');
                    fieldset.find('.preview img').addClass('hidden');
                    fieldset.find('label').html('Choose file')
                    alert.removeClass('hidden')
                    alert.html(message);
                },
            });
        }
    });
});

function addBlockUi() {
    $.blockUI({
        message: '<div class="ft-refresh-cw icon-spin font-medium-2"></div>',
        overlayCSS: {
            backgroundColor: "#FFF",
            opacity: 0.8,
            cursor: "wait"
        },
        css: {
            border: 0,
            padding: 0,
            backgroundColor: "transparent"
        }
    });
}

function removeBlockUi() {
    $.unblockUI();
}
