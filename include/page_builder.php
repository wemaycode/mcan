<?php
global $post,$cs_node, $cs_count_node, $cs_xmlObject,$cs_theme_option;
add_action( 'add_meta_boxes', 'cs_page_bulider_add' );
add_action( 'add_meta_boxes', 'cs_page_options_add' );
function cs_page_options_add() {
	add_meta_box( 'id_page_options', 'CS Page Options', 'cs_page_options', 'page', 'normal', 'high' );  
}
function cs_page_bulider_add() {
	add_meta_box( 'id_page_builder', 'CS Page Builder', 'cs_page_bulider', 'page', 'normal', 'high' );  
}  
function cs_page_bulider( $post ) {
	global $post,$cs_xmlObject, $cs_node, $cs_count_node, $post, $column_container, $coloum_width;
	wp_reset_query();
	$postID = $post->ID;
	$count_widget = 0;
	$page_title = '';
	$page_content = '';
	$page_sub_title = '';
	$builder_active = 0;
	$cs_page_bulider = get_post_meta("$post->ID", "cs_page_builder", true);
	/*$cs_tmp_fn = 'base'.'64_decode';
	$cs_page_bulider = unserialize(call_user_func($cs_tmp_fn, $cs_page_bulider));*/
	if ( $cs_page_bulider <> "" ){
		$cs_xmlObject = new stdClass();
		$cs_xmlObject = new SimpleXMLElement($cs_page_bulider);
		$builder_active = $cs_xmlObject->builder_active;
	}
?>
<input type="hidden" name="builder_active" value="<?php echo cs_allow_special_char($builder_active) ?>" />
  <div class="clear"></div>
  <div id="add_page_builder_item">
  	<div id="cs_shortcode_area"></div>
  
<?php
		if ( $cs_page_bulider <> "" ) {
			if ( isset($cs_xmlObject->page_title) ) $page_title = $cs_xmlObject->page_title;
			if ( isset($cs_xmlObject->page_content) ) $page_content = $cs_xmlObject->page_content;
			if ( isset($cs_xmlObject->page_sub_title) ) $page_sub_title = $cs_xmlObject->page_sub_title;
				foreach ( $cs_xmlObject->column_container as $column_container ){
					cs_column_pb(1);
				}
		}
?>
    <?php //if(!isset($cs_xmlObject->column_container) || count($cs_xmlObject->column_container)<1){?>
    <!-- <div id="no_widget" class="placehoder">Page Builder in Empty, Please Select Page Element. <img src="<?php echo get_template_directory_uri()?>/include/assets/images/bg-arrowup.png" alt="" /></div> -->
    <?php //}?>
  </div>
   <div class="clear"></div>
   <div class="add-widget"> <span class="addwidget"> <a href="javascript:ajaxSubmit('cs_column_pb','1','column_full')"><i class="fa fa-plus-circle"></i> Add Page Sections</a> </span> 
  <div id="loading" class="builderload"></div>
  <div class="clear"></div>
  <input type="hidden" name="page_builder_form" value="1" />
  <div class="clear"></div>
</div>
<div class="clear"></div>
<script>
	jQuery(function() {
		// jQuery( "#add_page_builder_item" ).sortable({
		// 	cancel : 'div div.poped-up'
		// });
		//jQuery( "#add_page_builder_item" ).disableSelection();
	});
</script> 
<script type="text/javascript">
		var count_widget = <?php echo cs_allow_special_char($count_widget) ; ?>;
		jQuery(function() {
		   jQuery( ".draginner" ) .sortable({
				connectWith: '.draginner',
				handle:'.column-in',
				start: function( event, ui ) {jQuery(ui.item).css({"width":"25%"});},
				cancel:'.draginner .poped-up,#confirmOverlay',
				revert:false,
				receive: function( event, ui ) {callme();},
				placeholder: "ui-state-highlight",
				forcePlaceholderSize:true
		   });
			jQuery( "#add_page_builder_item" ).sortable({
				handle:'.column-in',
				connectWith: ".columnmain",
				cancel:'.column_container,.draginner,#confirmOverlay',
				revert:false,
				placeholder: "ui-state-highlight",
				forcePlaceholderSize:true
			 });
		   // jQuery( "#add_page_builder_item" ).disableSelection();
		  });
		function ajaxSubmit(action,total_column, column_class){
			counter++;
			count_widget++;
			jQuery('.builderload').html("<img src='<?php echo get_template_directory_uri();?>/include/assets/images/ajax_loading.gif' />");
            var newCustomerForm = "action=" + action + '&counter=' + counter + '&total_column=' + total_column + '&column_class=' + column_class + '&postID=<?php echo esc_js($postID);?>';
            jQuery.ajax({
                type:"POST",
                url: "<?php echo admin_url('admin-ajax.php')?>",
                data: newCustomerForm,
                success:function(data){
					jQuery('.builderload').html("");
                    jQuery("#add_page_builder_item").append(data);
					jQuery('div.cs-drag-slider').each(function() {
						var _this = jQuery(this);
							_this.slider({
								range:'min',
								step: _this.data('slider-step'),
								min: _this.data('slider-min'),
								max: _this.data('slider-max'),
								value: _this.data('slider-value'),
								slide: function (event, ui) {
									jQuery(this).parents('li.to-field').find('.cs-range-input').val(ui.value)
								}
							});
						});
					jQuery('.bg_color').wpColorPicker(); 
					 jQuery( ".draginner" ) .sortable({
							connectWith: '.draginner',
							handle:'.column-in',
							cancel:'.draginner .poped-up,#confirmOverlay',
							revert:false,
							start: function( event, ui ) {jQuery(ui.item).css({"width":"25%"})},
							receive: function( event, ui ) {callme();},
							placeholder: "ui-state-highlight",
							forcePlaceholderSize:true
			  		 });
					 // if (count_widget > 0) jQuery("#no_widget").hide();
					//alert(count_widget);
                }
            });
            //return false;
        }
		
		function ajaxSubmitwidget(action,id){
			SuccessLoader ();
			counter++;
            var newCustomerForm = "action=" + action + '&counter=' + counter;
			var edit_url = action + counter;
			//jQuery('.composer-'+id).hide();
            jQuery.ajax({
                type:"POST",
                url: "<?php echo admin_url('admin-ajax.php')?>",
                data: newCustomerForm,
                success:function(data){
                jQuery("#counter_"+id).append(data);
				jQuery("#"+action+counter).append('<input type="hidden" name="cs_widget_element_num[]" value="form" />');
				jQuery('.bg_color').wpColorPicker(); 
				  jQuery( ".draginner" ) .sortable({
					connectWith: '.draginner',
					handle:'.column-in',
					cancel:'.draginner .poped-up,#confirmOverlay',
					revert:false,
					// start: function( event, ui ) {jQuery(ui.item).css({"width":"25%"})},
					receive: function( event, ui ) {callme();},
					placeholder: "ui-state-highlight",
					forcePlaceholderSize:true
			   });
				removeoverlay("composer-"+id,"append");
				jQuery('div.cs-drag-slider').each(function() {
						var _this = jQuery(this);
							_this.slider({
								range:'min',
								step: _this.data('slider-step'),
								min: _this.data('slider-min'),
								max: _this.data('slider-max'),
								value: _this.data('slider-value'),
								slide: function (event, ui) {
									jQuery(this).parents('li.to-field').find('.cs-range-input').val(ui.value)
								}
							});
						});
				callme(); 
                }
            });
		}
		function ajaxSubmitwidget_element(action,id,name){
			 SuccessLoader ();
			counter++;
            var newCustomerForm = "action=" + action + '&element_name=' + name + '&counter=' + counter;
			var edit_url = action + counter;
			//jQuery('.composer-'+id).hide();
            jQuery.ajax({
                type:"POST",
                url: "<?php echo admin_url('admin-ajax.php')?>",
                data: newCustomerForm,
                success:function(data){
                jQuery("#counter_"+id).append(data);
				//results-shortocde-id-form
				jQuery("#counter_"+id+" #results-shortocde-id-form").append('<input type="hidden" name="cs_widget_element_num[]" value="form" />');
				jQuery('.bg_color').wpColorPicker(); 
				  jQuery( ".draginner" ) .sortable({
					connectWith: '.draginner',
					handle:'.column-in',
					cancel:'.draginner .poped-up,#confirmOverlay',
					revert:false,
					// start: function( event, ui ) {jQuery(ui.item).css({"width":"25%"})},
					receive: function( event, ui ) {callme();},
					placeholder: "ui-state-highlight",
					forcePlaceholderSize:true
			   });
				removeoverlay("composer-"+id,"append");
				jQuery('div.cs-drag-slider').each(function() {
						var _this = jQuery(this);
							_this.slider({
								range:'min',
								step: _this.data('slider-step'),
								min: _this.data('slider-min'),
								max: _this.data('slider-max'),
								value: _this.data('slider-value'),
								slide: function (event, ui) {
									jQuery(this).parents('li.to-field').find('.cs-range-input').val(ui.value)
								}
							});
						});
				callme(); 
                }
            });
		}
        function ajaxSubmittt(action){
 			counter++;
			count_widget++;
            var newCustomerForm = "action=" + action + '&counter=' + counter;
            jQuery.ajax({
                type:"POST",
                url: "<?php echo admin_url()?>/admin-ajax.php",
                data: newCustomerForm,
                success:function(data){
                    jQuery("#add_page_builder_item").append(data);
					if (count_widget > 0) jQuery("#add_page_builder_item").addClass('hasclass');
					//alert(count_widget);
                }
            });
            //return false;
        }
    </script>
<?php  
}
function cs_page_options( $post ) {
	
	global $post, $cs_xmlObject,$cs_theme_options;
 	$cs_page_bulider = get_post_meta($post->ID, "cs_page_builder", true);
	
	if ( $cs_page_bulider <> "" ){
		$cs_xmlObject = new stdClass();
		$cs_xmlObject = new SimpleXMLElement($cs_page_bulider);
		$builder_active = $cs_xmlObject->builder_active;
	}
	//$cs_theme_options=get_option('cs_theme_options');
	$cs_builtin_seo_fields =$cs_theme_options['cs_builtin_seo_fields'];
	$cs_header_position =$cs_theme_options['cs_header_position'];
		?>
		<div class="elementhidden">
		<div class="tabs vertical">
        	<nav class="admin-navigtion">
               <ul id="myTab" class="nav nav-tabs">
                 <li class="active"><a href="#tab-general-settings" data-toggle="tab"><i class="fa fa-gear"></i><?php _e('General Settings','Awaken');?> </a></li>
                 <li><a href="#tab-slideshow" data-toggle="tab"><i class="fa fa-forward"></i><?php _e('Sub header','Awaken');?> </a></li>
                <?php if($cs_builtin_seo_fields == 'on'){?>
                 <li><a href="#tab-seo-advance-settings" data-toggle="tab"><i class="fa fa-dribbble"></i> <?php _e('Seo Options','Awaken');?></a></li>
                 <?php }?>
                <?php if($cs_header_position == 'absolute'){?>
                 <li><a href="#tab-header-position-settings" data-toggle="tab"><i class="fa fa-forward"></i><?php _e('Header Absolute','Awaken');?></a></li>
                 <?php }?>
	
                </ul>
           </nav>
          <!--- Tab Content --->
		  <div class="tab-content">
          	<!--- Content Tab --->
			<div id="tab-general-settings" class="tab-pane fade active in">
                <?php  //cs_general_settings_element();
					   cs_sidebar_layout_options();
					   cs_pagebuilder_themeoptions();
				?>
			</div>
            <!--- Content Tab --->
			<!--- Content Tab --->
			<div id="tab-slideshow" class="tab-pane fade">
				<?php cs_subheader_element();?>
			</div>
            <!--- Content Tab --->
                <!--- Content Tab --->
                <?php if($cs_builtin_seo_fields == 'on'){?>
                    <!--- Content Tab --->
                    <div id="tab-seo-advance-settings" class="tab-pane fade">
                        
                        <?php cs_seo_settitngs_element();?>
                    </div>
                    <!--- Content Tab --->
            	<?php }?>
				<?php if($cs_header_position == 'absolute'){?>
                <!--- Content Tab --->
                <div id="tab-header-position-settings" class="tab-pane fade">
                
                <?php cs_header_postition_element();?>
                </div>
                <!--- Content Tab --->
                <?php }?>

			<!--- Content Tab --->
		  </div>
          <!--- Tab Content --->
		</div>
	  </div>
	<?php
}
if ( isset($_POST['page_builder_form']) and $_POST['page_builder_form'] == 1 ) {
		add_action( 'save_post', 'save_page_builder' );
		function save_page_builder( $post_id ) {
			if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
				if ( isset($_POST['builder_active']) ) {
					$sxe = new SimpleXMLElement("<pagebuilder></pagebuilder>");
					if ( empty($_POST["builder_active"]) ) $_POST["builder_active"] = "";
					if ( empty($_POST["page_content"]) ) $_POST["page_content"] = "";
					$sxe->addChild('builder_active', $_POST['builder_active']);
					$sxe->addChild('page_content', $_POST['page_content']);
					$sxe = cs_page_options_save_xml($sxe);
								//if ( isset($_POST['cs_orderby']) ) {
									$cs_counter 			= 0;
									$page_element_id = 0;
									$cs_counter_gal 		= 0;
									$cs_counter_port 		= 0;
									$counter_team 			= 0;
									$cs_counter_slider 		= 0;
									$cs_counter_blog_slider = 0;
									$cs_counter_blog = 0;
									$cs_counter_sermon = 0;
									$cs_counter_latest_sermon = 0;
									$cs_counter_cause 		= 0;
									$cs_counter_news 		= 0;
									$cs_counter_contact 	= 0;
									$cs_counter_contactus 	= 0;
									$cs_counter_testimonial = 0;
									$cs_counter_column 		= 0;
									$cs_counter_mb 			= 0;
									$cs_counter_image 		= 0;
									$cs_counter_map 				= 0;
									$cs_counter_services_node 		= 0;
									$cs_counter_services 			= 0;
									$cs_counter_tabs_node 			= 0;
									$cs_counter_accordion_node 	  	= 0;
									$cs_counter_highlight 			= 0;
									$cs_counter_register 			= 0;
									$cs_counter_testimonials_node 	= 0;
									$cs_shortcode_counter_testimonial = 0;
									$cs_global_counter_testimonials = 0;
									$cs_counter_testimonials		= 0;
									$cs_counter_list 				= 0;
									$cs_counter_lists_node 			= 0;
									$cs_counter_team 				= 0;
									$cs_counter_team_node 			= 0;
									$counter_quote 					= 0;
									$counter_video 					= 0;
									$counter_quote 					= 0;
									$counter_services 				= 0;
									$counter_services_node 			= 0;
									$cs_global_counter_services = 0;
									$cs_shortcode_counter_services = 0;
									$counter_tabs 					= 0;
									$counter_tabs_node 				= 0;
									$cs_shortcode_counter_tabs 		= 0;
									$cs_global_counter_tabs 		= 0;
									$counter_accordion 				= 0;
									$counter_accordion_node 		= 0;
									$cs_global_counter_accordion    = 0;
									$cs_shortcode_counter_accordion = 0;
									$counter_faq 					= 0;
									$counter_faq_node 				= 0;
									$cs_global_counter_faq    		= 0;
									$cs_shortcode_counter_faq 		= 0;
									$cs_counter_toggle 				= 0;
									$cs_global_counter_toggle = 0;
									$cs_shortcode_counter_toggle = 0;
									$cs_counter_parallax 			= 0;
									$widget_no 						= 0;
									$column_container_no 			= 0;
									$cs_counter_dcpt 				= 0;
									$cs_counter_pricetables 		= 0;
									$cs_counter_pricetables_node 	= 0;
									$cs_global_counter_pricetables  = 0;
									$cs_shortcode_counter_pricetables = 0;
									$cs_counter_client				= 0;
									$cs_counter_image				= 0;
									$cs_counter_dropcap				= 0;
									$cs_counter_divider				= 0;
									$cs_counter_tooltip				= 0;
									$cs_counter_piecharts			= 0;
									$cs_global_counter_piecharts 	= 0;
									$cs_shortcode_counter_piecharts = 0;
									$cs_counter_progressbars		= 0;
									$cs_counter_progressbars_node 	= 0;
									$cs_global_counter_progressbars = 0;
									$cs_shortcode_counter_progressbars = 0;
									$cs_counter_table				= 0;
									$cs_global_counter_table 		= 0;
									$cs_shortcode_counter_table 	= 0;
									$cs_counter_message				= 0;
									$cs_counter_heading 			= 0;
									$cs_counter_button				= 0;
									$cs_counter_call_to_action 		= 0;
									$cs_global_counter_call_to_action = 0;
									$cs_shortcode_counter_call_to_action = 0;
									$cs_counter_fancyheading 		= 0;
									$cs_counter_promobox 			= 0;
									$cs_counter_iconbox 			= 0;
									$cs_counter_audio				= 0;
									$cs_counter_audio_node			= 0;
									$cs_counter_infobox 			= 0;
									$cs_counter_infobox_node 		= 0;
									$counter_coutner				= 0;
									$cs_global_counter_counter = 0;
									$cs_shortcode_counter_counter = 0;
									$counter_counter_item_node		= 0;
									$cs_counter_icons 				= 0;
									$cs_counter_map 				= 0;
									$cs_parallax_slider 			= 0;
									$cs_parallax_video_url 			= 0;
									$cs_parallax_video_mute 		= 0;
									$cs_counter_offerslider 		= 0;
									$cs_counter_clients				= 0;
									$cs_counter_clients_node		= 0;
									$cs_counter_contentslider 		= 0;
									$cs_counter_page_element		= 0;
									$cs_counter_members 			= 0;
									$cs_counter_spacer 				= 0;
									$cs_counter_teams				= 0;
									$cs_counter_tweets				= 0;
									$cs_counter_richeditor			= 0;
									$cs_counter_apple				= 0;
									$cs_global_counter_message		= 0;
									$cs_shortcode_counter_message	= 0;
									$cs_global_counter_button 		= 0;
									$cs_shortcode_counter_button	= 0;
									$cs_global_counter_column	= 0;
									$cs_shortcode_counter_column	= 0;
									$cs_global_counter_contactus	= 0;
									$cs_shortcode_counter_contactus	= 0;
									$cs_global_counter_tooltip	= 0;
									$cs_shortcode_counter_tooltip	= 0;
									$cs_global_counter_tweets	= 0;
									$cs_shortcode_counter_tweets	= 0;
									$cs_global_counter_heading	= 0;
									$cs_shortcode_counter_heading	= 0;
									$cs_global_counter_divider	= 0;
									$cs_shortcode_counter_divider	= 0;
									$cs_global_counter_quote	= 0;
									$cs_shortcode_counter_quote	= 0;
									$cs_global_counter_highlight	= 0;
									$cs_shortcode_counter_highlight	= 0;
									$cs_global_counter_register	= 0;
									$cs_shortcode_counter_register	= 0;
									$cs_global_counter_dropcap	= 0;
									$cs_shortcode_counter_dropcap	= 0;
									$cs_global_counter_list	= 0;
									$cs_shortcode_counter_list	= 0;
									$cs_global_counter_richeditor = 0;
									$cs_shortcode_counter_richeditor = 0;
									$cs_global_counter_blog_slider = 0;
									$cs_shortcode_counter_blog_slider = 0;
									$cs_global_counter_blog = 0;
									$cs_global_counter_sermon = 0;
									$cs_global_counter_latest_sermon = 0;
									$cs_shortcode_counter_blog = 0;
									$cs_shortcode_counter_sermon = 0;
									$cs_shortcode_counter_latest_sermon = 0;
									$cs_global_counter_teams = 0;
									$cs_shortcode_counter_teams = 0;
									$cs_global_counter_clients = 0;
									$cs_shortcode_counter_clients = 0;
									$cs_global_counter_page_element = 0;
									$cs_shortcode_counter_page_element = 0;
									$cs_global_counter_image= 0;
									$cs_shortcode_counter_image = 0;
									$cs_global_counter_promobox = 0;
									$cs_shortcode_counter_promobox = 0;
									$cs_global_counter_gallery = 0;
									$cs_shortcode_counter_gallery = 0;
									$cs_global_counter_video=0;
									$cs_shortcode_counter_video =0;
									$cs_global_counter_audio=0;
									$cs_shortcode_counter_audio =0;
									$cs_counter_offerslider_node = 0;
									$cs_global_counter_offerslider=0;
									$cs_shortcode_counter_offerslider =0;
									$cs_global_counter_spacer=0;
									$cs_shortcode_counter_spacer =0;
									$cs_global_counter_map=0;
									$cs_shortcode_counter_map =0;
									$cs_global_counter_icons =0;
									$cs_shortcode_counter_icons =0;
									$cs_global_counter_contentslider = 0;
									$cs_shortcode_counter_contentslider = 0;
									$cs_global_counter_members = 0;
									$cs_shortcode_counter_members = 0;
									$cs_global_counter_page_element = 0;
									$cs_shortcode_counter_page_element = 0;
									$cs_global_counter_infobox = 0;
									$cs_shortcode_counter_infobox = 0;
									$cs_shortcode_counter_slider	= 0;
									$cs_global_counter_slider	= 0;
									
									$counter_badges 				= 0;
									$cs_global_counter_badges 		= 0;
									$cs_shortcode_counter_badges 	= 0;
									
									$cs_counter_events 				= 0;
									$cs_global_counter_events 		= 0;
									$cs_shortcode_counter_events 	= 0;
									
									$cs_global_counter_cause = 0;
									$cs_shortcode_counter_cause = 0;
									$cs_counter_cause = 0;
									
									$cs_global_counter_latest_cause = 0;
									$cs_shortcode_counter_latest_cause = 0;
									$cs_counter_latest_cause = 0;
									
									$cs_global_counter_project = 0;
									$cs_shortcode_counter_project = 0;
									$cs_counter_project = 0;
									
								if(isset($_POST['total_column'])){	
										foreach ( $_POST['total_column'] as $count_column ) {
										// Sections Element Attributes start
										$column_container = $sxe->addChild('column_container');
										if ( empty($_POST['column_class'][$column_container_no]) ) $_POST['column_class'][$column_container_no] = "";
										$column_container->addAttribute('class', $_POST['column_class'][$column_container_no] );
										$column_rand_id = $_POST['column_rand_id'][$column_container_no];
										
										//cs_section_background_option
										if ( empty($_POST['cs_section_background_option'][$column_container_no]) ) $_POST['cs_section_background_option'][$column_container_no] = "";
										if ( empty($_POST['cs_section_bg_image'][$column_container_no]) ) $_POST['cs_section_bg_image'][$column_container_no] = "";
										if ( empty($_POST['cs_section_bg_image_position'][$column_container_no]) ) $_POST['cs_section_bg_image_position'][$column_container_no] = "";
										if ( empty($_POST['cs_section_flex_slider'][$column_container_no]) ) $_POST['cs_section_flex_slider'][$column_container_no] = "";
										if ( empty($_POST['cs_section_video_url'][$column_container_no]) ) $_POST['cs_section_video_url'][$column_container_no] = "";
										if ( empty($_POST['cs_section_video_mute'][$column_container_no]) ) $_POST['cs_section_video_mute'][$column_container_no] = "";
										if ( empty($_POST['cs_section_video_autoplay'][$column_container_no]) ) $_POST['cs_section_video_autoplay'][$column_container_no] = "";
										if ( empty($_POST['cs_section_bg_color'][$column_container_no]) ) $_POST['cs_section_bg_color'][$column_container_no] = "";
										if ( empty($_POST['cs_section_padding_top'][$column_container_no]) ) $_POST['cs_section_padding_top'][$column_container_no] = "";
										if ( empty($_POST['cs_section_padding_bottom'][$column_container_no]) ) $_POST['cs_section_padding_bottom'][$column_container_no] = "";
										if ( empty($_POST['cs_section_parallax'][$column_container_no]) ) $_POST['cs_section_parallax'][$column_container_no] = "";
										if ( empty($_POST['cs_section_css_id'][$column_container_no]) ) $_POST['cs_section_css_id'][$column_container_no] = "";
										if ( empty($_POST['cs_section_view'][$column_rand_id]['0']) ) $_POST['cs_section_view'][$column_rand_id] = "";
										if ( empty($_POST['cs_layout'][$column_rand_id]['0']) ) $_POST['cs_layout'][$column_rand_id]['0'] = "";
										
										
										$column_container->addAttribute('cs_section_background_option', $_POST['cs_section_background_option'][$column_container_no] );
										$column_container->addAttribute('cs_section_bg_image', $_POST['cs_section_bg_image'][$column_container_no] );
										$column_container->addAttribute('cs_section_bg_image_position', $_POST['cs_section_bg_image_position'][$column_container_no] );
										$column_container->addAttribute('cs_section_flex_slider', $_POST['cs_section_flex_slider'][$column_container_no] );
										$column_container->addAttribute('cs_section_custom_slider', $_POST['cs_section_custom_slider'][$column_container_no] );
										$column_container->addAttribute('cs_section_video_url', $_POST['cs_section_video_url'][$column_container_no] );
										$column_container->addAttribute('cs_section_video_mute', $_POST['cs_section_video_mute'][$column_container_no] );
										$column_container->addAttribute('cs_section_video_autoplay', $_POST['cs_section_video_autoplay'][$column_container_no] );
										$column_container->addAttribute('cs_section_bg_color', $_POST['cs_section_bg_color'][$column_container_no] );
										$column_container->addAttribute('cs_section_padding_top', $_POST['cs_section_padding_top'][$column_container_no] );
										$column_container->addAttribute('cs_section_padding_bottom', $_POST['cs_section_padding_bottom'][$column_container_no] );
										$column_container->addAttribute('cs_section_border_bottom', $_POST['cs_section_border_bottom'][$column_container_no] );
										$column_container->addAttribute('cs_section_border_top', $_POST['cs_section_border_top'][$column_container_no] );
										$column_container->addAttribute('cs_section_border_color', $_POST['cs_section_border_color'][$column_container_no] );
										$column_container->addAttribute('cs_section_margin_top', $_POST['cs_section_margin_top'][$column_container_no] );
										$column_container->addAttribute('cs_section_margin_bottom', $_POST['cs_section_margin_bottom'][$column_container_no] );
										$column_container->addAttribute('cs_section_parallax', $_POST['cs_section_parallax'][$column_container_no] );
										$column_container->addAttribute('cs_section_css_id', $_POST['cs_section_css_id'][$column_container_no] );
										$column_container->addAttribute('cs_section_view', $_POST['cs_section_view'][$column_container_no] );
										$column_container->addAttribute('cs_layout', $_POST['cs_layout'][$column_rand_id]['0'] );
										$column_container->addAttribute('cs_sidebar_left', $_POST['cs_sidebar_left'][$column_container_no] );
										$column_container->addAttribute('cs_sidebar_right', $_POST['cs_sidebar_right'][$column_container_no] );
										// Sections Element Attributes end
										for ( $i = 0; $i < $count_column; $i++ ) {
											$column = $column_container->addChild('column');
											$a = $_POST['total_widget'][$widget_no];
											for ( $j = 1; $j <= $a; $j++ ){	
											$page_element_id++;
										// Typography Start
										// Save Column page element 
										if ( $_POST['cs_orderby'][$cs_counter] == "flex_column" ) {
 												$shortcode = '';
												$flex_column = $column->addChild('flex_column');
												$flex_column->addChild('page_element_size', htmlspecialchars($_POST['flex_column_element_size'][$cs_global_counter_column]) );
												$flex_column->addChild('flex_column_element_size', htmlspecialchars($_POST['flex_column_element_size'][$cs_global_counter_column]) );
												if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
													$shortcode_str =stripslashes(htmlspecialchars(( $_POST['shortcode']['flex_column'][$cs_shortcode_counter_column]), ENT_QUOTES ));
													$cs_shortcode_counter_column++;
													$flex_column->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
													
												} else {
													$shortcode = '[cs_column ';
													if(isset($_POST['flex_column_section_title'][$cs_counter_column]) && $_POST['flex_column_section_title'][$cs_counter_column] != ''){
														$shortcode .= 	'flex_column_section_title="'.stripslashes(htmlspecialchars(($_POST['flex_column_section_title'][$cs_counter_column]), ENT_QUOTES )).'" ';
													}
													if(isset($_POST['cs_column_class'][$cs_counter_column]) && $_POST['cs_column_class'][$cs_counter_column] != ''){
														$shortcode .= 	'cs_column_class="'.htmlspecialchars($_POST['cs_column_class'][$cs_counter_column], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_column_animation'][$cs_counter_column]) && $_POST['cs_column_animation'][$cs_counter_column] != ''){
														$shortcode .= 	'cs_column_animation="'.htmlspecialchars($_POST['cs_column_animation'][$cs_counter_column]).'" ';
													}
													$shortcode .= 	']';
													if(isset($_POST['flex_column_text'][$cs_counter_column]) && $_POST['flex_column_text'][$cs_counter_column] != ''){
														$shortcode .= 	htmlspecialchars($_POST['flex_column_text'][$cs_counter_column], ENT_QUOTES).' ';
													}
 													$shortcode .= 	'[/cs_column]';
													$flex_column->addChild('cs_shortcode', $shortcode );
													$cs_counter_column++;
												}
											$cs_global_counter_column++;
										}
										// Save Form page element 
										else if ( $_POST['cs_orderby'][$cs_counter] == "richeditor" ) {
												$shortcode = '';
												$richeditor_column = $column->addChild('richeditor');
												$richeditor_column->addChild('page_element_size', htmlspecialchars($_POST['richeditor_element_size'][$cs_counter_richeditor]) );
												$richeditor_column->addChild('richeditor_element_size', htmlspecialchars($_POST['richeditor_element_size'][$cs_counter_richeditor]) );
												if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
													$shortcode_str = stripslashes ($_POST['shortcode']['richeditor'][$cs_shortcode_counter_richeditor]);
													$cs_shortcode_counter_richeditor++;
													$richeditor_column->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
												} else {
														$shortcode = '[cs_richeditor ';
														if(isset($_POST['richeditor_section_title'][$cs_counter_richeditor]) && $_POST['richeditor_section_title'][$cs_counter_richeditor] != ''){
															$shortcode .= 	'richeditor_section_title="'.htmlspecialchars($_POST['richeditor_section_title'][$cs_counter_richeditor], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_richeditor_class'][$cs_counter_richeditor]) && $_POST['cs_richeditor_class'][$cs_counter_richeditor] != ''){
															$shortcode .= 	'cs_richeditor_class="'.htmlspecialchars($_POST['cs_richeditor_class'][$cs_counter_richeditor], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_richeditor_animation'][$cs_counter_richeditor]) && $_POST['cs_richeditor_animation'][$cs_counter_richeditor] != ''){
															$shortcode .= 	'cs_richeditor_animation="'.htmlspecialchars($_POST['cs_richeditor_animation'][$cs_counter_richeditor], ENT_QUOTES).'" ';
														}
														if(isset($_POST['csricheditor'][$cs_counter_column]) && $_POST['csricheditor'][$cs_counter_richeditor] != ''){
															$shortcode .= 	'csricheditor="'.htmlspecialchars($_POST['csricheditor'][$cs_counter_richeditor], ENT_QUOTES).'" ';
														}
														$shortcode .= 	']';
														if(isset($_POST['csricheditor'][$cs_counter_richeditor]) && $_POST['csricheditor'][$cs_counter_richeditor] != ''){
															$shortcode .= 	htmlspecialchars($_POST['csricheditor'][$cs_counter_richeditor], ENT_QUOTES).' ';
														}
														$shortcode .= 	'[/cs_richeditor]';
														$richeditor_column->addChild('cs_shortcode', htmlspecialchars($shortcode, ENT_QUOTES) );
													$cs_counter_richeditor++;
												}
												$cs_global_counter_richeditor++;
										}
										else if ( $_POST['cs_orderby'][$cs_counter] == "contactus" ) {
													$shortcode = '';
													$contact_us = $column->addChild('contactus');
													$contact_us->addChild('page_element_size', htmlspecialchars($_POST['contactus_element_size'][$cs_global_counter_contactus]) );
													$contact_us->addChild('contactus_element_size', htmlspecialchars($_POST['contactus_element_size'][$cs_global_counter_contactus]) );
													if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
														$shortcode_str = stripslashes ($_POST['shortcode']['contactus'][$cs_shortcode_counter_contactus]);
														$cs_shortcode_counter_contactus++;
														$contact_us->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
													} else {
														$shortcode = '[cs_contactus ';
														if(isset($_POST['cs_contactus_section_title'][$cs_counter_contactus]) && $_POST['cs_contactus_section_title'][$cs_counter_contactus] != ''){
															$shortcode .= 	'cs_contactus_section_title="'.htmlspecialchars($_POST['cs_contactus_section_title'][$cs_counter_contactus], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_contactus_label'][$cs_counter_contactus]) && $_POST['cs_contactus_label'][$cs_counter_contactus] != ''){
															$shortcode .= 	'cs_contactus_label="'.htmlspecialchars($_POST['cs_contactus_label'][$cs_counter_contactus], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_contactus_view'][$cs_counter_contactus]) && $_POST['cs_contactus_view'][$cs_counter_contactus] != ''){
															$shortcode .= 	'cs_contactus_view="'.htmlspecialchars($_POST['cs_contactus_view'][$cs_counter_contactus], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_contactus_send'][$cs_counter_contactus]) && $_POST['cs_contactus_send'][$cs_counter_contactus] != ''){
															$shortcode .= 	'cs_contactus_send="'.htmlspecialchars($_POST['cs_contactus_send'][$cs_counter_contactus], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_success'][$cs_counter_contactus]) && $_POST['cs_success'][$cs_counter_contactus] != ''){
															$shortcode .= 	'cs_success="'.htmlspecialchars($_POST['cs_success'][$cs_counter_contactus], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_error'][$cs_counter_contactus]) && $_POST['cs_error'][$cs_counter_contactus] != ''){
															$shortcode .= 	'cs_error="'.htmlspecialchars($_POST['cs_error'][$cs_counter_contactus], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_form_id'][$cs_counter_contactus]) && $_POST['cs_form_id'][$cs_counter_contactus] != ''){
															$shortcode .= 	'cs_form_id="'.htmlspecialchars($_POST['cs_form_id'][$cs_counter_contactus], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_contact_class'][$cs_counter_contactus]) && $_POST['cs_contact_class'][$cs_counter_contactus] != ''){
															$shortcode .= 	'cs_contact_class="'.htmlspecialchars($_POST['cs_contact_class'][$cs_counter_contactus], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_contact_animation'][$cs_counter_contactus]) && $_POST['cs_contact_animation'][$cs_counter_contactus] != ''){
															$shortcode .= 	'cs_contact_animation="'.htmlspecialchars($_POST['cs_contact_animation'][$cs_counter_contactus], ENT_QUOTES).'" ';
														}
														$shortcode .= 	']';
														$contact_us->addChild('cs_shortcode', $shortcode );
														$cs_counter_contactus++;
													}
												$cs_global_counter_contactus++;
										}
										// Save Tooltip page element 
										else if ( $_POST['cs_orderby'][$cs_counter] == "tooltip" ) {
													$shortcode = '';
													
													$tooltip = $column->addChild('tooltip');
													$tooltip->addChild('page_element_size', htmlspecialchars($_POST['tooltip_element_size'][$cs_global_counter_tooltip]));
													$tooltip->addChild('tooltip_element_size', htmlspecialchars($_POST['tooltip_element_size'][$cs_global_counter_tooltip]));
													if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
														$shortcode_str = stripslashes ($_POST['shortcode']['tooltip'][$cs_shortcode_counter_tooltip]);
														$cs_shortcode_counter_tooltip++;
														$tooltip->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
													} else {
														$shortcode = '[cs_tooltip ';
														if(isset($_POST['tooltip_hover_title'][$cs_counter_tooltip]) && $_POST['tooltip_hover_title'][$cs_counter_tooltip] != ''){
															$shortcode .= 	'tooltip_hover_title="'.htmlspecialchars($_POST['tooltip_hover_title'][$cs_counter_tooltip], ENT_QUOTES).'" ';
														}
														if(isset($_POST['tooltip_data_placement'][$cs_counter_tooltip]) && $_POST['tooltip_data_placement'][$cs_counter_tooltip] != ''){
															$shortcode .= 	'tooltip_data_placement="'.htmlspecialchars($_POST['tooltip_data_placement'][$cs_counter_tooltip], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_tooltip_class'][$cs_counter_tooltip]) && $_POST['cs_tooltip_class'][$cs_counter_tooltip] != ''){
															$shortcode .= 	'cs_tooltip_class="'.htmlspecialchars($_POST['cs_tooltip_class'][$cs_counter_tooltip], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_tooltip_animation'][$cs_counter_tooltip]) && $_POST['cs_tooltip_animation'][$cs_counter_tooltip] != ''){
															$shortcode .= 	'cs_tooltip_animation="'.htmlspecialchars($_POST['cs_tooltip_animation'][$cs_counter_tooltip]).'" ';
														}
														$shortcode .= 	']';
														if(isset($_POST['tooltip_content'][$cs_counter_tooltip])){
															$shortcode .= 	htmlspecialchars($_POST['tooltip_content'][$cs_counter_tooltip], ENT_QUOTES);
														}
														$shortcode .= 	'[/cs_tooltip]';
														$tooltip->addChild('cs_shortcode', $shortcode );
														$cs_counter_tooltip++;
													}
												$cs_global_counter_tooltip++;
										}
										// Save heading page element 
										else if ( $_POST['cs_orderby'][$cs_counter] == "heading" ) {
												$shortcode = '';
												$heading = $column->addChild('heading');
												$heading->addChild('page_element_size', htmlspecialchars($_POST['heading_element_size'][$cs_global_counter_heading]) );
												$heading->addChild('heading_element_size', htmlspecialchars($_POST['heading_element_size'][$cs_global_counter_heading]) );
												if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
													$shortcode_str = stripslashes($_POST['shortcode']['heading'][$cs_shortcode_counter_heading]);
													$cs_shortcode_counter_heading++;
													$heading->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
												} else {
													$shortcode = '[cs_heading ';
													if(isset($_POST['heading_title'][$cs_counter_heading]) && $_POST['heading_title'][$cs_counter_heading] != ''){
														$shortcode .= 	'heading_title="'.htmlspecialchars($_POST['heading_title'][$cs_counter_heading], ENT_QUOTES).'" ';
													}
													if(isset($_POST['heading_style'][$cs_counter_heading]) && $_POST['heading_style'][$cs_counter_heading] != ''){
														$shortcode .= 	'heading_style="'.htmlspecialchars($_POST['heading_style'][$cs_counter_heading]).'" ';
													}
													if(isset($_POST['heading_size'][$cs_counter_heading]) && $_POST['heading_size'][$cs_counter_heading] != ''){
														$shortcode .= 	'heading_size="'.htmlspecialchars($_POST['heading_size'][$cs_counter_heading], ENT_QUOTES).'" ';
													}
													if(isset($_POST['heading_align'][$cs_counter_heading]) && $_POST['heading_align'][$cs_counter_heading] != ''){
														$shortcode .= 	'heading_align="'.htmlspecialchars($_POST['heading_align'][$cs_counter_heading], ENT_QUOTES).'" ';
													}
													if(isset($_POST['heading_font_style'][$cs_counter_heading]) && $_POST['heading_font_style'][$cs_counter_heading] != ''){
														$shortcode .= 	'heading_font_style="'.htmlspecialchars($_POST['heading_font_style'][$cs_counter_heading], ENT_QUOTES).'" ';
													}
													if(isset($_POST['heading_divider'][$cs_counter_heading]) && $_POST['heading_divider'][$cs_counter_heading] != ''){
														$shortcode .= 	'heading_divider="'.htmlspecialchars($_POST['heading_divider'][$cs_counter_heading]).'" ';
													}
													if(isset($_POST['heading_color'][$cs_counter_heading]) && $_POST['heading_color'][$cs_counter_heading] != ''){
														$shortcode .= 	'heading_color="'.htmlspecialchars($_POST['heading_color'][$cs_counter_heading], ENT_QUOTES).'" ';
													}
													if(isset($_POST['color_title'][$cs_counter_heading]) && $_POST['color_title'][$cs_counter_heading] != ''){
														$shortcode .= 	'color_title="'.htmlspecialchars($_POST['color_title'][$cs_counter_heading], ENT_QUOTES).'" ';
													}
													if(isset($_POST['heading_content_color'][$cs_counter_heading]) && $_POST['heading_content_color'][$cs_counter_heading] != ''){
														$shortcode .= 	'heading_content_color="'.htmlspecialchars($_POST['heading_content_color'][$cs_counter_heading], ENT_QUOTES).'" ';
													}
													if(isset($_POST['heading_animation'][$cs_counter_heading]) && $_POST['heading_animation'][$cs_counter_heading] != ''){
														$shortcode .= 	'heading_animation="'.htmlspecialchars($_POST['heading_animation'][$cs_counter_heading]).'" ';
													}
													$shortcode .= 	']';
													if(isset($_POST['heading_content'][$cs_counter_heading]) && $_POST['heading_content'][$cs_counter_heading] != ''){
														$shortcode .= 	htmlspecialchars($_POST['heading_content'][$cs_counter_heading], ENT_QUOTES);
													}
													$shortcode .= 	'[/cs_heading]';
													$heading->addChild('cs_shortcode', $shortcode );
													$cs_counter_heading++;
												}
											$cs_global_counter_heading++;
										}
										// Save divider page element 
										else if ( $_POST['cs_orderby'][$cs_counter] == "divider" ) {
												$shortcode = '';
												$divider   = $column->addChild('divider');
												$divider->addChild('page_element_size', htmlspecialchars($_POST['divider_element_size'][$cs_global_counter_divider]) );
												$divider->addChild('divider_element_size', htmlspecialchars($_POST['divider_element_size'][$cs_global_counter_divider]) );
												if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
													$shortcode_str = stripslashes ($_POST['shortcode']['divider'][$cs_shortcode_counter_divider]);
													$cs_shortcode_counter_divider++;
													$divider->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
												} else {
													$shortcode = '[cs_divider ';
														if(isset($_POST['divider_style'][$cs_counter_divider]) && $_POST['divider_style'][$cs_counter_divider] != ''){
															$shortcode .= 	'divider_style="'.htmlspecialchars($_POST['divider_style'][$cs_counter_divider]).'" ';
														}
														if(isset($_POST['divider_backtotop'][$cs_counter_divider]) && $_POST['divider_backtotop'][$cs_counter_divider] != ''){
															$shortcode .= 	'divider_backtotop="'.htmlspecialchars($_POST['divider_backtotop'][$cs_counter_divider]).'" ';
														}
														if(isset($_POST['divider_margin_top'][$cs_counter_divider]) && $_POST['divider_margin_top'][$cs_counter_divider] != ''){
															$shortcode .= 	'divider_margin_top="'.htmlspecialchars($_POST['divider_margin_top'][$cs_counter_divider]).'" ';
														}
														if(isset($_POST['divider_margin_bottom'][$cs_counter_divider]) && $_POST['divider_margin_bottom'][$cs_counter_divider] != ''){
															$shortcode .= 	'divider_margin_bottom="'.htmlspecialchars($_POST['divider_margin_bottom'][$cs_counter_divider]).'" ';
														}
														if(isset($_POST['divider_height'][$cs_counter_divider]) && $_POST['divider_height'][$cs_counter_divider] != ''){
															$shortcode .= 	'divider_height="'.htmlspecialchars($_POST['divider_height'][$cs_counter_divider]).'" ';
														}
														if(isset($_POST['cs_divider_class'][$cs_counter_divider]) && $_POST['cs_divider_class'][$cs_counter_divider] != ''){
															$shortcode .= 	'cs_divider_class="'.htmlspecialchars($_POST['cs_divider_class'][$cs_counter_divider], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_divider_animation'][$cs_counter_divider]) && $_POST['cs_divider_animation'][$cs_counter_divider] != ''){
															$shortcode .= 	'cs_divider_animation="'.htmlspecialchars($_POST['cs_divider_animation'][$cs_counter_divider]).'" ';
														}
														$shortcode .= 	']';
													$divider->addChild('cs_shortcode', $shortcode );
													$cs_counter_divider++;
												}
												$cs_global_counter_divider++;
										}// Save divider page element 
										else if ( $_POST['cs_orderby'][$cs_counter] == "badges" ) {
												$shortcode = '';
												$badge   = $column->addChild('badges');
												$badge->addChild('page_element_size', htmlspecialchars($_POST['badges_element_size'][$cs_shortcode_counter_badges]) );
												$badge->addChild('badges_element_size', htmlspecialchars($_POST['badges_element_size'][$cs_shortcode_counter_badges]) );
												if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
													$shortcode_str = stripslashes ($_POST['shortcode']['badges'][$cs_global_counter_badges]);
													$cs_global_counter_badges++;
													$badge->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
												} else {
													$shortcode = '[cs_badges ';
														if(isset($_POST['cs_numbering'][$cs_counter_divider]) && $_POST['cs_numbering'][$counter_badges] != ''){
															$shortcode .= 	'cs_numbering="'.htmlspecialchars($_POST['cs_numbering'][$counter_badges]).'" ';
														}
														if(isset($_POST['cs_badges_class'][$cs_counter_divider]) && $_POST['cs_badges_class'][$counter_badges] != ''){
															$shortcode .= 	'cs_badges_class="'.htmlspecialchars($_POST['cs_badges_class'][$counter_badges]).'" ';
														}
														if(isset($_POST['cs_badges_animation'][$cs_counter_divider]) && $_POST['cs_badges_animation'][$counter_badges] != ''){
															$shortcode .= 	'cs_badges_animation="'.htmlspecialchars($_POST['cs_badges_animation'][$counter_badges]).'" ';
														}
														
														$shortcode .= 	']';
													$badge->addChild('cs_shortcode', $shortcode );
													$counter_badges++;
												}
												$cs_shortcode_counter_badges++;
										}// Save Badges page element 
										else if ( $_POST['cs_orderby'][$cs_counter] == "spacer" ) {
											$shortcode = '';
											$spacer 		= $column->addChild('spacer');
 											$spacer->addChild('page_element_size', '100');
											if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
												$shortcode_str = stripslashes ($_POST['shortcode']['spacer'][$cs_shortcode_counter_spacer]);
												$cs_shortcode_counter_spacer++;
												$spacer->addChild('cs_shortcode', htmlspecialchars($shortcode_str) );
											} else {
  												$shortcode = '[cs_spacer ';
												if(isset($_POST['cs_spacer_height'][$cs_counter_spacer]) && $_POST['cs_spacer_height'][$cs_counter_spacer] != ''){
													$shortcode .= 	'cs_spacer_height="'.htmlspecialchars($_POST['cs_spacer_height'][$cs_counter_spacer]).'" ';
												}
												$shortcode .= 	']';
												$spacer->addChild('cs_shortcode', $shortcode );
												$cs_counter_spacer++;
											}
											$cs_global_counter_spacer++;
										}
										// Save quote page element 
										else if ( $_POST['cs_orderby'][$cs_counter] == "quote" ) {
													$shortcode = '';
													$quote = $column->addChild('quote');
													$quote->addChild('page_element_size', htmlspecialchars($_POST['quote_element_size'][$cs_global_counter_quote]) );
													$quote->addChild('quote_element_size', htmlspecialchars($_POST['quote_element_size'][$cs_global_counter_quote]) );
													if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
														$shortcode_str = stripslashes ($_POST['shortcode']['quote'][$cs_shortcode_counter_quote]);
														$cs_shortcode_counter_quote++;
														$quote->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
													} else {
														$shortcode = '[cs_quote ';
														if(isset($_POST['quote_cite'][$counter_quote]) && $_POST['quote_cite'][$counter_quote] != ''){
															$shortcode .= 	'quote_cite="'.htmlspecialchars($_POST['quote_cite'][$counter_quote], ENT_QUOTES).'" ';
														}
														if(isset($_POST['quote_cite_url'][$counter_quote]) && $_POST['quote_cite_url'][$counter_quote] != ''){
															$shortcode .= 	'quote_cite_url="'.htmlspecialchars($_POST['quote_cite_url'][$counter_quote], ENT_QUOTES).'" ';
														}
														if(isset($_POST['quote_text_color'][$counter_quote]) && $_POST['quote_text_color'][$counter_quote] != ''){
															$shortcode .= 	'quote_text_color="'.htmlspecialchars($_POST['quote_text_color'][$counter_quote]).'" ';
														}
														if(isset($_POST['quote_align'][$counter_quote]) && $_POST['quote_align'][$counter_quote] != ''){
															$shortcode .= 	'quote_align="'.htmlspecialchars($_POST['quote_align'][$counter_quote]).'" ';
														}
														if(isset($_POST['cs_quote_section_title'][$counter_quote]) && $_POST['cs_quote_section_title'][$counter_quote] != ''){
															$shortcode .= 	'cs_quote_section_title="'.htmlspecialchars($_POST['cs_quote_section_title'][$counter_quote], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_quote_class'][$counter_quote]) && $_POST['cs_quote_class'][$counter_quote] != ''){
															$shortcode .= 	'cs_quote_class="'.htmlspecialchars($_POST['cs_quote_class'][$counter_quote], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_quote_animation'][$counter_quote]) && $_POST['cs_quote_animation'][$counter_quote] != ''){
															$shortcode .= 	'cs_quote_animation="'.htmlspecialchars($_POST['cs_quote_animation'][$counter_quote]).'" ';
														}
														$shortcode .= 	']';
														if(isset($_POST['quote_content'][$counter_quote])){
															$shortcode .= 	htmlspecialchars($_POST['quote_content'][$counter_quote], ENT_QUOTES);
														}
														$shortcode .= 	'[/cs_quote]';
														$quote->addChild('cs_shortcode', $shortcode );
														$counter_quote++;
													}
												$cs_global_counter_quote++;
										}
										// Save highlight page element 
										else if ( $_POST['cs_orderby'][$cs_counter] == "highlight" ) {
											$shortcode = '';
											$highlight = $column->addChild('highlight');
											$highlight->addChild('page_element_size', htmlspecialchars($_POST['highlight_element_size'][$cs_global_counter_highlight]) );
											$highlight->addChild('highlight_element_size', htmlspecialchars($_POST['highlight_element_size'][$cs_global_counter_highlight]) );
											if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
												$shortcode_str = stripslashes ($_POST['shortcode']['highlight'][$cs_shortcode_counter_highlight]);
												$cs_shortcode_counter_highlight++;
												$highlight->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
											} else {
												$shortcode = '[cs_highlight ';
												if(isset($_POST['highlight_bg_color'][$cs_counter_highlight]) && $_POST['highlight_bg_color'][$cs_counter_highlight] != ''){
													$shortcode .= 	'highlight_bg_color="'.htmlspecialchars($_POST['highlight_bg_color'][$cs_counter_highlight]).'" ';
												}
												if(isset($_POST['highlight_color'][$cs_counter_highlight]) && $_POST['highlight_color'][$cs_counter_highlight] != ''){
													$shortcode .= 	'highlight_color="'.htmlspecialchars($_POST['highlight_color'][$cs_counter_highlight]).'" ';
												}
												if(isset($_POST['cs_highlight_class'][$cs_counter_highlight]) && $_POST['cs_highlight_class'][$cs_counter_highlight] != ''){
													$shortcode .= 	'cs_highlight_class="'.htmlspecialchars($_POST['cs_highlight_class'][$cs_counter_highlight], ENT_QUOTES).'" ';
												}
												if(isset($_POST['cs_highlight_animation'][$cs_counter_highlight]) && $_POST['cs_highlight_animation'][$cs_counter_highlight] != ''){
													$shortcode .= 	'cs_custom_animation="'.htmlspecialchars($_POST['cs_highlight_animation'][$cs_counter_highlight]).'" ';
												}
												$shortcode .= 	']';
												if(isset($_POST['highlight_content'][$cs_counter_highlight]) && $_POST['highlight_content'][$cs_counter_highlight] != ''){
													$shortcode .= 	htmlspecialchars($_POST['highlight_content'][$cs_counter_highlight], ENT_QUOTES);
												}
												$shortcode .= 	'[/cs_highlight]';
												$highlight->addChild('cs_shortcode', $shortcode );
												$cs_counter_highlight++;
											}	
											$cs_global_counter_highlight++;
										}
										
										// Save register page element 
										else if ( $_POST['cs_orderby'][$cs_counter] == "register" ) {
											$shortcode = '';
											$register = $column->addChild('register');
											$register->addChild('page_element_size', htmlspecialchars($_POST['register_element_size'][$cs_global_counter_register]) );
											$register->addChild('register_element_size', htmlspecialchars($_POST['register_element_size'][$cs_global_counter_register]) );
											if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
												$shortcode_str = stripslashes ($_POST['shortcode']['register'][$cs_shortcode_counter_register]);
												$cs_shortcode_counter_register++;
												$register->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
											} else {
												$shortcode = '[cs_register ';
												if(isset($_POST['register_title'][$cs_counter_register]) && $_POST['register_title'][$cs_counter_register] != ''){
													$shortcode .= 	'register_title="'.htmlspecialchars($_POST['register_title'][$cs_counter_register]).'" ';
												}
												if(isset($_POST['register_role'][$cs_counter_register]) && $_POST['register_role'][$cs_counter_register] != ''){
													$shortcode .= 	'register_role="'.htmlspecialchars($_POST['register_role'][$cs_counter_register]).'" ';
												}
												if(isset($_POST['register_text'][$cs_counter_register]) && $_POST['register_text'][$cs_counter_register] != ''){
													$shortcode .= 	'register_text="'.htmlspecialchars($_POST['register_text'][$cs_counter_register]).'" ';
												}
												if(isset($_POST['cs_register_class'][$cs_counter_register]) && $_POST['cs_register_class'][$cs_counter_register] != ''){
													$shortcode .= 	'cs_register_class="'.htmlspecialchars($_POST['cs_register_class'][$cs_counter_register], ENT_QUOTES).'" ';
												}
												if(isset($_POST['cs_register_animation'][$cs_counter_register]) && $_POST['cs_register_animation'][$cs_counter_register] != ''){
													$shortcode .= 	'cs_register_animation="'.htmlspecialchars($_POST['cs_register_animation'][$cs_counter_register]).'" ';
												}
												$shortcode .= 	'[/cs_register]';
												$register->addChild('cs_shortcode', $shortcode );
												$cs_counter_register++;
											}	
											$cs_global_counter_register++;
										}
 										// Save dropcap page element 
										 else if ( $_POST['cs_orderby'][$cs_counter] == "dropcap" ) {
											$shortcode = '';
											
											$dropcap = $column->addChild('dropcap');
											$dropcap->addChild('page_element_size', htmlspecialchars($_POST['dropcap_element_size'][$cs_global_counter_dropcap]) );
											$dropcap->addChild('dropcap_element_size', htmlspecialchars($_POST['dropcap_element_size'][$cs_global_counter_dropcap]) );
											if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
												$shortcode_str = stripslashes ($_POST['shortcode']['dropcap'][$cs_shortcode_counter_dropcap]);
												$cs_shortcode_counter_dropcap++;
												$dropcap->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
											} else {
												$shortcode = '[cs_dropcap ';
												if(isset($_POST['dropcap_style'][$cs_counter_dropcap]) && $_POST['dropcap_style'][$cs_counter_dropcap] != ''){
													$shortcode .= 	'dropcap_style="'.htmlspecialchars($_POST['dropcap_style'][$cs_counter_dropcap]).'" ';
												}
												if(isset($_POST['dropcap_size'][$cs_counter_dropcap]) && $_POST['dropcap_size'][$cs_counter_dropcap] != ''){
													$shortcode .= 	'dropcap_size="'.htmlspecialchars($_POST['dropcap_size'][$cs_counter_dropcap]).'" ';
												}
												if(isset($_POST['cs_dropcap_section_title'][$cs_counter_dropcap]) && $_POST['cs_dropcap_section_title'][$cs_counter_dropcap] != ''){
													$shortcode .= 	'cs_dropcap_section_title="'.htmlspecialchars($_POST['cs_dropcap_section_title'][$cs_counter_dropcap], ENT_QUOTES).'" ';
												}
												if(isset($_POST['dropcap_color'][$cs_counter_dropcap]) && $_POST['dropcap_color'][$cs_counter_dropcap] != ''){
													$shortcode .= 	'dropcap_color="'.htmlspecialchars($_POST['dropcap_color'][$cs_counter_dropcap]).'" ';
												}
												if(isset($_POST['dropcap_bg_color'][$cs_counter_dropcap]) && $_POST['dropcap_bg_color'][$cs_counter_dropcap] != ''){
													$shortcode .= 	'dropcap_bg_color="'.htmlspecialchars($_POST['dropcap_bg_color'][$cs_counter_dropcap]).'" ';
												}
												
												if(isset($_POST['cs_dropcap_class'][$cs_counter_dropcap]) && $_POST['cs_dropcap_class'][$cs_counter_dropcap] != ''){
													$shortcode .= 	'cs_dropcap_class="'.htmlspecialchars($_POST['cs_dropcap_class'][$cs_counter_dropcap], ENT_QUOTES).'" ';
												}
												if(isset($_POST['cs_dropcap_animation'][$cs_counter_dropcap]) && $_POST['cs_dropcap_animation'][$cs_counter_dropcap] != ''){
													$shortcode .= 	'cs_dropcap_animation="'.htmlspecialchars($_POST['cs_dropcap_animation'][$cs_counter_dropcap]).'" ';
												}
												$shortcode .= 	']';
												if(isset($_POST['dropcap_content'][$cs_counter_dropcap]) && $_POST['dropcap_content'][$cs_counter_dropcap] != ''){
													$shortcode .= 	htmlspecialchars($_POST['dropcap_content'][$cs_counter_dropcap], ENT_QUOTES);
												}
												$shortcode .= 	'[/cs_dropcap]';
												$dropcap->addChild('cs_shortcode', $shortcode );
												$cs_counter_dropcap++;
											}
											$cs_global_counter_dropcap++;
										} 
										// Save testimonials page element 
										else if ( $_POST['cs_orderby'][$cs_counter] == "testimonials" ) {
											$shortcode = $shortcode_item = '';
											$testimonials = $column->addChild('testimonials');
											$testimonials->addChild('page_element_size', htmlspecialchars($_POST['testimonials_element_size'][$cs_global_counter_testimonials]) );
											$testimonials->addChild('testimonials_element_size', htmlspecialchars($_POST['testimonials_element_size'][$cs_global_counter_testimonials]) );
											if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
												$shortcode_str = stripslashes ($_POST['shortcode']['testimonials'][$cs_shortcode_counter_testimonial]);
												$cs_shortcode_counter_testimonial++;
												$testimonials->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
											} else {
												if(isset($_POST['testimonials_num'][$cs_counter_testimonials]) && $_POST['testimonials_num'][$cs_counter_testimonials]>0){
													for ( $i = 1; $i <= $_POST['testimonials_num'][$cs_counter_testimonials]; $i++ ){
														$shortcode_item .= '[testimonial_item ';
														
														if(isset($_POST['testimonial_company'][$cs_counter_testimonials_node]) && $_POST['testimonial_company'][$cs_counter_testimonials_node] != ''){
															$shortcode_item .= 	'testimonial_company="'.htmlspecialchars($_POST['testimonial_company'][$cs_counter_testimonials_node], ENT_QUOTES).'" ';
														}
														if(isset($_POST['testimonial_img'][$cs_counter_testimonials_node]) && $_POST['testimonial_img'][$cs_counter_testimonials_node] != ''){
															$shortcode_item .= 	'testimonial_img="'.htmlspecialchars($_POST['testimonial_img'][$cs_counter_testimonials_node], ENT_QUOTES).'" ';
														}
														
														if(isset($_POST['testimonial_author'][$cs_counter_testimonials_node]) && $_POST['testimonial_author'][$cs_counter_testimonials_node] != ''){
															$shortcode_item .= 	'testimonial_author="'.htmlspecialchars($_POST['testimonial_author'][$cs_counter_testimonials_node], ENT_QUOTES).'" ';
														}
														$shortcode_item .= 	']';
														if(isset($_POST['testimonial_text'][$cs_counter_testimonials_node]) && $_POST['testimonial_text'][$cs_counter_testimonials_node] != ''){
															$shortcode_item .= 	htmlspecialchars($_POST['testimonial_text'][$cs_counter_testimonials_node], ENT_QUOTES);
														}
														$shortcode_item .= 	'[/testimonial_item]'; 
														$cs_counter_testimonials_node++;
													}
												}
												$section_title = '';
												if(isset($_POST['cs_testimonial_section_title'][$cs_counter_testimonials]) && $_POST['cs_testimonial_section_title'][$cs_counter_testimonials] != ''){
													$section_title = 	'cs_testimonial_section_title="'.htmlspecialchars($_POST['cs_testimonial_section_title'][$cs_counter_testimonials], ENT_QUOTES).'" ';
												}
												$shortcode = '[cs_testimonials testimonial_style="'.htmlspecialchars($_POST['testimonial_style'][$cs_counter_testimonials], ENT_QUOTES).'" 
												 testimonial_text_color="'.htmlspecialchars($_POST['testimonial_text_color'][$cs_counter_testimonials]).'"
												 cs_testimonial_text_align="'.htmlspecialchars($_POST['cs_testimonial_text_align'][$cs_counter_testimonials]).'"
												 cs_testimonial_class="'.htmlspecialchars($_POST['cs_testimonial_class'][$cs_counter_testimonials], ENT_QUOTES).'"
												 cs_testimonial_animation="'.htmlspecialchars($_POST['cs_testimonial_animation'][$cs_counter_testimonials]).'"
												 '.$section_title.' ]'.$shortcode_item.'[/cs_testimonials]';
												$testimonials->addChild('cs_shortcode', $shortcode );
												$cs_counter_testimonials++;
											}
											$cs_global_counter_testimonials++;
										}
										// Save List page element 
										 else if ( $_POST['cs_orderby'][$cs_counter] == "list" ) {
											$shortcode = $shortcode_item = '';
											$lists = $column->addChild('list');
											$lists->addChild('page_element_size', htmlspecialchars($_POST['list_element_size'][$cs_global_counter_list]) );
											$lists->addChild('list_element_size', htmlspecialchars($_POST['list_element_size'][$cs_global_counter_list]) );
											if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
												$shortcode_str = stripslashes ($_POST['shortcode']['list'][$cs_shortcode_counter_list]);
												$cs_shortcode_counter_list++;
												$lists->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
											} else {
												if(isset($_POST['list_num'][$cs_counter_list]) && $_POST['list_num'][$cs_counter_list]>0){
													for ( $i = 1; $i <= $_POST['list_num'][$cs_counter_list]; $i++ ){
														$shortcode_item .= '[list_item ';
														if(isset($_POST['cs_list_icon'][$cs_counter_lists_node])){
															$shortcode_item .= 	'cs_list_icon="'.htmlspecialchars($_POST['cs_list_icon'][$cs_counter_lists_node], ENT_QUOTES).'" ';
														}
														$shortcode_item .= 	']';
														if(isset($_POST['cs_list_item'][$cs_counter_lists_node])){
															$shortcode_item .= 	htmlspecialchars($_POST['cs_list_item'][$cs_counter_lists_node], ENT_QUOTES);
														}
														$shortcode_item .= 	'[/list_item]'; 
														$cs_counter_lists_node++;
													}
												}
												$shortcode = '[cs_list ';
												
												$shortcode .= 	'column_size="1/1" ';
												if(isset($_POST['cs_list_type'][$cs_counter_list]) && $_POST['cs_list_type'][$cs_counter_list] != ''){
													$shortcode .= 	'cs_list_type="'.htmlspecialchars($_POST['cs_list_type'][$cs_counter_list]).'" ';
												}
												if(isset($_POST['cs_border'][$cs_counter_list]) && $_POST['cs_border'][$cs_counter_list] != ''){
													$shortcode .= 	'cs_border="'.htmlspecialchars($_POST['cs_border'][$cs_counter_list]).'" ';
												}
												if(isset($_POST['cs_list_section_title'][$cs_counter_list]) && $_POST['cs_list_section_title'][$cs_counter_list] != ''){
													$shortcode .= 	'cs_list_section_title="'.htmlspecialchars($_POST['cs_list_section_title'][$cs_counter_list], ENT_QUOTES).'" ';
												}
												if(isset($_POST['cs_list_class'][$cs_counter_list]) && $_POST['cs_list_class'][$cs_counter_list] != ''){
													$shortcode .= 	'cs_list_class="'.htmlspecialchars($_POST['cs_list_class'][$cs_counter_list], ENT_QUOTES).'" ';
												}
												if(isset($_POST['cs_list_animation'][$cs_counter_list]) && $_POST['cs_list_animation'][$cs_counter_list] != ''){
													$shortcode .= 	'cs_list_animation="'.htmlspecialchars($_POST['cs_list_animation'][$cs_counter_list]).'" ';
												}
												$shortcode .= 	']'.$shortcode_item.'[/cs_list]';
												$lists->addChild('cs_shortcode', $shortcode );
												$cs_counter_list++;
											}
											$cs_global_counter_list++;
										}
										// Save message page element 
										else if ( $_POST['cs_orderby'][$cs_counter] == "mesage" ) {
												$shortcode = $shortcode_item = '';
												$message = $column->addChild('mesage');
												$message->addChild('page_element_size', htmlspecialchars($_POST['mesage_element_size'][$cs_global_counter_message]) );
												$message->addChild('message_element_size', htmlspecialchars($_POST['mesage_element_size'][$cs_global_counter_message]) );
												if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
													$shortcode_str = stripslashes ($_POST['shortcode']['mesage'][$cs_shortcode_counter_message]);
													$cs_shortcode_counter_message++;
													$message->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
												} else {
													$shortcode = '[cs_message ';
													if(isset($_POST['cs_message_title'][$cs_counter_message]) && $_POST['cs_message_title'][$cs_counter_message] != ''){
														$shortcode .= 	'cs_message_title="'.htmlspecialchars($_POST['cs_message_title'][$cs_counter_message], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_title_color'][$cs_counter_message]) && $_POST['cs_title_color'][$cs_counter_message] != ''){
														$shortcode .= 	'cs_title_color="'.htmlspecialchars($_POST['cs_title_color'][$cs_counter_message]).'" ';
													}
													if(isset($_POST['cs_text_color'][$cs_counter_message]) && $_POST['cs_text_color'][$cs_counter_message] != ''){
														$shortcode .= 	'cs_text_color="'.htmlspecialchars($_POST['cs_text_color'][$cs_counter_message]).'" ';
													}
													if(isset($_POST['cs_background_color'][$cs_counter_message]) && $_POST['cs_background_color'][$cs_counter_message] != ''){
														$shortcode .= 	'cs_background_color="'.htmlspecialchars($_POST['cs_background_color'][$cs_counter_message]).'" ';
													}
													if(isset($_POST['cs_icon_color'][$cs_counter_message]) && $_POST['cs_icon_color'][$cs_counter_message] != ''){
														$shortcode .= 	'cs_icon_color="'.htmlspecialchars($_POST['cs_icon_color'][$cs_counter_message]).'" ';
													}
													if(isset($_POST['cs_message_box_title'][$cs_counter_message]) && $_POST['cs_message_box_title'][$cs_counter_message] != ''){
														$shortcode .= 	'cs_message_box_title="'.htmlspecialchars($_POST['cs_message_box_title'][$cs_counter_message]).'" ';
													}
													if(isset($_POST['cs_button_text'][$cs_counter_message]) && $_POST['cs_button_text'][$cs_counter_message] != ''){
														$shortcode .= 	'cs_button_text="'.htmlspecialchars($_POST['cs_button_text'][$cs_counter_message], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_button_link'][$cs_counter_message]) && $_POST['cs_button_link'][$cs_counter_message] != ''){
														$shortcode .= 	'cs_button_link="'.htmlspecialchars($_POST['cs_button_link'][$cs_counter_message], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_message_icon'][$cs_counter_message]) && $_POST['cs_message_icon'][$cs_counter_message] != ''){
														$shortcode .= 	'cs_message_icon="'.htmlspecialchars($_POST['cs_message_icon'][$cs_counter_message]).'" ';
													}
													if(isset($_POST['cs_message_type'][$cs_counter_message]) && $_POST['cs_message_type'][$cs_counter_message] != ''){
														$shortcode .= 	'cs_message_type="'.htmlspecialchars($_POST['cs_message_type'][$cs_counter_message]).'" ';
													}
													if(isset($_POST['cs_style_type'][$cs_counter_message]) && $_POST['cs_style_type'][$cs_counter_message] != ''){
														$shortcode .= 	'cs_style_type="'.htmlspecialchars($_POST['cs_style_type'][$cs_counter_message]).'" ';
													}
													if(isset($_POST['cs_message_close'][$cs_counter_message]) && $_POST['cs_message_close'][$cs_counter_message] != ''){
														$shortcode .= 	'cs_message_close="'.htmlspecialchars($_POST['cs_message_close'][$cs_counter_message]).'" ';
													}
													if(isset($_POST['cs_alert_style'][$cs_counter_message]) && $_POST['cs_alert_style'][$cs_counter_message] != ''){
														$shortcode .= 	'cs_alert_style="'.htmlspecialchars($_POST['cs_alert_style'][$cs_counter_message]).'" ';
													}
													if(isset($_POST['cs_msg_section_title'][$cs_counter_message]) && $_POST['cs_msg_section_title'][$cs_counter_message] != ''){
														$shortcode .= 	'cs_msg_section_title="'.htmlspecialchars($_POST['cs_msg_section_title'][$cs_counter_message], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_message_class'][$cs_counter_message]) && $_POST['cs_message_class'][$cs_counter_message] != ''){
														$shortcode .= 	'cs_message_class="'.htmlspecialchars($_POST['cs_message_class'][$cs_counter_message], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_message_animation'][$cs_counter_message]) && $_POST['cs_message_animation'][$cs_counter_message] != ''){
														$shortcode .= 	'cs_message_animation="'.htmlspecialchars($_POST['cs_message_animation'][$cs_counter_message]).'" ';
													}
													$shortcode .= 	']';
													if(isset($_POST['cs_message_text'][$cs_counter_message]) && $_POST['cs_message_text'][$cs_counter_message] != ''){
														$shortcode .= 	htmlspecialchars($_POST['cs_message_text'][$cs_counter_message], ENT_QUOTES);
													}
													$shortcode .= 	'[/cs_message]';
													$message->addChild('cs_shortcode', $shortcode );
													$cs_counter_message++;
												}
												$cs_global_counter_message++;
										}
										// Typography end
										
										// Common Elements Start
											
											// Services
											else if ( $_POST['cs_orderby'][$cs_counter] == "services" ) {
													$shortcode = $shortcode_item = '';
													$services  = $column->addChild('services');
													$services->addChild('page_element_size', $_POST['services_element_size'][$cs_global_counter_services]);
													$services->addChild('services_element_size',$_POST['services_element_size'][$cs_global_counter_services]);
													
													if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
														$shortcode_str = stripslashes ($_POST['shortcode']['services'][$cs_shortcode_counter_services]);
														$cs_shortcode_counter_services++;
														$services->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
													} else {
														$shortcode_item .= '[cs_services ';
														if(isset($_POST['cs_service_type'][$cs_counter_services]) && $_POST['cs_service_type'][$cs_counter_services] != ''){
															$shortcode_item .= 	'cs_service_type="'.htmlspecialchars($_POST['cs_service_type'][$cs_counter_services], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_service_icon_type'][$cs_counter_services]) && $_POST['cs_service_icon_type'][$cs_counter_services] != ''){
															$shortcode_item .= 	'cs_service_icon_type="'.htmlspecialchars($_POST['cs_service_icon_type'][$cs_counter_services]).'" ';
														}
														if(isset($_POST['cs_service_icon'][$cs_counter_services]) && $_POST['cs_service_icon'][$cs_counter_services] != ''){
															$shortcode_item .= 	'cs_service_icon="'.htmlspecialchars($_POST['cs_service_icon'][$cs_counter_services]).'" ';
														}
														if(isset($_POST['cs_service_icon_color'][$cs_counter_services]) && $_POST['cs_service_icon_color'][$cs_counter_services] != ''){
															$shortcode_item .= 	'cs_service_icon_color="'.htmlspecialchars($_POST['cs_service_icon_color'][$cs_counter_services]).'" ';
														}
														if(isset($_POST['cs_service_bg_image'][$cs_counter_services]) && $_POST['cs_service_bg_image'][$cs_counter_services] != ''){
															$shortcode_item .= 	'cs_service_bg_image="'.htmlspecialchars($_POST['cs_service_bg_image'][$cs_counter_services]).'" ';
														}
														if(isset($_POST['cs_service_bg_color'][$cs_counter_services]) && $_POST['cs_service_bg_color'][$cs_counter_services] != ''){
															$shortcode_item .= 	'cs_service_bg_color="'.htmlspecialchars($_POST['cs_service_bg_color'][$cs_counter_services]).'" ';
														}
														if(isset($_POST['service_icon_size'][$cs_counter_services]) && $_POST['service_icon_size'][$cs_counter_services] != ''){
															$shortcode_item .= 	'service_icon_size="'.htmlspecialchars($_POST['service_icon_size'][$cs_counter_services]).'" ';
														}
														if(isset($_POST['cs_service_postion_modern'][$cs_counter_services]) && $_POST['cs_service_postion_modern'][$cs_counter_services] != ''){
															$shortcode_item .= 	'cs_service_postion_modern="'.htmlspecialchars($_POST['cs_service_postion_modern'][$cs_counter_services]).'" ';
														}
														if(isset($_POST['cs_service_postion_classic'][$cs_counter_services]) && $_POST['cs_service_postion_classic'][$cs_counter_services] != ''){
															$shortcode_item .= 	'cs_service_postion_classic="'.htmlspecialchars($_POST['cs_service_postion_classic'][$cs_counter_services]).'" ';
														}
														if(isset($_POST['cs_service_title'][$cs_counter_services]) && $_POST['cs_service_title'][$cs_counter_services] != ''){
															$shortcode_item .= 	'cs_service_title="'.htmlspecialchars($_POST['cs_service_title'][$cs_counter_services], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_service_link_text'][$cs_counter_services]) && $_POST['cs_service_link_text'][$cs_counter_services] != ''){
															$shortcode_item .= 	'cs_service_link_text="'.htmlspecialchars($_POST['cs_service_link_text'][$cs_counter_services]).'" ';
														}
														if(isset($_POST['cs_service_link_color'][$cs_counter_services]) && $_POST['cs_service_link_color'][$cs_counter_services] != ''){
															$shortcode_item .= 	'cs_service_link_color="'.htmlspecialchars($_POST['cs_service_link_color'][$cs_counter_services], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_service_url'][$cs_counter_services]) && $_POST['cs_service_url'][$cs_counter_services] != ''){
															$shortcode_item .= 	'cs_service_url="'.htmlspecialchars($_POST['cs_service_url'][$cs_counter_services]).'" ';
														}
														if(isset($_POST['cs_service_class'][$cs_counter_services]) && $_POST['cs_service_class'][$cs_counter_services] != ''){
															$shortcode_item .= 	'cs_service_class="'.htmlspecialchars($_POST['cs_service_class'][$cs_counter_services]).'" ';
														}
														if(isset($_POST['cs_service_animation'][$cs_counter_services]) && $_POST['cs_service_animation'][$cs_counter_services] != ''){
															$shortcode_item .= 	'cs_service_animation="'.htmlspecialchars($_POST['cs_service_animation'][$cs_counter_services]).'" ';
														}
														
														$shortcode_item .= 	']';
														if(isset($_POST['cs_service_content'][$cs_counter_services]) && $_POST['cs_service_content'][$cs_counter_services] != ''){
															$shortcode_item .= 	htmlspecialchars($_POST['cs_service_content'][$cs_counter_services], ENT_QUOTES);
														}
														$shortcode_item .= 	'[/cs_services]';
														$services->addChild('cs_shortcode', $shortcode_item );
												   $cs_counter_services++;
												}
												$cs_global_counter_services++;
											}
											// Accrodian
											else if ( $_POST['cs_orderby'][$cs_counter] == "accordion" ) {
												$shortcode = $shortcode_item = '';
												$accordions = $column->addChild('accordion');
												$accordions->addChild('page_element_size', htmlspecialchars($_POST['accordion_element_size'][$cs_global_counter_accordion]) );
												$accordions->addChild('accordion_element_size', htmlspecialchars($_POST['accordion_element_size'][$cs_global_counter_accordion]) );
												if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
													$shortcode_str = stripslashes ($_POST['shortcode']['accordion'][$cs_shortcode_counter_accordion]);
													$cs_shortcode_counter_accordion++;
													$accordions->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
												} else {
													if(isset($_POST['accordion_num'][$counter_accordion]) && $_POST['accordion_num'][$counter_accordion]>0){			
														for ( $i = 1; $i <= $_POST['accordion_num'][$counter_accordion]; $i++ ){
																$shortcode_item .= '[accordian_item ';
																if(isset($_POST['accordion_title'][$counter_accordion_node]) && $_POST['accordion_title'][$counter_accordion_node] != ''){
																	$shortcode_item .= 	'accordion_title="'.htmlspecialchars($_POST['accordion_title'][$counter_accordion_node], ENT_QUOTES).'" ';
																}
																if(isset($_POST['accordion_active'][$counter_accordion_node]) && $_POST['accordion_active'][$counter_accordion_node] != ''){
																	$shortcode_item .= 	'accordion_active="'.htmlspecialchars($_POST['accordion_active'][$counter_accordion_node]).'" ';
																}
																if(isset($_POST['cs_accordian_icon'][$counter_accordion_node]) && $_POST['cs_accordian_icon'][$counter_accordion_node] != ''){
																	$shortcode_item .= 	'cs_accordian_icon="'.htmlspecialchars($_POST['cs_accordian_icon'][$counter_accordion_node], ENT_QUOTES).'" ';
																}
															
																$shortcode_item .= 	']';
																if(isset($_POST['accordion_text'][$counter_accordion_node]) && $_POST['accordion_text'][$counter_accordion_node] != ''){
																	$shortcode_item .= 	htmlspecialchars($_POST['accordion_text'][$counter_accordion_node], ENT_QUOTES);
																}
																$shortcode_item .= 	'[/accordian_item]'; 
																	 
																$counter_accordion_node++;
															}
													}
													
													$section_title = '';
													if(isset($_POST['cs_accordian_section_title'][$counter_accordion]) && $_POST['cs_accordian_section_title'][$counter_accordion] != ''){
														$section_title = 	'cs_accordian_section_title="'.htmlspecialchars($_POST['cs_accordian_section_title'][$counter_accordion], ENT_QUOTES).'" ';
													}
													$shortcode = '[cs_accordian accordian_style="'.htmlspecialchars($_POST['accordian_style'][$counter_accordion]).'" '.$section_title;
													
													
													if(isset($_POST['accordion_class'][$counter_accordion]) && $_POST['accordion_class'][$counter_accordion] != ''){
														$shortcode .= 	' accordion_class="'.htmlspecialchars($_POST['accordion_class'][$counter_accordion], ENT_QUOTES).'" ';
													}
													if(isset($_POST['accordion_animation'][$counter_accordion]) && $_POST['accordion_animation'][$counter_accordion] != ''){
														$shortcode .= 	' accordion_animation="'.htmlspecialchars($_POST['accordion_animation'][$counter_accordion]).'" ';
													}
													$shortcode .= ']'.$shortcode_item.'[/cs_accordian]';
													
													$accordions->addChild('cs_shortcode', $shortcode );
													$counter_accordion++;
												}
												$cs_global_counter_accordion++;
											}
											// Faq
											else if ( $_POST['cs_orderby'][$cs_counter] == "faq" ) {
												$shortcode = $shortcode_item = '';
												$faqs = $column->addChild('faq');
												$faqs->addChild('page_element_size', htmlspecialchars($_POST['faq_element_size'][$cs_global_counter_faq]) );
												$faqs->addChild('faq_element_size', htmlspecialchars($_POST['faq_element_size'][$cs_global_counter_faq]) );
												if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
													$shortcode_str = stripslashes ($_POST['shortcode']['faq'][$cs_shortcode_counter_faq]);
													$cs_shortcode_counter_faq++;
													$faqs->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );

												} else {
													if(isset($_POST['faq_num'][$counter_faq]) && $_POST['faq_num'][$counter_faq]>0){			
														for ( $i = 1; $i <= $_POST['faq_num'][$counter_faq]; $i++ ){
																$shortcode_item .= '[faq_item ';
																if(isset($_POST['faq_title'][$counter_faq_node]) && $_POST['faq_title'][$counter_faq_node] != ''){
																	$shortcode_item .= 	'faq_title="'.htmlspecialchars($_POST['faq_title'][$counter_faq_node], ENT_QUOTES).'" ';
																}
																if(isset($_POST['faq_active'][$counter_faq_node]) && $_POST['faq_active'][$counter_faq_node] != ''){
																	$shortcode_item .= 	'faq_active="'.htmlspecialchars($_POST['faq_active'][$counter_faq_node]).'" ';
																}
																if(isset($_POST['cs_faq_icon'][$counter_faq_node]) && $_POST['cs_faq_icon'][$counter_faq_node] != ''){
																	$shortcode_item .= 	'cs_faq_icon="'.htmlspecialchars($_POST['cs_faq_icon'][$counter_faq_node], ENT_QUOTES).'" ';
																}
															
																$shortcode_item .= 	']';
																if(isset($_POST['faq_text'][$counter_faq_node]) && $_POST['faq_text'][$counter_faq_node] != ''){
																	$shortcode_item .= 	htmlspecialchars($_POST['faq_text'][$counter_faq_node], ENT_QUOTES);
																}
																$shortcode_item .= 	'[/faq_item]'; 
																	 
																$counter_faq_node++;
															}
													}
													
													$section_title = '';
													if(isset($_POST['cs_faq_section_title'][$counter_faq]) && $_POST['cs_faq_section_title'][$counter_faq] != ''){
														$section_title = 	'cs_faq_section_title="'.htmlspecialchars($_POST['cs_faq_section_title'][$counter_faq], ENT_QUOTES).'" ';
													}
													$shortcode = '[cs_faq '.$section_title;
													
													
													if(isset($_POST['faq_class'][$counter_faq]) && $_POST['faq_class'][$counter_faq] != ''){
														$shortcode .= 	' faq_class="'.htmlspecialchars($_POST['faq_class'][$counter_faq], ENT_QUOTES).'" ';
													}
													if(isset($_POST['faq_animation'][$counter_faq]) && $_POST['faq_animation'][$counter_faq] != ''){
														$shortcode .= 	' faq_animation="'.htmlspecialchars($_POST['faq_animation'][$counter_faq]).'" ';
													}
													$shortcode .= ']'.$shortcode_item.'[/cs_faq]';
													
													$faqs->addChild('cs_shortcode', $shortcode );
													$counter_faq++;
												}
												$cs_global_counter_faq++;
											}
											// Tabs
											else if ( $_POST['cs_orderby'][$cs_counter] == "tabs" ) {
												$shortcode = $shortcode_item = '';
												$tabs = $column->addChild('tabs');
												$tabs->addChild('page_element_size', htmlspecialchars($_POST['tabs_element_size'][$cs_global_counter_tabs]) );
												$tabs->addChild('tabs_element_size', htmlspecialchars($_POST['tabs_element_size'][$cs_global_counter_tabs]) );
												if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
													$shortcode_str = stripslashes ($_POST['shortcode']['tabs'][$cs_shortcode_counter_tabs]);
													$cs_shortcode_counter_tabs++;
													$tabs->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
												}else {
														if(isset($_POST['tabs_num'][$counter_tabs]) && $_POST['tabs_num'][$counter_tabs]>0){
															for ( $i = 1; $i <= $_POST['tabs_num'][$counter_tabs]; $i++ ){
															$shortcode_item .= '[tab_item ';
															if(isset($_POST['tab_title'][$counter_tabs_node]) && $_POST['tab_title'][$counter_tabs_node] != ''){
																$shortcode_item .= 	'tab_title="'.htmlspecialchars($_POST['tab_title'][$counter_tabs_node], ENT_QUOTES).'" ';
															}
															if(isset($_POST['tab_active'][$counter_tabs_node]) && $_POST['tab_active'][$counter_tabs_node] != ''){
																$shortcode_item .= 	'tab_active="'.htmlspecialchars($_POST['tab_active'][$counter_tabs_node]).'" ';
															}
															if(isset($_POST['cs_tab_icon'][$counter_tabs_node]) && $_POST['cs_tab_icon'][$counter_tabs_node] != ''){
																$shortcode_item .= 	'cs_tab_icon="'.htmlspecialchars($_POST['cs_tab_icon'][$counter_tabs_node], ENT_QUOTES).'" ';
															}
														
															$shortcode_item .= 	']';
															if(isset($_POST['tab_text'][$counter_tabs_node]) && $_POST['tab_text'][$counter_tabs_node] != ''){
																$shortcode_item .=htmlspecialchars($_POST['tab_text'][$counter_tabs_node], ENT_QUOTES);
															}
															$shortcode_item .= 	'[/tab_item]'; 
															$counter_tabs_node++;
														}
													 }
													$section_title = '';
													if(isset($_POST['cs_tabs_section_title'][$counter_tabs]) && $_POST['cs_tabs_section_title'][$counter_tabs] != ''){
														$section_title = 	'cs_tabs_section_title="'.htmlspecialchars($_POST['cs_tabs_section_title'][$counter_tabs], ENT_QUOTES).'" ';
													}
													$shortcode = '[cs_tabs '.$section_title.'  cs_tab_style="'.htmlspecialchars($_POST['cs_tab_style'][$counter_tabs]).'" cs_tabs_class="'.htmlspecialchars($_POST['cs_tabs_class'][$counter_tabs], ENT_QUOTES).'"   cs_tabs_animation="'.htmlspecialchars($_POST['cs_tabs_animation'][$counter_tabs]).'"]'.$shortcode_item.'[/cs_tabs]';
													$tabs->addChild('cs_shortcode', $shortcode );
												$counter_tabs++;
												}
										    $cs_global_counter_tabs++;
											}
											// Toggle
											else if ( $_POST['cs_orderby'][$cs_counter] == "toggle" ) {
												$shortcode = '';
												$toggle = $column->addChild('toggle');
												$toggle->addChild('page_element_size', htmlspecialchars($_POST['toggle_element_size'][$cs_global_counter_toggle]) );
												$toggle->addChild('toggle_element_size', htmlspecialchars($_POST['toggle_element_size'][$cs_global_counter_toggle]) );
												
												if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
													$shortcode_str = stripslashes ($_POST['shortcode']['toggle'][$cs_shortcode_counter_toggle]);
													$cs_shortcode_counter_toggle++;
													$toggle->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
												} else {
													$shortcode .= '[cs_toggle ';
													if(isset($_POST['cs_toggle_section_title'][$counter_tabs]) && $_POST['cs_toggle_section_title'][$counter_tabs] != ''){
														$shortcode .= 	'cs_toggle_section_title="'.htmlspecialchars($_POST['cs_toggle_section_title'][$counter_tabs]).'" ';
													}
													if(isset($_POST['cs_toggle_title'][$cs_counter_toggle]) && trim($_POST['cs_toggle_title'][$cs_counter_toggle]) <> ''){
														$shortcode .= 	'cs_toggle_title="'.htmlspecialchars($_POST['cs_toggle_title'][$cs_counter_toggle], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_toggle_icon'][$cs_counter_toggle]) && $_POST['cs_toggle_icon'][$cs_counter_toggle] != ''){
														$shortcode .= 	'cs_toggle_icon="'.htmlspecialchars($_POST['cs_toggle_icon'][$cs_counter_toggle], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_toggle_state'][$counter_tabs_node]) && $_POST['cs_toggle_state'][$cs_counter_toggle] != ''){
														$shortcode .= 	'cs_toggle_state="'.htmlspecialchars($_POST['cs_toggle_state'][$cs_counter_toggle], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_toggle_custom_class'][$cs_counter]) && $_POST['cs_toggle_custom_class'][$cs_counter] != ''){
														$shortcode .= 	'cs_toggle_custom_class="'.htmlspecialchars($_POST['cs_toggle_custom_class'][$cs_counter], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_toggle_custom_animation'][$cs_counter]) && $_POST['cs_toggle_custom_animation'][$cs_counter] != ''){
														$shortcode .= 	'cs_toggle_custom_animation="'.htmlspecialchars($_POST['cs_toggle_custom_animation'][$cs_counter]).'" ';
													}
												
													$shortcode .= 	']';
													if(isset($_POST['cs_toggle_text'][$cs_counter_toggle]) && $_POST['cs_toggle_text'][$cs_counter_toggle] != ''){
														$shortcode .= 	htmlspecialchars($_POST['cs_toggle_text'][$cs_counter_toggle], ENT_QUOTES);
													}
													$shortcode .= 	'[/cs_toggle]';
													$toggle->addChild('cs_shortcode', $shortcode );
													$cs_counter_toggle++;
												}
												$cs_global_counter_toggle++;
											}
											// Counters
											else if ( $_POST['cs_orderby'][$cs_counter] == "counter" ) {
												$shortcode_item = '';
												$counter = $column->addChild('counter');
												$counter->addChild('counter_element_size', htmlspecialchars($_POST['counter_element_size'][$cs_global_counter_counter]) );
												$counter->addChild('page_element_size', htmlspecialchars($_POST['counter_element_size'][$cs_global_counter_counter]) );
												
												if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
													$shortcode_str = stripslashes ($_POST['shortcode']['counter'][$cs_shortcode_counter_counter]);
													$cs_shortcode_counter_counter++;
													$counter->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
												} else {
													$shortcode_item .= '[cs_counter ';
													if(isset($_POST['counter_style'][$counter_coutner]) && $_POST['counter_style'][$counter_coutner] != ''){
														$shortcode_item .= 	'counter_style="'.htmlspecialchars($_POST['counter_style'][$counter_coutner]).'" ';
													}
													if(isset($_POST['counter_title'][$counter_coutner]) && $_POST['counter_title'][$counter_coutner] != ''){
														$shortcode_item .= 	'counter_title="'.htmlspecialchars($_POST['counter_title'][$counter_coutner], ENT_QUOTES).'" ';
													}
													if(isset($_POST['counter_link_title'][$counter_coutner]) && $_POST['counter_link_title'][$counter_coutner] != ''){
														$shortcode_item .= 	'counter_link_title="'.htmlspecialchars($_POST['counter_link_title'][$counter_coutner], ENT_QUOTES).'" ';
													}
													if(isset($_POST['counter_link_url'][$counter_coutner]) && $_POST['counter_link_url'][$counter_coutner] != ''){
														$shortcode_item .= 	'counter_link_url="'.htmlspecialchars($_POST['counter_link_url'][$counter_coutner], ENT_QUOTES).'" ';
													}
													
													if(isset($_POST['counter_icon_type'][$counter_coutner]) && $_POST['counter_icon_type'][$counter_coutner] != ''){
														$shortcode_item .= 	'counter_icon_type="'.htmlspecialchars($_POST['counter_icon_type'][$counter_coutner]).'" ';
													}
													if(isset($_POST['counter_icon'][$counter_coutner]) && $_POST['counter_icon'][$counter_coutner] != ''){
														$shortcode_item .= 	'counter_icon="'.htmlspecialchars($_POST['counter_icon'][$counter_coutner], ENT_QUOTES).'" ';
													}
													if(isset($_POST['counter_icon_align'][$counter_coutner]) && $_POST['counter_icon_align'][$counter_coutner] != ''){
														$shortcode_item .= 	'counter_icon_align="'.htmlspecialchars($_POST['counter_icon_align'][$counter_coutner], ENT_QUOTES).'" ';
													}
													if(isset($_POST['counter_icon_size'][$counter_coutner]) && $_POST['counter_icon_size'][$counter_coutner] != ''){
														$shortcode_item .= 	'counter_icon_size="'.htmlspecialchars($_POST['counter_icon_size'][$counter_coutner], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_counter_logo'][$counter_coutner]) && $_POST['cs_counter_logo'][$counter_coutner] != ''){
														$shortcode_item .= 	'cs_counter_logo="'.htmlspecialchars($_POST['cs_counter_logo'][$counter_coutner], ENT_QUOTES).'" ';
													}
													if(isset($_POST['counter_icon_color'][$counter_coutner]) && $_POST['counter_icon_color'][$counter_coutner] != ''){
														$shortcode_item .= 	'counter_icon_color="'.htmlspecialchars($_POST['counter_icon_color'][$counter_coutner], ENT_QUOTES).'" ';
													}
													
													if(isset($_POST['counter_numbers'][$counter_coutner]) && $_POST['counter_numbers'][$counter_coutner] != ''){
														$shortcode_item .= 	'counter_numbers="'.htmlspecialchars($_POST['counter_numbers'][$counter_coutner]).'" ';
													}
													if(isset($_POST['counter_number_color'][$counter_coutner]) && $_POST['counter_number_color'][$counter_coutner] != ''){
														$shortcode_item .= 	'counter_number_color="'.htmlspecialchars($_POST['counter_number_color'][$counter_coutner]).'" ';
													}
													if(isset($_POST['counter_text_color'][$counter_coutner]) && $_POST['counter_text_color'][$counter_coutner] != ''){
														$shortcode_item .= 	'counter_text_color="'.htmlspecialchars($_POST['counter_text_color'][$counter_coutner]).'" ';
													}
													if(isset($_POST['counter_border'][$counter_coutner]) && $_POST['counter_border'][$counter_coutner] != ''){
														$shortcode_item .= 	'counter_border="'.htmlspecialchars($_POST['counter_border'][$counter_coutner]).'" ';
													}
													if(isset($_POST['counter_class'][$counter_coutner]) && $_POST['counter_class'][$counter_coutner] != ''){
														$shortcode_item .= 	'counter_class="'.htmlspecialchars($_POST['counter_class'][$counter_coutner], ENT_QUOTES).'" ';
													}
													if(isset($_POST['counter_animation'][$counter_coutner]) && $_POST['counter_animation'][$counter_coutner] != ''){
														$shortcode_item .= 	'counter_animation="'.htmlspecialchars($_POST['counter_animation'][$counter_coutner]).'" ';
													}
													$shortcode_item .= 	']';
													if(isset($_POST['counter_text'][$counter_coutner]) && $_POST['counter_text'][$counter_coutner] != ''){
														$shortcode_item .= 	htmlspecialchars($_POST['counter_text'][$counter_coutner], ENT_QUOTES);
													}
													$shortcode_item .= 	'[/cs_counter]'; 
													$counter->addChild('cs_shortcode', $shortcode_item );
												$counter_coutner++;
											  }
											  $cs_global_counter_counter++;
											}
											// Pricetable
											else if ( $_POST['cs_orderby'][$cs_counter] == "pricetable" ) {
												$shortcode = $price_item = $shortcode_item = '';
												$pricetable_item = $column->addChild('pricetable');
												$pricetable_item->addChild('page_element_size', htmlspecialchars($_POST['pricetable_element_size'][$cs_global_counter_pricetables]) );
												$pricetable_item->addChild('pricetable_element_size', htmlspecialchars($_POST['pricetable_element_size'][$cs_global_counter_pricetables]) );
												if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
													$shortcode_str = stripslashes ($_POST['shortcode']['pricetable'][$cs_shortcode_counter_pricetables]);
													$cs_shortcode_counter_pricetables++;
													$pricetable_item->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
												} else {
													if(isset($_POST['price_num'][$cs_counter_pricetables]) && $_POST['price_num'][$cs_counter_pricetables]>0){
														for ( $i = 1; $i <= $_POST['price_num'][$cs_counter_pricetables]; $i++ ){
															$price_item .= '[pricing_item ';
															if(isset($_POST['pricing_feature'][$cs_counter_pricetables_node]) && trim($_POST['pricing_feature'][$cs_counter_pricetables_node]) != ''){
																$price_item .= 	'pricing_feature="'.htmlspecialchars($_POST['pricing_feature'][$cs_counter_pricetables_node], ENT_QUOTES).'" ';
															}
															$price_item .= 	']';
															$price_item .= 	'[/pricing_item]'; 
															$cs_counter_pricetables_node++;
														}
													}
													$section_title = '';
													if(isset($_POST['cs_pricetable_section_title'][$cs_counter_pricetables]) && $_POST['cs_pricetable_section_title'][$cs_counter_pricetables] != ''){
														$section_title = ' cs_pricetable_section_title="'.htmlspecialchars($_POST['cs_pricetable_section_title'][$cs_counter_pricetables], ENT_QUOTES).'" ';
													}
													if(isset($_POST['pricetable_style'][$cs_counter_pricetables]) && $_POST['pricetable_style'][$cs_counter_pricetables] != ''){
														$shortcode_item .= 	'pricetable_style="'.htmlspecialchars($_POST['pricetable_style'][$cs_counter_pricetables], ENT_QUOTES).'" ';
													}
													if(isset($_POST['pricetable_title'][$cs_counter_pricetables]) && $_POST['pricetable_title'][$cs_counter_pricetables] != ''){
														$shortcode_item .= 	'pricetable_title="'.htmlspecialchars($_POST['pricetable_title'][$cs_counter_pricetables], ENT_QUOTES).'" ';
													}
													if(isset($_POST['pricetable_title_bgcolor'][$cs_counter_pricetables]) && $_POST['pricetable_title_bgcolor'][$cs_counter_pricetables] != ''){
														$shortcode_item .= 	'pricetable_title_bgcolor="'.htmlspecialchars($_POST['pricetable_title_bgcolor'][$cs_counter_pricetables], ENT_QUOTES).'" ';
													}
													if(isset($_POST['pricetable_price'][$cs_counter_pricetables]) && $_POST['pricetable_price'][$cs_counter_pricetables] != ''){
														$shortcode_item .= 	'pricetable_price="'.htmlspecialchars($_POST['pricetable_price'][$cs_counter_pricetables], ENT_QUOTES).'" ';
													}
													if(isset($_POST['pricetable_img'][$cs_counter_pricetables]) && $_POST['pricetable_img'][$cs_counter_pricetables] != ''){
														$shortcode_item .= 	'pricetable_img="'.htmlspecialchars($_POST['pricetable_img'][$cs_counter_pricetables], ENT_QUOTES).'" ';
													}
													
													if(isset($_POST['pricetable_period'][$cs_counter_pricetables]) && $_POST['pricetable_period'][$cs_counter_pricetables] != ''){
														$shortcode_item .= 	'pricetable_period="'.htmlspecialchars($_POST['pricetable_period'][$cs_counter_pricetables], ENT_QUOTES).'" ';
													}
													if(isset($_POST['pricetable_bgcolor'][$cs_counter_pricetables]) && $_POST['pricetable_bgcolor'][$cs_counter_pricetables] != ''){
														$shortcode_item .= 	'pricetable_bgcolor="'.htmlspecialchars($_POST['pricetable_bgcolor'][$cs_counter_pricetables], ENT_QUOTES).'" ';
													}
													
													if(isset($_POST['btn_text'][$cs_counter_pricetables]) && $_POST['btn_text'][$cs_counter_pricetables] != ''){
														$shortcode_item .= 	'btn_text="'.htmlspecialchars($_POST['btn_text'][$cs_counter_pricetables], ENT_QUOTES).'" ';
													}
													if(isset($_POST['btn_bg_color'][$cs_counter_pricetables]) && $_POST['btn_bg_color'][$cs_counter_pricetables] != ''){
														$shortcode_item .= 	'btn_bg_color="'.htmlspecialchars($_POST['btn_bg_color'][$cs_counter_pricetables]).'" ';
													}
													if(isset($_POST['pricetable_featured'][$cs_counter_pricetables]) && $_POST['pricetable_featured'][$cs_counter_pricetables] != ''){
														$shortcode_item .= 	'pricetable_featured="'.htmlspecialchars($_POST['pricetable_featured'][$cs_counter_pricetables], ENT_QUOTES).'" ';
													}
													if(isset($_POST['pricetable_class'][$cs_counter_pricetables]) && $_POST['pricetable_class'][$cs_counter_pricetables] != ''){
														$shortcode_item .= 	'pricetable_class="'.htmlspecialchars($_POST['pricetable_class'][$cs_counter_pricetables], ENT_QUOTES).'" ';
													}
													if(isset($_POST['pricetable_animation'][$cs_counter_pricetables]) && $_POST['pricetable_animation'][$cs_counter_pricetables] != ''){
														$shortcode_item .= 	'pricetable_animation="'.htmlspecialchars($_POST['pricetable_animation'][$cs_counter_pricetables]).'" ';
													}
													$shortcode = '[cs_pricetable '.$section_title.' '.$shortcode_item.']';
													$shortcode .= 	$price_item . '[/cs_pricetable]';
													$pricetable_item->addChild('cs_shortcode', $shortcode );
													$cs_counter_pricetables++;
												}
											  $cs_global_counter_pricetables++;
											}
											// Price Table
											else if ( $_POST['cs_orderby'][$cs_counter] == "piecharts" ) {
												$shortcode = '';
												$piecharts = $column->addChild('piecharts');
												$piecharts->addChild('page_element_size', $_POST['piecharts_element_size'][$cs_global_counter_piecharts] );
												$piecharts->addChild('piecharts_element_size', $_POST['piecharts_element_size'][$cs_global_counter_piecharts] );
												
												if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
													$shortcode_str = stripslashes ($_POST['shortcode']['piecharts'][$cs_shortcode_counter_piecharts]);
													$cs_shortcode_counter_piecharts++;
													$piecharts->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
												} else {
												
													$shortcode .= '[cs_piechart ';
													if(isset($_POST['piechart_section_title'][$cs_counter_piecharts]) && trim($_POST['piechart_section_title'][$cs_counter_piecharts]) <> ''){
														$shortcode .= 	'piechart_section_title="'.htmlspecialchars($_POST['piechart_section_title'][$cs_counter_piecharts], ENT_QUOTES).'" ';
													}
													if(isset($_POST['piechart_info'][$cs_counter_piecharts]) && trim($_POST['piechart_info'][$cs_counter_piecharts]) <> ''){
														$shortcode .= 	'piechart_info="'.htmlspecialchars($_POST['piechart_info'][$cs_counter_piecharts], ENT_QUOTES).'" ';
													}
													
													if(isset($_POST['piechart_percent'][$cs_counter_piecharts]) && $_POST['piechart_percent'][$cs_counter_piecharts] != ''){
														$shortcode .= 	'piechart_percent="'.htmlspecialchars($_POST['piechart_percent'][$cs_counter_piecharts], ENT_QUOTES).'" ';
													}
													if(isset($_POST['piechart_icon_color'][$cs_counter_piecharts]) && $_POST['piechart_icon_color'][$cs_counter_piecharts] != ''){
														$shortcode .= 	'piechart_icon_color="'.htmlspecialchars($_POST['piechart_icon_color'][$cs_counter_piecharts], ENT_QUOTES).'" ';
													}
													if(isset($_POST['piechart_fgcolor'][$cs_counter_piecharts]) && trim($_POST['piechart_fgcolor'][$cs_counter_piecharts]) <> ''){
														$shortcode .= 	'piechart_fgcolor="'.htmlspecialchars($_POST['piechart_fgcolor'][$cs_counter_piecharts], ENT_QUOTES).'" ';
													}
													if(isset($_POST['piechart_bg_image'][$cs_counter_piecharts]) && $_POST['piechart_bg_image'][$cs_counter_piecharts] != ''){
														$shortcode .= 	'piechart_bg_image="'.htmlspecialchars($_POST['piechart_bg_image'][$cs_counter_piecharts], ENT_QUOTES).'" ';
													}
													if(isset($_POST['piechart_icon'][$cs_counter_piecharts]) && $_POST['piechart_icon'][$cs_counter_piecharts] != ''){
														$shortcode .= 	'piechart_icon="'.htmlspecialchars($_POST['piechart_icon'][$cs_counter_piecharts], ENT_QUOTES).'" ';
													}
													if(isset($_POST['piechart_bg_color'][$cs_counter_piecharts]) && trim($_POST['piechart_bg_color'][$cs_counter_piecharts]) <> ''){
														$shortcode .= 	'piechart_bg_color="'.htmlspecialchars($_POST['piechart_bg_color'][$cs_counter_piecharts], ENT_QUOTES).'" ';
													}
													if(isset($_POST['piechart_class'][$cs_counter]) && $_POST['piechart_class'][$cs_counter] != ''){
														$shortcode .= 	'piechart_class="'.htmlspecialchars($_POST['piechart_class'][$cs_counter], ENT_QUOTES).'" ';
													}
													if(isset($_POST['piechart_animation'][$cs_counter]) && $_POST['piechart_animation'][$cs_counter] != ''){
														$shortcode .= 	'piechart_animation="'.htmlspecialchars($_POST['piechart_animation'][$cs_counter]).'" ';
													}
													$shortcode .= 	']';
													$piecharts->addChild('cs_shortcode', $shortcode );
													$cs_counter_piecharts++;
												}
												$cs_global_counter_piecharts++;
											} 
											// Progressbar
											else if ( $_POST['cs_orderby'][$cs_counter] == "progressbars" ) {
												$shortcode = $shortcode_item = '';
												$progressbars = $column->addChild('progressbars');
												$progressbars->addChild('progressbars_element_size', $_POST['progressbars_element_size'][$cs_global_counter_progressbars] );
												$progressbars->addChild('page_element_size', $_POST['progressbars_element_size'][$cs_global_counter_progressbars] );
												
												if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
													$shortcode_str = stripslashes ($_POST['shortcode']['progressbars'][$cs_shortcode_counter_progressbars]);
													$cs_shortcode_counter_progressbars++;
													$progressbars->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
												} else {
													if(isset($_POST['progressbars_num'][$cs_counter_progressbars]) && $_POST['progressbars_num'][$cs_counter_progressbars]>0){
														for ( $i = 1; $i <= $_POST['progressbars_num'][$cs_counter_progressbars]; $i++ ){
															$shortcode_item .= '[progressbar_item ';
															if(isset($_POST['progressbars_title'][$cs_counter_progressbars_node]) && $_POST['progressbars_title'][$cs_counter_progressbars_node] != ''){
																$shortcode_item .= 	'progressbars_title="'.htmlspecialchars($_POST['progressbars_title'][$cs_counter_progressbars_node], ENT_QUOTES).'" ';
															}
															if(isset($_POST['progressbars_percentage'][$cs_counter_progressbars_node]) && $_POST['progressbars_percentage'][$cs_counter_progressbars_node] != ''){
																$shortcode_item .= 	'progressbars_percentage="'.htmlspecialchars($_POST['progressbars_percentage'][$cs_counter_progressbars_node], ENT_QUOTES).'" ';
															}
															if(isset($_POST['progressbars_color'][$cs_counter_progressbars_node]) && $_POST['progressbars_color'][$cs_counter_progressbars_node] != ''){
																$shortcode_item .= 	'progressbars_color="'.htmlspecialchars($_POST['progressbars_color'][$cs_counter_progressbars_node], ENT_QUOTES).'" ';
															}
															$shortcode_item .= 	']'; 
															 
															$cs_counter_progressbars_node++;
														}
													}
													$shortcode .= '[cs_progressbars ';
													
													if(isset($_POST['cs_progressbars_style'][$cs_counter_progressbars]) && trim($_POST['cs_progressbars_style'][$cs_counter_progressbars]) <> ''){
														$shortcode .= 	'cs_progressbars_style="'.htmlspecialchars($_POST['cs_progressbars_style'][$cs_counter_progressbars]).'" ';
													}
													if(isset($_POST['progressbars_class'][$cs_counter_progressbars]) && $_POST['progressbars_class'][$cs_counter_progressbars] != ''){
														$shortcode .= 	'progressbars_class="'.htmlspecialchars($_POST['progressbars_class'][$cs_counter_progressbars], ENT_QUOTES).'" ';
													}
													if(isset($_POST['progressbars_animation'][$cs_counter_progressbars]) && $_POST['progressbars_animation'][$cs_counter_progressbars] != ''){
														$shortcode .= 	'progressbars_animation="'.htmlspecialchars($_POST['progressbars_animation'][$cs_counter_progressbars]).'" ';
													}
													
													$shortcode .= 	']'.$shortcode_item.'[/cs_progressbars]';
													
													$progressbars->addChild('cs_shortcode', $shortcode );
												
												$cs_counter_progressbars++;
											}
											$cs_global_counter_progressbars++;
										}
											// Table
											else if ( $_POST['cs_orderby'][$cs_counter] == "table" ) {
												$shortcode = '';
												$table 	   = $column->addChild('table');
												$table->addChild('table_element_size', $_POST['table_element_size'][$cs_global_counter_table] );
												$table->addChild('page_element_size', $_POST['table_element_size'][$cs_global_counter_table] );
												if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
 													$shortcode_str = stripslashes ($_POST['shortcode']['table'][$cs_shortcode_counter_table]);
													$cs_shortcode_counter_table++;
													$table->addChild('cs_shortcode', htmlspecialchars($shortcode_str) );
												} else {
													$shortcode .= '[cs_table ';
													if(isset($_POST['cs_table_section_title'][$cs_counter_table]) && $_POST['cs_table_section_title'][$cs_counter_table] != ''){
														$shortcode .= ' cs_table_section_title="'.htmlspecialchars($_POST['cs_table_section_title'][$cs_counter_table], ENT_QUOTES).'" ';
													}
													if(isset($_POST['table_style'][$cs_counter_table]) && trim($_POST['table_style'][$cs_counter_table]) <> ''){
														$shortcode .= 	'table_style="'.htmlspecialchars($_POST['table_style'][$cs_counter_table], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_table_class'][$cs_counter_table]) && $_POST['cs_table_class'][$cs_counter_table] != ''){
														$shortcode .= 	'cs_table_class="'.htmlspecialchars($_POST['cs_table_class'][$cs_counter_table], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_table_animation'][$cs_counter_table]) && $_POST['cs_table_animation'][$cs_counter_table] != ''){
														$shortcode .= 	'cs_table_animation="'.htmlspecialchars($_POST['cs_table_animation'][$cs_counter_table]).'" ';
													}
													$shortcode .= ']';
													if(isset($_POST['cs_table_content'][$cs_counter_table]) && $_POST['cs_table_content'][$cs_counter_table] != ''){
														$shortcode .= htmlspecialchars($_POST['cs_table_content'][$cs_counter_table], ENT_QUOTES);
													}
													$shortcode .= 	'[/cs_table]';
													$table->addChild('cs_shortcode', $shortcode );															
													$cs_counter_table++;
												}
												$cs_global_counter_table++;
											}
											// Button
											else if ( $_POST['cs_orderby'][$cs_counter] == "button" ) {
												$shortcode  = '';
												$button = $column->addChild('button');
												$button->addChild('page_element_size', htmlspecialchars($_POST['button_element_size'][$cs_global_counter_button]) );
												$button->addChild('button_element_size', htmlspecialchars($_POST['button_element_size'][$cs_global_counter_button]) );
												if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
													$shortcode_str = stripslashes ($_POST['shortcode']['button'][$cs_shortcode_counter_button]);
													$button->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
													$cs_shortcode_counter_button++;
												} else {
													$shortcode .= '[cs_button  ';
													if(isset($_POST['button_size'][$cs_counter_button]) && trim($_POST['button_size'][$cs_counter_button]) <> ''){
														$shortcode .= 	'button_size="'.htmlspecialchars($_POST['button_size'][$cs_counter_button]).'" ';
													}
													if(isset($_POST['button_title'][$cs_counter_button]) && trim($_POST['button_title'][$cs_counter_button]) <> ''){
														$shortcode .= 	'button_title="'.htmlspecialchars($_POST['button_title'][$cs_counter_button], ENT_QUOTES).'" ';
													}
													if(isset($_POST['button_link'][$cs_counter_button]) && trim($_POST['button_link'][$cs_counter_button]) <> ''){
														$shortcode .= 	'button_link="'.htmlspecialchars($_POST['button_link'][$cs_counter_button], ENT_QUOTES).'" ';
													}
													if(isset($_POST['button_bg_color'][$cs_counter_button]) && trim($_POST['button_bg_color'][$cs_counter_button]) <> ''){
														$shortcode .= 	'button_bg_color="'.htmlspecialchars($_POST['button_bg_color'][$cs_counter_button], ENT_QUOTES).'" ';
													}
													if(isset($_POST['button_color'][$cs_counter_button]) && trim($_POST['button_color'][$cs_counter_button]) <> ''){
														$shortcode .= 	'button_color="'.htmlspecialchars($_POST['button_color'][$cs_counter_button], ENT_QUOTES).'" ';
													}
													if(isset($_POST['border_button_color'][$cs_counter_button]) && trim($_POST['border_button_color'][$cs_counter_button]) <> ''){
														$shortcode .= 	'border_button_color="'.htmlspecialchars($_POST['border_button_color'][$cs_counter_button]).'" ';
													}
													if(isset($_POST['button_icon'][$cs_counter_button]) && trim($_POST['button_icon'][$cs_counter_button]) <> ''){
														$shortcode .= 	'button_icon="'.htmlspecialchars($_POST['button_icon'][$cs_counter_button], ENT_QUOTES).'" ';
													}
													if(isset($_POST['button_icon_position'][$cs_counter_button]) && trim($_POST['button_icon_position'][$cs_counter_button]) <> ''){
														$shortcode .= 	'button_icon_position="'.htmlspecialchars($_POST['button_icon_position'][$cs_counter_button]).'" ';
													}
													if(isset($_POST['button_type'][$cs_counter_button]) && trim($_POST['button_type'][$cs_counter_button]) <> ''){
														$shortcode .= 	'button_type="'.htmlspecialchars($_POST['button_type'][$cs_counter_button]).'" ';
													}
													if(isset($_POST['button_target'][$cs_counter_button]) && trim($_POST['button_target'][$cs_counter_button]) <> ''){
														$shortcode .= 	'button_target="'.htmlspecialchars($_POST['button_target'][$cs_counter_button]).'" ';
													}
													if(isset($_POST['cs_button_class'][$cs_counter_button]) && $_POST['cs_button_class'][$cs_counter_button] != ''){
														$shortcode .= 	'cs_button_class="'.htmlspecialchars($_POST['cs_button_class'][$cs_counter_button], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_button_animation'][$cs_counter_button]) && $_POST['cs_button_animation'][$cs_counter_button] != ''){
														$shortcode .= 	'cs_button_animation="'.htmlspecialchars($_POST['cs_button_animation'][$cs_counter_button]).'" ';
													}
													$shortcode .= 	']';
													$button->addChild('cs_shortcode', $shortcode );
													$cs_counter_button++;
												}
												$cs_global_counter_button++;
											}
											// Call to action
											else if ( $_POST['cs_orderby'][$cs_counter] == "call_to_action" ) {
												$shortcode 		= '';
												$call_to_action = $column->addChild('call_to_action');
												$call_to_action->addChild('page_element_size', htmlspecialchars($_POST['call_to_action_element_size'][$cs_global_counter_call_to_action]) );
												$call_to_action->addChild('call_to_action_element_size', htmlspecialchars($_POST['call_to_action_element_size'][$cs_global_counter_call_to_action]) );
												if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
													$shortcode_str = htmlspecialchars( stripslashes ($_POST['shortcode']['call_to_action'][$cs_shortcode_counter_call_to_action]));
													$cs_shortcode_counter_call_to_action++;
													$call_to_action->addChild('cs_shortcode', htmlspecialchars($shortcode_str) );
												} else {
													$shortcode .= '[call_to_action ';
													if(isset($_POST['cs_call_to_action_section_title'][$cs_counter_call_to_action]) && $_POST['cs_call_to_action_section_title'][$cs_counter_call_to_action] != ''){
														$shortcode .= ' cs_call_to_action_section_title="'.htmlspecialchars($_POST['cs_call_to_action_section_title'][$cs_counter_call_to_action], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_content_type'][$cs_counter_call_to_action]) && trim($_POST['cs_content_type'][$cs_counter_call_to_action]) <> ''){
														$shortcode .= 	'cs_content_type="'.htmlspecialchars($_POST['cs_content_type'][$cs_counter_call_to_action]).'" ';
													}
													if(isset($_POST['cs_call_action_title'][$cs_counter_call_to_action]) && trim($_POST['cs_call_action_title'][$cs_counter_call_to_action]) <> ''){
														$shortcode .= 	'cs_call_action_title="'.htmlspecialchars($_POST['cs_call_action_title'][$cs_counter_call_to_action], ENT_QUOTES).'" ';
													}
													
													if(isset($_POST['cs_contents_color'][$cs_counter_call_to_action]) && trim($_POST['cs_contents_color'][$cs_counter_call_to_action]) <> ''){
														$shortcode .= 	'cs_contents_color="'.htmlspecialchars($_POST['cs_contents_color'][$cs_counter_call_to_action]).'" ';
													}
													
													if(isset($_POST['cs_title_color'][$cs_counter_call_to_action]) && trim($_POST['cs_title_color'][$cs_counter_call_to_action]) <> ''){
														$shortcode .= 	'cs_title_color="'.htmlspecialchars($_POST['cs_title_color'][$cs_counter_call_to_action]).'" ';
													}
													if(isset($_POST['cs_contents_color'][$cs_counter_call_to_action]) && trim($_POST['cs_contents_color'][$cs_counter_call_to_action]) <> ''){
														$shortcode .= 	'cs_contents_color="'.htmlspecialchars($_POST['cs_contents_color'][$cs_counter_call_to_action]).'" ';
													}
													if(isset($_POST['cs_call_action_icon'][$cs_counter_call_to_action]) && trim($_POST['cs_call_action_icon'][$cs_counter_call_to_action]) <> ''){
														$shortcode .= 	'cs_call_action_icon="'.htmlspecialchars($_POST['cs_call_action_icon'][$cs_counter_call_to_action]).'" ';
													}
													if(isset($_POST['cs_icon_color'][$cs_counter_call_to_action]) && trim($_POST['cs_icon_color'][$cs_counter_call_to_action]) <> ''){
														$shortcode .= 	'cs_icon_color="'.htmlspecialchars($_POST['cs_icon_color'][$cs_counter_call_to_action]).'" ';
													}
													if(isset($_POST['cs_call_to_action_icon_background_color'][$cs_counter_call_to_action]) && trim($_POST['cs_call_to_action_icon_background_color'][$cs_counter_call_to_action]) <> ''){
														$shortcode .= 	'cs_call_to_action_icon_background_color="'.htmlspecialchars($_POST['cs_call_to_action_icon_background_color'][$cs_counter_call_to_action]).'" ';
													}
													if(isset($_POST['cs_show_button'][$cs_counter_call_to_action]) && trim($_POST['cs_show_button'][$cs_counter_call_to_action]) <> ''){
														$shortcode .= 	'cs_show_button="'.htmlspecialchars($_POST['cs_show_button'][$cs_counter_call_to_action]).'" ';
													}
													if(isset($_POST['cs_call_to_action_button_text'][$cs_counter_call_to_action]) && trim($_POST['cs_call_to_action_button_text'][$cs_counter_call_to_action]) <> ''){
														$shortcode .= 	'cs_call_to_action_button_text="'.htmlspecialchars($_POST['cs_call_to_action_button_text'][$cs_counter_call_to_action], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_call_to_action_button_link'][$cs_counter_call_to_action]) && trim($_POST['cs_call_to_action_button_link'][$cs_counter_call_to_action]) <> ''){
														$shortcode .= 	'cs_call_to_action_button_link="'.htmlspecialchars($_POST['cs_call_to_action_button_link'][$cs_counter_call_to_action]).'" ';
													}
													
													if(isset($_POST['cs_call_to_action_bg_img'][$cs_counter_call_to_action]) && trim($_POST['cs_call_to_action_bg_img'][$cs_counter_call_to_action]) <> ''){
														$shortcode .= 	'cs_call_to_action_bg_img="'.htmlspecialchars($_POST['cs_call_to_action_bg_img'][$cs_counter_call_to_action]).'" ';
													}
													if(isset($_POST['cs_call_to_action_class'][$cs_counter_call_to_action]) && $_POST['cs_call_to_action_class'][$cs_counter_call_to_action] != ''){
														$shortcode .= 	'cs_call_to_action_class="'.htmlspecialchars($_POST['cs_call_to_action_class'][$cs_counter_call_to_action], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_call_to_action_animation'][$cs_counter_call_to_action]) && $_POST['cs_call_to_action_animation'][$cs_counter_call_to_action] != ''){
														$shortcode .= 	'cs_call_to_action_animation="'.htmlspecialchars($_POST['cs_call_to_action_animation'][$cs_counter_call_to_action]).'" ';
													}
													$shortcode .= 	']';
													if(isset($_POST['cs_call_action_contents'][$cs_counter_call_to_action]) && $_POST['cs_call_action_contents'][$cs_counter_call_to_action] != ''){
														$shortcode .= 	htmlspecialchars($_POST['cs_call_action_contents'][$cs_counter_call_to_action], ENT_QUOTES);
													}
													$shortcode .= 	'[/call_to_action]';
													
													$call_to_action->addChild('cs_shortcode', $shortcode );
													$cs_counter_call_to_action++;
												}
												$cs_global_counter_call_to_action++;
												
												
											}
										
										// Common Elements end
										
							// Media Elements Shortcode
										else if ( $_POST['cs_orderby'][$cs_counter] == "slider" ) {
												$shortcode  = '';
												$slider 	= $column->addChild('slider');
												$slider->addChild('page_element_size', $_POST['slider_element_size'][$cs_global_counter_slider] );
												$slider->addChild('slider_element_size', $_POST['slider_element_size'][$cs_global_counter_slider] );

												if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
													$shortcode_str = stripslashes ($_POST['shortcode']['slider'][$cs_shortcode_counter_slider]);
													$cs_shortcode_counter_slider++;
													$slider->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
												} else {
													$shortcode .= '[cs_slider ';
													if(isset($_POST['cs_slider_header_title'][$cs_counter_slider]) && trim($_POST['cs_slider_header_title'][$cs_counter_slider]) <> ''){
														$shortcode .= 	'cs_slider_header_title="'.htmlspecialchars($_POST['cs_slider_header_title'][$cs_counter_slider], ENT_QUOTES).'" ';
													}
 													if(isset($_POST['cs_slider'][$cs_counter_slider]) && trim($_POST['cs_slider'][$cs_counter_slider]) <> ''){
														$shortcode .= 	'cs_slider="'.htmlspecialchars($_POST['cs_slider'][$cs_counter_slider]).'" ';
													}
													if(isset($_POST['cs_slider_id'][$cs_counter_slider]) && trim($_POST['cs_slider_id'][$cs_counter_slider]) <> ''){
														$shortcode .= 	'cs_slider_id="'.htmlspecialchars($_POST['cs_slider_id'][$cs_counter_slider]).'" ';
													}
													 
													$shortcode .= 	']';
													$slider->addChild('cs_shortcode', $shortcode );
													$cs_counter_slider++;
												}
												$cs_global_counter_slider++;
											} 
										else if ( $_POST['cs_orderby'][$cs_counter] == "promobox" ) {
												$shortcode  = '';
												$promobox = $column->addChild('promobox');
 												$promobox->addChild('page_element_size', htmlspecialchars($_POST['promobox_element_size'][$cs_global_counter_promobox]) );
												if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
													$shortcode_str = stripslashes ($_POST['shortcode']['promobox'][$cs_shortcode_counter_promobox]);
													$cs_shortcode_counter_promobox++;
													$promobox->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
												} else {
													$shortcode .= '[cs_promobox ';
													if(isset($_POST['cs_promobox_section_title'][$cs_counter_promobox]) && trim($_POST['cs_promobox_section_title'][$cs_counter_promobox]) <> ''){
														$shortcode .= 	'cs_promobox_section_title="'.htmlspecialchars($_POST['cs_promobox_section_title'][$cs_counter_promobox], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_promo_image_url'][$cs_counter_promobox]) && trim($_POST['cs_promo_image_url'][$cs_counter_promobox]) <> ''){
														$shortcode .= 	'cs_promo_image_url="'.htmlspecialchars($_POST['cs_promo_image_url'][$cs_counter_promobox], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_promobox_title'][$cs_counter_promobox]) && trim($_POST['cs_promobox_title'][$cs_counter_promobox]) <> ''){
														$shortcode .= 	'cs_promobox_title="'.htmlspecialchars($_POST['cs_promobox_title'][$cs_counter_promobox], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_promobox_contents'][$cs_counter_promobox]) && trim($_POST['cs_promobox_contents'][$cs_counter_promobox]) <> ''){
														$shortcode .= 	'cs_promobox_contents="'.htmlspecialchars($_POST['cs_promobox_contents'][$cs_counter_promobox], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_link'][$cs_counter_promobox]) && trim($_POST['cs_link'][$cs_counter_promobox]) <> ''){
														$shortcode .= 	'cs_link="'.htmlspecialchars($_POST['cs_link'][$cs_counter_promobox], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_promobox_title_color'][$cs_counter_promobox]) && trim($_POST['cs_promobox_title_color'][$cs_counter_promobox]) <> ''){
														$shortcode .= 	'cs_promobox_title_color="'.htmlspecialchars($_POST['cs_promobox_title_color'][$cs_counter_promobox], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_promobox_content_color'][$cs_counter_promobox]) && trim($_POST['cs_promobox_content_color'][$cs_counter_promobox]) <> ''){
														$shortcode .= 	'cs_promobox_content_color="'.htmlspecialchars($_POST['cs_promobox_content_color'][$cs_counter_promobox], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_promobox_btn_bg_color'][$cs_counter_promobox]) && trim($_POST['cs_promobox_btn_bg_color'][$cs_counter_promobox]) <> ''){
														$shortcode .= 	'cs_promobox_btn_bg_color="'.htmlspecialchars($_POST['cs_promobox_btn_bg_color'][$cs_counter_promobox], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_link_title'][$cs_counter_promobox]) && trim($_POST['cs_link_title'][$cs_counter_promobox]) <> ''){
														$shortcode .= 	'cs_link_title="'.htmlspecialchars($_POST['cs_link_title'][$cs_counter_promobox], ENT_QUOTES).'" ';
													}
													if(isset($_POST['bg_repeat'][$cs_counter_promobox]) && trim($_POST['bg_repeat'][$cs_counter_promobox]) <> ''){
														$shortcode .= 	'bg_repeat="'.htmlspecialchars($_POST['bg_repeat'][$cs_counter_promobox], ENT_QUOTES).'" ';
													}
													if(isset($_POST['text_align'][$cs_counter_promobox]) && trim($_POST['text_align'][$cs_counter_promobox]) <> ''){
														$shortcode .= 	'text_align="'.htmlspecialchars($_POST['text_align'][$cs_counter_promobox], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_promobox_class'][$cs_counter_promobox]) && $_POST['cs_promobox_class'][$cs_counter_promobox] != ''){
														$shortcode .= 	'cs_promobox_class="'.htmlspecialchars($_POST['cs_promobox_class'][$cs_counter_promobox], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_promobox_animation'][$cs_counter_promobox]) && $_POST['cs_promobox_animation'][$cs_counter_promobox] != ''){
														$shortcode .= 	'cs_promobox_animation="'.htmlspecialchars($_POST['cs_promobox_animation'][$cs_counter_promobox]).'" ';
													}
													$shortcode .= 	']';
													if(isset($_POST['cs_promobox_contents'][$cs_counter_promobox]) && $_POST['cs_promobox_contents'][$cs_counter_promobox] != ''){
														$shortcode .= 	htmlspecialchars($_POST['cs_promobox_contents'][$cs_counter_promobox], ENT_QUOTES);
													}
													$shortcode .= 	'[/cs_promobox]';				 
													$promobox->addChild('cs_shortcode', $shortcode );
													$cs_counter_promobox++;
												}
											$cs_global_counter_promobox++;
										}
										else if ( $_POST['cs_orderby'][$cs_counter] == "team" ) {
													$shortcode = '';
													$team = $column->addChild('team');
													$team->addChild('page_element_size', htmlspecialchars($_POST['team_element_size'][$cs_counter_team]) );
													$team->addChild('team_element_size', htmlspecialchars($_POST['team_element_size'][$cs_counter_team]) );
													$team->addChild('cs_size', htmlspecialchars($_POST['cs_size'][$cs_counter_team]) );
													$team->addChild('cs_image_position', $_POST['cs_image_position'][$cs_counter_team] );
													$team->addChild('cs_text_align', $_POST['cs_text_align'][$cs_counter_team] );
													$team->addChild('cs_attached_media', $_POST['cs_attached_media'][$cs_counter_team] );
													$team->addChild('cs_team_website', $_POST['cs_team_website'][$cs_counter_team] );
													$team->addChild('cs_team_title', $_POST['cs_team_title'][$cs_counter_team] );
													$team->addChild('cs_team_designation', $_POST['cs_team_designation'][$cs_counter_team] );
													$team->addChild('cs_team_about', $_POST['cs_team_about'][$cs_counter_team] );
													$team->addChild('cs_team_fb', htmlspecialchars($_POST['cs_team_fb'][$cs_counter_team]) );
													$team->addChild('cs_team_tw', $_POST['cs_team_tw'][$cs_counter_team] );
													$team->addChild('cs_team_gm', $_POST['cs_team_gm'][$cs_counter_team] );
													$team->addChild('cs_team_yt', $_POST['cs_team_yt'][$cs_counter_team] );
													$team->addChild('cs_team_sky', $_POST['cs_team_sky'][$cs_counter_team] );
													$team->addChild('cs_team_fs', $_POST['cs_team_fs'][$cs_counter_team] );
													$team->addChild('cs_button_target', $_POST['cs_button_target'][$cs_counter_team] );
													$team->addChild('cs_team_class', htmlspecialchars($_POST['cs_team_class'][$cs_counter_team]) );
													$team->addChild('cs_team_animation', htmlspecialchars($_POST['cs_team_animation'][$cs_counter_team]) );
												$shortcode .= '[cs_team ';
												if(isset($_POST['cs_size'][$cs_counter_team]) && trim($_POST['cs_size'][$cs_counter_team]) <> ''){
													$shortcode .= 	'cs_size="'.htmlspecialchars($_POST['cs_size'][$cs_counter_team]).'" ';
												}
												if(isset($_POST['cs_image_position'][$cs_counter_team]) && trim($_POST['cs_image_position'][$cs_counter_team]) <> ''){
													$shortcode .= 	'cs_image_position="'.htmlspecialchars($_POST['cs_image_position'][$cs_counter_team]).'" ';
												}
												if(isset($_POST['cs_text_align'][$cs_counter_team]) && trim($_POST['cs_text_align'][$cs_counter_team]) <> ''){
													$shortcode .= 	'cs_text_align="'.htmlspecialchars($_POST['cs_text_align'][$cs_counter_team]).'" ';
												}
												if(isset($_POST['cs_attached_media'][$cs_counter_team]) && trim($_POST['cs_attached_media'][$cs_counter_team]) <> ''){
													$shortcode .= 	'cs_attached_media="'.htmlspecialchars($_POST['cs_attached_media'][$cs_counter_team]).'" ';
												}
												if(isset($_POST['cs_team_website'][$cs_counter_team]) && trim($_POST['cs_team_website'][$cs_counter_team]) <> ''){
													$shortcode .= 	'cs_team_website="'.htmlspecialchars($_POST['cs_team_website'][$cs_counter_team]).'" ';
												}
												
												if(isset($_POST['cs_team_title'][$cs_counter_team]) && trim($_POST['cs_team_title'][$cs_counter_team]) <> ''){
													$shortcode .= 	'cs_team_title="'.htmlspecialchars($_POST['cs_team_title'][$cs_counter_team]).'" ';
												}
												if(isset($_POST['cs_team_designation'][$cs_counter_team]) && trim($_POST['cs_team_designation'][$cs_counter_team]) <> ''){
													$shortcode .= 	'cs_team_designation="'.htmlspecialchars($_POST['cs_team_designation'][$cs_counter_team]).'" ';
												}
												if(isset($_POST['cs_team_about'][$cs_counter_team]) && trim($_POST['cs_team_about'][$cs_counter_team]) <> ''){
													$shortcode .= 	'cs_team_about="'.htmlspecialchars($_POST['cs_team_about'][$cs_counter_team]).'" ';
												}
												if(isset($_POST['cs_team_fb'][$cs_counter_team]) && trim($_POST['cs_team_fb'][$cs_counter_team]) <> ''){
													$shortcode .= 	'cs_team_fb="'.htmlspecialchars($_POST['cs_team_fb'][$cs_counter_team]).'" ';
												}
												if(isset($_POST['cs_team_tw'][$cs_counter_team]) && trim($_POST['cs_team_tw'][$cs_counter_team]) <> ''){
													$shortcode .= 	'cs_team_tw="'.htmlspecialchars($_POST['cs_team_tw'][$cs_counter_team]).'" ';
												}
												if(isset($_POST['cs_team_gm'][$cs_counter_team]) && trim($_POST['cs_team_gm'][$cs_counter_team]) <> ''){
													$shortcode .= 	'cs_team_gm="'.htmlspecialchars($_POST['cs_team_gm'][$cs_counter_team]).'" ';
												}
												if(isset($_POST['cs_team_yt'][$cs_counter_team]) && trim($_POST['cs_team_yt'][$cs_counter_team]) <> ''){
													$shortcode .= 	'cs_team_yt="'.htmlspecialchars($_POST['cs_team_yt'][$cs_counter_team]).'" ';
												}
												if(isset($_POST['cs_team_sky'][$cs_counter_team]) && trim($_POST['cs_team_sky'][$cs_counter_team]) <> ''){
													$shortcode .= 	'cs_team_sky="'.htmlspecialchars($_POST['cs_team_sky'][$cs_counter_team]).'" ';
												}
												if(isset($_POST['cs_team_fs'][$cs_counter_team]) && trim($_POST['cs_team_fs'][$cs_counter_team]) <> ''){
													$shortcode .= 	'cs_team_fs="'.htmlspecialchars($_POST['cs_team_fs'][$cs_counter_team]).'" ';
												}
												if(isset($_POST['cs_button_target'][$cs_counter_team]) && trim($_POST['cs_button_target'][$cs_counter_team]) <> ''){
													$shortcode .= 	'cs_button_target="'.htmlspecialchars($_POST['cs_button_target'][$cs_counter_team]).'" ';
												}
												
												if(isset($_POST['cs_team_class'][$cs_counter_team]) && $_POST['cs_team_class'][$cs_counter_team] != ''){
													$shortcode .= 	'cs_team_class="'.htmlspecialchars($_POST['cs_team_class'][$cs_counter_team]).'" ';
												}
												if(isset($_POST['cs_team_animation'][$cs_counter_team]) && $_POST['cs_team_animation'][$cs_counter_team] != ''){
													$shortcode .= 	'cs_cs_team_animation="'.htmlspecialchars($_POST['cs_team_animation'][$cs_counter_team]).'" ';
												}
												$shortcode .= 	']';
													$team->addChild('cs_shortcode', $shortcode );
													$cs_counter_team++;
											}
											else if ( $_POST['cs_orderby'][$cs_counter] == "offerslider" ) {
												$shortcode = $shortcode_item = '';
  												$offerslider = $column->addChild('offerslider');
												$offerslider->addChild('page_element_size', htmlspecialchars($_POST['offerslider_element_size'][$cs_global_counter_offerslider]) );
												$offerslider->addChild('offerslider_element_size', htmlspecialchars($_POST['offerslider_element_size'][$cs_global_counter_offerslider]) );
												if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
													$shortcode_str = stripslashes ($_POST['shortcode']['offerslider'][$cs_shortcode_counter_offerslider]);
													$cs_shortcode_counter_offerslider++;
													$offerslider->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
												} else {
													
													if(isset($_POST['offerslider_num'][$cs_counter_offerslider]) && $_POST['offerslider_num'][$cs_counter_offerslider]>0){			
														for ( $i = 1; $i <= $_POST['offerslider_num'][$cs_counter_offerslider]; $i++ ){
															
															$shortcode_item .= '[offer_item ';
															
															if(isset($_POST['cs_slider_image'][$cs_counter_offerslider_node]) && trim($_POST['cs_slider_image'][$cs_counter_offerslider]) <> ''){
																$shortcode_item .= 	'cs_slider_image="'.htmlspecialchars($_POST['cs_slider_image'][$cs_counter_offerslider_node]).'" ';
															}
															if(isset($_POST['cs_slider_title'][$cs_counter_offerslider_node]) && trim($_POST['cs_slider_title'][$cs_counter_offerslider]) <> ''){
																$shortcode_item .= 	'cs_slider_title="'.htmlspecialchars($_POST['cs_slider_title'][$cs_counter_offerslider_node], ENT_QUOTES).'" ';
															}
															if(isset($_POST['cs_readmore_link'][$cs_counter_offerslider_node]) && trim($_POST['cs_readmore_link'][$cs_counter_offerslider]) <> ''){
																$shortcode_item .= 	'cs_readmore_link="'.htmlspecialchars($_POST['cs_readmore_link'][$cs_counter_offerslider_node], ENT_QUOTES).'" ';
															}
															if(isset($_POST['cs_offerslider_link_title'][$cs_counter_offerslider_node]) && trim($_POST['cs_offerslider_link_title'][$cs_counter_offerslider_node]) <> ''){
																$shortcode_item .= 	'cs_offerslider_link_title="'.htmlspecialchars($_POST['cs_offerslider_link_title'][$cs_counter_offerslider_node], ENT_QUOTES).'" ';
															}
															
															$shortcode_item .= 	']';
															if(isset($_POST['cs_slider_contents'][$cs_counter_offerslider]) && $_POST['cs_slider_contents'][$cs_counter_offerslider] != ''){
																$shortcode_item .= 	htmlspecialchars($_POST['cs_slider_contents'][$cs_counter_offerslider_node], ENT_QUOTES);
															}
															$shortcode_item .= 	'[/offer_item]'; 
															$cs_counter_offerslider_node++;
														}
													}
													
													$section_title = '';
													if(isset($_POST['cs_offerslider_section_title'][$cs_counter_offerslider]) && trim($_POST['cs_offerslider_section_title'][$cs_counter_offerslider]) <> ''){
														$section_title  = 	'cs_offerslider_section_title="'.htmlspecialchars($_POST['cs_offerslider_section_title'][$cs_counter_offerslider], ENT_QUOTES).'" ';
													}
													
													$shortcode = '[cs_offerslider cs_offerslider_class="'.htmlspecialchars($_POST['cs_offerslider_class'][$cs_counter_testimonials]).'"  cs_offerslider_animation="'.htmlspecialchars($_POST['cs_offerslider_animation'][$cs_counter_testimonials]).'"  '.$section_title.' ]'.$shortcode_item.'[/cs_offerslider]';
													$offerslider->addChild('cs_shortcode', $shortcode );
								
													$cs_counter_offerslider++;
												}
												$cs_global_counter_offerslider++;
										  }
										else if ( $_POST['cs_orderby'][$cs_counter] == "members" ) {
												$shortcode  = '';
												$members 	= $column->addChild('members');
												$members->addChild('page_element_size', htmlspecialchars($_POST['members_element_size'][$cs_global_counter_members]) );
												$members->addChild('members_element_size', htmlspecialchars($_POST['members_element_size'][$cs_global_counter_members]) );
												if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
													$shortcode_str = stripslashes ($_POST['shortcode']['members'][$cs_shortcode_counter_members]);
													$cs_shortcode_counter_members++;
													$output = array();
													$PREFIX = 'cs_members';
													$parseObject = new ShortcodeParse();
													$output = $parseObject->cs_shortcodes( $output, $shortcode_str , true , $PREFIX );
													$defaults = array('var_pb_members_title' => '','var_pb_members_profile_inks'=>'','var_pb_members_roles'=>'','var_pb_members_filterable'=>'','var_pb_members_pagination'=>'','var_pb_members_all_tab'=>'', 'var_pb_members_per_page'=>get_option("posts_per_page"),'var_pb_member_view'=>'','cs_members_class' => '','cs_members_animation' => '');
													if(isset($output['0']['atts']))
														$atts = $output['0']['atts'];
													else 
														$atts = array();
													foreach($defaults as $key=>$values){
														if(isset($atts[$key]))
															$$key = $atts[$key];
														else 
															$$key =$values;
													 }
													$members->addChild('var_pb_members_title', htmlspecialchars($var_pb_members_title, ENT_QUOTES) );
													$members->addChild('var_pb_member_view', htmlspecialchars($var_pb_member_view) );
													$members->addChild('var_pb_members_roles', htmlspecialchars($var_pb_members_roles));
													$members->addChild('var_pb_members_filterable', htmlspecialchars($var_pb_members_filterable) );
													$members->addChild('var_pb_members_all_tab', htmlspecialchars($var_pb_members_all_tab) );
													$members->addChild('var_pb_members_profile_inks', htmlspecialchars($var_pb_members_profile_inks) );
													$members->addChild('var_pb_members_pagination', htmlspecialchars($var_pb_members_pagination) );
													$members->addChild('var_pb_members_per_page', htmlspecialchars($var_pb_members_per_page, ENT_QUOTES) );
													$members->addChild('cs_members_class', htmlspecialchars($cs_members_class, ENT_QUOTES) );
													$members->addChild('cs_members_animation', htmlspecialchars($cs_members_animation) );
													$members->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
												} else {
													if (isset($_POST['cs_members_counter'][$cs_counter_members])){
														 $cs_members_counter = htmlspecialchars($_POST['cs_members_counter'][$cs_counter_members]);
												 	}
													$members->addChild('var_pb_members_title', htmlspecialchars($_POST['var_pb_members_title'][$cs_counter_members], ENT_QUOTES) );
													$members->addChild('var_pb_member_view', htmlspecialchars($_POST['var_pb_member_view'][$cs_counter_members]) );
													if (empty($_POST['var_pb_members_roles'][$cs_members_counter])){
														 $var_pb_members_roles = "";
												 	} else {
														$var_pb_members_roles = implode(",", $_POST['var_pb_members_roles'][$cs_members_counter]);
													}
													$members->addChild('var_pb_members_roles', htmlspecialchars($var_pb_members_roles));
													$members->addChild('var_pb_members_filterable', htmlspecialchars($_POST['var_pb_members_filterable'][$cs_counter_members] ));
													$members->addChild('var_pb_members_all_tab', htmlspecialchars($_POST['var_pb_members_all_tab'][$cs_counter_members]) );
													$members->addChild('var_pb_members_profile_inks', htmlspecialchars($_POST['var_pb_members_profile_inks'][$cs_counter_members]) );
													$members->addChild('var_pb_members_pagination', htmlspecialchars($_POST['var_pb_members_pagination'][$cs_counter_members]) );
													$members->addChild('var_pb_members_per_page', htmlspecialchars($_POST['var_pb_members_per_page'][$cs_counter_members] ));
													$members->addChild('cs_members_class', htmlspecialchars($_POST['cs_members_class'][$cs_counter_members], ENT_QUOTES) );
													$members->addChild('cs_members_animation', htmlspecialchars($_POST['cs_members_animation'][$cs_counter_members]) );
													$shortcode .= '[cs_members ';
													if(isset($_POST['var_pb_members_title'][$cs_counter_members]) && trim($_POST['var_pb_members_title'][$cs_counter_members]) <> ''){
														$shortcode .= 	'var_pb_members_title="'.htmlspecialchars($_POST['var_pb_members_title'][$cs_counter_members], ENT_QUOTES).'" ';
													}
													if(isset($_POST['var_pb_member_view'][$cs_counter_members]) && trim($_POST['var_pb_member_view'][$cs_counter_members]) <> ''){
														$shortcode .= 	'var_pb_member_view="'.htmlspecialchars($_POST['var_pb_member_view'][$cs_counter_members]).'" ';
													}
													if(isset($var_pb_members_roles) && trim($var_pb_members_roles) <> ''){
														$shortcode .= 	'var_pb_members_roles="'.htmlspecialchars($var_pb_members_roles).'" ';
													}
													if(isset($_POST['var_pb_members_filterable'][$cs_counter_members]) && trim($_POST['var_pb_members_filterable'][$cs_counter_members]) <> ''){
														$shortcode .= 	'var_pb_members_filterable="'.htmlspecialchars($_POST['var_pb_members_filterable'][$cs_counter_members]).'" ';
													}
													if(isset($_POST['var_pb_members_all_tab'][$cs_counter_members]) && trim($_POST['var_pb_members_all_tab'][$cs_counter_members]) <> ''){
														$shortcode .= 	'var_pb_members_all_tab="'.htmlspecialchars($_POST['var_pb_members_all_tab'][$cs_counter_members]).'" ';
													}
													if(isset($_POST['var_pb_members_profile_inks'][$cs_counter_members]) && trim($_POST['var_pb_members_profile_inks'][$cs_counter_members]) <> ''){
														$shortcode .= 	'var_pb_members_profile_inks="'.htmlspecialchars($_POST['var_pb_members_profile_inks'][$cs_counter_members]).'" ';
													}
													if(isset($_POST['var_pb_members_pagination'][$cs_counter_members]) && trim($_POST['var_pb_members_pagination'][$cs_counter_members]) <> ''){
														$shortcode .= 	'var_pb_members_pagination="'.htmlspecialchars($_POST['var_pb_members_pagination'][$cs_counter_members]).'" ';
													}
													if(isset($_POST['var_pb_members_per_page'][$cs_counter_members]) && trim($_POST['var_pb_members_per_page'][$cs_counter_members]) <> ''){
														$shortcode .= 	'var_pb_members_per_page="'.htmlspecialchars($_POST['var_pb_members_per_page'][$cs_counter_members]).'" ';
													}
													if(isset($_POST['cs_members_class'][$cs_counter_members]) && $_POST['cs_members_class'][$cs_counter_members] != ''){
														$shortcode .= 	'cs_members_class="'.htmlspecialchars($_POST['cs_members_class'][$cs_counter_members], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_members_animation'][$cs_counter_members]) && $_POST['cs_members_animation'][$cs_counter_members] != ''){
														$shortcode .= 	'cs_members_animation="'.htmlspecialchars($_POST['cs_members_animation'][$cs_counter_members]).'" ';
													}
													$shortcode .= 	']';
													$members->addChild('cs_shortcode', $shortcode );
													$cs_counter_members++;
												}
												$cs_global_counter_members++;
											}
											else if ( $_POST['cs_orderby'][$cs_counter] == "video" ) {
												$shortcode = '';
												$video = $column->addChild('video');
 												$video->addChild('page_element_size', htmlspecialchars($_POST['video_element_size'][$cs_global_counter_video]) );
												if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
													$shortcode_str = stripslashes ($_POST['shortcode']['video'][$cs_shortcode_counter_video]);
													$cs_shortcode_counter_video++;
													$video->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
												} else {
													$shortcode = '[cs_video ';
													if(isset($_POST['cs_video_section_title'][$counter_video]) && $_POST['cs_video_section_title'][$counter_video] != ''){
														$shortcode .= 	'cs_video_section_title="'.htmlspecialchars($_POST['cs_video_section_title'][$counter_video], ENT_QUOTES).'" ';
													}if(isset($_POST['video_url'][$counter_video]) && $_POST['video_url'][$counter_video] != ''){
														$shortcode .= 	'video_url="'.htmlspecialchars($_POST['video_url'][$counter_video], ENT_QUOTES).'" ';
													}if(isset($_POST['video_width'][$counter_video]) && $_POST['video_width'][$counter_video] != ''){
														$shortcode .= 	'video_width="'.htmlspecialchars($_POST['video_width'][$counter_video]).'" ';
													}if(isset($_POST['video_height'][$counter_video]) && $_POST['video_height'][$counter_video] != ''){
														$shortcode .= 	'video_height="'.htmlspecialchars($_POST['video_height'][$counter_video]).'" ';
													}if(isset($_POST['cs_video_custom_class'][$counter_video]) && $_POST['cs_video_custom_class'][$counter_video] != ''){
														$shortcode .= 	'cs_video_custom_class="'.htmlspecialchars($_POST['cs_video_custom_class'][$counter_video], ENT_QUOTES).'" ';
													}
													$shortcode .= 	']';
												$video->addChild('cs_shortcode', $shortcode );
												$counter_video++;
												}
												$cs_global_counter_video++;
											}
											else if ( $_POST['cs_orderby'][$cs_counter] == "audio" ) {
												$shortcode = $shortcode_item = '';
												$section_title = '';
												$audio = $column->addChild('audio');
 												$audio->addChild('page_element_size', htmlspecialchars($_POST['audio_element_size'][$cs_global_counter_audio]) );
												if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
													$shortcode_str = stripslashes ($_POST['shortcode']['audio'][$cs_shortcode_counter_audio]);
													$cs_shortcode_counter_audio++;
													$audio->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
												} else {
													if(isset($_POST['album_num'][$cs_counter_audio]) && $_POST['album_num'][$cs_counter_audio]>0){
														for ( $i = 1; $i <= $_POST['album_num'][$cs_counter_audio]; $i++ ){
															
															$shortcode_item .= '[album_item ';
															if(isset($_POST['cs_album_track_title'][$cs_counter_audio_node]) && $_POST['cs_album_track_title'][$cs_counter_audio_node] != ''){
																$shortcode_item .= 	'cs_album_track_title="'.htmlspecialchars($_POST['cs_album_track_title'][$cs_counter_audio_node]).'" ';
															}if(isset($_POST['cs_album_speaker'][$cs_counter_audio_node]) && $_POST['cs_album_speaker'][$cs_counter_audio_node] != ''){
																$shortcode_item .= 	'cs_album_speaker="'.htmlspecialchars($_POST['cs_album_speaker'][$cs_counter_audio_node]).'" ';
															}
															if(isset($_POST['cs_album_track_mp3_url'][$cs_counter_audio_node]) && $_POST['cs_album_track_mp3_url'][$cs_counter_audio_node] != ''){
																$shortcode_item .= 	'cs_album_track_mp3_url="'.htmlspecialchars($_POST['cs_album_track_mp3_url'][$cs_counter_audio_node]).'" ';
															}
															if(isset($_POST['cs_album_track_buy_mp3'][$cs_counter_audio_node]) && $_POST['cs_album_track_buy_mp3'][$cs_counter_audio_node] != ''){
																$shortcode_item .= 	'cs_album_track_buy_mp3="'.htmlspecialchars($_POST['cs_album_track_buy_mp3'][$cs_counter_audio_node]).'" ';
															}
															$shortcode_item .= 	']';
															$cs_counter_audio_node++;
														}
													}
													if(isset($_POST['cs_audio_section_title'][$cs_counter_audio]) && $_POST['cs_audio_section_title'][$cs_counter_audio] != ''){
														$section_title = 	'cs_audio_section_title="'.htmlspecialchars($_POST['cs_audio_section_title'][$cs_counter_audio], ENT_QUOTES).'" ';
													}
													$shortcode = '[cs_album 
													  '.$section_title.' 
													 cs_audio_section_title="'.htmlspecialchars($_POST['cs_audio_section_title'][$cs_counter_audio], ENT_QUOTES).'"   cs_audio_class="'.htmlspecialchars($_POST['cs_audio_class'][$cs_counter_audio], ENT_QUOTES).'"   cs_audio_animation="'.htmlspecialchars($_POST['cs_audio_animation'][$cs_counter_audio]).'"  ]'.$shortcode_item.'[/cs_album]';
													$audio->addChild('cs_shortcode', $shortcode );
													$cs_counter_audio++;
												}
												$cs_global_counter_audio++;
											}
										else if ( $_POST['cs_orderby'][$cs_counter] == "map" ) {
													$shortcode  =  '';
 													$map = $column->addChild('map');
 													$map->addChild('page_element_size', htmlspecialchars( $_POST['map_element_size'][$cs_global_counter_map] ));
												if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
													$shortcode_str = stripslashes ($_POST['shortcode']['map'][$cs_shortcode_counter_map]);
													$cs_shortcode_counter_map++;
													$map->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
												} else {
 													$shortcode = '[cs_map ';
													if(isset($_POST['cs_map_section_title'][$cs_counter_map]) && $_POST['cs_map_section_title'][$cs_counter_map] != ''){
														$shortcode .= 	'cs_map_section_title="'.htmlspecialchars($_POST['cs_map_section_title'][$cs_counter_map]).'" ';
													}
													if(isset($_POST['map_title'][$cs_counter_map]) && $_POST['map_title'][$cs_counter_map] != ''){
														$shortcode .= 	'map_title="'.htmlspecialchars($_POST['map_title'][$cs_counter_map], ENT_QUOTES).'" ';
													}
													if(isset($_POST['map_height'][$cs_counter_map]) && $_POST['map_height'][$cs_counter_map] != ''){
														$shortcode .= 	'map_height="'.htmlspecialchars($_POST['map_height'][$cs_counter_map], ENT_QUOTES).'" ';
													}
													if(isset($_POST['map_lat'][$cs_counter_map]) && $_POST['map_lat'][$cs_counter_map] != ''){
														$shortcode .= 	'map_lat="'.htmlspecialchars($_POST['map_lat'][$cs_counter_map], ENT_QUOTES).'" ';
													}
													if(isset($_POST['map_lon'][$cs_counter_map]) && $_POST['map_lon'][$cs_counter_map] != ''){
														$shortcode .= 	'map_lon="'.htmlspecialchars($_POST['map_lon'][$cs_counter_map], ENT_QUOTES).'" ';
													}
													if(isset($_POST['map_zoom'][$cs_counter_map]) && $_POST['map_zoom'][$cs_counter_map] != ''){
														$shortcode .= 	'map_zoom="'.htmlspecialchars($_POST['map_zoom'][$cs_counter_map], ENT_QUOTES).'" ';
													}
													if(isset($_POST['map_type'][$cs_counter_map]) && $_POST['map_type'][$cs_counter_map] != ''){
														$shortcode .= 	'map_type="'.htmlspecialchars($_POST['map_type'][$cs_counter_map]).'" ';
													}
													if(isset($_POST['map_info'][$cs_counter_map]) && $_POST['map_info'][$cs_counter_map] != ''){
														$shortcode .= 	'map_info="'.htmlspecialchars($_POST['map_info'][$cs_counter_map], ENT_QUOTES).'" ';
													}
													if(isset($_POST['map_info_width'][$cs_counter_map]) && $_POST['map_info_width'][$cs_counter_map] != ''){
														$shortcode .= 	'map_info_width="'.htmlspecialchars($_POST['map_info_width'][$cs_counter_map]).'" ';
													}
													if(isset($_POST['map_info_height'][$cs_counter_map]) && $_POST['map_info_height'][$cs_counter_map] != ''){
														$shortcode .= 	'map_info_height="'.htmlspecialchars($_POST['map_info_height'][$cs_counter_map]).'" ';
													}
													if(isset($_POST['map_marker_icon'][$cs_counter_map]) && $_POST['map_marker_icon'][$cs_counter_map] != ''){
														$shortcode .= 	'map_marker_icon="'.htmlspecialchars($_POST['map_marker_icon'][$cs_counter_map]).'" ';
													}
													if(isset($_POST['map_show_marker'][$cs_counter_map]) && $_POST['map_show_marker'][$cs_counter_map] != ''){
														$shortcode .= 	'map_show_marker="'.htmlspecialchars($_POST['map_show_marker'][$cs_counter_map]).'" ';
													}
													if(isset($_POST['map_controls'][$cs_counter_map]) && $_POST['map_controls'][$cs_counter_map] != ''){
														$shortcode .= 	'map_controls="'.htmlspecialchars($_POST['map_controls'][$cs_counter_map]).'" ';
													}
													if(isset($_POST['map_draggable'][$cs_counter_map]) && $_POST['map_draggable'][$cs_counter_map] != ''){
														$shortcode .= 	'map_draggable="'.htmlspecialchars($_POST['map_draggable'][$cs_counter_map]).'" ';
													}
													if(isset($_POST['map_scrollwheel'][$cs_counter_map]) && $_POST['map_scrollwheel'][$cs_counter_map] != ''){
														$shortcode .= 	'map_scrollwheel="'.htmlspecialchars($_POST['map_scrollwheel'][$cs_counter_map]).'" ';
													}
													if(isset($_POST['map_view'][$cs_counter_map]) && $_POST['map_view'][$cs_counter_map] != ''){
														$shortcode .= 	'map_view="'.htmlspecialchars($_POST['map_view'][$cs_counter_map]).'" ';
													}
													if(isset($_POST['map_border'][$cs_counter_map]) && $_POST['map_border'][$cs_counter_map] != ''){
														$shortcode .= 	'map_border="'.htmlspecialchars($_POST['map_border'][$cs_counter_map]).'" ';
													}
													if(isset($_POST['map_border_color'][$cs_counter_map]) && $_POST['map_border_color'][$cs_counter_map] != ''){
														$shortcode .= 	'map_border_color="'.htmlspecialchars($_POST['map_border_color'][$cs_counter_map]).'" ';
													}
													if(isset($_POST['map_color'][$cs_counter_map]) && $_POST['map_color'][$cs_counter_map] != ''){
														$shortcode .= 	'map_color="'.htmlspecialchars($_POST['map_color'][$cs_counter_map]).'" ';
													}
													if(isset($_POST['map_conactus_content'][$cs_counter_map]) && $_POST['map_conactus_content'][$cs_counter_map] != ''){
														$shortcode .= 	'map_conactus_content="'.htmlspecialchars($_POST['map_conactus_content'][$cs_counter_map], ENT_QUOTES).'" ';
													}
													if(isset($_POST['map_border'][$cs_counter_map]) && $_POST['map_border'][$cs_counter_map] != ''){
														$shortcode .= 	'map_border="'.htmlspecialchars($_POST['map_border'][$cs_counter_map]).'" ';
													}
													if(isset($_POST['cs_map_class'][$cs_counter_map]) && $_POST['cs_map_class'][$cs_counter_map] != ''){
														$shortcode .= 	'cs_map_class="'.htmlspecialchars($_POST['cs_map_class'][$cs_counter_map], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_map_animation'][$cs_counter_map]) && $_POST['cs_map_animation'][$cs_counter_map] != ''){
														$shortcode .= 	'cs_map_animation="'.htmlspecialchars($_POST['cs_map_animation'][$cs_counter_map]).'" ';
													}
													$shortcode .= 	']';
													$map->addChild('cs_shortcode', $shortcode );
												$cs_counter_map++;
												}
												$cs_global_counter_map++;
										}
										else if ( $_POST['cs_orderby'][$cs_counter] == "infobox" ) {
													$shortcode = $shortcode_item = '';
													$infobox   = $column->addChild('infobox');
													$infobox->addChild('page_element_size', htmlspecialchars($_POST['infobox_element_size'][$cs_counter_infobox]) );
													$infobox->addChild('infobox_element_size', htmlspecialchars($_POST['infobox_element_size'][$cs_counter_infobox]) );
													if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
														$shortcode_str = stripslashes ($_POST['shortcode']['infobox'][$cs_shortcode_counter_infobox]);
														$cs_shortcode_counter_infobox++;
														$infobox->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
													} else {
														if(isset($_POST['info_list_num'][$cs_counter_infobox]) && $_POST['info_list_num'][$cs_counter_infobox]>0){	
															for ( $i = 1; $i <= $_POST['info_list_num'][$cs_counter_infobox]; $i++ ){
																$shortcode_item .= '[infobox_item ';
																if(isset($_POST['cs_infobox_list_icon'][$cs_counter_infobox_node]) && $_POST['cs_infobox_list_icon'][$cs_counter_infobox_node] != ''){
																	$shortcode_item .= 	'cs_infobox_list_icon="'.htmlspecialchars($_POST['cs_infobox_list_icon'][$cs_counter_infobox_node]).'" ';
																}
																if(isset($_POST['cs_infobox_list_color'][$cs_counter_infobox_node]) && $_POST['cs_infobox_list_color'][$cs_counter_infobox_node] != ''){
																	$shortcode_item .= 	'cs_infobox_list_color="'.htmlspecialchars($_POST['cs_infobox_list_color'][$cs_counter_infobox_node]).'" ';
																}
																if(isset($_POST['cs_infobox_list_title'][$cs_counter_infobox_node]) && $_POST['cs_infobox_list_title'][$cs_counter_infobox_node] != ''){
																	$shortcode_item .= 	'cs_infobox_list_title="'.htmlspecialchars($_POST['cs_infobox_list_title'][$cs_counter_infobox_node], ENT_QUOTES).'" ';
																}
																$shortcode_item .= 	']';
																if(isset($_POST['cs_infobox_list_description'][$cs_counter_infobox_node]) && $_POST['cs_infobox_list_description'][$cs_counter_infobox_node] != ''){
																	$shortcode_item .= 	htmlspecialchars($_POST['cs_infobox_list_description'][$cs_counter_infobox_node], ENT_QUOTES);
																}
																$shortcode_item .= 	'[/infobox_item]';
																$cs_counter_infobox_node++;
															}
														}
														$shortcode .= '[cs_infobox ';
														if(isset($_POST['cs_infobox_section_title'][$cs_counter_infobox]) && trim($_POST['cs_infobox_section_title'][$cs_counter_infobox]) <> ''){
															$shortcode .= 	'cs_infobox_section_title="'.htmlspecialchars($_POST['cs_infobox_section_title'][$cs_counter_infobox], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_infobox_title'][$cs_counter_infobox]) && trim($_POST['cs_infobox_title'][$cs_counter_infobox]) <> ''){
															$shortcode .= 	'cs_infobox_title="'.htmlspecialchars($_POST['cs_infobox_title'][$cs_counter_infobox], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_infobox_bg_color'][$cs_counter_infobox]) && trim($_POST['cs_infobox_bg_color'][$cs_counter_infobox]) <> ''){
															$shortcode .= 	'cs_infobox_bg_color="'.htmlspecialchars($_POST['cs_infobox_bg_color'][$cs_counter_infobox]).'" ';
														}
														
														if(isset($_POST['cs_infobox_list_text_color'][$cs_counter_infobox]) && trim($_POST['cs_infobox_list_text_color'][$cs_counter_infobox]) <> ''){
															$shortcode .= 	'cs_infobox_list_text_color="'.htmlspecialchars($_POST['cs_infobox_list_text_color'][$cs_counter_infobox]).'" ';
														}
														if(isset($_POST['cs_infobox_class'][$cs_counter_infobox]) && trim($_POST['cs_infobox_class'][$cs_counter_infobox]) <> ''){
															$shortcode .= 	'cs_infobox_class="'.htmlspecialchars($_POST['cs_infobox_class'][$cs_counter_infobox], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_infobox_animation'][$cs_counter_infobox]) && trim($_POST['cs_infobox_animation'][$cs_counter_infobox]) <> ''){
															$shortcode .= 	'cs_infobox_animation="'.htmlspecialchars($_POST['cs_infobox_animation'][$cs_counter_infobox]).'" ';
														}
														$shortcode .= 	']'.$shortcode_item.'[/cs_infobox]';
														$infobox->addChild('cs_shortcode', $shortcode );
														$cs_counter_infobox++;
													}
													$cs_global_counter_infobox++;
													
										} 
										elseif ( $_POST['cs_orderby'][$cs_counter] == "icons" ) {
												$shortcode  = '';
												$icons 	= $column->addChild('icons');
												$icons->addChild('page_element_size', htmlspecialchars($_POST['icons_element_size'][$cs_global_counter_icons]) );
												if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
													$shortcode_str = stripslashes ($_POST['shortcode']['icons'][$cs_shortcode_counter_icons]);
													$cs_shortcode_counter_icons++;
													$icons->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
												} else {
													$shortcode = '[cs_icons ';
													if(isset($_POST['font_type'][$cs_counter_icons]) && $_POST['font_type'][$cs_counter_icons] != ''){
														$shortcode .= 	'font_type="'.htmlspecialchars($_POST['font_type'][$cs_counter_icons]).'" ';
													}if(isset($_POST['font_size'][$cs_counter_icons]) && $_POST['font_size'][$cs_counter_icons] != ''){
														$shortcode .= 	'font_size="'.htmlspecialchars($_POST['font_size'][$cs_counter_icons]).'" ';
													}if(isset($_POST['icon_color'][$cs_counter_icons]) && $_POST['icon_color'][$cs_counter_icons] != ''){
														$shortcode .= 	'icon_color="'.htmlspecialchars($_POST['icon_color'][$cs_counter_icons]).'" ';
													}if(isset($_POST['icon_bg_color'][$cs_counter_icons]) && $_POST['icon_bg_color'][$cs_counter_icons] != ''){
														$shortcode .= 	'icon_bg_color="'.htmlspecialchars($_POST['icon_bg_color'][$cs_counter_icons]).'" ';
													}if(isset($_POST['font_icon'][$cs_counter_icons]) && $_POST['font_icon'][$cs_counter_icons] != ''){
														$shortcode .= 	'font_icon="'.htmlspecialchars($_POST['font_icon'][$cs_counter_icons]).'" ';
													}if(isset($_POST['icon_view'][$cs_counter_icons]) && $_POST['icon_view'][$cs_counter_icons] != ''){
														$shortcode .= 	'icon_view="'.htmlspecialchars($_POST['icon_view'][$cs_counter_icons]).'" ';
													}if(isset($_POST['cs_icons_class'][$cs_counter_icons]) && $_POST['cs_icons_class'][$cs_counter_icons] != ''){
														$shortcode .= 	'cs_icons_class="'.htmlspecialchars($_POST['cs_icons_class'][$cs_counter_icons]).'" ';
													}if(isset($_POST['cs_icons_animation'][$cs_counter_icons]) && $_POST['cs_icons_animation'][$cs_counter_icons] != ''){
														$shortcode .= 	'cs_icons_animation="'.htmlspecialchars($_POST['cs_icons_animation'][$cs_counter_icons]).'" ';
													}
													$shortcode .= 	'[/cs_icons]';	
													$icons->addChild('cs_shortcode', $shortcode );
												$cs_counter_icons++;
												}
												$cs_global_counter_icons++;
												
									}
										else if ( $_POST['cs_orderby'][$cs_counter] == "image" ) {
												$shortcode  = '';
												
												$image = $column->addChild('image');
 												$image->addChild('page_element_size', htmlspecialchars($_POST['image_element_size'][$cs_global_counter_image]) );
												if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
 													$shortcode_str = stripslashes ($_POST['shortcode']['image'][$cs_shortcode_counter_image]);
													$cs_shortcode_counter_image++;
													$image->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
												} else {
													$shortcode = '[cs_image ';
													if(isset($_POST['cs_image_section_title'][$cs_counter_image]) && $_POST['cs_image_section_title'][$cs_counter_image] != ''){
														$shortcode .= 	'cs_image_section_title="'.htmlspecialchars($_POST['cs_image_section_title'][$cs_counter_image], ENT_QUOTES).'" ';
													}
													if(isset($_POST['cs_image_url'][$cs_counter_image]) && $_POST['cs_image_url'][$cs_counter_image] != ''){
														$shortcode .= 	'cs_image_url="'.htmlspecialchars($_POST['cs_image_url'][$cs_counter_image], ENT_QUOTES).'" ';
													}
													if(isset($_POST['image_style'][$cs_counter_image]) && $_POST['image_style'][$cs_counter_image] != ''){
														$shortcode .= 	'image_style="'.htmlspecialchars($_POST['image_style'][$cs_counter_image]).'" ';
													}
													if(isset($_POST['cs_image_title'][$cs_counter_image]) && $_POST['cs_image_title'][$cs_counter_image] != ''){
														$shortcode .= 	'cs_image_title="'.htmlspecialchars($_POST['cs_image_title'][$cs_counter_image], ENT_QUOTES).'" ';
													}if(isset($_POST['cs_custom_class'][$cs_counter_image]) && $_POST['cs_custom_class'][$cs_counter_image] != ''){
														$shortcode .= 	'cs_custom_class="'.htmlspecialchars($_POST['cs_custom_class'][$cs_counter_image], ENT_QUOTES).'" ';
													}if(isset($_POST['cs_custom_animation'][$cs_counter_image]) && $_POST['cs_custom_animation'][$cs_counter_image] != ''){
														$shortcode .= 	'cs_custom_animation="'.htmlspecialchars($_POST['cs_custom_animation'][$cs_counter_image]).'" ';
													}
													$shortcode .= 	']';	 
													if(isset($_POST['cs_image_caption'][$cs_counter_image]) && $_POST['cs_image_caption'][$cs_counter_image] != ''){
														$shortcode .= 	htmlspecialchars($_POST['cs_image_caption'][$cs_counter_image], ENT_QUOTES);
													}				 
													$shortcode .= 	'[/cs_image]';					 
													$image->addChild('cs_shortcode', $shortcode );
													
													$cs_counter_image++;
												}
											$cs_global_counter_image++;
										}
										// Loops Short Code Start
										// Blog
										else if ( $_POST['cs_orderby'][$cs_counter] == "blog" ) {
													$shortcode = '';
													$blog = $column->addChild('blog');
													$blog->addChild('page_element_size', htmlspecialchars($_POST['blog_element_size'][$cs_global_counter_blog]) );
													$blog->addChild('blog_element_size', htmlspecialchars($_POST['blog_element_size'][$cs_global_counter_blog]) );
													if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
														$shortcode_str = stripslashes ($_POST['shortcode']['blog'][$cs_shortcode_counter_blog]);
														$cs_shortcode_counter_blog++;
														$blog->addChild('cs_shortcode', htmlspecialchars($shortcode_str) );
													} else {
														$shortcode = '[cs_blog ';
														if(isset($_POST['cs_blog_section_title'][$cs_counter_blog]) && $_POST['cs_blog_section_title'][$cs_counter_blog] != ''){
															$shortcode .= 	'cs_blog_section_title="'.htmlspecialchars($_POST['cs_blog_section_title'][$cs_counter_blog], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_blog_description'][$cs_counter_blog]) && $_POST['cs_blog_description'][$cs_counter_blog] != ''){
															$shortcode .= 	'cs_blog_description="'.htmlspecialchars($_POST['cs_blog_description'][$cs_counter_blog], ENT_QUOTES).'" ';
														}if(isset($_POST['cs_blog_cat'][$cs_counter_blog]) && $_POST['cs_blog_cat'][$cs_counter_blog] != ''){
															$shortcode .= 	'cs_blog_cat="'.htmlspecialchars($_POST['cs_blog_cat'][$cs_counter_blog]).'" ';
														}if(isset($_POST['cs_blog_view'][$cs_counter_blog]) && $_POST['cs_blog_view'][$cs_counter_blog] != ''){
															$shortcode .= 	'cs_blog_view="'.htmlspecialchars($_POST['cs_blog_view'][$cs_counter_blog]).'" ';
														}if(isset($_POST['cs_blog_excerpt'][$cs_counter_blog]) && $_POST['cs_blog_excerpt'][$cs_counter_blog] != ''){
															$shortcode .= 	'cs_blog_excerpt="'.htmlspecialchars($_POST['cs_blog_excerpt'][$cs_counter_blog], ENT_QUOTES).'" ';
														}if(isset($_POST['cs_blog_num_post'][$cs_counter_blog]) && $_POST['cs_blog_num_post'][$cs_counter_blog] != ''){
															$shortcode .= 	'cs_blog_num_post="'.htmlspecialchars($_POST['cs_blog_num_post'][$cs_counter_blog]).'" ';
														}if(isset($_POST['cs_blog_orderby'][$cs_counter_blog]) && $_POST['cs_blog_orderby'][$cs_counter_blog] != ''){
															$shortcode .= 	'cs_blog_orderby="'.htmlspecialchars($_POST['cs_blog_orderby'][$cs_counter_blog]).'" ';
														}if(isset($_POST['blog_pagination'][$cs_counter_blog]) && $_POST['blog_pagination'][$cs_counter_blog] != ''){
															$shortcode .= 	'blog_pagination="'.htmlspecialchars($_POST['blog_pagination'][$cs_counter_blog]).'" ';
														}if(isset($_POST['cs_blog_filterable'][$cs_counter_blog]) && $_POST['cs_blog_filterable'][$cs_counter_blog] != ''){
															$shortcode .= 	'cs_blog_filterable="'.htmlspecialchars($_POST['cs_blog_filterable'][$cs_counter_blog]).'" ';
														}if(isset($_POST['cs_blog_class'][$cs_counter_blog]) && $_POST['cs_blog_class'][$cs_counter_blog] != ''){
															$shortcode .= 	'cs_blog_class="'.htmlspecialchars($_POST['cs_blog_class'][$cs_counter_blog], ENT_QUOTES).'" ';
														}if(isset($_POST['cs_blog_animation'][$cs_counter_blog]) && $_POST['cs_blog_animation'][$cs_counter_blog] != ''){
															$shortcode .= 	'cs_blog_animation="'.htmlspecialchars($_POST['cs_blog_animation'][$cs_counter_blog]).'" ';
														}
														$shortcode .= 	']';
														$blog->addChild('cs_shortcode', $shortcode );
														$cs_counter_blog++;
													}
												$cs_global_counter_blog++;
										}
										else if ( $_POST['cs_orderby'][$cs_counter] == "events" ) {
													$shortcode = '';
													$event = $column->addChild('events');
													$event->addChild('page_element_size', htmlspecialchars($_POST['events_element_size'][$cs_global_counter_events]) );
													$event->addChild('events_element_size', htmlspecialchars($_POST['events_element_size'][$cs_global_counter_events]) );
													if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
														$shortcode_str = stripslashes ($_POST['shortcode']['events'][$cs_shortcode_counter_events]);
														$cs_shortcode_counter_events++;
														$event->addChild('cs_shortcode', htmlspecialchars($shortcode_str) );
													} else {
														$shortcode = '[cs_events ';
														if(isset($_POST['cs_events_section_title'][$cs_counter_events]) && $_POST['cs_events_section_title'][$cs_counter_events] != ''){
															$shortcode .= 	'cs_events_section_title="'.htmlspecialchars($_POST['cs_events_section_title'][$cs_counter_events], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_events_cat'][$cs_counter_events]) && $_POST['cs_events_cat'][$cs_counter_events] != ''){
															$shortcode .= 	'cs_events_cat="'.htmlspecialchars($_POST['cs_events_cat'][$cs_counter_events]).'" ';
														}if(isset($_POST['cs_events_view'][$cs_counter_events]) && $_POST['cs_events_view'][$cs_counter_events] != ''){
															$shortcode .= 	'cs_events_view="'.htmlspecialchars($_POST['cs_events_view'][$cs_counter_events]).'" ';
														}if(isset($_POST['cs_events_excerpt'][$cs_counter_events]) && $_POST['cs_events_excerpt'][$cs_counter_events] != ''){
															$shortcode .= 	'cs_events_excerpt="'.htmlspecialchars($_POST['cs_events_excerpt'][$cs_counter_events], ENT_QUOTES).'" ';
														}if(isset($_POST['cs_events_num_post'][$cs_counter_events]) && $_POST['cs_events_num_post'][$cs_counter_events] != ''){
															$shortcode .= 	'cs_events_num_post="'.htmlspecialchars($_POST['cs_events_num_post'][$cs_counter_events]).'" ';
														}if(isset($_POST['cs_events_listing_type'][$cs_counter_events]) && $_POST['cs_events_listing_type'][$cs_counter_events] != ''){
															$shortcode .= 	'cs_events_listing_type="'.htmlspecialchars($_POST['cs_events_listing_type'][$cs_counter_events]).'" ';
														}if(isset($_POST['cs_events_orderby'][$cs_counter_events]) && $_POST['cs_events_orderby'][$cs_counter_events] != ''){
															$shortcode .= 	'cs_events_orderby="'.htmlspecialchars($_POST['cs_events_orderby'][$cs_counter_events]).'" ';
														}if(isset($_POST['cs_evnts_post_time'][$cs_counter_events]) && $_POST['cs_evnts_post_time'][$cs_counter_events] != ''){
															$shortcode .= 	'cs_evnts_post_time="'.htmlspecialchars($_POST['cs_evnts_post_time'][$cs_counter_events]).'" ';
														}if(isset($_POST['events_pagination'][$cs_counter_events]) && $_POST['events_pagination'][$cs_counter_events] != ''){
															$shortcode .= 	'events_pagination="'.htmlspecialchars($_POST['events_pagination'][$cs_counter_events]).'" ';
														}if(isset($_POST['cs_events_class'][$cs_counter_events]) && $_POST['cs_events_class'][$cs_counter_events] != ''){
															$shortcode .= 	'cs_events_class="'.htmlspecialchars($_POST['cs_events_class'][$cs_counter_events], ENT_QUOTES).'" ';
														}if(isset($_POST['cs_events_filterable'][$cs_counter_events]) && $_POST['cs_events_filterable'][$cs_counter_events] != ''){
															$shortcode .= 	'cs_events_filterable="'.htmlspecialchars($_POST['cs_events_filterable'][$cs_counter_events], ENT_QUOTES).'" ';
														}if(isset($_POST['cs_events_animation'][$cs_counter_events]) && $_POST['cs_events_animation'][$cs_counter_events] != ''){
															$shortcode .= 	'cs_events_animation="'.htmlspecialchars($_POST['cs_events_animation'][$cs_counter_events]).'" ';
														}
														$shortcode .= 	']';
														$event->addChild('cs_shortcode', $shortcode );
														$cs_counter_events++;
													}
												$cs_global_counter_events++;
										}
										
										// Loops Short Code Start
										// Sermon
										else if ( $_POST['cs_orderby'][$cs_counter] == "sermon" ) {
													$shortcode = '';
													$sermon = $column->addChild('sermon');
													$sermon->addChild('page_element_size', htmlspecialchars($_POST['sermon_element_size'][$cs_global_counter_sermon]) );
													$sermon->addChild('sermon_element_size', htmlspecialchars($_POST['sermon_element_size'][$cs_global_counter_sermon]) );
													if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
														$shortcode_str = stripslashes ($_POST['shortcode']['sermon'][$cs_shortcode_counter_sermon]);
														$cs_shortcode_counter_sermon++;
														$sermon->addChild('cs_shortcode', htmlspecialchars($shortcode_str) );
													} else {
														$shortcode = '[cs_sermon ';
														if(isset($_POST['cs_sermon_section_title'][$cs_counter_sermon]) && $_POST['cs_sermon_section_title'][$cs_counter_sermon] != ''){
															$shortcode .= 	'cs_sermon_section_title="'.htmlspecialchars($_POST['cs_sermon_section_title'][$cs_counter_sermon], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_sermon_cat'][$cs_counter_sermon]) && $_POST['cs_sermon_cat'][$cs_counter_sermon] != ''){
															$shortcode .= 	'cs_sermon_cat="'.htmlspecialchars($_POST['cs_sermon_cat'][$cs_counter_sermon]).'" ';
														}if(isset($_POST['cs_sermon_view'][$cs_counter_sermon]) && $_POST['cs_sermon_view'][$cs_counter_sermon] != ''){
															$shortcode .= 	'cs_sermon_view="'.htmlspecialchars($_POST['cs_sermon_view'][$cs_counter_sermon]).'" ';
														}if(isset($_POST['cs_sermon_num_post'][$cs_counter_sermon]) && $_POST['cs_sermon_num_post'][$cs_counter_sermon] != ''){
															$shortcode .= 	'cs_sermon_num_post="'.htmlspecialchars($_POST['cs_sermon_num_post'][$cs_counter_sermon]).'" ';
														}if(isset($_POST['sermon_pagination'][$cs_counter_sermon]) && $_POST['sermon_pagination'][$cs_counter_sermon] != ''){
															$shortcode .= 	'sermon_pagination="'.htmlspecialchars($_POST['sermon_pagination'][$cs_counter_sermon]).'" ';
														}if(isset($_POST['cs_sermon_filterable'][$cs_counter_sermon]) && $_POST['cs_sermon_filterable'][$cs_counter_sermon] != ''){
															$shortcode .= 	'cs_sermon_filterable="'.htmlspecialchars($_POST['cs_sermon_filterable'][$cs_counter_sermon], ENT_QUOTES).'" ';
														}if(isset($_POST['cs_sermon_class'][$cs_counter_sermon]) && $_POST['cs_sermon_class'][$cs_counter_sermon] != ''){
															$shortcode .= 	'cs_sermon_class="'.htmlspecialchars($_POST['cs_sermon_class'][$cs_counter_sermon], ENT_QUOTES).'" ';
														}if(isset($_POST['cs_sermon_animation'][$cs_counter_sermon]) && $_POST['cs_sermon_animation'][$cs_counter_sermon] != ''){
															$shortcode .= 	'cs_sermon_animation="'.htmlspecialchars($_POST['cs_sermon_animation'][$cs_counter_sermon]).'" ';
														}
														$shortcode .= 	']';
														$sermon->addChild('cs_shortcode', $shortcode );
														$cs_counter_sermon++;
													}
												$cs_global_counter_sermon++;
										}
										
										// Loops Short Code Start
										// Latest Sermon
										else if ( $_POST['cs_orderby'][$cs_counter] == "latest_sermon" ) {
													$shortcode = '';
													$sermon = $column->addChild('latest_sermon');
													$sermon->addChild('page_element_size', htmlspecialchars($_POST['latest_sermon_element_size'][$cs_global_counter_latest_sermon]) );
													$sermon->addChild('latest_sermon_element_size', htmlspecialchars($_POST['latest_sermon_element_size'][$cs_global_counter_latest_sermon]) );
													if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
														$shortcode_str = stripslashes ($_POST['shortcode']['latest_sermon'][$cs_shortcode_counter_latest_sermon]);
														$cs_shortcode_counter_latest_sermon++;
														$sermon->addChild('cs_shortcode', htmlspecialchars($shortcode_str) );
													} else {
														$shortcode = '[cs_latest_sermon ';
														if(isset($_POST['cs_latest_sermon_section_title'][$cs_counter_latest_sermon]) && $_POST['cs_latest_sermon_section_title'][$cs_counter_latest_sermon] != ''){
															$shortcode .= 	'cs_latest_sermon_section_title="'.htmlspecialchars($_POST['cs_latest_sermon_section_title'][$cs_counter_latest_sermon], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_latest_sermon_cat'][$cs_counter_latest_sermon]) && $_POST['cs_latest_sermon_cat'][$cs_counter_latest_sermon] != ''){
															$shortcode .= 	'cs_latest_sermon_cat="'.htmlspecialchars($_POST['cs_latest_sermon_cat'][$cs_counter_latest_sermon]).'" ';
														}if(isset($_POST['cs_sermon_text_color'][$cs_counter_latest_sermon]) && $_POST['cs_sermon_text_color'][$cs_counter_latest_sermon] != ''){
															$shortcode .= 	'cs_sermon_text_color="'.htmlspecialchars($_POST['cs_sermon_text_color'][$cs_counter_latest_sermon]).'" ';
														}if(isset($_POST['cs_latest_sermon_class'][$cs_counter_latest_sermon]) && $_POST['cs_latest_sermon_class'][$cs_counter_latest_sermon] != ''){
															$shortcode .= 	'cs_latest_sermon_class="'.htmlspecialchars($_POST['cs_latest_sermon_class'][$cs_counter_latest_sermon], ENT_QUOTES).'" ';
														}if(isset($_POST['cs_latest_sermon_animation'][$cs_counter_latest_sermon]) && $_POST['cs_latest_sermon_animation'][$cs_counter_latest_sermon] != ''){
															$shortcode .= 	'cs_latest_sermon_animation="'.htmlspecialchars($_POST['cs_latest_sermon_animation'][$cs_counter_latest_sermon]).'" ';
														}
														$shortcode .= 	']';
														$sermon->addChild('cs_shortcode', $shortcode );
														$cs_counter_latest_sermon++;
													}
												$cs_global_counter_latest_sermon++;
										}
										// Project
										else if ( $_POST['cs_orderby'][$cs_counter] == "project" ) {
													$shortcode = '';
													$project = $column->addChild('project');
													$project->addChild('page_element_size', htmlspecialchars($_POST['project_element_size'][$cs_global_counter_project]) );
													$project->addChild('project_element_size', htmlspecialchars($_POST['project_element_size'][$cs_global_counter_project]) );
													if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
														$shortcode_str = stripslashes ($_POST['shortcode']['project'][$cs_shortcode_counter_project]);
														$cs_shortcode_counter_project++;
														$project->addChild('cs_shortcode', htmlspecialchars($shortcode_str) );
													} else {
														$shortcode = '[cs_project ';
														if(isset($_POST['cs_project_section_title'][$cs_counter_project]) && $_POST['cs_project_section_title'][$cs_counter_project] != ''){
															$shortcode .= 	'cs_project_section_title="'.htmlspecialchars($_POST['cs_project_section_title'][$cs_counter_project], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_project_cat'][$cs_counter_project]) && $_POST['cs_project_cat'][$cs_counter_project] != ''){
															$shortcode .= 	'cs_project_cat="'.htmlspecialchars($_POST['cs_project_cat'][$cs_counter_project]).'" ';
														}if(isset($_POST['cs_project_view'][$cs_counter_project]) && $_POST['cs_project_view'][$cs_counter_project] != ''){
															$shortcode .= 	'cs_project_view="'.htmlspecialchars($_POST['cs_project_view'][$cs_counter_project]).'" ';
														}if(isset($_POST['cs_project_num_post'][$cs_counter_project]) && $_POST['cs_project_num_post'][$cs_counter_project] != ''){
															$shortcode .= 	'cs_project_num_post="'.htmlspecialchars($_POST['cs_project_num_post'][$cs_counter_project]).'" ';
														}if(isset($_POST['cs_project_pagination'][$cs_counter_project]) && $_POST['cs_project_pagination'][$cs_counter_project] != ''){
															$shortcode .= 	'cs_project_pagination="'.htmlspecialchars($_POST['cs_project_pagination'][$cs_counter_project]).'" ';
														}if(isset($_POST['cs_project_class'][$cs_counter_project]) && $_POST['cs_project_class'][$cs_counter_project] != ''){
															$shortcode .= 	'cs_project_class="'.htmlspecialchars($_POST['cs_project_class'][$cs_counter_project], ENT_QUOTES).'" ';
														}if(isset($_POST['cs_project_animation'][$cs_counter_project]) && $_POST['cs_project_animation'][$cs_counter_project] != ''){
															$shortcode .= 	'cs_project_animation="'.htmlspecialchars($_POST['cs_project_animation'][$cs_counter_project]).'" ';
														}
														$shortcode .= 	']';
														$project->addChild('cs_shortcode', $shortcode );
														$cs_counter_project++;
													}
												$cs_global_counter_project++;
										}
										// Causes
										else if ( $_POST['cs_orderby'][$cs_counter] == "cause" ) {
											$shortcode = '';
													$cause = $column->addChild('cause');
													$cause->addChild('page_element_size', htmlspecialchars($_POST['cause_element_size'][$cs_global_counter_cause]) );
													$cause->addChild('cause_element_size', htmlspecialchars($_POST['cause_element_size'][$cs_global_counter_cause]) );
													if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
														$shortcode_str = stripslashes ($_POST['shortcode']['cause'][$cs_shortcode_counter_cause]);
														$cs_shortcode_counter_cause++;
														$cause->addChild('cs_shortcode', htmlspecialchars($shortcode_str) );
													} else {
														$shortcode = '[cs_cause ';
														if(isset($_POST['cause_title'][$cs_counter_cause]) && $_POST['cause_title'][$cs_counter_cause] != ''){
															$shortcode .= 	'cause_title="'.htmlspecialchars($_POST['cause_title'][$cs_counter_cause], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cause_cat'][$cs_counter_cause]) && $_POST['cause_cat'][$cs_counter_cause] != ''){
															$shortcode .= 	'cause_cat="'.htmlspecialchars($_POST['cause_cat'][$cs_counter_cause]).'" ';
														}if(isset($_POST['cause_view'][$cs_counter_cause]) && $_POST['cause_view'][$cs_counter_cause] != ''){
															$shortcode .= 	'cause_view="'.htmlspecialchars($_POST['cause_view'][$cs_counter_cause]).'" ';
														}if(isset($_POST['cause_type'][$cs_counter_cause]) && $_POST['cause_type'][$cs_counter_cause] != ''){
															$shortcode .= 	'cause_type="'.htmlspecialchars($_POST['cause_type'][$cs_counter_cause]).'" ';
														}if(isset($_POST['cause_pagination'][$cs_counter_cause]) && $_POST['cause_pagination'][$cs_counter_cause] != ''){
															$shortcode .= 	'cause_pagination="'.htmlspecialchars($_POST['cause_pagination'][$cs_counter_cause]).'" ';
														}if(isset($_POST['cs_cause_description'][$cs_counter_cause]) && $_POST['cs_cause_description'][$cs_counter_cause] != ''){
															$shortcode .= 	'cs_cause_description="'.htmlspecialchars($_POST['cs_cause_description'][$cs_counter_cause]).'" ';
														}if(isset($_POST['cs_cause_last_miles_percentage'][$cs_counter_cause]) && $_POST['cs_cause_last_miles_percentage'][$cs_counter_cause] != ''){
															$shortcode .= 	'cs_cause_last_miles_percentage="'.htmlspecialchars($_POST['cs_cause_last_miles_percentage'][$cs_counter_cause]).'" ';
														}if(isset($_POST['cause_per_page'][$cs_counter_cause]) && $_POST['cause_per_page'][$cs_counter_cause] != ''){
															$shortcode .= 	'cause_per_page="'.htmlspecialchars($_POST['cause_per_page'][$cs_counter_cause]).'" ';
														}if(isset($_POST['cs_cause_excerpt'][$cs_counter_cause]) && $_POST['cs_cause_excerpt'][$cs_counter_cause] != ''){
															$shortcode .= 	'cs_cause_excerpt="'.htmlspecialchars($_POST['cs_cause_excerpt'][$cs_counter_cause]).'" ';
														}if(isset($_POST['cs_cause_filterable'][$cs_counter_cause]) && $_POST['cs_cause_filterable'][$cs_counter_cause] != ''){
															$shortcode .= 	'cs_cause_filterable="'.htmlspecialchars($_POST['cs_cause_filterable'][$cs_counter_cause]).'" ';
														}if(isset($_POST['cs_cause_class'][$cs_counter_cause]) && $_POST['cs_cause_class'][$cs_counter_cause] != ''){
															$shortcode .= 	'cs_cause_class="'.htmlspecialchars($_POST['cs_cause_class'][$cs_counter_cause], ENT_QUOTES).'" ';
														}if(isset($_POST['cs_cause_animation'][$cs_counter_cause]) && $_POST['cs_cause_animation'][$cs_counter_cause] != ''){
															$shortcode .= 	'cs_cause_animation="'.htmlspecialchars($_POST['cs_cause_animation'][$cs_counter_cause]).'" ';
														}
														$shortcode .= 	']';
														$cause->addChild('cs_shortcode', $shortcode );
														$cs_counter_cause++;
													}
												$cs_global_counter_cause++;
																					}
										// Latest Causes
										else if ( $_POST['cs_orderby'][$cs_counter] == "latest_cause" ) {
											$shortcode = '';
													$latest_cause = $column->addChild('latest_cause');
													$latest_cause->addChild('page_element_size', htmlspecialchars($_POST['latest_cause_element_size'][$cs_global_counter_latest_cause]) );
													$latest_cause->addChild('latest_cause_element_size', htmlspecialchars($_POST['latest_cause_element_size'][$cs_global_counter_latest_cause]) );
													if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
														$shortcode_str = stripslashes ($_POST['shortcode']['latest_cause'][$cs_shortcode_counter_latest_cause]);
														$cs_shortcode_counter_latest_cause++;
														$latest_cause->addChild('cs_shortcode', htmlspecialchars($shortcode_str) );
													} else {
														$shortcode = '[cs_latest_cause ';
														if(isset($_POST['latest_cause_title'][$cs_counter_latest_cause]) && $_POST['latest_cause_title'][$cs_counter_latest_cause] != ''){
															$shortcode .= 	'latest_cause_title="'.htmlspecialchars($_POST['latest_cause_title'][$cs_counter_latest_cause], ENT_QUOTES).'" ';
														}
														if(isset($_POST['latest_cause_cat'][$cs_counter_latest_cause]) && $_POST['latest_cause_cat'][$cs_counter_latest_cause] != ''){
															$shortcode .= 	'latest_cause_cat="'.htmlspecialchars($_POST['latest_cause_cat'][$cs_counter_latest_cause]).'" ';
														}if(isset($_POST['latest_cause_button_aling'][$cs_counter_latest_cause]) && $_POST['latest_cause_button_aling'][$cs_counter_latest_cause] != ''){
															$shortcode .= 	'latest_cause_button_aling="'.htmlspecialchars($_POST['latest_cause_button_aling'][$cs_counter_latest_cause]).'" ';
														}if(isset($_POST['latest_cause_text_color'][$cs_counter_latest_cause]) && $_POST['latest_cause_text_color'][$cs_counter_latest_cause] != ''){
															$shortcode .= 	'latest_cause_text_color="'.htmlspecialchars($_POST['latest_cause_text_color'][$cs_counter_latest_cause]).'" ';
														}if(isset($_POST['cs_latest_cause_class'][$cs_counter_cause]) && $_POST['cs_latest_cause_class'][$cs_counter_latest_cause] != ''){
															$shortcode .= 	'cs_latest_cause_class="'.htmlspecialchars($_POST['cs_latest_cause_class'][$cs_counter_latest_cause]).'" ';
														}if(isset($_POST['cs_latest_cause_animation'][$cs_counter_latest_cause]) && $_POST['cs_latest_cause_animation'][$cs_counter_latest_cause] != ''){
															$shortcode .= 	'cs_latest_cause_animation="'.htmlspecialchars($_POST['cs_latest_cause_animation'][$cs_counter_latest_cause]).'" ';
														}
														
														$shortcode .= 	']';
														$latest_cause->addChild('cs_shortcode', $shortcode );
														$cs_counter_latest_cause++;
													}
												$cs_global_counter_latest_cause++;
																					}
										// Clients
										else if ( $_POST['cs_orderby'][$cs_counter] == "clients" ) {
													$shortcode = $shortcode_item = '';
													$clients = $column->addChild('clients');
													$clients->addChild('page_element_size', htmlspecialchars($_POST['clients_element_size'][$cs_global_counter_clients]) );
													$clients->addChild('clients_element_size', htmlspecialchars($_POST['clients_element_size'][$cs_shortcode_counter_clients]) );
													if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
														$shortcode_str = stripslashes ($_POST['shortcode']['clients'][$cs_shortcode_counter_clients]);
														$cs_shortcode_counter_clients++;
														$clients->addChild('cs_shortcode', htmlspecialchars($shortcode_str) );
													} else {
														if(isset($_POST['clients_num'][$cs_counter_clients]) && $_POST['clients_num'][$cs_counter_clients]>0){
															for ( $i = 1; $i <= $_POST['clients_num'][$cs_counter_clients]; $i++ ){
																$clients_item = $clients->addChild('clients_item');
													
																$shortcode_item .= '[clients_item ';
																if(isset($_POST['cs_bg_color'][$cs_counter_clients_node])  && $_POST['cs_bg_color'][$cs_counter_clients_node] != ''){
																	$shortcode_item .= 	'cs_bg_color="'.htmlspecialchars($_POST['cs_bg_color'][$cs_counter_clients_node]).'" ';
																}	
																if(isset($_POST['cs_website_url'][$cs_counter_clients_node])  && $_POST['cs_website_url'][$cs_counter_clients_node] != ''){
																	$shortcode_item .= 	'cs_website_url="'.htmlspecialchars($_POST['cs_website_url'][$cs_counter_clients_node]).'" ';
																}
																if(isset($_POST['cs_client_title'][$cs_counter_clients_node])  && $_POST['cs_client_title'][$cs_counter_clients_node] != ''){
																	$shortcode_item .= 	'cs_client_title="'.htmlspecialchars($_POST['cs_client_title'][$cs_counter_clients_node], ENT_QUOTES).'" ';
																}
																if(isset($_POST['cs_client_logo'][$cs_counter_clients_node])  && $_POST['cs_client_logo'][$cs_counter_clients_node] != ''){
																	$shortcode_item .= 	'cs_client_logo="'.htmlspecialchars($_POST['cs_client_logo'][$cs_counter_clients_node]).'" ';
																}	
																$shortcode_item .= 	']';
																$cs_counter_clients_node++;
															}
														}
													$section_title = '';
													if(isset($_POST['cs_client_section_title'][$cs_counter_clients])  && $_POST['cs_client_section_title'][$cs_counter_clients] != ''){
														$section_title = 	'cs_client_section_title="'.htmlspecialchars($_POST['cs_client_section_title'][$cs_counter_clients], ENT_QUOTES).'" ';
													}
													$shortcode = '[cs_clients ';
													if(isset($_POST['cs_clients_view'][$cs_counter_clients])  && $_POST['cs_clients_view'][$cs_counter_clients] != ''){
														$shortcode .= 	'cs_clients_view="'.htmlspecialchars($_POST['cs_clients_view'][$cs_counter_clients]).'" ';
													}
													if(isset($_POST['cs_client_section_title'][$cs_counter_clients])  && $_POST['cs_client_section_title'][$cs_counter_clients] != ''){
														$shortcode .= 	'cs_client_section_title="'.htmlspecialchars($_POST['cs_client_section_title'][$cs_counter_clients]).'" ';
													}
													if(isset($_POST['cs_client_border'][$cs_counter_clients])  && $_POST['cs_client_border'][$cs_counter_clients] != ''){
														$shortcode .= 	'cs_client_border="'.htmlspecialchars($_POST['cs_client_border'][$cs_counter_clients]).'" ';
													}
													if(isset($_POST['cs_client_gray'][$cs_counter_clients])  && $_POST['cs_client_gray'][$cs_counter_clients] != ''){
														$shortcode .= 	'cs_client_gray="'.htmlspecialchars($_POST['cs_client_gray'][$cs_counter_clients]).'" ';
													}		
													if(isset($_POST['cs_client_class'][$cs_counter_clients])  && $_POST['cs_client_class'][$cs_counter_clients] != ''){
														$shortcode .= 	'cs_client_class="'.htmlspecialchars($_POST['cs_client_class'][$cs_counter_clients], ENT_QUOTES).'" ';
													}		
													if(isset($_POST['cs_client_animation'][$cs_counter_clients])  && $_POST['cs_client_animation'][$cs_counter_clients] != ''){
														$shortcode .= 	'cs_client_animation="'.htmlspecialchars($_POST['cs_client_animation'][$cs_counter_clients]).'" ';
													}
													$shortcode .= 	']'.$shortcode_item.'[/cs_clients]';		
													$clients->addChild('cs_shortcode', $shortcode );
													$cs_counter_clients++;
												}
											$cs_global_counter_clients++;		
										}
										// Teams
										else if ( $_POST['cs_orderby'][$cs_counter] == "teams" ) {
													$shortcode = '';
													$team = $column->addChild('teams');
													$team->addChild('page_element_size', htmlspecialchars($_POST['teams_element_size'][$cs_global_counter_teams]) );
													$team->addChild('teams_element_size', htmlspecialchars($_POST['teams_element_size'][$cs_global_counter_teams]) );
													if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
														$shortcode_str = stripslashes ($_POST['shortcode']['teams'][$cs_shortcode_counter_teams]);
														$cs_shortcode_counter_teams++;
														$team->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
													} else {
														$shortcode = '[cs_team ';
														if(isset($_POST['cs_team_section_title'][$cs_counter_teams])  && $_POST['cs_team_section_title'][$cs_counter_teams] != ''){
															$shortcode .= 	'cs_team_section_title="'.htmlspecialchars($_POST['cs_team_section_title'][$cs_counter_teams], ENT_QUOTES).'" ';
														}		
														if(isset($_POST['cs_team_view'][$cs_counter_teams])  && $_POST['cs_team_view'][$cs_counter_teams] != ''){
															$shortcode .= 	'cs_team_view="'.htmlspecialchars($_POST['cs_team_view'][$cs_counter_teams]).'" ';
														}
														if(isset($_POST['cs_team_name'][$cs_counter_teams])  && $_POST['cs_team_name'][$cs_counter_teams] != ''){
															$shortcode .= 	'cs_team_name="'.htmlspecialchars($_POST['cs_team_name'][$cs_counter_teams], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_team_designation'][$cs_counter_teams])  && $_POST['cs_team_designation'][$cs_counter_teams] != ''){
															$shortcode .= 	'cs_team_designation="'.htmlspecialchars($_POST['cs_team_designation'][$cs_counter_teams]).'" ';
														}
														if(isset($_POST['cs_team_description'][$cs_counter_teams])  && $_POST['cs_team_description'][$cs_counter_teams] != ''){
															$shortcode .= 	'cs_team_description="'.htmlspecialchars($_POST['cs_team_description'][$cs_counter_teams], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_team_profile_image'][$cs_counter_teams])  && $_POST['cs_team_view'][$cs_counter_teams] != ''){
															$shortcode .= 	'cs_team_profile_image="'.htmlspecialchars($_POST['cs_team_profile_image'][$cs_counter_teams]).'" ';
														}
														if(isset($_POST['cs_team_fb_url'][$cs_counter_clients])  && $_POST['cs_team_fb_url'][$cs_counter_teams] != ''){
															$shortcode .= 	'cs_team_fb_url="'.htmlspecialchars($_POST['cs_team_fb_url'][$cs_counter_teams]).'" ';
														}
														if(isset($_POST['cs_team_twitter_url'][$cs_counter_clients])  && $_POST['cs_team_twitter_url'][$cs_counter_teams] != ''){
															$shortcode .= 	'cs_team_twitter_url="'.htmlspecialchars($_POST['cs_team_twitter_url'][$cs_counter_teams]).'" ';
														}
														if(isset($_POST['cs_team_googleplus_url'][$cs_counter_teams])  && $_POST['cs_team_googleplus_url'][$cs_counter_teams] != ''){
															$shortcode .= 	'cs_team_googleplus_url="'.htmlspecialchars($_POST['cs_team_googleplus_url'][$cs_counter_teams]).'" ';
														}
														if(isset($_POST['cs_team_skype_url'][$cs_counter_clients])  && $_POST['cs_team_skype_url'][$cs_counter_teams] != ''){
															$shortcode .= 	'cs_team_skype_url="'.htmlspecialchars($_POST['cs_team_skype_url'][$cs_counter_teams]).'" ';
														}
														if(isset($_POST['cs_team_email'][$cs_counter_clients])  && $_POST['cs_team_email'][$cs_counter_teams] != ''){
															$shortcode .= 	'cs_team_email="'.htmlspecialchars($_POST['cs_team_email'][$cs_counter_teams]).'" ';
														}
														if(isset($_POST['teams_class'][$cs_counter_teams])  && $_POST['teams_class'][$cs_counter_teams] != ''){
															$shortcode .= 	'teams_class="'.htmlspecialchars($_POST['teams_class'][$cs_counter_teams], ENT_QUOTES).'" ';
														}		
														if(isset($_POST['teams_animation'][$cs_counter_teams])  && $_POST['teams_animation'][$cs_counter_teams] != ''){
															$shortcode .= 	'teams_animation="'.htmlspecialchars($_POST['teams_animation'][$cs_counter_teams]).'" ';
														}
														$shortcode .= 	']';
														if(isset($_POST['cs_team_description'][$cs_counter_teams])  && $_POST['cs_team_description'][$cs_counter_teams] != ''){
															$shortcode .= 	htmlspecialchars($_POST['cs_team_description'][$cs_counter_teams], ENT_QUOTES);
														}
														$shortcode .= 	'[/cs_team]';
														$team->addChild('cs_shortcode', $shortcode );
														$cs_counter_teams++;
													}
												$cs_global_counter_teams++;	
										}
										// Save Twitter page element 
										else if ( $_POST['cs_orderby'][$cs_counter] == "tweets" ) {
													$shortcode = '';
													$tweet = $column->addChild('tweets');
													$tweet->addChild('page_element_size', htmlspecialchars($_POST['tweets_element_size'][$cs_global_counter_tweets]));
													$tweet->addChild('tweets_element_size', htmlspecialchars($_POST['tweets_element_size'][$cs_global_counter_tweets]));
													if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
														$shortcode_str = stripslashes ($_POST['shortcode']['tweets'][$cs_shortcode_counter_tweets]);
														$cs_shortcode_counter_tooltip++;
														$tweet->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
													} else {
														$shortcode = '[cs_tweets ';
														if(isset($_POST['cs_tweets_section_title'][$cs_counter_contactus]) && $_POST['cs_tweets_section_title'][$cs_counter_tweets] != ''){
															//$shortcode .= 	'cs_tweets_section_title="'.htmlspecialchars($_POST['cs_tweets_section_title'][$cs_counter_tweets]).'" ';
														}
														if(isset($_POST['cs_tweets_user_name'][$cs_counter_tweets]) && $_POST['cs_tweets_user_name'][$cs_counter_tweets] != ''){
															$shortcode .= 	'cs_tweets_user_name="'.htmlspecialchars($_POST['cs_tweets_user_name'][$cs_counter_tweets]).'" ';
														}
														if(isset($_POST['cs_tweets_color'][$cs_counter_tweets]) && $_POST['cs_tweets_color'][$cs_counter_tweets] != ''){
															$shortcode .= 	'cs_tweets_color="'.htmlspecialchars($_POST['cs_tweets_color'][$cs_counter_tweets]).'" ';
														}
														if(isset($_POST['cs_no_of_tweets'][$cs_counter_tweets]) && $_POST['cs_no_of_tweets'][$cs_counter_tweets] != ''){
															$shortcode .= 	'cs_no_of_tweets="'.htmlspecialchars($_POST['cs_no_of_tweets'][$cs_counter_tweets]).'" ';
														}
														if(isset($_POST['cs_tweets_class'][$cs_counter_tweets]) && $_POST['cs_tweets_class'][$cs_counter_tweets] != ''){
															$shortcode .= 	'cs_tweets_class="'.htmlspecialchars($_POST['cs_tweets_class'][$cs_counter_tweets], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_tweets_animation'][$cs_counter_tweets]) && $_POST['cs_tweets_animation'][$cs_counter_tweets] != ''){
															$shortcode .= 	'cs_tweets_animation="'.htmlspecialchars($_POST['cs_tweets_animation'][$cs_counter_tweets]).'" ';
														}
														$shortcode .= 	']';
														$tweet->addChild('cs_shortcode', $shortcode );
														$cs_counter_tweets++;
													}
												$cs_global_counter_tweets++;
										}
										// Content Slider
									  else if ( $_POST['cs_orderby'][$cs_counter] == "contentslider" ) {
													$shortcode = '';
													$contentslider = $column->addChild('contentslider');
													$contentslider->addChild('page_element_size', htmlspecialchars($_POST['contentslider_element_size'][$cs_global_counter_contentslider]) );
													$contentslider->addChild('contentslider_element_size', htmlspecialchars($_POST['contentslider_element_size'][$cs_global_counter_contentslider]) );
													if(isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode'){
														$shortcode_str = stripslashes ($_POST['shortcode']['contentslider'][$cs_shortcode_counter_contentslider]);
														$cs_shortcode_counter_contentslider++;
														$contentslider->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES) );
													} else {
														$shortcode = '[cs_contentslider ';
														if(isset($_POST['cs_contentslider_title'][$cs_counter_contentslider]) && $_POST['cs_contentslider_title'][$cs_counter_contentslider] != ''){
															$shortcode .= 	'cs_contentslider_title="'.htmlspecialchars($_POST['cs_contentslider_title'][$cs_counter_contentslider], ENT_QUOTES).'" ';
														}	
														if(isset($_POST['cs_contentslider_post_type'][$cs_counter_contentslider]) && $_POST['cs_contentslider_post_type'][$cs_counter_contentslider] != ''){
															$shortcode .= 	'cs_contentslider_post_type="'.htmlspecialchars($_POST['cs_contentslider_post_type'][$cs_counter_contentslider]).'" ';
																										}	
														if(isset($_POST['cs_contentslider_dcpt_cat'][$cs_counter_contentslider]) && $_POST['cs_contentslider_dcpt_cat'][$cs_counter_contentslider] != ''){
															$shortcode .= 	'cs_contentslider_dcpt_cat="'.htmlspecialchars($_POST['cs_contentslider_dcpt_cat'][$cs_counter_contentslider]).'" ';
														}	
														if(isset($_POST['cs_contentslider_orderby'][$cs_counter_contentslider]) && $_POST['cs_contentslider_orderby'][$cs_counter_contentslider] != ''){
															$shortcode .= 	'cs_contentslider_orderby="'.htmlspecialchars($_POST['cs_contentslider_orderby'][$cs_counter_contentslider]).'" ';
														}	
														if(isset($_POST['cs_contentslider_description'][$cs_counter_contentslider]) && $_POST['cs_contentslider_description'][$cs_counter_contentslider] != ''){
															$shortcode .= 	'cs_contentslider_description="'.htmlspecialchars($_POST['cs_contentslider_description'][$cs_counter_contentslider], ENT_QUOTES).'" ';
														}	
														if(isset($_POST['cs_contentslider_excerpt'][$cs_counter_contentslider]) && $_POST['cs_contentslider_excerpt'][$cs_counter_contentslider] != ''){
															$shortcode .= 	'cs_contentslider_excerpt="'.htmlspecialchars($_POST['cs_contentslider_excerpt'][$cs_counter_contentslider]).'" ';
																										}
														if(isset($_POST['cs_contentslider_num_post'][$cs_counter_contentslider]) && $_POST['cs_contentslider_num_post'][$cs_counter_contentslider] != ''){
															$shortcode .= 	'cs_contentslider_num_post="'.htmlspecialchars($_POST['cs_contentslider_num_post'][$cs_counter_contentslider]).'" ';
														}	
														if(isset($_POST['cs_contentslider_class'][$cs_counter_contentslider]) && $_POST['cs_contentslider_class'][$cs_counter_contentslider] != ''){
															$shortcode .= 	'cs_contentslider_class="'.htmlspecialchars($_POST['cs_contentslider_class'][$cs_counter_contentslider], ENT_QUOTES).'" ';
														}
														if(isset($_POST['cs_contentslider_animation'][$cs_counter_contentslider]) && $_POST['cs_contentslider_animation'][$cs_counter_contentslider] != ''){
															$shortcode .= 	'cs_contentslider_animation="'.htmlspecialchars($_POST['cs_contentslider_animation'][$cs_counter_contentslider]).'" ';
														}
														$shortcode .= 	']';
														$contentslider->addChild('cs_shortcode', $shortcode );
														$cs_counter_contentslider++;
												}
												$cs_global_counter_contentslider++;
									}
									// Course Search
									 //===Loops Short Code End	
											$cs_counter++;
								}
								$widget_no++;
							}
							$column_container_no++;
						}
					 }
					
					//$cs_tmp_fn = 'base'.'64_encode';
//					$new = call_user_func($cs_tmp_fn, serialize($sxe->asXML()));
					update_post_meta( $post_id, 'cs_page_builder', $sxe->asXML() );
					//exit;
				//creating xml page builder end
			}
		}
	}
//add_action( 'init', 'stop_heartbeat', 1 );
function stop_heartbeat() {
 wp_deregister_script('heartbeat');
}
?>