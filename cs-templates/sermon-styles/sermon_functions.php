<?php
/**
 * File Type: Sermon Shortcode
 */
	

//======================================================================
// Adding Sermon Posts Start
//======================================================================
if (!function_exists('cs_sermon_shortcode')) {
	function cs_sermon_shortcode( $atts ) {
		global $post,$wpdb,$cs_theme_options,$cs_counter_node,$cs_xmlObject;
		
		$defaults = array('cs_sermon_section_title'=>'','cs_sermon_view'=>'','cs_sermon_cat'=>'','cs_sermon_filterable'=>'','cs_sermon_num_post'=>'10','sermon_pagination'=>'','cs_sermon_class' => '','cs_sermon_animation' => '');
		extract( shortcode_atts( $defaults, $atts ) );
		
		$CustomId	= '';
		if ( isset( $cs_sermon_class ) && $cs_sermon_class ) {
			$CustomId	= 'id="'.$cs_sermon_class.'"';
		}
		
		if ( trim($cs_sermon_animation) !='' ) {
			$cs_custom_animation = 'class="wow'.' '.$cs_sermon_animation.'"';
		} else {
			$cs_custom_animation	= '';
		}
		$owlcount = rand(40, 9999999);
		$cs_counter_node++;
		ob_start();
		
		
		if (isset($cs_xmlObject->sidebar_layout) && $cs_xmlObject->sidebar_layout->cs_page_layout <> '' and $cs_xmlObject->sidebar_layout->cs_page_layout <> "none"){				
				$cs_sermon_grid_layout = 'col-md-4';
		}else{
				$cs_sermon_grid_layout = 'col-md-3';	
		}
		
		//==Filters
		$filter_category = '';
		$filter_tag = '';
       	
		if ( isset($_GET['filter_category']) && $_GET['filter_category'] <> '' && $_GET['filter_category'] <> '0' ) { $filter_category = $_GET['filter_category'];
		}else if(isset($cs_sermon_cat) && $cs_sermon_cat <> '' && $cs_sermon_cat <> '0'){
			$filter_category = $cs_sermon_cat;
		}
		//==Filters End
		
		if(isset($_GET['sort']) and $_GET['sort']=='asc'){
			$order	= 'ASC';
		} else{
			$order	= 'DESC';
		}
		
		if(isset($_GET['sort']) and $_GET['sort']=='alphabetical'){
			$orderby	= 'title';
			$order	    = 'ASC';
		} else{
			$orderby	= 'meta_value';
		}

		if (empty($_GET['page_id_all'])) $_GET['page_id_all'] = 1;

		$cs_sermon_num_post	= $cs_sermon_num_post ? $cs_sermon_num_post : '-1';
		
		$args = array('posts_per_page' => "-1", 'post_type' => 'sermons', 'order' => $order,'orderby' => $orderby, 'post_status' => 'publish');
		
		if ( isset($_GET['filter_category']) && $_GET['filter_category'] <> '' && $_GET['filter_category'] <> '0' ) 
		{ 
			$sermon_category_array = array('sermon-category' => $_GET['filter_category']);
			$args = array_merge($args, $sermon_category_array);
		
		} else if(isset($cs_sermon_cat) && $cs_sermon_cat <> '' &&  $cs_sermon_cat <> '0'){
			$sermon_category_array = array('sermon-category' => "$cs_sermon_cat");
			$args = array_merge($args, $sermon_category_array);
		}
			
		

		$query = new WP_Query( $args );
		
		$count_post = $query->post_count;
		
		$cs_sermon_num_post	= $cs_sermon_num_post ? $cs_sermon_num_post : '-1';
		$args = array('posts_per_page' => "$cs_sermon_num_post", 'post_type' => 'sermons', 'paged' => $_GET['page_id_all'], 'order' => $order,'orderby' => $orderby, 'post_status' => 'publish');
		
		if ( isset($_GET['filter_category']) && $_GET['filter_category'] <> '' && $_GET['filter_category'] <> '0' ) 
		{ 
			$sermon_category_array = array('sermon-category' => $_GET['filter_category']);
			$args = array_merge($args, $sermon_category_array);
		
		} else if(isset($cs_sermon_cat) && $cs_sermon_cat <> '' &&  $cs_sermon_cat <> '0'){
			$sermon_category_array = array('sermon-category' => "$cs_sermon_cat");
			$args = array_merge($args, $sermon_category_array);
		}
		
		if(isset($filter_category) && $filter_category <> '' && $filter_category <> '0'){
				
				if ( isset($_GET['filter-tag']) ) {$filter_tag = $_GET['filter-tag'];}
				if($filter_tag <> ''){
					$sermon_category_array = array('sermon-category' => "$filter_category",'sermon-tag' => "$filter_tag");
				}else{
					$sermon_category_array = array('sermon-category' => "$filter_category");
				}
				$args = array_merge($args, $sermon_category_array);
			}
			
		if ( isset($_GET['filter-tag']) && $_GET['filter-tag'] <> '' && $_GET['filter-tag'] <> '0' ) {
			$filter_tag = $_GET['filter-tag'];
			if($filter_tag <> ''){
				$sermon_category_array = array('sermon-category' => "$filter_category",'sermon-tag' => "$filter_tag");
				$args = array_merge($args, $sermon_category_array);
			}
		}
		
		

		if ( $cs_sermon_cat !='' && $cs_sermon_cat !='0'){ 
			$row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from ".$wpdb->prefix."terms WHERE slug = %s", $cs_sermon_cat ));
		}
		
		$outerDivStart	= '<div '.cs_allow_special_char($CustomId).' '.cs_allow_special_char($cs_custom_animation).'>';
		$outerDivEnd	= '</div>';
		$section_title  = '';
		
		if(isset($cs_sermon_section_title) && trim($cs_sermon_section_title) <> ''){
			$section_title = '<div class="main-title col-md-12"><div class="cs-section-title"><h2>'.$cs_sermon_section_title.'</h2></div></div>';
		}
		
		$randomId = cs_generate_random_string('10');
		
		$query = new WP_Query( $args );
		$post_count = $query->post_count;
		
		cs_get_sermon_filters($cs_sermon_cat,$cs_sermon_filterable,$filter_category,$filter_tag,$cs_sermon_animation);
		
		if ( $query->have_posts() ) {  
			$postCounter	= 0;
                    	
					  echo balanceTags($outerDivStart,false);
					  echo balanceTags($section_title,false);
					  
                      while ( $query->have_posts() )  : $query->the_post();
							if ( $cs_sermon_view == 'sermon-list' ) {
								$sermonObject	= new SermonTemplates();
								$sermonObject->cs_sermon_list_view();
							} else if ( $cs_sermon_view == 'sermon-grid' ) {
								$sermonObject	= new SermonTemplates();
								$sermonObject->cs_sermon_grid_view($cs_sermon_grid_layout);
							} else if ( $cs_sermon_view == 'sermon-less' ) {
								$sermonObject	= new SermonTemplates();
								$sermonObject->cs_sermon_less_view();
							} 
						
					  endwhile;
					  echo balanceTags($outerDivEnd,false);
                              //==Pagination Start
                                 if ( $sermon_pagination == "Show Pagination" && $count_post > $cs_sermon_num_post && $cs_sermon_num_post > 0 ) {
                                    $qrystr = '';
									 if ( isset($_GET['sort']) ) $qrystr .= "&amp;sort=".$_GET['sort'];
									 if ( isset($_GET['filter_category']) ) $qrystr .= "&amp;filter_category=".$_GET['filter_category'];
									 if ( isset($_GET['filter-tag']) ) $qrystr .= "&amp;filter-tag=".$_GET['filter-tag'];
									 if ( isset($_GET['page_id']) ) $qrystr .= "&amp;page_id=".$_GET['page_id'];
                                    echo cs_pagination($count_post, $cs_sermon_num_post,$qrystr,'Show Pagination');
                                 }
                             //==Pagination End	
        
				if ( $cs_sermon_view <> 'sermon-less' ){
						echo cs_sermon_audio_player();
				}
            }
		  
		    wp_reset_postdata();	
                
            $post_data = ob_get_clean();
            return $post_data;
         }
	add_shortcode( 'cs_sermon', 'cs_sermon_shortcode' );
}


