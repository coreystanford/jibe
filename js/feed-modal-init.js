var feedModal = (function () {

    return {

    	// Open modal window

	    initialize: function () {

	    	// for each project in the feed:
		    $('.project').each(function () {

		    	// find the specific project ID
		    	var id = $(this).find('.open-modal').attr('rel');

		    	// remove click event from any projects already in the feed (creates havoc if not removed)
		    	$(this).off('click', '.open-modal');
		    	// add click event for all projects in the feed
	    		$(this).on('click', '.open-modal', function (e) {
	    			// don't go to the href
		        	e.preventDefault();
		        	// instead, open the modal window
		        	modal.open(id);
		        });

		    });

		}

	}

}());