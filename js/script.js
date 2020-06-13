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
// new SimpleBar($('.road-container')[0])