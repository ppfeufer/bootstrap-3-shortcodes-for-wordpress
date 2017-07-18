(function($) {
	$('[data-toggle="bootstrap-popover"]').on('click', function(e) {
		e.preventDefault();
		return true;
	}).popover();

	$('.bootstrap-tooltip').tooltip();
})(jQuery);
