// init only, functions instantiated in previous .js files  
// lettered prefix for auto-concat on alphabetical order (look for it in gulpfile.js) :)


// load binds
window.onload = function() {
	$('body').addClass('loaded');
	
	$('.close-teacher').on('click', hideTeachers);
	$('.teacher-info .square-hover-instance').on('click', showTeacher); 
	
	hideTeachers();
	openModal('.open-modal, .open-modal-fixed, .get-in-contact, .schedule-now', '.modal-form');
	closeModal('.close-modal', '.modal-form');
	initMap();
	$('.fancybox-instance').fancybox();
	anchors();

	if (helpers.isMobile) {
		helpers.carousel('.becomes-carousel-on-mobile', helpers.carouselOptions.mobileBasic);	
		$('.hamburger').on('click', mobileMenu);
		$('.has-submenu').on('click', openSubMenu);
		$('.close-submenu').on('click', closeSubMenu);
	}

	else {
		scrollChanges();
		window.onscroll = scrollChanges;
	}
}

// domcontent binds 

document.addEventListener('DOMContentLoaded', function() {

	if (helpers.iOS) {
		$('html').addClass('ios');
	}

	if ( helpers.IE() ) {
		$('html').addClass('ie');
	}
	
});