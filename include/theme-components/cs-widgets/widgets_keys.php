<?php
if(!function_exists('cs_activate_widget')){
	
	function cs_activate_widget(){
		
		$sidebars_widgets = get_option('sidebars_widgets');
	
	/********************** Footer Siderbar Setting Start **********************/
	
		 /* ---- Footer Contact Us --- */
		/*----------------------------*/
			$footer_contactinfo = array();
			$footer_contactinfo[1] = array(
				'image_url' => get_template_directory_uri().'/assets/images/logo-footer.png',
				'address' => 'Awaken Chrch<br>2345 Setwant natrer, 1234,<br>Washington. United States.<br>(401) 1234 567',
				'phone' => 'Phone: <a href="tel:+44 1234 5678">(0044) 1234 5678</a>',
				'fax' => 'Fax: <a href="tel:+44 1234 5678">(0044) 1234 5678</a>',
				'email' => 'Email: <a href="mailto:hello@awaken.com">hello@awaken.com</a>',
			);						
			$footer_contactinfo['_multiwidget'] = '1';
			update_option('widget_contactinfo',$footer_contactinfo);
			$footer_contactinfo = get_option('widget_contactinfo');
			krsort($footer_contactinfo);
			foreach($footer_contactinfo as $key1=>$val1){
				$footer_contactinfo_key = $key1;
				if(is_int($footer_contactinfo_key)){
					break;
				}
			}
				
		 /* ---- Footer Latest Posts --- */
		/*----------------------------*/
			$footer_recent_post = array();
			$footer_recent_post[1] = array(
					"title"		=>	'Latest Posts',
					"select_category" 	=> '',
					"showcount" => '3',
					"thumb" => false
					);					
			$footer_recent_post['_multiwidget'] = '1';
			update_option('widget_recentposts',$footer_recent_post);
			$footer_recent_post = get_option('widget_recentposts');
			krsort($footer_recent_post);
			foreach($footer_recent_post as $key1=>$val1){
				$footer_recent_post_key = $key1;
				if(is_int($footer_recent_post_key)){
					break;
				}
			} 
		
		 /* ---- Footer Flickr Gallery --- */
		/*----------------------------*/
			$footer_flickr_gallery = array();
			$footer_flickr_gallery[1] = array(
					"title"		=>	'Flickr Gallery',
					"username" 	=> 'dspn',
					"no_of_photos" => '12',
					);					
			$footer_flickr_gallery['_multiwidget'] = '1';
			update_option('widget_cs_flickr',$footer_flickr_gallery);
			$footer_flickr_gallery = get_option('widget_cs_flickr');
			krsort($footer_flickr_gallery);
			foreach($footer_flickr_gallery as $key1=>$val1){
				$footer_flickr_gallery_key = $key1;
				if(is_int($footer_flickr_gallery_key)){
					break;
				}
			} 
		
		 /* ---- Footer Contact Form Widget --- */
		/*----------------------------*/
			$footer_contact_form = array();
			$footer_contact_form[1] = array(
					"title"		=>	'Leave us a Message',
					"contact_email" 	=> get_bloginfo('admin_email'),
					"contact_succ_msg" => 'Message Sent Successfully.',
					);					
			$footer_contact_form['_multiwidget'] = '1';
			update_option('widget_cs_contact_msg',$footer_contact_form);
			$footer_contact_form = get_option('widget_cs_contact_msg');
			krsort($footer_contact_form);
			foreach($footer_contact_form as $key1=>$val1){
				$footer_contact_form_key = $key1;
				if(is_int($footer_contact_form_key)){
					break;
				}
			}
			
		 /* ---- Default Sidebar Project Widget --- */
		/*----------------------------*/
			$projects = array();
			$projects[1] = array(
					"title"		=>	'Recent Projects',
					"select_category" 	=> '',
					"showcount" => '5',
					);					
			$projects['_multiwidget'] = '1';
			update_option('widget_cs_recent_projects',$projects);
			$projects = get_option('widget_cs_recent_projects');
			krsort($projects);
			foreach($projects as $key1=>$val1){
				$projects_key = $key1;
				if(is_int($projects_key)){
					break;
				}
			} 
			
		 /* ---- Default Sidebar Sermons Widget --- */
		/*----------------------------*/
			$sermons = array();
			$sermons[1] = array(
					"title"		=>	'Recent Sermons',
					"select_category" 	=> '',
					"showcount" => '5',
					);					
			$sermons['_multiwidget'] = '1';
			update_option('widget_cs_sermons',$sermons);
			$sermons = get_option('widget_cs_sermons');
			krsort($sermons);
			foreach($sermons as $key1=>$val1){
				$sermons_key = $key1;
				if(is_int($sermons_key)){
					break;
				}
			}
		
		 /* ---- Default Sidebar Causes Widget --- */
		/*----------------------------*/
			$causes = array();
			$causes[1] = array(
					"title"		=>	'Recent Causes',
					"select_category" 	=> '',
					"showcount" => '5',
					);					
			$causes['_multiwidget'] = '1';
			update_option('widget_cs_causes',$causes);
			$causes = get_option('widget_cs_causes');
			krsort($causes);
			foreach($causes as $key1=>$val1){
				$causes_key = $key1;
				if(is_int($causes_key)){
					break;
				}
			}
		
		 /* ---- Default Sidebar Facebook widget setting --- */
		/*----------------------------------*/
	
			$facebook_module = array();
			$facebook_module[1] = array(
					"title"		=> 'Facebook',
					"pageurl" 	=> "https://www.facebook.com/envato",
					"showfaces" => "on",
					"showstream" => "",
					"likebox_height" => "265",
					"fb_bg_color" => "#ffffff",
					);						
			$facebook_module['_multiwidget'] = '1';
			update_option('widget_facebook_module',$facebook_module);
			$facebook_module = get_option('widget_facebook_module');
			krsort($facebook_module);
			foreach($facebook_module as $key1=>$val1) {
				$facebook_module_key = $key1;
				if(is_int($facebook_module_key)) {
					break;
				}
			}
		
		 /* ---- Default Sidebar Twitter widget setting ----- */
		/*-----------------------------------*/
			$cs_twitter_widget = array();
			$cs_twitter_widget[1] = array(
					"title"		=>	'Twitter',
					"username" 	=>	"envato",
					"numoftweets" => "3",
					);						
			$cs_twitter_widget['_multiwidget'] = '1';
			update_option('widget_cs_twitter_widget',$cs_twitter_widget);
			$cs_twitter_widget = get_option('widget_cs_twitter_widget');
			krsort($cs_twitter_widget);
			foreach($cs_twitter_widget as $key1=>$val1){
				$cs_twitter_widget_key = $key1;
				if(is_int($cs_twitter_widget_key)){
					break;
				}
			}
		
		 /* ---- Event Sidebar Search widget setting --- */
		/*--------------------------------*/
			$search = array();
			$search[1] = array(
				"title"		=>	'',
			);
	
			$search['_multiwidget'] = '1';
			update_option('widget_search',$search);
			$search = get_option('widget_search');
			krsort($search);
			foreach($search as $key1=>$val1){
				$search_key = $key1;
				if(is_int($search_key)){
					break;
				}
			}
		
		 /* ---- Event Sidebar Event Calendar widget setting --- */
		/*--------------------------------*/
			$events_calander = array();
			$events_calander[1] = array(
				"title"		=>	'EVENTS CALENDER',
				"get_post_slug"		=>	'',
				"showcount"		=>	'1',
			);
	
			$events_calander['_multiwidget'] = '1';
			update_option('widget_upcoming_events_calander',$events_calander);
			$events_calander = get_option('widget_upcoming_events_calander');
			krsort($events_calander);
			foreach($events_calander as $key1=>$val1){
				$events_calander_key = $key1;
				if(is_int($events_calander_key)){
					break;
				}
			}
		
		 /* ------- Event Sidebar Custom Menu widget ------- */
		/*---------------------------------------------------*/
			$nav_menu_footer = array();
			$menu_name = 'Events';
			$footer_menu_id = '';
			$menu_object = wp_get_nav_menu_object( $menu_name );
			if ( ( $menu_object = wp_get_nav_menu_object( $menu_name ) ) && isset( $menu_object->term_id ) ) {
				$footer_menu_id = $menu_object->term_id;
			}
			$nav_menu_footer[1] = array(
				"title"		=>	'EVENT CETAGORIES',
				"nav_menu"		=>	$footer_menu_id,
			);	
	
			$nav_menu_footer['_multiwidget'] = '1';
			update_option('widget_nav_menu',$nav_menu_footer);
			$nav_menu_footer = get_option('widget_nav_menu');
			krsort($nav_menu_footer);
			foreach($nav_menu_footer as $key1=>$val1){
				$nav_menu_footer_key = $key1;
				if(is_int($nav_menu_footer_key)){
					break;
				}
			}
		
		 /* ---- Event Sidebar Event Map widget setting --- */
		/*--------------------------------*/
			$events_map = array();
			$events_map[1] = array(
				"title"		=>	'EVENTS MAP',
				"get_post_slug"		=>	'',
				"showcount"		=>	'10',
			);
	
			$events_map['_multiwidget'] = '1';
			update_option('widget_events_map',$events_map);
			$events_map = get_option('widget_events_map');
			krsort($events_map);
			foreach($events_map as $key1=>$val1){
				$events_map_key = $key1;
				if(is_int($events_map_key)){
					break;
				}
			}
			
		 /* ---- Event Sidebar Twitter widget setting --- */
		/*--------------------------------*/
			$event_twitter_widget = array();
			$event_twitter_widget[2] = array(
					"title"		=>	'TWITTER FEEDS',
					"username" 	=>	"envato",
					"numoftweets" => "3",
					);						
			$event_twitter_widget['_multiwidget'] = '1';
			update_option('widget_cs_twitter_widget',$event_twitter_widget);
			$event_twitter_widget = get_option('widget_cs_twitter_widget');
			krsort($event_twitter_widget);
			foreach($event_twitter_widget as $key1=>$val1){
				$event_twitter_widget_key = $key1;
				if(is_int($event_twitter_widget_key)){
					break;
				}
			}
			
		
		 /* ---- Blog Sidebar Recent Posts --- */
		/*----------------------------*/
			$blog_recent_post = array();
			$blog_recent_post[2] = array(
					"title"		=>	'Latest Posts',
					"select_category" 	=> '',
					"showcount" => '4',
					"thumb" => true
					);					
			$blog_recent_post['_multiwidget'] = '1';
			update_option('widget_recentposts',$blog_recent_post);
			$blog_recent_post = get_option('widget_recentposts');
			krsort($blog_recent_post);
			foreach($blog_recent_post as $key1=>$val1){
				$blog_recent_post_key = $key1;
				if(is_int($blog_recent_post_key)){
					break;
				}
			}
		
		 /* ---- Blog Sidebar text widget ---- */
		/*---------------------------*/
			$text = array();
			$text = get_option('widget_text');
			$text[1] = array(
				'title' => 'TEXT WIDGET',
				'text' => 'Bhat sneered vivaciously that thus are they poroise uncriti cal gosh and be to the that thus are much and vivaciously that thus are they poroise uncritical gosh and be to thvivaci ously that thus are they Bhat sneered vivaciously that thus are they.',
			);						
			$text['_multiwidget'] = '1';
			update_option('widget_text',$text);
			$text = get_option('widget_text');
			krsort($text);
			foreach($text as $key1=>$val1){
				$text_key = $key1;
				if(is_int($text_key)){
					break;
				}
			}
			
		 /* ------  Blog Sidebar Tags ----- */
		/*--------------------------------*/
			$tag_cloud = array();
	
			$tag_cloud[1] = array(
	
			"title"		=>	'TAG CLOUD',
			"taxonomy" => 'post_tag',
			);
	
			$tag_cloud['_multiwidget'] = '1';
			update_option('widget_tag_cloud',$tag_cloud);
			$tag_cloud = get_option('widget_tag_cloud');
			krsort($tag_cloud);
			foreach($tag_cloud as $key1=>$val1){
				$tag_cloud_key = $key1;
				if(is_int($tag_cloud_key)){
					break;
				}
			}
		
		 /* ---- Blog Sidebar Twitter widget setting --- */
		/*--------------------------------*/
			$blog_twitter_widget = array();
			$blog_twitter_widget[3] = array(
					"title"		=>	'TWITTER FEEDS',
					"username" 	=>	"envato",
					"numoftweets" => "3",
					);						
			$blog_twitter_widget['_multiwidget'] = '1';
			update_option('widget_cs_twitter_widget',$blog_twitter_widget);
			$blog_twitter_widget = get_option('widget_cs_twitter_widget');
			krsort($blog_twitter_widget);
			foreach($blog_twitter_widget as $key1=>$val1){
				$blog_twitter_widget_key = $key1;
				if(is_int($blog_twitter_widget_key)){
					break;
				}
			}
		
		 /* ---- Sermon Sidebar Sermons Widget --- */
		/*----------------------------*/
			$ser_sermons = array();
			$ser_sermons[2] = array(
					"title"		=>	'Recent Sermons',
					"select_category" 	=> '',
					"showcount" => '5',
					);					
			$ser_sermons['_multiwidget'] = '1';
			update_option('widget_cs_sermons',$ser_sermons);
			$ser_sermons = get_option('widget_cs_sermons');
			krsort($ser_sermons);
			foreach($ser_sermons as $key1=>$val1){
				$ser_sermons_key = $key1;
				if(is_int($ser_sermons_key)){
					break;
				}
			}
			
		 /* ---- Sermon Sidebar Recent Posts --- */
		/*----------------------------*/
			$sermon_recent_post = array();
			$sermon_recent_post[3] = array(
					"title"		=>	'Recent Posts',
					"select_category" 	=> '',
					"showcount" => '5',
					"thumb" => false
					);					
			$sermon_recent_post['_multiwidget'] = '1';
			update_option('widget_recentposts',$sermon_recent_post);
			$sermon_recent_post = get_option('widget_recentposts');
			krsort($sermon_recent_post);
			foreach($sermon_recent_post as $key1=>$val1){
				$sermon_recent_post_key = $key1;
				if(is_int($sermon_recent_post_key)){
					break;
				}
			}
		
		 /* ------  Sermon Sidebar Tags ----- */
		/*--------------------------------*/
			$tag_cloud = array();
	
			$tag_cloud[2] = array(
	
			"title"		=>	'TAG CLOUD',
			"taxonomy" => 'sermon-tag',
			);
	
			$tag_cloud['_multiwidget'] = '1';
			update_option('widget_tag_cloud',$tag_cloud);
			$tag_cloud = get_option('widget_tag_cloud');
			krsort($tag_cloud);
			foreach($tag_cloud as $key1=>$val1){
				$tag_cloud_key = $key1;
				if(is_int($tag_cloud_key)){
					break;
				}
			}
		
		 /* ------  Event Detail Sidebar Tags ----- */
		/*--------------------------------*/
			$upcoming_events = array();
			$upcoming_events[1] = array(
				"title"	=> "UPCOMING EVENTS",
				"get_post_slug" => "",
				"showcount" => "3"
			);
			$upcoming_events['_multiwidget'] = '1';
			update_option('widget_upcoming_events',$upcoming_events);
			$upcoming_events = get_option('widget_upcoming_events');
			krsort($upcoming_events);
			foreach($upcoming_events as $key1=>$val1){
				$upcoming_events_key = $key1;
				if(is_int($upcoming_events_key)){
					break;
				}
			}
		
		 /* ------  Causes Sidebar Donation ----- */
		/*--------------------------------*/
			$donation = array();
			$donation[1] = array(
				"title"	=> "Make A Donation",
			);
			$donation['_multiwidget'] = '1';
			update_option('widget_cs_donation',$donation);
			$donation = get_option('widget_cs_donation');
			krsort($donation);
			foreach($donation as $key1=>$val1){
				$donation_key = $key1;
				if(is_int($donation_key)){
					break;
				}
			}
			
		 /* ------  Causes Sidebar Top Causes ----- */
		/*--------------------------------*/
			$top_causes = array();
			$top_causes[1] = array(
					"title"		=>	'Top Causes',
					"select_category" 	=> '',
					"showcount" => '5',
					);					
			$top_causes['_multiwidget'] = '1';
			update_option('widget_cs_causes',$top_causes);
			$top_causes = get_option('widget_cs_causes');
			krsort($top_causes);
			foreach($top_causes as $key1=>$val1){
				$top_causes_key = $key1;
				if(is_int($top_causes_key)){
					break;
				}
			}
			
		 /* ------  Causes Sidebar custom Menu ----- */
		/*--------------------------------*/
			$causes_cus_menu = array();
			$menu_name = 'Casue Cat';
			$footer_menu_id = '';
			$menu_object = wp_get_nav_menu_object( $menu_name );
			if ( ( $menu_object = wp_get_nav_menu_object( $menu_name ) ) && isset( $menu_object->term_id ) ) {
				$footer_menu_id = $menu_object->term_id;
			}
			$causes_cus_menu[1] = array(
				"title"		=>	'Cause Cetagories',
				"nav_menu"		=>	$footer_menu_id,
			);	
	
			$causes_cus_menu['_multiwidget'] = '1';
			update_option('widget_nav_menu',$causes_cus_menu);
			$causes_cus_menu = get_option('widget_nav_menu');
			krsort($causes_cus_menu);
			foreach($causes_cus_menu as $key1=>$val1){
				$causes_cus_menu_key = $key1;
				if(is_int($causes_cus_menu_key)){
					break;
				}
			}
		
		 /* ---- News Sidebar Latest Posts --- */
		/*----------------------------*/
			$news_recent_post = array();
			$news_recent_post[4] = array(
					"title"		=>	'Latest Posts',
					"select_category" 	=> 'news',
					"showcount" => '5',
					"thumb" => true
					);					
			$news_recent_post['_multiwidget'] = '1';
			update_option('widget_recentposts',$news_recent_post);
			$news_recent_post = get_option('widget_recentposts');
			krsort($news_recent_post);
			foreach($news_recent_post as $key1=>$val1){
				$news_recent_post_key = $key1;
				if(is_int($news_recent_post_key)){
					break;
				}
			} 
		
		 /* ---- News Sidebar Project Widget --- */
		/*----------------------------*/
			$news_projects = array();
			$news_projects[2] = array(
					"title"		=>	'PROJECT NEWS',
					"select_category" 	=> '',
					"showcount" => '5',
					);					
			$news_projects['_multiwidget'] = '1';
			update_option('widget_cs_recent_projects',$news_projects);
			$news_projects = get_option('widget_cs_recent_projects');
			krsort($news_projects);
			foreach($news_projects as $key1=>$val1){
				$news_projects_key = $key1;
				if(is_int($news_projects_key)){
					break;
				}
			}
			
		 /* ------  News Sidebar custom Menu ----- */
		/*--------------------------------*/
			$news_cus_menu = array();
			$menu_name = 'Events';
			$footer_menu_id = '';
			$menu_object = wp_get_nav_menu_object( $menu_name );
			if ( ( $menu_object = wp_get_nav_menu_object( $menu_name ) ) && isset( $menu_object->term_id ) ) {
				$footer_menu_id = $menu_object->term_id;
			}
			$news_cus_menu[1] = array(
				"title"		=>	'Cause Cetagories',
				"nav_menu"		=>	$footer_menu_id,
			);	
	
			$news_cus_menu['_multiwidget'] = '1';
			update_option('widget_nav_menu',$news_cus_menu);
			$news_cus_menu = get_option('widget_nav_menu');
			krsort($news_cus_menu);
			foreach($news_cus_menu as $key1=>$val1){
				$news_cus_menu_key = $key1;
				if(is_int($news_cus_menu_key)){
					break;
				}
			}
		
	
	/* ----  Add widgets in sidebars  --- */
	/*-----------------------------------*/
		$sidebars_widgets['default_pages'] = array("cs_recent_projects-$projects_key", "cs_sermons-$sermons_key", "cs_causes-$causes_key", "facebook_module-$facebook_module_key", "cs_twitter_widget-$cs_twitter_widget_key");
		$sidebars_widgets['events_sidebar'] = array("search-$search_key", "upcoming_events_calander-$events_calander_key", "nav_menu-$nav_menu_footer_key", "events_map-$events_map_key", "cs_twitter_widget-$event_twitter_widget_key");
		$sidebars_widgets['blogs_sidebar'] = array("recentposts-$blog_recent_post_key", "text-$text_key", "tag_cloud-$tag_cloud_key", "cs_twitter_widget-$blog_twitter_widget_key");
		$sidebars_widgets['shop_listing_sidebar'] = array();
		$sidebars_widgets['shop_detail_sidebar'] = array();
		$sidebars_widgets['projects_sidebar'] = array();
		$sidebars_widgets['sermons_sidebar'] = array("cs_sermons-$ser_sermons_key", "recentposts-$sermon_recent_post_key", "recentposts-$sermon_recent_post_key");
		$sidebars_widgets['event_detail'] = array("upcoming_events_calander-$events_calander_key", "events_map-$events_map_key", "upcoming_events-$upcoming_events_key", "cs_twitter_widget-$event_twitter_widget_key");
		$sidebars_widgets['cause_detail'] = array("cs_donation-$donation_key", "cs_causes-$top_causes_key", "cs_flickr-$footer_flickr_gallery_key");
		$sidebars_widgets['causes'] = array("search-$search_key", "nav_menu-$causes_cus_menu_key", "cs_causes-$top_causes_key");
		$sidebars_widgets['news_sidebar'] = array("recentposts-$news_projects_key", "cs_recent_projects-$news_projects_key", "nav_menu-$news_cus_menu_key");
		$sidebars_widgets['footer-widget-1'] = array("contactinfo-$footer_contactinfo_key", "cs_flickr-$footer_flickr_gallery_key", "recentposts-$footer_recent_post_key", "cs_contact_msg-$footer_contact_form_key");
		
		update_option('sidebars_widgets',$sidebars_widgets); //save widget informations
	
	}
}