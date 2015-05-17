<?php
/**
 * File Type: Event Shortcode
 */
	

//=====================================================================
// Event Shortcode
//=====================================================================
if ( ! function_exists( 'cs_event_listing' ) ) {
	function cs_event_listing($atts, $content = ""){
		global $post,$cs_node,$cs_theme_option,$cs_dcpt_post_time,$cs_dcpt_post_excerpt,$cs_dcpt_post_view,$cs_dcpt_post_category;
		date_default_timezone_set('UTC');
		$current_time = time();
		
		$defaults = array('column_size' => '1/1','cs_events_section_title'=>'','cs_events_view'=>'','cs_events_cat'=>'','cs_events_orderby'=>'ASC','cs_events_listing_type'=>'','orderby'=>'ID','cs_events_excerpt'=>'255','cs_events_num_post'=>'10','cs_events_filterable'=>'','events_pagination'=>'','cs_evnts_post_time'=>'','cs_events_class' => '','cs_events_animation' => '');
		extract( shortcode_atts( $defaults, $atts ) );
		$coloumn_class = cs_custom_column_class($column_size);
		
		if ( trim($cs_events_animation) !='' ) {
			$cs_custom_animation	= 'wow'.' '.$cs_events_animation;
		} else {
			$cs_custom_animation	= '';
		}
		
		ob_start();
		
		if ( $cs_events_view == 'events-calender' ) {
			cs_eventCalender();
		}
		
		$organizer_filter = '';
		$user_meta_key				= '';
		$user_meta_value			= '';
		$meta_compare = "";
		$meta_value   = $current_time;
		$meta_key	  = 'cs_dynamic_event_from_date_time';
		
		
		//==Filters
		$filter_category = '';
		$filter_tag = '';
       	
		if ( isset($_GET['filter_category']) && $_GET['filter_category'] <> '' && $_GET['filter_category'] <> '0' ) { $filter_category = $_GET['filter_category'];
		}else if(isset($cs_events_cat) && $cs_events_cat <> '' && $cs_events_cat <> '0'){
			$filter_category = $cs_dcpt_post_category;
		}
		//==Filters End
		
		if ( $cs_events_listing_type == "upcoming-events" ) $meta_compare = ">=";
        else if ( $cs_events_listing_type == "past-events" ) $meta_compare = "<";
		$cs_counter_events = 0;
		
		if(isset($_GET['sort']) and $_GET['sort']=='asc'){
			$order	= 'ASC';
		} else{
			$order	= $cs_events_orderby;
		}
		
		if(isset($_GET['sort']) and $_GET['sort']=='alphabetical'){
			$orderby	= 'title';
			$order	    = 'ASC';
		} else{
			$orderby	= 'meta_value';
			$order	= $cs_events_orderby;
		}
 		if ( empty($_GET['page_id_all']) ) $_GET['page_id_all'] = 1;

		if ( isset($_GET['organizer']) && $_GET['organizer'] <> '' ) {
			$meta_key				= 'dynamic_event_members';
			$meta_value				= $_GET['organizer'];
			$meta_compare			= "LIKE";
			$organizer_filter		= $_GET['organizer'];
		}
 		if ( $cs_events_listing_type == "all-events" ) {
				$args = array(
					'posts_per_page'			=> "-1",
					'post_type'					=> 'events',
					'post_status'				=> 'publish',
					'orderby'					=> $orderby,
					'order'						=> $order,
				);
             } else {
                $args = array(
                    'posts_per_page'			=> "-1",
                    'post_type'					=> 'events',
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
				$event_category_array = array('event-category' => $_GET['filter_category']);
				$args = array_merge($args, $event_category_array);
			
			} else if(isset($cs_events_cat) && $cs_events_cat <> '' && $cs_events_cat <> '0'){
				$event_category_array = array('event-category' => "$cs_events_cat");
				$args = array_merge($args, $event_category_array);
			}
 			
            $custom_query = new WP_Query($args);
            $count_post = 0;
			$counter = 1;
			$count_post = $custom_query->post_count;
			
			if ( $cs_events_listing_type == "upcoming-events") {
				
				$args = array(
					'posts_per_page'			=> "$cs_events_num_post",
					'paged'						=> $_GET['page_id_all'],
					'post_type'					=> 'events',
					'post_status'				=> 'publish',
					'meta_key'					=> $meta_key,
					'meta_value'				=> $meta_value,
                    'meta_compare'				=> $meta_compare,
					'orderby'					=> $orderby,
					'order'						=> $order,
				 );
			}else if ( $cs_events_listing_type == "all-events" ) {
				
					$args = array(
						'posts_per_page'			=> "$cs_events_num_post",
						'paged'						=> $_GET['page_id_all'],
						'post_type'					=> 'events',
						'post_status'				=> 'publish',
						'meta_key'					=> $meta_key,
						'orderby'					=> $orderby,
						'order'						=> $order,
					);
				
			}
			else {
				$args = array(
                    'posts_per_page'			=> "$cs_events_num_post",
					'paged'						=> $_GET['page_id_all'],
                    'post_type'					=> 'events',
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
			$event_category_array = array('event-category' => "$cs_events_cat");
			$args = array_merge($args, $event_category_array);
		
		} else if(isset($cs_events_cat) && $cs_events_cat <> '' && $cs_events_cat <> '0'){
			$event_category_array = array('event-category' => "$cs_events_cat");
			$args = array_merge($args, $event_category_array);
		}
		
		if(isset($filter_category) && $filter_category <> '' && $filter_category <> '0'){
				
				if ( isset($_GET['filter-tag']) ) {$filter_tag = $_GET['filter-tag'];}
				if($filter_tag <> ''){
					$events_category_array = array('event-category' => "$filter_category",'event-tag' => "$filter_tag");
				}else{
					$events_category_array = array('event-category' => "$filter_category");
				}
				$args = array_merge($args, $events_category_array);
			}
			
		if ( isset($_GET['filter-tag']) && $_GET['filter-tag'] <> '' && $_GET['filter-tag'] <> '0' ) {
			$filter_tag = $_GET['filter-tag'];
			if($filter_tag <> ''){
				$events_category_array = array('event-category' => "$filter_category",'event-tag' => "$filter_tag");
				$args = array_merge($args, $events_category_array);
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
		
		
		if(isset($cs_events_cat) && $cs_events_cat <> '' && $cs_events_cat <> '0'){
			$event_category_array = array('event-category' => "$cs_events_cat");
			$args = array_merge($args, $event_category_array);
		}
		
		$custom_query = new WP_Query($args);
		$user_query = new WP_Query($user_args);
		// $count_post = $user_query->post_count;
		$userArray	= ''; 			
		while ( $user_query->have_posts() ) { $user_query->the_post();
			
			$cs_event_meta = get_post_meta($post->ID, "events", true);			
			if ( $cs_event_meta <> "" ) {
				$cs_event_meta = new SimpleXMLElement($cs_event_meta);
			}
			$user_ids = $cs_event_meta->dynamic_event_members;
			if (isset( $user_ids ) && $user_ids !='' ){
				$userArray	= array(); 
				$user_ids = explode(',',$user_ids);
				if(is_array($user_ids) && !empty( $user_ids )){
					foreach($user_ids as $user_id){
						$userArray[] = $user_id;
					}
				}
			}
		}
		// $count_post = $custom_query->post_count;
		wp_reset_postdata();
		
		
		cs_get_event_filters($cs_events_cat,$cs_events_filterable,$filter_category,$filter_tag,$userArray,$organizer_filter,$cs_custom_animation);
		
		if ( $custom_query->have_posts() <> "" ) {
			
		?>
               <?php  if(isset($cs_events_section_title) && $cs_events_section_title <> ''){
						echo '<div class="main-title col-md-12"><div class="cs-section-title">
								<h2>'.esc_attr( $cs_events_section_title ).'</h2>
						      </div></div>';
                  }
				  
				 //$count_post = $custom_query->post_count;
				 $counter_posts = 0;
				 $eventObject	= new EventTemplates();
				 
				 while ( $custom_query->have_posts() ): $custom_query->the_post();
						$counter_posts++;
						$event_from_date = get_post_meta($post->ID, "dynamic_post_event_from_date", true);
						$cs_event_meta = get_post_meta($post->ID, "events", true);
						
						if ( $cs_event_meta <> "" ) {
							$cs_event_meta = new SimpleXMLElement($cs_event_meta);
						}
						
						if ( $cs_events_view == 'events-listing' ) {
							$eventObject->cs_listing_view( $cs_event_meta , $event_from_date, $cs_events_cat , $cs_events_excerpt );
							
							if ( $counter_posts == 1 || $counter_posts < 2 ) {
								echo '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>';
							}
						
						} else if ( $cs_events_view == 'events-timeline' ) {
							$eventObject->cs_timeline_view( $cs_event_meta , $event_from_date, $cs_events_cat , $cs_events_excerpt );
						} else if ( $cs_events_view == 'events-classic' ) {
							$eventObject->cs_classic_view( $cs_event_meta , $event_from_date, $cs_events_cat , $cs_events_excerpt );
						} else if ( $cs_events_view == 'events-minimal' ) {
							$eventObject->cs_minimal_view( $cs_event_meta , $event_from_date, $cs_events_cat , $cs_events_excerpt );
						} else {
							$eventObject->cs_listing_view( $cs_event_meta , $event_from_date, $cs_events_cat , $cs_events_excerpt );
						}
				   
				 endwhile;
 					  	$qrystr = '';
 						if ( $events_pagination == "Show Pagination" and $count_post > $cs_events_num_post and $cs_events_num_post > 0) {
 							 if ( isset($_GET['organizer']) ) $qrystr .= "&amp;organizer=".$_GET['organizer'];
							 if ( isset($_GET['sort']) ) $qrystr .= "&amp;sort=".$_GET['sort'];
							 if ( isset($_GET['filter_category']) ) $qrystr .= "&amp;filter_category=".$_GET['filter_category'];
							 if ( isset($_GET['filter-tag']) ) $qrystr .= "&amp;filter-tag=".$_GET['filter-tag'];
							 if ( isset($_GET['page_id']) ) { $qrystr .= "&page_id=".$_GET['page_id'];}
							 
							 echo cs_pagination($count_post, $cs_events_num_post,$qrystr);
						 }
				} else {
					?> 
						<div class="col-md-12"><div class="succ_mess"><p><?php esc_html_e( 'No Event Found','Awaken' );?></p></div></div>
					<?php 
					}
		$eventpost_data = ob_get_clean();
		return $eventpost_data;
	}
	add_shortcode('cs_events', 'cs_event_listing');
}


//=====================================================================
// Event Location Fields
//=====================================================================
if ( ! function_exists( 'cs_location_fields' ) ) {
	function cs_location_fields(){
		global $cs_xmlObject;
		if ( isset($cs_xmlObject)) {
			if(isset($cs_xmlObject->dynamic_post_location_latitude)){ $dynamic_post_location_latitude = $cs_xmlObject->dynamic_post_location_latitude;} else {$dynamic_post_location_latitude = '';}
			if(isset($cs_xmlObject->dynamic_post_location_longitude)){ $dynamic_post_location_longitude = $cs_xmlObject->dynamic_post_location_longitude;} else {$dynamic_post_location_longitude = '';}
			if(isset($cs_xmlObject->dynamic_post_location_zoom)){ $dynamic_post_location_zoom = $cs_xmlObject->dynamic_post_location_zoom;} else {$dynamic_post_location_zoom = '';}
			if(isset($cs_xmlObject->dynamic_post_location_address)){ $dynamic_post_location_address = $cs_xmlObject->dynamic_post_location_address;} else {$dynamic_post_location_address = '';}
			if(isset($cs_xmlObject->loc_city)){ $loc_city = $cs_xmlObject->loc_city;} else {$loc_city = '';}
			if(isset($cs_xmlObject->loc_postcode)){ $loc_postcode = $cs_xmlObject->loc_postcode;} else {$loc_postcode = '';}
			if(isset($cs_xmlObject->loc_region)){ $loc_region = $cs_xmlObject->loc_region;} else {$loc_region = '';}
			if(isset($cs_xmlObject->loc_country)){ $loc_country = $cs_xmlObject->loc_country;} else {$loc_country = '';}
			if(isset($cs_xmlObject->event_map_switch)){ $event_map_switch = $cs_xmlObject->event_map_switch;} else {$event_map_switch = '';}
			if(isset($cs_xmlObject->event_map_heading)){ $event_map_heading = $cs_xmlObject->event_map_heading;} else {$event_map_heading = '';}
	
		}
		else {
			$dynamic_post_location_latitude = '';
			$dynamic_post_location_longitude = '';
			$dynamic_post_location_zoom = '';
			$dynamic_post_location_address = '';
			$loc_city = '';
			$loc_postcode = '';
			$loc_region = '';
			$loc_country = '';
			$event_map_switch = '';
			$event_map_heading = 'Event Location';
		}							
		cs_enqueue_location_gmap_script();
			?>
   
	<fieldset class="gllpLatlonPicker"  style="width:100%; float:left;">
	  <div class="page-wrap page-opts left" style="overflow:hidden; position:relative;">
		<div class="option-sec" style="margin-bottom:0;">
		  <div class="opt-conts">
			<ul class="form-elements">
              <li class="to-label">
                <label>Location Map</label>
              </li>
              <li class="to-field has_input">
                <div class="input-sec">
                  <label class="pbwp-checkbox">
                    <input type="hidden" name="event_map_switch" value=""/>
                    <input type="checkbox" class="myClass" name="event_map_switch" <?php if (isset($cs_xmlObject->event_map_switch) && $cs_xmlObject->event_map_switch == "on") echo "checked" ?>/>
                    <span class="pbwp-box"></span> </label>
                    <input type="text" name="event_map_heading" value="<?php echo esc_attr( htmlspecialchars( $event_map_heading ) );?>" />
                </div>
              </li>
            </ul>
            <ul class="form-elements">
			  <li class="to-label">
				<label>Address</label>
			  </li>
			  <li class="to-field">
				<input name="dynamic_post_location_address" id="loc_address" type="text" value="<?php echo esc_attr( htmlspecialchars( $dynamic_post_location_address ) )?>" class="gllpSearchButton" onBlur="gll_search_map()" />
			  </li>
			</ul>
			
            <ul class="form-elements">
			  <li class="to-label">
				<label>City / Town</label>
			  </li>
			  <li class="to-field">
				<input name="loc_city" id="loc_city" type="text" value="<?php echo esc_attr( htmlspecialchars( $loc_city ) );?>" class="gllpSearchButton" onBlur="gll_search_map()" />
			  </li>
			</ul>
			<ul class="form-elements">
			  <li class="to-label">
				<label>Post Code</label>
			  </li>
			  <li class="to-field">
				<input name="loc_postcode" id="loc_postcode" type="text" value="<?php echo esc_attr( htmlspecialchars( $loc_postcode ) );?>" class="gllpSearchButton" onBlur="gll_search_map()" />
			  </li>
			</ul>
			<ul class="form-elements">
			  <li class="to-label">
				<label>Region</label>
			  </li>
			  <li class="to-field">
				<input name="loc_region" id="loc_region" type="text" value="<?php echo esc_attr( htmlspecialchars( $loc_region ) );?>" class="gllpSearchButton" onBlur="gll_search_map()" />
			  </li>
			</ul>
			<ul class="form-elements">
			  <li class="to-label">
				<label>Country</label>
			  </li>
			  <li class="to-field">
				<select name="loc_country" id="loc_country" class="gllpSearchButton" onBlur="gll_search_map()" >
				  <?php foreach( cs_get_countries() as $key => $val ):?>
				  <option <?php if($loc_country==$val)echo "selected"?> ><?php echo esc_attr( $val );?></option>
				  <?php endforeach; ?>
				</select>
			  </li>
			</ul>
			
		  </div>
		</div>
	  </div>
	</fieldset>
    
	<?php
	}
}

//=====================================================================
// Event Custom Fields
//=====================================================================
if ( ! function_exists( 'cs_post_event_fields' ) ) {
	function cs_post_event_fields(){
		global $post,$cs_xmlObject;
		$dynamic_post_event_from_date = '';
		$event_organizer = array();
		$post_meta = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		$dynamic_post_event_from_date = get_post_meta($post->ID, "dynamic_post_event_from_date", true);
 		if ( $post_meta <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_meta);
			if(isset($cs_xmlObject->dynamic_post_event_all_day)){ $dynamic_post_event_all_day = $cs_xmlObject->dynamic_post_event_all_day;} else {$dynamic_post_event_all_day = '';}
		} else {
			$dynamic_post_event_all_day = '';
 		}
		$event_organizer = array();
		if(isset($cs_xmlObject->event_organizer))
		$event_organizer = $cs_xmlObject->event_organizer;
		if ($event_organizer){
			$event_organizer = explode(",", $event_organizer);
		}
			
		cs_enqueue_timepicker_script();
		?>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/include/assets/scripts/ui_multiselect.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri();?>/include/assets/css/jquery_ui.css" />
<link type="text/css" rel="stylesheet"  href="<?php echo get_template_directory_uri();?>/include/assets/css/ui_multiselect.css" />
<link type="text/css" rel="stylesheet"  href="<?php echo get_template_directory_uri();?>/include/assets/css/common.css" />
		<script type="text/javascript">
			jQuery(function($){
				jQuery(".multiselect").multiselect();
			//	jQuery('#switcher').themeswitcher();
			});
		</script>
	<script>
				 jQuery(function(){
				 jQuery('#dynamic_post_event_start_time').datetimepicker({
				  datepicker:false,
						format:'H:i',
						formatTime: 'H:i',
						step:30,
				  onSgow:function( at ){
				   this.setOptions({
					maxTime:jQuery('#dynamic_post_event_end_time').val()?jQuery('#dynamic_post_event_end_time').val():false
				   })
				  }
				 });
				 jQuery('#dynamic_post_event_end_time').datetimepicker({
					datepicker:false,
						format:'H:i',
						formatTime: 'H:i',
						step:30,
				  onShow:function( at ){
				   this.setOptions({
					minTime:jQuery('#dynamic_post_event_start_time').val()?jQuery('#dynamic_post_event_start_time').val():false
				   })
				  }
				 });
				 jQuery('#from_date').datetimepicker({
				  format:'Y/m/d',
				  onShow:function( ct ){
				   this.setOptions({
					maxDate:jQuery('#to_date').val()?jQuery('#to_date').val():false
				   })
				  },
				  timepicker:false
				 });
				 jQuery('#to_date').datetimepicker({
				  format:'Y/m/d',
				  onShow:function( ct ){
				   this.setOptions({
					minDate:jQuery('#from_date').val()?jQuery('#from_date').val():false
				   })
				  },
				  timepicker:false
				 });
				});
			</script>
	<div class="clear"></div>
	<ul class="form-elements">
	  <li class="to-label">
		<label>Event Date</label>
	  </li>
	  <li class="to-field short-field">
		<input type="text" id="from_date" name="dynamic_post_event_from_date" value="<?php if(isset($dynamic_post_event_from_date) && $dynamic_post_event_from_date <>'') echo cs_allow_special_char($dynamic_post_event_from_date); else echo gmdate("Y/m/d"); ?>" />
	  </li>
	  
	</ul>
	<ul class="form-elements event-day bcevent_title">
	  <li class="to-label">
		<label>Event Time</label>
	  </li>
	  <li class="to-field">
		<div id="event_time" <?php /*?><?php if($dynamic_post_event_all_day=='on')echo 'style="display:none"'?><?php */?>>
		  <div class="input-sec">
			<input id="dynamic_post_event_start_time" name="dynamic_post_event_start_time" value="<?php if(isset($cs_xmlObject->dynamic_post_event_start_time)){echo esc_attr($cs_xmlObject->dynamic_post_event_start_time);} else { echo date('H:i');}?>" type="text" class="vsmall" />
			<label class="first-label">Start time</label>
		  </div>
		  <!--<span class="short">To</span>-->
		  <div class="input-sec">
			<input id="dynamic_post_event_end_time" name="dynamic_post_event_end_time" value="<?php if(isset($cs_xmlObject->dynamic_post_event_start_time)){echo esc_attr($cs_xmlObject->dynamic_post_event_end_time);} else { echo date('H:i');}?>" type="text" class="vsmall"  />
			<label class="sec-label">End time</label>
		  </div>
		  <div class="input-sec">
			<div class="checkbox-list">
			  <div class="checkbox-item">
				<input type="checkbox" name="dynamic_post_event_all_day" value="on" <?php if(isset($cs_xmlObject->dynamic_post_event_all_day) && $cs_xmlObject->dynamic_post_event_all_day == 'on'){echo "checked";}?>  class="styled" />
			  </div>
			</div>
			<label>AllDay</label>
		  </div>
		</div>
	  </li>
	</ul>
	<?php if ( empty( $_GET['post']) ) {?>
	<ul class="form-elements">
	  <li class="to-label">
		<label>Repeat</label>
	  </li>
	  <li class="to-field">
		<div class="input-sec">
		  <div class="select-style">
			<select name="dynamic_post_event_repeat" class="dropdown" onchange="toggle_with_value('num_repeat', this.value)">
			  <option value="0">-- Never Repeat --</option>
			  <option value="+1 day">Every Day</option>
			  <option value="+1 week">Every Week</option>
			  <option value="+1 month">Every Month</option>
			</select>
		  </div>
		</div>
	  </li>
	</ul>
	<ul class="form-elements" id="num_repeat" style="display:none">
	  <li class="to-label">
		<label>Repeat how many time</label>
	  </li>
	  <li class="to-field">
		<div class="input-sec">
		  <div class="select-style">
			<select name="dynamic_post_event_num_repeat" class="dropdown">
			  <?php for ( $i = 1; $i <= 25; $i++ ) {?>
			  <option><?php echo intval( $i )?></option>
			  <?php }?>
			</select>
		  </div>
		</div>
	  </li>
	</ul>
	<?php }?>
	<div class="clear"></div>
	<ul class="form-elements">
	  <li class="to-label">
		<label>Ticket Option</label>
	  </li>
	  <li class="to-field">
		<div class="input-sec">
          <label>Title</label>
		  <input type="text" id="dynamic_post_event_ticket_options" name="dynamic_post_event_ticket_options" value="<?php if(isset($cs_xmlObject->dynamic_post_event_ticket_options)){echo esc_attr( $cs_xmlObject->dynamic_post_event_ticket_options );}?>" />
		</div>
		<div class="input-sec">
          <label>Url</label>
		  <input type="text" id="dynamic_post_event_buy_now" name="dynamic_post_event_buy_now" value="<?php if(isset($cs_xmlObject->dynamic_post_event_buy_now)){echo esc_attr( $cs_xmlObject->dynamic_post_event_buy_now );}?>" />
		</div>
		<div class="input-sec">
          <label>Color</label>
		  <input type="text" name="dynamic_post_event_ticket_color" value="<?php if(isset($cs_xmlObject->dynamic_post_event_ticket_color)){ echo esc_attr( $cs_xmlObject->dynamic_post_event_ticket_color );}?>" class="bg_color" />
		</div>
	  </li>
	</ul><div class="clear"></div>
    
    <ul class="form-elements">
	  <li class="to-label">
		<label>Contact No</label>
	  </li>
	  <li class="to-field">
		<div class="input-sec">
		  <input type="text" id="dynamic_post_event_contact_no" name="dynamic_post_event_contact_no" value="<?php if(isset($cs_xmlObject->dynamic_post_event_contact_no)){echo esc_attr( $cs_xmlObject->dynamic_post_event_contact_no );}?>" />
	
		</div>
	  </li>
	</ul>
    
	<div class="clear"></div>
    <ul class="form-elements">
	  <li class="to-label">
		<label>Email</label>
	  </li>
	  <li class="to-field">
		<div class="input-sec">
		  <input type="text" id="dynamic_post_event_email" name="dynamic_post_event_email" value="<?php if(isset($cs_xmlObject->dynamic_post_event_email)){echo esc_attr( $cs_xmlObject->dynamic_post_event_email );}?>" />
		</div>
	  </li>
	</ul>
    
    <ul class="form-elements">
	  <li class="to-label">
		<label>Website Url</label>
	  </li>
	  <li class="to-field">
		<div class="input-sec">
		  <input type="text" id="dynamic_post_event_web_url" name="dynamic_post_event_web_url" value="<?php if(isset($cs_xmlObject->dynamic_post_event_web_url)){echo esc_attr( $cs_xmlObject->dynamic_post_event_web_url );}?>" />
		</div>
	  </li>
	</ul>
    
	<div class="clear"></div>
	
	<div class="clear"></div>
	<input type="hidden" name="dynamic_post_location" value="1" />
	<?php
	}
}