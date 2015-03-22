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

                }
            });

        },

        close: function () {

            $('#feed-content').remove();
            $('#modal').css('display', 'none');

        }

    };

}());