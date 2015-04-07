var modal = (function () {

    return {

        // Centre modal window

        centre: function(){

            // find half of the height of the window minus the height of the content
            var top = Math.max($(window).height() - $('#home-content').outerHeight(), 0) / 2;
            // find half of the width of the window minus the width of the content
            var left = Math.max($(window).width() - $('#home-content').outerWidth(), 0) / 2;

            // Apply the height and width
            $('#home-content').css({
                top: top , 
                left: left
            });

        },

        // Open modal window

        open: function (id) {

            $.ajax({
                type: "POST",
                url: "modal.php", // Process request here
                data: {id: id}, // POST the ID to 'modal.php'
                beforeSend:function(){ // "loading icon"
                    $('#modal').css('display', 'block');
                    $('#modal').load('./model/loading.php');
                },
                success:function(response){

                    $('#modal').empty().append(response);

                    modal.centre();
                    $(window).on('resize', modal.centre);

                    // Add the response from the server to the HTML
                    $('#modal-close').on('click', function (e) {
                        e.preventDefault();
                        modal.close();
                    });

                    //Source http://stackoverflow.com/questions/9333531/hiding-a-div-with-esc-key-and-off-click-in-jquery

                    // On click of anywhere in #modal tag, 
                    // but outside the #feed-content tag, close window
                    $('#modal').on( 'click', function ( e ) {
                        if ( $(e.target).closest('#home-content').length === 0 ) {
                            e.preventDefault();
                            modal.close();
                        }
                    });

                    // ESC key - close the modal window on keydown
                    $(document).on( 'keydown', function ( e ) {
                        if ( e.keyCode === 27 ) { // ESC
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
            $('#home-content').remove();
            // Change CSS back to initial state of hidden
            $('#modal').css('display', 'none');

        },
        
    
        
        openRegister: function () {
            $.ajax( {
                type: "POST",
                url: "register.php", 
                success: function(response) {
                    $('#modal').css('display', 'block');
                    $('#modal').empty().append(response);
                    
                    $('#modal-close').on('click', function (e) {
                        e.preventDefault();
                        modal.close();
                    });
                    $('#modal').on('click', function(e) {
                        if ($(e.target).closest('#register').length === 0 ) {
                            e.preventDefault();
                            modal.close();
                        }
                    });
                    $(document).on('keydown', function (e) {
                        if (e.keyCode === 27) {
                            e.preventDefault();
                            modal.close();
                        }
                    });
                }
            });
        },
    

        openLogin: function () {
            
            $.ajax({
                type: "POST",
                url: "login.php", // Process request here
                success: function(response) {
                    $('#modal').css('display', 'block');
                    $('#modal').empty().append(response);
                    
                     $('#modal-close').on('click', function (e) {
                        e.preventDefault();
                        modal.close();
                    });
                    //Source http://stackoverflow.com/questions/9333531/hiding-a-div-with-esc-key-and-off-click-in-jquery

                    // On click of anywhere in #modal tag, 
                    // but outside the #feed-content tag, close window
                    $('#modal').on( 'click', function ( e ) {
                        if ( $(e.target).closest('#login').length === 0 ) {
                            e.preventDefault();
                            modal.close();
                        }
                    });

                    // ESC key - close the modal window on keydown
                    $(document).on( 'keydown', function ( e ) {
                        if ( e.keyCode === 27 ) { // ESC
                            e.preventDefault();
                            modal.close();
                        }
                    });
                        
                }
            });
            
        }
    }

}());