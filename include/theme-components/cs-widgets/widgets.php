<?php 
/**
 * Widgets Classes & Functions
 */
 

/**
 * @Facebook widget Class
 *
 *
 */

if ( ! class_exists( 'facebook_module' ) ) { 
	class facebook_module extends WP_Widget {
	  
		/**
		 * Outputs the content of the widget
		 *
		 * @param array $args
		 * @param array $instance
		 */
 		/**
		 * @Facebook Module
		 *
		 *
		 */
		 function facebook_module(){
				$widget_ops = array('classname' => 'facebok_widget', 'description' => 'Facebook widget like box total customized with theme.' );
				$this->WP_Widget('facebook_module', 'CS : Facebook', $widget_ops);
		  }
	  	  
		/**
		 * @Facebook html Form
		 *
		 *
		 */
		 function form($instance) {
				$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
				$title = $instance['title'];
				$pageurl = isset( $instance['pageurl'] ) ? esc_attr( $instance['pageurl'] ) : '';
				$showfaces = isset( $instance['showfaces'] ) ? esc_attr( $instance['showfaces'] ) : '';
				$showstream = isset( $instance['showstream'] ) ? esc_attr( $instance['showstream'] ) : '';
				$showheader = isset( $instance['showheader'] ) ? esc_attr( $instance['showheader'] ) : '';
				$fb_bg_color = isset( $instance['fb_bg_color'] ) ? esc_attr( $instance['fb_bg_color'] ) : '';
				$likebox_height = isset( $instance['likebox_height'] ) ? esc_attr( $instance['likebox_height'] ) : '';						
			?>
            <p>
              <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"> Title:
                <input class="upcoming" id="<?php echo esc_attr($this->get_field_id('title')); ?>" size='40' name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
              </label>
            </p>
            <p>
              <label for="<?php echo esc_attr($this->get_field_id('pageurl')); ?>"> Page URL:
                <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('pageurl')); ?>" size='40' name="<?php echo esc_attr($this->get_field_name('pageurl')); ?>" type="text" value="<?php echo esc_attr($pageurl); ?>" />
                <br />
                <small>Please enter your page or User profile url example: http://www.facebook.com/profilename OR <br />
                https://www.facebook.com/pages/wxyz/123456789101112 </small><br />
              </label>
            </p>
            <p>
              <label for="<?php echo esc_attr($this->get_field_id('showfaces')); ?>"> Show Faces:
                <input class="upcoming" id="<?php echo esc_attr($this->get_field_id('showfaces')); ?>" name="<?php echo esc_attr($this->get_field_name('showfaces')); ?>" type="checkbox" <?php if(esc_attr($showfaces) != '' ){echo 'checked';}?> />
              </label>
            </p>
            <p>
              <label for="<?php echo esc_attr($this->get_field_id('showstream')); ?>"> Show Stream:
                <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('showstream')); ?>" name="<?php echo cs_allow_special_char($this->get_field_name('showstream')); ?>" type="checkbox" <?php if(esc_attr($showstream) != '' ){echo 'checked';}?> />
              </label>
            </p>
            <p>
              <label for="<?php echo cs_allow_special_char($this->get_field_id('likebox_height')); ?>"> Like Box Height:
                <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('likebox_height')); ?>" size='2' name="<?php echo cs_allow_special_char($this->get_field_name('likebox_height')); ?>" type="text" value="<?php echo esc_attr($likebox_height); ?>" />
              </label>
            </p>
            <p>
              <label for="<?php echo cs_allow_special_char($this->get_field_id('fb_bg_color')); ?>"> Background Color:
                <input type="text" name="<?php echo cs_allow_special_char($this->get_field_name('fb_bg_color')); ?>" size='4' id="<?php echo cs_allow_special_char($this->get_field_id('fb_bg_color')); ?>"  value="<?php if(!empty($fb_bg_color)){ echo cs_allow_special_char($fb_bg_color);}else{ echo "#fff";}; ?>" class="fb_bg_color upcoming"  />
              </label>
            </p>
            
            <?php
		
	    }
		
		/**
		 * @Facebook Update Form Data
		 *
		 *
		 */
		 function update($new_instance, $old_instance) {
	
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['pageurl'] = $new_instance['pageurl'];
			$instance['showfaces'] = $new_instance['showfaces'];	
			$instance['showstream'] = $new_instance['showstream'];
			$instance['showheader'] = $new_instance['showheader'];
			$instance['fb_bg_color'] = $new_instance['fb_bg_color'];		
			$instance['likebox_height'] = $new_instance['likebox_height'];			
	
			return $instance;
			
		  }
		
		
		/**
		 * @Facebook Widget Display
		 *
		 *
		 */
		 function widget($args, $instance) {
	
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
			$pageurl = empty($instance['pageurl']) ? ' ' : apply_filters('widget_title', $instance['pageurl']);
			$showfaces = empty($instance['showfaces']) ? ' ' : apply_filters('widget_title', $instance['showfaces']);
			$showstream = empty($instance['showstream']) ? ' ' : apply_filters('widget_title', $instance['showstream']);
			$showheader = empty($instance['showheader']) ? ' ' : apply_filters('widget_title', $instance['showheader']);
			$fb_bg_color = empty($instance['fb_bg_color']) ? ' ' : apply_filters('widget_title', $instance['fb_bg_color']);								
			$likebox_height = empty($instance['likebox_height']) ? ' ' : apply_filters('widget_title', $instance['likebox_height']);													
			if(isset($showfaces) AND $showfaces == 'on'){$showfaces ='true';}else{$showfaces = 'false';}
			if(isset($showstream) AND $showstream == 'on'){$showstream ='true';}else{$showstream ='false';}
			echo cs_allow_special_char($before_widget);	

			if (!empty($title) && $title <> ' '){
				echo cs_allow_special_char($before_title);
				echo cs_allow_special_char($title);
				echo cs_allow_special_char($after_title);
			}
	
		global $wpdb, $post;?>
<style type="text/css" >
            .facebookOuter {background-color:<?php echo cs_allow_special_char($fb_bg_color);?>; width:100%;padding:0;float:left;}
            .facebookInner {float: left; width: 100%;}
            .facebook_module, .fb_iframe_widget > span, .fb_iframe_widget > span > iframe { width: 100% !important;}
            .fb_iframe_widget, .fb-like-box div span iframe { width: 100% !important; float: left;}
        </style>
<div class="facebook">
  <div class="facebookOuter">
    <div class="facebookInner">
      <div class="fb-like-box" data-height="<?php echo cs_allow_special_char($likebox_height);?>"  data-width="190"  data-href="<?php echo esc_url($pageurl);?>" data-border-color="#fff" data-show-faces="<?php echo cs_allow_special_char($showfaces);?>"  data-show-border="false" data-stream="<?php echo cs_allow_special_char($showstream);?>" data-header="false"> </div>
    </div>
  </div>
</div>
<script type="text/javascript">(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	</script> 
<?php echo cs_allow_special_char($after_widget);
	
			}
		}	
}
add_action( 'widgets_init', create_function('', 'return register_widget("facebook_module");') );

	
/**
 * @Social Network widget Class
 *
 *
 */
if ( ! class_exists( 'cs_social_network_widget' ) ) { 
	class cs_social_network_widget extends WP_Widget{
	
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	 
	/**
	 * @Social Network Module
	 *
	 *
	 */
	function cs_social_network_widget(){
		$widget_ops = array('classname' => 'widget-socialnetwork', 'description' => 'Social Newtork widget.' );
		$this->WP_Widget('cs_social_network_widget', 'CS : Social Newtork', $widget_ops);
  	}
  	
	/**
	 * @Social Network html form
	 *
	 *
	 */
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];
		?>
<p>
  <label for="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>"> Title:
    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>" size='40' name="<?php echo cs_allow_special_char($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
</p>
<?php
	  }
	  
	/**
	 * @Social Network Update from data 
	 *
	 *
	 */
	 function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		return $instance;
	  }
	  
	/**
	 * @Social Network Widget
	 *
	 *
	 */
	 function widget($args, $instance){
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
			echo cs_allow_special_char($before_widget);
				
			if (!empty($title) && $title <> ' '){
				echo cs_allow_special_char($before_title);
				echo cs_allow_special_char($title);
				echo cs_allow_special_char($after_title);
			}
				global $wpdb, $post;
				echo '<div class="followus">';
					cs_social_network_widget();
				echo '</div>';
				echo cs_allow_special_char($after_widget);
			}
		}
}
add_action( 'widgets_init', create_function('', 'return register_widget("cs_social_network_widget");') );


/**
 * @Flickr widget Class
 *
 *
 */
