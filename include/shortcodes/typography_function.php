<?php
//=====================================================================
// Adding column start
//=====================================================================
if (!function_exists('cs_column_shortocde')) {
	function cs_column_shortocde($atts, $content = "") {
		$defaults = array('column_size'=>'1/1','flex_column_section_title'=>'','cs_column_class'=>'','cs_column_animation'=>'','cs_column_animation_duration'=>'1');
		extract( shortcode_atts( $defaults, $atts ) );
		$column_class = cs_custom_column_class($column_size);
		
		$section_title = '';
		if ( trim($cs_column_animation) !='' ) {
			$cs_column_animation	= 'wow'.' '.$cs_column_animation;
		} else {
			$cs_column_animation	= '';
		}
		
		if ( trim($cs_column_class) !='' ) {
			$cs_column_class_id = ' id="'.$cs_column_class.'"';
		}
		else{
			$cs_column_class_id = '';
		}
		
		if ($flex_column_section_title && trim($flex_column_section_title) !='') {
			$section_title	= '<div class="cs-section-title"><h2>'.$flex_column_section_title.'</h2></div>';
		}
	 
		$html = do_shortcode($content);
		return '<div class="'.$cs_column_animation.' '.$cs_column_class.' '.$column_class.'"'.$cs_column_class_id.'>'.$section_title.' '.$html.'</div>';
	}
	add_shortcode('cs_column', 'cs_column_shortocde');
}
// adding column end

//=====================================================================
// Adding Tooltip start
//=====================================================================
if (!function_exists('cs_tooltip_shortcode')) {
	function cs_tooltip_shortcode($atts, $content = "") {
		$defaults = array( 'column_size'=>'1/1','tooltip_hover_title' => '','tooltip_data_placement' => 'top','cs_tooltip_class'=>'', 'cs_tooltip_animation'=>'', 'cs_tooltip_animation_duration'=>'1');
		extract( shortcode_atts( $defaults, $atts ) );
		$column_class = cs_custom_column_class($column_size);
		$html = "<script>
			jQuery(document).ready(function($) {
				$('.tolbtn').tooltip('hide');
				$('.tolbtn').popover('hide')
			});
		</script>";
		if ( trim($cs_tooltip_animation) !='' ) {
			$cs_tooltip_animation	= ' wow'.' '.$cs_tooltip_animation;
		} else {
			$cs_tooltip_animation	= '';
		}
        
		$html .= '<div class="tooltip-info">'.do_shortcode($content).'</div>
		<span class="tolbtn btn-default custom-btn" data-toggle="tooltip" data-placement="'.$tooltip_data_placement.'" title="'.$tooltip_hover_title.'" style="background-color:#fff; color:#333; box-shadow:0px 4px 4px -2px rgba(0, 0, 0, 0.5);">'.$tooltip_hover_title.'</span>';
					
		return do_shortcode('<div class="'.$column_class.$cs_tooltip_animation.'">'.$html.'</div>');
	}

	add_shortcode('cs_tooltip', 'cs_tooltip_shortcode');
}
// adding Tooltip end

