<?php
/**
 * The template for Home page
 
 */
 
 get_header();
 global $cs_node,$cs_theme_options,$cs_counter_node;

	if(isset($cs_theme_options['cs_excerpt_length']) && $cs_theme_options['cs_excerpt_length'] <> ''){ $default_excerpt_length = $cs_theme_options['cs_excerpt_length']; }else{ $default_excerpt_length = '255';}; 
			
	$cs_layout 	=  $cs_theme_options['cs_default_page_layout'];
	if ( isset( $cs_layout ) && $cs_layout == "sidebar_left") {
		$cs_layout = "content-right col-md-9";
		$custom_height = 390;
	} else if ( isset( $cs_layout ) && $cs_layout == "sidebar_right" ) {
		$cs_layout = "content-left col-md-9";
		$custom_height = 390;
	} else {
		$cs_layout = "col-md-12";
		$custom_height = 390;
	}
	$cs_sidebar	= $cs_theme_options['cs_default_layout_sidebar'];

	$cs_tags_name = 'post_tag';
	$cs_categories_name = 'category';

	?>   
       <section class="page-section" style="padding:0;">
            <!-- Container -->
            <div class="container">
                <!-- Row -->
              <div class="row">     
                <!--Left Sidebar Starts-->
				<?php if ($cs_layout == 'content-right col-md-9'){ ?>
                    <div class="content-lt col-md-3"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar) ) : ?><?php endif; ?></div>
                <?php } ?>
                <!--Left Sidebar End-->
                
                <!-- Page Detail Start -->
        		<div class="<?php echo esc_attr($cs_layout); ?>">
					<?php if ( have_posts() ) : ?>
                    <?php /* The loop */
                       if (empty($_GET['page_id_all']))
                              $_GET['page_id_all'] = 1;
                          if (!isset($_GET["s"])) {
                              $_GET["s"] = '';
                          }
                    
					while ( have_posts() ) : the_post(); 
					$width = '372';
					$height = '279';
					$title_limit = 1000;
					$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
					$description = 'yes'; 
					$excerpt	 = '255'; 
					$post_thumb_view = 'Single Image';
					$post_xml = get_post_meta(get_the_id(), "post", true);
					if ( $post_xml <> "" ) {
						$cs_xmlObject = new SimpleXMLElement($post_xml);
						$post_thumb_view = $cs_xmlObject->post_thumb_view;	
					}
                    
                     ?>
                     <div class="col-md-12">
                      <article class="cs-blog blog-small clearfix has_shapes">
                        <?php if ( $post_thumb_view == 'Single Image' ){
                                if ( isset( $thumbnail ) && $thumbnail !='' ) {?>
                                    <div class="cs-media">
                                      <figure>
                                        <?php cs_featured(); ?>
                                        <a href="<?php echo the_permalink();?>"><img alt="blog-grid" src="<?php echo esc_url( $thumbnail );?>"></a>
                                        <figcaption><a href="<?php echo the_permalink();?>"><i class="fa fa-align-justify"></i></a></figcaption>
                                      </figure>
                                    </div>
                            <?php }
                              } else if ($post_thumb_view == 'Slider') {
                                    echo '<figure>';
                                    cs_featured();
                                    cs_post_flex_slider($width,$height,get_the_id(),'post-list');
                                    echo '</figure>';
                              } 
                         ?>
                        <section>
                          <time datetime="<?php echo date_i18n('Y-m-d',strtotime(get_the_date()));?>"><?php echo date_i18n('M',strtotime(get_the_date()));?><small><?php echo date_i18n('j',strtotime(get_the_date()));?></small> </time>
                          <div class="title">
                            <h2><a href="<?php echo the_permalink();?>"><?php echo substr(get_the_title(),0, $title_limit); if(strlen(get_the_title())>$title_limit){echo '...';}?></a></h2>
                            <ul class="post-option clearfix">
                              <li><i class="fa fa-user"></i> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author();?></a> </li>
								<?php 
                                     /* Get All Cats */
                                      $categories_list = get_the_term_list ( get_the_id(), 'category', '' , ', ', '' );
                                      if ( $categories_list ){
										  echo '<li> <i class="fa fa-bars"></i>';
                                        printf( __( '%1$s', 'Awaken'),$categories_list );
										echo ' </li>';
                                      } 
                                     // End if Cats 
                                ?>
                            </ul>
                            <!--title--> 
                          </div>
                          	<?php 
								if ($description == 'yes') {
									echo '<p>';
									 echo cs_get_the_excerpt($excerpt,'ture','');
									  echo '</p>';
									 wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'Awaken' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); 
							} ?> 
                          <a href="<?php echo the_permalink();?>" class="continue-reading"><i class="fa fa-angle-right"></i><?php _e('Continue Reading','Awaken');?></a>
                          
                          <ul class="post-option-btm clearfix">
                            <li><a href="<?php comments_link(); ?>"><i class="fa fa-comment-o"></i><?php echo comments_number(__('0', 'Awaken'), __('1', 'Awaken'), __('%', 'Awaken') );?> </a></li>
                            <?php //if ( $post_social_sharing == 'on' ) { ?>
                                <?php cs_addthis_script_init_method();?>
                                <li><a class="btnshare addthis_button_compact"><i class="fa fa-share-alt"></i><?php _e('Share','Awaken');?></a></li>
                            <?php //}?>
                          </ul>
                        </section>
                      </article>
                     </div>
                    <?php 
                        endwhile; 
                    else:
                         if ( function_exists( 'fnc_no_result_found' ) ) { fnc_no_result_found(); }
                    endif; 
                    ?>
                    
					<?php
                        $qrystr = '';
                        if ( isset($_GET['page_id']) ) $qrystr .= "&page_id=".$_GET['page_id'];
						if ($wp_query->found_posts > get_option('posts_per_page')) {
						   if ( function_exists( 'cs_pagination' ) ) { echo cs_pagination(wp_count_posts()->publish,get_option('posts_per_page'), $qrystr); } 
						}
                    ?>
            </div>
             	<!-- Page Detail End -->
                
                <!-- Right Sidebar Start -->
                <?php if ( $cs_layout  == 'content-left col-md-9'){ ?>
                   <div class="content-rt col-md-3"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar) ) : ?><?php endif; ?></div>
                <?php } ?>
                <!-- Right Sidebar End -->
   			</div> 	
        </div>
  </section>
<?php 

	

get_footer(); ?>