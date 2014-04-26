(function($) {

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