//=====================================================================
// Adding dropcap start
//=====================================================================
if (!function_exists('cs_dropcap_shortcode')) {
	function cs_dropcap_shortcode($atts, $content = "") {
		$defaults = array( 'column_size' => '1/1', 'cs_dropcap_section_title' => '', 'dropcap_style' => 'dropcap','dropcap_bg_color' => '','dropcap_color' => '','dropcap_size' => '', 'cs_dropcap_class'=>'', 'cs_dropcap_animation'=>'', 'cs_dropcap_animation_duration'=>'1');
		extract( shortcode_atts( $defaults, $atts ) );
		$randomID = rand(0, 999);
		$column_class 			= cs_custom_column_class($column_size);
		$dropcap_style_class 	= '';
		$dropcap_css 	= '';

		$font_size				= $dropcap_size ? $dropcap_size : '40';
		$bg_color				= $dropcap_bg_color ? $dropcap_bg_color : '';
		

		$html = '';
		$section_title = '';
		if ( trim($cs_dropcap_animation) !='' ) {
			$cs_dropcap_animation	= 'wow'.' '.$cs_dropcap_animation;
		} else {
			$cs_dropcap_animation	= '';
		}
		if ($cs_dropcap_section_title && trim($cs_dropcap_section_title) !='') {
			$section_title = '<div class="cs-section-title"><h2 class="'.$cs_dropcap_animation.'">'.$cs_dropcap_section_title.'</h2></div>';
		}
		if(isset($dropcap_style) && $dropcap_style == 'box'){		
       		$dropcap_style_class = 'dropcap-one';
			$html .= '<style scoped="scoped">
					.dropcap-'.$randomID.' P:first-letter {
						border: 5px solid '.$dropcap_color.';
						color: '.$dropcap_color.';
						background-color: '.$bg_color.';
						font-size: '.$font_size.'px !important;
						float: left;
						font-weight: 400;
						margin: 0 20px 0 0;
						padding: 15px;
					}
				 </style>';
		}
		else{
			$dropcap_style_class = 'dropcap-two';
			$html .= '<style scoped="scoped">
					.dropcap-'.$randomID.' P:first-letter {
						color: '.$dropcap_color.';
						background-color: '.$bg_color.';
						font-size: '.$font_size.'px !important;
						font-weight: 400;
						float: left;
						margin: 0 15px 0 0;
						padding: 8px 0 0;
					}
				 </style>';
		}
		if($cs_dropcap_class <> ''){
			$drop_cap_id = ' id="'.$cs_dropcap_class.'"';
		}
		else{
			$drop_cap_id = '';
		}
				
		$html .= '<div class="'.$column_class.'">'.$section_title.'<div class="'.$dropcap_style_class . ' '.$cs_dropcap_class.' '.$cs_dropcap_animation.' dropcap-'.$randomID.'"'.$drop_cap_id.'><p>'.do_shortcode($content).'</p></div></div>';
		
		
		return $html;
		
		
	}
	add_shortcode('cs_dropcap', 'cs_dropcap_shortcode');
}
// adding dropcap end

//=====================================================================
// Diveder Shortcode Start
//=====================================================================
if (!function_exists('cs_divider_shortcode')) {
	function cs_divider_shortcode($atts) {
		$defaults = array( 'column_size' => '1/1', 'divider_style' => 'crossy','divider_height' => '1','divider_backtotop' => '','divider_margin_top' => '','divider_margin_bottom' =>'','line' => 'Wide','color'=>'#000', 'cs_divider_class'=>'','cs_divider_animation'=>'','cs_divider_animation_duration' => '1');
		extract( shortcode_atts( $defaults, $atts ) );
		
		$column_class = cs_custom_column_class($column_size);
		
		$html = '';
		$backtotop = '';
		if ( trim($cs_divider_animation) !='' ) {
			$cs_divider_animation	= 'wow'.' '.$cs_divider_animation;
		} else {
			$cs_divider_animation	= '';
		}
		if ($divider_backtotop == 'yes' ){
			$backtotop = '<span class="backtotop"><a class="btn-back-top btnnext" href="#"><i class="fa fa-angle-up"></i></a></span>';
		}
		
		if($divider_style == 'crossy'){
			$divider_style_class = 'cs-seprator';
			$div_html = '<div class="devider1"></div>';
		}
		else if($divider_style == 'plain'){
			$divider_style_class = 'cs-seprator';
			$div_html = '<div class="devider2"></div>';
		}
		else if($divider_style == 'zigzag'){
			$divider_style_class = 'cs-seprator';
			$div_html = '<div class="devider3"></div>';
		}
		else if($divider_style == 'small-zigzag'){
			$divider_style_class = 'cs-seprator';
			$div_html = '<div class="divider5"></div>';
		}
		else{
			$divider_style_class = 'spreater';
			$div_html = '<div class="spreater-holder">
							<span></span>
							<span></span>
							<span></span>
						</div>';
		}
		
		$cs_divider_class_id = '';
		if($cs_divider_class <> ''){
			$cs_divider_class_id = ' id="'.$cs_divider_class.'"';
		}
		
		$html = '<div class="'.$column_class.' '.$cs_divider_class.' '.$cs_divider_animation.'"'.$cs_divider_class_id.' style="animation-duration: '.$cs_divider_animation_duration.'s; margin-top:'.$divider_margin_top.'px; margin-bottom:'.$divider_margin_bottom.'px;height: '.$divider_height.'px;">';
					if($divider_style == '3box'){
					$html .= '<div class="box_spreater" >';
					}
					$html .= '
					<div class="'.$divider_style_class.'" >
						'.$div_html;
						if($divider_style != '3box'){
						$html .= $backtotop;
						}
					$html .= '
					</div>';
					if($divider_style == '3box'){
					$html .= $backtotop;
					$html .= '</div>';
					}
					$html .= '
					
				 </div>';
		
		return do_shortcode($html);
	}
	add_shortcode('cs_divider', 'cs_divider_shortcode');
}
// Diveder Shortcode end

