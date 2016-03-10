$(function() {



	//E-mail Ajax Send
	//Documentation & Example: https://github.com/agragregra/uniMail
	$(".main-form").submit(function() { //Change
		var th = $(this);
		$.ajax({
			type: "POST",
			url: "/wp-content/themes/itwascool/mail.php", //Change
			data: th.serialize()
		}).done(function() {
			alert("Спасибо за заявку!");
			setTimeout(function() {
				// Done Functions
				th.trigger("reset");
			}, 1000);
		});
		return false;
	});

	// LOGIN SUBMENU
	$(".logged").click(function(){
		$(".log_submnu ul").slideToggle();
		return false;
	});
	//Equal Heights
	$(".post-content").equalHeights();

	//Background-Slider
	$(".main-head").vegas({

   	timer: false,
   	cover: true,
	src: '/wp-content/themes/itwascool/img/slider/bg_top.jpg',
    slides: [
        { src: "/wp-content/themes/itwascool/img/slider/bg_top.jpg" },
        { src: "/wp-content/themes/itwascool/img/slider/bg_top1.jpg" },
        { src: "/wp-content/themes/itwascool/img/slider/bg_top2.jpg" },
        { src: "/wp-content/themes/itwascool/img/slider/bg_top3.jpg" }
    ]
});



	//SVG Fallback
	if(!Modernizr.svg) {
		$("img[src*='svg']").attr("src", function() {
			return $(this).attr("src").replace(".svg", ".png");
		});
	};

	//Chrome Smooth Scroll
	try {
		$.browserSelector();
		if($("html").hasClass("chrome")) {
			$.smoothScroll();
		}
	} catch(err) {

	};

	$("img, a").on("dragstart", function(event) { event.preventDefault(); });

});
