$(function() {

	//Equal Heights
	$(".post-content").equalHeights();

	// LOGIN SUBMENU
	$(".logged").click(function(){
		$(".log_submnu ul").slideToggle();
		return false;

	});

	//Background-Slider
	$(".main-head").vegas({
   	timer: false,
   	cover: true,
   	preload: true,
    slides: [
        { src: "/img/slider/bg_top.jpg" },
        { src: "/img/slider/bg_top1.jpg" },
        { src: "/img/slider/bg_top2.jpg" },
        { src: "/img/slider/bg_top3.jpg" }
    ]
});




	//SVG Fallback
	if(!Modernizr.svg) {
		$("img[src*='svg']").attr("src", function() {
			return $(this).attr("src").replace(".svg", ".png");
		});
	};

	//E-mail Ajax Send
	//Documentation & Example: https://github.com/agragregra/uniMail
	$("form").submit(function() { //Change
		var th = $(this);
		$.ajax({
			type: "POST",
			url: "mail.php", //Change
			data: th.serialize()
		}).done(function() {
			alert("Thank you!");
			setTimeout(function() {
				// Done Functions
				th.trigger("reset");
			}, 1000);
		});
		return false;
	});

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
