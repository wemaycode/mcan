<?php
	require_once 'pt_functions.php';

	//adding columns start
    add_filter('manage_csprojects_posts_columns', 'csprojects_columns_add');
	function csprojects_columns_add($columns) {
		$columns['category'] = 'Category';
		$columns['author'] = 'Author';
		return $columns;
	}
    add_action('manage_csprojects_posts_custom_column', 'csprojects_columns');
	function csprojects_columns($name) {
		global $post;
		switch ($name) {
			case 'category':
				$categories = get_the_terms( $post->ID, 'project-category' );
					if($categories <> ""){
						$couter_comma = 0;
						foreach ( $categories as $category ) {
							echo cs_allow_special_char($category->name);
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
	if ( ! function_exists( 'cs_csprojects_register' ) ) {
		function cs_csprojects_register() {
			$labels = array(
				'name' => 'Projects',
				'all_items' => __('Projects','Awaken'),
				'add_new_item' => 'Add New Project',
				'edit_item' => 'Edit Project',
				'new_item' => 'New Project Item',
				'add_new' => 'Add New Project',
				'view_item' => 'View Project Item',
				'search_items' => 'Search Project',
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
			register_post_type( 'project' , $args );
		}
		add_action('init', 'cs_csprojects_register');
	}
		// adding cat start
		  $labels = array(
			'name' => 'Project Categories',
			'search_items' => 'Search Project Categories',
			'edit_item' => 'Edit Project Category',
			'update_item' => 'Update Project Category',
			'add_new_item' => 'Add New Category',
			'menu_name' => 'Categories',
		  ); 	
		  register_taxonomy('project-category',array('project'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'project-category' ),
		  ));
		// adding cat end
		// adding tag start
		  $labels = array(
			'name' => 'Project Tags',
			'singular_name' => 'project-tag',
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
		  register_taxonomy('project-tag','project',array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var' => true,
			'rewrite' => array( 'slug' => 'project-tag' ),
		  ));
		// adding tag end

	// adding Project meta info start
	add_action( 'add_meta_boxes', 'cs_meta_project_add' );
	function cs_meta_project_add(){
		add_meta_box( 'cs_meta_project', 'Project Options', 'cs_meta_project', 'project', 'normal', 'high' );  
	}
	function cs_meta_project( $post ) {
		global $post, $cs_xmlObject;
		$cs_theme_options = get_option('cs_theme_options');
		$cs_builtin_seo_fields = $cs_theme_options['cs_builtin_seo_fields'];
		$cs_header_position = $cs_theme_options['cs_header_position'];
		$cs_project = get_post_meta($post->ID, "csprojects", true);
		if ( $cs_project <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($cs_project);
			$cs_project_from_date = $cs_xmlObject->cs_project_from_date;
			$cs_project_to_date = $cs_xmlObject->cs_project_to_date;
			$cs_project_plan = $cs_xmlObject->cs_project_plan;
			$cs_project_link_title = $cs_xmlObject->cs_project_link_title;
			$cs_project_link_url = $cs_xmlObject->cs_project_link_url;
			$cs_project_link_color = $cs_xmlObject->cs_project_link_color;
			$cs_project_style = $cs_xmlObject->cs_project_style;
			
		} else {
			$cs_project_from_date = '';
			$cs_project_to_date = '';
			$cs_project_link_title = '';
			$cs_project_link_url = '';
			$cs_project_link_color = $cs_project_plan = '';
			$cs_project_style = '';
			
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
									<li class="active"><a href="#tab-general-settings" data-toggle="tab"><i class="fa fa-cog"></i><?php _e('General','Awaken'); ?></a></li>
									<li><a href="#tab-subheader-options" data-toggle="tab"><i class="fa fa-indent"></i><?php _e('Sub Header','Awaken'); ?></a></li>
									<?php if($cs_header_position == 'absolute'){?>
                 						<li><a href="#tab-header-position-settings" data-toggle="tab"><i class="fa fa-forward"></i><?php _e('Header Absolute','Awaken'); ?></a></li>
                 					<?php }?>
									<?php if($cs_builtin_seo_fields == 'on'){?>
									<li><a href="#tab-seo-advance-settings" data-toggle="tab"><i class="fa fa-dribbble"></i><?php _e('SEO Options','Awaken'); ?></a></li>
									<?php }?>
                                    <li><a href="#tab-location-settings" data-toggle="tab"><i class="fa fa-globe"></i><?php _e('Location','Awaken'); ?></a></li>
                                    <li><a data-toggle="tab" href="#tab-projects-settings-cs-projects"><i class="fa fa-briefcase"></i><?php _e('Project Options','Awaken'); ?></a></li>
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
							<div id="tab-location-settings" class="tab-pane fade">
                            	<?php cs_location_fields(); ?>
                            </div>
                            <div id="tab-projects-settings-cs-projects" class="tab-pane fade">
								<script>
                                jQuery(function(){
									jQuery('#cs_project_from_date').datetimepicker({
										format:'d/m/Y',
										timepicker:false
									});
									jQuery('#cs_project_to_date').datetimepicker({
										format:'d/m/Y',
										timepicker:false
									});
                                });
                                </script>
                                <div class="clear"></div>
                                <ul class="form-elements">
                                  <li class="to-label">
                                    <label><?php _e('Start Date', 'Awaken'); ?></label>
                                  </li>
                                  <li class="to-field short-field">
                                    <input type="text" id="cs_project_from_date" name="cs_project_from_date" value="<?php if(isset($cs_project_from_date) && $cs_project_from_date <> '') echo cs_allow_special_char($cs_project_from_date)?>" />
                                  </li>
                                </ul>
                                <ul class="form-elements">
                                  <li class="to-label">
                                    <label><?php _e('Completion Date', 'Awaken'); ?></label>
                                  </li>
                                  <li class="to-field short-field">
                                    <input type="text" id="cs_project_to_date" name="cs_project_to_date" value="<?php if(isset($cs_project_to_date) && $cs_project_to_date <> '') echo cs_allow_special_char($cs_project_to_date)?>" />
                                  </li>
                                </ul>
                                
                                <ul class="form-elements">
                                  <li class="to-label">
                                    <label><?php _e('Project Plan', 'Awaken'); ?></label>
                                  </li>
                                  <li class="to-field short-field">
                                    <textarea id="cs_project_plan" name="cs_project_plan" ><?php if(isset($cs_project_plan) && $cs_project_plan <> '') echo cs_allow_special_char($cs_project_plan)?></textarea>
                                  </li>
                                </ul>
                                
                                <ul class="form-elements bcevent_title">
                                  <li class="to-label">
                                    <label><?php _e('Link', 'Awaken'); ?></label>
                                  </li>
                                  <li class="to-field">
                                    <div class="input-sec">
                                      <input type="text" id="cs_project_link_title" name="cs_project_link_title" value="<?php if(isset($cs_project_link_title)){echo cs_allow_special_char($cs_project_link_title);}?>" />
                                      <label><?php _e('Title', 'Awaken'); ?></label>
                                    </div>
                                    <div class="input-sec">
                                      <input type="text" id="cs_project_link_url" name="cs_project_link_url" value="<?php if(isset($cs_project_link_url)){echo cs_allow_special_char($cs_project_link_url);}?>" />
                                      <label><?php _e('Url', 'Awaken'); ?></label>
                                    </div>
                                    <div class="input-sec">
                                      <input type="text" id="cs_project_link_color" name="cs_project_link_color" value="<?php if(isset($cs_project_link_color)){echo cs_allow_special_char($cs_project_link_color);}?>" class="bg_color" />
                                      <label><?php _e('Color', 'Awaken'); ?></label>
                                    </div>
                                  </li>
                                </ul>
                                <div class="clear"></div>
                                <ul class="form-elements">
                                  <li class="to-label">
                                    <label><?php _e('Listing Color', 'Awaken'); ?></label>
                                  </li>
                                  <li class="to-field">
                                    <div class="input-sec">
                                      <input type="text" id="cs_project_style" name="cs_project_style" value="<?php if(isset($cs_project_style)){echo cs_allow_special_char($cs_project_style);}?>" class="bg_color" />
                                    </div>
                                    <p><?php _e('This color will apply only in Projet Listing (Classic View)', 'Awaken'); ?></p>
                                  </li>
                                </ul>
                            </div>
                            
 						  </div>
						</div>
					  </div>
					</div>
				<input type="hidden" name="csproject_meta_form" value="1" />
			</div>
		</div>
		<div class="clear"></div>
	<?php 
    }
 	// Course Meta option save
	if ( isset($_POST['csproject_meta_form']) and $_POST['csproject_meta_form'] == 1 ) {
		add_action( 'save_post', 'cs_meta_project_save' );  
		function cs_meta_project_save( $post_id ){  
			$sxe = new SimpleXMLElement("<project></project>");
			if (empty($_POST['cs_project_from_date'])){ $_POST['cs_project_from_date'] = '';}
			if (empty($_POST['cs_project_to_date'])){ $_POST['cs_project_to_date'] = '';}
			if (empty($_POST['cs_project_link_title'])){ $_POST['cs_project_link_title'] = '';}
			if (empty($_POST['cs_project_plan'])){ $_POST['cs_project_plan'] = '';}
			if (empty($_POST['cs_project_link_url'])){ $_POST['cs_project_link_url'] = '';}
			if (empty($_POST['cs_project_link_color'])){ $_POST['cs_project_link_color'] = '';}
			if (empty($_POST['cs_project_style'])){ $_POST['cs_project_style'] = '';}
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
			
			$sxe->addChild('cs_project_from_date', $_POST['cs_project_from_date']);
			$sxe->addChild('cs_project_to_date', $_POST['cs_project_to_date']);
			$sxe->addChild('cs_project_plan', $_POST['cs_project_plan']);
			$sxe->addChild('cs_project_link_title', $_POST['cs_project_link_title']);
			$sxe->addChild('cs_project_link_url', $_POST['cs_project_link_url']);
			$sxe->addChild('cs_project_link_color', $_POST['cs_project_link_color']);
			$sxe->addChild('cs_project_style', $_POST['cs_project_style']);
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
			
			$sxe = cs_page_options_save_xml($sxe);
			
			update_post_meta( $post_id, 'csprojects', $sxe->asXML() );
	
		}
	}
		// adding Project meta info end

 ?>