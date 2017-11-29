$(document).ready(function(){
    $('#tasks').DataTable({
        'bFilter': false,
        'paging':  false,
        'info': false,
    });
});

$(window).on('shown.bs.modal', function() {
    var username = $('#username').val();
    var email    = $('#email').val();
    var text     = $('#text').val();
    var modal_image    = $('#modal_image');

    resizeImage();

    $('#modal_username').text(username);
    $('#modal_email').text(email);
    $('#modal_text').text(text);
});

$(document).on('change', '#image', function () {
    readURL(this);
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#modal_image').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function resizeImage() {
    var modal_image = $('#modal_image');

    var maxWidth = 320;
    var maxHeight = 240;
    var ratio = 0;
    var width = modal_image.width();
    var height = modal_image.height();

    if(width > maxWidth){
        ratio = maxWidth / width;
        modal_image.css("width", maxWidth);
        modal_image.css("height", height * ratio);
        height = height * ratio;
        width = width * ratio;
    }

    if(height > maxHeight){
        ratio = maxHeight / height;
        modal_image.css("height", maxHeight);
        modal_image.css("width", width * ratio);
        width = width * ratio;
        height = height * ratio;
    }
}

