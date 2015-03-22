var modal = (function () {

    return {

        centre: function(){

            var top = Math.max($(window).height() - $('#modal-content').outerHeight(), 0) / 2;
            var left = Math.max($(window).width() - $('#modal-content').outerWidth(), 0) / 2;

            $('#modal-content').css({
                top: top , 
                left: left
            });

        },

        open: function (id) {

            $.ajax({
                type: "POST",
                url: "modal.php",
                data: {id: id},
                beforeSend:function(){
                    $('#modal').css('display', 'block');
                    $('#modal').append('./model/loading.php');
                },
                success:function(response){

                    $('#modal').empty().append(response);

                    modal.centre();
                    $(window).on('resize', modal.centre);

                    $('#modal-close').on('click', function (e) {
                        e.preventDefault();
                        modal.close();
                    });

                }
            });

        },

        close: function () {

            $('#modal-content').remove();
            $('#modal').css('display', 'none');

        }

    };

}());