$(document).ready(function () {

    // Find ID associated with the profile in the 'follow' button
    var edit_id = $('#photoEdit').attr('rel');
    var img = $('.photo img').attr('src');

    // On click of the 'edit' button
    $('.photo').on('click', '.edit', function (e) {

        e.preventDefault();

        // Send AJAX Request
        $.ajax({
            type: "POST",
            url: "edit-img-modal.php", // Process request here
            data: {id: edit_id, img: img}, // POST the ID
            success:function(response){
                // On success, change span text of button
                $('#modal').css('display', 'block');
                $('#modal').empty().append(response);
            

                $('#modal-close').on('click', function (e) {
                    e.preventDefault();
                    $('#img-content').remove();
                    // Change CSS back to initial state of hidden
                    $('#modal').css('display', 'none');
                });

                $('#modal').on( 'click', function ( e ) {
                    if ( $(e.target).closest('#img-content').length === 0 ) {
                        e.preventDefault();
                        // Remove content from the inner tag
                        $('#img-content').remove();
                        // Change CSS back to initial state of hidden
                        $('#modal').css('display', 'none');
                    }
                });

            }

        });

    });

    var delete_id = $('#photoDelete').attr('rel');

    // On click of the 'delete' button
    $('.photo').on('click', '.delete', function (e) {

        e.preventDefault();
        
        // Send AJAX Request
        $.ajax({
            type: "POST",
            url: "delete-img-modal.php", // Process request here
            data: {id: delete_id, img: img}, // POST the ID
            success:function(response){
                // On success, change span text of button
                $('#modal').css('display', 'block');
                $('#modal').empty().append(response);
            
                $('#modal-close').on('click', function (e) {
                    e.preventDefault();
                    $('#img-content').remove();
                    // Change CSS back to initial state of hidden
                    $('#modal').css('display', 'none');
                });

            }

        });
    });

    $('#modal').on( 'click', function ( e ) {
        if ( $(e.target).closest('#img-content').length === 0 ) {
            e.preventDefault();
            // Remove content from the inner tag
            $('#img-content').remove();
            // Change CSS back to initial state of hidden
            $('#modal').css('display', 'none');
        }
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

}());

                