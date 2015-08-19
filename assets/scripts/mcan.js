jQuery(document).ready(function($) {
	
	// HOMEPAGE FORM
	// add CSS to parent of form for fullwidth bg
	$('#contact-form').parent().parent().parent().parent().parent().addClass('contact-form');
	
	// HOMEPAGE CONTENT BLOCK "Get Organized"
	// add CSS to parent of form for fullwidth bg
	$('#homepage-organizing').parent().parent().parent().parent().parent().addClass('homepage-content-dark');
	
	// HOMEPAGE CONTENT BLOCK "This Is How We Work"
	// add CSS to parent of form for fullwidth bg
	$('#homepage-howwework').parent().parent().parent().parent().parent().addClass('homepage-content-howwework');
	
	// Run Fancybox on Staff Page template
	if ( $('body').attr('class').indexOf('staff') > 0 ||  $('body').attr('class').indexOf('pastcampaigns') > 0 || $('body').attr('class').indexOf('resources') > 0 ){
		console.log("run fancybox");
		$('.fancybox').fancybox({
			'type' : 'inline',
			'mouseWheel' : false,
			'autoSize' : true,
			'fitToView' : true,
			'scrolling' : 'auto',
			'nextClick' : false,
			'maxWidth' : 800
		});
	}
});