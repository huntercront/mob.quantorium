$(document).ready(function(){
function getScrollBarWidth () {
    var $outer = $('<div>').css({visibility: 'hidden', width: 100, overflow: 'scroll'}).appendTo('body'),
        widthWithScroll = $('<div>').css({width: '100%'}).appendTo($outer).outerWidth();
    $outer.remove();
    return 100 - widthWithScroll;
};
var scrollWidth = getScrollBarWidth ();

if(window.matchMedia("(min-width: 700px)").matches){
var curentScreenTop = $(".logos-anim-block").offset().top - $(window).scrollTop();
$('.logos-line-1').css({'transform' : 'translate(' + 0 +', ' + curentScreenTop/20 + '%)'})
$('.logos-line-2').css({'transform' : 'translate(' + 0 +', ' + curentScreenTop/40 + '%)'})
$('.logos-line-3').css({'transform' : 'translate(' + 0 +', ' + curentScreenTop/30 + '%)'})
$(document).scroll(function() {
	var offsetFromScreenTop = $(".logos-anim-block").offset().top - $(window).scrollTop();
	if($(window).scrollTop() < $(".logos-anim-block").offset().top ){
		$('.logos-line-1').css({'transform' : 'translate(' + 0 +', ' + offsetFromScreenTop/10 + '%)'})
		$('.logos-line-2').css({'transform' : 'translate(' + 0 +', ' + offsetFromScreenTop/20 + '%)'})
		$('.logos-line-3').css({'transform' : 'translate(' + 0 +', ' + offsetFromScreenTop/15 + '%)'})
	}
});
}

$('.mobile-icon').on('click', function(e){
	$('.hamRotate').toggleClass('active');
	$('.navigation').toggleClass('navigation--active');
	$('.overlay').toggleClass('overlay--active');
	if($('.header').css('padding-right')=='0px'){
		$('.header').css('padding-right',scrollWidth+'px')
		$('body').css('padding-right',scrollWidth+'px')
		$('body').toggleClass('no-scroll')
	}else {
		$('.header').css('padding-right',0+'px')
		$('body').css('padding-right',0+'px')
		$('body').toggleClass('no-scroll')
	  }

})

$('.overlay').on('click', function(e){
	if(window.matchMedia("(max-width: 924px)").matches){
		if($('.navigation').hasClass('navigation--active')){
			$('.hamRotate').toggleClass('active');
			$('.navigation').toggleClass('navigation--active')
			$('.overlay').toggleClass('overlay--active')
			if($('.header').css('padding-right')=='0px'){
				$('.header').css('padding-right',scrollWidth+'px')
				$('body').css('padding-right',scrollWidth+'px')
				$('body').toggleClass('no-scroll')
			}else {
				$('.header').css('padding-right',0+'px')
				$('body').css('padding-right',0+'px')
				$('body').toggleClass('no-scroll')
			  }
		}
	}
})
$('.has-child a').on('click', function(e){
	if(window.matchMedia("(max-width: 924px)").matches){
		$(this).toggleClass('active--link');
		var panel = $(this).parent().find('.child-list');
		if (panel.css('max-height')=='0px') {
      panel.css('max-height',panel.prop('scrollHeight') + "px")
    } else {
      panel.css('max-height','0px');
    }
	}
})

})