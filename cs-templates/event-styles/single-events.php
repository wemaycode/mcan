<?php
/**
 * The template for Event Detail
 */
	global $cs_node,$post,$cs_theme_options,$cs_counter_node;
	
	$cs_uniq = rand(40, 9999999);
	if ( is_single() ) {
		cs_set_post_views($post->ID);
	}	
	$cs_node = new stdClass();
  	get_header();
 	$cs_layout = '';
	$leftSidebarFlag	= false;
	$rightSidebarFlag	= false;
	?>
<!-- PageSection Start -->

<section class="page-section" style=" padding: 0; "> 
  <!-- Container -->
  <div class="container"> 
    <!-- Row -->
    <div class="row">
      <?php
	if (have_posts()):
		while (have_posts()) : the_post();	
		$cs_tags_name = 'event-tag';
		$cs_categories_name = 'event-category';
		$postname = 'events';

		$post_xml = get_post_meta($post->ID, "events", true);
			
			if ( $post_xml <> "" ) {
			
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				
				$cs_layout 			= $cs_xmlObject->sidebar_layout->cs_page_layout;
				$cs_sidebar_left 	= $cs_xmlObject->sidebar_layout->cs_page_sidebar_left;
				$cs_sidebar_right   = $cs_xmlObject->sidebar_layout->cs_page_sidebar_right;
				if(isset($cs_xmlObject->cs_related_post))
					$cs_related_post = $cs_xmlObject->cs_related_post;
				else 
					$cs_related_post = '';

				if(isset($cs_xmlObject->post_pagination_show))
					 $post_pagination_show = $cs_xmlObject->post_pagination_show;
				else 
					$post_pagination_show = '';
					
				if ( $cs_layout == "left") {
					$cs_layout = "page-content";
					
					$leftSidebarFlag	= true;
				}
				else if ( $cs_layout == "right" ) {
					$cs_layout = "page-content";
					
					$rightSidebarFlag	= true;
				}
				else {
					$cs_layout = "col-md-12";
					
				}
				$postname = 'events';
			}else{
				$cs_layout 	=  $cs_theme_options['cs_single_post_layout'];
				if ( isset( $cs_layout ) && $cs_layout == "sidebar_left") {
					$cs_layout = "page-content event-editor";
					$cs_sidebar_left	= $cs_theme_options['cs_single_layout_sidebar'];
					
					$leftSidebarFlag	= true;
				} else if ( isset( $cs_layout ) && $cs_layout == "sidebar_right" ) {
					$cs_layout = "page-content event-editor";
					$cs_sidebar_right	= $cs_theme_options['cs_single_layout_sidebar'];
					
					$rightSidebarFlag	= true;
				} else {
					$cs_layout = "col-md-12";
					
				}
  				$post_pagination_show = 'on';
				$post_tags_show = '';
				$cs_related_post = '';
				$post_social_sharing = '';
				$post_social_sharing = '';
				
				$postname = 'events';
				$cs_post_social_sharing = '';
			}
			if ($post_xml <> "") {
			
					$post_tags_show = isset($cs_xmlObject->post_tags_show)?$cs_xmlObject->post_tags_show:'';
					$cs_post_event_email = $cs_xmlObject->dynamic_post_event_email;
					$dynamic_post_event_web_url = $cs_xmlObject->dynamic_post_event_web_url;
					$cs_post_event_contact_no = $cs_xmlObject->dynamic_post_event_contact_no;
					$dynamic_post_event_ticket_color = $cs_xmlObject->dynamic_post_event_ticket_color;
					$cs_post_event_ticket_options = $cs_xmlObject->dynamic_post_event_ticket_options;
					$cs_post_event_buy_now = $cs_xmlObject->dynamic_post_event_buy_now;
					$cs_post_event_start_time = $cs_xmlObject->dynamic_post_event_start_time;
					$cs_post_social_sharing = isset($cs_xmlObject->post_social_sharing)?$cs_xmlObject->post_social_sharing:'';
					$cs_post_event_end_time = $cs_xmlObject->dynamic_post_event_end_time;
					$cs_post_event_from_date = $cs_xmlObject->dynamic_post_event_from_date;
					$cs_event_members = $cs_xmlObject->dynamic_event_members;
					$cs_post_location_address = $cs_xmlObject->dynamic_post_location_address;
					$cs_event_members = explode(',',$cs_event_members);
								
			}
			else {
				$cs_xmlObject = new stdClass();
				$dynamic_post_event_web_url =$post_tags_show = $cs_post_event_email = $dynamic_post_event_ticket_color = $cs_post_event_contact_no = $cs_post_event_ticket_options = $cs_post_event_buy_now = $cs_post_event_start_time = $cs_post_social_sharing = $cs_post_event_end_time = $cs_post_event_from_date = $cs_event_members = $cs_post_location_address = '';
							
			}		
			
		$width = 300;
		$height = 300;
		$image_url = cs_get_post_img_src($post->ID, $width, $height);
		?>
      <!--Left Sidebar Starts-->
      <?php if ($leftSidebarFlag == true){ ?>
      <aside class="page-sidebar">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_left) ) : ?>
        <?php endif; ?>
      </aside>
      <?php } ?>
      <!--Left Sidebar End--> 
      
      <!-- Event Detail Start -->
      <div class="<?php echo esc_attr($cs_layout); ?> event-editor"> 
        <!-- Event Start --> 
        <!-- Row -->
		
 		 <div class="col-md-4">
            <div class="event-sidebar" >
			<?php if($image_url <> ''){ ?>
                <figure>
                    <img src="<?php echo esc_url($image_url);?>" alt="Event-detail">
                </figure>
			<?php } ?>
                <div class="side-holder">
                    <ul class="post-options">
                        <?php $categories_list = get_the_term_list ( get_the_id(), 'event-category', '' , ', ', '' );
							if ( $categories_list ){
						?>
								<li> <i class="fa fa-align-left"></i>
							<?php 
									printf( __( '%1$s', 'Awaken'),$categories_list );
								 
							?>
								</li>
						  <?php } ?>
                    </ul>
                    <div class="side-detail">
                        <ul>
                        <?php if($dynamic_post_event_web_url<>'') { ?>
                                    <li>
                                        <span> <?php _e('Website','Awaken');?></span>
                                        <a target="_blank" href="<?php echo cs_allow_special_char($dynamic_post_event_web_url); ?>"><?php echo cs_allow_special_char($dynamic_post_event_web_url); ?></a>
                                    </li>
							<?php } if($cs_post_event_contact_no<>'') { ?>
									<li>
										<span><?php _e( 'PHONE','Awaken');?></span>
										<a><?php echo cs_allow_special_char( $cs_post_event_contact_no ); ?></a>
									</li>
							<?php 
								}
							if($cs_post_event_email<>'') { ?>
									<li>
										<span><?php _e('EMAIL','Awaken');?></span>
										<a href="mailto:<?php echo is_email($cs_post_event_email); ?>"><?php echo is_email($cs_post_event_email); ?></a>
									</li>
						    <?php } ?>
                        </ul>
						<?php if($cs_post_event_ticket_options <> '' and $cs_post_event_buy_now <> '') { ?>
								<a href="<?php echo esc_url($cs_post_event_buy_now); ?>" style="background:<?php echo $dynamic_post_event_ticket_color; ?>" class="custom-btn"><?php echo esc_attr($cs_post_event_ticket_options); ?></a>
						<?php } ?>
                    </div>
                </div>
            </div>
        </div>
		
		<div class="col-md-8">
            
                          <div class="post-option-panel">
                            <div class=" cs-map-section has_map">
                              					   
							    <?php 
			
								if ( isset($cs_xmlObject->event_map_switch) && $cs_xmlObject->event_map_switch == "on" ) {
									include 'event-map.php';
								}
							?>
                            </div>
                            <div class="event-info">
                                <ul>
								<?php if($cs_post_event_start_time<>''){?>
                                    <li><?php _e('Event Time','Awaken');?>
                                        <span><i class="fa fa-clock-o"></i><?php echo date(get_option('time_format'),strtotime($cs_post_event_start_time)) ?><?php echo ($cs_post_event_end_time<>'')?'-'.date(get_option('time_format'),strtotime($cs_post_event_end_time)):''; ?></span>
                                    </li>
									<?php 
										}
									if($cs_post_event_from_date<>''){?>
                                    <li><?php _e('Event Start Date','Awaken');?>
                                        <span><i class="fa fa-clock-o"></i><?php echo date(get_option('date_format'),strtotime($cs_post_event_from_date)) ?></span>
                                    </li>
									<?php 
										}
									if($cs_post_location_address<>''){?>
											<li><?php _e('Event Location','Awaken');?>
												<span><i class="fa fa-map-marker"></i><?php echo esc_attr($cs_post_location_address); ?></span>
											</li>
									<?php } ?>
                                </ul>
                                <div class="left-aligned">
                                    
                                </div>
                            </div>
							<?php if(is_array($cs_event_members) and $cs_event_members[0]<>''){ 
								
							?>
                            <div class="event-speakers">
                                <h4><?php _e('Event Speakers','Awaken');?></h4>
                                <ul>
									<?php 
										foreach($cs_event_members as $user_id){
										
											$user_info 			= get_userdata($user_id);
											$username  			= $user_info->display_name;
											$image_url 			= get_user_meta($user_id, 'google_profile_picture', true);
											$custom_image_url 	= get_user_meta($user_id, 'custom_avatar', true);
											$size = 60;
											$html ='';
											
											if ( isset( $user_info ) && !empty( $user_info )) {
											
											$html  .='<li>';
												if(isset($image_url) && $image_url <> ''){
													$html .= '<figure><a href="'.get_author_posts_url($user_id).'"><img alt="" src="'.$image_url.'" width="'.$size.'" height="'.$size.'" alt="'.$username .'"></a></figure>';
												}else if(isset($custom_image_url) && $custom_image_url <> '') {
													$html .= '<figure><a href="'.get_author_posts_url($user_id).'"><img src="'.$custom_image_url.'" class="avatar photo" id="upload_media" width="'.$size.'" height="'.$size.'" alt="'.$username .'" /></a></figure>';
												  }else{
														$html .= '<figure><a href="'.get_author_posts_url($user_id).'">'.
																		get_avatar($user_info->user_email,apply_filters('PixFill_author_bio_avatar_size', 60))
																.'</a></figure>';
												  }
												 
												 
												  
												  $html .='<div class="text">
																<a href="'.get_author_posts_url($user_id).'">'.$username.'</a>
																<span>'.implode(', ', $user_info->roles).'</span>
															</div>';
												  '</li>';
												 }
											echo  balanceTags($html,false);
										
										}
									?>
 
                                   
                                </ul>
                            </div>
						<?php } ?>
							
                            <div class="rich_editor_text">
                              <?php 
							  	the_content(); 
							 	wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'Awaken' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );							  ?>
                              
                            </div>
                          </div>
                        
                      <!-- Related post Start -->
                     
                
       
        </div>
		
		          <!-- Col Tags Start -->
         
        <div class="col-md-12">
            <div class="detail-post">
			 <?php if(isset($post_tags_show) &&  $post_tags_show == 'on'){ 
			 			if ( empty($cs_xmlObject->post_tags_show_text) ) $post_tags_show_text = __('Tags', 'Awaken'); else $post_tags_show_text = $cs_xmlObject->post_tags_show_text;
							  $categories_list = get_the_term_list ( get_the_id(), 'event-tag', '<li>', '</li><li>', '</li>' );
			 				if ( isset($categories_list) and $categories_list <> '' ){ ?>
			 
                              <!-- cs Tages Start -->
                              <div class="cs-tags">
                                <div class="cs-title"><a href="#"><i class="fa fa-tags"></i><?php echo esc_attr($post_tags_show_text);?></a></div>
                                <ul>
									<?php printf( __( '%1$s', 'Awaken' ), $categories_list ); ?>
                                </ul>
                              </div>
				 <?php } 
			 
			 		} 
			 	?>
              				<!-- cs Tages End -->
              
                 <?php  
			  		if ($cs_post_social_sharing == "on"){
						echo '<div class="socialmedia">';
							if ( empty($cs_xmlObject->post_social_sharing_text) ) $post_social_sharing_text = __('Share', 'Awaken'); else $post_social_sharing_text = $cs_xmlObject->post_social_sharing_text;
								cs_social_share(false,true,$post_social_sharing_text);
						echo '</div>';
				 } ?>
              
            </div>
        </div>
		  
		 <!-- Sermon next/prev Button Start-->
          
          <?php if(isset($post_pagination_show) &&  $post_pagination_show == 'on'){
				echo '<div class="col-md-12">';
							px_next_prev_custom_links('events');
				echo '</div>';
             }
          ?>
		            <!-- Col Recent Posts Start -->
          <?php if( $cs_related_post =='on' ){
						
				  $custom_taxterms='';
				  $width  = 370;
				  $height = 208;
				  $custom_taxterms = wp_get_object_terms( $post->ID, array($cs_categories_name, $cs_tags_name), array('fields' => 'ids') );
				  $args = array(
					  'post_type' => $postname,
					  'post_status' => 'publish',
					  'posts_per_page' => 3,
					  'orderby' => 'DESC',
					  'tax_query' => array(
						  'relation' => 'OR',
						  array(
							  'taxonomy' => $cs_tags_name,
							  'field' => 'id',
							  'terms' => $custom_taxterms
						  ),
						  array(
							  'taxonomy' => $cs_categories_name,
							  'field' => 'id',
							  'terms' => $custom_taxterms
						  )
					  ),
					  'post__not_in' => array ($post->ID),
				  );
				
				 $custom_query = new WP_Query($args);
				 if($custom_query->have_posts()){

						 while ($custom_query->have_posts()) : $custom_query->the_post();
								$post_xml = get_post_meta($post->ID, "events", true);
								$title = get_the_title();
							if ( $post_xml <> "" ) {
									$cs_xmlObject = new SimpleXMLElement($post_xml);
									
									$cs_post_event_start_time = strtotime($cs_xmlObject->dynamic_post_event_start_time);
									$cs_post_event_end_time = strtotime($cs_xmlObject->dynamic_post_event_end_time);
									$cs_post_event_from_date = strtotime($cs_xmlObject->dynamic_post_event_from_date);
									$cs_post_location_address = $cs_xmlObject->dynamic_post_location_address;
									
							}else{
									$cs_post_event_start_time = $cs_post_event_end_time = $cs_post_event_from_date = $cs_post_location_address = '';
									
							}
							?>
								<div class="col-md-4">
									<article class="cs-events events-minimal minimal-grid">
										<div class="left-sp">
											<h2><a href="<?php the_permalink(); ?>"><?php echo substr($title,0,30); echo (strlen($title)>25)?'...':''; ?></a></h2>
											<div class="location-info">
												<time datetime="<?php echo esc_attr( $cs_post_event_from_date );?>"> <?php echo date_i18n('M',$cs_post_event_from_date); ?> <span><?php echo date_i18n('d',$cs_post_event_from_date); ?> </span> </time>
												<div class="info">
													<div class="time-period">
													<time datetime="<?php echo date('d-m-y',$cs_post_event_from_date); ?>"><i class="fa fa-clock-o"></i><?php echo date_i18n(get_option('time_format'),$cs_post_event_start_time) ?><?php echo ($cs_post_event_end_time<>'')?'-'.date_i18n(get_option('time_format'),$cs_post_event_end_time):''; ?></time> 
													</div>
													<?php if($cs_post_location_address<>''){ ?>
															<span><i class="fa fa-map-marker"></i><?php echo substr($cs_post_location_address,0,25);echo (strlen($cs_post_location_address)>25)?'...':'';?></span>
													<?php } ?>
												</div>
											</div>
										</div>
									</article>
								</div>
					  <?php endwhile; 
			  
				}
			  ?>

       <?php } ?>
		
		
		
      <!-- Sermon Detail End --> 
      <!-- Right Sidebar Start --> 
      </div>
	  
	  <?php endwhile; endif;  
		?>
    	<?php if ($rightSidebarFlag == true){ ?>
      		<aside class="page-sidebar">
       			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_right) ) : endif; ?>
      		</aside>
      <?php } ?>
      <!-- Right Sidebar End -->
    
  </div>
  </div>
</section>
<!-- PageSection End --> 
<!-- Footer -->
<?php get_footer(); ?>