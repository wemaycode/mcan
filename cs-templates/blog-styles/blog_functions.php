<?php
/**
 * File Type: Blog Shortcode
 */
	

//======================================================================
// Adding Blog Posts Start
//======================================================================
if (!function_exists('cs_blog_shortcode')) {
	function cs_blog_shortcode( $atts ) {
		global $post,$wpdb,$cs_theme_options,$cs_counter_node,$cs_xmlObject;
		$defaults = array('cs_blog_section_title'=>'','cs_blog_view'=>'','cs_blog_cat'=>'','cs_blog_orderby'=>'DESC','orderby'=>'ID','cs_blog_description'=>'yes','cs_blog_filterable'=>'','cs_blog_excerpt'=>'255','cs_blog_num_post'=>'10','blog_pagination'=>'','cs_blog_class' => '','cs_blog_animation' => '');
		extract( shortcode_atts( $defaults, $atts ) );
		
		$CustomId	= '';
		if ( isset( $cs_blog_class ) && $cs_blog_class ) {
			$CustomId	= 'id="'.$cs_blog_class.'"';
		}
		
		if ( trim($cs_blog_animation) !='' ) {
			$cs_custom_animation	= 'wow'.' '.$cs_blog_animation;
		} else {
			$cs_custom_animation	= '';
		}
		$owlcount = rand(40, 9999999);
		$cs_counter_node++;
		ob_start();
		
		if (isset($cs_xmlObject->sidebar_layout) && $cs_xmlObject->sidebar_layout->cs_page_layout <> '' and $cs_xmlObject->sidebar_layout->cs_page_layout <> "none"){				
				$cs_blog_layout = 'col-md-4';
		}else{
				$cs_blog_layout = 'col-md-3';	
		}
		
		//==Filters
		$filter_category = '';
		$filter_tag = '';
		$author_filter = '';
       	
		if ( isset($_GET['filter_category']) && $_GET['filter_category'] <> '' && $_GET['filter_category'] <> '0' ) { 
			$filter_category = $_GET['filter_category'];
		}
		//==Filters End
		
		//==Sorting
		
		if(isset($_GET['sort']) and $_GET['sort']=='asc'){
			$cs_blog_orderby	= 'ASC';
		} else{
			$cs_blog_orderby	= $cs_blog_orderby;
		}
		
		if(isset($_GET['sort']) and $_GET['sort']=='alphabetical'){
			$orderby				= 'title';
			$cs_blog_orderby	    = 'ASC';
		} else{
			$orderby	= 'meta_value';
		}
		
		//==Sorting End 
		
		if (empty($_GET['page_id_all'])) $_GET['page_id_all'] = 1;

		$cs_blog_num_post	= $cs_blog_num_post ? $cs_blog_num_post : '-1';
		
		$args = array('posts_per_page' => "-1", 'post_type' => 'post', 'order' => $cs_blog_orderby, 'orderby' => $orderby, 'post_status' => 'publish', 'ignore_sticky_posts' => 1);
		
		if(isset($cs_blog_cat) && $cs_blog_cat <> '' &&  $cs_blog_cat <> '0'){
			$blog_category_array = array('category_name' => "$cs_blog_cat");
			$args = array_merge($args, $blog_category_array);
		}
		
		if(isset($filter_category) && $filter_category <> '' && $filter_category <> '0'){
				
				if ( isset($_GET['filter-tag']) ) {$filter_tag = $_GET['filter-tag'];}
				if($filter_tag <> ''){
					$blog_category_array = array('category_name' => "$filter_category",'tag' => "$filter_tag");
				}else{
					$blog_category_array = array('category_name' => "$filter_category");
				}
				$args = array_merge($args, $blog_category_array);
			}
			
		if ( isset($_GET['filter-tag']) && $_GET['filter-tag'] <> '' && $_GET['filter-tag'] <> '0' ) {
			$filter_tag = $_GET['filter-tag'];
			if($filter_tag <> ''){
				$course_category_array = array('category_name' => "$filter_category",'tag' => "$filter_tag");
				$args = array_merge($args, $course_category_array);
			}
		}
		if ( isset($_GET['by_author']) && $_GET['by_author'] <> '' && $_GET['by_author'] <> '0' ) {
			$author_filter = $_GET['by_author'];
			if($author_filter <> ''){
				$authorArray = array('author' => "$author_filter");
				$args = array_merge($args, $authorArray);
			}
		}
		

		$query = new WP_Query( $args );
		$count_post = $query->post_count;
		
		$cs_blog_num_post	= $cs_blog_num_post ? $cs_blog_num_post : '-1';
		$args = array('posts_per_page' => "$cs_blog_num_post", 'post_type' => 'post', 'paged' => $_GET['page_id_all'], 'order' => $cs_blog_orderby, 'orderby' => $orderby, 'post_status' => 'publish', 'ignore_sticky_posts' => 1);
		
		if(isset($cs_blog_cat) && $cs_blog_cat <> '' &&  $cs_blog_cat <> '0'){
			$blog_category_array = array('category_name' => "$cs_blog_cat");
			$args = array_merge($args, $blog_category_array);
		}
		
		if(isset($filter_category) && $filter_category <> '' && $filter_category <> '0'){
				
				if ( isset($_GET['filter-tag']) ) {$filter_tag = $_GET['filter-tag'];}
				if($filter_tag <> ''){
					$blog_category_array = array('category_name' => "$filter_category",'tag' => "$filter_tag");
				}else{
					$blog_category_array = array('category_name' => "$filter_category");
				}
				$args = array_merge($args, $blog_category_array);
			}
			
		if ( isset($_GET['filter-tag']) && $_GET['filter-tag'] <> '' && $_GET['filter-tag'] <> '0' ) {
			$filter_tag = $_GET['filter-tag'];
			if($filter_tag <> ''){
				$course_category_array = array('category_name' => "$filter_category",'tag' => "$filter_tag");
				$args = array_merge($args, $course_category_array);
			}
		}
		if ( isset($_GET['by_author']) && $_GET['by_author'] <> '' && $_GET['by_author'] <> '0' ) {
			$author_filter = $_GET['by_author'];
			if($author_filter <> ''){
				$authorArray = array('author' => "$author_filter");
				$args = array_merge($args, $authorArray);
			}
		}
		
		if ( $cs_blog_cat !='' && $cs_blog_cat !='0'){ 
			$row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from $wpdb->terms WHERE slug = %s", $cs_blog_cat ));
		}
		
		$outerDivStart	= '';
		$outerDivEnd	= '';
		$section_title  = '';
		
		if(isset($cs_blog_section_title) && trim($cs_blog_section_title) <> ''){
			$section_title = '<div class="main-title col-md-12"><div class="cs-section-title"><h2>'.$cs_blog_section_title.'</h2></div></div>';
		}
		
		$randomId = cs_generate_random_string('10');
		
		if ( $cs_blog_view == 'blog-3-column' ) {
			$outerDivStart	= '<div class="mas-isotope-'.$randomId.'">';
			$outerDivEnd	= '</div>';
 		}

		$query = new WP_Query( $args );
		$post_count = $query->post_count;
		
		cs_get_blog_filters($cs_blog_cat,$author_filter,$filter_category,$filter_tag,$cs_blog_filterable,$cs_blog_animation);
		
		if ( $query->have_posts() ) {  
			$postCounter	= 0;
                    	
					  echo cs_allow_special_char($outerDivStart);
					  echo cs_allow_special_char( $section_title );
					  $blogObject	= new BlogTemplates();
                      while ( $query->have_posts() )  : $query->the_post();
					  		
					  $postCounter++;
					  $last_child = ( $post_count == $postCounter ) ? 'last_child' : '' ;
							if ( $cs_blog_view == 'blog-small' ) {
								$blogObject->cs_small_view( $cs_blog_description , $cs_blog_excerpt );
							} else if ( $cs_blog_view == 'blog-medium' ) {
								$blogObject->cs_medium_view( $cs_blog_description , $cs_blog_excerpt );
							} else if ( $cs_blog_view == 'blog-lrg' ) {
								$blogObject->cs_large_view( $cs_blog_description , $cs_blog_excerpt);
							} else if ( $cs_blog_view == 'blog-classic' ) {
								$blogObject->cs_classic_view( $cs_blog_description , $cs_blog_excerpt );
							} else if ( $cs_blog_view == 'blog-timeline' ) {
								$blogObject->cs_timeline_view( $cs_blog_description , $cs_blog_excerpt ,$last_child);
							} else if ( $cs_blog_view == 'blog-3-column' ) {
								$blogObject->cs_mesnory_view( $cs_blog_description , $cs_blog_excerpt );
							} else if ( $cs_blog_view == 'blog-grid' ) {
								$blogObject->cs_grid_view( $cs_blog_description , $cs_blog_excerpt,$cs_blog_layout );
							} else if ( $cs_blog_view == 'blog-clean' ) {
								$blogObject->cs_clean_view( $cs_blog_description , $cs_blog_excerpt );
							} else if ( $cs_blog_view == 'blog-box' ) {
								$blogObject->cs_box_view( $cs_blog_description , $cs_blog_excerpt ,$cs_blog_layout);
							} else if ( $cs_blog_view == 'blog-elite' ) {
								$blogObject->cs_elite_view( $cs_blog_description , $cs_blog_excerpt );
							} else {
								$blogObject->cs_small_view( $cs_blog_description , $cs_blog_excerpt );
							}
						
					  endwhile;
					  echo cs_allow_special_char( $outerDivEnd );
						  //==Pagination Start
							 if ( $blog_pagination == "Show Pagination" && $count_post > $cs_blog_num_post && $cs_blog_num_post > 0 ) {
								$qrystr = '';
								 if ( isset($_GET['page_id']) ) $qrystr .= "&amp;page_id=".$_GET['page_id'];
								 if ( isset($_GET['by_author']) ) $qrystr .= "&amp;by_author=".$_GET['by_author'];
								 if ( isset($_GET['sort']) ) $qrystr .= "&amp;sort=".$_GET['sort'];
								 if ( isset($_GET['filter_category']) ) $qrystr .= "&amp;filter_category=".$_GET['filter_category'];
								 if ( isset($_GET['filter-tag']) ) $qrystr .= "&amp;filter-tag=".$_GET['filter-tag'];
									 
								echo cs_pagination($count_post, $cs_blog_num_post,$qrystr,'Show Pagination');
							 }
						 //==Pagination End	
                         ?>                   
            <?php 
            }
            
		    wp_reset_postdata();	
                
            $post_data = ob_get_clean();
            return $post_data;
         }
	add_shortcode( 'cs_blog', 'cs_blog_shortcode' );
}
