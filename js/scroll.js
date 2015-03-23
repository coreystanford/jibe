var didScroll;
var lastScrollTop = 0;
var delta = 5;
var headerHeight = $('#header').outerHeight();

$(window).scroll(function(){
  didScroll = true;
});

setInterval(function() {
	
  if (didScroll === true) {
    hasScrolled();
    didScroll = false;
  }
}, 200);

function hasScrolled() {
  var sc = $(this).scrollTop();
  
  if(Math.abs(sc) <= delta){
	    return;
	  }

	  if (sc > lastScrollTop && sc > headerHeight){
    $('#header').removeClass('scrollup').addClass('scrolldown');

  } else {
    if(sc + $(window).height() < $(document).height()) { 
      $('#header').removeClass('scrolldown').addClass('scrollup');
    }
  }

  lastScrollTop = sc;
}