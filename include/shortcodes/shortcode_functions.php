<?php
//=====================================================================
// Adding mce custom button for short codes start
//=====================================================================
class ShortcodesEditorSelector {
    var $buttonName = 'shortcode';
    function addSelector() {
        add_filter('mce_external_plugins', array($this, 'registerTmcePlugin'));
        add_filter('mce_buttons', array($this, 'registerButton'));
    }
    function registerButton($buttons) {
        array_push($buttons, "separator", $this->buttonName);
        return $buttons;
    }
    function registerTmcePlugin($plugin_array) {
        return $plugin_array;
    }
}

if (!isset($shortcodesES)) {
   $shortcodesES = new ShortcodesEditorSelector();
    add_action('admin_head', array($shortcodesES, 'addSelector'));
}

//=====================================================================
//Bootstrap Coloumn Class
//=====================================================================
if ( ! function_exists( 'cs_custom_column_class' ) ) {
	function cs_custom_column_class($column_size){
		$coloumn_class = 'col-md-12';
		if(isset($column_size) && $column_size <> ''){
			list($top, $bottom) = explode('/', $column_size);
				$width = $top / $bottom * 100;
				$width =(int)$width;
				$coloumn_class = '';
				if(round($width) == '25' || round($width) < 25){
					$coloumn_class = 'col-md-3';			
				} elseif(round($width) == '33' || (round($width) < 33 && round($width) > 25)){
					$coloumn_class = 'col-md-4';	
				} elseif(round($width) == '50' || (round($width) < 50 && round($width) > 33)){
					$coloumn_class = 'col-md-6';	
				} elseif(round($width) == '67' || (round($width) < 67 && round($width) > 50)){
					$coloumn_class = 'col-md-8';	
				} elseif(round($width) == '75' || (round($width) < 75 && round($width) > 67)){
					$coloumn_class = 'col-md-9';	
				} else {
					$coloumn_class = 'col-md-12';
				}
		}
		return $coloumn_class;
	}
}

//=====================================================================
// Column Width
//=====================================================================
if ( ! function_exists( 'cs_custom_column_type' ) ) {
	function cs_custom_column_type($width){
		$coloumn_class = '1/1';
		if(isset($width) && $width <> ''){
			$width = (int)$width;
				if(round($width) == '25' || round($width) < 25){
					$coloumn_class = '1/4';			
				} elseif(round($width) == '33' || (round($width) < 33 && round($width) > 25)){
					$coloumn_class = '1/3';	
				} elseif(round($width) == '50' || (round($width) < 50 && round($width) > 33)){
					$coloumn_class = '1/2';	
				} elseif(round($width) == '67' || (round($width) < 67 && round($width) > 50)){
					$coloumn_class = '2/3';	
				} elseif(round($width) == '75' || (round($width) < 75 && round($width) > 67)){
					$coloumn_class = '3/4';	
				} else {
					$coloumn_class = '1/1';
				}
		}
		return  $coloumn_class;
	}
}

//=====================================================================
// Event Listing Shortcode
//=====================================================================
if (!function_exists('cs_events_listing_shortcode')) {
	function cs_events_listing_shortcode( $atts ) {
		$defaults = array('cs_event_title'=>'','cs_event_type'=>'All Events', 'cs_event_category'=>'0', 'cs_event_view'=>'eventlisting', 'cs_event_featured_category'=>'0', 'cs_event_thumbnail'=>'Yes', 'cs_event_time'=>'Yes', 'cs_event_view_all_link'=>'#', 'cs_event_excerpt'=>'255', 'cs_event_filterables'=>'No', 'cs_event_pagination'=>'Show Pagination','orderby'=>'ID','order'=>'DESC','cs_event_per_page'=>'10','class'=>'cs-eventlist','order'=>'DESC','orderby'=>'ID');
		extract( shortcode_atts( $defaults, $atts ) );
		
		if (empty($_GET['page_id_all'])) $_GET['page_id_all'] = 1;
		ob_start();
		if(isset($cs_event_title) && $cs_event_title <> ''){
			echo esc_attr('<header class="cs-heading-title">
							<h2 class="cs-section-title">'.$cs_event_title.'</h2>
						  </header>');
		}
		if(!is_int($cs_event_per_page)){
			$cs_event_per_page = 8;	
		}
		$event_args_all = array('posts_per_page' => "-1", 'post_type' => 'events', 'post_status' => 'publish');
		if(isset($cs_event_category) && $cs_event_category <> '' &&  $cs_event_category <> '0'){
			$event_category_array = array('event-category' => "$cs_event_category");
			$event_args_all = array_merge($event_args_all, $event_category_array);
		}
		$event_query_all = new WP_Query($event_args_all);
		$event_post_count = $event_query_all->post_count;
		$args = array(
			'post_type' 		=> 'events',
			'paged'  			=> $_GET['page_id_all'],
			'posts_per_page' 	=> (int)"$cs_event_per_page",
			'order' 			=> "$order",
			'orderby' 			=> "$orderby",
		);
		if(isset($cs_event_category) && $cs_event_category <> '' &&  $cs_event_category <> '0'){
			$event_category_array = array('event-category' => "$cs_event_category");
			$args = array_merge($args, $event_category_array);
		}
		$event_query = new WP_Query( $args );
		if ( $event_query->have_posts() ) {
			echo '<div class="event-listing '.$class.' '.$cs_event_view.'">';
					while ( $event_query->have_posts() ) : $event_query->the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <h4><a href="<?php esc_url(the_permalink()); ?>"><?php esc_attr(the_title()); ?></a></h4>
                            <p><?php echo cs_get_the_excerpt($cs_event_excerpt,true);?></p>
                        </article>
				<?php endwhile;
				 $qrystr = '';
               if ( $cs_event_pagination == "Show Pagination" and $event_post_count > $cs_event_per_page and $cs_event_per_page > 0 ) {
					if ( isset($_GET['page_id']) ) $qrystr = "&page_id=".$_GET['page_id'];
						echo cs_pagination($event_post_count, $cs_event_per_page,$qrystr);
                }
				wp_reset_postdata(); ?>
			</ul>
		<?php $events_data = ob_get_clean();
		return $events_data;
		}
	}
	add_shortcode( 'cs_event', 'cs_events_listing_shortcode' );
}

//=====================================================================
// Portfolio Listing Shortcode
//=====================================================================
if (!function_exists('cs_portfolio_listing_shortcode')) {
	function cs_portfolio_listing_shortcode( $atts ) {
		$defaults = array('cs_portfolio_title'=>'', 'cs_portfolio_category'=>'0', 'cs_portfolio_view'=>'portfoliolisting', 'cs_portfolio_featured_category'=>'0', 'cs_portfolio_thumbnail'=>'Yes', 'cs_portfolio_time'=>'Yes', 'cs_portfolio_view_all_link'=>'#', 'cs_portfolio_excerpt'=>'255', 'cs_portfolio_filterables'=>'No', 'cs_portfolio_pagination'=>'Show Pagination','orderby'=>'ID','order'=>'DESC','cs_portfolio_per_page'=>'10','class'=>'cs-portfoliolist','order'=>'DESC','orderby'=>'ID');
		extract( shortcode_atts( $defaults, $atts ) );

		if (empty($_GET['page_id_all'])) $_GET['page_id_all'] = 1;
		ob_start();
		if(isset($cs_portfolio_title) && $cs_portfolio_title <> ''){
			echo esc_attr('<header class="cs-heading-title">
							<h2 class="cs-section-title">'.$cs_portfolio_title.'</h2>
						  </header>');
		}
		$cs_portfolio_pagination = $atts['cs_dcpt_post_pagination'];
		if(isset($atts['cs_dcpt_post_per_page'])){
			$cs_portfolio_per_page = $atts['cs_dcpt_post_per_page'];
		}
		else{
			$cs_portfolio_per_page = '-1';
		}
		
		$portfolio_args_all = array('posts_per_page' => "-1", 'post_type' => 'portfolio', 'post_status' => 'publish');
		if(isset($atts['cs_dcpt_post_category']) && $atts['cs_dcpt_post_category'] <> '' &&  $atts['cs_dcpt_post_category'] <> '0'){
			$cs_portfolio_category = $atts['cs_dcpt_post_category'];
			$portfolio_category_array = array('portfolio-categories' => "$cs_portfolio_category");
			$portfolio_args_all = array_merge($portfolio_args_all, $portfolio_category_array);
		}
		$portfolio_query_all = new WP_Query($portfolio_args_all);
		$portfolio_post_count = $portfolio_query_all->post_count;
		$args = array(
			'post_type' => 'portfolio',
			'paged'  => $_GET['page_id_all'],
			'posts_per_page' => (int)"$cs_portfolio_per_page",
			'order' => "$order",
			'orderby' => "$orderby",
		);
		if(isset($cs_portfolio_category) && $cs_portfolio_category <> '' &&  $cs_portfolio_category <> '0'){
			$portfolio_category_array = array('portfolio-categories' => "$cs_portfolio_category");
			$args = array_merge($args, $portfolio_category_array);
		}
		
		//var_dump($atts);
		
		$filterable = $atts['cs_dcpt_post_filterable'];
		$portfolio_query = new WP_Query( $args );
		if ( $portfolio_query->have_posts() ) { 
			
			cs_filterable();
		?>
        	
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					portfolio_mix();
				});
			</script>
            <?php
			if(isset($atts['cs_dcpt_section_title']) and $atts['cs_dcpt_section_title'] <> ''){
			?>
            <div class="cs-section-title">
                <h2><?php echo balanceTags($atts['cs_dcpt_section_title']); ?></h2>
            </div>
            <?php
			}
			?>
			<div class="portfoliopage <?php echo esc_html($class.' '.$cs_portfolio_view);?>">
            	<?php
				if( isset($cs_portfolio_category) && ($cs_portfolio_category <> "" && $cs_portfolio_category <> "0")){	
					$categories = get_categories( array('child_of' => "$cs_portfolio_category", 'taxonomy' => 'portfolio-categories') );
				
				}else{
					$categories = get_categories( array('taxonomy' => 'portfolio-categories') );
				}
				
				if(isset($filterable) and $filterable == 'Yes'){
				?>
            	<div class="filter_nav">
                    <ul class="splitter">
                      <li class="filter active" data-filter="all"><a href="#"><?php _e('View All', 'Awaken'); ?></a></li>
                      <?php
					  foreach ($categories as $category) {
					  ?>
                      <li class="filter" data-filter="<?php echo intval($category->term_id); ?>"><a href="#"><?php echo esc_attr($category->cat_name); ?></a></li>
                      <?php
					  }
					  ?>
                    </ul>
                </div>
                <?php
				}
				?>
            	<ul id="list" class="image-grid">
				<?php while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post();
						
						global $post;
						$image_id = get_post_thumbnail_id($post->ID);
						if($image_id <> ''){
							$image_url = cs_attachment_image_src(get_post_thumbnail_id($post->ID), 370, 278);
							$full_image_url = cs_attachment_image_src(get_post_thumbnail_id($post->ID), 0, 0);
						}else{
							$image_url = get_template_directory_uri().'/assets/images/no-image4x3.jpg';
							$full_image_url = get_template_directory_uri().'/assets/images/no-image4x3.jpg';
						}
						
						$post_cats = wp_get_object_terms( $post->ID, 'portfolio-categories' );
						$p_cats = '';
						foreach($post_cats as $cats){
							$p_cats = $cats->term_id.' ';
						}
						?>
                        <li data-id="id-<?php echo intval($post->ID); ?>" class="mix <?php echo esc_html($p_cats); ?>">
                            <!-- Article Start -->
                            <article>
                            	<?php if($image_url <> ''){ ?>
                                <figure><a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($image_url); ?>" alt=""></a>
                                <?php } ?>
                                    <figcaption>
                                        <div class="figinn lightbox">
                                            <a data-rel="prettyPhoto" href="<?php echo esc_url($full_image_url);?>" class="fa fa-search-plus"></a>
                                            <a href="<?php the_permalink(); ?>" class="fa fa-link"></a>
                                        </div>
                                    </figcaption>
                                </figure>
                                <?php
								if(isset($atts['cs_dcpt_post_time']) and $atts['cs_dcpt_post_time'] == 'Yes'){
								?>
                                <div class="text">
                                    <h2><a href="<?php the_permalink(); ?>"><?php echo substr(get_the_title(), 0, 18); echo strlen(get_the_title()) > 18 ? '...' : ''; ?></a></h2>
                                    <?php echo get_the_term_list ( $post->ID, 'portfolio-categories', '<span><i class="fa fa-plus"></i>', ', ', '</span>' ); ?>
                                    
                                </div>
                                <?php
								}
								?>
                            </article>
                            <!-- Article End -->
                        </li>
				 <?php endwhile;
				 if(isset($filterable) and $filterable <> 'Yes'){
					 $qrystr = '';
					 if ( $cs_portfolio_pagination == "Show Pagination" and $portfolio_post_count > $cs_portfolio_per_page and $cs_portfolio_per_page > 0 ) {
						if ( isset($_GET['page_id']) ) $qrystr = "&page_id=".$_GET['page_id'];
							echo cs_pagination($portfolio_post_count, $cs_portfolio_per_page,$qrystr);
					 }
				 }
				 wp_reset_postdata(); ?>
			</ul>
        </div>
		<?php $portfolios_data = ob_get_clean();
		return $portfolios_data;
		}
	}
	add_shortcode( 'cs_portfolio', 'cs_portfolio_listing_shortcode' );
}

//=====================================================================
//Progress bars Shortcode
//=====================================================================
if (!function_exists('cs_bar_shortcode')) {
	function cs_chart_shortcode($atts, $content = "") {
		$defaults = array('class'=>'cs-chart','percent'=>'50','icon'=>'','title'=>'Title','text'=>'Text Description', 'background_color'=>'#ccc','animate_style'=>'slide');
		extract( shortcode_atts( $defaults, $atts ) );
		$html = '';
		$html .= '<div class="tiny-green" data-loadbar="'.$percent.'" data-loadbar-text="'.$text.'"><p>'.$title.'</p><div '.$style.'></div><span class="infotxt"></span></div>';
		return '<div class="skills"><div class="cs-chart '.$class.' progress_bar">' . $html . '</div><div class="clear"></div></div>';
	}
	add_shortcode('bar', 'cs_chart_shortcode');
}
//Skills Shortcode end

//=====================================================================
// Adding Article Box start
//=====================================================================
if (!function_exists('cs_article_box_shortcode')) {
	function cs_article_box_shortcode($atts, $content = "") {
		$defaults = array('class'=>'cs-article-box','image_url'=>'','slogan'=>'','title'=>'','link'=>'','target'=>'_self','animate_style'=>'slide');
		extract( shortcode_atts( $defaults, $atts ) );
		$figure = '';
		$link_tag_start = '';
		$link_tag_end = '';
		if(isset($link) && $link <> ''){
			$link_tag_start = '<a href="'.$link.'" target="'.$target.'" >';
			$link_tag_end = '</a>';
		}
		$figure .= '<figure>';
			if(isset($image_url) && $image_url <> ''){
				$figure .= $link_tag_start.'<img src="'.$image_url.'" alt="'.$title.'"  style="width: '.$width.'px; height: '.$height.'px;" />'.$link_tag_end;
			}
			$figure .= '<figcaption>';
				$figure .= '<h2>'.$link_tag_start.$title.$link_tag_end.'</h2>';
				$figure .= '<h3>'.$slogan.'</h3>';
			$figure .= '</figcaption>';
		$figure .= '</figure>';
		$figure .= '<p>'.do_shortcode($content).'</p>';
		return "<div class='animate-".$animate_style.' '.$class."'>" . $figure . "</div>";
	}
	add_shortcode('article_box', 'cs_article_box_shortcode');
}

