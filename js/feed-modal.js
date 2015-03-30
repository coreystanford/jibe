var modal = (function () {

    return {

        // Open modal window

        open: function (id) {

            // Send AJAX Request

            $.ajax({

                type: "POST",
                url: "modal.php", // Process request here
                data: {id: id}, // POST the ID to 'modal.php'
                beforeSend:function(){ // "loading icon"
                    $('#modal').css('display', 'block');
                    $('#modal').load('./loading.php');
                },
                timeout: 3000,
                error: function(x, t, m){
                    if(t === 'timeout' || t === 'error' || t === 'abort' || t === 'parsererror'){
                        $('#modal').load('/errors/loading-error.php');
                    }
                },
                success:function(response){

                    // Add the response from the server to the HTML
                    $('#modal').empty().append(response);

                    // On click of #modal-close, execute close function
                    $('#modal-close').on('click', function (e) {
                        e.preventDefault();
                        modal.close();
                    });

                    // Find ID associated with the profile in the 'follow' button
                    var follow_id = $('#modal').find('.follow-modal').attr('rel');

                    // On click of the 'follow' button
                    $('#modal').on('click', '.follow-modal', function (e) {

                        e.preventDefault();
                        
                        // Send AJAX Request
                        $.ajax({
                            type: "POST",
                            url: "follow.php", // Process request here
                            data: {id: follow_id}, // POST the ID
                            success:function(){
                                // On success, change span text of button
                                $('#modal').find('.follow-modal span').html('Following');
                            },
                            fail:function(){
                                // On failure, change span text of button
                                $('#modal').find('.follow-modal span').html('Error');
                            }
                        });

                    });

                    // Find ID associated with the profile in the 'unfollow' button
                    var unfollow_id = $('#modal').find('.unfollow-modal').attr('rel');

                    // On hover of the 'following' button, change text
                    $(".unfollow-modal").hover(function(){
                        $('.unfollow-modal span').html('Unfollow');
                        }, function(){
                        $('.unfollow-modal span').html('Following');
                    });

                    // On click of the 'following' button
                    $('#modal').on('click', '.unfollow-modal', function (e) {

                        e.preventDefault();
                        
                        // Send AJAX Request
                        $.ajax({
                            type: "POST",
                            url: "unfollow.php", // Process request here
                            data: {id: unfollow_id}, // POST the ID
                            timeout: 3000,
                            error: function(x, t, m){
                                if(t === 'timeout' || t === 'error' || t === 'abort' || t === 'parsererror'){
                                    // On failure, change span text of button
                                    $('#modal').find('.unfollow-modal span').html('Error');
                                }
                            },
                            success:function(){
                                // On success, change span text of button
                                $('#modal').find('.unfollow-modal span').html('Unfollowed');
                            }
                        });

                        // After click, unbind the hover effect
                        $('.unfollow-modal').unbind('mouseenter mouseleave');

                    });

                    //Source http://stackoverflow.com/questions/9333531/hiding-a-div-with-esc-key-and-off-click-in-jquery

                    // On click of anywhere in #modal tag, 
                    // but outside the #feed-content tag, close window
                    $('#modal').on( 'click', function ( e ) {
                        if ( $(e.target).closest('#feed-content').length === 0 ) {
                            e.preventDefault();
                            modal.close();
                        }
                    });

                    // ESC key - close the modal window on keydown
                    $(document).on( 'keydown', function ( e ) {
                        if ( e.keyCode === 27 ) {
                            e.preventDefault();
                            modal.close();
                        }
                    });

                }
                
            });

        },

        // Close modal window

        close: function () {

            // Remove content from the inner tag
            $('#feed-content').remove();
            // Change CSS back to initial state of hidden
            $('#modal').css('display', 'none');

        }

    };2

}());