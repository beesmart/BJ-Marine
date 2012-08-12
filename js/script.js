/* Author:

*/

$(function() {
	$('img[data-hover]').hover(function() {
		if(!$(this).attr('data-hover')) {
			$(this).attr('data-hover', getHoverImageURI(this.src));
		}

		$(this)
			.attr('tmp', $(this).attr('src'))
			.attr('src', $(this).attr('data-hover'))
			.attr('data-hover', $(this).attr('tmp'))
			.removeAttr('tmp');
	}).each(function() {
		$('<img />').attr('src', $(this).attr('data-hover'));
	});

	function getHoverImageURI(uri) {
		ext = uri.substr(uri.lastIndexOf('.') + 1);
		newExt = '-hover.' + ext;
		this.src = uri.replace('.' + ext, newExt);
		return uri.replace('.' + ext, newExt);
	}

	/* Adds Sliderjs.org widget to .slider */
	$('.slider').bjqs({
		'height' : 300,
		'width' : 940,
		'animation' : 'slide',
		'nextText': '<i class="icon-chevron-right icon-black"></i>',
		'prevText': '<i class="icon-chevron-left icon-black"></i>'
	});
});

