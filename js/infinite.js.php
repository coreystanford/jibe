var limit = $('#limit').attr('value');
var maxLoads = $('#loads').attr('value');
var loads = 1;
var offset;

$(function(){

	$.ajax({
		type: "POST",
        url: "infinite.php", // Process request here
        data: {limit: limit, offset: 0},
		beforeSend: function(){ // "loading icon"
            $('.feed').load(<?php echo  ?>./loading.php');
        },
        timeout: 3000,
        error: function(x, t, m){
            if(t === 'timeout' || t === 'error' || t === 'abort' || t === 'parsererror'){
                $('.feed').load('/errors/loading-error.php');
            }
        },
		success: function(response){
			
            $('.feed').empty().append(response);

            // Source http://stackoverflow.com/questions/6813227/how-do-i-check-if-an-html-element-is-empty-using-jquery
            if($.trim($('.feed').html()) == ""){
                $('.feed').load('nofeed.php');
                $('.load-more').remove();
            } else {
                feedModal.initialize(); // load initializer from feed-modal-init.js
            }

		}

	});

	$('.load-more').on('click', '#load-more', function (e) {

        e.preventDefault();
        
        loads++;
        offset = (loads * limit)  - limit;

        // Send AJAX Request
        $.ajax({
            type: "POST",
            url: "infinite.php", // Process request here
            data: {limit: limit, offset: offset}, // POST the ID
            beforeSend: function(){ // "loading icon"
	            $('#load-more span').html('<i class="fa fa-cog fa-spin fa-2x loading"></i>');
	        },
            timeout: 3000,
            error: function(x, t, m){
                if(t === 'timeout' || t === 'error' || t === 'abort' || t === 'parsererror'){
                    $('.load-more').load('/errors/loading-error.php');
                }
            },
            success:function(response){
                // On success, change span text of button
                if(loads > maxLoads){
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