//=====================================================================
// Quote Shortcode Shortcode Start
//=====================================================================
if (!function_exists('cs_quote_shortcode')) {
	function cs_quote_shortcode( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'column_size' => '1/1',
			'quote_style' => 'default',
			'cs_quote_section_title' => '',
			'quote_cite'   => '',
			'quote_cite_url'   => '#',
			'quote_text_color'   => '',
			'quote_align'   => 'center',
			'cs_quote_class'   => '',
			'cs_quote_animation_duration'   => '1',
			'cs_quote_animation'   => ''
	    ), $atts));
		$author_name = '';
		$html		 = '';
		
		$column_class = cs_custom_column_class($column_size);
		
		if ( trim($cs_quote_animation) !='' ) {
			$cs_quote_animation	= 'wow'.' '.$cs_quote_animation;
		} else {
			$cs_quote_animation	= '';
		}
		$customId	= '';
		if ( trim($cs_quote_class) !='' ) {
			$customId	= 'id="'.$cs_quote_class.'"';
		} else {
			$customId	= '';
		}
		
		
		if(isset($quote_cite) && $quote_cite <> ''){
			$author_name .= '<div class="cs-auther-name"><span>';
			if(isset($quote_cite_url) && $quote_cite_url <> ''){
				$author_name .= '<a href="'.esc_url($quote_cite_url).'">';
			}
			$author_name .= '- '.$quote_cite;
			if(isset($quote_cite_url) && $quote_cite_url <> ''){
				$author_name .= '</a>';
			}
			
			$author_name .= '</span></div>';
		}
		
		if(isset($quote_align)){
			if($quote_align == 'left') $quote_align = 'text-left-align';
			if($quote_align == 'right') $quote_align = 'text-right-align';
			if($quote_align == 'center') $quote_align = 'text-center-align';
		}
		
		$section_title = '';
		if ($cs_quote_section_title && trim($cs_quote_section_title) !='') {
			$section_title = '<div class="cs-section-title"><h2 class="'.$cs_quote_animation.'">'.$cs_quote_section_title.'</h2></div>';
		}
		
		$html	.= '<blockquote class="'.$cs_quote_class.' '.$quote_align.' '.$cs_quote_animation.'" '.$customId.'  style="animation-duration: '.$cs_quote_animation_duration.'s; color:'.$quote_text_color.'">' . do_shortcode($content) . $author_name .'</blockquote>';
		
		return '<div class="'.$column_class.'">'.$section_title.$html.'</div>';
	}
	add_shortcode('cs_quote', 'cs_quote_shortcode');
}
// Quote Shortcode Shortcode End

//=====================================================================
// Adding hightlight start
//=====================================================================
if (!function_exists('cs_hightlight_shortcode')) {
	function cs_hightlight_shortcode($atts, $content = "") {
		$defaults = array( 'highlight_bg_color' => '','highlight_color' => '','cs_highlight_class' => '','cs_highlight_animation'=>'','cs_highlight_animation_duration'   => '10');
		extract( shortcode_atts( $defaults, $atts ) );
		
		if ( trim($cs_highlight_animation) !='' ) {
			$cs_highlight_animation	= 'wow'.' '.$cs_highlight_animation;
		} else {
			$cs_highlight_animation	= '';
		}
		$cs_highlight_class_id = '';
		if($cs_highlight_class_id <> ''){
			$cs_highlight_class_id = ' id="'.$cs_highlight_class.'"';
		}
		
		$html = '<mark'.$cs_highlight_class_id.' style="background:'.$highlight_bg_color.'; color:'.$highlight_color.'; animation-duration: '.$cs_highlight_animation_duration.'s;" class="highlights '.$cs_highlight_class.' '.$cs_highlight_animation.'">'.$content.'</mark>';
		return do_shortcode($html);
	}
	add_shortcode('cs_highlight', 'cs_hightlight_shortcode');
}
// adding hightlight end