if ( ! class_exists( 'cs_flickr' ) ) { 
	class cs_flickr extends WP_Widget {	
	
		/**
		 * Outputs the content of the widget
		 *
		 * @param array $args
		 * @param array $instance
		 */
			 
		/**
		 * @init Flickr Module
		 *
		 *
		 */
		function cs_flickr() {
			$widget_ops = array('classname' => 'widget-flickr widget-gallery', 'description' => 'Type a user name to show photos in widget.');
			$this->WP_Widget('cs_flickr', 'CS : Flickr Gallery', $widget_ops);
		}
		 
		 /**
		 * @Flickr html form
		 *
		 *
		 */
		function form($instance){
			$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
			$title = $instance['title'];
			$username = isset( $instance['username'] ) ? esc_attr( $instance['username'] ) : '';
			$no_of_photos = isset( $instance['no_of_photos'] ) ? esc_attr( $instance['no_of_photos'] ) : '';	
		?>
		<p>
            <label for="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>"> Title:
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </label>
		</p>
        <p>
            <label for="<?php echo cs_allow_special_char($this->get_field_id('username')); ?>"> Flickr username:
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('username')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('username')); ?>" type="text" value="<?php echo esc_attr($username); ?>" />
            </label>
		</p>
		<p>
            <label for="<?php echo cs_allow_special_char($this->get_field_id('no_of_photos')); ?>"> Number of Photos:
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('no_of_photos')); ?>" size='2' name="<?php echo cs_allow_special_char($this->get_field_name('no_of_photos')); ?>" type="text" value="<?php echo esc_attr($no_of_photos); ?>" />
            </label>
		</p>
		<?php
		}
			
		/**
		 * @Flickr update form data
		 *
		 *
		 */
		function update($new_instance, $old_instance){
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['username'] = $new_instance['username'];
			$instance['no_of_photos'] = $new_instance['no_of_photos'];
			
			return $instance;
		}
	
		/**
		 * @Display Flickr widget
		 *
		 *
		 */
		function widget($args, $instance){
			global $cs_theme_options;
			
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
			$username = empty($instance['username']) ? ' ' : apply_filters('widget_title', $instance['username']);			
			$no_of_photos = empty($instance['no_of_photos']) ? ' ' : apply_filters('widget_title', $instance['no_of_photos']);	
			if($instance['no_of_photos'] == ""){$instance['no_of_photos'] = '3';}
			
			echo cs_allow_special_char($before_widget);	
			
			if (!empty($title) && $title <> ' '){
				echo cs_allow_special_char($before_title);
				echo cs_allow_special_char($title);
				echo cs_allow_special_char($after_title);
			}
			
			$get_flickr_array = array();
					
			$apiKey = $cs_theme_options['flickr_key'];
			$apiSecret = $cs_theme_options['flickr_secret'];
			
			if($apiKey <> ''){
			
				// Getting transient
				$cachetime = 86400;
				$transient = 'flickr_gallery_data';
				$check_transient = get_transient($transient);
				
				// Get Flickr Gallery saved data
				$saved_data = get_option('flickr_gallery_data');
				
				$db_apiKey = '';
				$db_user_name = '';
				$db_total_photos = '';
				
				if($saved_data <> ''){
					$db_apiKey = isset($saved_data['api_key']) ? $saved_data['api_key'] : '';
					$db_user_name = isset($saved_data['user_name']) ? $saved_data['user_name'] : '';
					$db_total_photos = isset($saved_data['total_photos']) ? $saved_data['total_photos'] : '';
				}
				
				if( $check_transient === false || ($apiKey <> $db_apiKey || $username <> $db_user_name || $no_of_photos <> $db_total_photos) ){
				
					$user_id = "https://api.flickr.com/services/rest/?method=flickr.people.findByUsername&api_key=".$apiKey."&username=".$username."&format=json&nojsoncallback=1";
					
					$user_info = file_get_contents($user_id);
					$user_info = json_decode($user_info, true);
								
					if ($user_info['stat'] == 'ok') {
						
						$user_get_id = $user_info['user']['id'];
						
						$get_flickr_array['api_key'] = $apiKey;
						$get_flickr_array['user_name'] = $username;
						$get_flickr_array['user_id'] = $user_get_id;
						
						$url = "https://api.flickr.com/services/rest/?method=flickr.people.getPublicPhotos&api_key=".$apiKey."&user_id=".$user_get_id."&per_page=".$no_of_photos."&format=json&nojsoncallback=1";
						$content = file_get_contents($url);
						$content = json_decode($content, true);
						
						if ($content['stat'] == 'ok') {
							$counter = 0;
							echo '<ul class="gallery-list">';			 				
							foreach ((array)$content['photos']['photo'] as $photo) {
								
								$image_file = "https://farm{$photo['farm']}.staticflickr.com/{$photo['server']}/{$photo['id']}_{$photo['secret']}_s.jpg";
								
								$img_headers = get_headers($image_file);
								if(strpos($img_headers[0], '200') !== false) {
									
									$image_file = $image_file;
								}
								else{
									$image_file = "https://farm{$photo['farm']}.staticflickr.com/{$photo['server']}/{$photo['id']}_{$photo['secret']}_q.jpg";
									$img_headers = get_headers($image_file);
									if(strpos($img_headers[0], '200') !== false) {
										
										$image_file = $image_file;
									}
									else{
										$image_file = get_template_directory_uri().'/assets/images/no_image_thumb.jpg';
									}
								}
								
								echo '<li>';
								echo "<a target='_blank' title='" . $photo['title'] . "' href='https://www.flickr.com/photos/" . $photo['owner'] . "/" . $photo['id'] . "/'>";
								echo "<img alt='".$photo['title']."' src='".$image_file."'>";
								echo "</a>";
								echo '</li>';
														
								$counter++;
								
								$get_flickr_array['photo_src'][] = $image_file;
								$get_flickr_array['photo_title'][] = $photo['title'];
								$get_flickr_array['photo_owner'][] = $photo['owner'];
								$get_flickr_array['photo_id'][] = $photo['id'];
								
							}
							echo '</ul>';
							
							$get_flickr_array['total_photos'] = $counter;
							
							// Setting Transient
							set_transient( $transient, true, $cachetime );
							update_option('flickr_gallery_data', $get_flickr_array);
							
							if($counter == 0) _e('No result found.', 'Awaken');
						}
						
						else {
							echo 'Error:' . $content['code'] . ' - ' . $content['message'];
						}
					}
					
					else {
						echo 'Error:' . $user_info['code'] . ' - ' . $user_info['message'];
					}
				
				}
				else{
					if( get_option('flickr_gallery_data') <> '' ){
						
						$flick_data = get_option('flickr_gallery_data');
						echo '<ul class="gallery-list">';
							if(isset($flick_data['photo_src'])):
								$i = 0;
								foreach($flick_data['photo_src'] as $ph){
									echo '<li>';
									echo "<a target='_blank' title='" . $flick_data['photo_title'][$i] . "' href='https://www.flickr.com/photos/" . $flick_data['photo_owner'][$i] . "/" . $flick_data['photo_id'][$i] . "/'>";
									echo "<img alt='".$flick_data['photo_title'][$i]."' src='".$flick_data['photo_src'][$i]."'>";
									echo "</a>";
									echo '</li>';
									$i++;
								}
							endif;
						echo '</ul>';
					}
					else{
						_e('No result found.', 'Awaken');
					}
				}
			
			}
			else{
				_e('Please Enter Flickr API key from Theme Options.', 'Awaken');
			}
			echo cs_allow_special_char($after_widget);
			
		}
	}
}
add_action('widgets_init', create_function('', 'return register_widget("cs_flickr");'));


/**
 * @Recent posts widget Class
 *
 *
 */

if ( ! class_exists( 'recentposts' ) ) { 
	class recentposts extends WP_Widget{
	
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
		 
	/**
	 * @init Recent posts Module
	 *
	 *
	 */
	 function recentposts(){
		$widget_ops = array('classname' => 'widget-recent-blog widget_latest_post', 'description' => 'Recent Posts from category.' );
		$this->WP_Widget('recentposts', 'CS : Recent Posts', $widget_ops);
	 }
	 
	 /**
	 * @Recent posts html form
	 *
	 *
	 */
	 function form($instance){
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];
		$select_category = isset( $instance['select_category'] ) ? esc_attr( $instance['select_category'] ) : '';
		$showcount = isset( $instance['showcount'] ) ? esc_attr( $instance['showcount'] ) : '';	
		$thumb = isset( $instance['thumb'] ) ? esc_attr( $instance['thumb'] ) : '';
	?>
        <p>
          <label for="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>"> Title:
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
          </label>
        </p>
        <p>
          <label for="<?php echo cs_allow_special_char($this->get_field_id('select_category')); ?>"> Select Category:
            <select id="<?php echo cs_allow_special_char($this->get_field_id('select_category')); ?>" name="<?php echo cs_allow_special_char($this->get_field_name('select_category')); ?>" style="width:225px">
              <option value="" >All</option>
              <?php
				$categories = get_categories();
				if($categories <> ""){
					foreach ( $categories as $category ) {?>
					  <option <?php if($select_category == $category->slug){echo 'selected';}?> value="<?php echo cs_allow_special_char($category->slug);?>" ><?php echo cs_allow_special_char($category->name);?></option>
					<?php 
					}
				}?>
            </select>
          </label>
        </p>
        <p>
          <label for="<?php echo cs_allow_special_char($this->get_field_id('showcount')); ?>"> Number of Posts To Display:
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('showcount')); ?>" size='2' name="<?php echo cs_allow_special_char($this->get_field_name('showcount')); ?>" type="text" value="<?php echo esc_attr($showcount); ?>" />
          </label>
        </p>
        <p>
          <label for="<?php echo cs_allow_special_char($this->get_field_id('thumb')); ?>"> Display Thumbnails:
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('thumb')); ?>" size='2' name="<?php echo cs_allow_special_char($this->get_field_name('thumb')); ?>" value="true" type="checkbox"  <?php if(isset($instance['thumb']) && $instance['thumb']=='true' ) echo 'checked="checked"'; ?> />
          </label>
        </p>
        <?php
        }
		
		/**
		 * @Recent posts update form data
		 *
		 *
		 */
		 function update($new_instance, $old_instance){
			  $instance = $old_instance;
			  $instance['title'] = $new_instance['title'];
			  $instance['select_category'] = $new_instance['select_category'];
			  $instance['showcount'] = $new_instance['showcount'];
			  $instance['thumb'] = $new_instance['thumb'];
			
			  return $instance;
		 }

		 /**
		 * @Display Recent posts widget
		 *
		 *
		 */
		 function widget($args, $instance){
			  global $cs_node;
		
			  extract($args, EXTR_SKIP);
			  $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
			  $select_category = empty($instance['select_category']) ? ' ' : apply_filters('widget_title', $instance['select_category']);			
			  $showcount = empty($instance['showcount']) ? ' ' : apply_filters('widget_title', $instance['showcount']);	
			  $thumb = isset( $instance['thumb'] ) ? esc_attr( $instance['thumb'] ) : '';						
			  if($instance['showcount'] == ""){$instance['showcount'] = '-1';}
		
			  echo cs_allow_special_char($before_widget);	
		
			  if (!empty($title) && $title <> ' '){
				  echo cs_allow_special_char($before_title);
				  echo cs_allow_special_char($title);
				  echo cs_allow_special_char($after_title);
			  }
		
		global $wpdb, $post;?>
<?php
			  wp_reset_query();
			  
			   /**
				 * @Display Recent posts
				 *
				 *
				 */
				if(isset($select_category) and $select_category <> ' ' and $select_category <> ''){
					$args = array( 'posts_per_page' => "$showcount",'post_type' => 'post','category_name' => "$select_category", 'ignore_sticky_posts' => 1);
				}else{
					$args = array( 'posts_per_page' => "$showcount",'post_type' => 'post', 'ignore_sticky_posts' => 1);
				}

			  $custom_query = new WP_Query($args);
			  if ( $custom_query->have_posts() <> "" ) {
				  if($thumb <> true) echo '<ul>';
				  while ( $custom_query->have_posts()) : $custom_query->the_post();
				  $post_xml = get_post_meta($post->ID, "post", true);	
				  $cs_xmlObject = new stdClass();
				  $cs_noimage = '';
				  if ( $post_xml <> "" ) {
					  $cs_xmlObject = new SimpleXMLElement($post_xml);

				  }//43
				  
				  if($thumb <> true){
						?>
						  <li>
							<!--<div class="cs-time"> <span><?php //echo date_i18n('M',strtotime(get_the_date()));?></span>
							  <time datetime="<?php //echo date_i18n('Y-m-d',strtotime(get_the_date()));?>"><?php //echo date_i18n('d',strtotime(get_the_date()));?></time>
							</div>-->
							<div class="latest-post-title">
							  <h5><a href="<?php the_permalink();?>"><?php echo substr(get_the_title(),0,27); if ( strlen(get_the_title()) > 27) echo "..."; ?></a><i class="fa fa-angle-right"></i></h5>
							  
							  <!--<ul class="post-options">
								<li><?php echo cs_category_render('', 'category', ', '); ?></li>
								<li><?php //comments_popup_link( __( 'Leave a comment', 'Awaken' ), __( '1 Comment', 'Awaken' ), __( '% Comments', 'Awaken' ) ); ?></li>
							  </ul>-->
							</div>
						  </li>
						  <?php
				  }
				  else{
				  $cs_noimage = '';
				  $width = 150;
				  $height = 150;
				  $image_id = get_post_thumbnail_id( $post->ID );
				  $image_url = cs_attachment_image_src($image_id, $width, $height);
				  if($image_id == ''){
					  $cs_noimage = ' class="cs-noimage"';	
				  }
				  ?>
                  <article<?php echo cs_allow_special_char($cs_noimage); ?>>
                    <?php 
					if($image_id <> ''){
					?>
                    <figure><a href="<?php the_permalink();?>"><img alt="<?php the_title();?>" width="70" height="70" src="<?php echo esc_url($image_url); ?>"></a></figure>
                    <?php 
					}
					?>
                    <div class="text">
                      <h6><a class="pix-colrhvr" href="<?php the_permalink();?>"><?php echo substr(get_the_title(),0,27); if ( strlen(get_the_title()) > 27) echo "..."; ?></a></h6>
                      <ul class="post-option">
                        <li>
                          <?php echo date_i18n(get_option('date_format'), strtotime(get_the_date()));?>
                        </li>
                      </ul>
                    </div>
                  </article>
                  <?php
				  }
				  
				endwhile; 
				
				 if($thumb <> true) echo '</ul>';
				
                  }
                  else {
                      if ( function_exists( 'fnc_no_result_found' ) ) { fnc_no_result_found(false); }

                  }
			    echo cs_allow_special_char($after_widget);
			  }
		  }
}
add_action( 'widgets_init', create_function('', 'return register_widget("recentposts");') );


