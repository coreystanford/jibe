var modal = (function () {

    return {

        open: function (id) {

            $.ajax({
                type: "POST",
                url: "modal.php",
                data: {id: id},
                beforeSend:function(){
                    $('#modal').css('display', 'block');
                    $('#modal').load('../model/loading.php');
                },
                success:function(response){

                    $('#modal').empty().append(response);

                    $('#modal-close').on('click', function (e) {
                        e.preventDefault();
                        modal.close();
                    });

                    var follow_id = $('#modal').find('.follow-modal').attr('rel');

                    console.log($('#modal'));

                    $('#modal').on('click', '.follow-modal', function (e) {

                        e.preventDefault();
                        
                        $.ajax({
                            type: "POST",
                            url: "follow.php",
                            data: {id: follow_id},
                            success:function(){
                                $('#modal').find('.follow-modal span').html('Following');
                            },
                            fail:function(){
                                $('#modal').find('.follow-modal span').html('Error');
                            }
                        });

                    });

                    //Source http://stackoverflow.com/questions/9333531/hiding-a-div-with-esc-key-and-off-click-in-jquery

                    $('#modal').on( 'click', function ( e ) {
                        if ( $(e.target).closest('#feed-content').length === 0 ) {
                            e.preventDefault();
                            modal.close();
                        }
                    });

                    $(document).on( 'keydown', function ( e ) {
                        if ( e.keyCode === 27 ) { // ESC
                            e.preventDefault();
                            modal.close();
                        }
                    });

                }
            });

        },

        close: function () {

            $('#feed-content').remove();
            $('#modal').css('display', 'none');

        }

    };

}());