//=====================================================================
// Adding heading start
//=====================================================================
if (!function_exists('cs_heading_shortcode')) {
	function cs_heading_shortcode($atts, $content = "") {
		$defaults = array( 'column_size'=>'1/1','heading_title' => '','color_title'=>'','heading_color' => '#000', 'class'=>'cs-heading-shortcode', 'heading_style'=>'1','heading_style_type'=>'1', 'heading_size'=>'', 'font_weight'=>'', 'heading_font_style'=>'', 'heading_align'=>'center', 'heading_divider'=>'', 'heading_color' => '', 'heading_content_color' => '', 'heading_animation'=>'');
		extract( shortcode_atts( $defaults, $atts ) );
		$column_class = cs_custom_column_class($column_size);
		$html = '';
		$css = '';
		
		$he_font_style = '';
		if($heading_font_style <> ''){
			$he_font_style = ' font-style:'.$heading_font_style;
		}
		
		echo balanceTags($css, false);
		$html .= '<div  class="'.$heading_animation.'" >';
			if($heading_title <> ''){
				if($color_title<>''){
					$color_title ='&nbsp;<span class="cs-color">'.$color_title.'</span>';
				}
				$html .= '<h'.$heading_style.' style="color:'.$heading_color.' !important; font-size: '.$heading_size.'px !important; text-align: '.$heading_align.';'.$he_font_style.';">'.$heading_title.$color_title.'</h'.$heading_style.'>';
				
			}
			if($heading_divider == 'on'){
				$html	.= '<div class="box_spreater"><div class="spreater" style="text-align: '.$heading_align.';"><div class="box_spreater" ><div class="spreater-holder"><span></span><span></span><span></span></div></div></div></div>';
			}
			if($content <> ''){
				$html	.= '<div class="heading-description" style="color:'.$heading_content_color.' !important; text-align: '.$heading_align.';'.$he_font_style.';">'.do_shortcode($content).'</div>';
		
			}
		$html .= '</div>';
		return do_shortcode($html);
	}
	add_shortcode('cs_heading', 'cs_heading_shortcode');
}
// adding heading end

//=====================================================================
// Adding list start
//=====================================================================
if (!function_exists('cs_list_shortcode')) {
	function cs_list_shortcode($atts, $content = "") {
		global $cs_border,$cs_list_type;
		$defaults = array('column_size'=>'','cs_list_section_title'=>'','cs_list_type'=>'','cs_list_icon'=>'','cs_border'=>'','cs_list_item'=>'','cs_list_class'=>'','cs_list_animation'=>'','cs_list_animation_duration'=>'1');
		extract( shortcode_atts( $defaults, $atts ) );
		$customID = '';
		if ( isset( $column_size ) && $column_size !='' ) {
			$column_class = cs_custom_column_class($column_size);
		} else {
			$column_class = '';
		}
		
		if ( isset( $cs_list_class ) && $cs_list_class !='' ) {
			$customID = 'id="'.$cs_list_class.'"';
		}
		
		$html	 = "";
		$cs_list_typeClass	= '';
		$section_title = '';
		if ($cs_list_section_title && trim($cs_list_section_title) !='' ) {
			$section_title	= '<div class="cs-section-title"><h2>'.$cs_list_section_title.'</h2></div>';
		}
		
		$cs_list_type	= $cs_list_type ? $cs_list_type : 'cs-bulletslist';
		
		if ($cs_list_type == 'none'){
			$cs_list_typeClass	= 'cs-unorderedlist';
		} else if ($cs_list_type == 'icon'){
			$cs_list_typeClass	= 'cs-iconlist';
		} else if ($cs_list_type == 'built'){
			$cs_list_typeClass	= 'cs-bulletslist';
		} else if ($cs_list_type == 'decimal'){
			$cs_list_typeClass	= 'cs-number-list';
		} else if ($cs_list_type == 'alphabatic'){
			$cs_list_typeClass	= 'cs-upper-alphalist';
		} else if ($cs_list_type == 'numeric-icon'){
			$cs_list_typeClass	= 'cs-num-iconlist';
		}

		$html	.= '<div '.$customID.' class="'.$column_class.' '.$cs_list_animation.' '.$cs_list_class.'">';
		$html	.= $section_title;
		$html	.= '<div class="liststyle">';
		$html	.= '<ul class="' .$cs_list_typeClass. '">';
		$html	.= do_shortcode($content);
		$html	.= '</ul>';
		$html	.= '</div>';
		$html	.= '</div>';
		return $html;
	}
	add_shortcode('cs_list', 'cs_list_shortcode');
}

