$(document).ready(function(){
	$('.slider').each(function(){
		var $this = $(this);
		var $slides = $this.find('.slide');
		var buttonArray = [];
		var currentIndex = 0;

		function select(newIndex){
			buttonArray[currentIndex].removeClass('active');
			buttonArray[newIndex].addClass('active');
			$slides.eq(newIndex).css({display: 'block'});
			$slides.eq(currentIndex).css( {display: 'none'});
			currentIndex = newIndex;
		}

		$slides.each(function(index){
			var $button = $('<button type="button" class="slide-btn"></button>');
			if(index === currentIndex){
				$button.addClass('active');
			}
			$button.on('click', function(){
				select(index);
			}).appendTo('.slide-buttons');
			buttonArray.push($button);
		});
	});
});