//=====================================================================
// Adding Brands start
//=====================================================================
if (!function_exists('cs_brands_shortcode')) {
	function cs_brands_shortcode($atts, $content = "") {
		$defaults = array('onclick'=>'open_url','slider_type'=>'horizontal','slider_speed'=>'500','slider_autoplay'=>'true','slider_loop'=>'false','pagination'=>'','buttons_hide'=>'no','partial_view'=>'yes','class'=>'cs-brands-shortcode');
		extract( shortcode_atts( $defaults, $atts ) );
		return "<ul class='".$class."'>" . do_shortcode($content) . "</ul>";
	}
	add_shortcode('brands', 'cs_brands_shortcode');
}

//=====================================================================
// Adding Brands item
//=====================================================================
if (!function_exists('cs_brand_item_shortcode')) {
	function cs_brand_item_shortcode($atts, $content = "") {
		$defaults = array('title'=>'Title','image_url'=>'', 'width'=>'500','height'=>'300','url'=>'#','caption'=>'','target'=>'_self','animate'=>'');
		extract( shortcode_atts( $defaults, $atts ) );
		$figure = '';
		$link_tag_start = '';
		$link_tag_end = '';
		if(isset($url) && $url <> ''){
			$link_tag_start = '<a href="'.$url.'" target="'.$target.'" >';
			$link_tag_end = '</a>';
		}
		$figure .= '<figure>';
			if(isset($image_url) && $image_url <> ''){
				$figure .= $link_tag_start.'<img src="'.$image_url.'" alt="'.$title.'"  style="width: '.$width.'px; height: '.$height.'px;" />'.$link_tag_end;
			}
			$figure .= '<figcaption>';
				$figure .= '<h2>'.$link_tag_start.$title.$link_tag_end.'</h2>';
				$figure .= '<p>'.do_shortcode($content).'</p>';
			$figure .= '</figcaption>';
		$figure .= '</figure>';
		return "<li>". $figure . "</li>";
	}
	add_shortcode('brand-item', 'cs_brand_item_shortcode');
}


//=====================================================================
// Adding icon start
//=====================================================================
if (!function_exists('cs_icon_shortcode')) {
	function cs_icon_shortcode($atts, $content = "") {
			$defaults = array( 'border' => '','color' => '','bgcolor' => '','type' => '','cs_custom_class'=>'cs-tooltip-shortcode', 'cs_custom_animation'=>'', 'cs_custom_animation_duration'=>'1');
			extract( shortcode_atts( $defaults, $atts ) );
			
			$CustomId	= '';
			if ( isset( $cs_custom_class ) && $cs_custom_class ) {
				$CustomId	= 'id="'.$cs_custom_class.'"';
			}
		
			if ( trim($cs_custom_animation) !='' ) {
				$cs_quote_animation	= 'wow'.' '.$cs_custom_animation;
			} else {
				$cs_custom_animation	= '';
			}
			$icon_border = "";
			if ( $border == "yes" ){ $icon_border = "icon-border";}
		$html = '<i '.$CustomId.' class="fa '.$cs_custom_class.' '.$cs_custom_animation.' '.$type.' '.$size.' '.$icon_border. ' '. $class.'" style="color:'.$color.'; animation-duration: '.$cs_custom_animation_duration.'s; background-color:'.$bgcolor.'"></i>';
		return $html;
	}
	add_shortcode('icon', 'cs_icon_shortcode');
}
// adding icon end

//=====================================================================
// Adding code start
//=====================================================================
if (!function_exists('cs_code_shortcode')) {
	function cs_code_shortcode($atts, $content = "") {
		$defaults = array( 'title' => 'Title','content' => '','class'=>'cs-code-shortcode');
		extract( shortcode_atts( $defaults, $atts ) );
		$content = str_replace("<br />", "", $content);
		$title ='<h2 class="section-title">'.$title.'</h2>';
		$html = $title . '<div class="code-element '.$class.'"><pre>' . $content . '</pre></div>';
		return $html . '<div class="clear"></div>';
	}
	add_shortcode('code', 'cs_code_shortcode');
}
// adding code end

//=====================================================================
// Listing pages shortcode
//=====================================================================
if (!function_exists('cs_category_render')) {
	function cs_category_render($atts, $content = ""){
		global $post;
		$defaults = array('icon' => '', 'label' => '', 'no_categories'=>'', 'seperator'=>'' );
		ob_start();
		//$cs_categories_name = get_post_meta($cs_dcpt_post_type, 'cs_categories_name', true);
		if(isset($seperator) && $seperator <> ''){
			$seperator = $seperator;
		}
		
		$args=array(
			  'name' => (string)get_post_type($post->ID),
			  'post_type' => 'dcpt',
			  'post_status' => 'publish',
			  'showposts' => 1,
			);
 			$get_posts = get_posts($args);
			if($get_posts){
				$dcpt_id = (int)$get_posts[0]->ID;
				$cs_categories_name = get_post_meta($dcpt_id, 'cs_categories_name', true);
				$before_cat = '';
				if($icon){
					$before_cat .= $icon;
				}
				if($label){
					$before_cat .= ' '.$label;
				}
				
				$categories_listtt = get_the_term_list ( $post->ID, strtolower($cs_categories_name), $before_cat, $seperator, '' );
				if ( $categories_listtt ){
					printf( __( '%1$s', ''),$categories_listtt );
				}
			}
		$category_data = ob_get_clean();
		return $category_data;
	}
	add_shortcode('cs_category', 'cs_category_render');
}

//=====================================================================
// Listing pages shortcode
//=====================================================================
if (!function_exists('cs_tags_render')) {
	function cs_tags_render($atts, $content = ""){
		global $post,$cs_xmlObject;
		$defaults = array('icon' => '', 'label' => '', 'seperator'=>'' );
		ob_start();
		if(isset($cs_xmlObject->cs_post_tags_show) && $cs_xmlObject->cs_post_tags_show == 'on'){
			if(isset($seperator) && $seperator <> ''){
				$seperator = $seperator;
			}
			$args=array(
				  'name' => (string)get_post_type($post->ID),
				  'post_type' => 'dcpt',
				  'post_status' => 'publish',
				  'showposts' => 1,
				);
				$get_posts = get_posts($args);
				if($get_posts){
					$dcpt_id = (int)$get_posts[0]->ID;
					$cs_tags_name = get_post_meta($dcpt_id, 'cs_tags_name', true);
					$before_cat = '';
					if($icon){
						$before_cat .= $icon;
					}
					if($label){
						$before_cat .= ' '.$label;
					}
					$tags_listtt = get_the_term_list ( $post->ID, strtolower($cs_tags_name), $before_cat, $seperator, '' );
					if ( $tags_listtt ){
						printf( __( '%1$s', ''),$tags_listtt );
					}
				}
		}	
		$tags_data = ob_get_clean();
		return $tags_data;
	}
	add_shortcode('cs_tag', 'cs_tags_render');
}

//=====================================================================
// get shortcode content
//=====================================================================
if (!function_exists('cs_content_render')) {
	function cs_content_render($atts, $content = ""){
		global $post;
		ob_start();
		 the_content();
		 wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'Awaken' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
		$content_data = ob_get_clean();
		return $content_data;
	}
	add_shortcode('cs_content', 'cs_content_render');
}

//=====================================================================
// get post attachement
//=====================================================================
if (!function_exists('cs_post_attachment_render')) {
	function cs_post_attachment_render($atts, $content = ""){
		global $post,$cs_xmlObject;
		ob_start();
		$post_attachment = '';
		$args = array(
		   'post_type' => 'attachment',
		   'numberposts' => -1,
		   'post_status' => null,
		   'post_parent' => $post->ID
		  );
		  $attachments = get_posts( $args );
			if ( $attachments ) {
		 ?>
                <div class="cs-media-attachment mediaelements-post">
                <?php 
                foreach ( $attachments as $attachment ) {
					$attachment_title = apply_filters( 'the_title', $attachment->post_title );
					$type = get_post_mime_type( $attachment->ID );
					if($type=='image/jpeg'){
					  ?>
					<a <?php if ( $attachment_title <> '' ) { echo 'data-title="'.$attachment_title.'"'; }?> href="<?php echo esc_url($attachment->guid); ?>" data-rel="<?php echo "prettyPhoto[gallery1]"?>" class="me-imgbox"><?php echo wp_get_attachment_image( $attachment->ID, array(240,180),true ) ?></a>
					<?php
					
					} elseif($type=='audio/mpeg') {
						?>
						<!-- Button to trigger modal --> 
						<a href="#audioattachment<?php echo intval($attachment->ID);?>" role="button" data-toggle="modal" class="iconbox"><i class="fa fa-microphone"></i></a> 
						<!-- Modal -->
						<div class="modal fade" id="audioattachment<?php echo intval($attachment->ID);?>" tabindex="-1" role="dialog" aria-hidden="true">
						  <div class="modal-dialog">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							  </div>
							  <div class="modal-body">
								<audio style="width:100%;" src="<?php echo esc_url($attachment->guid); ?>" type="audio/mp3" controls="controls"></audio>
							  </div>
							</div>
							<!-- /.modal-content --> 
						  </div>
						</div>
						<?php
					} elseif($type=='video/mp4') {
					 ?>
					<a href="#videoattachment<?php echo intval($attachment->ID);?>" role="button" data-toggle="modal" class="iconbox"><i class="fa fa-video-camera"></i></a>
					<div class="modal fade" id="videoattachment<?php echo intval($attachment->ID);?>" tabindex="-1" role="dialog" aria-hidden="true">
					  <div class="modal-dialog">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						  </div>
						  <div class="modal-body">
							<video width="100%" height="360" poster="">
							  <source src="<?php echo esc_url($attachment->guid); ?>" type="video/mp4" title="mp4">
							</video>
						  </div>
						</div>
						<!-- /.modal-content --> 
					  </div>
					</div>
					<?php
					}
                }
                ?>
                </div>
                <?php  }
		$post_attachment_data = ob_get_clean();
		return $post_attachment_data;
	}
	add_shortcode('cs_post_attachment', 'cs_post_attachment_render');
}

//=====================================================================
// Author's related posts
//=====================================================================
if (!function_exists('cs_get_related_athor_posts')) {
	function cs_get_related_athor_posts($num_of_post) {
		global $authordata, $post;
		$post_type = get_post_type($post->ID);
		$authors_posts = get_posts( array( 'author' => $authordata->ID, 'post_type' => $post_type, 'post__not_in' => array( $post->ID ), 'posts_per_page' => $num_of_post ) );
		$output = '<ul>';
		foreach ( $authors_posts as $authors_post ) {
			$output .= '<li><a href="' . get_permalink( $authors_post->ID ) . '">' . apply_filters( 'the_title', $authors_post->post_title, $authors_post->ID ) . '</a></li>';
		}
		$output .= '</ul>';
		return $output;
	}
}

//=====================================================================
// Author's posts
//=====================================================================
if (!function_exists('cs_post_author_render')) {
	function cs_post_author_render($atts, $content = ""){
		global $post,$cs_xmlObject,$authordata;
		$defaults = array('thumbnail' => 'on','thumbnail_size' => '70','biographical' => 'off','social' => 'off','related_post' => 'on','num_of_post' => '4' );
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		if (isset($cs_xmlObject->cs_post_author_info_show) && $cs_xmlObject->cs_post_author_info_show == 'on') {
	 	?>
			<!-- About Author -->
			<div class="cs-content-wrap">
                <header class="cs-heading-title">
                  <h2 class=" cs-section-title"><?php _e('About','Awaken');?> <?php _e('Author','Awaken');?></h2>
                </header>
				<div class="about-author">
                    <?php if(isset($thumbnail) && $thumbnail == 'on'){?>
					 <figure><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="float-left"><?php echo get_avatar(get_the_author_meta('user_email'), apply_filters('PixFill_author_bio_avatar_size', $thumbnail_size)); ?></a></figure>
                     <?php }?>
					 <div class="text">
						<h4><a class="colrhover" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author(); ?></a></h4>
						<span></span>
                        <?php if(isset($thumbnail) && $thumbnail == 'on'){?>
							<p><?php the_author_meta('description'); ?></p>
                        <?php }?>
                        <?php if(isset($social) && $social == 'on'){?>
                            <ul class="socialmedia group">
                                 <?php if(get_the_author_meta('facebook') <> ''){?>
                                <li><a href="http://facebook.com/<?php the_author_meta('facebook'); ?>"><i class="fa fa-facebook"></i></a></li>
                                <?php } ?>
                                <?php if(get_the_author_meta('twitter') <> ''){?>
                                <li><a href="http://twitter.com/<?php the_author_meta('twitter'); ?>"><i class="fa fa-twitter"></i></a></li>
                                <?php } ?>
                                <li class="share"><a href="#">View All Posts</a></li>
                           </ul>
                        <?php }?>
					</div>
				</div>
                <?php if(isset($related_post) && $related_post == 'on'){
						
                		echo cs_get_related_athor_posts($num_of_post);
                 }?>
			</div>    
		   <!-- About Author End -->
		<?php	 
		}
		$coments_data = ob_get_clean();
		return $coments_data;
	}
	add_shortcode('cs_author_description', 'cs_post_author_render');
	add_shortcode('cs_author_detail', 'cs_post_author_render');
}

//=====================================================================
// Links Render
//=====================================================================
if (!function_exists('cs_edit_link_render')) {
	function cs_edit_link_render($atts, $content = ""){
		global $post;
		ob_start();
		edit_post_link( __( 'Edit','Awaken'), '<li>', '</li>' ); 
		$edit_post_data = ob_get_clean();
		return $edit_post_data;
	}
	add_shortcode('cs_edit', 'cs_edit_link_render');
}

//=====================================================================
// next prev posts links
//=====================================================================
if (!function_exists('cs_next_previous_post_render')) {
	function cs_next_previous_post_render($atts, $content = ""){
		global $post, $cs_xmlObject;
		$defaults = array('post_type' => 'post' );
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		if(isset($cs_xmlObject->post_pagination_show) &&  $cs_xmlObject->post_pagination_show == 'on'){px_next_prev_custom_links();}
		$cs_next_previous_data = ob_get_clean();
		return $cs_next_previous_data;
	}
	add_shortcode('cs_next_previous', 'cs_next_previous_post_render');
}

//=====================================================================
// post share button
//=====================================================================
if (!function_exists('cs_share_render')) {
	function cs_share_render($atts, $content = ""){
		global $post, $cs_xmlObject;
		$defaults = array('title'=>'Share', 'icon' => 'fa-share-square-o', 'class'=>'btnshare' );
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		if ($cs_xmlObject->cs_post_social_sharing == "on"){
			cs_addthis_script_init_method();
			echo '<a class="addthis_button_compact '.$class.'" href="#"><i class="fa '.$icon.'"></i>'.$title.'</a>';
		}

		$share_data = ob_get_clean();
		return $share_data;
	}
	add_shortcode('cs_share', 'cs_share_render');
}