/**
 * @Twitter Tweets widget Class
 *
 *
 */
if ( ! class_exists( 'cs_twitter_widget' ) ) { 
	class cs_twitter_widget extends WP_Widget {
		
		/**
		 * Outputs the content of the widget
		 *
		 * @param array $args
		 * @param array $instance
		 */
			 
		/**
		 * @init Twitter Module
		 *
		 *
		 */
		function cs_twitter_widget() {
			$widget_ops = array('classname' => 'twitter_widget', 'description' => 'Twitter Widget');
			$this->WP_Widget('cs_twitter_widget', 'CS : Twitter Widget', $widget_ops);
		}
		
		
		/**
		 * @Twitter html form
		 *
		 *
		 */
		 function form($instance) {
			$instance = wp_parse_args((array) $instance, array('title' => ''));
			$title = $instance['title'];
			$username = isset($instance['username']) ? esc_attr($instance['username']) : '';
			$numoftweets = isset($instance['numoftweets']) ? esc_attr($instance['numoftweets']) : '';
 		?>
            <label for="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>"> <span>Title: </span>
              <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </label>
            <label for="screen_name">User Name<span class="required">(*)</span>: </label>
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('username')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('username')); ?>" type="text" value="<?php echo esc_attr($username); ?>" />
            <label for="tweet_count">
            <span>Num of Tweets: </span>
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('numoftweets')); ?>" size="2" name="<?php echo cs_allow_special_char($this->get_field_name('numoftweets')); ?>" type="text" value="<?php echo esc_attr($numoftweets); ?>" />
            <div class="clear"></div>
            </label>
            <?php
		}
		/**
		 * @Twitter update form data 
		 *
		 *
		 */
		 function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['username'] = $new_instance['username'];
			$instance['numoftweets'] = $new_instance['numoftweets'];
			
 			return $instance;
		 }
		/**
		 * @Display Twitter widget
		 *
		 *
		 */
  		 function widget($args, $instance) {
			global $cs_theme_options;
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
			$username = $instance['username'];
 			$numoftweets = $instance['numoftweets'];		
	 		if($numoftweets == ''){$numoftweets = 2;}
			echo cs_allow_special_char($before_widget);
  			// WIDGET display CODE Start
			if (!empty($title) && $title <> ' '){
				echo cs_allow_special_char($before_title . $title . $after_title);
			}
			if(strlen($username) > 1){
					$text ='';
					$return = '';
					$cacheTime =10000;
					$transName = 'latest-tweets';
					require_once get_template_directory() . '/include/theme-components/cs-twitter/twitteroauth.php';
					
					$consumerkey = $cs_theme_options['cs_consumer_key'];
					$consumersecret = $cs_theme_options['cs_consumer_secret'];
					$accesstoken = $cs_theme_options['cs_access_token'];
					$accesstokensecret = $cs_theme_options['cs_access_token_secret'];
 					$connection = new TwitterOAuth($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
					
					$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$username."&count=".$numoftweets);
					
					if(!is_wp_error($tweets) and is_array($tweets)){
						
						set_transient($transName, $tweets, 60 * $cacheTime);
					}else{
						$tweets= get_transient('latest-tweets');
					}
					
  					if(!is_wp_error($tweets) and is_array($tweets)){
						$rand_id = rand(5, 300);
						
						$return .= "";
							foreach($tweets as $tweet) {
								$text = $tweet->{'text'};
								foreach($tweet->{'user'} as $type => $userentity) {
									if($type == 'profile_image_url') {	
										$profile_image_url = $userentity;
									} else if($type == 'screen_name'){
										$screen_name = '<a href="https://twitter.com/' . $userentity . '" target="_blank" class="colrhover" title="' . $userentity . '">@' . $userentity . '</a>';
									}
								}
								foreach($tweet->{'entities'} as $type => $entity) {
								if($type == 'urls') {						
									foreach($entity as $j => $url) {
										$display_url = '<a href="' . $url->{'url'} . '" target="_blank" title="' . $url->{'expanded_url'} . '">' . $url->{'display_url'} . '</a>';
										$update_with = 'Read more at '.$display_url;
										$text = str_replace('Read more at '.$url->{'url'}, '', $text);
										$text = str_replace($url->{'url'}, '', $text);
									}
								} else if($type == 'hashtags') {
									foreach($entity as $j => $hashtag) {
										$update_with = '<a href="https://twitter.com/search?q=%23' . $hashtag->{'text'} . '&amp;src=hash" target="_blank" title="' . $hashtag->{'text'} . '">#' . $hashtag->{'text'} . '</a>';
										$hashtag->{'text'};
										$text = str_replace('#'.$hashtag->{'text'}, $update_with, $text);
									}
								} else if($type == 'user_mentions') {
										foreach($entity as $j => $user) {
											  $update_with = '<a href="https://twitter.com/' . $user->{'screen_name'} . '" target="_blank" title="' . $user->{'name'} . '">@' . $user->{'screen_name'} . '</a>';
											  $text = str_replace('@'.$user->{'screen_name'}, $update_with, $text);
										}
									}
								} 
								$large_ts = time();
								$n = $large_ts - strtotime($tweet->{'created_at'});
								if($n < (60)){ $posted = sprintf(__('%d seconds ago','Awaken'),$n); }
								elseif($n < (60*60)) { $minutes = round($n/60); $posted = sprintf(_n('About a Minute Ago','%d Minutes Ago',$minutes,'Awaken'),$minutes); }
								elseif($n < (60*60*16)) { $hours = round($n/(60*60)); $posted = sprintf(_n('About an Hour Ago','%d Hours Ago',$hours,'Awaken'),$hours); }
								elseif($n < (60*60*24)) { $hours = round($n/(60*60)); $posted = sprintf(_n('About an Hour Ago','%d Hours Ago',$hours,'Awaken'),$hours); }
								elseif($n < (60*60*24*6.5)) { $days = round($n/(60*60*24)); $posted = sprintf(_n('About a Day Ago','%d Days Ago',$days,'Awaken'),$days); }
								elseif($n < (60*60*24*7*3.5)) { $weeks = round($n/(60*60*24*7)); $posted = sprintf(_n('About a Week Ago','%d Weeks Ago',$weeks,'Awaken'),$weeks); } 
								elseif($n < (60*60*24*7*4*11.5)) { $months = round($n/(60*60*24*7*4)) ; $posted = sprintf(_n('About a Month Ago','%d Months Ago',$months,'Awaken'),$months);}
								elseif($n >= (60*60*24*7*4*12)){$years=round($n/(60*60*24*7*52)) ; $posted = sprintf(_n('About a year Ago','%d years Ago',$years,'Awaken'),$years);}
								$return .="<article><p>";
								$return .= $text;
								$return .= "</p><div class='text'><a href='https://twitter.com/" . $username . "'><i class='fa fa-twitter'></i>".$username."</a>&nbsp;<span>" . $posted. "</span>";
								$return .= "</div></article>";
						}
					
				$return .= "";
				if(isset($profile_image_url) && $profile_image_url <> ''){$profile_image_url = '<img src="'.$profile_image_url.'" alt="">';} else {$profile_image_url = '';}
				$return .= '';
				echo cs_allow_special_char($return);

 		}else{
			if(isset($tweets->errors[0]) && $tweets->errors[0] <> ""){
				echo '<span class="bad_authentication">'.$tweets->errors[0]->message.". Please enter valid Twitter API Keys </span>";
			}else{
				echo '<span class="bad_authentication">';
					fnc_no_result_found(false);
				echo '</span>';
			}
		}
	}else{
			echo '<span class="bad_authentication">';			
				fnc_no_result_found(false);
			echo '</span>';
		}
		echo cs_allow_special_char($after_widget);
		}
 	}
}
add_action('widgets_init', create_function('', 'return register_widget("cs_twitter_widget");'));

/**
 * @Upcoming Events widget Class
 *
 *
 */
