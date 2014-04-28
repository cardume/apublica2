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