//=====================================================================
// Adding list item start
//=====================================================================
if (!function_exists('cs_list_item_shortcode')) {
	function cs_list_item_shortcode($atts, $content = "") {
		global $cs_border,$cs_list_type;
		$html='';
		$defaults = array('cs_list_icon'=>'','cs_list_item'=>'','cs_cusotm_class'=>'','cs_custom_animation'=>'','cs_custom_animation'=>'');
		extract( shortcode_atts( $defaults, $atts ) );
		
		if ($cs_border == 'yes') {
			$border	= 'has_border';
		} else {
			$border	= '';
		}
		
		if ($cs_list_icon && $cs_list_type == 'icon' ) {
			$html	.= '<li class="'.$border.'"><i class="fa '.$cs_list_icon.'"></i>' .do_shortcode($content). '</li>'; 
		} 
		else if ($cs_list_icon && $cs_list_type == 'numeric-icon' ) {
			$html	.= '<li class="'.$border.'">' .do_shortcode($content). '<i class="cs-color fa '.$cs_list_icon.'"></i></li>'; 
		} 
		else {
			$html	.= '<li class="'.$border.'">' .do_shortcode($content). '</li>';
		}
		
		return $html;
	}
	add_shortcode('list_item', 'cs_list_item_shortcode');
}
// adding list item end

//=====================================================================
// Adding Contact Us Form start
//=====================================================================
if (!function_exists('cs_contactus_shortcode')) {
	function cs_contactus_shortcode($atts, $content = "") {
		$defaults = array( 'column_size' => '1/1', 'cs_contactus_section_title' => '', 'cs_contactus_label' => '', 'cs_contactus_view' => '','cs_contactus_send' => '','cs_success' => '','cs_error' => '','cs_contact_class' => '','cs_contact_animation' => '','cs_contact_animation_duration'=>'1');
		extract( shortcode_atts( $defaults, $atts ) );
		$column_class	= cs_custom_column_class($column_size);
		$cs_email_counter 	= cs_generate_random_string(3);
		$html 	 = '';
		$class	 = '';
		$section_title = '';
		
		if ($cs_contactus_section_title && trim($cs_contactus_section_title) !='') {
			$section_title	= '<div class="cs-section-title"><h2 class="'.$cs_contact_animation.'">'.$cs_contactus_section_title.'</h2></div>';
		}
			 
		if (trim($cs_success) && trim($cs_success) !='') {
			$success	= $cs_success;
		} else {
			$success	= 'Email has been sent Successfully.';
		}
		
		if (trim($cs_error) && trim($cs_error) !='') {
			$error	= $cs_error;
		} else {
			$error	= 'An error Occured, please try again later.';
		}
		
		if (trim($cs_contactus_view) == 'plain') {
			$view_class	= 'cs-plan';
		} else {
			$view_class	= '';
		}

		?>
        <script type="text/javascript">
			function frm_submit<?php echo esc_js($cs_email_counter);?>(){
				
				var $ = jQuery;
				$("#loading_div<?php echo esc_js($cs_email_counter);?>").html('<img src="<?php echo esc_js(esc_url(get_template_directory_uri()));?>/assets/images/ajax-loader.gif" alt="" />');
				$("#loading_div<?php echo esc_js($cs_email_counter);?>").show();
				$("#message<?php echo esc_js($cs_email_counter);?>").html('');
				var datastring =$('#frm<?php echo esc_js($cs_email_counter);?>').serialize() +"&cs_contact_email=<?php echo esc_js($cs_contactus_send);?>&cs_contact_succ_msg=<?php echo esc_js($success);?>&cs_contact_error_msg=<?php echo esc_js($error);?>&action=cs_contact_form_submit";

				$.ajax({
					type:'POST', 
					url: '<?php echo esc_js(esc_url(admin_url('admin-ajax.php')));?>',
					data: datastring, 
					dataType: "json",
					success: function(response) {
						
						if (response.type == 'error'){
							$("#loading_div<?php echo esc_js($cs_email_counter);?>").html('');
							$("#loading_div<?php echo esc_js($cs_email_counter);?>").hide();
							$("#message<?php echo esc_js($cs_email_counter);?>").addClass('error_mess');
							$("#message<?php echo esc_js($cs_email_counter);?>").show();
							$("#message<?php echo esc_js($cs_email_counter)?>").html(response.message);
						} else if (response.type == 'success'){
							$("#frm<?php echo esc_js($cs_email_counter);?>").slideUp();
							$("#loading_div<?php echo esc_js($cs_email_counter);?>").html('');
							$("#loading_div<?php echo esc_js($cs_email_counter);?>").hide();
							$("#message<?php echo esc_js($cs_email_counter);?>").addClass('succ_mess');
							$("#message<?php echo esc_js($cs_email_counter)?>").show();
							$("#message<?php echo esc_js($cs_email_counter);?>").html(response.message);
						}
						
					}
				});
			}
    	 </script>
        <?php 
		
		if ( trim($cs_contact_animation) !='' ) {
			$cs_contact_animation	= 'wow'.' '.$cs_contact_animation;
		} else {
			$cs_contact_animation	= '';
		}
		
		
		$html	.= '<div class="'.$cs_contact_animation.' '.$cs_contact_class.' cs_form_styling">';
		$html	.= '<div class="form-style" id="contact_form'.$cs_email_counter.'">';
		$html	.= '<form id="frm'.$cs_email_counter.'" name="frm'.$cs_email_counter.'" method="post" action="javascript:frm_submit'.$cs_email_counter.'(\''.admin_url("admin-ajax.php").'\');" >';
		
		if ( isset( $cs_contactus_label ) && $cs_contactus_label == 'on' ) {
			$html	.= '<label>Enter Your Name</label>';
		}
		
		$html	.= '<input type="text" name="contact_name" onfocus="if(this.value == \'Full Name\') { this.value = \'\'; }" onblur="if(this.value == \'\') { this.value = \'Full Name\'; }" value="Full Name" class="'.$class.' '.$view_class.'" required />';
		
		if ( isset( $cs_contactus_label ) && $cs_contactus_label == 'on' ) {
			$html	.= '<label>Enter Your Email Address</label>';
		}
		
		$html	.= '<input type="email" name="contact_email" onfocus="if(this.value == \'example@example.com\') { this.value = \'\'; }" onblur="if(this.value == \'\') { this.value = \'example@example.com\'; }" value="example@example.com" class="'.$class.' '.$view_class.'" required />';
		
		if ( isset( $cs_contactus_label ) && $cs_contactus_label == 'on' ) {
			$html	.= '<label>Enter Subject</label>';
		}
		
		$html	.= '<input type="text" name="subject" onfocus="if(this.value == \'Subject\') { this.value = \'\'; }" onblur="if(this.value == \'\') { this.value = \'Subject\'; }" value="Subject" class="'.$class.' '.$view_class.'" required />';
		
		if ( isset( $cs_contactus_label ) && $cs_contactus_label == 'on' ) {
			$html	.= '<label>Message</label>';
		}
		
		$html	.= '<textarea class="'.$class.' '.$view_class.'" placeholder="Message" name="contact_msg" required></textarea>';
		$html	.= '<input type="submit" value="Submit Now" class="custom-btn cs-bg-color" id="submit_btn'.$cs_email_counter.'">';
		$html	.= '</form>';
		$html	.= '<div id="loading_div'.$cs_email_counter.'"></div>';
		$html	.= '<div id="message'.$cs_email_counter.'"  style="display:none;"></div>';
		$html	.= '</div>';
		$html	.= '</div>';
		
		$cs_contact_class_id = '';
		if($cs_contact_class <> ''){
			$cs_contact_class_id = ' id="'.$cs_contact_class.'"';
		}
		return '<div class="'.$column_class.'"'.$cs_contact_class_id.'>'.$section_title.$html.'</div>';
	}
	add_shortcode('cs_contactus', 'cs_contactus_shortcode');
}
// adding Contact Us Form  End

