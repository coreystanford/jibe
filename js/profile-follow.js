$(document).ready(function () {

    var follow_id = $('#user').find('.follow-profile').attr('rel');

    $('#user').on('click', '.follow-profile', function (e) {

        e.preventDefault();
        
        $.ajax({
            type: "POST",
            url: "follow.php",
            data: {id: follow_id},
            success:function(){
                $('#user').find('.follow-profile span').html('Following');
            },
            fail:function(){
                $('#user').find('.follow-profile span').html('Error');
            }
        });

    });

    var unfollow_id = $('#user').find('.unfollow-profile').attr('rel');

    console.log(unfollow_id);

    $(".unfollow-profile").hover(function(){
        $('.unfollow-profile span').html('Unfollow');
        }, function(){
        $('.unfollow-profile span').html('Following');
    });

    $('#user').on('click', '.unfollow-profile', function (e) {

        e.preventDefault();
        
        $.ajax({
            type: "POST",
            url: "unfollow.php",
            data: {id: unfollow_id},
            success:function(){
                $('#user').find('.unfollow-profile span').html('Unfollowed');
            },
            fail:function(){
                $('#user').find('.unfollow-profile span').html('Error');
            }
        });

         $('.unfollow-profile').unbind('mouseenter mouseleave');

    });

}());

                