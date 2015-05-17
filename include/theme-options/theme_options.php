<?php
// Theme option function
if ( ! function_exists( 'cs_options_page' ) ) {
	function cs_options_page(){
		global $cs_theme_options,$options;
		$cs_theme_options=get_option('cs_theme_options');
	?>
		<div class="theme-wrap fullwidth">
			<div class="inner">
				<div class="outerwrapp-layer">
					<div class="loading_div">
						<i class="fa fa-circle-o-notch fa-spin"></i>
						<br>
						<?php esc_html_e('Saving changes...','Awaken');?>
					</div>
					<div class="form-msg">
						<i class="fa fa-check-circle-o"></i>
						<div class="innermsg"></div>
					</div>
				</div>
				<div class="row">   
					<form id="frm" method="post">
						<?php 
							$theme_options_fields = new theme_options_fields();
							$return = $theme_options_fields->cs_fields($options);
						?>
						<div class="col1">
							<nav class="admin-navigtion">
								<div class="logo">
									<a href="#" class="logo1"><img src="<?php echo get_template_directory_uri()?>/include/assets/images/logo-themeoption.png" /></a>
									<a href="#" class="nav-button"><i class="fa fa-align-justify"></i></a>
								</div>
								<ul>
									<?php  echo force_balance_tags($return[1],true); ?>
								</ul>
							</nav>
						</div>
						<div class="col2">
							<?php  echo force_balance_tags($return[0],true); /* Settings */ ?>
						</div>
						<div class="clear"></div>
						<div class="footer">
							<input type="button" id="submit_btn" name="submit_btn" class="bottom_btn_save" value="Save All Settings" onclick="javascript:theme_option_save('<?php echo admin_url('admin-ajax.php')?>', '<?php echo get_template_directory_uri();?>');" />
							<input type="hidden" name="action" value="theme_option_save"  />
							<input class="bottom_btn_reset" name="reset" type="button" value="Reset All Options"  
							onclick="javascript:cs_rest_all_options('<?php echo esc_js(admin_url('admin-ajax.php'))?>', '<?php echo esc_js(get_template_directory_uri())?>');" />
						</div>
				  </form>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<!--wrap-->
		<script type="text/javascript">
			// Sub Menus Show/hide
			jQuery(document).ready(function($) {
				jQuery(".sub-menu").parent("li").addClass("parentIcon");
				$("a.nav-button").click(function() {
					$(".admin-navigtion").toggleClass("navigation-small");
				});
				
				$("a.nav-button").click(function() {
					$(".inner").toggleClass("shortnav");
				});
				
				$(".admin-navigtion > ul > li > a").click(function() {
					var a = $(this).next('ul')
					$(".admin-navigtion > ul > li > a").not($(this)).removeClass("changeicon")
					$(".admin-navigtion > ul > li ul").not(a) .slideUp();
					$(this).next('.sub-menu').slideToggle();
					$(this).toggleClass('changeicon');
				});
			});
			
			function show_hide(id){
				var link = id.replace('#', '');
				jQuery('.horizontal_tab').fadeOut(0);
				jQuery('#'+link).fadeIn(400);
			}
			
			function toggleDiv(id) { 
				jQuery('.col2').children().hide();
				jQuery(id).show();
				location.hash = id+"-show";
				var link = id.replace('#', '');
				jQuery('.categoryitems li').removeClass('active');
				jQuery(".menuheader.expandable") .removeClass('openheader');
				jQuery(".categoryitems").hide();
				jQuery("."+link).addClass('active');
				jQuery("."+link) .parent("ul").show().prev().addClass("openheader");
			}
			jQuery(document).ready(function() {
				jQuery(".categoryitems").hide();
				jQuery(".categoryitems:first").show();
				jQuery(".menuheader:first").addClass("openheader");
				jQuery(".menuheader").live('click', function(event) {
					if (jQuery(this).hasClass('openheader')){
						jQuery(".menuheader").removeClass("openheader");
						jQuery(this).next().slideUp(200);
						return false;
					}
					jQuery(".menuheader").removeClass("openheader");
					jQuery(this).addClass("openheader");
					jQuery(".categoryitems").slideUp(200);
					jQuery(this).next().slideDown(200); 
					return false;
				});
				
				var hash = window.location.hash.substring(1);
				var id = hash.split("-show")[0];
				if (id){
					jQuery('.col2').children().hide();
					jQuery("#"+id).show();
					jQuery('.categoryitems li').removeClass('active');
					jQuery(".menuheader.expandable") .removeClass('openheader');
					jQuery(".categoryitems").hide();
					jQuery("."+id).addClass('active');
					jQuery("."+id) .parent("ul").slideDown(300).prev().addClass("openheader");
				} 
			});
			jQuery(function($) {
				$( "#cs_launch_date" ).datepicker({
					defaultDate: "+1w",
					dateFormat: "dd/mm/yy",
					changeMonth: true,
					numberOfMonths: 1,
					onSelect: function( selectedDate ) {
						$( "#cs_launch_date" ).datepicker( "option", "minDate", selectedDate );
					}
				});
			});
		</script>
		<link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri())?>/include/assets/css/jquery_ui_datepicker.css">
		<link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri())?>/include/assets/css/jquery_ui_datepicker_theme.css">
	<?php
	}
}

