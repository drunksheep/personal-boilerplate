function scrollChanges() {
	var $headerNode = $('.fixed'), 
	$headerChild = $headerNode.children('.center-content'),
	y = window.pageYOffset; 

	if (y > 60) {
		$headerNode.addClass('scrolled');
		$headerChild.removeClass('inner');
	}

	else {
		$headerNode.removeClass('scrolled');
		$headerChild.addClass('inner');
	}
}


function initMap() {

	if (document.getElementById('googleMap') !== null) {

		// this (coordinatesObject) was passed by Wordpress with wp_localize_script on functions.php 
		var coordinates = JSON.parse(coordinatesObject),
		place = new google.maps.LatLng( parseFloat(coordinates.lat), parseFloat(coordinates.long) );

		var map = new google.maps.Map(document.getElementById('googleMap'), {
			center: place, 
			zoom: 15, 
			styles: mapStyles,
		});

		var marker = new google.maps.Marker({
			position: place,
			map: map,
		});
	}

	if (document.getElementById('footerMap') !== null ) {
		var footerPlace = new google.maps.LatLng(-23.463728, -46.877583);

		var footerMap = new google.maps.Map(document.getElementById('footerMap'), {
			center: footerPlace, 
			zoom: 17, 
			styles: mapStyles,
		});

		var footerMarker = new google.maps.Marker({
			position: footerPlace, 
			map: footerMap, 
		})
	}
}

function showTeacher() {
	var instance = $(this).data('teacher'),
	toOpen = $('.teacher-instance[data-teacher="'+instance+'"]'); 
	$('.overlay').addClass('teacher-open').fadeIn(400, function() {
		toOpen.addClass('is-open').fadeIn();
	});
};

function hideTeachers() {
	$('.teacher-instance').fadeOut(400, function() {
		$('.teacher-instance').removeClass('is-open');
		$('.overlay').fadeOut().removeClass('teacher-open');
	});
}

function mobileMenu() {
	$(this).toggleClass('is-active');
	$('.header-links').toggleClass('is-open');
}

function openSubMenu(e) {
	var target =  $(event.target); 
	target.children('.submenu').addClass('submenu-open');
	setTimeout(function() {
		target.addClass('submenu-open');
		$('.close-submenu').addClass('submenu-open');
	}, 400);

	if ($(event.target).is('a')) {
		$(event.target).parents('li').addClass('submenu-open'); 
	}
}

function closeSubMenu() {
	$(this).removeClass('submenu-open'); 
	setTimeout(function() {
		$('.has-submenu, .submenu').removeClass('submenu-open');	
	}, 200);
}