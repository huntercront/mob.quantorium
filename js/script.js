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

// for (i = 0; i < acc.length; i++) {
//   acc[i].addEventListener("click", function() {
//     this.classList.toggle("active");
//     var panel = this.nextElementSibling;
//     if (panel.style.maxHeight) {
//       panel.style.maxHeight = null;
//     } else {
//       panel.style.maxHeight = panel.scrollHeight + "px";
//     }
//   });
// }
// // new SimpleBar($('.road-container')[0])