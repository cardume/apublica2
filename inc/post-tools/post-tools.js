(function($) {

	$(document).ready(function() {

		var $tools = $('#publica-post-tools');

		$tools.list = $tools.find('.tool-list');

		var showList = function() {
			$tools.addClass('active');
		};

		var hideList = function() {
			$tools.removeClass('active');
		}

		$tools.on('click', '.toggle-tools', function(e) {

			e.preventDefault();

			if($tools.hasClass('active'))
				hideList();
			else
				showList();
		});

		// Scroll behaviour
		$tools.addClass('steady');
		$tools.find('.secondary').hide();

		$(window).scroll(function() {

			var top = getTopOffset();

			if(top <= 100) {
				lock();
				if(isAtBottom()) {
					release();
				}
			} else {
				release();
			}

		});

		function lock() {
			$tools.removeClass('steady').addClass('fixed').css({
				'top': 100,
				'bottom': 'auto'
			});
			$tools.find('.secondary').show();
		}

		function release() {
			$tools.removeClass('fixed').addClass('steady').css({
				'top': 'auto',
				'bottom': 20
			});
			$tools.find('.secondary').hide();
		}

		function getTopOffset() {

			var documentOffset = $tools.offset().top;

			var windowOffset = documentOffset - $(window).scrollTop();

			return windowOffset;

		}

		function isAtBottom() {

			var height = $tools.height();
			var top = $tools.offset().top;
			var windowHeight = $(window).height();

			return ((height + top) <= windowHeight);

		}

		// Font sizing
		(function() {

			var $fontsize = $tools.find('.font-size-adjust');

			var $target = $('.entry-content p');

			var defaultFontSize = parseInt($target.css('font-size').replace('px', ''));

			var min = 8;
			var max = 30;

			$fontsize.on('click', '.regular', function() {
				$target.css('font-size', defaultFontSize);
			});

			$fontsize.on('click', '.increase', function() {
				var current = parseInt($target.css('font-size').replace('px', ''));
				if(current < max) {
					$target.css('font-size', current+1);
				}
			});

			$fontsize.on('click', '.decrease', function() {
				var current = parseInt($target.css('font-size').replace('px', ''));
				if(current > min) {
					$target.css('font-size', current-1);
				}
			});

		})();


		// Total shares

		var $shareCount = $('.total-shares .share-count');

		if($shareCount.length) {
			var count = parseInt($shareCount.text());
			$shareCount.text(kFormatter(count));
		}
		
		function kFormatter(num) {
			return num > 999 ? (num/1000).toFixed(1) + 'K' : num
		}

	});

})(jQuery);