//=====================================================================
// Adding message start
//=====================================================================
if (!function_exists('cs_message_shortcode')) {
	function cs_message_shortcode($atts, $content = "") {
		$defaults = array( 'column_size' => '1/1', 'cs_msg_section_title' => '', 'cs_message_title' => '','cs_message_type' => '','cs_alert_style' => '','cs_style_type' => '', 'cs_message_icon' => '','cs_title_color' => '','cs_message_box_title' => '','cs_background_color' => '','cs_text_color' => '','cs_button_text' => '','cs_button_link' => '','cs_icon_color' => '','cs_message_close' => '','cs_message_class' => '','cs_message_animation' => '','cs_message_animation_duration' => '');
		extract( shortcode_atts( $defaults, $atts ) ); 
		$html = '';
		$column_class	= cs_custom_column_class($column_size);
		$section_title = '';
		
		if ( trim($cs_message_animation) !='' ) {
			$cs_message_animation	= ' wow'.' '.$cs_message_animation;
		} else {
			$cs_message_animation	= '';
		}
		
		if ($cs_msg_section_title && trim($cs_msg_section_title) !='' ) {
			$html .= '<div class="cs-section-title"><h2>'.$cs_msg_section_title.'</h2></div>';
		}

		if(isset($cs_message_type) && $cs_message_type == 'alert'){
			if(isset($cs_style_type) && $cs_style_type == 'fancy'){
				$html .= '
				<div class="messagebox cs-dearktheme has-radius alert alert-info align-left" style=" background-color:'.$cs_background_color.'; border:1px solid '.$cs_background_color.';">';
				if(isset($cs_message_close) && $cs_message_close == 'yes'){
				$html .= '<button data-dismiss="alert" class="close-v1" type="button"><em class="fa fa-times"></em></button>';
				}
				if(isset($cs_message_icon) && $cs_message_icon <> ''){
				$html .= '<i style="color:'.$cs_icon_color.';" class="fa '.$cs_message_icon.'"></i>';
				}
				$html .= '
				<span style="color:'.$cs_text_color.';">'.do_shortcode($cs_message_title).'<a>'.do_shortcode($content).'</a></span> 
				</div>';
			}
			else{
				$html .= '
				<div class="messagebox messagebox-v1 has-radius alert alert-info align-left no_border" style=" background:'.$cs_background_color.';">';
				if(isset($cs_message_close) && $cs_message_close == 'yes'){
				$html .= '<button data-dismiss="alert" class="close-v1" type="button"><em class="fa fa-times"></em></button>';
				}
				if(isset($cs_message_icon) && $cs_message_icon <> ''){
				$html .= '<i style="color:'.$cs_icon_color.';" class="fa '.$cs_message_icon.'"></i>';
				}
				$html .= '
				<span style="color:'.$cs_text_color.';">'.do_shortcode($cs_message_title).'<a>'.do_shortcode($content).'</a></span> 
				</div>';
			}
		}
		else{
			$html .= '
			<div style="background:'.$cs_background_color.';  box-shadow:0px 4px 3px 0px #e0e0e0; margin-bottom:25px;" class="messagebox-v3 alert alert-info has_pattern icon_position_left no_border">';
				if(isset($cs_message_close) && $cs_message_close == 'yes'){
				$html .= '<button data-dismiss="alert" class="close-v2" type="button"><em class="fa fa-times"></em></button>';
				}
				if(isset($cs_message_icon) && $cs_message_icon <> ''){
				$html .= '<i style="color:'.$cs_icon_color.';" class="fa fa-cog"></i>';
				}
				if(isset($cs_message_box_title) && $cs_message_box_title <> ''){
				$html .= '<h6 style="color:'.$cs_title_color.';">'.do_shortcode($cs_message_box_title).'</h6>';
				}
				$html .= '<p style="color:'.$cs_text_color.';">'.do_shortcode($content).'</p>';
				if(isset($cs_button_text) && $cs_button_text <> ''){
				$html .= '<button class="custom-btn cs-bg-color" onclick="javascript:location.href=\''.$cs_button_link.'\'">'.$cs_button_text.'</button>';
				}
			$html .= '
			</div>';
		}
		
		$cs_message_class_id = '';
		if($cs_message_class <> ''){
			$cs_message_class_id = ' id="'.$cs_message_class.'"';
		}
		return do_shortcode('<div class="'.$column_class.$cs_message_animation.'"'.$cs_message_class_id.'>'.$html.'</div>');
	}
	add_shortcode('cs_message', 'cs_message_shortcode');
}
// adding message end

