(function($) {

	// Site areas (inside search form)
	$(document).ready(function() {

		var $siteAreas = $('#et_top_search .site-areas');

		if($siteAreas.length) {

			$siteAreas.find('.area-content > *').hide();

			$siteAreas.find('.area-list li').click(function() {

				$siteAreas.find('.area-content > *').hide();
				$siteAreas.find('.area-list li').removeClass('active');

				$(this).addClass('active');

				var area = $(this).data('area');

				$siteAreas.find('.area-content .' + area).show();

			});

		}

	});

	// Sum cmm counts
	window.fbAsyncInit = function() {
		FB.Event.subscribe('xfbml.render', function() {

			setTimeout(function() {

				$smcmm = $('.cmm-sum');

				if($smcmm.length) {

					$smcmm.each(function() {

						var $fb = $(this).find('.fb_comments_count');

						var fb = parseInt($fb.text());

						var $regular = $(this).find('.cmm-cnt');

						var total = fb + parseInt($regular.text());

						$regular.text(total);
						$fb.remove();

						if(total < 2) {
							$(this).hide();
						}

					});

				}

			}, 200);

		});
	};

	$(document).ready(function() {

	});

	// Making of
	$(document).ready(function() {
		var $makingOf = $('.making-of');

		if($makingOf.length) {

			$makingOf.find('.making-of-content');

			$makingOf.find('h3').click(function() {
				if($makingOf.is('.active'))
					$makingOf.removeClass('active');
				else
					$makingOf.addClass('active');
			})

		}
	})

	// Fitvid

	$(document).ready(function() {
		$('body').fitVids();
	});

	// Place related posts

	$(document).ready(function() {

		var $yarpp = $('.yarpp-related');

		var after = '.entry-content p:nth-child(4)';

		$(".entry-content p:contains('[relacionados]')").each(function() {
			$yarpp.insertAfter($(this));
			$(this).remove();
			after = false;
		})

		if(after)
			$yarpp.insertAfter($('.entry-content p:nth-child(4)').eq(0));

	});

})(jQuery);