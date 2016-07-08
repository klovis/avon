$(document).ready(
	function () {
		$('.new-tab').each(function(){
            $(this).attr('target', '_blank');
		});
});