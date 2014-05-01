(function($) {

	/*
	 * Publica slider
	 */

	(function() {

		var $slider;

		$(document).ready(function() {

			$slider = $('.publica-slider');

			if($slider.length) {

				var run;

				var href;

				var openNext = function() {

					var next = $slider.find('.slide-item.active').next();

					if(!next.length)
						next = $slider.find('.slide-item:first-child');

					next.click();

				};

				$slider.on('click', '.slide-item', function() {

					href = $(this).find('a.main-link').attr('href');

					if($(this).is('.active')) {
						window.location = href;
					} else {

						$slider.find('.active-content').empty();

						$slider.find('.slide-item').removeClass('active');

						$(this).addClass('active').find('.slide-content').clone().appendTo('.active-content');

						if(typeof run !== 'undefined')
							clearInterval(run);

						run = setInterval(openNext, 6000);
					}

				});

				$slider.find('.slide-item a').on('click', function() {
					return false;
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

				$summary.find('.summary-content-item').hide();

			}

			$summary.on('click', '.summary-nav a', function() {

				$summary.find('.summary-nav a').removeClass('active');

				$summary.find('.summary-content-item').hide();

				$(this).addClass('active');

				$summary.find('[data-summary="' + $(this).data('summary') + '"]').show();

				$summary.fitVids();

				return false;

			});

			$summary.find('.summary-nav a:first-child').click();

		});

	})();

})(jQuery);