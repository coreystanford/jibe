var feedModal = (function () {

    return {

    	// Open modal window

	    initialize: function (id) {

		    $('.project').each(function () {

		    	var id = $(this).find('.open-modal').attr('rel');

		        $(this).on('click', '.open-modal', function (e) {

		        	e.preventDefault();
		        	
		        	modal.open(id);

		        });

		    });

		}

	}

}());