<?php
/**
 * The template for Sermon Detail
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
		$cs_tags_name = 'sermon-tag';
		$cs_categories_name = 'sermon-category';
		$postname = 'sermons';
			
		$post_xml = get_post_meta($post->ID, "sermons", true);	
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
				$postname = 'sermons';
			}else{
				$cs_layout 	=  $cs_theme_options['cs_single_post_layout'];
				if ( isset( $cs_layout ) && $cs_layout == "sidebar_left") {
					$cs_layout = "page-content blog-editor";
					$cs_sidebar_left	= $cs_theme_options['cs_single_layout_sidebar'];
					
					$leftSidebarFlag	= true;
				} else if ( isset( $cs_layout ) && $cs_layout == "sidebar_right" ) {
					$cs_layout = "page-content blog-editor";
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
				
				$postname = 'sermons';
				$cs_post_social_sharing = '';
			}
			if ($post_xml <> "") {
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$cs_post_social_sharing 			= isset($cs_xmlObject->post_social_sharing)?$cs_xmlObject->post_social_sharing:'';
				$post_social_sharing_text 			= isset($cs_xmlObject->post_social_sharing_text)?$cs_xmlObject->post_social_sharing_text:'';
				$post_tags_show 			= isset($cs_xmlObject->post_tags_show)?$cs_xmlObject->post_tags_show:'';
				$sermon_audio_download_link = isset($cs_xmlObject->sermon_audio_download_link)?$cs_xmlObject->sermon_audio_download_link:'';;
				$sermon_notes_link			= isset($cs_xmlObject->sermon_notes_link)?$cs_xmlObject->sermon_notes_link:'';
				$sermon_summery			= isset($cs_xmlObject->sermon_summery)?$cs_xmlObject->sermon_summery:'';
				$sermon_speaker			= isset($cs_xmlObject->sermon_speaker)?$cs_xmlObject->sermon_speaker:'';
				$sermon_audio_url = '';
			}
			else {
				$cs_xmlObject = new stdClass();
							
				$cs_post_social_sharing = $post_social_sharing_text = $post_tags_show = $sermon_audio_download_link =$sermon_notes_link =$sermon_summery = $sermon_speaker = $sermon_audio_url = '';
			}		
			
		$width = 372;
		$height = 279;
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
      
      <!-- Sermon Detail Start -->
      <div class="<?php echo esc_attr($cs_layout); ?>"> 
        <!-- Sermon Start --> 
        <!-- Row -->
 		 <div class="col-md-12">
		 
				<div class="post-option-panel">
                        
                        <article class="cs-sermons sermon-list sermons-detail">
                            <?php if($image_url <> ''){ ?>
                                    <figure><img src="<?php echo esc_url($image_url); ?>" alt="sermon"></figure>
                            <?php } ?>
                            <section class="clearfix">
                                  <ul class="post-option">
                                    <?php if( $sermon_speaker <> ''){ ?>
                                        <li><i class="fa fa-user"></i><?php echo esc_attr($sermon_speaker); ?></li>
                                    <?php } ?>
                                    <li>
                                      <time datetime="<?php echo date_i18n(get_option('date_format'),strtotime(get_the_date()));?>"><i class="fa fa-building-o"></i><?php echo date_i18n(get_option('date_format'),strtotime(get_the_date()));?></time>
                                    </li>
                                    <?php $categories_list = get_the_term_list ( get_the_id(), 'sermon-category', 'Series:' , ', ', '' );
                                            if ( $categories_list ){
                                        ?>
                                                <li> <i class="fa fa-book"></i>
                                            <?php 
                                                    printf( __( '%1$s', 'Awaken'),$categories_list );
                                                 
                                            ?>
                                                </li>
                                          <?php } ?>
                                  </ul>
                                  
                                  <?php if($sermon_summery <> ''){ ?>
                                        <p><strong><?php _e('Summary:&nbsp;','Awaken'); ?></strong><?php echo esc_attr($sermon_summery); ?></p>
                                    <?php } ?>
                                  <ul class="post-links">
                                    <?php 
                                    if($sermon_audio_download_link<>''){ ?>
                                        <li><a class="btn-style2" href="<?php echo esc_url($sermon_audio_download_link); ?>"><i class="fa fa-microphone"></i><?php _e('Download Audio','Awaken');?></a></li>
                                    <?php } 
                                        if($cs_post_social_sharing == 'on'){
                                                cs_addthis_script_init_method();
                                    ?>
                                    <li><a class="btn-style2 btnshare addthis_button_compact" href="#"><i class="fa fa-share-alt"></i><?php echo esc_attr($post_social_sharing_text); ?></a></li>
                                    <?php } ?>
                                  </ul>
                            </section>
                        </article>
                        
                        <!--player-->
                        <?php
                            $counter_sermons=0;
                            $counter_sermons = count($cs_xmlObject->sermons);
                            cs_enqueue_jplayer();
                            if(isset($cs_xmlObject->sermons) && count($cs_xmlObject->sermons) > 0){
                                
                                ?>
                                <script>
                                jQuery(document).ready(function(){
                                    new jPlayerPlaylist({
                                        jPlayer: "#jquery_jplayer_<?php echo intval($post->ID);?>",
                                        cssSelectorAncestor: "#jp_container_<?php echo intval($post->ID);?>"
                                    }, [                                         
                                         <?php
                                            for ( $i=0; $i < $counter_sermons ;$i++ ){
                                                $sermon_title = $cs_xmlObject->sermons[$i]->sermon_title <> '' ? $cs_xmlObject->sermons[$i]->sermon_title : '';
                                                $sermon_audio_url = $cs_xmlObject->sermons[$i]->sermon_file_url <> '' ? $cs_xmlObject->sermons[$i]->sermon_file_url : '';
                                                echo '{';
                                                echo 'title:"'.$sermon_title.'",';
                                                echo 'mp3:"'.$sermon_audio_url.'"';
                                                echo '},';
                                            }
                                        ?>
                                    ], {
                                        swfPath: "<?php echo get_template_directory_uri()?>/assets/scripts/Jplayer.swf",
                                        supplied: "mp3,oga",
                                        smoothPlayBar: true,
                                        wmode: "window",
                                    });
                                });                                                     
                                </script> 
                                <div class="nowplaying">
                                    <a href="<?php echo get_permalink();?>"><h5 class="colrhover"><?php the_title(); ?></h5></a>
                                    <div id="jquery_jplayer_<?php echo intval($post->ID);?>" class="jp-jplayer"></div>
                                    <div id="jp_container_<?php echo intval($post->ID);?>" class="jp-audio album-detail">
                                        <div class="jp-type-playlist">
                                            <div class="jp-gui">
                                                <div class="jp-interface">
                                                    <div class="jp-controls-holder">
                                                        <ul class="jp-controls audio-control">
                                                            <li>
                                                                <a href="javascript:;" class="jp-play" tabindex="1"> <em class="fa fa-play"></em>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;" class="jp-pause" tabindex="1">
                                                                    <em class="fa fa-pause"></em>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <div class="volume-wrap">
                                                            <ul class="jp-controls">
                                                                <li>
                                                                    <a title="mute" tabindex="1" class="jp-mute" href="javascript:;"> <em class="fa fa-volume-up"></em>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a title="unmute" tabindex="1" class="jp-unmute" href="javascript:;" style="display: none;"> <em class="fa fa-volume-down"></em>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <div class="jp-volume-bar">
                                                                        <div class="jp-volume-bar-value"></div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="jp-play-wrap">
                                                            <div class="fullwidth">
                                                                <div class="jp-title gallery">
                                                                    <ul>
                                                                        <li></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="jp-current-time"></div>
                                                            </div>
                                                            <div class="jp-progress">
                                                                <div class="jp-seek-bar">
                                                                    <div class="jp-play-bar backcolr"></div>
                                                                </div>
                                                            </div>
                                                            <div class="jp-duration"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="jp-playlist gallery">
                                                <div class="wrapper-payerlsit">
                                                    <ul>
                                                        <li></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        ?>
                            	
                        <div class="rich_editor_text">    
							<?php 
							the_content(); 
							wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'Awaken' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );							?>
                        </div>
						<?php
						 $thumb_ID = get_post_thumbnail_id( $post->ID );
						 if ( $images = get_children(array(
						   'post_parent' => get_the_ID(),
						   'post_type' => 'attachment',
						  // 'post_mime_type' => 'image',
						   'exclude' => $thumb_ID,
						  )))  
						//echo '<pre>';
						if(is_array($images))	{  
					?>
						  <div class="cs-attachments">
						  <h5> <?php _e('Attachments','Awaken');?> </h5>
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
										 <figure> <a href="<?php echo esc_attr($image->guid);?>"><img src="<?php echo esc_url($image_url);?>" alt="<?php echo esc_attr($image->post_name);?>"></a> </figure>
										 <?php } else if ( $image->post_mime_type == 'application/zip' ) { ?>
														<figure> <a href="<?php echo esc_attr($image->guid);?>"><i class="fa fa-file-zip-o"></i></a> </figure>
										 <?php }else if ( $image->post_mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' ) { ?>
														<figure> <a href="<?php echo esc_attr($image->guid);?>"><i class="fa fa-file-word-o"></i></a> </figure>
										 <?php } else if ( $image->post_mime_type == 'text/plain' ) { ?>
														<figure> <a href="<?php echo esc_attr($image->guid);?>"><i class="fa fa-file-text"></i></a> </figure>
										 <?php } else if ( $image->post_mime_type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' ) { ?>
														<figure> <a href="<?php echo esc_attr($image->guid);?>"><i class="fa fa-file-excel-o"></i></a> </figure>
										 <?php } else { ?>
														<figure> <a href="<?php echo esc_attr($image->guid);?>"><i class="fa fa-align-justify"></i></a> </figure>
										 <?php } ?>
									<div class="text"> <a href="<?php echo esc_attr($image->guid);?>"><?php echo esc_url($image->post_name);?></a> </div>
								</li>
							<?php } ?>
						  </ul>
					   </div>
					<?php } ?>
            </div>
                     
          <!-- Col Tags Start -->
         <div class="row">
          <div class="col-md-12">
            <div class="detail-post">
			 <?php if(isset($post_tags_show) &&  $post_tags_show == 'on'){ 
			 		$categories_list = get_the_term_list ( get_the_id(), 'sermon-tag', '<li>', '</li><li>', '</li>' );
					if ( empty($cs_xmlObject->post_tags_show_text) ) $post_tags_show_text = __('Tags', 'Awaken'); else $post_tags_show_text = $cs_xmlObject->post_tags_show_text;
					if ( isset($categories_list) and $categories_list <> '' ){
				?>
              <!-- cs Tages Start -->
              <div class="cs-tags">
                <div class="cs-title"><a href="#"><i class="fa fa-tags"></i><?php echo esc_attr($post_tags_show_text); ?></a></div>
                <ul>
                  <?php  
							  printf( __( '%1$s', 'Awaken'),$categories_list );
						  
					?>
                </ul>
              </div>
			 <?php }  } ?>
              <!-- cs Tages End -->
              <div class="socialmedia">
                 <?php  
			  		if ($cs_post_social_sharing == "on"){
						if ( empty($cs_xmlObject->post_social_sharing_text) ) $post_social_sharing_text = __('Share', 'Awaken'); else $post_social_sharing_text = $cs_xmlObject->post_social_sharing_text;
                       	cs_social_share(false,true,$post_social_sharing_text);
				 } ?>
              </div>
            </div>
          </div>
          
         
          <!-- Sermon next/prev Button Start-->
          
          <?php if(isset($post_pagination_show) &&  $post_pagination_show == 'on'){
				echo '<div class="col-md-12">';
							px_next_prev_custom_links('sermons');
				echo '</div>';
             }
          ?>
          
          <!-- Col related Sermon Start -->
          <?php if($cs_related_post =='on'){
						if ( empty($cs_xmlObject->cs_related_post_title) ) $cs_related_post_title = __('Related Sermons', 'Awaken'); else $cs_related_post_title = $cs_xmlObject->cs_related_post_title;
						
						 ?>
          <div class="col-md-12 post-recent">
            
            <div class="row">
              <?php 
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
					echo '<div class="col-md-12"><div class="cs-section-title">
								<h2>'. $cs_related_post_title.'</h2>
							</div></div>';
						 while ($custom_query->have_posts()) : $custom_query->the_post();
							$image_url = cs_get_post_img_src($post->ID, $width, $height);
							
							if($image_url == ''){
								$img_class = 'no-image';	
								$image_url	= get_template_directory_uri().'/assets/images/no-image4x3.jpg';
							}else{
								$img_class  = '';
							}						 
							?>
					 
						<div class="col-md-4">
						  <!-- Article -->
						  <article class="cs-blog cs-blog-grid has_shapes clearfix"> 
							<?php if($image_url <> ""){?>
							<div class="cs-media">
							   <figure class="<?php echo esc_attr($img_class);?>"><img alt="blog-grid" src="<?php echo esc_url($image_url);?>">
								 <figcaption><a href="<?php the_permalink();?>"><i class="fa fa-align-justify"></i></a></figcaption>
							   </figure>
							</div>
							<?php }?>
							<section>
								<time datetime="<?php echo get_the_date();?>"><?php echo date_i18n('M',strtotime(get_the_date()));?><small><?php echo date_i18n('j',strtotime(get_the_date()));?></small> </time>
								<div class="title clearfix">
								  <h5><a href="<?php echo the_permalink();?>"><?php echo substr(get_the_title(),0,30);echo (strlen(get_the_title())>30)?'...':''; ?></a></h5>
								  <ul class="post-option clearfix">
								  <?php if( $sermon_speaker <> ''){ ?>
									<li><i class="fa fa-user"></i><?php echo esc_attr($sermon_speaker);?></li>
								  <?php } ?>
								  </ul>
								  <!--title--> 
								</div>
							</section>
						  </article>
						  <!-- Article Close -->
					  </div>
					  <?php endwhile; 
				}
			  ?>
          </div>
          </div>
       <?php } ?>
	   
          <!-- Col Comments Start -->
		  <?php comments_template('', true); ?>
          <!-- Col Comments End --> 
          </div>
       </div>
      <!-- Sermon Detail End --> 
      <!-- Right Sidebar Start --> 
      </div>
	  <?php endwhile; endif; ?>
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