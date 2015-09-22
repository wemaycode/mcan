<!-- single.php -->
<?php
/**
 * The template for displaying all single posts
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
		$cs_tags_name = 'post_tag';
		$cs_categories_name = 'category';
		$postname = 'post';
		$image_url = cs_get_post_img_src($post->ID, 844, 475);	

		$post_xml = get_post_meta($post->ID, "post", true);	
			if ( $post_xml <> "" ) {
			
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$cs_layout 			= $cs_xmlObject->sidebar_layout->cs_page_layout;
				$cs_sidebar_left 	= $cs_xmlObject->sidebar_layout->cs_page_sidebar_left;
				$cs_sidebar_right   = $cs_xmlObject->sidebar_layout->cs_page_sidebar_right;
				if(isset($cs_xmlObject->cs_related_post))
					$cs_related_post = $cs_xmlObject->cs_related_post;
				else 
					$cs_related_post = '';
				
				if(isset($cs_xmlObject->cs_post_tags_show))
					$post_tags_show = $cs_xmlObject->cs_post_tags_show;
				else 
					$post_tags_show = '';
				
				if(isset($cs_xmlObject->post_social_sharing))
					$cs_post_social_sharing = $cs_xmlObject->post_social_sharing;
				else 
					$cs_post_social_sharing = '';
				
				if(isset($cs_xmlObject->cs_post_author_info_show))
					 $cs_post_author_info_show = $cs_xmlObject->cs_post_author_info_show;
				else 
					$cs_post_author_info_show = '';

				if ( $cs_layout == "left") {
					$cs_layout = "page-content blog-editor";
					$custom_height = 408;
					$leftSidebarFlag	= true;
				}
				else if ( $cs_layout == "right" ) {
					$cs_layout = "page-content blog-editor";
					$custom_height = 408;
					$rightSidebarFlag	= true;
				}
				else {
					$cs_layout = "col-md-12";
					$custom_height = 408;
				}
				$postname = 'post';
			}else{
				$cs_layout 	=  $cs_theme_options['cs_single_post_layout'];
				if ( isset( $cs_layout ) && $cs_layout == "sidebar_left") {
					$cs_layout = "page-content blog-editor";
					$cs_sidebar_left	= $cs_theme_options['cs_single_layout_sidebar'];
					$custom_height = 408;
					$leftSidebarFlag	= true;
				} else if ( isset( $cs_layout ) && $cs_layout == "sidebar_right" ) {
					$cs_layout = "page-content blog-editor";
					$cs_sidebar_right	= $cs_theme_options['cs_single_layout_sidebar'];
					$custom_height = 408;
					$rightSidebarFlag	= true;
				} else {
					$cs_layout = "col-md-12";
					$custom_height = 408;
				}
  				$post_pagination_show = 'on';
				$post_tags_show = '';
				$cs_related_post = '';
				$post_social_sharing = '';
				$post_social_sharing = '';
				$cs_post_author_info_show = '';
				$postname = 'post';
				$cs_post_social_sharing = '';
			}
			if ($post_xml <> "") {
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$post_view = $cs_xmlObject->post_thumb_view;
				$inside_post_view = $cs_xmlObject->inside_post_thumb_view;
				$post_video = $cs_xmlObject->inside_post_thumb_video;
				$post_audio = $cs_xmlObject->inside_post_thumb_audio;
				$post_slider = $cs_xmlObject->inside_post_thumb_slider;
				$post_featured_image = $cs_xmlObject->inside_post_featured_image_as_thumbnail;
				$cs_related_post = $cs_xmlObject->cs_related_post;
				$cs_post_social_sharing = $cs_xmlObject->post_social_sharing;
				$post_tags_show = $cs_xmlObject->post_tags_show;
				$post_pagination_show = $cs_xmlObject->post_pagination_show;
				$cs_post_author_info_show = $cs_xmlObject->post_author_info_show;
				$postname = 'post';
				
			}
			else {
				$cs_xmlObject = new stdClass();
				$post_view = '';
				$post_video = '';
				$post_audio = '';
				$post_slider = '';
				$post_slider_type = '';
				$cs_related_post = '';
				$post_pagination_show = '';
				$image_url = '';
				$width = 0;
				$height = 0;
				$image_id = 0;
				$cs_post_author_info_show = '';
				$postname = 'post';
				
				$cs_xmlObject->post_social_sharing = '';
			}		
		$custom_height = 408;	
		$width = 844;
		$height = 475;
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
      
      <!-- Blog Detail Start -->
      <div class="<?php echo esc_attr($cs_layout); ?>"> 
        <!-- Blog Start --> 
        <!-- Row -->
		<div class="col-md-12">
			<?php 
				/* Get Category Description for color bar */
				$postCats = get_the_category();
				foreach($postCats as $postCat){
					if($postCat->description != null)
						$catColorStyle = "border-left: 10px solid " . $postCat->description;
				}
				/* Display post title if in News */
				/*
				if (in_category('news') == true )
					$h2style = "font-size:30px!important;font-weight:bold!important;";
				*/
				
			?>
			<div class="blog-title-wrapper test" style="<?php echo $catColorStyle ?>">					
				<h2 style="<?php echo $h2style; ?>"><?php echo the_title(); ?></h2>
			</div>
				
			  <?php 
				if (isset($inside_post_view) and $inside_post_view <> '') {
					if( $inside_post_view == "Slider"){
						echo '<figure class="detailpost has_shapes">';
							cs_post_flex_slider($width,$height,get_the_id(),'post');
						echo '</figure>';
					} else if ($inside_post_view == "Single Image" && $image_url <> '') { 
						echo '<figure class="detailpost has_shapes">';
							echo '<img src="'.$image_url.'" alt="" >';
						echo '</figure>';
					} elseif ( $inside_post_view == "Video" and $post_video <> '' and $inside_post_view <> '' ) {
					   	$url = parse_url($post_video);
					   	if($url['host'] == $_SERVER["SERVER_NAME"]) {?>
					<?php
							echo '<figure class="detailpost has_shapes">';
							echo do_shortcode('[video width="'.$width.'" height="'.$height.'" mp4="'.$post_video.'"][/video]');
							echo '</figure>';
					  } else {
							$video	= wp_oembed_get($post_video,array('height' => $custom_height));
							$search = array('webkitallowfullscreen', 'mozallowfullscreen', 'frameborder="0"');
							echo '<figure class="detailpost has_shapes">';
							echo  str_replace($search,'',$video);
							echo '</figure>';
					  }
 				} elseif ($inside_post_view == "Audio" and $inside_post_view <> ''){  
				?>
                    <figure class="detail_figure">
                      <?php
					  echo do_shortcode('[audio mp3="'.$post_audio.'"][/audio]');
					  ?>
                    </figure>
            <?php    
				}
            }
			?>
            
            <!-- Post Content Start-->
            <div class="post-option-panel">
			
				<div class="post-info">
					<!-- Post Info -->
					<ul class="post-option clearfix">
						<!-- Author -->
						<li> 
							Posted by: 
							<a class="author" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
								<?php echo get_the_author();?>
							</a> 
						</li>
						<!-- Date -->
						<li> 
							<i class="fa fa-calendar-o"></i><?php echo date_i18n(get_option( 'date_format' ),strtotime(get_the_date()));?>
						</li>
						<!-- Categories -->
						<li> 
							<i class="fa fa-folder-o"></i> 
							<?php 
							if ( isset($cs_blog_cat) && $cs_blog_cat !='' && $cs_blog_cat !='0'){ 
								echo '<a href="'.site_url().'?cat='.$row_cat->term_id.'">'.$row_cat->name.'</a>';
							 } else {
								 /* Get All Tags */
		 
								  $categories_list = get_the_term_list ( get_the_id(), 'category', '' , ', ', '' );
								  if ( $categories_list ){
									printf( __( '%1$s', 'Awaken'),$categories_list );
								  } 
								 // End if Tags 
							 }
							?>
						</li>
						<!-- Tags -->
						<li>
							<i class="fa fa-tags"></i>
							<?php  
								if ( empty($cs_xmlObject->post_tags_show_text) ) 
									$post_tags_show_text = __('Tags', 'Awaken'); else $post_tags_show_text = $cs_xmlObject->post_tags_show_text;
								$categories_list = get_the_term_list ( get_the_id(), 'post_tag', '', ', ', '' );
								if ( $categories_list ){?>
									<?php printf( __( '%1$s', 'Awaken'),$categories_list );
								}
							?>
						</li>
						  
			  
					  <!--
					  <li> <i class="fa fa-comment-o"></i> <a href="<?php comments_link(); ?>"><?php echo comments_number(__('Comments 0', 'Awaken'), __('Comments 1', 'Awaken'), __('Comments %', 'Awaken') );?></a> </li>
					  -->
					</ul>
					
				</div>
				
                <!-- Post Content -->
                <div class="rich_editor_text">
                 <p>
				 
				 	<?php 
				
						the_content();
                 		wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'Awaken' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); 
					?>
                 </p>
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
                <!--<div class="cs-attachments">
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
                          		 <figure> <a href="<?php echo esc_url($image->guid);?>"><img src="<?php echo esc_url($image_url);?>" alt="<?php echo esc_attr($image->post_name);?>"></a> </figure>
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
                          	<div class="text"> <a href="<?php echo esc_url($image->guid);?>"><?php echo esc_attr($image->post_name);?></a> </div>
                        </li>
                    <?php } ?>
                  </ul>
               </div>
			   -->
               <?php } ?>
          </div>
            <!-- Post Content End--> 
          </div>
          <!-- Col Tags Start -->
          
          
		 <?php  
			if ($cs_post_social_sharing == "on"){
				?>
                <div class="detail-post col-md-12">
                    <div class="socialmedia">
                    <?php
					
                    if ( empty($cs_xmlObject->post_social_sharing_text) ) {
						$post_social_sharing_text = __('Share', 'Awaken');
					} else {
						$post_social_sharing_text = $cs_xmlObject->post_social_sharing_text;
					}
					//cs_social_share(false,true,$post_social_sharing_text);
					cs_social_share(false,true,'Share');
                    ?>
                    </div>
                </div>
			<?php
		 }
		 ?>
              
          <!-- Post Button Start-->
		  <div class="col-md-12">
			<div class="prevnext">View Older/Newer Posts</div>
		  </div>
          <div class="col-md-12">
          <?php if(isset($post_pagination_show) &&  $post_pagination_show == 'on'){
                  px_next_prev_custom_links('post');
             }
          ?>
          </div>
          
          <!-- Col Author Start -->
          <?php if(isset($cs_post_author_info_show) &&  $cs_post_author_info_show == 'on'){ ?>
          <!--<div class="col-md-12">
			 <?php //cs_author_description('show');?>    
          </div>
          <!-- Col Author End --> 
          
          <?php } ?>

          <!-- Col Recent Posts Start -->
          <?php if($cs_related_post =='on'){
						if ( empty($cs_xmlObject->cs_related_post_title) ) $cs_related_post_title = __('Related Posts', 'Awaken'); else $cs_related_post_title = $cs_xmlObject->cs_related_post_title;
						
						 ?>
          <div class="col-md-12 post-recent">
            <div class="cs-section-title">
              <h2><?php echo 'Related Posts' //esc_attr($cs_related_post_title);?></h2>
            </div>
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
				 while ($custom_query->have_posts()) : $custom_query->the_post();
					$image_url = cs_get_post_img_src($post->ID, $width, $height);
					
					if($image_url == ''){
						$img_class = 'no-image';	
						$image_url	= get_template_directory_uri().'/assets/images/no-image4x3.jpg';
					}else{
						$img_class  = '';
					}						 
					?>
             
              	<div class="col-md-3">
                  <!-- Article -->
                  <article class="cs-blog cs-blog-grid has_shapes clearfix"> 
                    <?php if($image_url <> ""){?>
                    <div class="cs-media">
                       <figure class="<?php echo esc_attr($img_class);?>"><a href="<?php the_permalink();?>"><img alt="blog-grid" src="<?php echo esc_url($image_url);?>"></a>
                         <figcaption><i class="fa fa-align-justify"></i></figcaption>
                       </figure>
                    </div>
                    <?php }?>
                    <section>
                        <time datetime="<?php echo get_the_date();?>"><?php echo date_i18n('M',strtotime(get_the_date()));?><small><?php echo date_i18n('j',strtotime(get_the_date()));?></small> </time>
                        <div class="title clearfix">
                          <h5><a href="<?php echo the_permalink();?>"><?php echo get_the_title();?></a></h5>
                          <ul class="post-option clearfix">
                            <li><i class="fa fa-user"></i> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author();?></a> </li>
                          </ul>
                          <!--title--> 
                        </div>
                    </section>
                  </article>
                  <!-- Article Close -->
              </div>
              <?php endwhile; wp_reset_postdata(); ?>
          </div>
          </div>
       <?php } ?>
          <!-- Col Recent Posts End --> 
          
          <!-- Col Comments Start -->
		  <?php comments_template('', true); ?>
          <!-- Col Comments End --> 
          
          <!-- Blog Post End --> 
        <!-- Blog End --> 
       <!-- Blog Detail End --> 
      <!-- Right Sidebar Start --> 
		
      <!-- Right Sidebar End -->
      <?php endwhile;   
		endif; ?>
        
    </div>
    <?php if ($rightSidebarFlag == true){ ?>
      		<aside class="page-sidebar">
       			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_right) ) : endif; ?>
      		</aside>
      <?php } ?>
  </div>
  </div>
</section>
<!-- PageSection End --> 
<!-- Footer -->
<?php get_footer(); ?>