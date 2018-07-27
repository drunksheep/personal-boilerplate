//- generic helpers
//-------------------------------------------

var helpers = {
	lockBody : function()  {
		document.body.classList.add('no-scroll');
	},
	unlockBody : function() {
		document.body.classList.remove('no-scroll');
	},

	isMobile : window.innerWidth < 1023 ? true : false, 

	iOS : !!navigator.platform && /iPad|iPhone|iPod/.test(navigator.platform), 

	IE : function() {

		var sAgent = window.navigator.userAgent;
		var Idx = sAgent.indexOf("MSIE");

		if (Idx > 0 || !!navigator.userAgent.match(/Trident\/7\./) || document.documentMode || /Edge/.test(navigator.userAgent)) {	
			return true; 
		} 

		else {
			return false;
		}

	},

	carousel : function(selector, options) {
		$(selector).slick(options);
	}, 

	carouselOptions : {
		mobileBasic : {
			dots: false, 
			arrows: false, 
			slidesToShow: 1, 
			centerMode: true, 
			autoplay: true, 
			autoplaySpeed: 4000, 
			variableWidth: true, 
		}, 
	}, 
}

//- smooth jquery anchors (Jquery dependant)
//-------------------------------------------

function anchors() {
	$('.is-anchor').click(function(event) {   
		if (!helpers.iOS)  {
			event.preventDefault();
			var target; 

			// sort if it is <a> or <button> or whatever

			if ($(this).attr('href') === undefined) {
				target = $(this).data('anchor');
			}

			else {
				target = $(this).attr('href');
			}

			$('html,body').animate({
				scrollTop: $(target).offset().top
			}, 500, function() {
				// callback if needed
			});
		}
	});
}

//- generic modals (Jquery dependant)
//-------------------------------------------

function openModal(button, modal) {

	helpers.lockBody();

	button = $(button); 
	modal = $(modal);

	button.on('click', function(e) {
		e.preventDefault();

		// overlay is mostly a generic 
		
		$('.overlay').addClass('modal-open').fadeIn(400, function() {
			modal.fadeIn();
		});
	});

}

function closeModal(button, modal) {

	button = $(button); 
	modal = $(modal);

	button.on('click', function() { 

		$(modal).fadeOut(400, function() {
			$('.overlay').fadeOut().removeClass('modal-open');
		});

	});

	helpers.unlockBody();
}