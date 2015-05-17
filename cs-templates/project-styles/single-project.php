<?php
    get_header();
	global $post, $cs_xmlObject;
?>
<section class="page-section" style="padding: 0;">
	<!-- Container -->
	<div class="container">
		<!-- Row -->
		<div class="row">

	<?php
		if ( have_posts() ) while ( have_posts() ) : the_post();
		$cs_project = get_post_meta($post->ID, "csprojects", true);
		
		if ( $cs_project <> "" ) {
			
			$cs_xmlObject = new SimpleXMLElement($cs_project);
			
			$cs_layout = $cs_xmlObject->sidebar_layout->cs_page_layout;
			
			$cs_sidebar_left = (string)$cs_xmlObject->sidebar_layout->cs_page_sidebar_left;
			
			$cs_sidebar_right = (string)$cs_xmlObject->sidebar_layout->cs_page_sidebar_right;
							
			$cs_post_tags_show = $cs_xmlObject->post_tags_show;
			
			$cs_share_post = $cs_xmlObject->post_social_sharing;
			
			$post_pagination_show = $cs_xmlObject->post_pagination_show;
			
			$cs_related_post = $cs_xmlObject->cs_related_post;
										
			
			if ( $cs_layout == "left") {
				$cs_layout = "content-right col-md-9";
			}
			else if ( $cs_layout == "right" ) {
				$cs_layout = "content-left col-md-9";
			}
			else {
				$cs_layout = "col-md-12";
			}
						
		} else {
			
			
			$cs_layout = "col-md-12";
		}
		
		if ($cs_layout == 'content-right col-md-9'){
		?>
			<div class="col-md-3"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_left) ) : endif; ?></div>
		<?php } ?>
            
            <div class="<?php echo cs_allow_special_char($cs_layout); ?>">
            	<div class="row">
				<?php
				$cs_noimage = '';
				$width = 842;
				$height = 632;
				$image_id = get_post_thumbnail_id( $post->ID );
				
				if($image_id <> ''){
					$image_url = cs_attachment_image_src($image_id, $width, $height);
				?>
                    <div class="col-md-12">
                        <figure><img alt="<?php the_title(); ?>" src="<?php echo esc_url($image_url); ?>"></figure>
                    </div>
                <?php
				}
				?>
                <div class="col-md-4">
                    <div class="side-detail project-detail">
                        <div class="cs-section-title">
                            <h2><?php _e('Project Detail','Awaken'); ?></h2>
                        </div>
                        <ul>
                        	<?php
							if(isset($cs_xmlObject->cs_project_from_date) and $cs_xmlObject->cs_project_from_date <> ''){
							?>
                            <li>
                                <h6><?php _e('Started Date', 'Awaken'); ?></h6>
                                <a><?php echo date_i18n(get_option('date_format'), strtotime($cs_xmlObject->cs_project_from_date)); ?></a>
                            </li>
                            <?php
							}
							if(isset($cs_xmlObject->cs_project_to_date) and $cs_xmlObject->cs_project_to_date <> ''){
							?>
                            <li>
                                <h6><?php _e('Completion Date', 'Awaken'); ?></h6>
                                <a><?php echo date_i18n(get_option('date_format'), strtotime($cs_xmlObject->cs_project_to_date)); ?></a>
                            </li>
                            <?php
							}
							 $categories_list = get_the_term_list ( get_the_id(), 'project-category', '' , ', ', '' );
                             if ( isset($categories_list) ){
							  ?>
								 <li> 
									  <h6><?php _e('Categories', 'Awaken'); ?></h6>
								  <?php 
										  printf( __( '%1$s', 'Awaken'),$categories_list );
								  ?>
								  </li>
                          <?php } 
							if(isset($cs_xmlObject->cs_project_plan) and $cs_xmlObject->cs_project_plan <> ''){
							?>
                            	<li>
                                	<h6><?php _e('Project Plan', 'Awaken'); ?></h6>
                                    <?php echo cs_allow_special_char($cs_xmlObject->cs_project_plan); ?>
                                </li>
                            <?php } ?>
                        </ul>
                        <?php
						if(isset($cs_xmlObject->cs_project_link_url) and $cs_xmlObject->cs_project_link_url <> ''){
						?>
                        <a class="custom-btn" style="background-color:<?php echo cs_allow_special_char($cs_xmlObject->cs_project_link_color); ?>;" href="<?php echo esc_url($cs_xmlObject->cs_project_link_url); ?>"><?php echo cs_allow_special_char($cs_xmlObject->cs_project_link_title); ?></a>
                        <?php
						}
						?>
                    </div>
                     <?php
					if(isset($cs_xmlObject->event_map_switch) and $cs_xmlObject->event_map_switch == 'on'){
					?>
                    <div class=" cs-map-section">
                        <div class="cs-section-title">
                            <h2><?php echo cs_allow_special_char($cs_xmlObject->event_map_heading); ?></h2>
                        </div>
                        <?php
						$map_latitude = isset($cs_xmlObject->dynamic_post_location_latitude) ? $cs_xmlObject->dynamic_post_location_latitude : '';
						$map_longitude = isset($cs_xmlObject->dynamic_post_location_longitude) ? $cs_xmlObject->dynamic_post_location_longitude : '';
						$map_info = isset($cs_xmlObject->dynamic_post_location_address) ? $cs_xmlObject->dynamic_post_location_address : '';
                        cs_location_map($post->ID, '278', $map_latitude, $map_longitude, $map_info);
						?>
                    </div>
                    <?php
					}
					?>
                </div>
                
                <div class="col-md-8">
                    <div class="rich_editor_text">
                        <?php the_content(); ?>
                    </div>
                    <?php
						 $thumb_ID = get_post_thumbnail_id( $post->ID );
						 if ( $images = get_children(array(
						   'post_parent' => get_the_ID(),
						   'post_type' => 'attachment',
						  // 'post_mime_type' => 'image',
						   'exclude' => $thumb_ID,
						  ))) { 
						//echo '<pre>';
						//print_r($images);	  
					?>
					<div class="cs-attachments">
					  <h5><?php _e('Attachments','Awaken');?></h5>
					  <ul>
						<?php 
						  foreach( $images as $image ) {  ?>
							<li>
							<?php if ( $image->post_mime_type == 'image/png' 
									|| $image->post_mime_type == 'image/gif' 
									|| $image->post_mime_type == 'image/jpg'
									|| $image->post_mime_type == 'image/jpeg'
								  ) { 
									
									$image_url = cs_attachment_image_src($image->ID, 370, 208 );
									
									?>
									 <figure> <a href="<?php echo esc_url($image->guid);?>"><img src="<?php echo esc_url($image_url);?>" alt="<?php echo cs_allow_special_char($image->post_name); ?>"></a> </figure>
									 <?php } else if ( $image->post_mime_type == 'application/zip' ) { ?>
													<figure> <a href="<?php echo esc_url($image->guid);?>"><i class="fa fa-file-zip-o"></i></a> </figure>
									 <?php }else if ( $image->post_mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' ) { ?>
													<figure> <a href="<?php echo esc_url($image->guid);?>"><i class="fa fa-file-word-o"></i></a> </figure>
									 <?php } else if ( $image->post_mime_type == 'text/plain' ) { ?>
													<figure> <a href="<?php echo esc_url($image->guid);?>"><i class="fa fa-file-text"></i></a> </figure>
									 <?php } else if ( $image->post_mime_type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' ) { ?>
													<figure> <a href="<?php echo esc_url($image->guid);?>"><i class="fa fa-file-excel-o"></i></a> </figure>
									 <?php } else { ?>
													<figure> <a href="<?php echo esc_url($image->guid);?>"><i class="fa fa-align-justify"></i></a> </figure>
									 <?php } ?>
								<div class="text"> <a href="<?php echo esc_url($image->guid);?>"><?php echo cs_allow_special_char($image->post_name);?></a> </div>
							</li>
						<?php } ?>
					  </ul>
				   </div>
				   <?php } ?>
                   
                </div>
                
                
            <?php if((isset($cs_post_tags_show) &&  $cs_post_tags_show == 'on') || (isset($cs_share_post) &&  $cs_share_post == 'on')){ ?>
            <div class="col-md-12">
              <div class="detail-post">
				<?php 
                if($cs_post_tags_show == 'on'){
                ?>
                <!-- cs Tages Start -->
                <div class="cs-tags">
                  <?php
					if(isset($cs_xmlObject->post_tags_show_text) and $cs_xmlObject->post_tags_show_text <> ''){
						$post_tags_show_text = $cs_xmlObject->post_tags_show_text;
					}
					else{
						$post_tags_show_text = __('Tags', 'Awaken');
					}
				  ?>
                  <div class="cs-title"><a><i class="fa fa-tags"></i><?php echo cs_allow_special_char($post_tags_show_text); ?></a></div>
                  <ul>
                    <?php  
						$categories_list = get_the_term_list ( get_the_id(), 'project-tag', '<li>', '</li><li>', '</li>' );
						if ( $categories_list ){
							printf( __( '%1$s', 'Awaken'),$categories_list );
						}
                    ?>
                  </ul>
                </div>
                <!-- cs Tages End -->
                <?php 
				}
                if($cs_share_post == 'on'){
                ?>
                <div class="socialmedia">
                	<?php
                      if(isset($cs_xmlObject->post_social_sharing_text) and $cs_xmlObject->post_social_sharing_text <> ''){
						  $post_social_sharing_text = $cs_xmlObject->post_social_sharing_text;
					  }
					  else{
						  $post_social_sharing_text = __('Share Now', 'Awaken');
					  }
					  cs_social_share(false,true,$post_social_sharing_text);
					?>
                </div>
                <?php 
				}
                ?>
              </div>
            </div>
            <?php }
			
			
			if(isset($post_pagination_show) &&  $post_pagination_show == 'on'){
				echo '<div class="col-md-12">';
				px_next_prev_custom_links('project');
				echo '</div>';
			}
          
			if(isset($cs_related_post) &&  $cs_related_post == 'on'){
			?>
				<div class="col-md-12 post-recent">
                    <div class="cs-section-title">
					  <?php
                      if(isset($cs_xmlObject->cs_related_post_title) and $cs_xmlObject->cs_related_post_title <> ''){
						  $cs_related_post_title = $cs_xmlObject->cs_related_post_title;
					  }
					  else{
						  $cs_related_post_title = __('Related Post', 'Awaken');
					  }
                      ?>
                      <h2><?php echo cs_allow_special_char($cs_related_post_title); ?></h2>
                    </div>
                    <div class="row">
                      <?php 
                          $custom_taxterms = '';
                          $custom_taxterms = wp_get_object_terms( $post->ID, array('project-category', 'project-tag'), array('fields' => 'ids') );
                          $args = array(
                              'post_type' => 'project',
                              'post_status' => 'publish',
                              'posts_per_page' => 3,
                              'orderby' => 'DESC',
                              'tax_query' => array(
                                  'relation' => 'OR',
                                  array(
                                      'taxonomy' => 'project-tag',
                                      'field' => 'id',
                                      'terms' => $custom_taxterms
                                  ),
                                  array(
                                      'taxonomy' => 'project-category',
                                      'field' => 'id',
                                      'terms' => $custom_taxterms
                                  )
                              ),
                              'post__not_in' => array ($post->ID),
                          );
                         $custom_query = new WP_Query($args);
                         while ($custom_query->have_posts()) : $custom_query->the_post();
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
								  $image_url = get_template_directory_uri().'/assets/images/no-image.jpg';
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
									  <h5><a href="<?php the_permalink(); ?>"><?php echo substr(get_the_title(),0,24); if(strlen(get_the_title()) > 24) echo '...'; ?></a></h5>
									  <ul class="post-option">
										  <li><time datetime="<?php echo date_i18n('Y-m-d', strtotime(get_the_date())); ?>"><i class="fa fa-clock-o"></i><?php echo date_i18n(get_option('date_format'), strtotime(get_the_date())); ?></time></li>
										  <?php echo get_the_term_list( get_the_ID(), 'project-category', '<li><i class="fa fa-align-left"></i>', ', ', '</li>' ); ?>
									  </ul>
									  <a class="arrow" href="<?php the_permalink(); ?>"><i class="fa fa-arrow-right"></i></a>
								  </section> 
							  </article>
						  </div>
                      <?php endwhile; wp_reset_postdata(); ?>
                  </div>
              </div>
			<?php
			}
			
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			?>
            </div>
            </div>
            
        <?php
		endwhile;
		
		if ( $cs_layout  == 'content-left col-md-9'){ 
		?>
            <div class="col-md-3"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_right) ) :  endif; ?></div>
        <?php } ?>
    	
		</div>
	</div>
</section>
 <?php get_footer(); ?>