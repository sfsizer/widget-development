jQuery(window).on('elementor/frontend/init', function () {

	elementorFrontend.hooks.addAction(
		'frontend/element_ready/slider.default',
		function ($scope, $) {

			let $carousel = $scope.find('.slick-carousel');
			var arrowLeft  = $carousel.data('arrow-left');
			var arrowRight = $carousel.data('arrow-right');

			if ($carousel.length && !$carousel.hasClass('slick-initialized')) {
				$carousel.slick({
					dots: false,
					arrows: window.mySliderSettings.arrows,
					infinite: true,
					speed: 300,
					slidesToShow: 3,
					slidesToScroll: 3,
					prevArrow: `<button type="button" class="slick-prev custom-arrow"><i class="${arrowLeft}"></i></button>`,
					nextArrow: `<button type="button" class="slick-next custom-arrow"><i class="${arrowRight}"></i></button>`,
					responsive: [
						{ breakpoint: 1024, settings: { slidesToShow: 3, slidesToScroll: 3, dots: true } },
						{ breakpoint: 600, settings: { slidesToShow: 2, slidesToScroll: 2 } },
						{ breakpoint: 480, settings: { slidesToShow: 1, slidesToScroll: 1 } }
					]
				});
			}

		}
	);
});