if ( ! class_exists( 'upcoming_events' ) ) { 
	class upcoming_events extends WP_Widget{
	
		/**
		 * Outputs the content of the widget
		 *
		 * @param array $args
		 * @param array $instance
		 */
			 
		/**
		 * @init Upcoming Events Module
		 *
		 *
		 */
		function upcoming_events(){
			$widget_ops = array('classname' => 'widget-topevent', 'description' => 'Select Event to show its countdown.' );
			$this->WP_Widget('upcoming_events', 'CS : Upcoming Events', $widget_ops);
		}
		 
		
		/**
		 * @Upcoming Events html form 
		 *
		 *
		 */
		function form($instance){
			$instance = wp_parse_args( (array) $instance, array( 'title' => '' ,'widget_names_events' =>'new') );
			$title = $instance['title'];
			$get_post_slug = isset( $instance['get_post_slug'] ) ? esc_attr( $instance['get_post_slug'] ) : '';
			$showcount = isset( $instance['showcount'] ) ? esc_attr( $instance['showcount'] ) : '';	
			?>
			<p>
			  <label for="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>"> Title:
				<input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			  </label>
			</p>
			<p>
			  <label for="<?php echo cs_allow_special_char($this->get_field_id('get_post_slug')); ?>"> Select Event:
				<select id="<?php echo cs_allow_special_char($this->get_field_id('get_post_slug')); ?>" name="<?php echo cs_allow_special_char($this->get_field_name('get_post_slug')); ?>" style="width:225px">
				  <option value=""> Select Category</option>
				  <?php
					global $wpdb,$post;
					$categories = get_categories('taxonomy=event-category&child_of=0&hide_empty=0'); 
					if($categories != ''){}
					foreach ( $categories as $category){
					?>
				  <option <?php if(esc_attr($get_post_slug) == $category->slug){echo 'selected';}?> value="<?php echo cs_allow_special_char($category->slug);?>" > <?php echo substr($category->name, 0, 20);	if ( strlen($category->name) > 20 ) echo "...";?> </option>
				  <?php
				  }
				  ?>
				</select>
			  </label>
			</p>
			<p>
			  <label for="<?php echo cs_allow_special_char($this->get_field_id('showcount')); ?>"> Number of Events:
				<input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('showcount')); ?>" size="2" name="<?php echo cs_allow_special_char($this->get_field_name('showcount')); ?>" type="text" value="<?php echo esc_attr($showcount); ?>" />
			  </label>
			</p>
		<?php
		}
				
		/**
		 * @Upcoming Events Update data
		 *
		 *
		 */
		 function update($new_instance, $old_instance){
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['get_post_slug'] = $new_instance['get_post_slug'];	
			$instance['showcount'] = $new_instance['showcount'];		
			return $instance;
		 }
		
		
		/**
		 * @Display Upcoming Events widget
		 *
		 *
		 */
		function widget($args, $instance){
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
			$get_post_slug = isset( $instance['get_post_slug'] ) ? esc_attr( $instance['get_post_slug'] ) : '';
			$showcount = isset( $instance['showcount'] ) ? esc_attr( $instance['showcount'] ) : '';		
			if(empty($showcount)){$showcount = '4';}
			// WIDGET display CODE Start
			echo cs_allow_special_char($before_widget);	
			wp_reset_query();
			if (!empty($title) && $title <> ' '){
					echo cs_allow_special_char($before_title . $title . $after_title);
			}
			global $wpdb, $post;
				$newterm = get_term_by('slug', $get_post_slug, 'event-category'); 
				if(isset($get_post_slug) and $get_post_slug <> ''){
					$args = array('posts_per_page' => $showcount, 'post_type'=> 'events', 'event-category' => "$get_post_slug", 'post_status' => 'publish', 'order' => 'ASC');
				}else{
					$args = array('posts_per_page' => $showcount, 'post_type'=> 'events', 'post_status' => 'publish', 'order' => 'ASC');
				}
				$custom_query = new WP_Query($args);
				if ( $custom_query->have_posts() <> "" ) {
					$cs_counter_events = 0;
					while ( $custom_query->have_posts() ): $custom_query->the_post();
						$cs_counter_events++;
						$post_meta = get_post_meta($post->ID, "events", true);
						if ( $post_meta <> "" ) {
							$cs_xmlObject = new SimpleXMLElement($post_meta);
							$cs_event_from_date = $cs_xmlObject->dynamic_post_event_from_date;
							$event_start_time = $cs_xmlObject->dynamic_post_event_start_time;
							$event_end_time = $cs_xmlObject->dynamic_post_event_end_time;
							$cs_event_loc = $cs_xmlObject->dynamic_post_location_address;
						}
						else{
							$cs_event_from_date = '';
							$event_start_time = '';
							$event_end_time = '';
							$cs_event_loc = '';
						}
				?>
                        
                        <article class="cs-events events-classic">
                          <div class="left-sp">
                            <h5><a href="<?php echo get_permalink(); ?>"><?php echo substr(get_the_title(), 0, 27); if (strlen(get_the_title()) > 27) echo "...";?></a></h5>
                            <div class="location-info">
                              <time datetime="<?php echo cs_allow_special_char($cs_event_from_date); ?>"> <?php echo date_i18n('M', strtotime($cs_event_from_date));?> <span><?php echo date_i18n('d', strtotime($cs_event_from_date));?></span> </time>
                              <div class="info">
                                <?php
								if($event_start_time <> '' || $event_end_time <> ''){
								?>
                                <div class="time-period">
                                  <time datetime="<?php echo date_i18n('Y-m-d', strtotime(get_the_date()));?>"><i class="fa fa-clock-o"></i>
                                  <?php if($event_start_time <> '') echo cs_allow_special_char($event_start_time); ?>
                                  <?php if($event_start_time <> '' and $event_end_time <> '') echo ' - '; ?>
                                  <?php if($event_end_time <> '') echo cs_allow_special_char($event_end_time); ?>
                                  </time> 
                                </div>
                                <?php
								}
								if($cs_event_loc <> ''){
								?>
                                <span><i class="fa fa-map-marker"></i><?php echo cs_allow_special_char($cs_event_loc); ?></span>
                                <?php
								}
								?>
                              </div>
                          </div>
                        </article>
                    <!-- Events Widget End -->
			<?php 
				endwhile;
			}
			else{
				fnc_no_result_found(false);
			}
			echo cs_allow_special_char($after_widget);
		}
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("upcoming_events");') );


/**
 * @Event Map widget Class
 *
 *
 */
if ( ! class_exists( 'events_map' ) ) { 
	class events_map extends WP_Widget{
	
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
		 
	/**
	 * @init Event Map Module
	 *
	 *
	 */
	 function events_map(){
		$widget_ops = array('classname' => 'widget-events-map fullwidth', 'description' => 'Select Event to show its countdown.' );
		$this->WP_Widget('events_map', 'CS : Events Map', $widget_ops);	
	 }
	 
	 /**
	 * @Event Map html form 
	 *
	 *
	 */
	 function form($instance) {
	    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ,'widget_names_events' =>'new') );
		$title = $instance['title'];
		$get_post_slug = isset( $instance['get_post_slug'] ) ? esc_attr( $instance['get_post_slug'] ) : '';
		$showcount = isset( $instance['showcount'] ) ? esc_attr( $instance['showcount'] ) : '';	
	?>
<p>
  <label for="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>"> Title:
    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo cs_allow_special_char($this->get_field_id('get_post_slug')); ?>"> Select Event:
    <select id="<?php echo cs_allow_special_char($this->get_field_id('get_post_slug')); ?>" name="<?php echo cs_allow_special_char($this->get_field_name('get_post_slug')); ?>" style="width:225px">
      <option value=""> Select Category</option>
      <?php
		global $wpdb,$post;
		$categories = get_categories('taxonomy=event-category&child_of=0&hide_empty=0'); 
		if($categories != ''){}
		foreach ( $categories as $category){ ?>
      <option <?php if(esc_attr($get_post_slug) == $category->slug){echo 'selected';}?> value="<?php echo cs_allow_special_char($category->slug);?>" > <?php echo substr($category->name, 0, 20);	if ( strlen($category->name) > 20 ) echo "...";?> </option>
      <?php }?>
    </select>
  </label>
</p>
<p>
  <label for="<?php echo cs_allow_special_char($this->get_field_id('showcount')); ?>"> Number of Events:
    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('showcount')); ?>" size="2" name="<?php echo cs_allow_special_char($this->get_field_name('showcount')); ?>" type="text" value="<?php echo esc_attr($showcount); ?>" />
  </label>
</p>
<?php
  }

 	/**
	 * @Event Map update data
	 *
	 *
	 */
	 function update($new_instance, $old_instance)
	
	  {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['get_post_slug'] = $new_instance['get_post_slug'];	
		$instance['showcount'] = $new_instance['showcount'];		
		return $instance;
	
	 }
	/**
	 * @Display Event Map widget
	 *
	 *
	 */
	 function widget($args, $instance){
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$get_post_slug = isset( $instance['get_post_slug'] ) ? esc_attr( $instance['get_post_slug'] ) : '';
		$showcount = isset( $instance['showcount'] ) ? esc_attr( $instance['showcount'] ) : '';		
		if(empty($showcount)){$showcount = '4';}
		echo cs_allow_special_char($before_widget);	
		wp_reset_query();	
		if (!empty($title) && $title <> ' '){
				echo cs_allow_special_char($before_title . $title . $after_title);
		}
			global $wpdb, $post;
 			if($get_post_slug <> ''){
				$newterm = get_term_by('slug', $get_post_slug, 'events-categories'); 
					$args = array(
						'posts_per_page'			=> $showcount,
						'post_type'					=> 'events',
						'events-categories'			=> $get_post_slug,
                        'post_status'				=> 'publish',
                        'order'						=> 'ASC'

 					);
                    $custom_query = new WP_Query($args);
					if ( $custom_query->have_posts() <> "" ) {
 						$cs_counter_events = 0;
                        while ( $custom_query->have_posts() ): $custom_query->the_post();
							$cs_counter_events++;
							$counter_first = 0;
							$post_xml = get_post_meta($post->ID, "events", true);
 							if ( $post_xml <> "" ) {
								$cs_xmlObject = new SimpleXMLElement($post_xml);
								$loc_country = $cs_xmlObject->loc_country;
								$event_loc_lat	= $cs_xmlObject->dynamic_post_location_latitude;
								$event_loc_long	= $cs_xmlObject->dynamic_post_location_longitude;
								$loc_address	= $cs_xmlObject->dynamic_post_location_address;
 							}
							$event_map_title = get_the_title();
							$map_list = '';
                        	if ($event_loc_lat <> '' && $event_loc_long <> '' && $loc_address <> '') {
								$map_list = "{pos:{lat:".$event_loc_lat.",lng:".$event_loc_long."},address:'".addslashes($loc_address).' '.addslashes($loc_country)."',title:'".addslashes($event_map_title)."'},";
							}
							if($counter_first == '0' ){
								$event_loc_lat_first = $cs_xmlObject->dynamic_post_location_latitude;
								$event_loc_long_first = $cs_xmlObject->dynamic_post_location_longitude;
								$title_first_id = get_the_title();
								$counter_first++;
							}
						endwhile;
					?>
                    <div class="cs-map-section has_map" id="gigs-area-map" style="width:300px; height:300px;">
                      <div id="map_canvas_<?php echo absint($cs_counter_events); ?>" style="width:100%;height:100%"></div>
                    </div>
                    <?php
					if($map_list <> ''){
					?>
                    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
                    <script type="text/javascript">
                        var map;
                        var markers = [];
                        var lastinfowindow;
                        var locIndex;
                        //Credit: MDN
                        if ( !Array.prototype.forEach ) {
                          Array.prototype.forEach = function(fn, scope) {
                            for(var i = 0, len = this.length; i < len; ++i) {
                              fn.call(scope, this[i], i, this);
                            }
                          }
                        }
                        /*
                        This is the data as a JS array. It could be generated by CF of course. This
                        drives the map and the div on the side.
                        */
                        var data = [ <?php echo cs_allow_special_char($map_list); ?> ];
                    //A utility function that translates a given type to an icon
                        function getIcon(type) {
                            switch(type) {
                                // case "pharmacy": return "images/map-marker.png";
                                // case "hospital": return "images/map-marker.png";
                                // case "lab": return "images/map-marker.png";
                                default: return "<?php echo cs_allow_special_char(get_template_directory_uri().'/assets/images/map-marker.png');?>";
                            }
                        }
                        //console.log(results[0].geometry.location.lat()+','+results[0].geometry.location.lng(),mapData.title);
                        function initialize() {
                            var latlng = new google.maps.LatLng(<?php echo cs_allow_special_char($event_loc_lat_first); ?>, <?php echo cs_allow_special_char($event_loc_long_first); ?>);
                            var myOptions = {
                                zoom:4,
                                center: latlng,
                                scrollwheel:true,
                                draggable:true,
                                mapTypeId: google.maps.MapTypeId.ROADMAP,
                                disableDefaultUI:false
                            };
                            map = new google.maps.Map(document.getElementById("map_canvas_<?php echo cs_allow_special_char($cs_counter_events); ?>"),myOptions);
                            geocoder = new google.maps.Geocoder();
                            data.forEach(function(mapData,idx) {
                                var marker = new google.maps.Marker({
                                    map: map, 
                                    position: new google.maps.LatLng(mapData.pos.lat,mapData.pos.lng),
                                    title: mapData.title,
                                    icon: getIcon(mapData.type)
                                });
                                var contentHtml = "<div style='width:200px;height:100px'><h3>"+mapData.title+"</h3>"+mapData.address+"</div>";
                                var infowindow = new google.maps.InfoWindow({
                                    content: contentHtml
                                });
                                google.maps.event.addListener(marker, 'click', function() {
                                  infowindow.open(map,marker);
                                });
                                 jQuery(".minict_wrapper ul li").live('click', function() {
                                      infowindow.close();
                                    });
                                marker.locid = idx+1;
                                marker.infowindow = infowindow;
                                markers[markers.length] = marker;
                                var sideHtml = '<p class="loc" data-locid="'+marker.locid+'"><b>'+mapData.title+'</b><br/>';
                                     sideHtml += mapData.address + '</p>';
                                     jQuery("#locs").append(sideHtml); 
                                //Are we all done? Not 100% sure of this
                                if(markers.length == data.length) doFilter();
                            });
                            /*
                            Run on every change to the checkboxes. If you add more checkboxes to the page,
                            we should use a class to make this more specific.
                            */
                            function doFilter() {
                                if(!locIndex) {
                                    locIndex = {};
                                    //I reverse index markers to figure out the position of loc to marker index
                                    for(var x=0, len=markers.length; x<len; x++) {
                                        locIndex[markers[x].locid] = x;
                                    }
                                }
                                var checked = jQuery(".minict_wrapper input[type^='radio']:checked");
                                var selTypes = [];
                                for(var i=0, len=checked.length; i<len; i++) {
                                    selTypes.push(jQuery(checked[i]).val());
                                }
                                for(var i=0, len=data.length; i<len; i++) {
                                    var sideDom = "p.loc[data-locid="+(i+1)+"]";
                                    //Only hide if length != 0
                                    if(checked.length !=0 && selTypes.indexOf(data[i].type) < 0) {
                                        jQuery(sideDom).hide();
                                        markers[locIndex[i+1]].setVisible(false);
                                    } else {
                                        jQuery(sideDom).show();
                                        markers[locIndex[i+1]].setVisible(true);
                                         map.panTo(markers[i].getPosition());
                                    }
                                }
                            }
                            jQuery(".select-area").on("change", "input[type^='radio']", doFilter);
                        }
                        google.maps.event.addDomListener(window, 'load', initialize);
                    </script>
                    <?php
					}
					
		}else{
			 if ( function_exists( 'fnc_no_result_found' ) ) { fnc_no_result_found(false); }
		}
	}
	echo cs_allow_special_char($after_widget);	// WIDGET display CODE End
	}
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("events_map");') );


