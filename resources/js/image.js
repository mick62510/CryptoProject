$(document).ready(function () {
    var previousX;
    var previousY;
    var clicking = false;

    $(document).on('click', 'img.img-extendable', function () {
        let src = $(this).attr('src');
        let imageFullscreen = $('.image-fullscreen');
        imageFullscreen.find('.image-fullscreen-gestion img').attr('src', src);
        imageFullscreen.fadeIn(500, function () {
            window.scrollTo(0, 0);
        });

    }).on('click', '.image-fullscreen-gestion-panel button.btn-image-close', function () {

        $('.image-fullscreen').fadeOut(500);
    }).on('click', '.image-fullscreen-gestion-panel button.btn-image-zoom-in', function () {
        let image = $(".image-fullscreen-gestion-image").find('img');
        let width = image.width() + 100;
        let height = image.height() + 100;
        image.height(height);
        image.width(width);
    }).on('click', '.image-fullscreen-gestion-panel button.btn-image-zoom-out', function () {
        let image = $(".image-fullscreen-gestion-image").find('img');
        let width = image.width() - 100;
        let height = image.height() - 100;
        image.height(height);
        image.width(width);
    }).on('mousemove', '.image-fullscreen-gestion-image', function (e) {
        if (clicking) {
            let image = $(".image-fullscreen-gestion-image");
            image.scrollLeft(image.scrollLeft() + (previousX - e.clientX));
            image.scrollTop(image.scrollTop() + (previousY - e.clientY));
            previousX = e.clientX;
            previousY = e.clientY;
        }
    }).mouseup(function () {

        clicking = false;
    }).mouseleave(function (e) {
        clicking = false;
    }).mousedown(function (e) {
        e.preventDefault();
        previousX = e.clientX;
        previousY = e.clientY;
        clicking = true;
    });


})