//=====================================================================
// Adding Testimonial start
//=====================================================================
if (!function_exists('cs_testimonials_shortcode')) {
	function cs_testimonials_shortcode( $atts, $content = null ) {
		global $testimonial_style,$cs_testimonial_class,$column_class,$testimonial_text_color,$section_title;
		$randomid = rand(0,999);
		//cs_owl_carousel();
		$defaults = array('column_size'=>'1/1','testimonial_style'=>'','testimonial_text_color'=>'','cs_testimonial_text_align'=>'','cs_testimonial_section_title'=>'','cs_testimonial_class'=>'','cs_testimonial_animation'=>'','cs_testimonial_animation_duration' => '');
		extract( shortcode_atts( $defaults, $atts ) );
		$column_class = cs_custom_column_class($column_size);
		$html = '';
		$section_title = '';
		
		if ( trim($cs_testimonial_animation) !='' ) {
			$cs_testimonial_animation	= ' wow'.' '.$cs_testimonial_animation;
		} else {
			$cs_testimonial_animation	= '';
		}
		
		if ($cs_testimonial_section_title && trim($cs_testimonial_section_title) !='' ) {
			$section_title	= '<div class="cs-section-title"><h2>'.$cs_testimonial_section_title.'</h2></div>';
		}
		if ( function_exists( 'cs_enqueue_flexslider_script' ) ) {
			//add_action( 'wp_enqueue_scripts', 'cs_enqueue_flexslider_script' );
			cs_enqueue_flexslider_script();
		}
		//cs_enqueue_flexslider_script();
		?>
		<script type='text/javascript'>
			jQuery(document).ready(function(){
				jQuery("#cs-testimonial-<?php echo cs_allow_special_char($randomid); ?>").flexslider({
					animation: 'fade',
					slideshow: true,
					controlNav: true,
					directionNav: false,
					slideshowSpeed: 7000,
					animationDuration: 600,
					prevText:"<em class='fa fa-arrow-left'></em>",
					nextText:"<em class='fa fa-arrow-right'></em>",
					start: function(slider) {
						jQuery('.cs-testimonial').fadeIn();
					}
				});
			});
		</script>
		<?php
		if(isset($testimonial_style) && $testimonial_style == 'fancy'){
			$html .= '
			' .$section_title. '
			<div id="cs-testimonial-'.cs_allow_special_char($randomid).'" class="flexslider cs-testimonial '.$cs_testimonial_text_align.'">
				
				<ul class="slides">
				' . do_shortcode( $content ) . ' 
				</ul>
			</div>';
		}
		else if(isset($testimonial_style) && $testimonial_style == 'slider'){
			
			$html .= '
			' .$section_title. '
			<div id="cs-testimonial-'.cs_allow_special_char($randomid).'" class="flexslider cs-testimonial '.$cs_testimonial_text_align.'">
				
				<ul class="slides">
				' . do_shortcode( $content ) . ' 
				</ul>
			</div>';
		}
		else{
			$html .= '
			' .$section_title. '
			<div id="cs-testimonial-'.cs_allow_special_char($randomid).'" class="flexslider cs-testimonial '.$cs_testimonial_text_align.'">
				<ul class="slides">
				' . do_shortcode( $content ) . '
				</ul> 
			</div>';
		}
		
		return '<div class="'.$column_class.$cs_testimonial_animation.'">'.$html.'</div>';
	}
	add_shortcode( 'cs_testimonials', 'cs_testimonials_shortcode' );
}
// adding Testimonial end