/**
 * @Upcoming Event Calander widget Class
 *
 *
 */

if ( ! class_exists( 'upcoming_events_calander' ) ) {
	class upcoming_events_calander extends WP_Widget{
	  
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
		 
	/**
	 * @Init Upcoming Events Module
	 *
	 *
	 */
	 function upcoming_events_calander(){
		$widget_ops = array('classname' => 'event-calendar', 'description' => 'Select Event to show its Calendar.' );
		$this->WP_Widget('upcoming_events_calander', 'CS :Events Calander', $widget_ops);
	 }
	 
	 
	/**
	 * @Upcoming Events html form 
	 *
	 *
	 */
	 function form($instance){
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ,'widget_names_events' =>'new') );
		$title = $instance['title'];
		$get_post_slug = isset( $instance['get_post_slug'] ) ? esc_attr( $instance['get_post_slug'] ) : '';
		$showcount = isset( $instance['showcount'] ) ? esc_attr( $instance['showcount'] ) : '';	
		?>
        <p>
          <label for="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>"> Title:
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
          </label>
        </p>
        <p>
          <label for="<?php echo cs_allow_special_char($this->get_field_id('get_post_slug')); ?>"> Select Event:
            <select id="<?php echo cs_allow_special_char($this->get_field_id('get_post_slug')); ?>" name="<?php echo cs_allow_special_char($this->get_field_name('get_post_slug')); ?>" style="width:225px">
              <option value=""> Select Category</option>
			  <?php
            
                    global $wpdb,$post;
            
                    $categories = get_categories('taxonomy=event-category&child_of=0&hide_empty=0'); 
            
                        if($categories != ''){}
            
                            foreach ( $categories as $category){ ?>
                              <option <?php if(esc_attr($get_post_slug) == $category->slug){echo 'selected';}?> value="<?php echo stripslashes($category->slug);?>" > <?php echo substr($category->name, 0, 20);	if ( strlen($category->name) > 20 ) echo "...";?> </option>
                              <?php }?>
                            </select>
                          </label>
                        </p>
                        <p>
                          <label for="<?php echo cs_allow_special_char($this->get_field_id('showcount')); ?>"> Number of Events:
                            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('showcount')); ?>" size="2" name="<?php echo cs_allow_special_char($this->get_field_name('showcount')); ?>" type="text" value="<?php echo esc_attr($showcount); ?>" />
                          </label>
                        </p>
		<?php
		}
		
		/**
		 * @Upcoming Events update data
		 *
		 *
		 */
		 function update($new_instance, $old_instance){
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['get_post_slug'] = $new_instance['get_post_slug'];	
			$instance['showcount'] = $new_instance['showcount'];		
			return $instance;
		 }
		 
		 
		 /**
		 * @Display Upcoming Events widget
		 *
		 *
		 */
		 function widget($args, $instance){
			global $cs_theme_options;
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
			$get_post_slug = isset( $instance['get_post_slug'] ) ? esc_attr( $instance['get_post_slug'] ) : '';
			$showcount = isset( $instance['showcount'] ) ? esc_attr( $instance['showcount'] ) : '';		
			if(empty($showcount)){$showcount = '4';}
			// WIDGET display CODE Start
			echo cs_allow_special_char($before_widget);	
			if (!empty($title) && $title <> ' '){
				echo cs_allow_special_char($before_title . $title . $after_title);
			}
			global $wpdb, $post;
			$count =1;
			$seprator = ',';
			
			if( $get_post_slug <> ''){
				$args = array(
					'posts_per_page'			=> -1,
					'post_type'					=> 'events',
					'event-categories'			=> $get_post_slug,
					'post_status'				=> 'publish',
					'order'						=> 'ASC'
				);
			}else{
				$args = array(
					'posts_per_page'			=> -1,
					'post_type'					=> 'events',
					'post_status'				=> 'publish',
					'order'						=> 'ASC'
				);
			}
			
			$custom_query = new WP_Query($args);  
			$published_posts = $custom_query->post_count;
			$event_calendar = '[';
			if ( $custom_query->have_posts() <> "" ) {
				cs_eventcalendar_enqueue();
				while ( $custom_query->have_posts() ): $custom_query->the_post();
					$cs_post_meta = get_post_meta($post->ID, "events", true);
					if ( $cs_post_meta <> "" ) {
						$cs_xmlObject = new SimpleXMLElement($cs_post_meta);
						$event_from_date = $cs_xmlObject->dynamic_post_event_from_date;
						$event_from_time = $cs_xmlObject->dynamic_post_event_start_time;
					} else {
						$event_from_date = '';
						$event_from_time = '';
					}
					
					$dateformat =date('Y-m-d',strtotime($event_from_date));
					$timeformat =date('h:i',strtotime($event_from_time));
					$event_calendar .= '{"date":"'.$dateformat.' '.$timeformat.'","type":"","title":"'.get_the_title().'","description":"","url":"'.get_permalink().'"}';
					if($count != $published_posts){
						 $event_calendar .= $seprator;
					}
					$count++;
				endwhile;
				wp_reset_query();	
			}
			$event_calendar .= ']';

			?>
                <div class="g4">
                  <div id="eventCalendarLimit"></div>
                </div>
                <script>
                    jQuery(document).ready(function($) {
                        jQuery("#eventCalendarLimit").eventCalendar({
                            jsonData :<?php echo cs_allow_special_char($event_calendar); ?>,
                            jsonDateFormat: 'human',
                            txt_noEvents:'<?php _e('No results found.','Awaken'); ?>',
                            eventsLimit:<?php echo cs_allow_special_char($showcount);?>
                        });
                    });
                </script>
			<?php
                    echo cs_allow_special_char($after_widget);	// WIDGET display CODE End
                }
            }
}	
add_action( 'widgets_init', create_function('', 'return register_widget("upcoming_events_calander");') );


/**
 * @User(s) list widget Class
 *
 *
 */
if ( ! class_exists( 'cs_userlist' ) ) {
	class cs_userlist extends WP_Widget {		
	
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
		 
	/**
	 * @init User list Module
	 *
	 *
	 */
	 function cs_userlist() {
		$widget_ops = array('classname' => 'widget_userlist', 'description' => 'Select user list to show in widget.');
		$this->WP_Widget('cs_userlist', 'CS : User List', $widget_ops);
	 }
	
	/**
	 * @User list html form
	 *
	 *
	 */
	 function form($instance) {
		$instance = wp_parse_args((array) $instance, array('title' => '', 'get_username' => 'new'));
		$title = $instance['title'];
		$get_username = esc_sql($instance['get_username']);
		?>
<p>
  <label for="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>"> Title:
    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo cs_allow_special_char($this->get_field_id('get_username')); ?>">Select Users:</label>
  <?php 
			$args = array(
				'role'         => '',
				'meta_key'     => '',
				'meta_value'   => '',
				'meta_compare' => '',
				'meta_query'   => array(),
				'include'      => array(),
				'exclude'      => array(),
				'orderby'      => 'login',
				'order'        => 'ASC',
				'offset'       => '',
				'search'       => '',
				'number'       => '',
				'count_total'  => false,
				'fields'       => 'all',
				'who'          => ''
			 );
			$userlist = get_users( $args );
           ?>
</p>
<p>
  <?php
  if($get_username == '' || !(is_array($get_username))){
      $get_username = array();
  }
  ?>
  <select id="<?php echo cs_allow_special_char($this->get_field_id('get_username')); ?>" name="<?php echo cs_allow_special_char($this->get_field_name('get_username'));?>[]" style="width:225px;" multiple="multiple">
    <?php foreach($userlist as $user){?>
   		<option value="<?php echo absint($user->ID);?>" <?php if(in_array($user->ID,$get_username)){ echo 'selected';}?>> <?php echo cs_allow_special_char( $user->display_name);?> </option>
    <?php } ?>
  </select>
</p>
<?php
 		}
		
		
		/**
		 * @User list update data
		 *
		 *
		 */
		 function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['get_username'] = esc_sql($new_instance['get_username']);
  			return $instance;
		 }
		/**
		 * @Display User list widget
		 *
		 *
		 */
		 function widget($args, $instance) {
			extract($args, EXTR_SKIP);
			global $wpdb, $post,$cs_theme_options;
			$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
			$get_username = $instance['get_username'];
			// WIDGET display CODE Start
			echo cs_allow_special_char($before_widget);
			$cs_page_id = $cs_theme_options['cs_dashboard'];
 			if (strlen($title) <> 1 || strlen($title) <> 0) {
 				echo cs_allow_special_char($before_title . $title . $after_title);
 			}
  			if ($get_username <> '') {
  				foreach($get_username as $userid){
 					$user_info = get_userdata($userid);
					$username = $user_info->display_name;
 					$user_email = $user_info->user_email;
					$role = $user_info->roles;
					$usermeta =get_user_meta($userid);
  					if(isset($usermeta['tagline']) and $usermeta['tagline'] <> ''){
						$tagline = substr($usermeta['tagline'],0,20);
					} else { 
						$tagline = '';
					}
					echo '<div class="cs-user-info">';  
 								if(isset($usermeta['user_avatar_display']) and $usermeta['user_avatar_display'] <> ''){
									echo '<figure><img src="'.$usermeta['user_avatar_display'].'" width="58" height="58" alt="'.$usermeta['tagline'].'"></figure>';
								}else{
									echo '<figure>'.get_avatar($user_email, apply_filters('PixFill_author_bio_avatar_size', 58)).'</figure>';	
								}
							echo '<div class="cs-widget-info">
								<a href="'.get_permalink($cs_page_id).'/?action=dashboard&amp;uid='.$userid.'">'.$username.'</a>
								<span>'.$tagline.'</span>
 								<ul>';
									if(isset($usermeta['facebook']) and $usermeta['facebook']<>''){
										echo '<li><a href="'.$usermeta['facebook'].'"><i class="fa fa-facebook"></i></a></li>';
									}
									if(isset($usermeta['twitter']) and $usermeta['twitter']<>''){
										echo '<li><a href="'.$usermeta['twitter'].'"><i class="fa fa-twitter"></i></a></li>';
									}
									if(isset($usermeta['linkedin']) and $usermeta['linkedin']<>''){
										echo '<li><a href="'.$usermeta['linkedin'].'"><i class="fa fa-linkedin"></i></a></li>';
									}
									if(isset($usermeta['lastfm']) and $usermeta['lastfm']<>''){
										echo '<li><a href="'.$usermeta['lastfm'].'"><i class="fa fa-google-plus"></i></a></li>';
									}
									if(isset($usermeta['evernote']) and $usermeta['evernote']<>''){
										echo '<li><a href="'.$usermeta['evernote'].'"><i class="fa fa-exchange"></i></a></li>';
									}
							echo '</ul></div></div>';
					}
 				}else{
 					fnc_no_result_found(false);
			 }   
 			echo cs_allow_special_char($after_widget); 
		}
	}
}
add_action('widgets_init', create_function('', 'return register_widget("cs_userlist");'));


