$(document).ready(function() {
	var $height = $(window).height();

	var $image = $('#invisible').attr('src');

	var $bkgd = "url('" + $image + "')";
	console.log($bkgd);
	$('.featured').css('height', $height);
	$('.featured').css('background-image', $bkgd);

	$(window).resize(function() {
		var $height = $(window).height();
		$('.featured').css('height', $height);
	});

});