//=====================================================================
// Adding Testimonial Item start
//=====================================================================
if (!function_exists('cs_testimonial_item')) {
	function cs_testimonial_item( $atts, $content = null ) {
		global $testimonial_style,$cs_testimonial_class,$column_class,$testimonial_text_color;
		$defaults = array('testimonial_author' =>'','testimonial_img' => '','cs_testimonial_text_align'=>'','testimonial_company' => '');
		extract( shortcode_atts( $defaults, $atts ) );
		$figure = '';
		
		if(isset($testimonial_img) && $testimonial_img <> ''){
			$figure = '<figure><img src="'.$testimonial_img.'" alt="" /></figure>';
		}
		$tc_color = '';
		if(isset($testimonial_text_color) && $testimonial_text_color <> ''){
			$tc_color = 'style=color:'.$testimonial_text_color.'!important';
		}
		
		if(isset($testimonial_style) && $testimonial_style == 'fancy'){
			
	   return '<li>
	   		<article style="text-align:'.$cs_testimonial_text_align.';">
				<div class="question-mark">
				<p '.$tc_color.'><span>'. do_shortcode( $content ) .'</span></p>
				'.$figure.'
				   	<h4 class="cs-author">'.$testimonial_author.'<br>
					  <span>'.$testimonial_company.'</span>
					</h4>
				</div>
			</article>
			</li>';
		
		} else if(isset($testimonial_style) && $testimonial_style == 'slider'){
			return '<li>
					<div class="content-info">
					<article>
						<div class="question-mark">
						<p '.$tc_color.'>'. do_shortcode( $content ) .'</p>
						'.$figure.'
							<h4 class="cs-author">'.$testimonial_author.'<br>
							  <span>'.$testimonial_company.'</span>
							</h4>
						</div>
					</article>
					</div>
					</li>';
		} else {
			
			 return '<li>
			 		<article>
						<div class="question-mark">
						<p '.$tc_color.'>'. do_shortcode( $content ) .'</p>
						'.$figure.'
							<h4 class="cs-author">'.$testimonial_author.'<br>
							  <span>'.$testimonial_company.'</span>
							</h4>
						</div>
					</article></li>';
		} 
	}
	add_shortcode( 'testimonial_item', 'cs_testimonial_item' );
}
// adding Testimonial Item end