$(document).ready(function() {

	var width = $(window).width();

	if(width < 474){
		$('#jibe').attr('src', '/images/up.png');
	} else {
		$('#jibe').attr('src', '/images/logo.png');
	}

	$(window).resize(function() {

		var width = $(window).width();

		if(width < 474){
			$('#jibe').attr('src', '/images/up.png');
		} else {
			$('#jibe').attr('src', '/images/logo.png');
		}

	});
});