$(document).ready(function() {

	var width = $(window).width();

	if(width < 474){
		$('#jibe').attr('src', '/jibe/images/up.png');
	} else {
		$('#jibe').attr('src', '/jibe/images/logo.png');
	}

	$(window).resize(function() {

		var width = $(window).width();

		if(width < 474){
			$('#jibe').attr('src', '/jibe/images/up.png');
		} else {
			$('#jibe').attr('src', '/jibe/images/logo.png');
		}

	});
});