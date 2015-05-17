<?php
/**
 * Event Map
 */
 
global $cs_node, $cs_theme_option,$cs_xmlObject,$post_xml,$img_class,$image_url;

?>
<style scoped="scoped">
.event_map .col-md-12 {
	padding:0px;
}
</style>
<?php
	$event_view = $cs_xmlObject->dynamic_post_event_views;
	$map_height	= '300';
	
	$event_map_heading = $cs_xmlObject->event_map_heading;
						 				
	$map_attribute = array('column_size'=>'','cs_map_section_title'=> $event_map_heading,'map_title'=>'','map_height'=> $map_height,'map_view'=>'ROADMAP','map_info'=>'','map_info_width'=>'200','map_info_height'=>'200','map_marker_icon'=>'','map_show_marker'=>'true','map_controls'=>'false','map_draggable' => 'true','map_scrollwheel' => 'true','map_conactus_content' => '','map_border' => '','map_border_color' => '','cs_custom_class' => '','cs_custom_animation' => '','cs_custom_animation_duration'=>'1');
	if(isset($cs_xmlObject->dynamic_post_location_latitude) && $cs_xmlObject->dynamic_post_location_latitude <> ''){
		$map_attribute['map_lat'] = (string)$cs_xmlObject->dynamic_post_location_latitude;
	}
	if(isset($cs_xmlObject->dynamic_post_location_longitude) && $cs_xmlObject->dynamic_post_location_longitude <> ''){
		$map_attribute['map_lon'] = (string)$cs_xmlObject->dynamic_post_location_longitude;
	}
	if(isset($cs_xmlObject->dynamic_post_location_address_icon) && $cs_xmlObject->dynamic_post_location_address_icon <> ''){
		$map_attribute['map_marker_icon'] = 'fa-map-marker';
	}
	if(isset($cs_xmlObject->dynamic_post_location_address) && $cs_xmlObject->dynamic_post_location_address <> ''){
		$map_attribute['map_info'] = $cs_xmlObject->dynamic_post_location_address;
	}
	if(isset($cs_xmlObject->dynamic_post_location_zoom) && $cs_xmlObject->dynamic_post_location_zoom <> ''){
		$map_attribute['map_zoom'] = (int)$cs_xmlObject->dynamic_post_location_zoom;
	}
	echo cs_map_shortcode($map_attribute);
	?>
