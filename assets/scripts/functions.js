/* ---------------------------------------------------------------------------
 * Hover on Section Function
 * --------------------------------------------------------------------------- */
jQuery(document).ready(function(){
	jQuery(".blog-box").hover(function(){
		jQuery(this).find("section").stop().animate({bottom:0}, 500);},
		function() {
			jQuery(this).find('section').stop().animate({bottom:-95}, 500);
	});
	
	// Removing Audio text
	jQuery('.mejs-offscreen').remove();
	
});
/* ---------------------------------------------------------------------------
	* nice scroll for theme
 	* --------------------------------------------------------------------------- */
	function cs_nicescroll(){
		'use strict';	
		var nice = jQuery("html").niceScroll({mousescrollstep: "20",scrollspeed: "150",}); 
	}
/*---------------------------------------------------------------------------
	 * Skills Function
* --------------------------------------------------------------------------- */
/*jQuery(document).ready(function(){
		jQuery('.skillbar').each(function() {
			jQuery(this).waypoint(function(direction) {
				jQuery(this).find('.skillbar-bar').animate({
					width: jQuery(this).attr('data-percent')
				}, 2000);
			}, {
				offset: "100%",
			triggerOnce: true
			});
	});
	
});*/

/* ---------------------------------------------------------------------------
	*  Mail Chimp Funtion For Ajax Submit Function
	* --------------------------------------------------------------------------- */
	function cs_mailchimp_submit(theme_url,counter,admin_url){
		'use strict';
		$ = jQuery;
		$('#btn_newsletter_'+counter).hide();
		$('#process_'+counter).html('<div id="process_newsletter_'+counter+'"><i class="fa fa-refresh fa-spin"></i></div>');
		$.ajax({
			type:'POST', 
			url: admin_url,
			data:$('#mcform_'+counter).serialize()+'&action=cs_mailchimp', 
			success: function(response) {
				$('#mcform_'+counter).get(0).reset();
				$('#newsletter_mess_'+counter).fadeIn(600);
				$('#newsletter_mess_'+counter).html(response);
				$('#btn_newsletter_'+counter).fadeIn(600);
				$('#process_'+counter).html('');
			}
		});
	}
	
/* ---------------------------------------------------------------------------
	 * Toggle Function
* --------------------------------------------------------------------------- */

jQuery(document).ready(function(){
	jQuery(".hidediv").hide();
	  jQuery(".showdiv").click(function(){
		  jQuery(this).parents("article").stop().find(".hidediv").toggle(300);
		  								  
	  });
});
	 
/*----------------------------------------------------------------------------
	 *  Event Toggle Function
	 * ----------------------------------------------------------------------------*/
	jQuery('#toggle1').click(function() {
		$('.csmap').slideToggle();
		return false;
	});
	jQuery('#toggle1').click(function() {
		$('#toggle1').toggleClass('active');
		return false;
	});

/* ---------------------------------------------------------------------------
	 *  Navigation Sub Menu Function
	 * --------------------------------------------------------------------------- */
jQuery(document).ready(function($) {
	jQuery(".dropdown-menu").parent("li").addClass("parentIcon");
	jQuery(".mega-grid").parent("li").addClass("parentIcon");
});
/*----------------------------------------------------------------------------
	 *  Courses Toggle Function
	 * ----------------------------------------------------------------------------*/
	jQuery('#toggle02').click(function() {
		$('.toggle-div').slideToggle();
		return false;
	});
	jQuery('#toggle02').click(function() {
		$('#toggle02').toggleClass('active');
		return false;
	});



/* ---------------------------------------------------------------------------
	 * Show Map Function
	 * --------------------------------------------------------------------------- */
	
function cs_show_map(id, add,lat, long, zoom, home_url, get_template_directory_uri) {
						
	var a = jQuery("div.post-"+id).find("[id^=map]").length;
	if (a > 1) {
			jQuery("#event-"+id).slideToggle();
		} else {
			jQuery("article.post-"+id) .find("a.map-marker i").hide();
			//jQuery("article.post-"+id) .find("a.map-marker").append('<img src="'+get_template_directory_uri+'/images/ajax-loader.gif" />');
			jQuery("article.post-"+id) .find("a.map-marker").append('<i class="fa fa-spinner fa-spin"></i>');
	var dataString = 'post_id=' + id + '&add=' + add + '&lat=' + lat + '&long=' + long + '&zoom='+ zoom;
			jQuery.ajax({
				type:"POST",
				url: get_template_directory_uri+"/cs-templates/event-styles/event_map_ajax.php",
				data:dataString, 
				success:function(response){
					
					jQuery("article.post-"+id) .find("a.map-marker i").show();
					jQuery("article.post-"+id) .find("a.map-marker .fa-spin").hide();
					jQuery("div.post-"+id).toggleClass("event-map");
					jQuery("div.post-"+id).show();
					jQuery("#map_canvas"+id).html(response);
				
				}
	});
		}
}