// Background Count function
if ( ! function_exists( 'cs_bgcount' ) ) {
	 function cs_bgcount($name,$count) {
		for($i=0; $i<=$count; $i++){
			$pattern['option'.$i] = $name.$i;
		}
		return $pattern;
	 }
}
add_action('init','cs_theme_option');
if ( ! function_exists( 'cs_theme_option' ) ) {
	function cs_theme_option(){
		global $options,$header_colors,$cs_theme_options;
		$cs_theme_options=get_option('cs_theme_options');
		$on_off_option =  array("show" => "on","hide"=>"off"); 
		$navigation_style = array("left" => "left","center"=>"center","right"=>"right");
		$google_fonts =array('google_font_family_name'=>array('','',''),'google_font_family_url'=>array('','',''));
		$social_network =array('social_net_icon_path'=>array('','','','','',''),'social_net_awesome'=>array('fa-facebook','fa-twitter','fa-google-plus','fa-skype','fa-pinterest','fa-envelope-o'),'social_net_url'=>array('https://www.facebook.com/','https://www.twitter.com/','https://plus.google.com/','https://www.skype.com/','https://www.pintrest.com/','https://www.mail.com/'),'social_net_tooltip'=>array('Facebook','Twitter','Google Plus','Skype','Pintrest','Mail'),'social_font_awesome_color'=>array('#2d5faa','#3ba3f3','#f33b3b','#22b6f4','#a82626','#f4ca22'));
		

		$sidebar =array('sidebar' => array('default_pages'=>'Default Pages','events_sidebar'=>'Events Sidebar','blogs_sidebar'=>'Blogs Sidebar','pages_sidebar'=>'Pages Sidebar','contact'=>'Contact'));
		$menus_locations = array_flip(get_nav_menu_locations());
		$breadcrumb_option = array("option1" => "option1","option2"=>"option2","option3"=>"option3");
		$deafult_sub_header = array('breadcrumbs_sub_header'=>'Breadcrumbs Sub Header','slider'=>'Revolution Slider','no_header'=>'No sub Header');
		$padding_sub_header = array('Default'=>'default','Custom'=>'custom');
		//Menus List
		$menu_option = get_registered_nav_menus();
		foreach($menu_option as $key=>$menu){
			$menu_location = $key;
			$menu_locations = get_nav_menu_locations();
			$menu_object = (isset($menu_locations[$menu_location]) ? wp_get_nav_menu_object($menu_locations[$menu_location]) : null);
			$menu_name[] = (isset($menu_object->name) ? $menu_object->name : '');
		}
		//Mailchimp List
		$mail_chimp_list[]='';
		if(isset($cs_theme_options['cs_mailchimp_key'])){
			$mailchimp_option = $cs_theme_options['cs_mailchimp_key'];
			if($mailchimp_option <> ''){
				$mc_list = cs_mailchimp_list($mailchimp_option);
 				if(isset($mc_list['data']) and $mc_list <> ''){
					foreach($mc_list['data'] as $list){
						$mail_chimp_list[$list['id']]=$list['name'];
					}
				}
		 	}
		}	
		
		//google fonts array
		$g_fonts = cs_googlefont_list(); 

		$g_fonts_atts = cs_get_google_font_attribute();
		
		global $cs_theme_options;
		if (isset($cs_theme_options) and $cs_theme_options <> '') {
			if(isset($cs_theme_options['sidebar']) and count($cs_theme_options['sidebar'])>0){
				$cs_sidebar =array('sidebar'=>$cs_theme_options['sidebar']);
			}elseif(!isset($cs_theme_options['sidebar'])){
				$cs_sidebar = array('sidebar'=>array());
			}
		}else{
			$cs_sidebar=$sidebar;
		}
	 	// Set the Options Array
		$options = array();
		$header_colors= cs_header_setting();
		/* general setting options */
		$options[] = array(	
					"name" =>__("General",'Awaken'),
					"fontawesome" => 'fa fa-cogs',
					"type" => "heading",
					"options" => array(
						'tab-global-setting'=>__('global','Awaken'),
						'tab-header-options'=>__('Header','Awaken'),
						'tab-sub-header-options'=>__('Sub Header','Awaken'),
						'tab-footer-options'=>__('Footer','Awaken'),
						'tab-social-setting'=>__('social icons','Awaken'),
						'tab-social-network'=>__('social sharing','Awaken'),
						'tab-custom-code'=>__('custom code','Awaken'),
					) 
				);
		$options[] = array( 
					"name" =>__("color",'Awaken'),
					"fontawesome" => 'fa fa-magic',
					"hint_text" => "",
					"type" => "heading",
					
					"options" => array(
						'tab-general-color'=>__('general','Awaken'),
						'tab-header-color'=>__('Header','Awaken'),
						'tab-footer-color'=>__('Footer','Awaken'),
						'tab-heading-color'=>__('headings','Awaken'),
					) 
				);
	$options[] = array( 
					"name" =>__("typography / fonts",'Awaken'),
					"fontawesome" => 'fa fa-font',
					"desc" => "",
					"hint_text" => "",
					"type" => "heading",
					"options" => array(
						'tab-custom-font'=>__('Custom Font','Awaken'),
						'tab-font-family'=>__('font family','Awaken'),
						'tab-font-size'=>__('font size','Awaken'),
					) 
				);					
	$options[] = array(	
					"name" =>__( "sidebar",'Awaken'),
					"fontawesome" => 'fa fa-columns',
					"id" => "tab-sidebar",
					"std" => "",
					"type" => "main-heading",
					"options" => ''
				);
	$options[] = array(	
					"name" =>__( "SEO",'Awaken'),
					"fontawesome" => 'fa fa-globe',
					"id" => "tab-seo",
					"std" => "",
					"type" => "main-heading",
					"options" => ""
				);	
	$options[] = array( 
					"name" =>__("global",'Awaken'),
					"id" => "tab-global-setting",
					"type" => "sub-heading"
				);
	$options[] = array( 
					"name" =>__("Layout",'Awaken'),
					"desc" => "",
					"hint_text" =>__("Layout type",'Awaken'),
					"id" =>   "cs_layout",
					"std" =>  "full_width",
					"options" => array(
						"boxed" => "boxed",
						"full_width"=>"full width"
					),
					"type" => "layout",
				);		
				
	$options[] = array( 
					"name" => "",
					"id" =>   "cs_horizontal_tab",
					"class" =>  "horizontal_tab",
					"type" => "horizontal_tab",
					"std" => "",
					"options" => array('Background'=>'background_tab','Pattern'=>'pattern_tab','Custom Image'=>'custom_image_tab')
				);

	$options[] = array( 
					"name" =>__("Background image",'Awaken'),
					"desc" => "",
					"hint_text" =>__("Choose from Predefined Background images.",'Awaken'),
					"id" =>   "cs_bg_image",
					"class" =>  "cs_background_",
					"path" => "background",
					"tab"=>"background_tab",
					"std" =>  "bg1",
					"type" => "layout_body",
					"display"=>"block",
					"options" => cs_bgcount('bg','10')
				);
				
	$options[] = array( "name" =>__("Background pattern",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Choose from Predefined Pattern images.",'Awaken'),
						"id" =>   "cs_bg_image",
						"class" =>  "cs_background_",
						"path" => "patterns",
						"tab"=>"pattern_tab",
						"std" =>  "bg1",
						"type" => "layout_body",
						"display"=>"none",
						"options" => cs_bgcount('pattern','27') 					
					);
	$options[] = array( 
					"name" =>__("Custom image",'Awaken'),
					"desc" => "",
					"hint_text" =>__("This option can be used only with Boxed Layout.",'Awaken'),
					"id" =>   "cs_custom_bgimage",
					"std" =>  "",
					"tab"=>"custom_image_tab",
					"display"=>"none",
					"type" => "upload logo"
				);
	$options[] = array( "name" =>__("Background image position",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Choose image position for body background",'Awaken'),
						"id" =>   "cs_bgimage_position",
						"std" =>  "Center Repeat",
						"type" => "select",
						"options" =>array(
							"option1" => "no-repeat center top",
							"option2"=>"repeat center top",
							"option3"=>"no-repeat center",
							"option4"=>"Repeat Center",
							"option5"=>"no-repeat left top",
							"option6"=>"repeat left top",
							"option7"=>"no-repeat fixed center",
							"option8"=>"no-repeat fixed center / cover"
						)
					);	
	$options[] = array( "name" =>__("Custom favicon",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Custom favicon for your site.",'Awaken'),
						"id" =>   "cs_custom_favicon",
						"std" =>  get_template_directory_uri()."/assets/images/favicon.png",
						"type" => "upload logo"
					);

					
	$options[] = array( "name" =>__("Events Time Format",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Select the time format for events",'Awaken'),
						"id" =>   "cs_time_formate",
						"std" => "12 hour",
						"type" => "select",
						"options" => array('12 hour'=>'12 hour','24 hour'=>'24 hour'),
					);

	$options[] = array( "name" =>__("Smooth Scroll",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Lightweight Script for Page Scrolling animation",'Awaken'),
						"id" =>   "cs_smooth_scroll",
						"std" => "off",
						"type" => "checkbox",
						"options" => $on_off_option
					);
	
	$options[] = array( "name" => "RTL",
						"desc" => "",
						"hint_text" =>__("Turn RTL ON/OFF here for Right to Left languages like Arabic etc.",'Awaken'),
						"id" =>   "cs_style_rtl",
						"std" => "off",
						"type" => "checkbox",
						"options" => $on_off_option
					);
					
	$options[] = array( "name" =>__("Responsive",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Set responsive design layout for mobile devices ON/OFF here",'Awaken'),
						"id" =>   "cs_responsive",
						"std" => "off",
						"type" => "checkbox",
						"options" => $on_off_option
					);

	// end global setting tab					
	// Header top strip option end
	// Header options start
	$options[] = array( "name" =>__("header",'Awaken'),
						"id" => "tab-header-options",
						"type" => "sub-heading"
					);
	$options[] = array( "name" =>__("Attention for Header Position!",'Awaken'),
						"id" => "header_postion_attention",
						"std"=>" <strong>Relative Position:</strong> The element is positioned relative to its normal position. The header is positioned above the content. <br> <strong>Absolute Position:</strong> The element is positioned relative to its first positioned. The header is positioned on the content.",
						"type" => "announcement"
					);
					
	$options[] = array( "name" =>__("Logo",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Upload your custom logo in .png .jpg .gif formats only.",'Awaken'),
						"id" =>   "cs_custom_logo",
						"std" => get_template_directory_uri()."/assets/images/logo.png",
						"type" => "upload logo"
					);
	$options[] = array( "name" =>__("Logo Height",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Set exact logo height otherwise logo will not display normally.",'Awaken'),
						"id" => "cs_logo_height",
						"min" => '0',
						"max" => '100',
						"std" => "46",
						"type" => "range"
					);				
	$options[] = array( "name" =>__("logo width",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Set exact logo width otherwise logo will not display normally.",'Awaken'),
						"id" => "cs_logo_width",
						"min" => '0',
						"max" => '250',
						"std" => "238",
						"type" => "range"
					);				
	
	$options[] = array( "name" =>__("Logo margin top and bottom",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Logo spacing/margin from top and bottom.",'Awaken'),
						"id" => "cs_logo_margintb",
						"min" => '0',
						"max" => '200',
						"std" => "0",
						"type" => "range"
					);	
	$options[] = array( "name" =>__("Logo margin left and right",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Logo spacing/margin from left and right.",'Awaken'),
						"id" => "cs_logo_marginlr",
						"min" => '0',
						"max" => '200',
						"std" => "0",
						"type" => "range"
					);										
	$options[] = array( "name" =>__("Header Styles",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Choose header style from the given options",'Awaken'),
						"id" =>   "cs_header_options",
						"class" =>  "cs_",
						"std" => "header_2",
						"type" => "layout1",
						"options" => array(
							"header_1" => "header_1",
							"header_2"=>"header_2",
							"header_3"=>"header_3",
							"header_4"=>"header_4",
							)
						);
 	/* header element settings*/
 	
	$options[] = array( "name" =>__("Header Elements",'Awaken'),
						"id" => "tab-header-options",
						"std" => "Header Elements",
						"type" => "section",
						"options" => ""
					);	
	$options[] = array( "name" =>__("Main Search",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Set header search On/Off. Allow user to search site content.",'Awaken'),
						"id" =>   "cs_search",
						"std" => "on",
						"type" => "checkbox",
						"options" => $on_off_option
					);
	$options[] = array( "name" =>__("Login Options",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Membership must be enabled from Dashboard Settings > General > Membership to allow user Registration ",'Awaken'),
						"id" =>   "cs_login_options",
						"std" => "on",
						"type" => "checkbox",
						"options" => $on_off_option
					);
	$options[] = array( "name" =>__("WPML",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Set WordPress Multi Language switcher ON/OFF in header",'Awaken'),
						"id" =>   "cs_wpml_switch",
						"std" => "on",
						"type" => "wpml",
						"options" => $on_off_option
					);
						
	$options[] = array( "name" =>__("Sticky Header On/Off",'Awaken'),
						"desc" => "",
						"id" =>   "cs_sitcky_header_switch",
						"hint_text" =>__("If you enable this option , header will be fixed on top of your browser window.",'Awaken'),
						"std" => "off",
						"type" => "checkbox",
						"options" => $on_off_option
					);
	$options[] = array( "name" =>__("Tagline Text",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Enable/Disable Header Tagline Text",'Awaken'),
						"id" =>   "cs_header_tagline_switch",
						"std" => "on",
						"type" => "checkbox",
						"options" => $on_off_option);
	$options[] = array( "name" =>__("Contribute now",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Enable/Disable Contribute now  Button",'Awaken'),
						"id" =>   "cs_contribute_now",
						"std" => "on",
						"type" => "checkbox",
						"options" => $on_off_option);
	$options[] = array( "name" =>__("Contribute now Button link",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Enter the Contribute now Button Link",'Awaken'),
						"id" =>   "cs_contribute_now_link",
						"std" => "",
						"type" => "text",
						);
						
	$options[] = array( "name" =>__("Header Position Settings",'Awaken'),
						"id" => "tab-header-options",
						"std" => "Header Position Settings",
						"type" => "section",
						"options" => ""
					);
	$options[] = array( "name" =>__("Select Header Position",'Awaken'),
					"desc" => "Make header position fixed as Absolute or move it",
					"hint_text" =>__("Select header position as Absolute OR Relative",'Awaken'),
					"id" =>   "cs_header_position",
					"std" => "relative",
					"type" => "select",
					"options" => array('absolute'=>'absolute','relative'=>'relative')
				);
	$options[] = array( "name" =>__("Header Background",'Awaken'),
					"desc" => "",
					"hint_text" =>__("Header settings made here will be implemented on default pages.",'Awaken'),
					"id" =>   "cs_headerbg_options",
					"std" => "Default Header Background",
					"type" => "default header background",
					"options" => array('none'=>'None','cs_rev_slider'=>'Revolution Slider','cs_bg_image_color'=>'Bg Image / bg Color')
			);				
 	$options[] = array( "name" =>__("Revolution Slider",'Awaken'),
						"desc" => "",
						"hint_text" =>'<p>'.__("Please select Revolution Slider if already included in package. Otherwise buy Sliders from <a href='http://codecanyon.net/' target='_blank'>Codecanyon</a>. But its optional".'</p>','Awaken'),
						"id" =>   "cs_headerbg_slider",
						"std" => "",
						"type" => "headerbg slider",
						"options" => ''
					);
	$options[] = array( "name" =>__("Background Image",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Upload your custom background image in .png .jpg .gif formats only.",'Awaken'),
						"id" =>   "cs_headerbg_image",
						"std" =>  "",
						"type" => "upload"
					);
	$options[] = array( "name" =>__("Background Color",'Awaken'),
						"desc" => "",
						"hint_text" =>__("set header background color.",'Awaken'),
						"id" =>   "cs_headerbg_color",
						"std" => "",
						"type" => "color"
					);
	$options[] = array( "name" =>__("Header Top Strip",'Awaken'),
						"id" => "tab-header-options",
						"std" => "Header Top Strip",
						"type" => "section",
						"options" => ""
					);	
					
	$options[] = array( "name" =>__("Header Strip",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Enable/Disable header top strip.",'Awaken'),
						"id" =>   "cs_header_top_strip",
						"std" => "on",
						"type" => "checkbox",
						"options" => $on_off_option);				
	
	$options[] = array( "name" =>__("Social Icon",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Enable/Disable social icon. Add icons from General > social icon",'Awaken'),
						"id" =>   "cs_socail_icon_switch",
						"std" => "on",
						"type" => "checkbox",
						"options" => $on_off_option);				

	$options[] = array( "name" =>__("Top Menu",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Menu location can be set from Appearance > Menu > Manage Menu Locations.",'Awaken'),
						"id" =>   "cs_top_menu_switch",
						"std" => "on",
						"type" => "checkbox",
						"options" => $on_off_option);
	$options[] = array( "name" =>__("Cart Count",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Enable/Disable Cart Count.",'Awaken'),
						"id" =>   "cs_woocommerce_switch",
						"std" => "on",
						"type" => "checkbox",
						"options" => $on_off_option);							
	$options[] = array( "name" =>__("Short Text",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Write phone no, email or address for Header top strip",'Awaken'),
						"id" =>   "cs_header_strip_tagline_text",
						"std" => '<i class="fa fa-envelope-o"></i> for any inquiry: 000-111-222-33<a href="mailto: future@university.com"> future@university.com</a>',
						"type" => "textarea");
	$options[] = array( "name" =>__("Header addsense",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Embed Image/Google addsense Code",'Awaken'),
						"id" =>   "cs_header_banner_addsense",
						"std" => '',
						"type" => "textarea");
	
	/* sub header element settings*/
	$options[] = array( "name" =>__("sub header",'Awaken'),
						"id" => "tab-sub-header-options",
						"type" => "sub-heading"
					);
	$options[] = array( "name" =>__("Announcement!",'Awaken'),
						"id" => "sub_header_announcement",
						"std"=>"Change this and that and try again. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.",
						"type" => "announcement"
					);
					
	$options[] = array( "name" =>__("Default",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Sub Header settings made here will be implemented on all pages.",'Awaken'),
						"id" =>   "cs_default_header",
						"std" => "Breadcrumbs Sub Header",
						"type" => "default header",
						"options" => $deafult_sub_header
					);
	$options[] = array( "name" =>__("Content Padding",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Choose default or custom padding for sub header content.",'Awaken'),
						"id" =>   "subheader_padding_switch",
						"std" => "Default",
						"type" => "default padding",
						"options" => $padding_sub_header
					);
					
	$options[] = array( "name" =>__("Header Border Color",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_header_border_color",
						"std" => "",
						"type" => "color"
					);
					
	$options[] = array( "name" =>__("Revolution Slider",'Awaken'),
						"desc" => "",
						"hint_text" =>'<p>'.__("Please select Revolution Slider if already included in package. Otherwise buy Sliders from <a href='http://codecanyon.net/' target='_blank'>Codecanyon</a>. But its optional".'</p>','Awaken'),
						"id" =>   "cs_custom_slider",
						"std" => "",
						"type" => "slider code",
						"options" => ''
					);
	$options[] = array( "name" =>__("Padding Top",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Set custom padding for sub header content top area.",'Awaken'),
						"id" => "cs_sh_paddingtop",
						"min" => '0',
						"max" => '200',
						"std" => "45",
						"type" => "range"
					);
	$options[] = array( "name" =>__("Padding Bottom",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Set custom padding for sub header content bottom area.",'Awaken'),
						"id" => "cs_sh_paddingbottom",
						"min" => '0',
						"max" => '200',
						"std" => "45",
						"type" => "range"
					);					
	$options[] = array( "name" =>__("Content Text Align",'Awaken'),
						"desc" => "",
						"hint_text" =>__("select the text Alignment for sub header content.",'Awaken'),
						"id" =>   "cs_title_align",
						"std" => "left",
						"type" => "select",
						"options" => $navigation_style
					);
	$options[] = array( "name" =>__("Page Title",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Set page title On/Off in sub header",'Awaken'),
						"id" => "cs_title_switch",
						"std" => "on",
						"type" => "checkbox"
					);
	
					
	$options[] = array( "name" =>__("Breadcrumbs",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_breadcrumbs_switch",
						"std" => "on",
						"type" => "checkbox"
					);
	
	$options[] = array( "name" => __("Background Color",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_sub_header_bg_color",
						"std" => "#f5f5f5",
						"type" => "color"
					);	
	$options[] = array( "name" =>__("Text Color",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_sub_header_text_color",
						"std" => "#333333",
						"type" => "color"
					);	
	$options[] = array( "name" =>__("Border Color",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_sub_header_border_color",
						"std" => "#dddddd",
						"type" => "color"
					);			
	$options[] = array( "name" =>__("Background",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Background Image",'Awaken'),
						"id" =>   "cs_background_img",
						"std" => "",
						"type" => "upload logo"
					);			

	$options[] = array( "name" =>__("Parallax",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_parallax_bg_switch",
						"std" => "on",
						"type" => "checkbox"
					);				
	
	// start footer options	
				
	$options[] = array( "name" =>__("footer options",'Awaken'),
						"id" => "tab-footer-options",
						"type" => "sub-heading"
						);						
	$options[] = array( "name" =>__("Footer section",'Awaken'),
						"desc" => "",
						"hint_text" =>__("enable/disable footer area",'Awaken'),
						"id" => "cs_footer_switch",
						"std" => "on",
						"type" => "checkbox"
					);			
	$options[] = array( "name" =>__("Footer Widgets",'Awaken'),
						"desc" => "",
						"hint_text" =>__("enable/disable footer widget area",'Awaken'),
						"id" => "cs_footer_widget",
						"std" => "on",
						"type" => "checkbox"
					);					
	
		
	$options[] = array( "name" =>__("Social Icons",'Awaken'),
						"desc" => "",
						"hint_text" =>__("enable/disable Social Icons",'Awaken'),
						"id" => "cs_sub_footer_social_icons",
						"std" => "on",
						"type" => "checkbox");						
	$options[] = array( "name" =>__("Footer Menu",'Awaken'),
						"desc" => "",
						"hint_text" =>__("enable/disable Footer Menu",'Awaken'),
						"id" => "cs_sub_footer_menu",
						"std" => "on",
						"type" => "checkbox");			
	$options[] = array( "name" =>__("NewsLetter Signup",'Awaken'),
						"desc" => "",
						"hint_text" =>__("enable/disable NewsLetter Signup area",'Awaken'),
						"id" => "cs_footer_newsletter",
						"std" => "on",
						"type" => "checkbox");		
						
	$options[] = array( "name" =>__("footer logo",'Awaken'),
						"desc" => "",
						"hint_text" =>__("set custom footer logo",'Awaken'),
						"id" =>   "cs_footer_logo",
						"std" => get_template_directory_uri()."/assets/images/footer-logo.png",
						"type" => "upload logo");
						
	$options[] = array( "name" =>__("Footer Background Image",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Set custom Footer Background Image",'Awaken'),
						"id" =>   "cs_footer_background_image",
						"std" => "",
						"type" => "upload logo");					
	$options[] = array( "name" =>__("copyright text",'Awaken'),
						"desc" => "",
						"hint_text" =>__("write your own copyright text",'Awaken'),
						"id" => "cs_copy_right",
						"std" => "&copy; 2014 Theme Options Wordpress All rights reserved.",
						"type" => "textarea"
					);
					
	$options[] = array( "name" =>__("Footer Twitter Options",'Awaken'),
						"id" => "tab-footer-twitter-options",
						"std" => "Footer Twitter Options",
						"type" => "section",
						"options" => ""
					);
	
	$options[] = array( "name" =>__("Footer Twitter Background Color",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Set Footer Twitter Background Color",'Awaken'),
						"id" => "cs_footer_tweet_bgcolor",
						"std" => "#1dcaff",
						"type" => "color"
					);
										
	$options[] = array( "name" =>__("footer twitter",'Awaken'),
						"desc" => "",
						"hint_text" =>__("set footer twitter on/off",'Awaken'),
						"id" =>   "cs_footer_twitter",
						"std" => "on",
						"type" => "checkbox");
						
	$options[] = array( 
					"name" =>__("twitter username",'Awaken'),
					"desc" => "",
					"hint_text" =>__("set footer twitter username",'Awaken'),
					"id" =>   "cs_footer_twitter_username",
					"std" =>  "",
					"type" => "text",
				);
	
	$options[] = array( 
					"name" =>__("twitter no. of tweets",'Awaken'),
					"desc" => "",
					"hint_text" =>__("set number of tweets such as 5",'Awaken'),
					"id" =>   "cs_footer_twitter_num_tweets",
					"std" =>  "",
					"type" => "text",
				);
				
	// End footer tab setting
	/* general colors*/				
	$options[] = array( "name" =>__("general colors",'Awaken'),
						"id" => "tab-general-color",
						"type" => "sub-heading"
						);	
	$options[] = array( "name" =>__("Theme Color",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Choose theme skin color",'Awaken'),
						"id" => "cs_theme_color",
						"std" => "#355c7d",
						"type" => "color"
					);
					
	$options[] = array( "name" =>__("Background Color",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Choose Body Background Color",'Awaken'),
						"id" => "cs_bg_color",
						"std" => "#ffffff",
						"type" => "color"
					);
					
	$options[] = array( "name" =>__("Body Text Color",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Choose text color",'Awaken'),
						"id" => "cs_text_color",
						"std" => "#818181",
						"type" => "color"
					);	
					
	// start top strip tab options
	$options[] = array( "name" =>__("header colors",'Awaken'),
						"id" => "tab-header-color",
						"type" => "sub-heading"
						);	
	$options[] = array( "name" =>__("top strip colors",'Awaken'),
						"id" => "tab-top-strip-color",
						"std" => "Top Strip",
						"type" => "section",
						"options" => ""
						);
	$options[] = array( "name" =>__("Background Color",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Change Top Strip background color",'Awaken'),
						"id" => "cs_topstrip_bgcolor",
						"std" => "#4c4c4c",
						"type" => "color"
					);
					
	$options[] = array( "name" =>__("Text Color",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Change Top Strip text color",'Awaken'),
						"id" => "cs_topstrip_text_color",
						"std" => "#ffffff",
						"type" => "color"
					);
					
	$options[] = array( "name" =>__("Link Color",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Change Top Strip link color",'Awaken'),
						"id" => "cs_topstrip_link_color",
						"std" => "#ffffff",
						"type" => "color"
					);
					
						
	// end top stirp tab options
	// start header color tab options
	$options[] = array( "name" =>__("Header Colors",'Awaken'),
						"id" => "tab-header-color",
						"std" => "Header Colors",
						"type" => "section",
						"options" => ""
						);
	$options[] = array( "name" =>__("Background Color",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Change Header background color",'Awaken'),
						"id" => "cs_header_bgcolor",
						"std" => "",
						"type" => "color"
					);											
	$options[] = array( "name" =>__("Navigation Background Color",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Change Header Navigation Background color",'Awaken'),
						"id" => "cs_nav_bgcolor",
						"std" => "#e17a26",
						"type" => "color"
					);
					
	
					
	 $options[] = array( "name" =>__("Menu Link color",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Change Header Menu Link color",'Awaken'),
						"id" => "cs_menu_color",
						"std" => "#ffffff",
						"type" => "color"
					);
					
	$options[] = array( "name" =>__("Menu Active Link color",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Change Header Menu Active Link color",'Awaken'),
						"id" => "cs_menu_active_color",
						"std" => "#ffffff",
						"type" => "color"
					);
					

	$options[] = array( "name" =>__("Submenu Background",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Change Submenu Background color",'Awaken'),
						"id" => "cs_submenu_bgcolor",
						"std" => "#ffffff",
						"type" => "color",
					);
			
	$options[] = array( "name" =>__("Submenu Link Color ",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Change Submenu Link color",'Awaken'),
						"id" => "cs_submenu_color",
						"std" => "#666",
						"type" => "color"
					);
					
	$options[] = array( "name" =>__("Submenu Hover Link Color",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Change Submenu Hover Link color",'Awaken'),
						"id" => "cs_submenu_hover_color",
						"std" => "#e17a26",
						"type" => "color"
					);
	
	
	
	/* footer colors*/				
	$options[] = array( "name" =>__("footer colors",'Awaken'),
						"id" => "tab-footer-color",
						"type" => "sub-heading"
						);								
	$options[] = array( "name" =>__("Footer Background Color",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_footerbg_color",
						"std" => "#333",
						"type" => "color"
					);
	
	$options[] = array( "name" =>__("Footer Title Color",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_title_color",
						"std" => "#fff",
						"type" => "color"
					);
					
	$options[] = array( "name" =>__("Footer Text Color",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_footer_text_color",
						"std" => "#fff",
						"type" => "color"
					);
					
	$options[] = array( "name" =>__("Footer Link Color",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_link_color",
						"std" => "#333",
						"type" => "color"
					);
	
	$options[] = array( "name" =>__("Footer Widget Background Color",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_sub_footerbg_color",
						"std" => "#f5f5f5",
						"type" => "color"
					);
	
	$options[] = array( "name" =>__("Copyright Text",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_copyright_text_color",
						"std" => "#666666",
						"type" => "color"
					);
	
	/* heading colors*/				
	$options[] = array( "name" =>__("heading colors",'Awaken'),
						"id" => "tab-heading-color",
						"type" => "sub-heading"
						);								
	$options[] = array( "name" =>__("heading h1",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_heading_h1_color",
						"std" => "#000000",
						"type" => "color"
					);
	
	$options[] = array( "name" =>__("heading h2",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_heading_h2_color",
						"std" => "#000000",
						"type" => "color"
					);
	
	$options[] = array( "name" =>__("heading h3",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_heading_h3_color",
						"std" => "#000000",
						"type" => "color"
					);
	
	$options[] = array( "name" =>__("heading h4",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_heading_h4_color",
						"std" => "#000000",
						"type" => "color"
					);
	
	$options[] = array( "name" =>__("heading h5",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_heading_h5_color",
						"std" => "#000000",
						"type" => "color"
					);
	
	$options[] = array( "name" =>__("heading h6",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_heading_h6_color",
						"std" => "#000000",
						"type" => "color"
					);
																																																				
	// end header color tab options	
	
	/* start custom font family */
	$options[] = array( "name" =>__("Custom Fonts",'Awaken'),
						"id" => "tab-custom-font",
						"type" => "sub-heading"
						);
						
	$options[] = array( "name" =>__("Custom Font .woff",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Custom font for your site upload .woff format file.",'Awaken'),
						"id" =>   "cs_custom_font_woff",
						"std" =>  "",
						"type" => "upload font"
					);
					
	$options[] = array( "name" =>__("Custom Font .ttf",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Custom font for your site upload .ttf format file.",'Awaken'),
						"id" =>   "cs_custom_font_ttf",
						"std" =>  "",
						"type" => "upload font"
					);
					
	$options[] = array( "name" =>__("Custom Font .svg",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Custom font for your site upload .svg format file.",'Awaken'),
						"id" =>   "cs_custom_font_svg",
						"std" =>  "",
						"type" => "upload font"
					);
					
	$options[] = array( "name" =>__("Custom Font .eot",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Custom font for your site upload .eot format file.",'Awaken'),
						"id" =>   "cs_custom_font_eot",
						"std" =>  "",
						"type" => "upload font"
					);	
									
	/* start font family */
	$options[] = array( "name" =>__("font family",'Awaken'),
						"id" => "tab-font-family",
						"type" => "sub-heading"
						);
	$options[] = array( "name" =>__("Content Font",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Set fonts for Body text",'Awaken'),
						"id" =>   "cs_content_font",
						"std" => "Roboto",
						"type" => "gfont_select",
						"options" => $g_fonts
					);
	$options[] = array( "name" =>__("Content Font Attribute",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Set Font Attribute",'Awaken'),
						"id" =>   "cs_content_font_att",
						"std" => "",
						"type" => "gfont_att_select",
						"options" => $g_fonts_atts
					);
	$options[] = array( "name" =>__("Main Menu Font",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Set font for main Menu. It will be applied to sub menu as well",'Awaken'),
						"id" =>   "cs_mainmenu_font",
						"std" => "Roboto",
						"type" => "gfont_select",
						"options" => $g_fonts
					);
	$options[] = array( "name" =>__("Main Menu Font Attribute",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Set Font Attribute",'Awaken'),
						"id" =>   "cs_mainmenu_font_att",
						"std" => "",
						"type" => "gfont_att_select",
						"options" => $g_fonts_atts
					);
	$options[] = array( "name" =>__("Headings Font",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Select font for Headings. It will apply on all posts and pages headings",'Awaken'),
						"id" =>   "cs_heading_font",
						"std" => "Cabin",
						"type" => "gfont_select",
						"options" => $g_fonts
					);
	$options[] = array( "name" =>__("Headings Font Attribute",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Set Font Attribute",'Awaken'),
						"id" =>   "cs_heading_font_att",
						"std" => "",
						"type" => "gfont_att_select",
						"options" => $g_fonts_atts
					);					
	$options[] = array( "name" =>__("Widget Headings Font",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Set font for Widget Headings",'Awaken'),
						"id" =>   "cs_widget_heading_font",
						"std" => "Cabin",
						"type" => "gfont_select",
						"options" => $g_fonts
					);
	$options[] = array( "name" =>__("Widget Headings Font Attribute",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Set Font Attribute",'Awaken'),
						"id" =>   "cs_widget_heading_font_att",
						"std" => "",
						"type" => "gfont_att_select",
						"options" => $g_fonts_atts
					);								
	 /* start font size */
	$options[] = array( "name" =>__("Font size",'Awaken'),
						"id" => "tab-font-size",
						"type" => "sub-heading"
						);
	 
	$options[] = array( "name" =>__("Content",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_content_size",
						"min" => '6',
						"max" => '50',
						"std" => "14",
						"type" => "range"
					);
	$options[] = array( "name" =>__("Main Menu",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_mainmenu_size",
						"min" => '6',
						"max" => '50',
						"std" => "12",
						"type" => "range"
					);
	$options[] = array( "name" =>__("Heading 1",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_heading_1_size",
						"min" => '6',
						"max" => '50',
						"std" => "32",
						"type" => "range"
					);
	$options[] = array( "name" =>__("Heading 2",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_heading_2_size",
						"min" => '6',
						"max" => '50',
						"std" => "20",
						"type" => "range"
					);
	$options[] = array( "name" =>__("Heading 3",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_heading_3_size",
						"min" => '6',
						"max" => '50',
						"std" => "18",
						"type" => "range"
					);	
	$options[] = array( "name" =>__("Heading 4",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_heading_4_size",
						"min" => '6',
						"max" => '50',
						"std" => "16",
						"type" => "range"
					);
	$options[] = array( "name" =>__("Heading 5",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_heading_5_size",
						"min" => '6',
						"max" => '50',
						"std" => "14",
						"type" => "range"
					);
	$options[] = array( "name" =>__("Heading 6",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_heading_6_size",
						"min" => '6',
						"max" => '50',
						"std" => "12",
						"type" => "range"
					);
					
	$options[] = array( "name" =>__("Widget Heading",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_widget_heading_size",
						"min" => '6',
						"max" => '50',
						"std" => "15",
						"type" => "range"
					);		
																							
	/* social icons setting*/					
	$options[] = array( "name" =>__("social icons",'Awaken'),
						"id" => "tab-social-setting",
						"type" => "sub-heading"
						);			
	$options[] = array( "name" =>__("Social Network",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_social_network",
						"std" => "",
						"type" => "networks",
						"options" => $social_network
					); 
	/* social icons end*/	
	/* social Network setting*/					
					
	$options[] = array( "name" =>__("social Sharing",'Awaken'),
						"id" => "tab-social-network",
						"type" => "sub-heading"
						);
	$options[] = array( "name" =>__("Facebook",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_facebook_share",
						"std" => "on",
						"type" => "checkbox");
						
	$options[] = array( "name" =>__("Twitter",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_twitter_share",
						"std" => "on",
						"type" => "checkbox");
						
	$options[] = array( "name" =>__("Google Plus",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_google_plus_share",
						"std" => "on",
						"type" => "checkbox");
						
	$options[] = array( "name" =>__("Pinterest",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_pintrest_share",
						"std" => "on",
						"type" => "checkbox");
						
	$options[] = array( "name" =>__("Tumblr",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_tumblr_share",
						"std" => "on",
						"type" => "checkbox");
						
	$options[] = array( "name" =>__("Dribbble",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_dribbble_share",
						"std" => "on",
						"type" => "checkbox");
						
	$options[] = array( "name" =>__("Instagram",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_instagram_share",
						"std" => "on",
						"type" => "checkbox");
						
	$options[] = array( "name" =>__("StumbleUpon",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_stumbleupon_share",
						"std" => "on",
						"type" => "checkbox");
						
	$options[] = array( "name" =>__("youtube",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_youtube_share",
						"std" => "on",
						"type" => "checkbox");
	
	$options[] = array( "name" =>__("share more",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_share_share",
						"std" => "on",
						"type" => "checkbox");
	
	/* social network end*/
	
	
	
	/* custom code setting*/	
	$options[] = array( "name" =>__("custom code",'Awaken'),
						"id" => "tab-custom-code",
						"type" => "sub-heading"
					);
	$options[] = array( "name" =>__("Custom Css",'Awaken'),
						"desc" => "",
						"hint_text" =>__("write you custom css without style tag",'Awaken'),
						"id" => "cs_custom_css",
						"std" => "",
						"type" => "textarea"
					);
						
	$options[] = array( "name" =>__("Custom JavaScript",'Awaken'),
						"desc" => "",
						"hint_text" =>__("write you custom js without script tag",'Awaken'),
						"id" => "cs_custom_js",
						"std" => "",
						"type" => "textarea"
					);
					
	/* sidebar tab */
	$options[] = array( "name" =>__("sidebar",'Awaken'),
						"id" => "tab-sidebar",
						"type" => "sub-heading"
					);
	$options[] = array( "name" =>__("Sidebar",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Select a sidebar from the list already given. (Nine pre-made sidebars are given)",'Awaken'),
						"id" => "cs_sidebar",
						"std" => $sidebar,
						"type" => "sidebar",
						"options" => $sidebar
					);
	
	$options[] = array( "name" =>__("post layout",'Awaken'),
						"id" => "cs_non_metapost_layout",
						"std" => "single post layout",
						"type" => "section",
						"options" => ""
						);				
	$options[] = array( "name" =>__("Single Post Layout",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Use this option to set default layout. It will be applied to all posts",'Awaken'),
						"id" =>   "cs_single_post_layout",
						"std" => "sidebar_right",
						"type" => "layout",
						"options" => array(
							"no_sidebar" =>__("full width",'Awaken'),
							"sidebar_left"=>__("sidebar left",'Awaken'),
							"sidebar_right"=>__("sidebar right",'Awaken'),
							)
						);
					
	$options[] = array( "name" =>__("Single Layout Sidebar",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Select Single Post Layout of your choice for sidebar layout. You cannot select it for full width layout",'Awaken'),
						"id" =>   "cs_single_layout_sidebar",
						"std" => "Blogs Sidebar",
						"type" => "select_sidebar",
						"options" => $cs_sidebar
					);
					
	$options[] = array( "name" =>__("default pages",'Awaken'),
						"id" => "default_pages",
						"std" => "default pages",
						"type" => "section",
						"options" => ""
						);
	$options[] = array( "name" =>__("Default Pages Layout",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Set Sidebar for all pages like Search, Author Archive, Category Archive etc",'Awaken'),
						"id" =>   "cs_default_page_layout",
						"std" => "sidebar_right",
						"type" => "layout",
						"options" => array(
							"no_sidebar" =>__("full width",'Awaken'),
							"sidebar_left"=>__("sidebar left",'Awaken'),
							"sidebar_right"=>__("sidebar right",'Awaken'),
							)
						);					
	$options[] = array( "name" =>__("Sidebar",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Select pre-made sidebars for default pages on sidebar layout. Full width layout cannot have sidebars",'Awaken'),
						"id" =>   "cs_default_layout_sidebar",
						"std" => "Blogs Sidebar",
						"type" => "select_sidebar",
						"options" => $cs_sidebar
					);	
	$options[] = array( "name" =>__("Excerpt",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Set excerpt length/limit from here. It controls text limit for post's content",'Awaken'),
						"id" => "cs_excerpt_length",
						"std" => "255",
						"type" => "text"
					);		
	
	/* seo */
	$options[] = array( "name" =>__("SEO",'Awaken'),
						"id" => "tab-seo",
						"type" => "sub-heading"
						);
		$options[] = array( "name" => "<b>Attention for External SEO Plugins!</b>",
						"id" => "header_postion_attention",
						"std"=>" <strong> If you are using any external SEO plugin, Turn OFF these options. </strong>",
						"type" => "announcement"
					);

	$options[] = array( "name" =>__("Built-in SEO fields",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Turn SEO options On/Off",'Awaken'),
						"id" => "cs_builtin_seo_fields",
						"std" => "on",
						"type" => "checkbox");
						
	$options[] = array( "name" =>__("Meta Description",'Awaken'),
						"desc" => "",
						"hint_text" =>__("HTML attributes that explain the contents of web pages commonly used on search engine result pages (SERPs) for pages snippets",'Awaken'),
						"id" => "cs_meta_description",
						"std" => "",
						"type" => "text"
					);
					
	$options[] = array( "name" =>__("Meta Keywords",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Attributes of meta tags, a list of comma-separated words included in the HTML of a Web page that describe the topic of that page",'Awaken'),
						"id" => "cs_meta_keywords",
						"std" => "",
						"type" => "text"
					);
					
	$options[] = array( "name" =>__("Google Analytics",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Google Analytics is a service offered by Google that generates detailed statistics about a website's traffic, traffic sources, measures conversions and sales. Paste Google Analytics code here",'Awaken'),
						"id" => "cs_google_analytics",
						"std" => "",
						"type" => "textarea"
					);
					
	/* maintenance mode*/				
	$options[] = array( "name" =>__("Maintenance Mode",'Awaken'),
						"fontawesome" => 'fa fa-tasks',
						"id" => "tab-maintenace-mode",
						"std" => "",
						"type" => "main-heading",
						"options" => ""
						);	
	$options[] = array( "name" =>__("Maintenance Mode",'Awaken'),
						"id" => "tab-maintenace-mode",
						"type" => "sub-heading"
						);
	$options[] = array( "name" =>__("Maintenace Page",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Users will see Maintenance page & logged in Admin will see normal site.",'Awaken'),
						"id" => "cs_maintenance_page_switch",
						"std" => "off",
						"type" => "checkbox");
						
	$options[] = array( "name" =>__("Show Logo",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Show/Hide logo on Maintenance. Logo can be uploaded from General > Header in CS Theme options.",'Awaken'),
						"id" => "cs_maintenance_logo_switch",
						"std" => "on",
						"type" => "checkbox");
						
	$options[] = array( "name" =>__("Maintenance Text",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Text for Maintenance page. Insert some basic HTML or use shortcodes here.",'Awaken'),
						"id" => "cs_maintenance_text",
						"std" => "<h1>Sorry, We are down for maintenance </h1><p>We're currently under maintenance, if all goas as planned we'll be back in</p>",
						"type" => "textarea"
					);
					
	$options[] = array( "name" =>__("Launch Date",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Estimated date for completion of site on Maintenance page.",'Awaken'),
						"id" => "cs_launch_date",
						"std" => gmdate("dd/mm/yy"),
						"type" => "text"
					);
											
	/* api options tab*/
	$options[] = array( "name" =>__("api settings",'Awaken'),
						"fontawesome" => 'fa fa-chain-broken',
						"id" => "tab-api-options",
						"std" => "",
						"type" => "main-heading",
						"options" => ""
						);
	//Start Twitter Api	
	$options[] = array( "name" =>__("all api settings",'Awaken'),
						"id" => "tab-api-options",
						"type" => "sub-heading"
						);
	$options[] = array( "name" =>__("Twitter",'Awaken'),
						"id" => "Twitter",
						"std" => "Twitter",
						"type" => "section",
						"options" => ""
						);								
		$options[] = array( "name" =>__("Attention for API Settings!",'Awaken'),
						"id" => "header_postion_attention",
						"std"=>__("API Settings allows admin of the site to show their activity on site semi-automatically. Set your social account API once, it will be update your social activity automatically on your site.",'Awaken'),
						"type" => "announcement"
					);
	$options[] = array( "name" =>__("Show Twitter",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Turn Twitter option On/Off",'Awaken'),
						"id" => "cs_twitter_api_switch",
						"std" => "off",
						"type" => "checkbox"); 
						
	$options[] = array( "name" =>__("Consumer Key",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" =>   "cs_consumer_key",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" =>__("Consumer Secret",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Insert consumer key. To get your account key, <a href='https://dev.twitter.com/' target='_blank'>Click Here </a>",'Awaken'),
						"id" =>   "cs_consumer_secret",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" =>__( "Access Token",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Insert Twitter Access Token for permissions. When you create your Twitter App, you get this Token",'Awaken'),
						"id" =>   "cs_access_token",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" =>__("Access Token Secret",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Insert Twitter Access Token Secret here. When you create your Twitter App, you get this Token",'Awaken'),
						"id" =>   "cs_access_token_secret",
						"std" => "",
						"type" => "text");
	//end Twitter Api
	//Start Facebook Api
	
	if(class_exists('wp_causes'))
	{
		$options[] = array( "name" =>__("Facebook",'Awaken'),
							"id" => "Facebook",
							"std" => "Facebook",
							"type" => "section",
							"options" => ""
							);	
		$options[] = array( "name" =>__("Facebook Login On/Off",'Awaken'),
							"desc" => "",
							"hint_text" =>__("Turn Facebook Login ON/OFF",'Awaken'),
							"id" =>   "cs_facebook_login_switch",
							"std" => "off",
							"type" => "checkbox",
							"options" => $on_off_option);
							
		$options[] = array( "name" =>__("Facebook Application ID",'Awaken'),
							"desc" => "",
							"hint_text" =>__("To get your Facebook Aplication ID <a href='https://developers.facebook.com/docs/graph-api/reference/v2.1/app' target='_blank'>Click Here </a>",'Awaken'),
							"id" =>   "cs_facebook_app_id",
							"std" => "",
							"type" => "text");
							
		$options[] = array( "name" =>__("Facebook  Secret",'Awaken'),
							"desc" => "",
							"hint_text" =>__("Put your Facebook Secret here. You can find it in your facebook Application Dashboard",'Awaken'),
							"id" =>   "cs_facebook_secret",
							"std" => "",
							"type" => "text");
	}
	//end facebook api
	//start google api
	$options[] = array( "name" =>__("Google",'Awaken'),
						"id" => "Google",
						"std" => "Google+",
						"type" => "section",
						"options" => ""
						);	
	$options[] = array( "name" =>__("Google+ Login On/Off",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Turn Google+ Login ON/OFF",'Awaken'),
						"id" =>   "cs_google_login_switch",
						"std" => "off",
						"type" => "checkbox",
						"options" => $on_off_option);
						
	$options[] = array( "name" =>__("Google+ Client Id",'Awaken'),
						"desc" => "",
						"hint_text" =>__("Type your Google Login information here",'Awaken'),
						"id" =>   "cs_google_client_id",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" =>__("Google+ Client Secret",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" =>   "cs_google_client_secret",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" =>__("Google+ API key",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" =>   "cs_google_api_key",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" =>__("Fixed redirect url for login",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" =>   "cs_google_login_redirect_url",
						"std" => "",
						"type" => "text");
	
	//end google api
	//start mailChimp api
	$options[] = array( "name" =>__("MailChimp",'Awaken'),
						"id" => "mailchimp",
						"std" => "MailChimp",
						"type" => "section",
						"options" => ""
						);	
	$options[] = array( "name" =>__("MailChimp Key",'Awaken'),
						"desc" => "Enter a valid MailChimp API key here to get started. Once you've done that, you can use the MailChimp Widget from the Widgets menu. You will need to have at least MailChimp list set up before the using the widget. You can get your mailchimp activation key",
						"hint_text" =>__("Get your mailchimp key by <a href='https://login.mailchimp.com/' target='_blank'>Clicking Here </a>",'Awaken'),
						"id" =>   "cs_mailchimp_key",
						"std" => "90f86a57314446ddbe87c57acc930ce8-us2",
						"type" => "text"
						);
						
	$options[] = array( "name" =>__("MailChimp List",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" =>   "cs_mailchimp_list",
						"std" => "on",
						"type" => "mailchimp",
						"options" => $mail_chimp_list
					);
					
	$options[] = array( "name" =>__("Flickr API Setting",'Awaken'),
						"id" => "flickr_api_setting",
						"std" => "Flickr API Setting",
						"type" => "section",
						"options" => ""
						);					
	$options[] = array( "name" =>__("Flickr key",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" =>   "flickr_key",
						"std" => "",
						"type" => "text");
	$options[] = array( "name" =>__("Flickr secret",'Awaken'),
						"desc" => "",
						"hint_text" => "",
						"id" =>   "flickr_secret",
						"std" => "",
						"type" => "text");
	
	/* Cause Plugin options tab*/
	if(class_exists('wp_causes'))
	{
		
				
		$options[] = array( "name" =>__("Cause settings",'Awaken'),
							"fontawesome" => 'fa fa-chain-broken',
							"id" => "tab-cause-options",
							"std" => "",
							"type" => "main-heading",
							"options" => ""
							);
		$options[] = array( "name" =>__("Cause settings",'Awaken'),
							"id" => "tab-cause-options",
							"type" => "sub-heading"
							);
		 $options[] = array( "name" =>__("User Profile Page",'Awaken'),
							"desc" => "",
							"hint_text" =>__("Select page for user profile here",'Awaken'),
							"id" =>   "cs_dashboard",
							"std" => "",
							"type" => "select_dashboard",
							"options" => ''
						);
		$options[] = array( "name" =>__("Allow Campaigns From Frontend",'Awaken'),
							"desc" => "",
							"hint_text" =>__("Allow Non Admins to Create Campaigns From Frontend",'Awaken'),
							"id" =>   "cs_cause_campaigns_allow",
							"std" => "on",
							"type" => "checkbox",
							"options" => $on_off_option
						);
		$options[] = array( "name" =>__("New Campaigns Status",'Awaken'),
							"desc" => "",
							"hint_text" =>__("New Campaigns Visibility. You can set default status of user compaigns",'Awaken'),
							"id" =>   "cs_campaigns_visibility",
							"std" =>  "publish",
							"type" => "select",
							"options" =>array(
								"publish" => "Publish",
								"private"=>"Private",
							)
						);	
		$options[] = array( "name" =>__("Campaigns Description",'Awaken'),
						"desc" => "",
						"hint_text" =>__("It will display on User Campaigns Listing",'Awaken'),
						"id" => "cs_compaigns_text",
						"std" => "Campaigns help you organize people to achieve a common goal. Follow these simple steps and start campaigning for what you care about Get people interested with a short description of what yo are trying to do.",
						"type" => "textarea"
					);
		$options[] = array( "name" =>__("Add New Campaigns Text",'Awaken'),
						"desc" => "",
						"hint_text" =>__("It will display on Add Campaigns Page",'Awaken'),
						"id" => "cs_add_compaigns_text",
						"std" => "An event happening at a certain time and location, such as a concert, lecture, or festival.",
						"type" => "textarea"
					);
		$options[] = array( "name" =>__("Campaigns Terms & Conditions",'Awaken'),
						"desc" => "",
						"hint_text" =>__("write your own copyright text",'Awaken'),
						"id" => "cs_compaigns_terms_text",
						"std" => "Asome decently militantly versus that a enormous less treacherous genially well upon until fishy audaciously where fabulously underneath toucan armadillo far toward illustratively flawlessly shark much a emoted hey tersely pointedly much that hey quetzal up trenchant abundant made alas wildebeest overate overhung during busily burst as jeez much because more added on some thrust out.",
						"type" => "textarea"
					);	
					
					
					//cs_compaigns_terms_text									
		$options[] = array( "name" =>__("Paypal Sandbox",'Awaken'),
							"desc" => "",
							"hint_text" =>__("Paypal Sandbox On/Off",'Awaken'),
							"id" =>   "cs_paypal_sandbox",
							"std" => "on",
							"type" => "checkbox",
							"options" => $on_off_option
						);	
		$options[] = array( "name" =>__("Donor Registeration",'Awaken'),
							"desc" => "",
							"hint_text" =>__("User Registeration For Donation On/Off",'Awaken'),
							"id" =>   "cs_donation_user_register",
							"std" => "on",
							"type" => "checkbox",
							"options" => $on_off_option
						);						
		$options[] = array( "name" =>__("Paypal Email",'Awaken'),
							"desc" => "",
							"hint_text" => "",
							"id" =>   "paypal_email",
							"std" => "",
							"type" => "text");
		$ipn_url = wp_causes::plugin_url().'causes/ipn.php';
		$options[] = array( "name" =>__("Paypal Ipn Url",'Awaken'),
							"desc" => $ipn_url,
							"hint_text" => "",
							"id" =>   "paypal_ipn_url",
							"std" => $ipn_url,
							"type" => "text");
		$options[] = array( "name" => "Paypal Payments",
							"desc" => "",
							"hint_text" => "",
							"id" =>   "paypal_payments",
							"std" => "10,15,20,50,100.500,1000",
							"type" => "text");
				$currency_array = array('U.S. Dollar'=>'USD','Australian Dollar'=>'AUD','Brazilian Real'=>'BRL','Canadian Dollar'=>'CAD','Czech Koruna'=>'CZK','Danish Krone'=>'DKK','Euro'=>'EUR','Hong Kong Dollar'=>'HKD','Hungarian Forint'=>'HUF','Israeli New Sheqel'=>'ILS','Japanese Yen'=>'JPY','Malaysian Ringgit'=>'MYR','Mexican Peso'=>'MXN','Norwegian Krone'=>'NOK','New Zealand Dollar'=>'NZD','Philippine Peso'=>'PHP','Polish Zloty'=>'PLN','Pound Sterling'=>'GBP','Singapore Dollar'=>'SGD','Swedish Krona'=>'SEK','Swiss Franc'=>'CHF','Taiwan New Dollar'=>'TWD','Thai Baht'=>'THB','Turkish Lira'=>'TRY');
		$options[] = array( "name" =>__("Currency",'Awaken'),
							"desc" => "",
							"hint_text" =>__("Currency Code",'Awaken'),
							"id" =>   "paypal_currency",
							"std" =>  "publish",
							"type" => "select",
							"options" =>$currency_array
						);	
		$options[] = array( "name" =>__("Currency Sign",'Awaken'),
							"desc" => "",
							"hint_text" =>__("Use Currency Sign eg: &pound;,&yen;",'Awaken'),
							"id" =>   "paypal_currency_sign",
							"std" => "$",
							"type" => "text");										
	}
	
	
	// import and export theme options tab
	$options[] = array( "name" =>__("import & export",'Awaken'),
						"fontawesome" => 'fa fa-database',
						"id" => "tab-import-export-options",
						"std" => "",
						"type" => "main-heading",
						"options" => ""
					);	
	$options[] = array( "name" =>__("import & export",'Awaken'),
						"id" => "tab-import-export-options",
						"type" => "sub-heading"
						);	
	$options[] = array( "name" => "Export",
						"desc" => "",
						"hint_text" =>__("If you want to make changes in your site or want to preserve your current settings, Export them code by saving this code with you. You can restore your settings by pasting this code in Import section below ",'Awaken'),
						"id" => "cs_export_theme_options",
						"std" => "",
						"type" => "export"
					);	
				
	$options[] = array( "name" =>__("Import",'Awaken'),
						"desc" => "Import theme options",
						"hint_text" =>__("To Import your settings, paste the code that you got in above area and saved it with you",'Awaken'),
						"id" => "cs_import_theme_options",
						"std" => "",
						"type" => "import"
					);
					
	update_option('cs_theme_data',$options); 
	//update_option('cs_theme_options',$options); 					  
	}
}
// saving all the theme options start
/**
*
*
* Header Colors Setting
 */
 
function cs_header_setting(){
	global $header_colors;
	  $header_colors = array();
			  $header_colors['header_colors'] =array(
					  'header_2'=>array(
						  'color' =>array( 
							  	'cs_topstrip_bgcolor'   =>  '#4c4c4c',
							 	'cs_topstrip_text_color' =>  '#ffffff',
								'cs_topstrip_link_color'  =>  '#ffffff',
							 	'cs_header_bgcolor'   =>  '',
							 	'cs_nav_bgcolor'    =>  '#e17a26',
							 	'cs_menu_color'    => '#ffffff',
							 	'cs_menu_active_color'  => '#ffffff',
							 	'cs_submenu_bgcolor'  => '#ffffff',
							 	'cs_submenu_color'   => '#666666',
							 	'cs_submenu_hover_color' => '#e17a26',
						  ),
						  'logo' =>array(
							  'cs_logo_with'			=> 	'159',
							  'cs_logo_height'		=> 	'41',
							  'cs_logo_margintb' 		=> 	'0',
							  'cs_logo_marginlr' 		=> 	'0',
						  )
				  ),
			  );
			  	
			  return $header_colors;
}