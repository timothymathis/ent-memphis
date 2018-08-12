;(function($) {

	
	$(document).ready(function() {

		var $win = $(window);
		var $doc = $(document);

		// Load Foundation
		$(document).foundation();

		// Intro Small 
		$('.intro-small .intro-image').stellar({
			horizontalScrolling: false,
			verticalOffset: 40
		});

		// Add end class to doctors
		$( ".box-item > .row > .columns" ).last().addClass( "end" );

		//FullSize Image
		var attrSrc;
		function fullsizeImageHelper () {
			$('.fullsize-image').each(function () {
				attrSrc = $(this).attr('src');
				$(this)
					.closest('.fullsize-image-container')
					.css('background-image', 'url(' + attrSrc + ')');
			});
		}

		fullsizeImageHelper();

		//Intro Slider
		var introSliderAuto = $( '.intro-slider' ).data( 'auto' );
		introSliderAuto = introSliderAuto == 'on' ? true : false;

		var introSlider = $('.intro-slider .slides').bxSlider({
			auto: true,
			pager: false,
			autoControls: false,
			autoHover: true,
			auto: introSliderAuto
		});

		if( $('.intro-slider .slides').length > 0 && introSlider.getSlideCount() < 2 ) {
			introSlider.stopAuto();
		}

		// Testimonials slider
		var sliderTestimonials;
		$win.on('load', function () {
			if( $('.slider-testimonials .slides .slide').length > 1 ) {
				sliderTestimonials = $('.slider-testimonials .slides').bxSlider({
					auto: true,
					pager: false,
					adaptiveHeight: true,
					maxSlides: 1,
					minSlides: 1,
					moveSlides: 1,
					slideWidth: 1030
				});
			}
		});

		// Tabs
		var currentItem;
		$('.tabs-clickable .list-services a').on('click', function (event) {
			event.preventDefault();

			currentItem = $(this).attr('href');

			$(this)
				.parent()
				.addClass('current')
				.siblings()
				.removeClass('current');

			$(currentItem)
				.addClass('current')
				.siblings()
				.removeClass('current');
			
		});

		//Slider Services
		var sliderList = $('.list-services-slider').bxSlider({
			pager: false,
			minSlides: 1,
			maxSlides: 6,
			moveSlides: 1,
			slideWidth: 200,
			infiniteLoop: false,
			hideControlOnEnd: true
		});

		$('.bx-controls-direction a').on('click', function (event) {
			if($(this).parents().hasClass('list-services-slider')) {
				event.preventDefault();
				sliderList.stopAuto();
				sliderList.startAuto();	
			}
		});

		// FitVids
		$('.service-video').fitVids();

		var $video;
		$('video').click(function(event) {
			event.preventDefault();
			$video = $(this);

			$video.addClass('active');

			if($video.get(0).paused) {
				$video.get(0).play()
				$video.next().fadeOut()
			} else {
				$video.get(0).pause();
				$video.next().show()
			}
		});

		// Tablet Nav
		$('.nav li').each(function () {
			if($(this).find('.nav-dropdown').length) {
				$(this).addClass('has-dropdown');
			}
		});

		// Event Slider
		var $slider;
		$('.event-slider ').each(function () {
			$slider = $(this).find('.slides');

			$slider.bxSlider({
				auto: true,
				pager: false
			});
		});

		// Tablet and mobile menu dropdowns
		var $listItem;
		var $navClicked = false;
		$('.nav li.has-dropdown > a').on('click', function (event) {
			$listItem = $(this).parent();
			if($win.width() < 1025) {
				if( $navClicked == true ) {
					$navClicked = false;
				} else {
					event.preventDefault();
					$navClicked = true;
				}
			}

			$listItem
				.toggleClass('active')	   			
				.siblings()
				.removeClass('active');

			if($win.width() < 768) {
				$listItem
					.children('.nav-dropdown')
					.slideToggle();
			}
		});

		// Map
		if (jQuery('#map').length) {
			var geocoder;
			var map;
			var latlng;
			var address = jQuery('#map').data('address');

			google.maps.event.addDomListener(window, 'load', function () {
				geocoder = new google.maps.Geocoder();
				latlng = new google.maps.LatLng(50, -50);
				var mapOptions = {
					zoom: 14,
					center: latlng,
					scrollwheel: false,
					disableDefaultUI: true
				};

				geocoder.geocode( { 'address': address}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						map.setCenter(results[0].geometry.location);
						var marker = new google.maps.Marker({
							map: map,
							position: results[0].geometry.location
						});
						latlng = new google.maps.LatLng(results[0].geometry.location.k, results[0].geometry.location.D);
					}
				});

				map = new google.maps.Map(document.getElementById('map'), mapOptions);

			});
		}

		// Mobile Nav
		$('.btn-menu').on('click', function (event) {
			event.preventDefault();

			$(this)
				.toggleClass('active');

			$('.nav').slideToggle();
			$('.nav-dropdown').slideUp();			
		});

		var isMobileWidth = false;
		function resizeHelper () {
			if($win.width() < 768) {
				if(isMobileWidth) {
					return;
				}

				isMobileWidth = true;

			} else {
				if(!isMobileWidth) {
					return;
				}

				isMobileWidth = false;
				$('.nav').show();
				$('.nav-dropdown').removeAttr('style');
			}
		}

		$win.on('resize', function () {
			resizeHelper();
			$('.intro-slider .bx-start').trigger('click');
		});

		$(function(){
			$.stellar({
				horizontalScrolling: false,
				verticalOffset: 300
			});
		});

		// Mark last row of elements
		$( '.widget-services.page .list-services li' ).slice( -$( '.widget-services.page .list-services li' ).length % 5 ).addClass( 'last-row' );
	});
})(jQuery);
