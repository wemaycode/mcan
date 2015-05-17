<?php
	require_once 'pt_functions.php';

	//adding columns start
    add_filter('manage_sermons_posts_columns', 'sermons_columns_add');
	function sermons_columns_add($columns) {
		$columns['category'] = 'Category';
		$columns['author'] = 'Author';
		return $columns;
	}
    add_action('manage_sermons_posts_custom_column', 'sermons_columns');
	function sermons_columns($name) {
		global $post;
		switch ($name) {
			case 'category':
				$categories = get_the_terms( $post->ID, 'sermon-category' );
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
	if ( ! function_exists( 'cs_sermons_register' ) ) {
		function cs_sermons_register() {
			$labels = array(
				'name' => 'Sermons',
				'all_items' => __('Sermons','Awaken'),
				'add_new_item' => 'Add New Sermon',
				'edit_item' => 'Edit Sermon',
				'new_item' => 'New Sermon Item',
				'add_new' => 'Add New Sermon',
				'view_item' => 'View Sermon Item',
				'search_items' => 'Search Sermon',
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
			register_post_type( 'sermons' , $args );
		}
		add_action('init', 'cs_sermons_register');
	}
		// adding cat start
		  $labels = array(
			'name' => 'Sermon Categories',
			'search_items' => 'Search Sermon Categories',
			'edit_item' => 'Edit Sermon Category',
			'update_item' => 'Update Sermon Category',
			'add_new_item' => 'Add New Category',
			'menu_name' => 'Categories',
		  ); 	
		  register_taxonomy('sermon-category',array('sermons'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'sermon-category' ),
		  ));
		// adding cat end
		// adding tag start
		  $labels = array(
			'name' => 'Sermon Tags',
			'singular_name' => 'sermon-tag',
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
		  register_taxonomy('sermon-tag','sermons',array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var' => true,
			'rewrite' => array( 'slug' => 'sermon-tag' ),
		  ));
		// adding tag end

	// adding course meta info start
	add_action( 'add_meta_boxes', 'cs_meta_sermons_add' );
	function cs_meta_sermons_add(){  
		add_meta_box( 'cs_meta_sermon', 'Sermons Options', 'cs_meta_sermon', 'sermons', 'normal', 'high' );  
	}
	function cs_meta_sermon( $post ) {
		global $post,$cs_xmlObject;
		 $cs_theme_options=get_option('cs_theme_options');
		
		$cs_builtin_seo_fields =$cs_theme_options['cs_builtin_seo_fields'];
		$cs_header_position =$cs_theme_options['cs_header_position'];
		$cs_sermons = get_post_meta($post->ID, "sermons", true);
		
		if ( $cs_sermons <> "" ) {
		
			$cs_xmlObject = new SimpleXMLElement($cs_sermons);
						
		} else {
			if(!isset($cs_xmlObject))
				$cs_xmlObject = new stdClass();
		}
		
		//cs_enqueue_timepicker_script();
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
                                   
                                    <li><a data-toggle="tab" href="#tab-sermons-settings-cs-sermons"><i class="fa fa-calendar"></i><?php _e('Sermons Options','Awaken'); ?></a></li>
 							  </ul>
						  </nav>
							<div class="tab-content">
							<div id="tab-subheader-options" class="tab-pane fade">
								<?php cs_subheader_element();?>
							</div>
							<div id="tab-general-settings" class="tab-pane fade active in">
								<?php cs_general_settings_element();
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
                            
                            <div id="tab-sermons-settings-cs-sermons" class="tab-pane fade">
                            	<?php cs_sermons_listing_section(); ?>
                            </div>
                            
 						  </div>
						</div>
					  </div>
					</div>
				<input type="hidden" name="cssermon_meta_form" value="1" />
			</div>
		</div>
		<div class="clear"></div>
	<?php 
    }
 	// Sermon Meta option save
	if ( isset($_POST['cssermon_meta_form']) and $_POST['cssermon_meta_form'] == 1 ) {
			//if ( empty($_POST['cs_layout']) ) $_POST['cs_layout'] = 'none';
			add_action( 'save_post', 'cs_meta_sermon_save' );  
			function cs_meta_sermon_save( $post_id )
			{  
			$sxe = new SimpleXMLElement("<sermon></sermon>");
			if (empty($_POST['sermon_notes_link'])){ $_POST['sermon_notes_link'] = "";}
			if (empty($_POST['sermon_summery'])){ $_POST['sermon_summery'] = "";}
			if (empty($_POST['sermon_speaker'])){ $_POST['sermon_speaker'] = "";}
			if (empty($_POST['sermon_audio_download_link'])){ $_POST['sermon_audio_download_link'] = "";}
			$sermon_counter=0;
			foreach ( $_POST['sermon_title_array'] as $type ){
				$sermon_list = $sxe->addChild('sermons');
				$sermon_list->addChild('sermon_title', htmlspecialchars($_POST['sermon_title_array'][$sermon_counter]) );
				$sermon_list->addChild('sermon_file_url', htmlspecialchars($_POST['sermon_file_url_array'][$sermon_counter]) );
				$sermon_counter++;
			}
			$sxe->addChild('sermon_notes_link', $_POST['sermon_notes_link']);
			$sxe->addChild('sermon_summery', $_POST['sermon_summery']);
			$sxe->addChild('sermon_speaker', $_POST['sermon_speaker']);
			$sxe->addChild('sermon_audio_download_link', $_POST['sermon_audio_download_link']);
			$sxe = cs_page_options_save_xml($sxe);
 			update_post_meta( $post_id, 'sermons', $sxe->asXML() );
		}
	}
	// adding Sermons meta info end