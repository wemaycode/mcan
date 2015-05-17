<?php
/**
 * The template for displaying Achive(s) pages
 *
 * @package LMS
 * @since LMS  1.0
 * @Auther Chimp Solutions
 * @copyright Copyright (c) 2014, Chimp Studio 
 */
	get_header();

	global $cs_node,$cs_theme_options,$cs_counter_node;
	
	$cs_layout 	= '';
			if(isset($cs_theme_options['cs_excerpt_length']) && $cs_theme_options['cs_excerpt_length'] <> ''){ $default_excerpt_length = $cs_theme_options['cs_excerpt_length']; }else{ $default_excerpt_length = '255';}; 
			
			$cs_layout =isset($cs_theme_options['cs_default_page_layout'])? $cs_theme_options['cs_default_page_layout']:'col-md-12';
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
	<!-- PageSection Start -->
    <section class="page-section" style=" padding: 0; ">
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

                <!-- Blog Post Start -->
                 <?php 
				 if(is_author()){
					 global $author;
					 $userdata = get_userdata($author);
				 }
				 if(category_description() || is_tag() || (is_author() && isset($userdata->description) && !empty($userdata->description))){
					echo '<div class="widget evorgnizer">';
					if(is_author()){?>
                            <figure><a><?php echo get_avatar($userdata->user_email, apply_filters('PixFill_author_bio_avatar_size', 70));?></a></figure>
                            <div class="left-sp">
                                <h5><a><?php echo esc_attr($userdata->display_name); ?></a></h5>
                                <p><?php echo balanceTags($userdata->description, true); ?></p>
                            </div>
					<?php } elseif ( is_category()) {
							$category_description = category_description();
							if ( ! empty( $category_description ) ) {
							?>
							<div class="left-sp">
                                <p><?php  echo category_description();?></p>
                            </div>
                           <?php }?>
					<?php } elseif(is_tag()){  
							$tag_description = tag_description();
							if ( ! empty( $tag_description ) ) {
							?>
							<div class="left-sp">
                                <p><?php echo apply_filters( 'tag_archive_meta', $tag_description );?></p>
                            </div>
						<?php }
					}
					echo '</div>';
				}
                    if (empty($_GET['page_id_all']))
                        $_GET['page_id_all'] = 1;
                    if (!isset($_GET["s"])) {
                        $_GET["s"] = '';
                    }
					$description = 'yes';
					$taxonomy = 'category';
					$taxonomy_tag = 'post_tag';
					$args_cat = array();
					if(is_author()){
						$args_cat = array('author' => $wp_query->query_vars['author']);
						$post_type = array( 'post' );
					} elseif(is_date()){
						if(is_month() || is_year() || is_day() || is_time()){
							$args_cat = array('m' => $wp_query->query_vars['m'],'year' => $wp_query->query_vars['year'],'day' => $wp_query->query_vars['day'],'hour' => $wp_query->query_vars['hour'], 'minute' => $wp_query->query_vars['minute'], 'second' => $wp_query->query_vars['second']);
						}
						$post_type = array( 'post' );
					} else if ((isset( $wp_query->query_vars['taxonomy']) && !empty( $wp_query->query_vars['taxonomy'] )) ) {
						$taxonomy = $wp_query->query_vars['taxonomy'];
						$taxonomy_category='';
						$taxonomy_category=$wp_query->query_vars[$taxonomy];
						if ( $wp_query->query_vars['taxonomy']=='event-category' || $wp_query->query_vars['taxonomy']=='event-tag') {
						  $args_cat = array( $taxonomy => "$taxonomy_category");
						  $post_type='events';
						}elseif ( $wp_query->query_vars['taxonomy']=='causes-category' || $wp_query->query_vars['taxonomy']=='causes-tag') {
						  $args_cat = array( $taxonomy => "$taxonomy_category");
						  $post_type='causes';
						}elseif ( $wp_query->query_vars['taxonomy']=='project-category' || $wp_query->query_vars['taxonomy']=='project-tag') {
						  $args_cat = array( $taxonomy => "$taxonomy_category");
						  $post_type='project';
						}elseif ( $wp_query->query_vars['taxonomy']=='sermon-category' || $wp_query->query_vars['taxonomy']=='sermon-tag') {
						  $args_cat = array( $taxonomy => "$taxonomy_category");
						  $post_type='sermons';
 						}else {
							$taxonomy = 'category';
							$args_cat = array();
							$post_type='post';
						}
					} else if( is_category() ) {
						$taxonomy = 'category';
						$args_cat = array();
						$category_blog = $wp_query->query_vars['cat'];
						$post_type='post';
						$args_cat = array( 'cat' => "$category_blog");
					
					} else if ( is_tag() ) {
						
						$taxonomy = 'category';
						$args_cat = array();
						$tag_blog = $wp_query->query_vars['tag'];
						$post_type='post';
						$args_cat = array( 'tag' => "$tag_blog");
					
					} else {
						$taxonomy = 'category';
						$args_cat = array();
						$post_type='post';
					}
					
					$args = array( 
					'post_type'		 => $post_type, 
					'paged'			 => $_GET['page_id_all'],
					'post_status'	 => 'publish', 
					'order'			 => 'ASC',
				);
								
				$args = array_merge( $args_cat,$args );
				$custom_query = new WP_Query( $args );
                 ?>
                <?php if ( $custom_query->have_posts() ): ?>
	            <?php
				    while ( $custom_query->have_posts() ) : $custom_query->the_post();
					
					?> 
                    <div class="col-md-12">
						
                      <article class="cs-blog blog-small clearfix has_shapes">
						<?php
							$width = '372';
							$height = '279';
							$title_limit = 1000;
							$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
                                if ( isset( $thumbnail ) && $thumbnail !='' ) {?>
                                    <div class="cs-media">
                                      <figure>
                                        <?php cs_featured(); ?>
                                        <a href="<?php echo the_permalink();?>"><img alt="blog-grid" src="<?php echo esc_url( $thumbnail );?>"></a>
                                       <figcaption><a href="<?php echo the_permalink();?>"><i class="fa fa-align-justify"></i></a></figcaption>
                                      </figure>
                                    </div>
							   <?php
								}
							   ?>
                        <section>
                          <time datetime="<?php echo date_i18n('Y-m-d',strtotime(get_the_date()));?>"><?php echo date_i18n('M',strtotime(get_the_date()));?><small><?php echo date_i18n('j',strtotime(get_the_date()));?></small> </time>
                          <div class="title">
                            <h2><a href="<?php echo the_permalink();?>"><?php echo substr(get_the_title(),0, $title_limit); if(strlen(get_the_title())>$title_limit){echo '...';}?></a></h2>
                            <ul class="post-option clearfix">
                              <li><i class="fa fa-user"></i> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author();?></a> </li>
                              <?php 
								   /* Get All Tags */
									$categories_list = get_the_term_list ( get_the_id(), 'category', '' , ', ', '' );
									
									if ( $categories_list ){
										echo '<li> <i class="fa fa-bars"></i>';
									  printf( __( '%1$s', 'Awaken'),$categories_list );
									  echo ' </li>';
									} 
								   // End if Tags 
                                ?>
                            </ul>
                            <!--title--> 
                          </div>
                          <p> <?php echo cs_get_the_excerpt(255,'ture','');?></p>
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
						
                <?php endwhile; 
				else:
					if ( function_exists( 'fnc_no_result_found' ) ) { fnc_no_result_found(); }
				endif;  
				?>
        		
                <?php
					 $qrystr = '';
					// pagination start
						if ($custom_query->found_posts > get_option('posts_per_page')) {
						 if ( isset($_GET['page_id']) ) $qrystr .= "&page_id=".$_GET['page_id'];
						 if ( isset($_GET['author']) ) $qrystr .= "&author=".$_GET['author'];
						 if ( isset($_GET['tag']) ) $qrystr .= "&tag=".$_GET['tag'];
						 if ( isset($_GET['cat']) ) $qrystr .= "&cat=".$_GET['cat'];
						 if ( isset($_GET['event-category']) ) $qrystr .= "&event-category=".$_GET['event-category'];
						 if ( isset($_GET['events-tags']) ) $qrystr .= "&events-tags=".$_GET['events-tags'];
						 if ( isset($_GET['m']) ) $qrystr .= "&m=".$_GET['m'];
						 
						 if ( function_exists( 'cs_pagination' ) ) {  echo cs_pagination($custom_query->found_posts,get_option('posts_per_page'), $qrystr); }
								
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
<?php get_footer(); ?> 