/* ---------------------------------------------------------------------------
* Parallex Function
* --------------------------------------------------------------------------- */
function cs_parallax_func(){
	"use strict";
	// Cache the Window object     
	jQuery('section.parallex-bg[data-type="background"]').each(function(){
		var $bgobj = jQuery(this); // assigning the object
		jQuery(window).scroll(function() {
			// Scroll the background at var speed
			// the yPos is a negative value because we're scrolling it UP!								
			var yPos = -(jQuery(window).scrollTop() / $bgobj.data('speed')); 
			// Put together our final background position
			var coords = '50% '+ yPos + 'px';
			// Move the background
			$bgobj.css({ backgroundPosition: coords });
		}); // window scroll Ends
	});
}

/* ---------------------------------------------------------------------------
	* skills Function
 	* --------------------------------------------------------------------------- */
	function cs_skill_bar(){
		
		"use strict";	 
		jQuery(document).ready(function($){
			jQuery('.skillbar').each(function($) {
				jQuery(this).waypoint(function(direction) {
					jQuery(this).find('.skillbar-bar').animate({
						width: jQuery(this).attr('data-percent')
					}, 2000);
				}, {
					offset: "100%",
					triggerOnce: true
				});
			});
		});
	}
	
/* ---------------------------------------------------------------------------
	 * Upload Browse Button Style
	 * --------------------------------------------------------------------------- */


	function cs_user_profile_picture_del(picture_class,user_id,admin_url){
		var dataString='picture_class=' + picture_class + 
				'&user_id=' + user_id +
				'&action=cs_admin_user_profile_picture_ajax';
		jQuery(".profile-loading").html('<i class="fa fa-spinner fa-spin fa-2x"></i>');
		jQuery.ajax({
			type:"POST",
			url: admin_url,
			data:dataString, 
			success:function(response){
				if(response != 'error'){
					jQuery("article figure").html(response);
					jQuery("#user_avatar_display_box").remove();
					jQuery(".profile-loading").html('');
				} else {
					jQuery(".profile-loading").html(' There is error while removing profile picture.');
				}
				
			}
		});
		return false;
	}


/* ---------------------------------------------------------------------------
	 * Upload Browse Button Style
	 * --------------------------------------------------------------------------- */
jQuery(document).ready(function($) {
	jQuery(".cs-filter-menu li a").live("click", function(event) {
		if (jQuery(this).hasClass('addclose')) {
			jQuery(this).removeClass('addclose');
		} else {
			jQuery(".cs-filter-menu li a").removeAttr('class');
			jQuery(this).addClass('addclose');
		}
		var a = jQuery(this).attr('href');
		jQuery('.filter-pager').not(a).slideUp();
		jQuery(a).slideToggle(300)
		return false;
	 });
});
/* ---------------------------------------------------------------------------
	 * Responsive Menu
	 * --------------------------------------------------------------------------- */
	jQuery(document).ready(function($) {
		jQuery(".navbar-toggle").live("click", function(event) {
			if (jQuery(this).hasClass('addclose')) {
				jQuery(this).removeClass('addclose');
			} else {
				//jQuery(".navbar-toggle").removeAttr('class');
				jQuery(this).addClass('addclose');
			}
		});
	});
	
	
/* ---------------------------------------------------------------------------
* Responsive Video Function
* --------------------------------------------------------------------------- */

  jQuery(document).ready(function($) {
    jQuery(".main-section").fitVids();
  });

(function(e){"use strict";e.fn.fitVids=function(t){var n={customSelector:null,ignore:null};if(!document.getElementById("fit-vids-style")){var r=document.head||document.getElementsByTagName("head")[0];var i=".fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}";var s=document.createElement("div");s.innerHTML='<p>x</p><style id="fit-vids-style">'+i+"</style>";r.appendChild(s.childNodes[1])}if(t){e.extend(n,t)}return this.each(function(){var t=['iframe[src*="player.vimeo.com"]','iframe[src*="youtube.com"]','iframe[src*="youtube-nocookie.com"]','iframe[src*="kickstarter.com"][src*="video.html"]',"object","embed"];if(n.customSelector){t.push(n.customSelector)}var r=".fitvidsignore";if(n.ignore){r=r+", "+n.ignore}var i=e(this).find(t.join(","));i=i.not("object object");i=i.not(r);i.each(function(){var t=e(this);if(t.parents(r).length>0){return}if(this.tagName.toLowerCase()==="embed"&&t.parent("object").length||t.parent(".fluid-width-video-wrapper").length){return}if(!t.css("height")&&!t.css("width")&&(isNaN(t.attr("height"))||isNaN(t.attr("width")))){t.attr("height",9);t.attr("width",16)}var n=this.tagName.toLowerCase()==="object"||t.attr("height")&&!isNaN(parseInt(t.attr("height"),10))?parseInt(t.attr("height"),10):t.height(),i=!isNaN(parseInt(t.attr("width"),10))?parseInt(t.attr("width"),10):t.width(),s=n/i;if(!t.attr("id")){var o="fitvid"+Math.floor(Math.random()*999999);t.attr("id",o)}t.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top",s*100+"%");t.removeAttr("height").removeAttr("width")})})}})(window.jQuery||window.Zepto)