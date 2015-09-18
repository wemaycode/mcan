<?php 
/**
 * File Type: Event Templates Class
 */
 

if ( !class_exists('EventTemplates') ) {
	
	class EventTemplates
	{
		
		function __construct()
		{
			// Constructor Code here..
		}
	
		//======================================================================
		// Blog Listing View
		//======================================================================
		public function cs_listing_view( $cs_event_meta , $event_from_date, $category , $excerpt ) {
			global $post;
			$width	= '150';
			$height	= '150';
			$image_url = cs_get_post_img_src($post->ID, $width, $height);
			$title_limit = 46;
			$background	= '';
			$randomid = cs_generate_random_string('10');
			
			$address_map	= $cs_event_meta->dynamic_post_location_address;
			$event_loc_long	= (string)$cs_event_meta->dynamic_post_location_longitude;
			$event_loc_zoom =(int)$cs_event_meta->dynamic_post_location_zoom;
			$event_loc_lat	= (string)$cs_event_meta->dynamic_post_location_latitude;
		?>
            <div class="col-md-12">
                <article class="cs-events events-listing post-<?php echo esc_attr( $post->ID );?>">
                    <div class="ev-inn">
                        <div class="cstime">
                            <i class="fa fa-clock-o"></i>
                            <span>
                            	<?php 
									  if( isset( $cs_event_meta->dynamic_post_event_start_time ) && $cs_event_meta->dynamic_post_event_start_time <> ''){
										echo esc_attr( $cs_event_meta->dynamic_post_event_start_time.' ' );
									  }
									  if(isset($cs_event_meta->dynamic_post_event_end_time) && $cs_event_meta->dynamic_post_event_end_time <> ''){
										_e('TO', 'Awaken');
										echo esc_attr( ' '.$cs_event_meta->dynamic_post_event_end_time );
									  }
								 ?>
                            </span>
                            <time datetime="<?php echo esc_attr( date_i18n('Y-m-d',strtotime( $event_from_date ) ) );?>" class="time-period"><?php echo esc_attr( date_i18n( get_option( 'date_format' ),strtotime( $event_from_date ) ) );?></time>
                        </div>
                        <section>
                            <h2><a href="<?php the_permalink();?>"><?php echo substr(get_the_title(),0, $title_limit); if(strlen(get_the_title())>$title_limit){echo '...';}?></a></h2>
                           
								<?php if ( $image_url ) { ?>
                                     <figure><a href="<?php the_permalink();?>"><img alt="" src="<?php echo esc_url( $image_url );?>"></a></figure>
                                <?php }?>
                                <div class="left-sp">
                                    <p><?php echo cs_get_the_excerpt($excerpt,false, 'Read More');?></p>
                                    <?php if( isset( $cs_event_meta->dynamic_post_location_address ) && $cs_event_meta->dynamic_post_location_address <> '' ){ ?>
                                        <div class="location-info"> <span><i class="fa fa-map-marker"></i><?php echo esc_attr( $cs_event_meta->dynamic_post_location_address );?></span> </div>
                                    <?php }?>
                                </div>
                            
                        </section>
                        <div class="event-map csmap post-<?php echo intval($post->ID);?>" id="event-<?php echo intval($post->ID);?>" style="display:none">
                            <div class="mapcode fullwidth mapsection gmapwrapp" id="map_canvas<?php echo intval($post->ID); ?>" style="height:182px; width:100%;"></div>
                        </div>
                                
                    </div>
                    <div class="cs-cat-list" id="post-<?php echo esc_attr( $post->ID );?>">
                        <ul>
                            <?php  if(isset($cs_event_meta->dynamic_post_event_ticket_options) && $cs_event_meta->dynamic_post_event_ticket_options <> '' ){?>
                            <li>
                            <?php 
                                if ( isset( $cs_event_meta->dynamic_post_event_ticket_color ) &&  $cs_event_meta->dynamic_post_event_ticket_color !='' ) {
                                    $color	= $cs_event_meta->dynamic_post_event_ticket_color;
                                    $background	= ' style="background-color:'.$color.' !important; color:#FFF !important;"';
                                }
                            ?>
                            	<a class="custom-btn" <?php echo balanceTags($background, false);?>  href="<?php echo esc_url( $cs_event_meta->dynamic_post_event_buy_now );?>"><?php echo esc_attr( $cs_event_meta->dynamic_post_event_ticket_options );?></a>
                            </li>
                            <style>
								.post-<?php echo esc_attr( $post->ID );?> .cs-cat-list ul li a.custom-btn:after {
									border-color: transparent transparent transparent <?php echo cs_allow_special_char($color);?> !important;
								}
							</style>
                           <?php  }?>
                           <li> <?php $this->cs_get_categories( $category );?></li>
                        </ul>
                        <span>
                        <a onclick="cs_show_map('<?php echo esc_attr( $post->ID ); ?>', '<?php echo esc_attr( $address_map );?>', '<?php echo esc_attr( $event_loc_lat );?>', '<?php echo esc_attr( $event_loc_long );?>', '<?php echo esc_attr( $event_loc_zoom );?>', '<?php echo home_url() ?>','<?php echo get_template_directory_uri() ?>')"  class="map-marker toggle" id="toggle-<?php echo esc_attr( $randomid );?>"><i class="fa fa-map-marker"></i><?php esc_html_e( 'Event Location','Awaken' );?></a>
                     </span>
                  </div>
              </article>
         </div>
		<?php }
		
		
		//======================================================================
		// Blog Timeline View
		//======================================================================
		public function cs_timeline_view(  $cs_event_meta , $event_from_date, $category , $excerpt  ) {
			global $post;
			$width	= '150';
			$height	= '150';
			$image_url = cs_get_post_img_src($post->ID, $width, $height);
			$title_limit = 46;
			$background	= '';
		?>
		<div class="col-md-12">
			<article class="cs-events events-timeline">
				<div class="ev-inn">
					<div class="cstime">
						<i class="fa fa-clock-o"></i>
						<span>
						<?php 
							  if( isset( $cs_event_meta->dynamic_post_event_start_time ) && $cs_event_meta->dynamic_post_event_start_time <> ''){
								echo esc_attr( $cs_event_meta->dynamic_post_event_start_time.' ' );
							  }
							  if(isset($cs_event_meta->dynamic_post_event_end_time) && $cs_event_meta->dynamic_post_event_end_time <> ''){
								_e('TO', 'Awaken');
								echo esc_attr( ' '.$cs_event_meta->dynamic_post_event_end_time );
							  }
						 ?>
                        </span>
                        <time datetime="<?php echo esc_attr( date_i18n('Y-m-d',strtotime( $event_from_date ) ) );?>" class="time-period"><?php echo esc_attr( date_i18n( get_option( 'date_format' ),strtotime( $event_from_date ) ) );?></time>
					</div>
					<section>
						<h2><a href="<?php the_permalink();?>"><?php echo substr(get_the_title(),0, $title_limit); if(strlen(get_the_title())>$title_limit){echo '...';}?></a></h2>
                         
							<?php if ( $image_url ) { ?>
                               <figure><a href="<?php the_permalink();?>"><img alt="" src="<?php echo esc_url( $image_url );?>"></a></figure>
                            <?php }?>
                            <div class="left-sp">
                                <p><?php echo cs_get_the_excerpt($excerpt,false, 'Read More');?></p>
                                <?php if( isset( $cs_event_meta->dynamic_post_location_address ) && $cs_event_meta->dynamic_post_location_address <> '' ){ ?>
                                    <div class="location-info"> <span><i class="fa fa-map-marker"></i><?php echo esc_attr(  $cs_event_meta->dynamic_post_location_address );?></span></div>
                                <?php }?>
                            </div>
                        
					</section>
				</div>
			</article>
		</div>
	
	<?php
	}
		
		//======================================================================
		// Blog Minimal View
		//======================================================================
		public function cs_minimal_view( $cs_event_meta , $event_from_date, $category , $excerpt  ) {
			global $post;
			$width	= '150';
			$height	= '150';
			$image_url = cs_get_post_img_src($post->ID, $width, $height);
			$title_limit = 46;
			$background	= '';
		?>
            <div class="col-md-4">
                <article class="cs-events events-minimal">
                    <div class="">
					
						<!-- Date -->
                        <a href="<?php the_permalink();?>">
							<h2>							
								<div> 
									<?php echo esc_attr( date_i18n('m',strtotime($event_from_date ) ) );?>/<?php echo esc_attr( date_i18n('j',strtotime( $event_from_date ) ) );?>
								</div>
							</h2>						
						</a>
						
                        <div class="location-info">
							<!-- Event Title -->
                            <div class="event-title">
								<?php echo substr(get_the_title(),0, $title_limit); if(strlen(get_the_title())>$title_limit){echo '...';}?>
							</div>
							
                            <div class="info">
								<!-- Date / Time -->
								<time datetime="<?php echo esc_attr( date_i18n('Y-m-d',strtotime( $event_from_date ) ) );?>">
									<?php echo date_i18n("F j", strtotime($event_from_date)) . ', '; ?>									
							   </time> 
								<?php										
									  if( isset( $cs_event_meta->dynamic_post_event_start_time ) && $cs_event_meta->dynamic_post_event_start_time <> ''){
										$startTime = date_i18n('g:iA', strtotime($cs_event_meta->dynamic_post_event_start_time));
										echo $startTime; //date_i18n('g:iA',$startTime);
									  }
								?>	
							   <br/>								
								<!-- Location Name -->
								<?php echo $cs_event_meta->event_map_heading; ?>
								
                            </div>
							
							<div class="event-link">
								<a href="<?php the_permalink();?>">Click here for more info >></a>
							</div>
                        </div>
                    </div>
                </article>
            </div>
		<?php 
		}
		
		
		//======================================================================
		// Blog Classic View
		//======================================================================
		public function cs_classic_view( $cs_event_meta , $event_from_date, $category , $excerpt ) {
			global $post;
			$width	= '370';
			$height	= '208';
			$image_url = cs_get_post_img_src($post->ID, $width, $height);
			$title_limit = 46;
			$background	= '';
		?>
        <div class="col-md-12">
            <article class="cs-events events-classic">
                <?php if ( $image_url ) { ?>
                    <figure><a href="<?php the_permalink();?>"><img alt="" src="<?php echo esc_url( $image_url );?>"></a></figure>
                <?php }?>
                <div class="left-sp">
                    <h2><a href="<?php the_permalink();?>"><?php echo substr(get_the_title(),0, $title_limit); if(strlen(get_the_title())>$title_limit){echo '...';}?></a></h2>
                    <div class="location-info">
                        <time datetime="<?php echo esc_attr( date_i18n('Y-m-d',strtotime( $event_from_date ) ) );?>"> <?php echo esc_attr( date_i18n('M',strtotime( $event_from_date ) ) );?>  <span><?php echo esc_attr( date_i18n('j',strtotime( $event_from_date ) ) );?></span> </time>
                        <div class="info">
                            <div class="time-period">
                               <time datetime="<?php echo esc_attr( date_i18n('Y-m-d',strtotime( $event_from_date ) ) );?>"><i class="fa fa-clock-o"></i>
								<?php 
									  if( isset( $cs_event_meta->dynamic_post_event_start_time ) && $cs_event_meta->dynamic_post_event_start_time <> ''){
										echo esc_attr( $cs_event_meta->dynamic_post_event_start_time.' ' );
									  }
									  if(isset($cs_event_meta->dynamic_post_event_end_time) && $cs_event_meta->dynamic_post_event_end_time <> ''){
										_e('-', 'Awaken');
										echo esc_attr( ' '.$cs_event_meta->dynamic_post_event_end_time );
									  }
								 ?>
                               </time>
                              
                              <?php  if(isset($cs_event_meta->dynamic_post_event_ticket_options) && $cs_event_meta->dynamic_post_event_ticket_options <> '' ){
                                    if ( isset( $cs_event_meta->dynamic_post_event_ticket_color ) &&  $cs_event_meta->dynamic_post_event_ticket_color !='' ) {
                                        $color	= $cs_event_meta->dynamic_post_event_ticket_color;
                                        $background	= 'style="color:'.$color.'"';
                                    }
                                ?>
                                	<a class="booked" <?php echo esc_attr($background);?> href="<?php echo esc_url( $cs_event_meta->dynamic_post_event_buy_now );?>"><?php echo esc_attr($cs_event_meta->dynamic_post_event_ticket_options);?></a>
                               <?php  }?>
                           
                              </div>
                               <?php if( isset( $cs_event_meta->dynamic_post_location_address ) && $cs_event_meta->dynamic_post_location_address <> '' ){ ?>
                                	<span><i class="fa fa-map-marker"></i><?php echo esc_attr( $cs_event_meta->dynamic_post_location_address );?></span>
                           	   <?php }?>
                    </div>
                </div>
                </div>
            </article>
        </div>
		<?php
		}
		
		
		//======================================================================
		// Blog Minimal View
		//======================================================================
		public function cs_get_categories( $category ) {
			global $wpdb;
			if ( $category !='' && $category !='0'){ 
				$row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from $wpdb->terms WHERE slug = %s", $category ));
			}
			
			if ( isset($category) && $category !='' && $category !='0'){ 
				echo '<a href="'.site_url().'?cat='.$row_cat->term_id.'">'.$row_cat->name.'</a>';
			 } else {
				 /* Get All Tags */
				  $before_cat = '<i class="fa fa-align-left"></i> ';
				  $categories_list = get_the_term_list ( get_the_id(), 'event-category', $before_cat , ', ', '' );
				  if ( $categories_list ){
					printf( __( '%1$s', 'Awaken'),$categories_list );
				  } 
				 // End if Tags 
			 }
		 }
		
		
	}
}