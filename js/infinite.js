var loads = 1;
var limit = 1;
var offset;

$(function(){

	$.ajax({
		type: "POST",
        url: "infinite.php", // Process request here
        data: {limit: limit, offset: 0},
		beforeSend: function(){ // "loading icon"
            $('.feed').load('../model/loading.php');
        },
		success: function(response){
			$('.feed').empty().append(response);
			feedModal.initialize(); // load initializer from feed-modal-init.js
		}

	});

	$('.load-more').on('click', '#load-more', function (e) {

        e.preventDefault();
        
        loads++;
        offset = (loads * limit)  - limit;

        console.log(limit);
        console.log(offset);

        // Send AJAX Request
        $.ajax({
            type: "POST",
            url: "infinite.php", // Process request here
            data: {limit: limit, offset: offset}, // POST the ID
            beforeSend: function(){ // "loading icon"
	            $('#load-more span').html('<i class="fa fa-cog fa-spin fa-2x loading"></i>');
	        },
            success:function(response){
                // On success, change span text of button
                if(loads > 5){
                    $('.load-more span').html('Fully Loaded');
                } else {
                    $('.load-more span').html('Load More <i class="fa fa-chevron-down fa-lg"></i>');
                    $('.feed').append(response);
                    feedModal.initialize(); // load initializer from feed-modal-init.js
                }
            }
        });
    });
});


