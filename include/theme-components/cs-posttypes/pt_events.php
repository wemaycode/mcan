<?php
	
	//adding columns start
    add_filter('manage_events_posts_columns', 'events_columns_add');
	function events_columns_add($columns) {
		$columns['category'] = 'Category';
		$columns['author'] = 'Author';
		return $columns;
	}
    add_action('manage_events_posts_custom_column', 'events_columns');
	function events_columns($name) {
		global $post;
		switch ($name) {
			case 'category':
				$categories = get_the_terms( $post->ID, 'event-category' );
					if($categories <> ""){
						$couter_comma = 0;
						foreach ( $categories as $category ) {
							echo esc_attr($category->name);
							$couter_comma++;
							if ( $couter_comma < count($categories) ) {
								echo ", ";
							}
						}
					}
				break;
			case 'author':
				echo get_the_author();
				break;
		}
	}
	//adding columns end
	if ( ! function_exists( 'cs_events_register' ) ) {
		function cs_events_register() {
			$labels = array(
				'name' => 'Events',
				'all_items' => __('Events','Awaken'),
				'add_new_item' => 'Add New Event',
				'edit_item' => 'Edit Event',
				'new_item' => 'New Event Item',
				'add_new' => 'Add New Event',
				'view_item' => 'View Event Item',
				'search_items' => 'Search Event',
				'not_found' =>  'Nothing found',
				'not_found_in_trash' => 'Nothing found in Trash',
				'parent_item_colon' => ''
			);
			
			$args = array(
				'labels' => $labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'query_var' => true,
				'menu_icon' => 'dashicons-book',
				'rewrite' => true,
				'capability_type' => 'post',
				'has_archive' => false,
				'map_meta_cap' => true,
				'hierarchical' => false,
				'menu_position' => null,
				'supports' => array('title','editor','thumbnail','comments')
			); 
			register_post_type( 'events' , $args );
		}
		add_action('init', 'cs_events_register');
	}
		// adding cat start
		  $labels = array(
			'name' => 'Event Categories',
			'search_items' => 'Search Event Categories',
			'edit_item' => 'Edit Event Category',
			'update_item' => 'Update Event Category',
			'add_new_item' => 'Add New Category',
			'menu_name' => 'Categories',
		  ); 	
		  register_taxonomy('event-category',array('events'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'event-category' ),
		  ));
		// adding cat end
		// adding tag start
		  $labels = array(
			'name' => 'Event Tags',
			'singular_name' => 'event-tag',
			'search_items' => 'Search Tags',
			'popular_items' => 'Popular Tags',
			'all_items' => 'All Tags',
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => 'Edit Tag', 
			'update_item' => 'Update Tag',
			'add_new_item' => 'Add New Tag',
			'new_item_name' => 'New Tag Name',
			'separate_items_with_commas' => 'Separate tags with commas',
			'add_or_remove_items' => 'Add or remove tags',
			'choose_from_most_used' => 'Choose from the most used tags',
			'menu_name' => 'Tags',
		  ); 
		  register_taxonomy('event-tag','events',array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var' => true,
			'rewrite' => array( 'slug' => 'event-tag' ),
		  ));
		// adding tag end

	// adding course meta info start
	add_action( 'add_meta_boxes', 'cs_meta_event_add' );
	function cs_meta_event_add(){  
		add_meta_box( 'cs_meta_event', 'Event Options', 'cs_meta_event', 'events', 'normal', 'high' );  
	}
	function cs_meta_event( $post ) {
		global $post,$cs_xmlObject;
		$cs_theme_options=get_option('cs_theme_options');
		$course_post_id = $post->ID;
		$cs_builtin_seo_fields =$cs_theme_options['cs_builtin_seo_fields'];
		$cs_header_position =$cs_theme_options['cs_header_position'];
		$cs_event = get_post_meta($post->ID, "events", true);
		if ( $cs_event <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($cs_event);
			$dynamic_event_members = explode(',', $cs_xmlObject->dynamic_event_members);
			
		} else {
			
			$dynamic_event_members = '';
			if(!isset($cs_xmlObject))
				$cs_xmlObject = new stdClass();
		}
				
		cs_enqueue_timepicker_script();
		?>		
		<div class="page-wrap page-opts left" style="overflow:hidden; position:relative; height: 1432px;">
			<div class="option-sec" style="margin-bottom:0;">
				<div class="opt-conts">
					<div class="elementhidden">
						<div class="tabs vertical">
							<nav class="admin-navigtion">
								<ul id="myTab" class="nav nav-tabs">
									<li class="active"><a href="#tab-general-settings" data-toggle="tab"><i class="fa fa-cog"></i><?php _e('General','Awaken');?></a></li>
									<li><a href="#tab-subheader-options" data-toggle="tab"><i class="fa fa-indent"></i> <?php _e('Sub Header','Awaken');?> </a></li>
									<?php if($cs_header_position == 'absolute'){?>
                 						<li><a href="#tab-header-position-settings" data-toggle="tab"><i class="fa fa-forward"></i><?php _e('Header Absolute','Awaken');?></a></li>
                 					<?php }?>
									<?php if($cs_builtin_seo_fields == 'on'){?>
									<li><a href="#tab-seo-advance-settings" data-toggle="tab"><i class="fa fa-dribbble"></i> <?php _e('SEO Options','Awaken');?></a></li>
									<?php }?>
 									<li><a href="#tab-member-settings" data-toggle="tab"><i class="fa fa-users"></i><?php _e('Speakers','Awaken'); ?></a></li>
                                    <li><a href="#tab-location-settings"  class="tab-location-map" data-toggle="tab"><i class="fa fa-globe"></i><?php _e('Location','Awaken');?></a></li>
                                    <li><a data-toggle="tab" href="#tab-events-settings-cs-events"><i class="fa fa-briefcase"></i><?php _e('Event Options','Awaken'); ?></a></li>
 							  </ul>
						  </nav>
							<div class="tab-content">
							<div id="tab-subheader-options" class="tab-pane fade">
								<?php cs_subheader_element();?>
							</div>
							<div id="tab-general-settings" class="tab-pane fade active in">
								<?php 
									cs_general_settings_element();
									cs_sidebar_layout_options();
								?>
							</div>
 							<?php if($cs_builtin_seo_fields == 'on'){?>
							<div id="tab-seo-advance-settings" class="tab-pane fade">
								<?php cs_seo_settitngs_element();?>
							</div>
							<?php }
                            if($cs_header_position == 'absolute'){?>
                             <div id="tab-header-position-settings" class="tab-pane fade">
                                 <?php cs_header_postition_element();?>
                            </div>
                            <?php } ?>
							<div id="tab-member-settings" class="tab-pane fade">
								<ul class="form-elements">
										<li class="to-label"><label><?php _e('Select Members','Awaken'); ?></label></li>
										<li class="to-field select-style">
 										<?php
										
											$blogusers = get_users('orderby=nicename');
											echo '<select name="dynamic_event_members[]" id="dynamic_event_members" multiple="multiple" style="height:200px !important;">
													<option value="">None</option>';
													  foreach ($blogusers as $user) {?>
													<?php
													if(in_array($user->ID, $dynamic_event_members)){
														$selected =' selected="selected"';
													}else{ 
														$selected = '';
													}
													echo '<option value="'.$user->ID.'" '.$selected.'>'.$user->display_name.'</option>';
													 ?>
											<?php }
											echo '</select>';
										?>
                                        </li>
									 </ul>
							</div>
                            <div id="tab-location-settings" class="tab-pane fade">
                            	<?php cs_location_fields(); ?>
                            </div>
                            <div id="tab-events-settings-cs-events" class="tab-pane fade">
                            	<?php cs_post_event_fields(); ?>
                            </div>
                            
 						  </div>
						</div>
					  </div>
					</div>
				<input type="hidden" name="event_meta_form" value="1" />
			</div>
		</div>
		<div class="clear"></div>
	<?php 
    }
 	// Course Meta option save
	if ( isset($_POST['event_meta_form']) and $_POST['event_meta_form'] == 1 ) {
		add_action( 'save_post', 'cs_meta_event_save' );  
		function cs_meta_event_save( $post_id ){  
			$sxe = new SimpleXMLElement("<event></event>");
			// Location Map
			
			if (empty($_POST['dynamic_post_location_latitude'])){ $_POST['dynamic_post_location_latitude'] = '';}
			if (empty($_POST['dynamic_post_location_longitude'])){ $_POST['dynamic_post_location_longitude'] = '';}
			if (empty($_POST['dynamic_post_location_zoom'])){ $_POST['dynamic_post_location_zoom'] = '';}
			if (empty($_POST['dynamic_post_location_address'])){ $_POST['dynamic_post_location_address'] = '';}
			if (empty($_POST['loc_city'])){ $_POST['loc_city'] = '';}
			if (empty($_POST['loc_postcode'])){ $_POST['loc_postcode'] = '';}
			if (empty($_POST['loc_region'])){ $_POST['loc_region'] = '';}
			if (empty($_POST['loc_country'])){ $_POST['loc_country'] = '';}
			if (empty($_POST['event_map_switch'])){ $_POST['event_map_switch'] = '';}
			if (empty($_POST['event_map_heading'])){ $_POST['event_map_heading'] = '';}
			
			if (empty($_POST['dynamic_post_event_from_date'])){ $_POST['dynamic_post_event_from_date'] = "";}
			if (empty($_POST['dynamic_post_event_to_date'])){ $_POST['dynamic_post_event_to_date'] = "";}
			if (empty($_POST['dynamic_post_event_start_time'])){ $_POST['dynamic_post_event_start_time'] = "";}
			if (empty($_POST['dynamic_post_event_end_time'])){ $_POST['dynamic_post_event_end_time'] = "";}
			if (empty($_POST['dynamic_post_event_all_day'])){ $_POST['dynamic_post_event_all_day'] = "";}
			if (empty($_POST['dynamic_post_event_address'])){ $_POST['dynamic_post_event_address'] = "";}
			if (empty($_POST['dynamic_post_event_ticket_options'])){ $_POST['dynamic_post_event_ticket_options'] = "";}
			if (empty($_POST['dynamic_post_event_buy_now'])){ $_POST['dynamic_post_event_buy_now'] = "";}
			if (empty($_POST['dynamic_post_event_ticket_color'])){ $_POST['dynamic_post_event_ticket_color'] = "";}
			if (empty($_POST['dynamic_post_event_contact_no'])){ $_POST['dynamic_post_event_contact_no'] = "";}
			if (empty($_POST['dynamic_post_event_email'])){ $_POST['dynamic_post_event_email'] = "";}
			if (empty($_POST['dynamic_post_event_web_url'])){ $_POST['dynamic_post_event_web_url'] = "";}
			if (empty($_POST['dynamic_event_members'])){ $_POST['dynamic_event_members'] = '';}
			
			// Location Map
			$sxe->addChild('dynamic_post_location_latitude', $_POST['dynamic_post_location_latitude']);
			$sxe->addChild('dynamic_post_location_longitude', $_POST['dynamic_post_location_longitude']);
			$sxe->addChild('dynamic_post_location_zoom', $_POST['dynamic_post_location_zoom']);
			$sxe->addChild('dynamic_post_location_address', $_POST['dynamic_post_location_address']);
			$sxe->addChild('loc_city', $_POST['loc_city']);
			$sxe->addChild('loc_postcode', $_POST['loc_postcode']);
			$sxe->addChild('loc_region', $_POST['loc_region']);
			$sxe->addChild('loc_country', $_POST['loc_country']);
			$sxe->addChild('event_map_switch', $_POST['event_map_switch']);
			$sxe->addChild('event_map_heading', $_POST['event_map_heading']);
			
			$sxe->addChild('dynamic_post_event_from_date', $_POST['dynamic_post_event_from_date']);
			$sxe->addChild('dynamic_post_event_to_date', $_POST['dynamic_post_event_to_date']);
			$sxe->addChild('dynamic_post_event_start_time', $_POST['dynamic_post_event_start_time']);
			$sxe->addChild('dynamic_post_event_end_time', $_POST['dynamic_post_event_end_time']);
			$sxe->addChild('dynamic_post_event_all_day', $_POST['dynamic_post_event_all_day']);
			$sxe->addChild('dynamic_post_event_address', $_POST['dynamic_post_event_address']);
			$sxe->addChild('dynamic_post_event_ticket_options', $_POST['dynamic_post_event_ticket_options']);
			$sxe->addChild('dynamic_post_event_buy_now', $_POST['dynamic_post_event_buy_now']);
			$sxe->addChild('dynamic_post_event_ticket_color', $_POST['dynamic_post_event_ticket_color']);
			$sxe->addChild('dynamic_post_event_contact_no', $_POST['dynamic_post_event_contact_no']); 
			$sxe->addChild('dynamic_post_event_email', $_POST['dynamic_post_event_email']);
			$sxe->addChild('dynamic_post_event_web_url', $_POST['dynamic_post_event_web_url']);
			if ( ! empty($_POST['dynamic_event_members']) and is_array($_POST['dynamic_event_members'])){
				$sxe->addChild('dynamic_event_members', implode(',',$_POST['dynamic_event_members']));
				$event_organizer = implode(',',$_POST['dynamic_event_members']);
			}
			else{
				$sxe->addChild('dynamic_event_members', '');
				$event_organizer = '';
			}
			
			$sxe = cs_page_options_save_xml($sxe);
			
			if ( isset ( $_POST["dynamic_post_event_from_date"] ) && $_POST["dynamic_post_event_from_date"] != '') {
				$cs_event_datetime = $_POST["dynamic_post_event_from_date"].' '.$_POST["dynamic_post_event_start_time"];
				update_post_meta( $post_id, 'cs_dynamic_event_from_date_time',strtotime($cs_event_datetime));
			}
			update_post_meta( $post_id, "dynamic_post_event_from_date",$_POST["dynamic_post_event_from_date"]);		
			update_post_meta( $post_id, 'events', $sxe->asXML() );
			update_post_meta( $post_id, 'dynamic_event_members',$event_organizer );
		}
	}
	// adding Event meta info end
 ?>