//======================================================================
// Adding Latest Sermon Posts Start
//======================================================================
if (!function_exists('cs_latest_sermon_shortcode')) {
	function cs_latest_sermon_shortcode( $atts ) {
		global $post,$wpdb,$cs_theme_options,$cs_counter_node,$latest_sermon_section_title,$cs_sermon_text_color;
		
		$defaults = array('cs_latest_sermon_section_title'=>'','cs_latest_sermon_cat'=>'','cs_sermon_text_color'=>'#fff','cs_latest_sermon_class' => '','cs_latest_sermon_animation' => '');
		extract( shortcode_atts( $defaults, $atts ) );
		
		$CustomId	= ( isset( $cs_latest_sermon_class ) && $cs_latest_sermon_class ) ?'id="'.$cs_latest_sermon_class.'"':'';
		
		$latest_sermon_section_title = ($cs_latest_sermon_section_title<>'')? $cs_latest_sermon_section_title : __('Latest Sermon','Awaken');
		
		if ( trim($cs_latest_sermon_animation) !='' ) {
			$cs_custom_animation = 'class="wow'.' '.$cs_latest_sermon_animation.'"';
		} else {
			$cs_custom_animation	= '';
		}
		
		$owlcount = rand(40, 9999999);
		$cs_counter_node++;
		ob_start();
		$args = array('posts_per_page' => "1", 'post_type' => 'sermons','order' => 'DESC', 'post_status' => 'publish');
		if(isset($cs_latest_sermon_cat) && $cs_latest_sermon_cat <> '' &&  $cs_latest_sermon_cat <> '0'){
			$sermon_category_array = array('sermon-category' => "$cs_latest_sermon_cat");
			$args = array_merge($args, $sermon_category_array);
		}
		if ( $cs_latest_sermon_cat !='' && $cs_latest_sermon_cat !='0'){ 
			$row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from ".$wpdb->prefix."terms WHERE slug = %s", $cs_latest_sermon_cat ));
		}
		$outerDivStart	= '<div '.cs_allow_special_char($CustomId).' '.cs_allow_special_char($cs_custom_animation).'>';
		$outerDivEnd	= '</div>';
		$section_title  = '';
		
		if(isset($cs_latest_sermon_section_title) && trim($cs_latest_sermon_section_title) <> ''){
			$section_title = '';
		}
		$randomId = cs_generate_random_string('10');
		$query = new WP_Query( $args );
		$post_count = $query->post_count;
		if ( $query->have_posts() ) {  
			$postCounter	= 0;
					  echo balanceTags($outerDivStart,false);
					  echo balanceTags($section_title,false);
                      while ( $query->have_posts() )  : $query->the_post();
							$sermonObject	= new SermonTemplates();
							$sermonObject->cs_latest_sermo_view();
					  endwhile;
					  echo balanceTags($outerDivEnd,false);
            }
		    wp_reset_postdata();	
            $post_data = ob_get_clean();
            return $post_data;
         }
		add_shortcode( 'cs_latest_sermon', 'cs_latest_sermon_shortcode' );
}

