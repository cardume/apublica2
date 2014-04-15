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

				setTimeout(function() {
					setTimeout(function() {
						$(window).resize();
					}, 500);
				}, 300);

			}

		});

	})();

	/*
	 * Publica summary
	 */

	(function() {

		var $summary,
			$itemsContent = {};

		$(document).ready(function() {

			$summary = $('.publica-summary');

			if($summary.length) {

				$summary.find('.summary-content-item').each(function() {

					$itemsContent[$(this).data('summary')] = $(this).clone();

					$(this).remove();

				});

			}

			$summary.on('click', '.summary-nav a', function() {

				$summary.find('.summary-nav a').removeClass('active');

				$(this).addClass('active');

				$summary.find('.summary-content').empty().append($itemsContent[$(this).data('summary')]);

				$summary.fitVids();

				return false;

			});

			$summary.find('.summary-nav a:first-child').click();

		});

	})();

})(jQuery);