/**
 * @Contact Us widget Class
 *
 *
 */
class contactinfo extends WP_Widget{
	
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
		 
	/**
	 * @init Contact Info Module
	 *
	 *
	 */
	 
	function contactinfo()	{
		$widget_ops = array('classname' => 'widget_text', 'description' => 'Fotter Contact Information.' );
		$this->WP_Widget('contactinfo', 'CS : Contact info', $widget_ops);
	}
	
	/**
	 * @Contact Info html form
	 *
	 *
	 */
	function form($instance){
		$instance = wp_parse_args( (array) $instance );
		$image_url 	= isset( $instance['image_url'] ) ? esc_attr( $instance['image_url'] ) : '';	
		$address 	= isset( $instance['address'] ) ? esc_attr( $instance['address'] ) : '';	
		$phone 		= isset( $instance['phone'] ) ? esc_attr( $instance['phone'] ) : '';
		$fax 		= isset( $instance['fax'] ) ? esc_attr( $instance['fax'] ) : '';	
		$email 		= isset( $instance['email'] ) ? esc_attr( $instance['email'] ) : '';
		$randomID   = rand(40, 9999999);
 	?>
    <ul class="form-elements-widget">
      <li class="to-label" style="margin-top:20px;">
        <label>Image</label>
      </li>
      <li class="to-field">
        <input id="form-widget_cs_widget_logo<?php echo absint($randomID)?>" name="<?php echo cs_allow_special_char($this->get_field_name('image_url')); ?>" type="hidden" class="" value="<?php echo esc_url($image_url); ?>"/>
        <label class="browse-icon" style="width:100%;">
        <input name="form-widget_cs_widget_logo<?php echo absint($randomID)?>"  type="button" class="uploadMedia left" value="Browse"/>
        </label>
      </li>
    </ul>
    <div class="page-wrap"  id="form-widget_cs_widget_logo<?php echo absint($randomID);?>_box" style="margin-top:10px; margin-bottom:10px; float:left; overflow:hidden; display:<?php echo cs_allow_special_char($image_url)&& cs_allow_special_char($image_url) !='' ? 'inline' : 'none';?>">
      <div class="gal-active">
        <div class="dragareamain" style="padding-bottom:0px;">
          <ul id="gal-sortable" style="margin-bottom:0px;">
            <li class="ui-state-default" style="margin:6px">
              <div class="thumb-secs"> <img src="<?php echo cs_allow_special_char($image_url); ?>"  id="form-widget_cs_widget_logo<?php echo absint($randomID);?>_img" style="max-height:80px; max-width:180px"  />
                <div class="gal-edit-opts"> <a   href="javascript:del_media('cs_widget_logo<?php echo absint($randomID)?>')" class="delete"></a> </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
            
	<p style="margin-top:0px; float:left;">
		<label for="<?php echo cs_allow_special_char($this->get_field_id('address')); ?>"> Address:<br />
			<textarea cols="20" rows="5" id="<?php echo cs_allow_special_char($this->get_field_id('address')); ?>" name="<?php echo cs_allow_special_char($this->get_field_name('address')); ?>" style="width:315px"><?php echo esc_attr($address); ?></textarea>
		</label>
	</p>
	
    <p style="margin-top:0px; float:left;">
        <label for="<?php echo cs_allow_special_char($this->get_field_id('email')); ?>"> Email:<br />
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('email')); ?>" size="40" 
            name="<?php echo cs_allow_special_char($this->get_field_name('email')); ?>" type="text" value="<?php echo esc_attr($email); ?>" />
        </label>
    </p>
	
	<p style="margin-top:0px; float:left;">
		<label for="<?php echo cs_allow_special_char($this->get_field_id('phone')); ?>"> Phone #:<br />
			<input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('phone')); ?>" size="40"
            name="<?php echo cs_allow_special_char($this->get_field_name('phone')); ?>" type="text" value="<?php echo esc_attr($phone); ?>" />
		</label>
     </p>
     
     <p style="margin-top:0px; float:left;">
        <label for="<?php echo cs_allow_special_char($this->get_field_id('fax')); ?>"> Fax #:<br />
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('fax')); ?>" size="40" 
            name="<?php echo cs_allow_special_char( $this->get_field_name('fax')); ?>" type="text" value="<?php echo esc_attr($fax); ?>" />
        </label>
    </p>
    
	<?php
	}
	
	/**
	 * @Update Info html form
	 *
	 *
	 */
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['image_url'] = $new_instance['image_url'];
		$instance['address']   = $new_instance['address'];
		$instance['phone']     = $new_instance['phone'];
		$instance['fax']    = $new_instance['fax'];
		$instance['email']     = $new_instance['email'];
 		return $instance;
	}
	
	/**
	 * @Widget Info html form
	 *
	 *
	 */
	function widget($args, $instance){
		global $px_node;
		extract($args, EXTR_SKIP);
		$image_url = empty($instance['image_url']) ? '' : apply_filters('widget_title', $instance['image_url']);
		$address = empty($instance['address']) ? '' : apply_filters('widget_title', $instance['address']);		
		$phone = empty($instance['phone']) ? '' : apply_filters('widget_title', $instance['phone']);
		$fax = empty($instance['fax']) ? '' : apply_filters('widget_title', $instance['fax']);
		$email = empty($instance['email']) ? '' : apply_filters('widget_title', $instance['email']);
		echo cs_allow_special_char($before_widget);	
		if ( isset ( $image_url ) && $image_url != '' ) {
			echo '<div class="logo"><a href="'.esc_url( home_url() ).'"><img src="'.$image_url.'" alt="" /></a></div>';
		}
         
			echo '<ul class="group">';
			if(isset($address) and $address<>''){
				echo '<li>'.do_shortcode(htmlspecialchars_decode($address)).'</li>';
			}
			if(isset($phone) and $phone<>''){
				echo '<li>'.htmlspecialchars_decode($phone).'</li>';
			}
			if(isset($fax) and $fax<>''){
				echo '<li>'.htmlspecialchars_decode($fax).'</li>';
			}
			if(isset($email) and $email<>''){
				echo '<li>'.htmlspecialchars_decode($email).'</li>';
			}
			echo '</ul>';
			

    echo cs_allow_special_char($after_widget);
	}
}
add_action('widgets_init', create_function('', 'return register_widget("contactinfo");'));

/**
 * @Projects widget Class
 *
 *
 */
if ( ! class_exists( 'cs_recent_projects' ) ) { 
	class cs_recent_projects extends WP_Widget {	
	
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
		 
	/**
	 * @init Projects Module
	 *
	 *
	 */
	 function cs_recent_projects() {
		$widget_ops = array('classname' => 'widget-projects', 'description' => 'Select a category to show Projects in widget.');
		$this->WP_Widget('cs_recent_projects', 'CS : Projects', $widget_ops);
	 }
	 
	 /**
	 * @Projects html form
	 *
	 *
	 */
	 function form($instance){
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];
		$select_category = isset( $instance['select_category'] ) ? esc_attr( $instance['select_category'] ) : '';
		$showcount = isset( $instance['showcount'] ) ? esc_attr( $instance['showcount'] ) : '';	
	?>
    <p>
      <label for="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>"> Title:
        <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
      </label>
    </p>
    <p>
      <label for="<?php echo cs_allow_special_char($this->get_field_id('select_category')); ?>"> Select Category:
        <select id="<?php echo cs_allow_special_char($this->get_field_id('select_category')); ?>" name="<?php echo cs_allow_special_char($this->get_field_name('select_category')); ?>" style="width:225px">
          <option value="" >All</option>
          <?php
                        $categories = get_categories('taxonomy=project-categories&child_of=0&hide_empty=0');
                        if($categories <> ""){
                            foreach ( $categories as $category ) {?>
                              <option <?php if($select_category == $category->slug){echo 'selected';}?> value="<?php echo cs_allow_special_char($category->slug);?>" ><?php echo cs_allow_special_char($category->name);?></option>
                            <?php 
                            }
                        }?>
        </select>
      </label>
    </p>
    <p>
      <label for="<?php echo cs_allow_special_char($this->get_field_id('showcount')); ?>"> Number of Projects To Display:
        <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('showcount')); ?>" size='2' name="<?php echo cs_allow_special_char($this->get_field_name('showcount')); ?>" type="text" value="<?php echo esc_attr($showcount); ?>" />
      </label>
    </p>
    <?php
        }
		
		/**
		 * @Projects update form data
		 *
		 *
		 */
		 function update($new_instance, $old_instance){
			  $instance = $old_instance;
			  $instance['title'] = $new_instance['title'];
			  $instance['select_category'] = $new_instance['select_category'];
			  $instance['showcount'] = $new_instance['showcount'];
			
			  return $instance;
		 }

		 /**
		 * @Display Projects widget
		 *
		 *
		 */
		 function widget($args, $instance){
			  global $cs_node;
		
			  extract($args, EXTR_SKIP);
			  $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
			  $select_category = empty($instance['select_category']) ? ' ' : apply_filters('widget_title', $instance['select_category']);			
			  $showcount = empty($instance['showcount']) ? ' ' : apply_filters('widget_title', $instance['showcount']);	
			  if($instance['showcount'] == ""){$instance['showcount'] = '-1';}
		
			  echo cs_allow_special_char($before_widget);	
		
			  if (!empty($title) && $title <> ' '){
				  echo cs_allow_special_char($before_title);
				  echo cs_allow_special_char($title);
				  echo cs_allow_special_char($after_title);
			  }
		
		global $wpdb, $post;?>
<?php
			  wp_reset_query();
			  
			   /**
				 * @Display Projects
				 *
				 *
				 */
				if(isset($select_category) and $select_category <> ' ' and $select_category <> ''){
					$args = array( 'posts_per_page' => "$showcount",
								   'post_type' => 'project',
								   'tax_query' => array(
													array(
														'taxonomy' => 'project-categories',
														'field'    => 'slug',
														'terms'    => "$select_category"
													)
									)
							);
				}else{
					$args = array( 'posts_per_page' => "$showcount",'post_type' => 'project');
				}

			  $custom_query = new WP_Query($args);
			  if ( $custom_query->have_posts() <> "" ) {
				  while ( $custom_query->have_posts()) : $custom_query->the_post();
				  $post_xml = get_post_meta($post->ID, "project", true);	
				  $cs_xmlObject = new stdClass();
				  $cs_noimage = '';
				  if ( $post_xml <> "" ) {
					  $cs_xmlObject = new SimpleXMLElement($post_xml);

				  }//43
				  
				  $cs_noimage = '';
				  $width = 150;
				  $height = 150;
				  $image_id = get_post_thumbnail_id( $post->ID );
				  $image_url = cs_attachment_image_src($image_id, $width, $height);
				  if($image_id == ''){
					  $cs_noimage = ' no-image';	
				  }
				?>
                
                <article class="cs-listing list-view<?php echo cs_allow_special_char($cs_noimage); ?>">
                  <?php
				  if($image_id <> ''){
				  ?>
                  <figure><img alt="<?php the_title();?>" width="90" height="90" src="<?php echo esc_url($image_url); ?>"></figure>
                  <?php
				  }
				  $cs_project = get_post_meta($post->ID, "csprojects", true);
				  if ( $cs_project <> "" ) {
					  $cs_xmlObject = new SimpleXMLElement($cs_project);
					  $cs_project_style = $cs_xmlObject->cs_project_style;
				  } else {
					  $cs_project_style = 'grey';
				  }
				  ?>
                  <div class="text" style="background-color: <?php echo cs_allow_special_char($cs_project_style); ?>;">
                    <div class="list-heading">
                      <h2><a href="<?php the_permalink();?>"><?php echo substr(get_the_title(),0,25); if ( strlen(get_the_title()) > 25) echo "..."; ?></a></h2>
                      <ul class="post-option">
                      <li>
                        <i class="fa fa-folder-o"></i><?php echo date_i18n(get_option('date_format'), strtotime(get_the_date())); ?>
                      </li>
                    </ul>
                    </div>
                  </div>
                </article>
				<?php 
				
				endwhile;
				
				}
				else {
					if ( function_exists( 'fnc_no_result_found' ) ) { fnc_no_result_found(false); }

				}
				echo cs_allow_special_char($after_widget);
			  }
		  }
}
add_action('widgets_init', create_function('', 'return register_widget("cs_recent_projects");'));