//=====================================================================
// Get related posts
//=====================================================================
if (!function_exists('cs_related_post_render')) {
	function cs_related_post_render($atts, $content = ""){
		global $post, $cs_xmlObject;
		ob_start();
		if (isset($cs_xmlObject->cs_related_post) && $cs_xmlObject->cs_related_post == 'on') {
			$postname = get_post_type($post->ID);
			$cs_category = cs_taxanomy_name($postname,'category');
			$cs_tags = cs_taxanomy_name($postname,'tags');

		?>
      <div class="cs-blog blog-grid">
        <?php if ($cs_xmlObject->var_pb_post_related_title <> '') {
        echo '<header class="cs-heading-title">
          <h2 class="cs-section-title heading-color">'.$cs_xmlObject->var_pb_post_related_title.'</h2>
        </header>';
        }?>
        <div class="cs-related-post">
          <?php 
		   $custom_taxterms='';
		   $custom_taxterms = wp_get_object_terms( $post->ID, array($cs_category,$cs_tags), array('fields' => 'ids') );
			// arguments
			$args = array(
			'post_type' => $postname,
			'post_status' => 'publish',
			'posts_per_page' => 3, // you may edit this number
			'orderby' => 'DESC',
			'tax_query' => array(
				'relation' => 'OR',
				array(
					'taxonomy' => $cs_tags,
					'field' => 'id',
					'terms' => $custom_taxterms
				),
				array(
					'taxonomy' => $cs_category,
					'field' => 'id',
					'terms' => $custom_taxterms
				)
			),
			'post__not_in' => array ($post->ID),
			); 
			//print_r($args);
		$custom_query = new WP_Query($args);
		if($custom_query->have_posts()):
		while ( $custom_query->have_posts() ): $custom_query->the_post(); 
			$image_url = cs_attachment_image_src(get_post_thumbnail_id($post->ID), '280','200');
			$no_image = '';
			if($image_url == ""){
					$no_image = 'no-img';
			}
			 ?>
		<!-- Element Size Start -->
			  <article <?php post_class($no_image); ?>>
				<figure>
				  <?php if($image_url <> ""){?>
				  <a href="<?php the_permalink();?>"><img src="<?php echo esc_url($image_url);?>" alt=""></a>
				  <?php }?>
				</figure>
				<!-- Text Section -->
				<div class="text-sec">
				  <h4 class="post-title heading-color"><a href="<?php the_permalink();?>">
					<?php if ( strlen(get_the_title()) > 50){echo substr(get_the_title(),0,50);} else { the_title();} if ( strlen(get_the_title()) > 50) echo  "...";?>
					</a></h4>
			 
				</div>
				<!-- Text Section --> 
			  </article>
          <!-- Element Size End -->
          <?php endwhile; endif; wp_reset_postdata();?>
        </div>
      </div>
      <?php }
		$related_data = ob_get_clean();
		return $related_data;
	}
	add_shortcode('cs_related_post', 'cs_related_post_render');
}

//=====================================================================
// Post comments
//=====================================================================
if (!function_exists('cs_comments_render')) {
	function cs_comments_render($atts, $content = ""){
		global $post;
		ob_start();
		comments_template('', true);
		$coments_data = ob_get_clean();
		return $coments_data;
	}
	add_shortcode('cs_comments', 'cs_comments_render');
}

