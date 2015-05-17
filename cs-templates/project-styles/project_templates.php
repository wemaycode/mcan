<?php 

// Project Templates
if ( !class_exists('ProjectTemplates') ) {
	
	class ProjectTemplates
	{
		
		function __construct()
		{
			// Constructor Code here..
		}
	
		//======================================================================
		// Project Classic View
		//======================================================================
		public function cs_project_classic_view( $atts ) {
			global $post, $wpdb, $cs_theme_options;
			if (empty($_GET['page_id_all'])) $_GET['page_id_all'] = 1;
			$args = array('posts_per_page' => "-1", 'post_type' => 'project', 'order' => 'ID', 'orderby' => 'DESC', 'post_status' => 'publish');
			if(isset($atts['cs_project_cat']) && $atts['cs_project_cat'] <> '' &&  $atts['cs_project_cat'] <> '0'){
				$row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from ".$wpdb->prefix."terms WHERE slug = %s", $atts['cs_project_cat'] ));
				
				$project_category_array = array(
											  'tax_query' => array(
												  array(
													  'taxonomy' => 'project-category',
													  'field'    => 'slug',
													  'terms'    => $row_cat->name,
												  ),
											  ),
										  );
				$args = array_merge($args, $project_category_array);
			}
			$query = new WP_Query( $args );
			$count_post = $query->post_count;
			$cs_project_num_post = $atts['cs_project_num_post'] <> '' ? $atts['cs_project_num_post'] : '-1';
			$cs_project_num_post = is_numeric($atts['cs_project_num_post']) ? $atts['cs_project_num_post'] : '-1';
			$args = array('posts_per_page' => "$cs_project_num_post", 'post_type' => 'project', 'paged' => $_GET['page_id_all'], 'order' => 'DESC', 'orderby' => 'ID', 'post_status' => 'publish');
			
			if(isset($atts['cs_project_cat']) && $atts['cs_project_cat'] <> '' &&  $atts['cs_project_cat'] <> '0'){
				$row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from $wpdb->terms WHERE slug = %s", $atts['cs_project_cat'] ));
				$project_category_array = array(
											  'tax_query' => array(
												  array(
													  'taxonomy' => 'project-category',
													  'field'    => 'slug',
													  'terms'    => $row_cat->name,
												  ),
											  ),
										  );
				$args = array_merge($args, $project_category_array);
			}
			
			
			
			$query = new WP_Query( $args );
			if ( $query->have_posts() ) {

					while ( $query->have_posts() ) : $query->the_post();	  
						  
						  $cs_noimage = '';
						  $width = 370;
						  $height = 208;
						  $image_id = get_post_thumbnail_id( $post->ID );
						  $image_url = cs_attachment_image_src($image_id, $width, $height);
						  if($image_id == ''){
							  $cs_noimage = ' no-image';
							  $image_url = get_template_directory_uri().'/assets/images/no-image4x3.jpg';
						  }
						  
						  $cs_pro_style = 'grey';
						  $cs_project = get_post_meta($post->ID, "csprojects", true);
						  if ( $cs_project <> "" ) {
							  $cs_xmlObject = new SimpleXMLElement($cs_project);
							  $cs_pro_style = $cs_xmlObject->cs_project_style;
						  }
						  ?>
						  <div class="col-md-6">
							  <article class="cs-projects projects-classic<?php echo cs_allow_special_char($cs_noimage); ?>">
								  <?php
								  if($image_id <> ''){
								  ?>
								  <div class="cs-media">
									  <figure>
										  <a href="<?php the_permalink(); ?>"><img alt="<?php the_title(); ?>" src="<?php echo esc_url($image_url); ?>" width="300" height="169"></a>
										  <figcaption><a href="<?php the_permalink(); ?>"><i class="fa fa-align-justify"></i></a></figcaption>
									  </figure>
								  </div>
								  <?php
								  }
								  ?>
								  <section style="background-color: <?php echo cs_allow_special_char($cs_pro_style); ?>;">
									  <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
									  <a class="custom-btn" href="<?php the_permalink(); ?>"><?php _e('Read More', 'Awaken'); ?></a>
								  </section> 
							  </article>
						  </div>
					  
					  <?php
					endwhile;

				//==Pagination Start
				if ( $atts['cs_project_pagination'] == "Show Pagination" && $count_post > $atts['cs_project_num_post'] && $atts['cs_project_num_post'] > 0 ) {
					$qrystr = '';
					if ( isset($_GET['page_id']) ) $qrystr .= "&amp;page_id=".$_GET['page_id'];
					echo cs_pagination($count_post, $atts['cs_project_num_post'], $qrystr, 'Show Pagination');
				}
				//==Pagination End	
			}
			   
			wp_reset_postdata();
				
		}
		
		//======================================================================
		// Project Small View
		//======================================================================
		public function cs_project_small_view( $atts ) {
			global $post, $wpdb, $cs_theme_options;
					
			if (empty($_GET['page_id_all'])) $_GET['page_id_all'] = 1;
			
			$args = array('posts_per_page' => "-1", 'post_type' => 'project', 'order' => 'ID', 'orderby' => 'DESC', 'post_status' => 'publish');
			if(isset($atts['cs_project_cat']) && $atts['cs_project_cat'] <> '' &&  $atts['cs_project_cat'] <> '0'){
				
				$row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from ".$wpdb->prefix."terms WHERE slug = %s", $atts['cs_project_cat'] ));
				$project_category_array = array(
											  'tax_query' => array(
												  array(
													  'taxonomy' => 'project-category',
													  'field'    => 'slug',
													  'terms'    => $row_cat->name,
												  ),
											  ),
										  );
				$args = array_merge($args, $project_category_array);
			}
	
			$query = new WP_Query( $args );
			$count_post = $query->post_count;
			
			$cs_project_num_post = $atts['cs_project_num_post'] <> '' ? $atts['cs_project_num_post'] : '-1';
			$cs_project_num_post = is_numeric($atts['cs_project_num_post']) ? $atts['cs_project_num_post'] : '-1';
			$args = array('posts_per_page' => "$cs_project_num_post", 'post_type' => 'project', 'paged' => $_GET['page_id_all'], 'order' => 'DESC', 'orderby' => 'ID', 'post_status' => 'publish');
			
			if(isset($atts['cs_project_cat']) && $atts['cs_project_cat'] <> '' &&  $atts['cs_project_cat'] <> '0'){
				$row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from ".$wpdb->prefix."terms WHERE slug = %s", $atts['cs_project_cat'] ));
				$project_category_array = array(
											  'tax_query' => array(
												  array(
													  'taxonomy' => 'project-category',
													  'field'    => 'slug',
													  'terms'    => $row_cat->name,
												  ),
											  ),
										  );
				$args = array_merge($args, $project_category_array);
			}
						
			$query = new WP_Query( $args );
			if ( $query->have_posts() ) {

					while ( $query->have_posts() ) : $query->the_post();	  
						  ?>
						  <div class="col-md-3">
                          <?php
							  $cs_noimage = '';
							  $width = 372;
							  $height = 279;
							  $image_id = get_post_thumbnail_id( $post->ID );
							  $image_url = cs_attachment_image_src($image_id, $width, $height);
							  if($image_id == ''){
								  $cs_noimage = ' no-image';
								  $image_url = get_template_directory_uri().'/assets/images/no-image4x3.jpg';
							  }
							  ?>
							  <article class="cs-projects projects-small<?php echo cs_allow_special_char($cs_noimage); ?>">
								  <div class="cs-media">
									  <figure>
										  <a href="<?php the_permalink(); ?>"><img alt="<?php the_title(); ?>" src="<?php echo esc_url($image_url); ?>"></a>
										  <figcaption><a href="<?php the_permalink(); ?>"><i class="fa fa-align-justify"></i></a></figcaption>
									  </figure>
								  </div>
								  <section>
									  <h2><a href="<?php the_permalink(); ?>"><?php echo substr(get_the_title(),0,24); if(strlen(get_the_title()) > 24) echo '...'; ?></a></h2>
									  <ul class="post-option">
										  <li><time datetime="<?php echo date_i18n('Y-m-d', strtotime(get_the_date())); ?>"><i class="fa fa-clock-o"></i><?php echo date_i18n(get_option('date_format'), strtotime(get_the_date())); ?></time></li>
										  <?php echo get_the_term_list( get_the_ID(), 'project-category', '<li><i class="fa fa-align-left"></i>', ', ', '</li>' ); ?>
									  </ul>
									  <a class="arrow" href="<?php the_permalink(); ?>"><i class="fa fa-arrow-right"></i></a>
								  </section> 
							  </article>
						  </div>
                          <?php
					endwhile;

				//==Pagination Start
				if ( $atts['cs_project_pagination'] == "Show Pagination" && $count_post > $atts['cs_project_num_post'] && $atts['cs_project_num_post'] > 0 ) {
					$qrystr = '';
					if ( isset($_GET['page_id']) ) $qrystr .= "&amp;page_id=".$_GET['page_id'];
					echo cs_pagination($count_post, $atts['cs_project_num_post'], $qrystr, 'Show Pagination');
				}
				//==Pagination End	
			}
			   
			wp_reset_postdata();
				
		}
		
		//======================================================================
		// Project Medium View
		//======================================================================
		public function cs_project_medium_view( $atts ,$cs_project_medium_layout = 'col-md-4' ) {
			global $post, $wpdb, $cs_theme_options;
					
			if (empty($_GET['page_id_all'])) $_GET['page_id_all'] = 1;
			
			$args = array('posts_per_page' => "-1", 'post_type' => 'project', 'order' => 'ID', 'orderby' => 'DESC', 'post_status' => 'publish');
			
			if(isset($atts['cs_project_cat']) && $atts['cs_project_cat'] <> '' &&  $atts['cs_project_cat'] <> '0'){
				$row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from $wpdb->terms WHERE slug = %s", $atts['cs_project_cat'] ));
				$project_category_array = array(
											  'tax_query' => array(
												  array(
													  'taxonomy' => 'project-category',
													  'field'    => 'slug',
													  'terms'    => $row_cat->name,
												  ),
											  ),
										  );
				$args = array_merge($args, $project_category_array);
			}
	
			$query = new WP_Query( $args );
			$count_post = $query->post_count;
			
			$cs_project_num_post = $atts['cs_project_num_post'] <> '' ? $atts['cs_project_num_post'] : '-1';
			$cs_project_num_post = is_numeric($atts['cs_project_num_post']) ? $atts['cs_project_num_post'] : '-1';
			$args = array('posts_per_page' => "$cs_project_num_post", 'post_type' => 'project', 'paged' => $_GET['page_id_all'], 'order' => 'DESC', 'orderby' => 'ID', 'post_status' => 'publish');
			
			if(isset($atts['cs_project_cat']) && $atts['cs_project_cat'] <> '' &&  $atts['cs_project_cat'] <> '0'){
				$row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from $wpdb->terms WHERE slug = %s", $atts['cs_project_cat'] ));
				$project_category_array = array(
											  'tax_query' => array(
												  array(
													  'taxonomy' => 'project-category',
													  'field'    => 'slug',
													  'terms'    => $row_cat->name,
												  ),
											  ),
										  );
				$args = array_merge($args, $project_category_array);
			}
						
			$query = new WP_Query( $args );
			if ( $query->have_posts() ) {

					while ( $query->have_posts() ) : $query->the_post();	  
						  ?>
						  <div class="<?php echo esc_attr($cs_project_medium_layout);?>">
                          <?php
							  $cs_noimage = '';
							  $width = 370;
							  $height = 208;
							  $image_id = get_post_thumbnail_id( $post->ID );
							  $image_url = cs_attachment_image_src($image_id, $width, $height);
							  if($image_id == ''){
								  $cs_noimage = ' no-image';
								  $image_url = get_template_directory_uri().'/assets/images/no-image4x3.jpg';
							  }
							  ?>
							  <article class="cs-projects projects-medium<?php echo cs_allow_special_char($cs_noimage); ?>">
								  <div class="cs-media">
									  <figure>
										  <a href="<?php the_permalink(); ?>"><img alt="<?php the_title(); ?>" src="<?php echo esc_url($image_url); ?>"></a>
										  <figcaption><a href="<?php the_permalink(); ?>"><i class="fa fa-align-justify"></i></a></figcaption>
									  </figure>
								  </div>
								  <section>
									  <h2><a href="<?php the_permalink(); ?>"><?php echo substr(get_the_title(),0,24); if(strlen(get_the_title()) > 24) echo '...'; ?></a></h2>
									  <ul class="post-option">
										  <li><time datetime="<?php echo date_i18n('Y-m-d', strtotime(get_the_date())); ?>"><i class="fa fa-clock-o"></i><?php echo date_i18n(get_option('date_format'), strtotime(get_the_date())); ?></time></li>
										  <?php echo get_the_term_list( get_the_ID(), 'project-category', '<li><i class="fa fa-align-left"></i>', ', ', '</li>' ); ?>
									  </ul>
									  <a class="arrow" href="<?php the_permalink(); ?>"><i class="fa fa-arrow-right"></i></a>
								  </section> 
							  </article>
						  </div>
                          <?php
					endwhile;

				//==Pagination Start
				if ( $atts['cs_project_pagination'] == "Show Pagination" && $count_post > $atts['cs_project_num_post'] && $atts['cs_project_num_post'] > 0 ) {
					$qrystr = '';
					if ( isset($_GET['page_id']) ) $qrystr .= "&amp;page_id=".$_GET['page_id'];
					echo cs_pagination($count_post, $atts['cs_project_num_post'], $qrystr, 'Show Pagination');
				}
				//==Pagination End	
			}
			   
			wp_reset_postdata();
				
		}
		
		//======================================================================
		// Project Grid view 3 column
		//======================================================================
		public function cs_project_grid_three_column( $atts) {
			global $post, $wpdb, $cs_theme_options;
					
			if (empty($_GET['page_id_all'])) $_GET['page_id_all'] = 1;
			
			$args = array('posts_per_page' => "-1", 'post_type' => 'project', 'order' => 'ID', 'orderby' => 'DESC', 'post_status' => 'publish');
			
			if(isset($atts['cs_project_cat']) && $atts['cs_project_cat'] <> '' &&  $atts['cs_project_cat'] <> '0'){
				$row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from $wpdb->terms WHERE slug = %s", $atts['cs_project_cat'] ));
				$project_category_array = array(
											  'tax_query' => array(
												  array(
													  'taxonomy' => 'project-category',
													  'field'    => 'slug',
													  'terms'    => $row_cat->name,
												  ),
											  ),
										  );
				$args = array_merge($args, $project_category_array);
			}
	
			$query = new WP_Query( $args );
			$count_post = $query->post_count;
			
			$cs_project_num_post = $atts['cs_project_num_post'] <> '' ? $atts['cs_project_num_post'] : '-1';
			$cs_project_num_post = is_numeric($atts['cs_project_num_post']) ? $atts['cs_project_num_post'] : '-1';
			$args = array('posts_per_page' => "$cs_project_num_post", 'post_type' => 'project', 'paged' => $_GET['page_id_all'], 'order' => 'DESC', 'orderby' => 'ID', 'post_status' => 'publish');
			
			if(isset($atts['cs_project_cat']) && $atts['cs_project_cat'] <> '' &&  $atts['cs_project_cat'] <> '0'){
				$row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from $wpdb->terms WHERE slug = %s", $atts['cs_project_cat'] ));
				$project_category_array = array(
											  'tax_query' => array(
												  array(
													  'taxonomy' => 'project-category',
													  'field'    => 'slug',
													  'terms'    => $row_cat->name,
												  ),
											  ),
										  );
				$args = array_merge($args, $project_category_array);
			}
						
			$query = new WP_Query( $args );
			if ( $query->have_posts() ) {

					while ( $query->have_posts() ) : $query->the_post();	  
						  ?>
						  <div class="col-md-4">
                          <?php
							  $cs_noimage = '';
							  $width = 370;
							  $height = 208;
							  $image_id = get_post_thumbnail_id( $post->ID );
							  $image_url = cs_attachment_image_src($image_id, $width, $height);
							  if($image_id == ''){
								  $cs_noimage = ' no-image';
								  $image_url = get_template_directory_uri().'/assets/images/no-image4x3.jpg';
							  }
							  ?>
							  <article class="cs-projects projects-medium<?php echo cs_allow_special_char($cs_noimage); ?>">
								  <div class="cs-media">
									  <figure>
										  <a href="<?php the_permalink(); ?>"><img alt="<?php the_title(); ?>" src="<?php echo esc_url($image_url); ?>"></a>
										  <figcaption><a href="<?php the_permalink(); ?>"><i class="fa fa-align-justify"></i></a></figcaption>
									  </figure>
								  </div>
								  <section>
									  <h2><a href="<?php the_permalink(); ?>"><?php echo substr(get_the_title(),0,24); if(strlen(get_the_title()) > 24) echo '...'; ?></a></h2>
									  <ul class="post-option">
										  <li><time datetime="<?php echo date_i18n('Y-m-d', strtotime(get_the_date())); ?>"><i class="fa fa-clock-o"></i><?php echo date_i18n(get_option('date_format'), strtotime(get_the_date())); ?></time></li>
										  <?php echo get_the_term_list( get_the_ID(), 'project-category', '<li><i class="fa fa-align-left"></i>', ', ', '</li>' ); ?>
									  </ul>
									  <a class="arrow" href="<?php the_permalink(); ?>"><i class="fa fa-arrow-right"></i></a>
								  </section> 
							  </article>
						  </div>
                          <?php
					endwhile;

				//==Pagination Start
				if ( $atts['cs_project_pagination'] == "Show Pagination" && $count_post > $atts['cs_project_num_post'] && $atts['cs_project_num_post'] > 0 ) {
					$qrystr = '';
					if ( isset($_GET['page_id']) ) $qrystr .= "&amp;page_id=".$_GET['page_id'];
					echo cs_pagination($count_post, $atts['cs_project_num_post'], $qrystr, 'Show Pagination');
				}
				//==Pagination End	
			}
			   
			wp_reset_postdata();
				
		}
		
	}
}