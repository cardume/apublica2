(function($) {

	/*
	 * Publica slider
	 */

	(function() {

		var $slider;

		$(document).ready(function() {
			
			$slider = $('.publica-slider');

			if($slider.length) {

				$slider.on('click', '.slide-item', function() {

					$slider.find('.active-content').empty();

					$slider.find('.slide-item').removeClass('active');

					$(this).addClass('active').find('.slide-content').clone().appendTo('.active-content');

				});

				$slider.find('.slide-item:first-child').click();

				$(window).resize(function() {

					$slider.find('.active-content').height($slider.find('.slides').height());

				}).resize();

			}

		});

	})();

})(jQuery);