//=====================================================================
// Post author
//=====================================================================
if (!function_exists('cs_author_render')) {
	function cs_author_render($atts, $content = ""){
		global $post;
		ob_start();
		printf( __('%s','Awaken'), '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'" >'.get_the_author().'</a>' );
		$author_data = ob_get_clean();
		return $author_data;
	}
	add_shortcode('cs_author', 'cs_author_render');
}

//=====================================================================
// Post date
//=====================================================================
if (!function_exists('cs_postdate_render')) {
	function cs_postdate_render($atts, $content = ""){
		global $post;
		$defaults = array('date_format' => '' );
		extract( shortcode_atts( $defaults, $atts ) );
		if(isset($date_format) || $date_format <> ''){
			$date_format = $date_format;
		} else {
			$date_format = get_option( 'date_format' );
		}
		
		ob_start();
		?>
        <time datetime="<?php echo date_i18n('Y-m-d',strtotime(get_the_date()));?>"><?php echo date_i18n(get_option( 'date_format' ),strtotime(get_the_date()));?></time>
		<?php
		$postdate_data = ob_get_clean();
		return $postdate_data;
	}
	add_shortcode('cs_postdate', 'cs_postdate_render');
}

//=====================================================================
// Post Excerpt
//=====================================================================
if (!function_exists('cs_excerpt_render')) {
	function cs_excerpt_render($atts, $content = ""){
		global $post,$cs_node;
		$defaults = array('read_more' => 'true', 'read_more_text' => 'Read More' );
		ob_start();
		$cs_node->cs_dcpt_excerpt=(int)$cs_node->cs_dcpt_excerpt;
		 if(isset($cs_node->cs_dcpt_excerpt) && $cs_node->cs_dcpt_excerpt > 0){?>
            <p><?php  echo cs_get_the_excerpt($cs_node->cs_dcpt_excerpt,$read_more, $read_more_text);?></p>
         <?php }
		$postexcerpt_data = ob_get_clean();
		return $postexcerpt_data;
	}
	add_shortcode('cs_excerpt', 'cs_excerpt_render');
}

//=====================================================================
// Post Title
//=====================================================================
if (!function_exists('cs_title_render')) {
	function cs_title_render($atts, $content = ""){
		global $post;
		$defaults = array( 'link' => 'yes', 'chars' => '' );
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		if($link == 'yes'){
			echo '<a href="'.get_permalink().'">';
		}
		if(!empty($chars) && strlen(get_the_title())>$chars){
			echo substr(get_the_title(),0,$chars);
			echo '...';
		} else {
			the_title();
		}
		if($link == 'yes'){
			echo '</a>';
		}
		$posttitle_data = ob_get_clean();
		return $posttitle_data;
	}
	add_shortcode('cs_title', 'cs_title_render');
}

//=====================================================================
// Post Image
//=====================================================================
if (!function_exists('cs_image_render')) {
	function cs_image_render($atts, $content = ""){
		global $post,$cs_node;
		$defaults = array( 'alt' => '', 'height' => '300', 'width' => '300', 'link' => 'yes' );
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		$image_url = cs_get_post_img_src($post->ID, $width, $height);
		if (isset($image_url) && !empty($image_url)){
			echo '<figure>';
			if($link == 'yes'){
				echo '<a href="'.get_permalink().'">';
			}
			if(!empty($image_url)){
				echo '<img src="'.$image_url.'" alt="">';
			}
			if($link == 'yes'){
				echo '</a>';
			}
			echo '</figure>';
		}
		$posttitle_data = ob_get_clean();
		return $posttitle_data;
	}
	add_shortcode('cs_image', 'cs_image_render');
}

//=====================================================================
// Post Fields
//=====================================================================
if ( ! function_exists( 'cs_stickyfields_render' ) ) {
	function cs_stickyfields_render($atts, $content = ""){
		global $post,$cs_node,$cs_xmlObject;
		$defaults = array( 'title' => '','icon'=>'','count'=>'');
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		$post_name = get_post_type($post->ID);
		$post_ID = cs_get_parent_custom_posttype_id($post_name);
		$custom_fields = '';
		$cs_dcpt_custom_fields = '';
		$cs_dcpt_custom_fields = get_post_meta($post_ID, "cs_dcpt_custom_fields", true);
		if ( $cs_dcpt_custom_fields <> "" ) {
			$cs_customfields_object = new SimpleXMLElement($cs_dcpt_custom_fields);
			$custom_field_counter = 0;
			if(isset($cs_customfields_object->custom_fields_elements) && $cs_customfields_object->custom_fields_elements == '1'){
				if(count($cs_customfields_object)>1){
					global $cs_xmlObject;
					foreach ( $cs_customfields_object->children() as $cs_field_node ){
						if(isset($cs_field_node->cs_customfield_sticky) && $cs_field_node->cs_customfield_sticky == 'yes'){
							$icon_class = '';
							$label = $cs_field_node->cs_customfield_label;
							$name = $cs_field_node->cs_customfield_name;
							$icon_class = $cs_field_node->cs_customfield_icon;
							$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
							if ( $post_xml <> "" ) {
								$cs_xmlObject = new SimpleXMLElement($post_xml);
							}
							$custom_fields .= '<li>';
							if($icon == 'yes' && $icon_class <> ''){
								$custom_fields .= '<i class="fa '.$icon_class.'"></i>';
							}
							if($label){
								$custom_fields .= $label;
								$custom_fields .= ': ';
							}
							if(isset($name)){
								$custom_fields .= $cs_xmlObject->$name;
							}
							$custom_fields .= '</li>';
							if(isset($count) && $custom_field_counter == $count){
								break;
							}
							$custom_field_counter++;
						}
					} 
				}
			}
		}
		return $custom_fields;
	}
	add_shortcode('cs_stickyfields', 'cs_stickyfields_render');
}

//=====================================================================
// featured post title
//=====================================================================
if ( ! function_exists( 'cs_featured_render' ) ) {
	function cs_featured_render($atts, $content = ""){
		$defaults = array( 'title' => 'Featured');
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		if ( is_sticky() ){
			echo '<span class="cs-featured">'.$title.'</span>';
		}
		$postfeatured_data = ob_get_clean();
		return $postfeatured_data;
	}
	add_shortcode('cs_featured', 'cs_featured_render');
}

//=====================================================================
// Rating
//=====================================================================
if ( ! function_exists( 'cs_rating_render' ) ) {
	function cs_rating_render($atts, $content = ""){
		$defaults = array( 'rating_percentage' => '');
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		$rating_percent = 0;
		$rating_percent = $rating_percentage*20;
		echo '<div class="cs-rating"><span style="width:'.$rating_percentage.'%" class="rating-box"></span></div>';
		
		$postfeatured_data = ob_get_clean();
		return $postfeatured_data;
	}
	add_shortcode('cs_rating', 'cs_rating_render');
}

//=====================================================================
// attachments
//=====================================================================
if ( ! function_exists( 'cs_mediaattachments_render' ) ) {
	function cs_mediaattachments_render($atts, $content = ""){
		global $post,$cs_node;
		$defaults = array( 'icon' => '');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$media_attachment = '';
		if($icon){
			$media_attachment .= '<i class="fa '.$icon.'"></i>';
		}
		if(count($cs_xmlObject->gallery)>0){
			$media_attachment .= count($cs_xmlObject->gallery);
		}
		return $media_attachment;
	}
	add_shortcode('cs_mediaattachments', 'cs_mediaattachments_render');
}

//=====================================================================
// Model
//=====================================================================
if ( ! function_exists( 'cs_model_render' ) ) {
	function cs_model_render($atts, $content = ""){
		global $post,$cs_node;
		$defaults = array( 'title' => '', 'model' => '', 'icon' => 'fa-check');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_model = '';
		if($icon){
			$cs_model .= '<i class="fa '.$icon.'"></i>';
		}
		if($title){
			$cs_model .= $title;
		}
		if(isset($cs_xmlObject->dynamic_post_sale_model) && $cs_xmlObject->dynamic_post_sale_model <> ''){
			$cs_model .= $cs_xmlObject->dynamic_post_sale_model;
		}
		return $cs_model;
	}
	add_shortcode('cs_model', 'cs_model_render');
}

//=====================================================================
// post sale milage
//=====================================================================
if ( ! function_exists( 'cs_milage_render' ) ) {
	function cs_milage_render(){
		global $post,$cs_node;
		$defaults = array( 'title' => '', 'milage' => '', 'icon' => 'fa-check');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_milage = '';
		if($icon){
			$cs_milage .= '<i class="fa '.$icon.'"></i>';
		}
		if($title){
			$cs_milage .= $title;
		}
		if(isset($cs_xmlObject->dynamic_post_sale_milage) && $cs_xmlObject->dynamic_post_sale_milage <> ''){
			$cs_milage .= $cs_xmlObject->dynamic_post_sale_milage;
		}
		return $cs_milage;
	}
	add_shortcode('cs_milage', 'cs_milage_render');
}

//=====================================================================
// post price
//=====================================================================
if ( ! function_exists( 'cs_price_render' ) ) {
	function cs_price_render($atts, $content = ""){
		global $post,$cs_node;
		$defaults = array( 'title' => '', 'old_price' => '', 'new_price' => '', 'icon' => '');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_price = '<span>';
		if($title){
			$cs_price .= $title;
		}
		if($icon){
			$cs_price .= '<i class="fa fa-'.$icon.'"></i>';
		}
		if($title){
			$cs_price .= $title;
		}
		if(isset($cs_xmlObject->dynamic_post_sale_oldprice) && $cs_xmlObject->dynamic_post_sale_oldprice <> ''){
			$cs_price .= '<span>'.$cs_xmlObject->dynamic_post_sale_oldprice.'</span>';
		}
		if(isset($cs_xmlObject->dynamic_post_sale_newprice) && $cs_xmlObject->dynamic_post_sale_newprice <> ''){
			$cs_price .= '<big>'.$cs_xmlObject->dynamic_post_sale_newprice.'</big>';
		}
		$cs_price .= '</span>';
		return '<div class="cs-carprice">'.$cs_price.'</div>';
	}
	add_shortcode('cs_price', 'cs_price_render');
}

//=====================================================================
// custom email
//=====================================================================
if ( ! function_exists( 'cs_custom_email_render' ) ) {
	function cs_custom_email_render($atts, $content = ""){
		global $post,$cs_node;
		$defaults = array( 'name' => '', 'title' => '', 'icon'=>'');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_custom_email = '';
		if($title){
			$cs_custom_email .= $title;
		}
		if($icon){
			$cs_custom_email .= '<i class="fa fa-'.$icon.'"></i>';
		}
		if(isset($name)){
			$cs_custom_email .= $cs_xmlObject->$name;
		}
		return $cs_custom_email;
	}
	add_shortcode('cs_email', 'cs_custom_email_render');
}

//=====================================================================
// custom text
//=====================================================================
if ( ! function_exists( 'cs_custom_text_render' ) ) {
	function cs_custom_text_render($atts, $content = ""){
		global $post,$cs_node;
		$defaults = array( 'name' => '', 'title' => '',  'icon'=>'');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_custom_text = '';
		if($icon){
			$cs_custom_text .= '<i class="fa '.$icon.'"></i>';
		}
		if($title){
			$cs_custom_text .= $title;
		}
		if(isset($name)){
			$cs_custom_text .= $cs_xmlObject->$name;
		}
		return $cs_custom_text;
	}
	add_shortcode('cs_text', 'cs_custom_text_render');
}

//=====================================================================
// custom textarea 
//=====================================================================
if ( ! function_exists( 'cs_custom_textarea_render' ) ) {
	function cs_custom_textarea_render($atts, $content = ""){
		global $post,$cs_node;
		$defaults = array( 'name' => '', 'title' => '',  'icon'=>'');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_custom_text = '';
		if($icon){
			$cs_custom_text .= '<i class="fa '.$icon.'"></i>';
		}
		if(isset($title) && $title <> ''){
			$cs_custom_text .= $title;
		}
		if(isset($name)){
			$cs_custom_text .= $cs_xmlObject->$name;
		}
		return $cs_custom_text;
	}
	add_shortcode('cs_textarea', 'cs_custom_text_render');
}

//=====================================================================
// custom radio
//=====================================================================
if ( ! function_exists( 'cs_custom_radio_render' ) ) {
	function cs_custom_radio_render($atts, $content = ""){
		global $post,$cs_node;
		$defaults = array( 'name' => '', 'title' => '', 'icon'=>'');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_custom_radio = '';
		if($icon){
			$cs_custom_radio .= '<i class="fa '.$icon.'"></i>';
		}
		if($title){
			$cs_custom_radio .= $title;
		}
		if(isset($name)){
			$cs_custom_radio .= $cs_xmlObject->$name;
		}
		return $cs_custom_radio;
	}
	add_shortcode('cs_radio', 'cs_custom_radio_render');
}

//=====================================================================
// post date
//=====================================================================
if ( ! function_exists( 'cs_date_render' ) ) {
	function cs_date_render($atts, $content = ""){
		global $post,$cs_node;
		$defaults = array( 'name' => '', 'title' => '',  'icon'=>'');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_custom_date = '';
		if($icon){
			$cs_custom_date .= '<i class="fa '.$icon.'"></i>';
		}
		if($title){
			$cs_custom_date .= $title;
		}
		if(isset($name)){
			$cs_custom_date .= $cs_xmlObject->$name;
		}
		return $cs_custom_date;
	}
	add_shortcode('cs_date', 'cs_date_render');
}

//=====================================================================
// multi select option
//=====================================================================
if ( ! function_exists( 'cs_multiselect_render' ) ) {
	function cs_multiselect_render($atts, $content = ""){
		global $post,$cs_node;
		$defaults = array( 'name' => '', 'title' => '', 'icon'=>'');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_multiselect = '';
		if($icon){
			$cs_multiselect .= '<i class="fa '.$icon.'"></i>';
		}
		if($title){
			$cs_multiselect .= $title;
		}
		if(isset($name)){
			$name = trim($name);
			$cs_multiselect .= $cs_xmlObject->$name;
		}
		return $cs_multiselect;
	}
	add_shortcode('cs_multiselect', 'cs_multiselect_render');
}

//=====================================================================
// post url
//=====================================================================
if ( ! function_exists( 'cs_url_render' ) ) {

	function cs_url_render($atts, $content = ""){
		
		global $post,$cs_node;
		$defaults = array( 'name' => '', 'title' => '', 'icon'=>'');
		extract( shortcode_atts( $defaults, $atts ) );
		
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_url_render = '';
		if($icon){
			$cs_url_render .= '<i class="fa '.$icon.'"></i>';
		}
		if($title){
			$cs_url_render .= $title;
		}
		
		if(isset($name)){
			$name = trim($name);
			$cs_url_render .= $cs_xmlObject->$name;
		}
		return $cs_url_render;
	}
	add_shortcode('cs_url', 'cs_url_render');
}

//=====================================================================
// count media attachments
//=====================================================================
if ( ! function_exists( 'cs_mediaattachment_count_render' ) ) {

	function cs_mediaattachment_count_render($atts, $content = ""){
		
		global $post,$cs_node;
		$defaults = array( 'title' => '', 'icon'=>'fa-camera');
		extract( shortcode_atts( $defaults, $atts ) );
		
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_mediaattachment_count .= '<i class="fa '.$icon.'"></i> <span class="viewcount cs-bg-color">'.count($cs_xmlObject->gallery).'</span>';
		return $cs_mediaattachment_count;
	}
	add_shortcode('cs_mediaattachment_count', 'cs_mediaattachment_count_render');
}

if ( ! function_exists( 'cs_map_location_link_render' ) ) {

	function cs_map_location_link_render($atts, $content = ""){
		
		global $post;
		$defaults = array( 'icon' => 'fa-map-marker', 'link'=>'#map');
		extract( shortcode_atts( $defaults, $atts ) );
		
		$cs_map_location .= '<a href="'.get_permalink().$link.'"><i class="fa '.$icon.'"></i></a>';
		return $cs_map_location;
	}
	add_shortcode('cs_map_location', 'cs_map_location_link_render');
}

//=====================================================================
// get location address
//=====================================================================
if ( ! function_exists( 'cs_location_address_render' ) ) {

	function cs_location_address_render($atts, $content = ""){
		global $post;
		$defaults = array( 'icon' => 'fa-map-marker', 'link'=>'#map');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_location_address = '';
		if(isset($cs_xmlObject->dynamic_post_location_address_icon)){
			$cs_location_address .= '<i class="fa '.$cs_xmlObject->dynamic_post_location_address_icon.'"></i>';
		}
		if(isset($cs_xmlObject->dynamic_post_location_address)){
			$cs_location_address .= $cs_xmlObject->dynamic_post_location_address;
		}
		return $cs_location_address;

	}
	add_shortcode('cs_location_address', 'cs_location_address_render');
}

//=====================================================================
// post hidden
//=====================================================================
if ( ! function_exists( 'cs_hidden_render' ) ) {

	function cs_hidden_render($atts, $content = ""){
		
		global $post,$cs_node;
		$defaults = array( 'name' => '', 'title' => '', 'icon'=>'');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_hidden = '';
		if($icon){
			$cs_hidden .= '<i class="fa '.$icon.'"></i>';
		}
		if($title){
			$cs_hidden .= $title;
		}
		
		if(isset($name)){
			$name = trim($name);
			$cs_hidden .= $cs_xmlObject->$name;
		}
		return $cs_hidden;
	}
	add_shortcode('cs_hidden', 'cs_hidden_render');
}

//=====================================================================
// post dropdown option
//=====================================================================
if ( ! function_exists( 'cs_post_dropdown_render' ) ) {

	function cs_post_dropdown_render($atts, $content = ""){
		
		global $post,$cs_node;
		$defaults = array( 'name' => '', 'title' => '', 'icon'=>'');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_post_dropdown = '';
		if($icon){
			$cs_post_dropdown .= '<i class="fa '.$icon.'"></i>';
		}
		if($title){
			$cs_post_dropdown .= $title;
		}
		if(isset($name)){
			$name = trim($name);
			$cs_post_dropdown .= $cs_xmlObject->$name;
		}
		return $cs_post_dropdown;
	}
	add_shortcode('cs_dropdown', 'cs_post_dropdown_render');
}

//=====================================================================
// buy tickers
//=====================================================================
if ( ! function_exists( 'cs_buytickets_render' ) ) {

	function cs_buytickets_render($atts, $content = ""){
		global $post;
		$defaults = array( 'icon' => 'fa-map-marker', 'title'=>'', 'link'=>'#map');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_location_address = '';
		if(isset($cs_xmlObject->dynamic_post_location_address_icon)){
			$cs_location_address .= '<i class="fa '.$cs_xmlObject->dynamic_post_location_address_icon.'"></i>';
		}
		if(isset($cs_xmlObject->dynamic_post_location_address)){
			$cs_location_address .= $cs_xmlObject->dynamic_post_location_address;
		}
		return $cs_location_address;

	}
	add_shortcode('cs_buytickets', 'cs_buytickets_render');
}

//=====================================================================
// user wishlist
//=====================================================================
if ( ! function_exists( 'cs_wishlist_render' ) ) {
	function cs_wishlist_render($atts, $content = ""){
		global $post;
		$defaults = array( 'icon' => 'fa-plus', 'title'=>'Save');
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		cs_wishlist($icon,$title);
		$post_data = ob_get_clean();
		return $post_data;

	}
	add_shortcode('cs_wishlist', 'cs_wishlist_render');
}

//=====================================================================
// wishlist listing
//=====================================================================
if ( ! function_exists( 'cs_wishlist_listing_render' ) ) {
	function cs_wishlist_listing_render($atts, $content = ""){
		global $post;
		$defaults = array( 'icon' => 'fa-plus', 'title'=>'Save');
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		cs_user_wishlist();
		$post_data = ob_get_clean();
		return $post_data;
	}
	add_shortcode('cs_wishlisting', 'cs_wishlist_listing_render');
}

//=====================================================================
// like counter
//=====================================================================
if ( ! function_exists( 'cs_likecounter_render' ) ) {
	function cs_likecounter_render($atts, $content = ""){
		global $post;
		$defaults = array( 'icon' => 'fa-plus', 'title'=>'Save');
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		cs_likes_counter();
		$post_data = ob_get_clean();
		return $post_data;
	}
	add_shortcode('cs_likecounter', 'cs_likecounter_render');
}
//=====================================================================
// User Rating 
//=====================================================================
if ( ! function_exists( 'cs_user_rating_render' ) ) {
	function cs_user_rating_render($atts, $content = ""){
		global $post;
		$defaults = array( 'icon' => 'fa-plus', 'title'=>'Save');
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		cs_likes_counter();
		$post_data = ob_get_clean();
		return $post_data;
	}
	add_shortcode('cs_user_rating', 'cs_user_rating_render');
}

//=====================================================================
// DCPT names
//=====================================================================
if ( ! function_exists( 'cs_shortcode_dcpt_names' ) ) {
	function cs_shortcode_dcpt_names(){
	global $post;
	$dcpt_elements_array = array();
	$cs_query = new WP_Query(array('post_type' => array('dcpt')));
		while ($cs_query->have_posts()) : $cs_query->the_post();
			$dcpt_elements_array[$post->post_name] = array(
							'title'=>$post->post_title,
							'name'=>'page_element',
							'categories'=>'loops',
					 );
		endwhile;
		wp_reset_postdata();
		wp_reset_query();
		return $dcpt_elements_array;
	}
}

//=====================================================================
// Shortcode Array Start
//=====================================================================
if ( ! function_exists( 'cs_shortcode_names' ) ) {
	function cs_shortcode_names(){
	global $post;
	$dcpt_elements_array = array();


		$shortcode_array = array(
		          'accordion'=>array(
						'title'=>__('Accordion','Awaken'),
						'name'=>'accordion',
						'icon'=>'fa-list-ul',
						'categories'=>'commonelements',
				 ),

				 'blog'=>array(
						'title'=>__('Blog','Awaken'),
						'name'=>'blog',
						'icon'=>'fa-newspaper-o',
						'categories'=>'loops',
				 ),
				 'sermon'=>array(
						'title'=>__('Sermon','Awaken'),
						'name'=>'sermon',
						'icon'=>'fa-newspaper-o',
						'categories'=>'loops',
				 ),
				 'latest_sermon'=>array(						
						'title'=>__('Latest Sermon','Awaken'),
						'name'=>'latest_sermon',
						'icon'=>'fa-newspaper-o',
						'categories'=>'loops',
				 ),
				 'button'=>array(
				 
						'title'=>__('Button','Awaken'),
						'name'=>'button',
						'icon'=>'fa-heart',
						'categories'=>'commonelements',
				 ),
				 'call_to_action'=>array(
						'title'=>__('Call to Action','Awaken'),						
						'name'=>'call_to_action',
						'icon'=>'fa-info-circle',
						'categories'=>'commonelements',
				 ),
				
			
				 'clients'=>array(
						'title'=>__('Clients','Awaken'),
						'name'=>'clients',
						'icon'=>'fa-weixin',
						'categories'=>'loops',
				 ),
				 'contactus'=>array(
					'title'=>__('Form','Awaken'),
					'name'=>'contactus',
					'icon'=>'fa-building-o',
					'categories'=>'contentblocks',
				 ),
				 'counter'=>array(
						'title'=>__('Counter','Awaken'),
						'name'=>'counter',
						'icon'=>'fa-clock-o',
						'categories'=>'commonelements',
				 ),
			 	'contentslider'=>array(
						'title'			=>__('Content Slider','Awaken'),
						'name'			=>'contentslider',
						'icon'			=>'fa-sliders',
						'categories'	=>'loops',
				 ),
				 'divider'=>array(
						'title'=>__('Divider','Awaken'),
						'name'=>'divider',
						'icon'=>'fa-ellipsis-h',
						'categories'=>'typography misc',
				 ),
				  'dropcap'=>array(
						'title'=>__('Dropcap','Awaken'),
						'name'=>'dropcap',
						'icon'=>'fa-bold',
						'categories'=>'typography misc',
				 ),
				 'flex_column'=>array(
						'title'=>__('Column','Awaken'),
						'name'=>'flex_column',
						'icon'=>'fa-columns',
						'categories'=>'typography misc',
				 ),
				 'heading'=>array(
						'title'=>__('Heading','Awaken'),
						'name'=>'heading',
						'icon'=>'fa-h-square',
						'categories'=>'typography misc',
				 ),
				 'highlight'=>array(
						'title'=>__('Highlight','Awaken'),
						'name'=>'highlight',
						'icon'=>'fa-pencil',
						'categories'=>'typography misc',
				 ),
				 'icons'=>array(
						'title'=>__('Icons','Awaken'),
						'name'=>'icons',
						'icon'=>'fa-empire',
						'categories'=>' contentblocks',
				 ),
				 'infobox'=>array(
						'title'=>__('Info box','Awaken'),
						'name'=>'infobox',
						'icon'=>'fa-info-circle',
						'categories'=>' contentblocks',
				 ),
				 'image'=>array(
						'title'=>__('Image Frame','Awaken'),
						'name'=>'image',
						'icon'=>'fa-picture-o',
						'categories'=>'mediaelement',
				 ),
				 'list'=>array(
						'title'=>__('List','Awaken'),
						'name'=>'list',
						'icon'=>'fa-list-ol',
						'categories'=>'typography misc	',
				 ),
				 'map'=>array(
						'title'=>__('Map','Awaken'),
						'name'=>'map',
						'icon'=>'fa-globe',
						'categories'=>'contentblocks',
				 ),
				 'mesage'=>array(
						'title'=>__('Message','Awaken'),
						'name'=>'mesage',
						'icon'=>'fa-envelope',
						'categories'=>'typography misc	',
				 ),
				
				 'offerslider'=>array(
						'title'=>__('Offer slider','Awaken'),
						'name'=>'offerslider',
						'icon'=>' fa-trophy',
						'categories'=>' contentblocks',
				 ),
				 'progressbars'=>array(
						'title'=>'Progressbars',
						'name'=>'progressbars',
						'icon'=>'fa-list-alt',
						'categories'=>' commonelements',
				 ),
				 'piecharts'=>array(
						'title'=>__('Piecharts','Awaken'),
						'name'=>'piecharts',
						'icon'=>'fa-tachometer',
						'categories'=>'commonelements',
				 ),
				 'promobox'=>array(
						'title'=>__('Promobox','Awaken'),
						'name'=>'promobox',
						'icon'=>'fa-life-ring',
						'categories'=>' mediaelement',
				 ),
				 'pricetable'=>array(
						'title'=>__('Pricetable','Awaken'),
						'name'=>'pricetable',
						'icon'=>'fa-table',
						'categories'=>'commonelements',
				 ),
				  'quote'=>array(
						'title'=>__('Quote','Awaken'),
						'name'=>'quote',
						'icon'=>'fa-quote-right',
						'categories'=>'typography misc',
				 ),
				 'register'=>array(
						'title'=>__('Register','Awaken'),
						'name'=>'register',
						'icon'=>'fa-external-link',
						'categories'=>'commonelements',
				 ),
				  'slider'=>array(
						'title'=>__('Slider','Awaken'),
						'name'=>'slider',
						'icon'=>'fa-picture-o',
						'categories'=>'loops',
				 ),
				  'services'=>array(
						'title'=>__('Services','Awaken'),
						'name'=>'services',
						'icon'=>'fa-check-square-o',
						'categories'=>' commonelements',
				 ),
				'teams'=>array(
						'title'=>__('Team','Awaken'),
						'name'=>'teams',
						'icon'=>'fa-user',
						'categories'=>'loops misc',
				 ),
				 'tooltip'=>array(
						'title'=>__('Tooltip','Awaken'),
						'name'=>'tooltip',
						'icon'=>'fa-comment-o',
						'categories'=>'typography misc',
				 ),
				/* 'contact'=>array(
						'title'=>'Form',
						'name'=>'contact',
						'categories'=>'typography contentblocks loops',
				 ),
				 'parallax'=>array(
						'title'=>'Parallax',
						'name'=>'parallax',
						'categories'=>'commonelements',
				 ),*/
				 'tabs'=>array(
						'title'=>__('Tabs','Awaken'),
						'name'=>'tabs',
						'icon'=>'fa-list-alt',
						'categories'=>'commonelements',
				 ),
				 'toggle'=>array(
						'title'=>__('Toggle','Awaken'),
						'name'=>'toggle',
						'icon'=>'fa-life-ring',
						'categories'=>'commonelements',
				 ),
				  'testimonials'=>array(
						'title'=>__('Testimonials','Awaken'),
						'name'=>'testimonials',
						'icon'=>'fa-comments-o',
						'categories'=>'typography misc',
				 ),
				 'table'=>array(
						'title'=>__('Table','Awaken'),
						'name'=>'table',
						'icon'=>'fa-th',
						'categories'=>'commonelements',
				 ),
				 'tweets'=>array(
						'title'=>__('Tweets','Awaken'),
						'name'=>'tweets',
						'icon'=>'fa-twitter',
						'categories'=>'loops',
				 ),
				 'video'=>array(
						'title'=>__('Video','Awaken'),
						'name'=>'video',
						'icon'=>'fa-play-circle',
						'categories'=>'mediaelement',
				 ),
				 'spacer'=>array(
						'title'=>__('Spacer','Awaken'),
						'name'=>'spacer',
						'icon'=>'fa-arrows-v',
						'categories'=>'commonelements',
				 ), 
				 'faq'=>array(
						'title'=>__('FAQ','Awaken'),
						'name'=>'faq',
						'icon'=>'fa-question-circle',
						'categories'=>'typography',
				 ),
				 
				 'project'=>array(
						'title'=>__('Project','Awaken'),
						'name'=>'project',
						'icon'=>'fa-briefcase',
						'categories'=>'loops',
				 ),
				 'events'=>array(
						'title'=>__('Events','Awaken'),
						'name'=>'events',
						'icon'=>'fa-question-circle',
						'categories'=>'loops misc',
				 ),
				 
				
				
		);
		 if ( function_exists( 'cs_pb_cause' ) ) {
			 $shortcode_array['cause'] = array(
											'title'=>__('cause','Awaken'),
											'name'=>'cause',
											'icon'=>'fa-question-circle',
											'categories'=>'loops misc',
									 );
			 $shortcode_array['latest_cause'] = array(												
												'title'=>__('Latest Cause','Awaken'),
												'name'=>'latest_cause',
												'icon'=>'fa-question-circle',
												'categories'=>'loops misc',
										 );
		 }

		
		ksort($shortcode_array);
		return $shortcode_array;
	}
}

//=====================================================================
// Shortcode Buttons
//=====================================================================
add_action('media_buttons','cs_shortcode_popup',11);
// 
if ( ! function_exists( 'cs_shortcode_popup' ) ) {
	function cs_shortcode_popup($die = 0, $shortcode='shortcode'){
		$i = 1;
		$style='';
		if ( isset($_POST['action']) ) {
			$name = $_POST['action'];
			$cs_counter = $_POST['counter'];
			$randomno = cs_generate_random_string('5');
			$rand = rand(1,999);
			$style='';
		} else {
			$name = '';
			$cs_counter = '';
			$rand = rand(1,999);
			$randomno = cs_generate_random_string('5');
			if(isset($_REQUEST['action']))
				$name = $_REQUEST['action'];
			$style='style="display:none;"';
		}
		$cs_page_elements_name = array();
		$cs_page_elements_name = cs_shortcode_names();
 
 		$cs_page_categories_name =  cs_elements_categories();
		
	?> 
		<div class="cs-page-composer  <?php echo sanitize_html_class($shortcode);?> composer-<?php echo intval($rand) ?>" id="composer-<?php echo intval($rand) ?>" style="display:none">
			<div class="page-elements">
			<div class="cs-heading-area">
				 <h5>
					<i class="fa fa-plus-circle"></i> Add Element
				</h5>
				<span class='cs-btnclose' onclick='javascript:removeoverlay("composer-<?php echo esc_js($rand) ?>","append")'><i class="fa fa-times"></i></span>
			</div>
			<script>
				jQuery(document).ready(function($){
					cs_page_composer_filterable('<?php echo esc_js($rand)?>');
				});
			</script>
		 <div class="cs-filter-content shortcode">
			<p><input type="text" id="quicksearch<?php echo intval($rand) ?>" placeholder="Search" /></p>
			  <div class="cs-filtermenu-wrap">
				<h6>Filter by</h6>
				<ul class="cs-filter-menu" id="filters<?php echo intval($rand) ?>">
				  <li data-filter="all" class="active">Show all</li>
                  <?php foreach($cs_page_categories_name as $key=>$value){
				  		echo '<li data-filter="'.$key.'">'.$value.'</li>';
					}?>
				</ul>
			  </div>
				<div class="cs-filter-inner" id="page_element_container<?php echo intval($rand) ?>">
                	<?php foreach($cs_page_elements_name as $key=>$value){
                    		echo '<div class="element-item '.$value['categories'].'">';
                              $icon = isset($value['icon']) ? $value['icon'] : 'accordion-icon'; ?>
                              <a href='javascript:cs_shortocde_selection("<?php echo esc_js($key);?>","<?php echo admin_url('admin-ajax.php');?>","composer-<?php echo intval($rand) ?>")'><?php cs_page_composer_elements($value['title'], $icon)?></a>
                          </div>
                    <?php }?>
				</div>
			  </div>
			</div>
			<div class="cs-page-composer-shortcode"></div>
		</div>
	   <?php 
		if(isset($shortcode) && $shortcode <> ''){
			?>
			<a class="button" href="javascript:_createpop('composer-<?php echo esc_js($rand) ?>', 'filter')"><i class="fa fa-plus-circle"></i> CS: Insert shortcode</a>
			<?php
		}
	}
}

//=====================================================================
// Column Size Dropdown Function Start
//=====================================================================
if ( ! function_exists( 'cs_shortcode_element_size' ) ) {
	function cs_shortcode_element_size($column_size =''){
		?>
			<ul class="form-elements">
                <li class="to-label"><label>Size</label></li>
                <li class="to-field select-style">
                    <select class="column_size" id="column_size" name="column_size[]">
                        <option value="1/1" <?php if($column_size == '1/1'){echo 'selected="selected"';}?>>Full width</option>
                        <option value="1/2" <?php if($column_size == '1/2'){echo 'selected="selected"';}?>>One half</option>
                        <option value="1/3" <?php if($column_size == '1/3'){echo 'selected="selected"';}?>>One third</option
                        ><option value="2/3" <?php if($column_size == '2/3'){echo 'selected="selected"';}?>>Two third</option>
                        <option value="1/4" <?php if($column_size == '1/4'){echo 'selected="selected"';}?>>One fourth</option>
                        <option value="3/4" <?php if($column_size == '3/4'){echo 'selected="selected"';}?>>Three fourth</option>
                    </select>
                    <p>Select column width. This width will be calculated depend page width</p>
                </li>                  
            </ul>
		<?php
	}
}
// Column Size Dropdown Function end

//=====================================================================
// Animation Styles
//=====================================================================
function cs_animation_style(){
	return $animation_style = array(
						'Entrances'=>array('slideDown'=>'slideDown','slideUp'=>'slideUp','slideLeft'=>'slideLeft','slideRight'=>'slideRight','slideExpandUp'=>'slideExpandUp','expandUp'=>'expandUp','expandOpen'=>'expandOpen','bigEntrance'=>'bigEntrance','hatch'=>'hatch'),
						'Misc'=>array('floating'=>'floating','tossing'=>'tossing','pullUp'=>'pullUp','pullDown'=>'pullDown','stretchLeft'=>'stretchLeft','stretchRight'=>'stretchRight'),
						'Attention Seekers'=>array('bounce'=>'bounce','flash'=>'flash','pulse'=>'pulse','rubberBand'=>'rubberBand','shake'=>'shake','swing'=>'swing','tada'=>'tada','wobble'=>'wobble'),
						'Bouncing Entrances'=>array('bounceIn'=>'bounceIn','bounceInDown'=>'bounceInDown','bounceInLeft'=>'bounceInLeft','bounceInRight'=>'bounceInRight','bounceInUp'=>'bounceInUp'),
                 		'Fading Entrances'=>array('fadeIn'=>'fadeIn','fadeInDown'=>'fadeInDown','fadeInDownBig'=>'fadeInDownBig','fadeInLeft'=>'fadeInLeft','fadeInLeftBig'=>'fadeInRight','fadeInRightBig'=>'fadeInRightBig','fadeInUp'=>'fadeInUp','fadeInUpBig'=>'fadeInUpBig'),
						'Flippers'=>array('flip'=>'flip','flipInX'=>'flipInX','flipInY'=>'flipInY'),
						'Lightspeed'=>array('lightSpeedIn'=>'lightSpeedIn'),
						 'Rotating Entrances'=>array('rotateIn'=>'rotateIn','rotateInDownLeft'=>'rotateInDownLeft','rotateInDownRight'=>'rotateInDownRight','rotateInUpLeft'=>'rotateInUpLeft','rotateInUpRight'=>'rotateInUpRight'),
						'Specials'=>array('hinge'=>'hinge','rollIn'=>'rollIn'),
						'Zoom Entrances'=>array('zoomIn'=>'zoomIn','zoomInDown'=>'zoomInDown','zoomInLeft'=>'zoomInLeft','zoomInRight'=>'zoomInRight','zoomInUp'=>'zoomInUp'),
						);	
}

//=====================================================================
// Custom Class and Animations Function Start
//=====================================================================
if ( ! function_exists( 'cs_shortcode_custom_classes' ) ) {
	function cs_shortcode_custom_classes($cs_custom_class = '',$cs_custom_animation='',$cs_custom_animation_duration='1'){
		?>
        	<ul class="form-elements">
                <li class="to-label"><label>Custom ID</label></li>
                <li class="to-field">
                    <input type="text" name="cs_custom_class[]" class="txtfield"  value="<?php echo sanitize_text_field($cs_custom_class); ?>" />
                    <p>Use this option if you want to use specified Class for this element	</p>
                </li>
            </ul>
            <?php $custom_animation_array = array('fade'=>'Fade','slide'=>'Slide','left-slide'=>'left Slide');?>
            
            <ul class="form-elements">
                <li class="to-label"><label>Animation Class <?php echo sanitize_text_field($cs_custom_animation);?></label></li>
                <li class="to-field select-style">
                	<select class="dropdown" name="cs_custom_animation[]">
                    	<option value="">Animation Class</option>
                        <?php 
								$animation_array = cs_animation_style();
								foreach($animation_array as $animation_key=>$animation_value){
									echo '<optgroup label="'.$animation_key.'">';	
									foreach($animation_value as $key=>$value){
										$active_class = '';
										if($cs_custom_animation == $key){$active_class = 'selected="selected"';}
										echo '<option value="'.$key.'" '.$active_class.'>'.$value.'</option>';
									}
								}
						?>
                      </select>
                      <p>Select Entrance animation type from the dropdown </p>
                </li>
            </ul>
        <?php
	}
}
// Custom Class and Animations Function end

//=====================================================================
// Dynamic Custom Class and Animations Function Start
//=====================================================================
if ( ! function_exists( 'cs_shortcode_custom_dynamic_classes' ) ) {
	function cs_shortcode_custom_dynamic_classes($cs_custom_class = '',$cs_custom_animation='',$cs_custom_animation_duration='1',$prefix){
		?>
        	<ul class="form-elements">
                <li class="to-label"><label>Custom ID</label></li>
                <li class="to-field">
                    <input type="text" name="<?php echo sanitize_text_field($prefix);?>_class[]" class="txtfield"  value="<?php echo sanitize_text_field($cs_custom_class)?>" />
                    <p>Use this option if you want to use specified id for this element</p>
                </li>
            </ul>
            <?php $custom_animation_array = array('fade'=>'Fade','slide'=>'Slide','left-slide'=>'left Slide');?>
            <ul class="form-elements">
                <li class="to-label"><label>Animation Class <?php echo sanitize_text_field($cs_custom_animation);?></label></li>
                <li class="to-field select-style">
                	<select class="dropdown" name="<?php echo sanitize_text_field($prefix);?>_animation[]">
                    	<option value="">Select Animation</option>
                        <?php 
								$animation_array = cs_animation_style();
								foreach($animation_array as $animation_key=>$animation_value){
									echo '<optgroup label="'.$animation_key.'">';	
									foreach($animation_value as $key=>$value){
										$active_class = '';
										if($cs_custom_animation == $key){$active_class = 'selected="selected"';}
										echo '<option value="'.$key.'" '.$active_class.'>'.$value.'</option>';
									}
								}
						
						?>
                      </select>
                      <p>Select Entrance animation type from the dropdown</p>
                </li>
            </ul>  
        <?php
	}
}
// Dynamic Custom Class and Animations Function end

//=====================================================================
// Event Shortcode
//=====================================================================
if ( ! function_exists( 'cs_event_listing' ) ) {
	function cs_event_listing($atts, $content = ""){
		global $post,$cs_node,$cs_theme_option,$cs_dcpt_post_time,$cs_dcpt_post_excerpt,$cs_dcpt_post_view,$cs_dcpt_post_category;
		date_default_timezone_set('UTC');
		$current_time = strtotime(current_time('m/d/Y H:i', $gmt = 0));
		$defaults = array( 'column_size' => '1/1', 'cs_dcpt_section_title' => '', 'cs_dcpt_listing_type'=>'All Events','cs_dcpt_post_category' => '', 'cs_dcpt_post_view' => 'event-listing', 'cs_dcpt_post_excerpt' => '255', 'cs_dcpt_post_time' => 'Yes', 'cs_dcpt_post_filterable' => '', 'cs_dcpt_post_pagination' => '', 'cs_dcpt_post_per_page' => '-1', 'cs_page_element_class' => '', 'cs_page_element_animation' => '', 'cs_custom_animation_duration' => '1', );
		extract( shortcode_atts( $defaults, $atts ) );
		$coloumn_class = cs_custom_column_class($column_size);
		
		if ( trim($cs_page_element_animation) !='' ) {
			$cs_custom_animation	= 'wow'.' '.$cs_page_element_animation;
		} else {
			$cs_custom_animation	= '';
		}
		
		ob_start();
		$section_div_start = '';
		$section_div_end = '';
		$eliteClass = '';
		$organizer_filter = '';
		$user_meta_key				= '';
		$user_meta_value			= '';
		$meta_value = $current_time;
		$meta_key	  = 'cs_dynamic_event_from_date_time';
		
		//==Filters
		$filter_category = '';
		$filter_tag = '';
       	
		if ( isset($_GET['filter_category']) && $_GET['filter_category'] <> '' && $_GET['filter_category'] <> '0' ) { $filter_category = $_GET['filter_category'];
		}else if(isset($cs_dcpt_post_category) && $cs_dcpt_post_category <> '' && $cs_dcpt_post_category <> '0'){
			$filter_category = $cs_dcpt_post_category;
		}
		//==Filters End
		
		if ( $cs_dcpt_listing_type == "Upcoming Events" ) $meta_compare = ">=";
        else if ( $cs_dcpt_listing_type == "Past Events" ) $meta_compare = "<";
		$cs_counter_events = 0;
		
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
			
		if ( empty($_GET['page_id_all']) ) $_GET['page_id_all'] = 1;

		if ( isset($_GET['organizer']) && $_GET['organizer'] <> '' ) {
			$meta_key				= 'event_organizer';
			$meta_value				= $_GET['organizer'];
			$meta_compare			= "LIKE";
			$organizer_filter		= $_GET['organizer'];
		}		
		    
		if ( $cs_dcpt_listing_type == "All Events" ) {
			$args = array(
				'posts_per_page'			=> "-1",
				'post_type'					=> 'cs-events',
				'post_status'				=> 'publish',
				'orderby'					=> $orderby,
				'order'						=> $order,
			);
			
            } else {
                $args = array(
                    'posts_per_page'			=> "-1",
                    'post_type'					=> 'cs-events',
                    'post_status'				=> 'publish',
                    'meta_key'					=> $meta_key,
                    'meta_value'				=> $meta_value,
                    'meta_compare'				=> $meta_compare,
                    'orderby'					=> $orderby,
                    'order'						=> $order,
                );
            }
			
			if ( isset($_GET['filter_category']) && $_GET['filter_category'] <> '' && $_GET['filter_category'] <> '0' ) 
			{ 
				$event_category_array = array('events-categories' => $_GET['filter_category']);
				$args = array_merge($args, $event_category_array);
			
			} else if(isset($cs_dcpt_post_category) && $cs_dcpt_post_category <> '' && $cs_dcpt_post_category <> '0'){
				$event_category_array = array('events-categories' => "$cs_dcpt_post_category");
				$args = array_merge($args, $event_category_array);
			}
			
			
			
            $custom_query = new WP_Query($args);
            $count_post = 0;
			$counter = 1;
			$count_post = $custom_query->post_count;
			
			if ( $cs_dcpt_listing_type == "Upcoming Events") {
				
				$args = array(
					'posts_per_page'			=> "$cs_dcpt_post_per_page",
					'paged'						=> $_GET['page_id_all'],
					'post_type'					=> 'cs-events',
					'post_status'				=> 'publish',
					'meta_key'					=> $meta_key,
					'meta_value'				=> $meta_value,
                    'meta_compare'				=> $meta_compare,
					'orderby'					=> $orderby,
					'order'						=> $order,
				 );
			}else if ( $cs_dcpt_listing_type == "All Events" ) {
				if ( isset($_GET['organizer']) && $_GET['organizer'] <> '' ) {
						$args = array(
							'posts_per_page'			=> "$cs_dcpt_post_per_page",
							'paged'						=> $_GET['page_id_all'],
							'post_type'					=> 'cs-events',
							'post_status'				=> 'publish',
							'meta_key'					=> $meta_key,
							'meta_value'				=> $meta_value,
							'meta_compare'				=> $meta_compare,
							'meta_query' 				=> array(
																array(
																	'key' => "$meta_key",
																	'value' => "$meta_value",
																	'compare' => "$meta_compare"
																)
															),
							'orderby'					=> $orderby,
							'order'						=> $order,
						 );
						
				} else {
					$args = array(
						'posts_per_page'			=> "$cs_dcpt_post_per_page",
						'paged'						=> $_GET['page_id_all'],
						'post_type'					=> 'cs-events',
						'meta_key'					=> $meta_key,
						'meta_value'				=> '',
						'post_status'				=> 'publish',
						'orderby'					=> $orderby,
						'order'						=> $order,
					);
				}
				
			}
			else {
				$args = array(
                    'posts_per_page'			=> "$cs_dcpt_post_per_page",
					'paged'						=> $_GET['page_id_all'],
                    'post_type'					=> 'cs-events',
                    'post_status'				=> 'publish',
                    'meta_key'					=> $meta_key,
                    'meta_value'				=> $meta_value,
                    'meta_compare'				=> $meta_compare,
                    'orderby'					=> $orderby,
                    'order'						=> $order,
                );
			}
		
		
		
		if ( isset($_GET['filter_category']) && $_GET['filter_category'] <> '' && $_GET['filter_category'] <> '0' ) 
		{ 
			$event_category_array = array('events-categories' => "$cs_dcpt_post_category");
			$args = array_merge($args, $event_category_array);
		
		} else if(isset($cs_dcpt_post_category) && $cs_dcpt_post_category <> '' && $cs_dcpt_post_category <> '0'){
			$event_category_array = array('events-categories' => "$cs_dcpt_post_category");
			$args = array_merge($args, $event_category_array);
		}
		
		if(isset($filter_category) && $filter_category <> '' && $filter_category <> '0'){
				
				if ( isset($_GET['filter-tag']) ) {$filter_tag = $_GET['filter-tag'];}
				if($filter_tag <> ''){
					$event_category_array = array('events-categories' => "$filter_category",'events-tags' => "$filter_tag");
				}else{
					$event_category_array = array('events-categories' => "$filter_category");
				}
				$args = array_merge($args, $event_category_array);
			}
			
		if ( isset($_GET['filter-tag']) && $_GET['filter-tag'] <> '' && $_GET['filter-tag'] <> '0' ) {
			$filter_tag = $_GET['filter-tag'];
			if($filter_tag <> ''){
				$event_category_array = array('events-categories' => "$filter_category",'events-tags' => "$filter_tag");
				$args = array_merge($args, $event_category_array);
			}
		}
		if ( isset($_GET['organizer']) && $_GET['organizer'] <> '' ) {
			$user_meta_key				= '';
			$user_meta_value			= '';
		}
		$user_args = array(
                    'posts_per_page'			=> "",
					'paged'						=> "",
					'meta_key'					=> $user_meta_key,
                    'meta_value'				=> $user_meta_value,
                );	
		$user_args = array_merge($args, $user_args);
		
		$custom_query = new WP_Query($args);
		$user_query = new WP_Query($user_args);
		$userArray	= array(); 
		while ( $user_query->have_posts() ) { $user_query->the_post();
			$user_ids = get_post_meta($post->ID, "event_organizer", true);
			$user_ids = explode(',',$user_ids);
			if(is_array($user_ids)){
				foreach($user_ids as $user_id){
					
					$userArray[] = $user_id;
				}
			}
		}
		wp_reset_postdata();
		$count_post = $custom_query->post_count;
		cs_get_event_filters($cs_dcpt_post_category,$cs_dcpt_post_filterable,$filter_category,$filter_tag,$userArray,$organizer_filter,$cs_custom_animation);
		if ( $custom_query->have_posts() <> "" ) {
			$event_view_class = '';
		if($cs_dcpt_post_view == 'default'){
			$eventClass	= 'cs-ev-default';
		} else if($cs_dcpt_post_view == 'plain'){
			$eventClass	= 'cs-ev-plain';
		}else if($cs_dcpt_post_view == 'listing'){
			$eventClass	= 'cs-ev-listing';
		}else if($cs_dcpt_post_view == 'modren'){
			$eventClass	= 'cs-ev-modren';
		}else if($cs_dcpt_post_view == 'elite'){
			$eventClass	= 'cs-ev-elite';
		}else if($cs_dcpt_post_view == 'clean'){
			$eventClass	= 'cs-ev-clean';
		}else if($cs_dcpt_post_view == 'timeline'){
			$eventClass	= 'cs-ev-timeline';
		} else if($cs_dcpt_post_view == 'grid'){
			$eventClass	= 'cs-ev-grid';
			$coloumn_class	= 'col-md-4';
		} else{
			$eventClass	= 'cs-ev-default';
		}
		?>
               <?php  if(isset($cs_dcpt_section_title) && $cs_dcpt_section_title <> ''){
                            
							if ($coloumn_class == 'col-md-4') {
								$sectionClass	=	'col-md-12'; 
							} else {
								$sectionClass	=	$coloumn_class; 
							}
							echo '<div class="'.$sectionClass.'"><div class="cs-section-title">
									<h2>'.$cs_dcpt_section_title.'</h2>
								  </div></div>';
                  }
				  
				 $count_post = $custom_query->post_count;
				 $counter_posts = 0;
				 while ( $custom_query->have_posts() ): $custom_query->the_post();
				 		
						$counter_posts++;
						global $dynamic_post_event_from_date,$cs_event_meta;
						$dynamic_post_event_from_date = get_post_meta($post->ID, "dynamic_post_event_from_date", true);
						$cs_event_meta = get_post_meta($post->ID, "dynamic_cusotm_post", true);
						if ( $cs_event_meta <> "" ) {
							$cs_event_meta = new SimpleXMLElement($cs_event_meta);
						}
						
					?>
                    <div class="<?php echo sanitize_html_class($coloumn_class);?>">
                    	<?php
                    		echo '<article class="event-list '.$event_view_class.' '.$eventClass.'">'; 
 									if( $cs_dcpt_post_view == 'default' ){
										get_template_part('cs-templates/events-styles/listing','default');
									} else if( $cs_dcpt_post_view == 'plain' ){
										get_template_part('cs-templates/events-styles/listing','plain');
									}else if( $cs_dcpt_post_view == 'listing'){
										get_template_part('cs-templates/events-styles/listing','list');
									}else if( $cs_dcpt_post_view == 'modren' ){
										get_template_part('cs-templates/events-styles/listing','modren');
									}else if( $cs_dcpt_post_view == 'elite' ){
										get_template_part('cs-templates/events-styles/listing','elite');
									}else if( $cs_dcpt_post_view == 'clean' ){
										get_template_part('cs-templates/events-styles/listing','clean');
									}else if( $cs_dcpt_post_view == 'timeline' ){
										get_template_part('cs-templates/events-styles/listing','timeline');
									} else if( $cs_dcpt_post_view == 'grid' ){
										get_template_part('cs-templates/events-styles/listing','grid');
									} else{
										get_template_part('cs-templates/events-styles/listing','default');
									}
							 ?>
                        </article>
                    </div>
                 <?php
				   // Divider	 
				   //if ( ( $cs_dcpt_post_view == 'default' || $cs_dcpt_post_view == 'plain' || $cs_dcpt_post_view == 'elite' ) && $counter_posts < $count_post ) {
						//echo '<div class="col-md-12"><span class="divider1 ev-divider"></span></div>';
				   //}
				 endwhile;
		 $qrystr = '';
          if ( $cs_dcpt_post_pagination == "Show Pagination" and $count_post > $cs_dcpt_post_per_page and $cs_dcpt_post_per_page > 0) {
				if ( isset($_GET['page_id']) ) { $qrystr .= "&page_id=".$_GET['page_id'];}
				echo cs_pagination($count_post, $cs_dcpt_post_per_page,$qrystr);
         }
		} else {
		?> 
			<div class="col-md-12"><?php echo _e('No Event Found','Awaken');?></div>
		<?php 
		}
		$eventpost_data = ob_get_clean();
		return $eventpost_data;
	}
	add_shortcode('cs_cs-events', 'cs_event_listing');
}

//=====================================================================
// Members Listing Shortcode Function
//=====================================================================
if ( ! function_exists( 'cs_members_listing' ) ) {
	function cs_members_listing($atts, $content = ""){
		global $post,$cs_node;
		$defaults = array( 'column_size' => '1/1', 'var_pb_members_title' => '', 'var_pb_members_roles'=>'','var_pb_members_profile_inks' => '', 'var_pb_members_pagination' => 'single', 'var_pb_members_per_page' => '-1', 'cs_custom_class' => '', 'cs_custom_animation' => '', 'cs_custom_animation_duration' => '1', );
		extract( shortcode_atts( $defaults, $atts ) );
		$coloumn_class = cs_custom_column_class($column_size);
		ob_start();
		 $qrystr = '';
          if ( $cs_dcpt_post_pagination == "Show Pagination" and $count_post > $cs_dcpt_post_per_page and $cs_dcpt_post_per_page > 0) {
				if ( isset($_GET['page_id']) ) $qrystr = "&page_id=".$_GET['page_id'];
					echo cs_pagination($count_post, $cs_dcpt_post_per_page,$qrystr);
        }
		$memberspost_data = ob_get_clean();
		return $memberspost_data;
	}
	add_shortcode('cs_memberssss', 'cs_members_listing');
}

//=====================================================================
// Shortcode Add box Ajax Function
//=====================================================================
if ( ! function_exists( 'cs_shortcode_element_ajax_call' ) ) {
	function cs_shortcode_element_ajax_call(){?>
	<?php 	
		if(isset($_POST['shortcode_element']) && $_POST['shortcode_element']){
			if($_POST['shortcode_element'] == 'services'){
				$rand_id = rand(8,7777);
				?>
				<div class='cs-wrapp-clone cs-shortcode-wrapp'  id="cs_infobox_<?php echo intval( $rand_id);?>">
					<header><h4><i class='fa fa-arrows'></i>Service</h4> <a href='#' class='deleteit_node'><i class='fa fa-minus-circle'></i>Remove</a></header>
                    
                    <?php if ( function_exists( 'cs_shortcode_element_size' ) ) {cs_shortcode_element_size();}?>
					<ul class='form-elements'>
						<li class='to-label'><label>Service Title:</label></li>
						<li class='to-field'> <div class='input-sec'><input class='txtfield' type='text' name='service_title[]' /></div>
						<div class='left-info'><p>Title of the Service.</p></div>
						</li>
					</ul>
					<ul class='form-elements'>
						<li class='to-label'><label>Service View:</label></li>
						<li class='to-field select-style'> <div class='input-sec'><select name='service_type[]' class='dropdown'>
                        <option value='size_large'>Large Boxed</option>
                        <option value='size_large_normal'>Large Normal</option>
                        <option value='size_circle'>Circle</option>
                        <option  value="size_medium" >Medium</option>
                        <option value='size_small'>Small</option>
                        </select></div>
						<div class='left-info'><p>Type of the Service.</p></div>
						</li>
					</ul>
					 <ul class='form-elements' id="<?php echo intval( $rand_id);?>">
							<li class='to-label'><label>Fontawsome Icon:</label></li>
							<li class="to-field">
								<input type="hidden" class="cs-search-icon-hidden" name="cs_service_icon[]">
								<?php cs_fontawsome_icons_box('',$rand_id);?>
							</li>
					</ul>
                    <ul class="form-elements">
                        <li class="to-label"><label>Icon Postion</label></li>
                        <li class="to-field select-style">
                            <select class="service_icon_postion" name="service_icon_postion[]">
                                <option value="left">left</option>
                                <option value="right">Right</option>
                                <option value="top">Top</option>
                                <option value="center">Center</option>
                            </select>
                        </li>                  
                    </ul>
                    <ul class="form-elements">
                        <li class="to-label"><label>Icon Type</label></li>
                        <li class="to-field select-style">
                            <select class="service_icon_type" name="service_icon_type[]">
                                <option value="circle">Circle</option>
                                <option value="square">Square</option>
                            </select>
                        </li>                  
                    </ul>
                    <ul class="form-elements">
                          <li class="to-label">
                            <label>Service Bg Image</label>
                          </li>
                          <li class="to-field">
                            <input id="service_bg_image<?php echo intval( $rand_id);?>" name="service_bg_image[]" type="hidden" class="" value=""/>
                            <input name="service_bg_image<?php echo intval( $rand_id);?>"  type="button" class="uploadMedia left" value="Browse"/>
                          </li>
                        </ul>
                        <div class="page-wrap" style="overflow:hidden; display:none;?>" id="service_bg_image<?php echo intval( $rand_id);?>_box" >
                          <div class="gal-active">
                            <div class="dragareamain" style="padding-bottom:0px;">
                              <ul id="gal-sortable">
                                <li class="ui-state-default" id="">
                                  <div class="thumb-secs"> <img src="<?php echo esc_url($service_bg_image);?>"  id="service_bg_image<?php echo intval( $rand_id);?>_img" width="100" height="150"  />
                                    <div class="gal-edit-opts"> <a   href="javascript:del_media('service_bg_image<?php echo intval( $rand_id);?>')" class="delete"></a> </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
					<ul class='form-elements'>
						<li class='to-label'><label>Service Link URL:</label></li>
						<li class='to-field'> <div class='input-sec'><input class='txtfield' type='text' name='service_link_url[]' /></div>
						<div class='left-info'><p>Service Link Url</p></div>
						</li>
					</ul>
                    <ul class="form-elements">
                        <li class="to-label"><label>Border</label></li>
                        <li class="to-field select-style">
                            <select class="service_border" id="service_border" name="service_border[]">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </li>                  
                    </ul>
					<ul class='form-elements'>
						<li class='to-label'><label>Service Text:</label></li>
						<li class='to-field'> <div class='input-sec'><textarea class='txtfield' data-content-text="cs-shortcode-textarea" name='service_text[]'></textarea></div>
						</li>
					</ul>
                    <ul class="form-elements">
                        <li class="to-label"><label>Divider</label></li>
                        <li class="to-field select-style">
                            <select class="service_divider" name="service_divider[]">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </li>                  
                    </ul>
                    <ul class="form-elements">
                        <li class="to-label"><label>Icon Color</label></li>
                        <li class="to-field">
                            <input type="text" name="service_icon_color[]" class="bg_color"  value="" />
                        </li>
                    </ul>
                    <ul class="form-elements">
                        <li class="to-label"><label>Icon Background Color</label></li>
                        <li class="to-field">
                            <input type="text" name="service_icon_bg_color[]" class="bg_color"  value="" />
                        </li>
                    </ul>
                  	 <ul class="form-elements">
                        <li class="to-label"><label>Custom ID</label></li>
                        <li class="to-field">
                            <input type="text" name="service_class[]" class="txtfield"  value="" />
                        </li>
                     </ul>
                    <ul class="form-elements">
                        <li class="to-label"><label>Animation Class </label></li>
                        <li class="to-field select-style">
                            <select class="dropdown" name="service_animation[]">
                                <option value="">Select Animation</option>
                                <?php 
                                    $animation_array = cs_animation_style();
                                    foreach($animation_array as $animation_key=>$animation_value){
                                        echo '<optgroup label="'.$animation_key.'">';	
                                        foreach($animation_value as $key=>$value){
                                            echo '<option value="'.$key.'" >'.$value.'</option>';
                                        }
                                    }
                                
                                 ?>
                              </select>
                        </li>
                    </ul>
				</div>
				<?php     
			} 
			else if($_POST['shortcode_element'] == 'accordions'){
				 $rand_id = rand(5,999);
				?>
                	<div class='cs-wrapp-clone cs-shortcode-wrapp'  id="cs_infobox_<?php echo intval( $rand_id);?>">
                        <header><h4><i class='fa fa-arrows'></i>Accordion</h4> <a href='#' class='deleteit_node'><i class='fa fa-minus-circle'></i>Remove</a></header>
                        <ul class='form-elements'>
                            <li class='to-label'><label>Active</label></li>
                            <li class='to-field select-style'> <select name='accordion_active[]'><option value="no">No</option><option value="yes">Yes</option></select>
                            <div class='left-info'>
                              <p>You can set the section that is active here by select dropdown</p>
                            </div>
                            </li>
                        </ul>
                        <ul class='form-elements'>
                            <li class='to-label'><label>Accordion Title:</label></li>
                            <li class='to-field'> <div class='input-sec'><input class='txtfield' type='text' name='accordion_title[]' /></div>
                            <div class='left-info'>
                              <p>Enter accordion title</p>
                            </div>
                            </li>
                        </ul>
                        <ul class='form-elements' id="<?php echo intval($rand_id);?>">
							<li class='to-label'><label>Fontawsome Icon:</label></li>
							<li class="to-field">
                                    <input type="hidden" class="cs-search-icon-hidden" name="cs_accordian_icon[]">
                                    <?php cs_fontawsome_icons_box('',$rand_id);?>
                                    
                                    <div class='left-info'>
                                      <p>select the fontawsome Icons you would like to add to your menu items</p>
                                    </div>
                            </li>
                        </ul>
                        <ul class='form-elements'>
                            <li class='to-label'><label>Accordion Text:</label></li>
                            <li class='to-field'> <div class='input-sec'><textarea class='txtfield' data-content-text="cs-shortcode-textarea" name='accordion_text[]'></textarea></div>
                            <div class='left-info'>
                              <p>Enter your content.</p>
                            </div>
                            </li>
                        </ul>
                    </div>
                <?php	
			
		
		    }
			else if($_POST['shortcode_element'] == 'faq'){
				 $rand_id = rand(5,999);
				?>
                	<div class='cs-wrapp-clone cs-shortcode-wrapp'  id="cs_infobox_<?php echo intval( $rand_id);?>">
                        <header><h4><i class='fa fa-arrows'></i>FAQ</h4> <a href='#' class='deleteit_node'><i class='fa fa-minus-circle'></i>Remove</a></header>
                        <ul class='form-elements'>
                            <li class='to-label'><label>Active</label></li>
                            <li class='to-field select-style'> <select name='faq_active[]'><option value="no">No</option><option value="yes">Yes</option></select>
                            </li>
                        </ul>
                        <ul class='form-elements'>
                            <li class='to-label'><label>Faq Title:</label></li>
                            <li class='to-field'> <div class='input-sec'><input class='txtfield' type='text' name='faq_title[]' /></div>
                            </li>
                        </ul>
                        <ul class='form-elements' id="<?php echo intval( $rand_id);?>">
							<li class='to-label'><label>Fontawsome Icon:</label></li>
							<li class="to-field">
                                    <input type="hidden" class="cs-search-icon-hidden" name="cs_faq_icon[]">
                                    <?php cs_fontawsome_icons_box('',$rand_id);?>
                            </li>
                        </ul>
                        <ul class='form-elements'>
                            <li class='to-label'><label>Faq Text:</label></li>
                            <li class='to-field'> <div class='input-sec'><textarea class='txtfield' data-content-text="cs-shortcode-textarea" name='faq_text[]'></textarea></div>
                            </li>
                        </ul>
                    </div>
                <?php	
				
		 }
		    else if($_POST['shortcode_element'] == 'register'){
				 $rand_id = rand(5,999);
				?>
                	<div class='cs-wrapp-clone cs-shortcode-wrapp'  id="cs_infobox_<?php echo intval( $rand_id);?>">
                        <header><h4><i class='fa fa-arrows'></i>Register</h4> <a href='#' class='deleteit_node'><i class='fa fa-minus-circle'></i>Remove</a></header>
                        <ul class='form-elements'>
                            <li class='to-label'><label>Register Title:</label></li>
                            <li class='to-field'> <div class='input-sec'><input class='txtfield' type='text' name='register_title[]' /></div>
                            </li>
                        </ul>
                        
                        <ul class='form-elements'>
                            <li class='to-label'><label>User Role:</label></li>
                            <li class='to-field'> <div class="select-style"><select name='register_role[]'><option value="subscriber">Subscriber</option><option value="staff">Staff</option><option value="member">Member</option><option value="instructor">Instructor</option>
                            <option value="customer">Customer</option><option value="contributor">Contributor</option><option value="author">Author</option><option value="editor">Editor</option><option value="administrator">Administrator</option></select></div>
                            </li>
                        </ul>
                        
                        <ul class='form-elements'>
                            <li class='to-label'><label>Register Text:</label></li>
                            <li class='to-field'> <div class='input-sec'><textarea class='txtfield' data-content-text="cs-shortcode-textarea" name='register_text[]'></textarea></div>
                            </li>
                        </ul>
                    </div>
                <?php
					
		} 
			else if($_POST['shortcode_element'] == 'tabs'){
				$rand_id = rand(40, 9999999);
			?>
                	<div class='cs-wrapp-clone cs-shortcode-wrapp add_tabs  cs-pbwp-content'  id="cs_infobox_<?php echo intval( $rand_id);?>">
								<header><h4><i class='fa fa-arrows'></i>Tab</h4> <a href='#' class='deleteit_node'><i class='fa fa-minus-circle'></i>Remove</a></header>
								<ul class='form-elements'>
									<li class='to-label'><label>Active</label></li>
									<li class='to-field'> 
                                    	<div class="select-style"><select name='tab_active[]'><option value="no">No</option><option value="yes">Yes</option></select></div>
                                        <div class='left-info'>
                                          <p>You can set the section that is active here by select dropdown</p>
                                        </div>
									</li>
								</ul>
								<ul class='form-elements'>
									<li class='to-label'><label>Tab Title:</label></li>
									<li class='to-field'> <div class='input-sec'><input class='txtfield' type='text' name='tab_title[]' /></div>
									</li>
								</ul>
                                <ul class='form-elements' id="<?php echo intval( $rand_id);?>">
                                	<li class='to-label'><label>Fontawsome Icon:</label></li>
                                	<li class="to-field">
                                        <input type="hidden" class="cs-search-icon-hidden" name="cs_tab_icon[]">
                                        <?php cs_fontawsome_icons_box('',$rand_id);?>
                                        <div class='left-info'>
                                          <p> select the fontawsome Icons you would like to add to your menu items</p>
                                        </div>
                                	</li>
                                </ul>
                                <ul class='form-elements'>
									<li class='to-label'><label>Tab Text:</label></li>
									<li class='to-field'> <div class='input-sec'><textarea class='txtfield' data-content-text="cs-shortcode-textarea" name='tab_text[]'></textarea></div>
                                    <div class='left-info'>
                                      <p>Enter tab body content here</p>
                                    </div>
									</li>
								</ul>
							</div>
                <?php	
			}
			else if($_POST['shortcode_element'] == 'testimonials'){
				 $rand_id = rand(5,999);
				?>
                    <div class='cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content'  id="cs_infobox_<?php echo intval( $rand_id);?>">
                        <header><h4><i class='fa fa-arrows'></i>Testimonial</h4> <a href='#' class='deleteit_node'><i class='fa fa-minus-circle'></i>Remove</a></header>
                        <ul class='form-elements'>
                            <li class='to-label'><label>Text:</label></li>
                            <li class='to-field'> <div class='input-sec'><textarea class='txtfield' data-content-text="cs-shortcode-textarea" name='testimonial_text[]'></textarea></div>
                            </li>
                        </ul>
                        <ul class='form-elements'>
                            <li class='to-label'><label>Author:</label></li>
                            <li class='to-field'> <div class='input-sec'><input class='txtfield' type='text' name='testimonial_author[]' /></div></li>
                        </ul>
                        <ul class='form-elements'>
                            <li class='to-label'><label>Company:</label></li>
                            <li class='to-field'> <div class='input-sec'><input class='txtfield' type='text' name='testimonial_company[]' /></div>
                            <div class='left-info'><p>Company Name</p></div>
                            </li>
                        </ul>
                        <ul class="form-elements">
                          <li class="to-label">
                            <label>Background Image</label>
                          </li>
                          <li class="to-field">
                            <input id="testimonial_img<?php echo intval( $rand_id);?>" name="testimonial_img[]" type="hidden" class="" value=""/>
                            <input name="testimonial_img<?php echo intval( $rand_id);?>"  type="button" class="uploadMedia left" value="Browse"/>
                          </li>
                        </ul>
                        <div class="page-wrap" style="overflow:hidden; display:none" id="testimonial_img<?php echo intval( $rand_id);?>_box" >
                          <div class="gal-active">
                            <div class="dragareamain" style="padding-bottom:0px;">
                              <ul id="gal-sortable">
                                <li class="ui-state-default" id="">
                                  <div class="thumb-secs"> <img src=""  id="testimonial_img<?php echo intval( $rand_id);?>_img" width="100" height="150"  />
                                    <div class="gal-edit-opts"> <a   href="javascript:del_media('testimonial_img<?php echo intval( $rand_id);?>')" class="delete"></a> </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                </div>
                <?php	
			} 
			else if($_POST['shortcode_element'] == 'counter'){
				$counter_count = rand(40, 9999999);
				?>
                <div class='cs-wrapp-clone cs-shortcode-wrapp' id="cs_infobox_<?php echo intval($counter_count);?>">
                        <header><h4><i class='fa fa-arrows'></i>Counter</h4> <a href='#' class='deleteit_node'><i class='fa fa-minus-circle'></i>Remove</a></header>
                        <ul class="form-elements">
                            <li class="to-label"><label>Counter Title</label></li>
                            <li class="to-field"><input type="text"  name="counter_title[]"  class="txtfield"  /></li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label"><label>Type</label></li>
                            <li class="to-field">
                                <div class="select-style">
                                    <select name="counter_style[]" class="dropdown" >
                                        <option value="one" >Counter Style One</option>
                                        <option value="two" >Counter Style Two</option>
                                        <option value="three" >Counter Style Three</option>
                                        <option value="four" >Counter Style Four</option>
                                     </select>
                                 </div>
                            </li>
                        </ul>
                        
                        <ul class="form-elements">
                            <li class="to-label"><label>Choose Icon</label></li>
                            <li class="to-field">
                                <div class="select-style">
                                    <select name="counter_icon_type[]" class="dropdown" onchange="cs_counter_image(this.value,'<?php echo esc_js($counter_count)?>','')">
                                        <option <?php if($counter_item->counter_icon_type=="icon")echo "selected";?> value="icon" >Icon</option>
                                        <option <?php if($counter_item->counter_icon_type=="image")echo "selected";?> value="image" >Image</option>
                                     </select>
                                 </div>
                            </li>
                        </ul>
                        
                        <div class="selected_icon_type" id="selected_icon_type<?php echo intval($counter_count)?>">
                        	 <ul class='form-elements' id="<?php echo intval($counter_count);?>">
								<li class='to-label'><label>Fontawsome Icon:</label></li>
								<li class="to-field">
                                     <input type="hidden" class="cs-search-icon-hidden" name="counter_icon">
                                     <?php cs_fontawsome_icons_box('',$counter_count);?>
                            	</li>
                         </ul>
                         	<ul class="form-elements">
                                <li class="to-label"><label>Icon Color</label></li>
                                <li><input type="text"  name="icon_color[]"  class="bg_color"  /></li>
                            </ul>
                        </div>
                        <div class="selected_image_type" id="selected_image_type<?php echo intval($counter_count)?>" style="display:none">
                       		<ul class="form-elements">
                              <li class="to-label">
                                <label>Image</label>
                              </li>
                              <li class="to-field">
                                <input id="cs_counter_logo<?php echo intval($counter_count)?>" name="cs_counter_logo[]" type="hidden" class="" value=""/>
                                <input name="cs_counter_logo<?php echo intval($counter_count)?>"  type="button" class="uploadMedia left" value="Browse"/>
                              </li>
                            </ul>
                            <div class="page-wrap" style="overflow:hidden; display:<?php echo 'none';?>" id="cs_counter_logo<?php echo intval($counter_count)?>_box" >
                              <div class="gal-active">
                                <div class="dragareamain" style="padding-bottom:0px;">
                                  <ul id="gal-sortable">
                                    <li class="ui-state-default" id="">
                                      <div class="thumb-secs"> <img src="<?php echo cs_allow_special_char($counter_count);?>"  id="cs_counter_logo<?php echo intval($counter_count)?>_img" width="100" height="150"  />
                                        <div class="gal-edit-opts"> <a   href="javascript:del_media('cs_counter_logo<?php echo esc_js($counter_count)?>')" class="delete"></a> </div>
                                      </div>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
        				</div>
						
                        <ul class="form-elements">
                            <li class="to-label"><label>Background Color</label></li>
                            <li><input type="text"  name="counter_bg_color[]" class="bg_color" value="" /></li>
                        </ul>
                                        
                        <ul class="form-elements">
                            <li class="to-label"><label>Numbers</label></li>
                            <li class="to-field"><input type="text" name="counter_numbers[]" class="txtfield" value="" /></li>
                        </ul>
                      	<ul class="form-elements">
                            <li class="to-label"><label>Count Text Color</label></li>
                            <li><input type="text" name="counter_text_color[]" class="bg_color" /></li>
                        </ul>
                        
                        <ul class="form-elements">
                            <li class="to-label"><label>Link Title</label></li>
                            <li class="to-field"><input type="text" name="counter_icon_linktitle[]" class="txtfield" /></li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label"><label>Link</label></li>
                            <li class="to-field"><input type="text" name="counter_icon_linkurl[]" class="txtfield"/></li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label"><label>Button Color</label></li>
                            <li><input type="text"  name="counter_link_bgcolor[]" class="bg_color"  /></li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label"><label>Text</label></li>
                            <li class="to-field"><textarea type="text" name="counter_text[]" class="txtfield" data-content-text="cs-shortcode-textarea" /><?php echo cs_allow_special_char($counter_text)?></textarea></li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label"><label>Custom ID</label></li>
                            <li class="to-field">
                                <input type="text" name="coutner_class[]" class="txtfield"  value="" />
                            </li>
                         </ul>
                       
                        <ul class="form-elements">
                            <li class="to-label"><label>Animation Class </label></li>
                            <li class="to-field select-style">
                                <select class="dropdown" name="coutner_animation[]">
                                    <option value="">Select Animation</option>
                                    <?php 
									
                                        $animation_array = cs_animation_style();
                                        foreach($animation_array as $animation_key=>$animation_value){
                                            echo '<optgroup label="'.$animation_key.'">';	
                                            foreach($animation_value as $key=>$value){
                                                echo '<option value="'.$key.'" >'.$value.'</option>';
                                            }
                                        }
                                    
                                     ?>
                                  </select>
                            </li>
                        </ul>
                      
                	</div>
                <?php	} 
			else if ($_POST['shortcode_element'] == 'list'){
							$rand_id = rand(40, 9999999);
						?>
                	<div class='cs-wrapp-clone cs-shortcode-wrapp' id="cs_infobox_<?php echo intval($rand_id);?>">
                            <header><h4><i class='fa fa-arrows'></i>List Item(s)</h4> <a href='#' class='deleteit_node'><i class='fa fa-minus-circle'></i>Remove</a></header>
                            <ul class='form-elements'>
                                <li class='to-label'><label>List Item:</label></li>
                                <li class='to-field'> <div class='input-sec'><input class='txtfield' type='text' name='cs_list_item[]' data-content-text="cs-shortcode-textarea" /></div>
                                </li>
                            </ul> 
                            <ul class='form-elements' id="<?php echo intval( $rand_id);?>">
								<li class='to-label'><label>Fontawsome Icon:</label></li>
								<li class="to-field">
                                <input type="hidden" class="cs-search-icon-hidden" name="cs_list_icon[]">
                                <?php cs_fontawsome_icons_box('',$rand_id);?>
                            </li>
                         </ul>
                    </div>
                <?php	
			}  
			else if ($_POST['shortcode_element'] == 'infobox_items'){
					$rand_id = rand(432420, 9999999);
				?>
                    <div class='cs-wrapp-clone cs-shortcode-wrapp' id="cs_infobox_<?php echo intval( $rand_id);?>">
                            <header><h4><i class='fa fa-arrows'></i>Infobox Item(s)</h4> 
                                <a href='#' class='deleteit_node'>
                                    <i class='fa fa-minus-circle'></i>Remove
                                </a>
                            </header>
                            
                        <ul class='form-elements' id="cs_infobox_<?php echo absint($rand_id);?>">
                            <li class='to-label'><label>Fontawsome Icon:</label></li>
                            <li class="to-field">
                                <input type="hidden" class="cs-search-icon-hidden" name="cs_infobox_list_icon[]">
                                <?php cs_fontawsome_icons_box('',$rand_id);?>
                            </li>
                        </ul>
                        <ul class='form-elements'>
                            <li class='to-label'><label>Icon Color:</label></li>
                            <li class='to-field'> <div class='input-sec'><input class='bg_color' type='text' name='cs_infobox_list_color[]' /></div>
                            </li>
                        </ul> 
                        <ul class='form-elements'>
                            <li class='to-label'><label>Title:</label></li>
                            <li class='to-field'> <div class='input-sec'><input class='txtfield' type='text' name='cs_infobox_list_title[]' /></div>
                            </li>
                        </ul>
                         <ul class='form-elements'>
                            <li class='to-label'><label>Short Description:</label></li>
                            <li class='to-field'> <div class='input-sec'><textarea name='cs_infobox_list_description[]' rows="8" cols="20" data-content-text="cs-shortcode-textarea" /></textarea></div>
                            </li>
                        </ul> 
                       <?php /*?> <ul class='form-elements'>
                            <li class='to-label'><label>Text Color:</label></li>
                            <li class='to-field'> <div class='input-sec'><input class='bg_color' type='text' name='cs_infobox_list_text_color[]' /></div>
                            </li>
                        </ul> <?php */?>
                    </div>
                <?php	
			} 
			else if ($_POST['shortcode_element'] == 'audio'){
				$rand_id = 'clinets_'.rand(40, 9999999);
				?>
                	<div class='cs-wrapp-clone cs-shortcode-wrapp' id="cs_infobox_<?php echo intval( $rand_id);?>">
                        <header><h4><i class='fa fa-arrows'></i>Album Item(s)</h4> <a href='#' class='deleteit_node'><i class='fa fa-minus-circle'></i>Remove</a></header>
                        <ul class="form-elements">
                            <li class="to-label"><label>Track Title</label></li>
                            <li class="to-field">
                                <input type="text" id="cs_album_track_title" name="cs_album_track_title[]" value="Track Title" />
                            </li>
                        </ul>
                        
                        <ul class="form-elements">
                            <li class="to-label"><label>Track MP3 URL</label></li>
                            <li class="to-field">
                                <input id="cs_album_track_mp3_url" name="cs_album_track_mp3_url[]" value="" type="text" class="small" />
                                <!--<input id="custom_media_upload" name="cs_album_track_mp3_url" type="button" class="uploadfile left" value="Browse"/>-->
                            </li>
                        </ul>
                        
                </div>
                <?php	
			}
			else if ($_POST['shortcode_element'] == 'clients'){
				$clients_count = 'clinets_'.rand(40, 9999999);
				?>
                	<div class='cs-wrapp-clone cs-shortcode-wrapp' id="cs_infobox_<?php echo cs_allow_special_char($clients_count);?>">
                        <header><h4><i class='fa fa-arrows'></i>Client</h4> <a href='#' class='deleteit_node'><i class='fa fa-minus-circle'></i>Remove</a></header>
                        <ul class="form-elements">
                          <li class="to-label">
                            <label>Title</label>
                          </li>
                          <li class="to-field">
                            <input type="text" id="cs_client_title" class="" name="cs_client_title[]" value="" />
                          </li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label"><label>Background Color</label></li>
                            <li class="to-field">
                                <input type="text" id="cs_bg_color" class="bg_color" name="cs_bg_color[]" value="" />
                            </li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label"><label>Website URL</label></li>
                            <li class="to-field">
                                <div class="input-sec"> <input type="text" id="cs_website_url" class="" name="cs_website_url[]" value="" /></div>
                                <div class="left-info"><p>e.g. http://yourdomain.com/</p></div>
                            </li>
                        </ul>
                        <ul class="form-elements">
                          <li class="to-label">
                            <label>Client Logo</label>
                          </li>
                          <li class="to-field">
                            <input id="cs_client_logo<?php echo cs_allow_special_char($clients_count)?>" name="cs_client_logo[]" type="hidden" class="" value=""/>
                            <input name="cs_client_logo<?php echo cs_allow_special_char($clients_count)?>"  type="button" class="uploadMedia left" value="Browse"/>
                          </li>
                        </ul>
                        <div class="page-wrap" style="overflow:hidden; display:<?php echo 'none';?>" id="cs_client_logo<?php echo cs_allow_special_char($clients_count)?>_box" >
                          <div class="gal-active">
                            <div class="dragareamain" style="padding-bottom:0px;">
                              <ul id="gal-sortable">
                                <li class="ui-state-default" id="">
                                  <div class="thumb-secs"> <img src="<?php echo cs_allow_special_char($clients_count);?>"  id="cs_client_logo<?php echo cs_allow_special_char($clients_count);?>_img" width="100" height="150"  />
                                    <div class="gal-edit-opts"> <a   href="javascript:del_media('cs_client_logo<?php echo cs_allow_special_char($clients_count)?>')" class="delete"></a> </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                </div>
                <?php	
			}
			else if ($_POST['shortcode_element'] == 'progressbars'){
				$rand_id = rand(40, 9999999);
				?>
                	<div class='cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content' id="cs_infobox_<?php echo intval( $rand_id);?>">
                        <header><h4><i class='fa fa-arrows'></i>Progressbars</h4> <a href='#' class='deleteit_node'><i class='fa fa-minus-circle'></i>Remove</a></header>
                        <ul class="form-elements">
                            <li class="to-label"><label>ProgressBars Title</label></li>
                            <li class="to-field">
                                <input type="text" name="progressbars_title[]" class="txtfield" value="" />
                            </li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label"><label>Skill (in percentage)</label></li>
                            <li class="to-field">
                                <div class="cs-drag-slider" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value=""></div>
                                <input  class="cs-range-input"  name="progressbars_percentage[]" type="text" value=""   />
                                <p>Set the Skill (In %)</p>
                            </li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label"><label>ProgressBars Color</label></li>
                            <li class="to-field">
                                <input type="text" name="progressbars_color[]" class="bg_color" value="#000" />
                            </li>
                        </ul>
                </div>
                <?php	
			}
			else if ($_POST['shortcode_element'] == 'offerslider'){
				$offer_count = 'offer_'.rand(40, 9999999);
				?>
                	<div class='cs-wrapp-clone cs-shortcode-wrapp' id="cs_infobox_<?php echo intval($offer_count);?>">
                        <header><h4><i class='fa fa-arrows'></i>Offer Slider Item</h4> <a href='#' class='deleteit_node'><i class='fa fa-minus-circle'></i>Remove</a></header>
                        <ul class="form-elements">
                          <li class="to-label">
                            <label>Image</label>
                          </li>
                          <li class="to-field">
                            <input id="cs_slider_image<?php echo intval($offer_count)?>" name="cs_slider_image[]" type="hidden" class="" value=""/>
                            <input name="cs_slider_image<?php echo intval($offer_count)?>"  type="button" class="uploadMedia left" value="Browse"/>
                          </li>
                        </ul>
                        <div class="page-wrap" style="overflow:hidden; display:<?php echo 'none';?>" id="cs_slider_image<?php echo intval($offer_count) ?>_box"  >
                          <div class="gal-active">
                            <div class="dragareamain" style="padding-bottom:0px;">
                              <ul id="gal-sortable">
                                <li class="ui-state-default" id="">
                                  <div class="thumb-secs"> <img src=""  id="cs_slider_image<?php echo intval($offer_count)?>_img" width="100" height="150"  />
                                    <div class="gal-edit-opts"> <a   href="javascript:del_media('cs_slider_image<?php echo esc_js($offer_count) ?>')" class="delete"></a> </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <ul class="form-elements">
                          <li class="to-label">
                            <label>Title</label>
                          </li>
                          <li class="to-field">
                            <input type="text" name="cs_slider_title[]" class="txtfield" value="" />
                          </li>
                        </ul>
                        <ul class="form-elements">
                          <li class="to-label">
                            <label>Content(s)</label>
                          </li>
                          <li class="to-field">
                            <textarea name="cs_slider_contents[]" data-content-text="cs-shortcode-textarea"></textarea>
                          </li>
                        </ul>
                        <ul class="form-elements">
                          <li class="to-label">
                            <label>Link</label>
                          </li>
                          <li class="to-field">
                            <input type="text" name="cs_readmore_link[]" class="txtfield" value="" />
                          </li>
                        </ul>
                        <ul class="form-elements">
                          <li class="to-label">
                            <label>Link Title</label>
                          </li>
                          <li class="to-field">
                            <input type="text" name="cs_offerslider_link_title[]" class="txtfield" value="" />
                          </li>
                        </ul>
                </div>
                <?php	
			}  
		}
		exit;
	}
	add_action('wp_ajax_cs_shortcode_element_ajax_call', 'cs_shortcode_element_ajax_call');
}