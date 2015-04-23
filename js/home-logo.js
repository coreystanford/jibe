$(document).ready(function() {

	var width = $(window).width();

	if(width < 474){
		$('#jibe').attr('src', './images_upload/up.png');
	} else {
		$('#jibe').attr('src', './images_upload/logo.png');
	}

	$(window).resize(function() {

		var width = $(window).width();

		if(width < 474){
			$('#jibe').attr('src', './images_upload/up.png');
		} else {
			$('#jibe').attr('src', './images_upload/logo.png');
		}

	});
});