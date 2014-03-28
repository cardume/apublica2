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
	});

})(jQuery);