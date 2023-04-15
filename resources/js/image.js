
import PhotoSwipeLightbox from 'photoswipe/lightbox';
import 'photoswipe/style.css';


$(document).ready(function () {
    const lightbox = new PhotoSwipeLightbox({
        gallery: '.show-image',
        children: 'a.open-image',
        mouseMovePan: true,
        pswpModule: () => import('photoswipe')
    });
    lightbox.init();

})