/**
 * @Sermons widget Class
 *
 *
 */
if ( ! class_exists( 'cs_sermons' ) ) { 
	class cs_sermons extends WP_Widget {	
	
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
		 
	/**
	 * @init Sermons Module
	 *
	 *
	 */
	 function cs_sermons() {
		$widget_ops = array('classname' => 'widget-sermon cs-sermons', 'description' => 'Select a category to show in widget.');
		$this->WP_Widget('cs_sermons', 'CS : Sermons', $widget_ops);
	 }
	 
	 /**
	 * @Sermons html form
	 *
	 *
	 */
	 function form($instance){
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];
		$select_category = isset( $instance['select_category'] ) ? esc_attr( $instance['select_category'] ) : '';
		$showcount = isset( $instance['showcount'] ) ? esc_attr( $instance['showcount'] ) : '';	
	?>
    <p>
      <label for="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>"> Title:
        <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
      </label>
    </p>
    <p>
      <label for="<?php echo cs_allow_special_char($this->get_field_id('select_category')); ?>"> Select Category:
        <select id="<?php echo cs_allow_special_char($this->get_field_id('select_category')); ?>" name="<?php echo cs_allow_special_char($this->get_field_name('select_category')); ?>" style="width:225px">
          <option value="" >All</option>
          <?php
			$categories = get_categories('taxonomy=sermon-category&child_of=0&hide_empty=0');
			if($categories <> ""){
				foreach ( $categories as $category ) {?>
				  <option <?php if($select_category == $category->slug){echo 'selected';}?> value="<?php echo cs_allow_special_char($category->slug);?>" ><?php echo cs_allow_special_char($category->name);?></option>
				<?php 
				}
			}?>
        </select>
      </label>
    </p>
    <p>
      <label for="<?php echo cs_allow_special_char($this->get_field_id('showcount')); ?>"> Number of Sermons To Display:
        <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('showcount')); ?>" size='2' name="<?php echo cs_allow_special_char($this->get_field_name('showcount')); ?>" type="text" value="<?php echo esc_attr($showcount); ?>" />
      </label>
    </p>
    <?php
        }
		
		/**
		 * @Sermons update form data
		 *
		 *
		 */
		 function update($new_instance, $old_instance){
			  $instance = $old_instance;
			  $instance['title'] = $new_instance['title'];
			  $instance['select_category'] = $new_instance['select_category'];
			  $instance['showcount'] = $new_instance['showcount'];
			
			  return $instance;
		 }

		 /**
		 * @Display Causes widget
		 *
		 *
		 */
		 function widget($args, $instance){
			  global $cs_node;
		
			  extract($args, EXTR_SKIP);
			  $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
			  $select_category = empty($instance['select_category']) ? ' ' : apply_filters('widget_title', $instance['select_category']);			
			  $showcount = empty($instance['showcount']) ? ' ' : apply_filters('widget_title', $instance['showcount']);	
			  if($instance['showcount'] == ""){$instance['showcount'] = '-1';}
		
			  echo cs_allow_special_char($before_widget);	
		
			  if (!empty($title) && $title <> ' '){
				  echo cs_allow_special_char($before_title);
				  echo cs_allow_special_char($title);
				  echo cs_allow_special_char($after_title);
			  }
		
		global $wpdb, $post;?>
<?php
			  wp_reset_query();
			  
			   /**
				 * @Display Recent posts
				 *
				 *
				 */
				if(isset($select_category) and $select_category <> ' ' and $select_category <> ''){
					$args = array( 'posts_per_page' => "$showcount",
								   'post_type' => 'sermons',
								   'tax_query' => array(
													array(
														'taxonomy' => 'sermon-category',
														'field'    => 'slug',
														'terms'    => "$select_category"
													)
									)
							);
				}else{
					$args = array( 'posts_per_page' => "$showcount",'post_type' => 'sermons');
				}

			  $custom_query = new WP_Query($args);
			  if ( $custom_query->have_posts() <> "" ) {
				  
				  while ( $custom_query->have_posts()) : $custom_query->the_post();
				  $cs_sermons = get_post_meta(get_the_id(), "sermons", true);
				  if ( $cs_sermons <> "" ) {
					  $cs_xmlObject = new SimpleXMLElement($cs_sermons);
					  $cs_post_social_sharing = isset($cs_xmlObject->post_social_sharing)?$cs_xmlObject->post_social_sharing:'';
					  $sermon_audio_download_link = isset($cs_xmlObject->sermon_audio_download_link)?$cs_xmlObject->sermon_audio_download_link:'';
					  $sermon_notes_link = isset($cs_xmlObject->sermon_notes_link)?$cs_xmlObject->sermon_notes_link:'';
					  $sermon_audio_url='';
					  if(isset($cs_xmlObject->sermons) && count($cs_xmlObject->sermons)){
							foreach ( $cs_xmlObject->sermons as $transct ){
									$sermon_audio_url = $transct->sermon_file_url;
									break;
							}
						}
					  
				  }else{
					  $sermon_audio_url = $sermon_audio_download_link = $sermon_notes_link = $cs_post_social_sharing = '';
				  }
				  
				  $cs_noimage = '';
				  $width = 150;
				  $height = 150;
				  $image_id = get_post_thumbnail_id( $post->ID );
				  $image_url = cs_attachment_image_src($image_id, $width, $height);
				  if($image_id == ''){
					  $cs_noimage = ' class="no-image"';	
				  }
				?>
                <article<?php echo cs_allow_special_char($cs_noimage); ?>>
                  <?php
				  if($image_id <> ''){
				  ?>
                  <figure><a href="<?php echo the_permalink(); ?>"><img alt="<?php the_title();?>" width="70" height="70" src="<?php echo esc_url($image_url); ?>"></a></figure>
                  <?php
				  }
				  ?>
                  <div class="text">
                    <h5><a href="<?php the_permalink();?>"><?php echo substr(get_the_title(),0,20); if ( strlen(get_the_title()) > 20) echo "..."; ?></a></h5>
                    <ul class="post-option">
                      <li>
                        <i class="fa fa-building-o"></i><?php echo date_i18n(get_option('date_format'), strtotime(get_the_date()));?>
                      </li>
                    </ul>
                    <ul class="socialmedia">
                      <?php
					  if($sermon_audio_url <> ''){
					  ?>
                      		<li>
                            	<audio class="cs-audio-skin">
                                	<source src="<?php echo esc_url($sermon_audio_url); ?>" >
                           		</audio>
                            </li>
                      <?php
					  	echo cs_sermon_audio_player();
					  }
					  if($sermon_audio_download_link <> ''){ ?>
									<li><a href="<?php echo esc_url($sermon_audio_download_link); ?>" class="btn-style2"><i class="fa fa-download"></i></a></li>
                      <?php
					  		}
					  if($sermon_notes_link <> ''){
					  ?>
                      <li><a href="<?php echo esc_url($sermon_notes_link); ?>"><i class="fa fa-file-pdf-o"></i></a></li>
                      <?php
					  }
					  if($cs_post_social_sharing == 'on'){
					  cs_addthis_script_init_method();
					  ?>
                      <li><a href="#" class="btnshare addthis_button_compact"><i class="fa fa-share-alt "></i></a></li>
                      <?php
					  }
					  ?>
                    </ul>
                  </div>
                </article>
				<?php 
				
				endwhile;
				
			  }
			  else {
				  if ( function_exists( 'fnc_no_result_found' ) ) { fnc_no_result_found(false); }
			
			  }
			  echo cs_allow_special_char($after_widget);
			}
		}
}
add_action('widgets_init', create_function('', 'return register_widget("cs_sermons");'));

/**
 * @Causes widget Class
 *
 *
 */
