$(document).ready(function () {

    $('.block-modal').on( 'click', function ( e ) {
        if ( $(e.target).closest('#block-modal-content').length === 0 ) {
            e.preventDefault();
            // Remove content from the inner tag
            $('#modal').css('display', 'none');
            $('.block-modal').remove();
        }
    });

    $('.block-modal').on('click', '#modal-close', function (e) {
        e.preventDefault();
        // Change CSS back to initial state of hidden
        $('#modal').css('display', 'none');
        $('.block-modal').remove();
    });

    // ESC key - close the modal window on keydown
    $(document).on( 'keydown', function ( e ) {
        if ( e.keyCode === 27 ) {
            e.preventDefault();
            // Remove content from the inner tag
            $('#img-content').remove();
            // Change CSS back to initial state of hidden
            $('#modal').css('display', 'none');
            $('.block-modal').remove();
        }
    });
    
});