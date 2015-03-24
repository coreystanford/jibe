$(document).ready(function () {

    // Find ID associated with the profile in the 'follow' button
    var follow_id = $('#user').find('.follow-profile').attr('rel');

    // On click of the 'follow' button
    $('#user').on('click', '.follow-profile', function (e) {

        e.preventDefault();
        
        // Send AJAX Request
        $.ajax({
            type: "POST",
            url: "follow.php", // Process request here
            data: {id: follow_id}, // POST the ID
            success:function(){
                // On success, change span text of button
                $('#user').find('.follow-profile span').html('Following');
            },
            fail:function(){
                // On failure, change span text of button
                $('#user').find('.follow-profile span').html('Error');
            }
        });

    });

    // Find ID associated with the profile in the 'following' button
    var unfollow_id = $('#user').find('.unfollow-profile').attr('rel');

    // Change the text of the 'following' button on hover
    $(".unfollow-profile").hover(function(){
        $('.unfollow-profile span').html('Unfollow');
        }, function(){
        $('.unfollow-profile span').html('Following');
    });

    // On click of the 'unfollow' button
    $('#user').on('click', '.unfollow-profile', function (e) {

        e.preventDefault();
        
        // Send AJAX Request
        $.ajax({
            type: "POST",
            url: "unfollow.php", // Process request here
            data: {id: unfollow_id}, // POST the ID
            success:function(){
                // On success, change span text of button
                $('#user').find('.unfollow-profile span').html('Unfollowed');
            },
            fail:function(){
                // On failure, change span text of button
                $('#user').find('.unfollow-profile span').html('Error');
            }
        });

        // After click, unbind the hover effect
        $('.unfollow-profile').unbind('mouseenter mouseleave');

    });

}());

                