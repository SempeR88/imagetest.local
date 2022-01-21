(function($) {

    $(document).ready(function() {

        /* Photos MagnificPopup */
        $('.photo-gallery').each(function() {
            $(this).magnificPopup({
                delegate: 'a.preview',
                type: 'image',
                closeOnContentClick: true,
                closeBtnInside: false,
                gallery: {
                    enabled: true,
                }
            });
        });
       
    });

})(jQuery);