if ( ! class_exists( 'cs_causes' ) ) { 
	class cs_causes extends WP_Widget {	
	
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
		 
	/**
	 * @init Causes Module
	 *
	 *
	 */
	 function cs_causes() {
		$widget_ops = array('classname' => 'widget-causes', 'description' => 'Select a category to show in widget.');
		$this->WP_Widget('cs_causes', 'CS : Causes', $widget_ops);
	 }
	 
	 /**
	 * @Causes html form
	 *
	 *
	 */
	function form($instance){
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];
		$select_category = isset( $instance['select_category'] ) ? esc_attr( $instance['select_category'] ) : '';
		$showcount = isset( $instance['showcount'] ) ? esc_attr( $instance['showcount'] ) : '';	
	?>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"> Title:
            <input class="upcoming" id="<?php echo esc_attr($this->get_field_id('title')); ?>" size="40" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
          </label>
        </p>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('select_category')); ?>"> Select Category:
            <select id="<?php echo esc_attr($this->get_field_id('select_category')); ?>" name="<?php echo esc_attr($this->get_field_name('select_category')); ?>" style="width:225px">
              <option value="" >All</option>
              <?php
					$categories = get_categories('taxonomy=causes-category&child_of=0&hide_empty=0');
					if($categories <> ""){
						foreach ( $categories as $category ) {?>
						  <option <?php if($select_category == $category->slug){echo 'selected';}?> value="<?php echo esc_attr($category->slug);?>" ><?php echo esc_attr($category->name);?></option>
						<?php 
						}
					}?>
            </select>
          </label>
        </p>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('showcount')); ?>"> Number of Causes To Display:
            <input class="upcoming" id="<?php echo esc_attr($this->get_field_id('showcount')); ?>" size='2' name="<?php echo esc_attr($this->get_field_name('showcount')); ?>" type="text" value="<?php echo intval($showcount); ?>" />
          </label>
        </p>
        <?php
        }
		
		/**
		 * @Causes update form data
		 *
		 *
		 */
		 function update($new_instance, $old_instance){
			  $instance = $old_instance;
			  $instance['title'] = $new_instance['title'];
			  $instance['select_category'] = $new_instance['select_category'];
			  $instance['showcount'] = $new_instance['showcount'];
			
			  return $instance;
		 }

		 /**
		 * @Display Causes widget
		 *
		 *
		 */
		 function widget($args, $instance){
			global $cs_node;
			
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
			$select_category = empty($instance['select_category']) ? ' ' : apply_filters('widget_title', $instance['select_category']);			
			$showcount = empty($instance['showcount']) ? ' ' : apply_filters('widget_title', $instance['showcount']);	
			if($instance['showcount'] == ""){$instance['showcount'] = '-1';}
			
			echo cs_allow_special_char($before_widget);	
			
			if (!empty($title) && $title <> ' '){
			  echo cs_allow_special_char($before_title);
			  echo cs_allow_special_char($title);
			  echo cs_allow_special_char($after_title);
			}
			
			global $wpdb, $post;?>
			<?php
			  wp_reset_query();
			  
			   /**
				 * @Display Recent posts
				 *
				 *
				 */
				if(isset($select_category) and $select_category <> ' ' and $select_category <> ''){
					$args = array( 'posts_per_page' => "$showcount",
								   'post_type' => 'causes',
								   'meta_key' => 'cs_cause_percentage_amount',
								   'orderby' => 'meta_value_num',
								   'order' => 'DESC',
								   'tax_query' => array(
													array(
														'taxonomy' => 'causes-category',
														'field'    => 'slug',
														'terms'    => "$select_category"
													)
									)
							);
							
				}else{
					$args = array( 'posts_per_page' => "$showcount",'post_type' => 'causes');
				}

			  $custom_query = new WP_Query($args);
			  if ( $custom_query->have_posts() <> "" ) {
				  
				  $cs_theme_options = get_option('cs_theme_options');
				  $paypal_currency_sign = isset($cs_theme_options['paypal_currency_sign'])?$cs_theme_options['paypal_currency_sign']:'$';	
				  
				  while ( $custom_query->have_posts()) : $custom_query->the_post();
				  
				  $cs_cause = get_post_meta($post->ID, "cs_cause_meta", true);
				  
				  
				 if ( $cs_cause <> "" ) {
					  $cs_xmlObject = new SimpleXMLElement($cs_cause);
					  $cause_goal_amount = ($cs_xmlObject->cause_goal_amount<>'' )? $cs_xmlObject->cause_goal_amount:0;
					  $cause_end_date = isset($cs_xmlObject->cause_end_date)?strtotime($cs_xmlObject->cause_end_date):strtotime(get_the_date());
				  }else{
					  $cause_goal_amount = $cause_end_date ='';
				  }
				  
				  $goal_percent= 0;
				  $payment_gross_total = 0;
				  $cause_raised_amount = get_post_meta($post->ID, "cs_cause_raised_amount", true);
				  $cause_raised_amount = ($cause_raised_amount<>'')?$cause_raised_amount:0;
				
				  if($cause_goal_amount<>0 and $cause_goal_amount<> ''){
					  $goal_percent = get_post_meta($post->ID, "cs_cause_percentage_amount", true).'%';
				  }
				  
				  $cs_noimage = '';
				  $width = 150;
				  $height = 150;
				  $image_id = get_post_thumbnail_id( $post->ID );
				  $image_url = cs_attachment_image_src($image_id, $width, $height);
				  if($image_id == ''){
					  $cs_noimage = ' no-image';	
				  }
				?>
                 <script type="text/javascript">
						  jQuery(document).ready(function(){
						cs_progress_bar();
						  });
					</script>
                <article class="cs-causes<?php echo esc_attr($cs_noimage); ?>">
                  <?php
				  if($image_id <> ''){
				  ?>
                  <figure><a href="<?php the_permalink(); ?>"><img alt="<?php the_title(); ?>" width="70" height="70" src="<?php echo esc_url($image_url); ?>"></a></figure>
                  <?php
				  }
				  ?>
                  <section>
                    <h2> <a href="<?php the_permalink();?>"><?php echo substr(get_the_title(),0,20); if ( strlen(get_the_title()) > 20) echo "..."; ?></a> </h2>
                    <ul class="post-option">
                      <li>
                        <?php echo date_i18n(get_option('date_format'), $cause_end_date);?>
                      </li>
                    </ul>
                    <div class="skills-sec">
                      <div class="cs-progres-bar">
                        <div class="cs-amount"> <span class="raised-amount"><?php echo cs_validate($paypal_currency_sign.number_format(absint($cause_raised_amount))); _e(' Raised','Awaken');?></span> <span class="goal-amount"><?php _e('Goal ','Awaken'); echo cs_validate($paypal_currency_sign.number_format(absint($cause_goal_amount)));?></span> </div>
                        <div class="cs-skillbar">
                          <div class="skillbar" data-percent="<?php echo cs_validate($goal_percent);?>">
                            <div class="skillbar-bar" ></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                </article>
				<?php 
				
				endwhile;
				
				  }
				  else {
					  if ( function_exists( 'fnc_no_result_found' ) ) { fnc_no_result_found(false); }

				  }
				  echo cs_allow_special_char($after_widget);
			  }
		  }
}
add_action('widgets_init', create_function('', 'return register_widget("cs_causes");'));

/**
 * @Contact form widget Class
 *
 *
 */
if ( ! class_exists( 'cs_contact_msg' ) ) { 
	class cs_contact_msg extends WP_Widget {	
	
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
		 
	/**
	 * @init Contact Module
	 *
	 *
	 */
	 function cs_contact_msg() {
		$widget_ops = array('classname' => 'widget-form', 'description' => 'Select contact form to show in widget.');
		$this->WP_Widget('cs_contact_msg', 'CS : Contact Form', $widget_ops);
	 }
	 
	 /**
	 * @Contact html form
	 *
	 *
	 */
	 function form($instance) {
		$instance = wp_parse_args((array) $instance, array('title' => '' ));
		$title = $instance['title'];
		$contact_email = isset($instance['contact_email']) ? esc_attr($instance['contact_email']) : '';
		$contact_succ_msg = isset($instance['contact_succ_msg']) ? esc_attr($instance['contact_succ_msg']) : '';
		?>
        <p>
          <label for="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>"> Title:
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
          </label>
        </p>
        
        <p>
          <label for="<?php echo cs_allow_special_char($this->get_field_id('contact_email')); ?>"> Contact Email:
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('contact_email')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('contact_email')); ?>" type="text" value="<?php echo esc_attr($contact_email); ?>" />
          </label>
        </p>
        
        <p>
          <label for="<?php echo cs_allow_special_char($this->get_field_id('contact_succ_msg')); ?>"> Success Message:
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('contact_succ_msg')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('contact_succ_msg')); ?>" type="text" value="<?php echo esc_attr($contact_succ_msg); ?>" />
          </label>
        </p>
        

<?php
 		}
		
		/**
		 * @Contact Update form data
		 *
		 *
		 */
		 function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['contact_email'] = $new_instance['contact_email'];
			$instance['contact_succ_msg'] = $new_instance['contact_succ_msg'];
			
   			return $instance;
		}
		
		/**
		 * @Display Contact widget
		 *
		 *
		 */
		function widget($args, $instance) {
			extract($args, EXTR_SKIP);
			global $wpdb, $post;
			$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
			$contact_email = isset($instance['contact_email']) ? esc_attr($instance['contact_email']) : '';
			$contact_succ_msg = isset($instance['contact_succ_msg']) ? esc_attr($instance['contact_succ_msg']) : '';
			
			// WIDGET display CODE Start
			echo cs_allow_special_char($before_widget);
			if (strlen($title) <> 1 || strlen($title) <> 0) {
				echo cs_allow_special_char($before_title . $title . $after_title);
			}
			
			
            $msg_form_counter = rand(1, 999); 
			if ( function_exists( 'cs_enqueue_validation_script' ) ) { cs_enqueue_validation_script(); }
			$error	= __('An error Occured, please try again later.', 'Awaken');
			?>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					var container = $('');
					var validator = jQuery("#frm<?php echo absint($msg_form_counter)?>").validate({
						messages:{
							contact_name: '',
							contact_email:{
								required: '',
								email:'',
							},
							subject: {
								required:'',
							},
							contact_msg: '',
						},
						errorContainer: container,
						errorLabelContainer: jQuery(container),
						errorElement:'div',
						errorClass:'frm_error',
						meta: "validate"
					});
				});
				function frm_submit<?php echo cs_allow_special_char($msg_form_counter)?>(){
					var $ = jQuery;
					$("#submit_btn<?php echo cs_allow_special_char($msg_form_counter) ?>").hide();
					$("#loading_div<?php echo cs_allow_special_char($msg_form_counter) ?>").html('<img src="<?php echo esc_js(get_template_directory_uri());?>/assets/images/ajax-loader.gif" alt="" />');
					var datastring =$('#frm<?php echo cs_allow_special_char($msg_form_counter) ?>').serialize() +"&cs_contact_email=<?php echo esc_js($contact_email);?>&cs_contact_succ_msg=<?php echo cs_allow_special_char($contact_succ_msg);?>&cs_contact_error_msg=<?php echo cs_allow_special_char($error);?>&action=cs_contact_form_submit";
					$.ajax({
						type: 'POST', 
						url: '<?php echo esc_js(admin_url('admin-ajax.php')); ?>',
						data: datastring, 
						dataType: "json",
						success: function(response) {
							if (response.type == 'error'){
								$("#loading_div<?php echo cs_allow_special_char($msg_form_counter);?>").html('');
								$("#loading_div<?php echo cs_allow_special_char($msg_form_counter);?>").hide();
								$("#message<?php echo cs_allow_special_char($msg_form_counter); ?>").addClass('error_mess');
								$("#message<?php echo cs_allow_special_char($msg_form_counter); ?>").show();
								$("#message<?php echo cs_allow_special_char($msg_form_counter); ?>").html(response.message);
							} else if (response.type == 'success'){
								$("#loading_div<?php echo cs_allow_special_char($msg_form_counter); ?>").html('');
								$("#message<?php echo cs_allow_special_char($msg_form_counter); ?>").addClass('succ_mess');
								$("#message<?php echo cs_allow_special_char($msg_form_counter); ?>").show();
								$("#message<?php echo cs_allow_special_char($msg_form_counter); ?>").html(response.message);
							}
						}
					});
				}
			</script>
            
            <div id="form_hide<?php echo absint($msg_form_counter);?>">
            <form id="frm<?php echo absint($msg_form_counter);?>" name="frm<?php echo absint($msg_form_counter);?>" method="post" action="javascript:<?php echo "frm_submit".$msg_form_counter. "()";
                ?>" novalidate>
                <ul class="group">
                    <li>
                      <input type="text" placeholder="Name" name="contact_name" id="contact_name" class="nameinput {validate:{required:true}}">
                    </li>
                    <li>
                      <input type="text" placeholder="Email" name="contact_email" id="contact_email" class="emailinput {validate:{required:true ,email:true}}">
                    </li>
                    <li>
                      <textarea placeholder="Message" name="contact_msg" id="contact_msg" class="{validate:{required:true}}"></textarea>
                    </li>
                    <li>
                      <input type="hidden" value="<?php echo esc_attr($contact_email);?>" name="cs_contact_email">
                      <input type="hidden" value="<?php echo cs_allow_special_char($contact_succ_msg);?>" name="cs_contact_succ_msg">
                      <input type="hidden" name="bloginfo" value="<?php echo get_bloginfo() ?>" />
                      <input type="hidden" name="counter_node" value="<?php echo absint($msg_form_counter)?>" />
                      <span id="loading_div<?php echo absint($msg_form_counter)?>"><i class="fa fa-envelope"></i></span>
                      <div id="message<?php echo absint($msg_form_counter);?>" style="display:none;"></div>
                      <input type="submit" value="Send message" name="submit" id="submit_btn<?php echo absint($msg_form_counter)?>">
                    </li>
                </ul>
            </form>
            </div>
			<?php
			
			echo cs_allow_special_char($after_widget); // WIDGET display CODE End
		}
	}
}
add_action('widgets_init', create_function('', 'return register_widget("cs_contact_msg");'));