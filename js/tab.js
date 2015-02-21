$(function(){
	var $tab = $(this).find('li.active');
	var $panel = $($tab.find('a').attr('href'));

	$('.tab-panel').removeClass('on');

	$(this).on('click', '.tab-control', function(e){
		e.preventDefault();
		var id = this.hash;
		if(id && !$(this).is('.active')){
			$tab.removeClass('active');
			$panel.removeClass('active');
			$tab = $(this).parent().addClass('active');
			$panel = $(id).addClass('active');
		}
	});
});