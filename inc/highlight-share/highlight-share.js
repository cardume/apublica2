(function($) {

	$(document).ready(function() {

		$('.entry-content').highlighter({
			'selector': '.highlight-share'
		});

		$('.highlight-share a').click(function() {

			var winTop = (screen.height / 2) - (350 / 2);
			var winLeft = (screen.width / 2) - (640 / 2);

			var serv = $(this).attr('class');

			var text = '"' + window.getSelection() + '" - ' + document.URL;

			var url = '';
			if(serv == 'twitter') {
				url = 'https://twitter.com/intent/tweet?text=' + text;
			} else if(serv == 'facebook') {
				url = 'http://www.facebook.com/sharer/sharer.php?u=' + document.URL + '&t=' + text;
			}

			window.open(url, 'sharer', 'top=' + winTop + ', left=' + winLeft + ', height=320, width=640, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no');

			return false;

		});

	});

	function share(url, title, descr, image, winWidth, winHeight) {
		window.open('http://www.facebook.com/sharer.php?s=100&p[title]=' + title + '&p[summary]=' + descr + '&p[url]=' + url + '&p[images][0]=' + image, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
	}

})(jQuery);